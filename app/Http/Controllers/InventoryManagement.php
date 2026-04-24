<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

class InventoryManagement extends Controller
{
    public function index()
    {
        $stock = Inventory::simplePaginate(15);

        if ($stock->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No Record for Inventory',
                'data' => $stock
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Inventory Details Fetched Successfully',
            'data' => $stock
        ], 200);
    }

    public function trashed()
    {
        $trashedStock = Inventory::onlyTrashed()->latest()->simplePaginate(15);

        if ($trashedStock->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No Trashed Records Found',
                'data' => $trashedStock
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Trashed Inventory Fetched Successfully',
            'data' => $trashedStock
        ], 200);
    }

    public function restoreItem($id)
    {
        $item = Inventory::onlyTrashed()->findOrFail($id);
        $item->restore();

        return response()->json([
            'status' => 'success',
            'message' => 'Item Restored Successfully',
        ], 200);
    }

    public function forceDeleteItem($id)
    {
        $item = Inventory::onlyTrashed()->findOrFail($id);
        $item->forceDelete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item Permanently Deleted',
        ], 200);
    }

    public function showLogs($id)
    {
        $logs = Inventory::withTrashed()->with('logs')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Retrieved Successfully',
            'data' => $logs
        ], 200);
    }

    public function show($id)
    {
        $item = Inventory::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Retrieved Successfully',
            'data' => $item
        ], 200);
    }

    public function add(Request $request)
    {
        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('inventories', 'name')
                ],
                'unit' => 'required|string|max:255',
                'initial_stock' => 'required|numeric',
                'alert' => 'required|numeric'
            ],
            [
                'name.unique' => 'This item name already exists in the active inventory or the trash. Please restore it or choose a different name.'
            ]
        );

        $item = DB::transaction(function () use ($request) {
            $newItem = new Inventory();
            $newItem->name = $request->name;
            $newItem->unit = $request->unit;
            $newItem->alert = $request->alert;
            $newItem->current_stock = $request->initial_stock;
            $newItem->save();

            if ($request->initial_stock > 0) {
                InventoryLog::create([
                    'inventory_id' => $newItem->id,
                    'type' => 'In',
                    'quantity' => $request->initial_stock,
                    'created_by' => auth()->id(),
                    'action' => 'Initial Stock Added'
                ]);
            }
            return $newItem;
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Item Added Successfully',
            'data' => $item
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $editItem = Inventory::findOrFail($id);

        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('inventories', 'name')->ignore($editItem->id)
                ],
                'unit' => 'required|string|max:255',
                'alert' => 'required|numeric',
                'stock' => 'nullable|numeric'
            ],
            [
                'name.unique' => 'This item name already exists in the active inventory or the trash. Please restore it or choose a different name.'
            ]
        );

        $item = DB::transaction(function () use ($request, $editItem) {
            $editItem->name = $request->name;
            $editItem->unit = $request->unit;
            $editItem->alert = $request->alert;

            if ($request->has('stock') && $request->stock != $editItem->current_stock) {
                $difference = $request->stock - $editItem->current_stock;

                InventoryLog::create([
                    'inventory_id' => $editItem->id,
                    'type' => $difference > 0 ? 'In' : 'Out',
                    'quantity' => abs($difference),
                    'created_by' => auth()->id(),
                    'action' => 'Stock updated by editing Item'
                ]);

                $editItem->current_stock = $request->stock;
            }

            $editItem->save();
            return $editItem;
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Item Updated Successfully',
            'data' => $item
        ], 200);
    }

    public function addStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|numeric|min:1',
            'action' => 'required|string|max:255'
        ]);

        $item = DB::transaction(function () use ($request, $id) {
            $updateItem = Inventory::findOrFail($id);
            $updateItem->increment('current_stock', $request->stock);

            InventoryLog::create([
                'inventory_id' => $updateItem->id,
                'type' => 'In',
                'quantity' => $request->stock,
                'created_by' => auth()->id(),
                'action' => $request->action
            ]);

            return $updateItem;
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Stock Added Successfully',
            'data' => $item
        ], 200);
    }

    public function deductStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|numeric|min:1',
            'action' => 'required|string|max:255'
        ]);


        $item = DB::transaction(function () use ($request, $id) {
            $updateItem = Inventory::findOrFail($id);
            if ($request->stock > $updateItem->current_stock) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Stock is not enough',
                ], 400);
            }
            $updateItem->decrement('current_stock', $request->stock);

            InventoryLog::create([
                'inventory_id' => $updateItem->id,
                'type' => 'Out',
                'quantity' => $request->stock,
                'created_by' => auth()->id(),
                'action' => $request->action
            ]);

            return $updateItem;
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Stock Deducted Successfully',
            'data' => $item
        ], 200);
    }

    public function deleteItem($id)
    {
        $item = Inventory::findOrFail($id);
        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item Soft Deleted Successfully',
        ], 200);
    }

    public function alerts()
    {
        $alerts = Inventory::whereColumn('current_stock', '<=', 'alert')->get();

        if ($alerts->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No Alerts',
                'data' => []
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Alerts Fetched Successfully',
            'data' => $alerts
        ], 200);
    }

    public function search($search)
    {
        $searchQuery = trim($search);

        if (empty($searchQuery)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search Query is Empty',
                'data' => []
            ], 400);
        }

        $results = Inventory::where('name', 'like', '%' . $searchQuery . '%')->get();

        if ($results->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No Results Found',
                'data' => []
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Search Results Fetched Successfully',
            'data' => $results
        ], 200);
    }

    public function allHistory()
    {
        $history = InventoryLog::with('inventory', 'user')->latest()->get();

        if ($history->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No History',
                'data' => []
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'History Fetched Successfully',
            'data' => $history
        ], 200);
    }

    public function exportStockasPdf()
    {
        $stock = Inventory::withTrashed()->get();
        if ($stock->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No stock available to export.'
            ], 404);
        }
        $pdf = Pdf::loadView('StockReport', ['stock' => $stock]);
        return $pdf->download('LabInventoryReport.pdf');
    }
}
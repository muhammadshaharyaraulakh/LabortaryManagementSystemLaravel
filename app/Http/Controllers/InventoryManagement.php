<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;


class InventoryManagement extends Controller
{
    // =========================
    // SHOW ALL INVENTORY ITEMS
    // =========================
    public function index()
    {
        $stock = Inventory::simplePaginate(15);

        if ($stock->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No Item Exists in Inventory',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inventory Details Fetched Successfully',
            'data' => $stock
        ], Response::HTTP_OK);
    }

    // =========================
    // SHOW ALL TRASHED INVENTORY ITEMS
    // =========================
    public function trashed()
    {
        $trashedStock = Inventory::onlyTrashed()->latest()->simplePaginate(15);

        if ($trashedStock->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No Trashed Records Found',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'message' => 'Trashed Inventory Fetched Successfully',
            'data' => $trashedStock
        ], Response::HTTP_OK);
    }
    // =========================
    // RESTORE TRASHED INVENTORY ITEM
    // =========================
    public function restoreItem($id)
    {
        $item = Inventory::onlyTrashed()->findOrFail($id);
        $item->restore();

        return response()->json([
            'success' => true,
            'message' => 'Item Restored Successfully',
        ], Response::HTTP_OK);
    }
    // =========================
    // FORCE DELETE TRASHED INVENTORY ITEM
    // =========================
    public function forceDeleteItem($id)
    {
        $item = Inventory::onlyTrashed()->findOrFail($id);
        $item->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Item Permanently Deleted',
        ], Response::HTTP_OK);
    }
    // =========================
    // SHOW INVENTORY LOGS
    // =========================
    public function showLogs($id)
    {
        $inventory = Inventory::withTrashed()
            ->with([
                'logs' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Data Retrieved Successfully',
            'data' => $inventory->logs
        ], Response::HTTP_OK);
    }
    // =========================
    // SHOW INVENTORY ITEM
    // =========================
    public function show($id)
    {
        $item = Inventory::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Data Retrieved Successfully',
            'data' => $item
        ], Response::HTTP_OK);
    }
    public function add(Request $request)
    {
        $validations = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('inventories', 'name')
            ],
            'initial_stock' => ['required', 'numeric'],
            'alert' => ['required', 'numeric',],
            'unit' => ['required', 'string', 'max:255']
        ], [
            'name.unique' => 'This item name already exists in the active inventory or the trash. Please restore it or choose a different name.'
        ]);

        try {
            DB::beginTransaction();

            $inventory = Inventory::create([
                'name' => $validations['name'],
                'stock_quantity' => $validations['initial_stock'],
                'current_stock' => $validations['initial_stock'],
                'alert' => $validations['alert'],
                'unit' => $validations['unit'],
            ]);

            if ($validations['initial_stock'] > 0) {
                InventoryLog::create([
                    'inventory_id' => $inventory->id,
                    'type' => 'In',
                    'quantity' => $validations['initial_stock'],
                    'created_by' => auth()->id(),
                    'action' => 'Initial Stock Added'
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item added successfully',
            ], Response::HTTP_CREATED);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to add item',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function edit(Request $request, $id)
    {
        $editItem = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('inventories', 'name')->ignore($editItem->id)
            ],
            'unit' => ['required', 'string', 'max:255'],
            'alert' => ['required', 'numeric'],
            'stock' => ['nullable', 'numeric', 'min:0']
        ], [
            'name.unique' => 'This item name already exists in the active inventory or the trash. Please restore it or choose a different name.'
        ]);

        try {
            DB::beginTransaction();

            $editItem->name = $validated['name'];
            $editItem->unit = $validated['unit'];
            $editItem->alert = $validated['alert'];

            if (isset($validated['stock']) && $validated['stock'] != $editItem->current_stock) {

                $newStock = $validated['stock'];
                $difference = $newStock - $editItem->current_stock;
                if ($newStock < 0) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stock cannot be negative',
                        'data' => null,
                        'error' => null
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                InventoryLog::create([
                    'inventory_id' => $editItem->id,
                    'type' => $difference > 0 ? 'In' : 'Out',
                    'quantity' => abs($difference),
                    'created_by' => auth()->id(),
                    'action' => 'Stock updated by editing Item'
                ]);

                $editItem->current_stock = $newStock;
            }

            $editItem->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item updated successfully',
                'data' => $editItem,
                'error' => null
            ], Response::HTTP_OK);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update item',
                'data' => null,
                'error' => app()->environment('local') ? $e->getMessage() : null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function addStock(Request $request, $id)
    {
        $validated = $request->validate([
            'stock' => ['required', 'numeric', 'min:1'],
            'action' => ['required', 'string', 'max:255']
        ]);

        try {
            DB::beginTransaction();

            $item = Inventory::findOrFail($id);
            if ($validated['stock'] <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock must be greater than 0',
                    'data' => null,
                    'error' => null
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $item->increment('current_stock', $validated['stock']);

            InventoryLog::create([
                'inventory_id' => $item->id,
                'type' => 'In',
                'quantity' => $validated['stock'],
                'created_by' => auth()->id(),
                'action' => $validated['action']
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Stock added successfully',
                'data' => $item,
                'error' => null
            ], Response::HTTP_OK);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to add stock',
                'data' => null,
                'error' => app()->environment('local') ? $e->getMessage() : null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deductStock(Request $request, $id)
    {
        $validated = $request->validate([
            'stock' => ['required', 'numeric', 'min:1'],
            'action' => ['required', 'string', 'max:255']
        ]);

        try {
            DB::beginTransaction();

            $item = Inventory::findOrFail($id);
            if ($validated['stock'] <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock must be greater than 0',
                    'data' => null,
                    'error' => null
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            if ($validated['stock'] > $item->current_stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock is not enough',
                    'data' => [
                        'available_stock' => $item->current_stock
                    ],
                    'error' => null
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $item->decrement('current_stock', $validated['stock']);

            InventoryLog::create([
                'inventory_id' => $item->id,
                'type' => 'Out',
                'quantity' => $validated['stock'],
                'created_by' => auth()->id(),
                'action' => $validated['action']
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Stock deducted successfully',
                'data' => $item,
                'error' => null
            ], Response::HTTP_OK);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to deduct stock',
                'data' => null,
                'error' => app()->environment('local') ? $e->getMessage() : null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function deleteItem($id)
    {
        $item = Inventory::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item Soft Deleted Successfully',
        ], Response::HTTP_OK);
    }

    public function alerts()
    {
        $alerts = Inventory::whereColumn('current_stock', '<=', 'alert')->get();

        if ($alerts->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'No Alerts',
                'data' => []
            ], Response::HTTP_OK);
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
                'success' => false,
                'message' => 'Search Query is Empty',
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        $results = Inventory::where('name', 'like', '%' . $searchQuery . '%')->get();

        if ($results->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No Results Found',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Search Results Fetched Successfully',
            'data' => $results
        ], Response::HTTP_OK);
    }

    public function exportStockasPdf()
    {
        $stock = Inventory::withTrashed()->get();
        if ($stock->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No stock available to export.',
                'data' => [],
                'error' => null
            ], Response::HTTP_OK);
        }
        $pdf = Pdf::loadView('StockReport', ['stock' => $stock]);
        return $pdf->download('LabInventoryReport.pdf');
    }
}
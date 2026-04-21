<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Test;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
class SampleCollectorController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'tests' => function ($query) {
                $query->whereHas('department', function ($query) {
                    $query->where('type', 'sample_based');
                })->with('department');
            }
        ])
            ->whereHas('tests', function ($query) {
                $query->where('order_test.status', 'Created')
                    ->whereHas('department', function ($query) {
                        $query->where('type', 'sample_based');
                    });
            })
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'message' => 'No orders found',
                'status' => 404
            ]);
        }

        return response()->json([
            'message' => 'Orders found',
            'status' => 200,
            'data' => $orders
        ]);
    }
    public function CollectSample(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'test_id' => 'required|exists:tests,id',
            'vial_number' => 'required|string|max:255|unique:order_test,vialBarcode',
        ], [
            'vial_number.unique' => 'This vial barcode has already been used.',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->tests()->updateExistingPivot($request->test_id, [
            'vialBarcode' => $request->vial_number,
            'status' => 'Collected',
            'collectedAt' => now(),
            'collectedBy' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Sample collected successfully',
            'status' => 200,
            'data' => $order
        ]);
    }
}

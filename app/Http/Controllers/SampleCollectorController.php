<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Test;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use \Symfony\Component\HttpFoundation\Response;
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
                'status' => false,
                'message' => 'No orders found',
                'data' => []
            ], Response::HTTP_OK);
        }

        return response()->json([

            'status' => true,
            'message' => 'Orders found',
            'data' => $orders
        ], Response::HTTP_OK);
    }
    public function CollectSample(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'test_id' => 'required|exists:tests,id',
            'vial_number' => 'required|string|max:255',
        ]);

        $order = Order::where('id', $request->order_id)
            ->whereHas('tests', function ($query) use ($request) {
                $query->where('tests.id', $request->test_id)
                    ->where('vialBarcode', $request->vial_number);
            })->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Barcode for this specific test.',
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        $order->tests()->updateExistingPivot($request->test_id, [
            'status' => 'Collected',
            'collectedAt' => now(),
            'collectedBy' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Sample collected successfully',
            'status' => true,
        ], Response::HTTP_OK);
    }
    
}

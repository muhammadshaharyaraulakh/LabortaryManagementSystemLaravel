<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PHPUnit\Logging\OpenTestReporting\Status;

class OrderController extends Controller
{
    public function CreateOrder(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "phone" => "required|regex:/^[0-9]{11}$/",
            "email" => "required|email",
            "age" => "required|integer|min:0|max:70",
            "gender" => "required|in:Male,Female,Other",
            "discount" => "nullable|numeric|min:0",
            "tests" => "required|array|min:1",
            "tests.*" => "exists:tests,id"
        ]);

        try {
            DB::beginTransaction();

            $tests = Test::whereIn('id', $validated['tests'])->get();
            $subtotal = $tests->sum('price');
            $discount = $validated['discount'] ?? 0;
            if ($discount > $subtotal) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'discount' => 'Discount cannot be greater than the subtotal amount.'
                    ]
                ], 422);
            }

            $afterDiscount = $subtotal - $discount;
            $tax = $afterDiscount * 0.05;
            $grandTotal = $afterDiscount + $tax;
            $trackingId = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(4));

            if (app()->environment('local')) {
                Http::fake([
                    'api.fia.gov.pk/*' => Http::response([
                        'status' => 'success',
                        'receipt_number' => 'FIA-TEST-' . rand(100000, 999999)
                    ], 200)
                ]);
            }

            $fiaResponse = Http::timeout(10)->post('https://api.fia.gov.pk/tax/sync', [
                'tracking_id' => $trackingId,
                'tax_amount' => $tax,
                'total_amount' => $grandTotal,
                'lab_id' => env('FIA_LAB_KEY', 'TEST_KEY_123')
            ]);

            $fiaReceiptNo = null;
            if ($fiaResponse->successful()) {
                $fiaReceiptNo = $fiaResponse->json('receipt_number');
            }

            $order = Order::create([
                'trackingId' => $trackingId,
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'age' => $validated['age'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'grandTotal' => $grandTotal,
                'fiaReceiptNo' => $fiaReceiptNo,
                'userId' => Auth()->user()->id
            ]);

            foreach ($tests as $test) {
                $order->tests()->attach($test->id, [
                    'status' => 'Created',
                    'priceAtOrder' => $test->price
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Order created and synced successfully!',
                'tracking_id' => $trackingId,
                'fia_receipt' => $fiaReceiptNo
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create order: ' . $e->getMessage()
            ], 500);
        }
    }
    public function showSummary($trackingId)
    {
        $order = Order::with('tests')->where('trackingId', $trackingId)->firstOrFail();

        return view('orders.summary', compact('order'));
    }


    public function getOrders()
    {
        $orders = Order::where('userId', Auth::id())
            ->with('tests')
            ->whereDate('created_at', Carbon::today())
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $orders
        ]);
    }
    public function SearchOrder(Request $request, $search)
    {
        if (empty($search)) {
            return response()->json([
                'status' => 400,
                'message' => 'Search parameter is required'
            ], 400);
        }

        $order = Order::with('tests')
            ->where('trackingId', $search)
            ->where('userId', Auth::id())
            ->first();

        if (empty($order)) {
            return response()->json([
                'status' => 404,
                'message' => 'No order found with this Tracking ID.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Order found',
            'orders' => [$order]
        ]);
    }
    public function Search(Request $request)
    {
        $validation = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $startDate = Carbon::parse($validation['startDate'])->startOfDay();
        $endDate = Carbon::parse($validation['endDate'])->endOfDay();

        $orders = Order::where('userId', Auth::id())
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalOrders = $orders->count();
        $totalMoney = $orders->sum('grandTotal');

        $deletedOrders = 0;

        return response()->json([
            'status' => 200,
            'message' => 'Statistics calculated successfully',
            'data' => [
                'orders_created' => $totalOrders,
                'money_collected' => $totalMoney,
                'deleted_orders' => $deletedOrders
            ]
        ]);
    }

}

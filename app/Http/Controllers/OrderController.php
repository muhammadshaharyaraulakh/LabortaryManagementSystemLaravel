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
                        'discount' => ['Discount cannot be greater than the subtotal amount.']
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
        $order = Order::withTrashed()->with('tests')->where('trackingId', $trackingId)->firstOrFail();

        return response()->json([
            'status' => 'success',
            'message' => 'Orders Fetched',
            'orders' => $order
        ]);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return response()->json([
                'status' => 400,
                'message' => 'Order ID is required'
            ], 400);
        }

        $order = Order::findOrFail($id);

        try {
            DB::beginTransaction();

            if (app()->environment('local')) {
                Http::fake([
                    'api.fia.gov.pk/*' => Http::response([
                        'status' => 'success',
                        'message' => 'Receipt voided successfully'
                    ], 200)
                ]);
            }

            $fiaResponse = Http::timeout(10)->post('https://api.fia.gov.pk/tax/void', [
                'tracking_id' => $order->trackingId,
                'receipt_number' => $order->fiaReceiptNo,
                'lab_id' => env('FIA_LAB_KEY', 'TEST_KEY_123'),
                'reason' => 'Patient cancelled order'
            ]);

            if (!$fiaResponse->successful()) {
                DB::rollBack();
                return response()->json([
                    'status' => 400,
                    'message' => 'Failed to cancel tax receipt with FIA API.'
                ], 400);
            }

            $order->delete();

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Order deleted and FIA tax receipt cancelled successfully.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOrders()
    {

        $orders = Order::with('tests')
            ->where('created_at', '>=', Carbon::now()->subHour())
            ->orderBy('created_at', 'desc')
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
        $order = Order::withTrashed()
            ->with('tests')
            ->where('trackingId', $search)
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

        $deletedOrders = Order::onlyTrashed()
            ->where('userId', Auth::id())
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

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
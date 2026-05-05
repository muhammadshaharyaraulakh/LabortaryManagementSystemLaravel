<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Test;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use \Barryvdh\DomPDF\Facade\Pdf;
use \Symfony\Component\HttpFoundation\Response;
use Milon\Barcode\Facades\DNS1DFacade;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function CreateOrder(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "max:255"],
            "phone" => ["required", "regex:/^[0-9]{11}$/"],
            "email" => ["required", "email"],
            "age" => ["required", "integer", "min:0", "max:70"],
            "gender" => ["required", "in:Male,Female,Other"],
            "discount" => ["nullable", "numeric", "min:0"],
            "tests" => ["required", "array", "min:1"],
            "tests.*" => ["exists:tests,id"]
        ]);

        try {
            DB::beginTransaction();

            $tests = Test::whereIn('id', $validated['tests'])->get();
            $subtotal = $tests->sum('price');
            $discount = $validated['discount'] ?? 0;

            if ($discount > $subtotal) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'discount' => ['Discount cannot be greater than the subtotal amount.']
                    ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $afterDiscount = $subtotal - $discount;
            $tax = $afterDiscount * 0.05;
            $grandTotal = $afterDiscount + $tax;
            $trackingId = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(4));

            if (app()->environment('local')) {
                Http::fake([
                    'api.fia.gov.pk/*' => Http::response([
                        'status' => 'success',
                        'receipt_number' => 'FIA-TEST-' . uniqid() . rand(100000, 999999)
                    ], Response::HTTP_OK)
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

            $BarcodeData = [];

            foreach ($tests as $test) {
                $vialBarcode = 'VIAL-' . $trackingId . '-' . $test->id . '-' . rand(1000, 9999);
                $order->tests()->attach($test->id, [
                    'status' => 'Created',
                    'priceAtOrder' => $test->price,
                    'vialBarcode' => $vialBarcode
                ]);
                $BarcodeData[] = [
                    'TestName' => $test->name,
                    'VialBarcode' => $vialBarcode
                ];
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Order created successfully!',
                'tracking_id' => $trackingId,
                'barcodeData' => $BarcodeData
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showSummary($trackingId)
    {
        if (empty($trackingId)) {
            return response()->json([
                'status' => false,
                'message' => 'Order ID is required',
            ], Response::HTTP_BAD_REQUEST);
        }
        $order = Order::withTrashed()->with('tests')->where('trackingId', $trackingId)->firstOrFail();
        foreach ($order->tests as $test) {
            $barcodeString = $test->pivot->vialBarcode;
            $test->backend_barcode = DNS1DFacade::getBarcodeSVG($barcodeString, 'C128', 1, 25, 'black');
        }

        return response()->json([
            'status' => true,
            'message' => 'Orders Fetched',
            'orders' => $order
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return response()->json([
                'status' => false,
                'message' => 'Order ID is required'
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = Order::findOrFail($id);

        try {
            DB::beginTransaction();
            if (
                $order->tests->contains(fn($test) => $test->pivot->status !== 'Created') ||
                $order->userId !== auth()->id() ||
                $order->created_at < now()->subHour()
            ) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Order is already in progress, older than 1 hour, or you are not authorized to delete this order.'
                ], Response::HTTP_BAD_REQUEST);
            }

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
                    'status' => false,
                    'message' => 'Failed to cancel tax receipt with FIA API.'
                ], Response::HTTP_BAD_REQUEST);
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
                'status' => false,
                'message' => 'Failed to delete order',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOrders()
    {

        $orders = Order::with('tests')
            ->where('created_at', '>=', Carbon::now()->subHour())
            ->where('userId', auth()->user()->id)
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
                'status' => false,
                'message' => 'Search parameter is required'
            ], Response::HTTP_BAD_REQUEST);
        }
        $order = Order::withTrashed()
            ->with('tests')
            ->where('trackingId', $search)
            ->where('userId', auth()->user()->id)
            ->first();

        if (empty($order)) {
            return response()->json([
                'status' => true,
                'message' => 'No order found with this Tracking ID.',
                $order => []
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Order found',
            'orders' => [$order]
        ], Response::HTTP_OK);
    }

    public function PublicTrackReport($trackingId)
    {
        if (empty($trackingId)) {
            return response()->json([
                'status' => false,
                'message' => 'Tracking ID is required'
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = Order::with('tests')->where('trackingId', $trackingId)->first();

        if (empty($order)) {
            return response()->json([
                'status' => false,
                'message' => 'No record found with this Tracking ID.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Order found',
            'orders' => [$order]
        ], Response::HTTP_OK);
    }
    public function downloadReceiptPdf($trackingId)
    {
        $order = Order::with('tests')->where('trackingId', $trackingId)->firstOrFail();
        foreach ($order->tests as $test) {
            $barcodeString = $test->pivot->vialBarcode;
            $test->backend_barcode = \DNS1D::getBarcodePNG($barcodeString, 'C128', 1, 25, [0, 0, 0]);
        }
        $pdf = Pdf::loadView('ReceiptPdf', compact('order'));
        return $pdf->download("Receipt-{$trackingId}.pdf");
    }

    public function downloadReport($trackingId, $testId)
    {
        $order = Order::with([
            'tests' => function ($query) use ($testId) {
                $query->where('tests.id', $testId);
            }
        ])->where('trackingId', $trackingId)->firstOrFail();

        $test = $order->tests->first();

        if (!$test || $test->pivot->status !== 'Completed') {
            abort(404, 'Report not ready or not found.');
        }

        $results = Result::where('orderTestId', $test->pivot->id)
            ->with('parameter')
            ->get();



        $pdf = Pdf::loadView('TestReport', compact('order', 'test', 'results'));

        return $pdf->download("Report-{$trackingId}-{$test->name}.pdf");
    }
}
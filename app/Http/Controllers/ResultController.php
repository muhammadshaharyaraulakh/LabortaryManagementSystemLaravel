<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Test;
use App\Models\TestParameter;
use App\Events\SampleRejected;



class ResultController extends Controller
{
    public function addResult(Request $request)
    {
        $request->validate([
            'orderTestId' => 'required|exists:order_test,id',
            'trackingId' => 'required|string',
            'remarks' => 'nullable|string',
            'attachmentPaths' => 'nullable|array',
            'results' => 'nullable|array',
            'results.*.testParameterId' => 'nullable|exists:test_parameters,id',
            'results.*.resultValue' => 'nullable',
            'results.*.statusFlag' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $orderTest = DB::table('order_test')->where('id', $request->orderTestId)->first();

            if (!empty($request->results)) {
                foreach ($request->results as $res) {
                    Result::create([
                        'orderTestId' => $request->orderTestId,
                        'testParameterId' => $res['testParameterId'] ?? null,
                        'trackingId' => $request->trackingId,
                        'resultValue' => $res['resultValue'] ?? null,
                        'statusFlag' => $res['statusFlag'] ?? null,
                        'attachmentPaths' => isset($request->attachmentPaths) ? json_encode($request->attachmentPaths) : null,
                        'remarks' => $request->remarks ?? null,
                    ]);
                }
            } else {
                Result::create([
                    'orderTestId' => $request->orderTestId,
                    'trackingId' => $request->trackingId,
                    'attachmentPaths' => isset($request->attachmentPaths) ? json_encode($request->attachmentPaths) : null,
                    'remarks' => $request->remarks ?? null,
                ]);
            }

            $requirements = DB::table('test_requirements')->where('testId', $orderTest->testId)->get();

            foreach ($requirements as $requirement) {
                $inventory = Inventory::where('id', $requirement->inventoryId)->lockForUpdate()->first();

                if ($inventory) {
                    $inventory->current_stock = $inventory->current_stock - $requirement->quantityUsed;
                    $inventory->save();
                    InventoryLog::create([
                        'inventory_id' => $requirement->inventoryId,
                        'type' => 'Out',
                        'quantity' => $requirement->quantityUsed,
                        'action' => 'Test Conducted (OrderTestID: ' . $request->orderTestId . ')',
                        'created_by' => Auth::id()
                    ]);
                }
            }
            DB::table('order_test')
                ->where('id', $request->orderTestId)
                ->update([
                    'status' => 'Unverified'
                ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Results saved successfully and sent for Verification.',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getPendingResultList()
    {
        $user = Auth::user();
        $orders = Order::whereHas('tests', function ($query) use ($user) {
            $query->where('tests.departmentId', $user->department_id)
                ->where('order_test.status', 'Unverified');
        })->with([
                    'tests' => function ($query) use ($user) {
                        $query->where('tests.departmentId', $user->department_id)
                            ->where('order_test.status', 'Unverified');
                    }
                ])->get();

        return response()->json([
            'status' => true,
            'message' => 'Pending Results Fetched Successfully',
            'data' => $orders
        ], Response::HTTP_OK);
    }

    public function getResultsByOrderTestId($id)
    {
        $results = Result::where('orderTestId', $id)
            ->with(['parameter' => function ($query) {
                $query->withTrashed();
            }])
            ->get();

        $orderTest = DB::table('order_test')->where('id', $id)->first();
        if ($orderTest) {
            $testParameters = TestParameter::withTrashed()->where('testId', $orderTest->testId)->get();
            if ($testParameters->count() > 0) {
                foreach ($results as $index => $res) {
                    if (!$res->parameter && isset($testParameters[$index])) {
                        $res->setRelation('parameter', $testParameters[$index]);
                    }
                }
            }
        }

        return response()->json([
            'status' => 200,
            'data' => $results
        ]);
    }

    public function verifyResult(Request $request)
    {
        $request->validate([
            'orderTestId' => 'required|exists:order_test,id',
            'orderId' => 'required|exists:orders,id',
            'results' => 'required|array',
            'results.*.id' => 'required|exists:results,id',
            'results.*.resultValue' => 'required',
            'results.*.statusFlag' => 'nullable|string',
            'remarks' => 'nullable|string',
            'alertPatient' => 'boolean'
        ]);

        $user = Auth::user();

        if (!$user->signature) {
            return response()->json([
                'status' => 400,
                'message' => 'Please upload your signature in settings before verifying results.'
            ], 400);
        }

        DB::beginTransaction();

        try {

            foreach ($request->results as $res) {
                Result::where('id', $res['id'])->update([
                    'resultValue' => $res['resultValue'],
                    'statusFlag' => $res['statusFlag'] ?? 'Normal',
                    'remarks' => $request->remarks,
                    'signatureImagePath' => $user->signature,
                    'alertPatient' => $request->alertPatient ?? false,
                    'verifiedBy' => $user->name,
                ]);
            }

            DB::table('order_test')
                ->where('id', $request->orderTestId)
                ->update(['status' => 'Completed']);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Test verified successfully.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'Failed to verify results.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCompletedReports(Request $request)
    {
        $user = Auth::user();

        $completedReports = Order::whereHas('tests', function ($query) use ($user) {
            $query->where('tests.departmentId', $user->department_id)
                ->where('order_test.status', 'Completed')
                ->whereDate('order_test.updated_at', today());
        })->get();
        return response()->json([
            'status' => true,
            'message' => 'Completed Reports Fetched Successfully',
            'data' => $completedReports
        ], Response::HTTP_OK);
    }

    public function rejectSample(Request $request)
    {
        $request->validate([
            'orderTestId' => 'nullable|exists:order_test,id',
            'barcode' => 'nullable|string',
            'reason' => 'required|string'
        ]);

        if (!$request->orderTestId && !$request->barcode) {
            return response()->json(['status' => 400, 'message' => 'Provide orderTestId or barcode.']);
        }

        $query = DB::table('order_test');
        if ($request->orderTestId) {
            $query->where('id', $request->orderTestId);
        } else {
            $query->where('vialBarcode', $request->barcode);
        }
        
        $orderTest = $query->first();

        if (!$orderTest) {
            return response()->json(['status' => 404, 'message' => 'Order test not found.']);
        }

        DB::table('order_test')
            ->where('id', $orderTest->id)
            ->update([
                'status' => 'Rejected',
                'rejectionReason' => $request->reason,
                'rejectedBy' => Auth::user()->name
            ]);

        $orderTest = DB::table('order_test')->where('id', $orderTest->id)->first();

        $collector = User::find($orderTest->collectedBy);

        $test = Test::find($orderTest->testId);

        if ($collector && $test) {
            Log::info('Broadcasting SampleRejected event', [
                'orderTestId' => $orderTest->id,
                'collector' => $collector->name,
                'test' => $test->name
            ]);
            broadcast(new SampleRejected(
                $orderTest,
                $collector,
                $test
            ));
        }


        return response()->json([
            'status' => 200,
            'message' => 'Sample rejected successfully.'
        ]);
    }

}
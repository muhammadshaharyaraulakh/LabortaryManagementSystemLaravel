<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Inventory;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function addResult(Request $request)
    {
        $request->validate([
            'orderTestId' => 'required|exists:order_test,id',
            'trackingId' => 'required|string',
            'remarks' => 'nullable|string',
            'attachmentPaths' => 'nullable|array',
            'results' => 'required|array',
            'results.*.testParameterId' => 'nullable|exists:test_parameters,id',
            'results.*.resultValue' => 'nullable',
            'results.*.statusFlag' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $orderTest = DB::table('order_test')->where('id', $request->orderTestId)->first();
            foreach ($request->results as $res) {
                Result::create([
                    'orderTestId' => $request->orderTestId,
                    'testParameterId' => $res['testParameterId'] ?? null,
                    'trackingId' => $request->trackingId,
                    'resultValue' => $res['resultValue'] ?? null,
                    'statusFlag' => $res['statusFlag'] ?? null,
                    'attachmentPaths' => $request->attachmentPaths ?? null,
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
}
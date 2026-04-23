<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Test;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    public function getDashboardStats()
    {
        $user = Auth::user();
        $departmentId = $user->department_id;

        $samplesToReceive = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $departmentId)
            ->where('order_test.status', 'Collected')
            ->count();

        $testsInProgress = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $departmentId)
            ->where('order_test.status', 'InProgress')
            ->where('order_test.testedBy', $user->id)
            ->count();

        $pendingVerification = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $departmentId)
            ->where('order_test.status', 'Completed')
            ->where('order_test.testedBy', $user->id)
            ->count();

        $completedToday = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $departmentId)
            ->where('order_test.status', 'Verified')
            ->whereDate('order_test.updated_at', Carbon::today())
            ->count();

        return response()->json([
            'samplesToReceive' => $samplesToReceive,
            'testsInProgress' => $testsInProgress,
            'pendingVerification' => $pendingVerification,
            'completedToday' => $completedToday
        ]);
    }

    public function Lock(Request $request)
    {
        $request->validate([
            'BarcodeNumber' => 'required|exists:order_test,vialBarcode',
        ]);

        $user = Auth::user();
        $userDepartmentId = $user->department_id;

        $order = Order::whereHas('tests', function ($query) use ($request, $userDepartmentId) {
            $query->where('order_test.vialBarcode', $request->BarcodeNumber)
                ->where('tests.departmentId', $userDepartmentId);
        })->with([
                    'tests' => function ($query) use ($request, $userDepartmentId) {
                        $query->where('order_test.vialBarcode', $request->BarcodeNumber)
                            ->where('tests.departmentId', $userDepartmentId)
                            ->with(['parameters', 'requirements']);
                    }
                ])->first();

        if (!$order) {
            return response()->json([
                'message' => 'Sample not found.',
                'status' => 403
            ], 403);
        }

        $test = $order->tests->first();

        if ($test->pivot->status === 'InProgress') {
            return response()->json([
                'message' => 'Sample is already in progress.',
                'status' => 200,
                'data' => $test
            ]);
        }

        if ($test->pivot->status !== 'Collected') {
            return response()->json([
                'message' => 'Sample cannot be received. Current status: ' . $test->pivot->status,
                'status' => 400
            ], 400);
        }

        $order->tests()->updateExistingPivot($test->id, [
            'status' => 'InProgress',
            'testedBy' => $user->id
        ]);

        $test = $order->tests()->where('order_test.vialBarcode', $request->BarcodeNumber)
            ->with(['parameters', 'requirements'])
            ->first();

        $collectedByUser = User::find($test->pivot->collectedBy);

        return response()->json([
            'message' => 'Sample received successfully. Moved to Active Worklist.',
            'status' => 200,
            'data' => [
                'test' => $test,
                'collectedBy_user' => $collectedByUser
            ]
        ]);
    }

    public function TechnicianWorklist()
    {
        $user = Auth::user();

        $orders = Order::whereHas('tests', function ($query) use ($user) {
            $query->where('tests.departmentId', $user->department_id)
                ->where('order_test.status', 'InProgress')
                ->where('order_test.testedBy', $user->id);
        })->with([
                    'tests' => function ($query) use ($user) {
                        $query->where('tests.departmentId', $user->department_id)
                            ->where('order_test.status', 'InProgress')
                            ->where('order_test.testedBy', $user->id)
                            ->with(['parameters', 'requirements']);
                    }
                ])->get();

        return response()->json([
            'status' => 200,
            'data' => $orders
        ]);
    }

}

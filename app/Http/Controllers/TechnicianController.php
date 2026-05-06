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
use Symfony\Component\HttpFoundation\Response;


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
            ->where('order_test.status', 'Unverified')
            ->where('order_test.testedBy', $user->id)
            ->count();

        $completedToday = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $departmentId)
            ->where('order_test.status', 'Completed')
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

        if (empty($user) || empty($userDepartmentId)) {
            return response()->json([
                'message' => 'User not found or department missing.',
                'status' => false,
            ], Response::HTTP_NOT_FOUND);
        }
        $order = Order::whereHas('tests', function ($query) use ($request, $userDepartmentId) {
            $query->where('order_test.vialBarcode', $request->BarcodeNumber)
                ->where('tests.departmentId', $userDepartmentId);
        })->first();

        if (empty($order)) {
            return response()->json([
                'message' => 'Order not found for this barcode and department.',
                'status' => false,
            ], Response::HTTP_NOT_FOUND);
        }

        $test = $order->tests()->where('order_test.vialBarcode', $request->BarcodeNumber)->first();

        if ($test->pivot->status !== 'Collected') {
            return response()->json([
                'message' => 'Sample cannot be received. Current status: ' . $test->pivot->status,
                'status' => false
            ], Response::HTTP_BAD_REQUEST);
        }
        $order->tests()->updateExistingPivot($test->id, [
            'status' => 'InProgress',
            'testedBy' => $user->id
        ]);

        $updatedTest = $order->tests()
            ->where('order_test.vialBarcode', $request->BarcodeNumber)
            ->with(['parameters', 'requirements'])
            ->first();
        $collectedByUser = User::find($updatedTest->pivot->collectedBy);

        return response()->json([
            'message' => 'Sample received successfully. Moved to Active Worklist.',
            'status' => true,
            'data' => [
                'test' => $updatedTest,
                'collectedBy_user' => $collectedByUser
            ]
        ], Response::HTTP_OK);
    }

    public function getSampleInfo(Request $request)
    {
        $request->validate([
            'BarcodeNumber' => 'required|exists:order_test,vialBarcode',
        ]);

        $user = Auth::user();
        $userDepartmentId = $user->department_id;

        $order = Order::whereHas('tests', function ($query) use ($request, $userDepartmentId) {
            $query->where('order_test.vialBarcode', $request->BarcodeNumber)
                ->where('tests.departmentId', $userDepartmentId);
        })->first();

        if (empty($order)) {
            return response()->json([
                'message' => 'Order not found for this barcode and department.',
                'status' => false,
            ], Response::HTTP_NOT_FOUND);
        }

        $test = $order->tests()->where('order_test.vialBarcode', $request->BarcodeNumber)->first();

        return response()->json([
            'status' => true,
            'data' => [
                'orderTestId' => $test->pivot->id,
                'patientName' => $order->name,
                'testName' => $test->name,
                'status' => $test->pivot->status,
                'sampleType' => $test->sampleType
            ]
        ]);
    }
    public function TechnicianWorklist()
    {
        $user = Auth::user();

        if (empty($user) || empty($user->department_id)) {
            return response()->json([
                'message' => 'User not found or department missing.',
                'status' => false,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $orders = Order::whereHas('tests', function ($query) use ($user) {
            $query->where('tests.departmentId', $user->department_id)
                ->where('order_test.status', 'InProgress')
                ->where('order_test.testedBy', $user->id);
        })
            ->with([
                'tests' => function ($query) use ($user) {
                    $query->where('tests.departmentId', $user->department_id)
                        ->where('order_test.status', 'InProgress')
                        ->where('order_test.testedBy', $user->id)
                        ->with(['parameters', 'requirements']);
                }
            ])
            ->get();
        return response()->json([
            'message' => 'Worklist retrieved successfully.',
            'status' => true,
            'data' => $orders
        ], Response::HTTP_OK);
    }
    public function getPendingVerificationList()
    {
        $user = Auth::user();

        if (empty($user) || empty($user->department_id)) {
            return response()->json([
                'message' => 'User not found or department missing.',
                'status' => false,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $orders = Order::whereHas('tests', function ($query) use ($user) {
            $query->where('tests.departmentId', $user->department_id)
                ->where('order_test.status', 'Unverified')
                ->where('order_test.testedBy', $user->id);
        })
            ->with([
                'tests' => function ($query) use ($user) {
                    $query->where('tests.departmentId', $user->department_id)
                        ->where('order_test.status', 'Unverified')
                        ->where('order_test.testedBy', $user->id);
                }
            ])
            ->get();

        return response()->json([
            'message' => 'Pending verification list retrieved successfully.',
            'status' => true,
            'data' => $orders
        ], Response::HTTP_OK);
    }

    public function getHumanDashboardStats()
    {
        $user = Auth::user();
        $department = $user->department;

        if (!$department || $department->type !== 'human_based') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized or invalid department type.'
            ], Response::HTTP_FORBIDDEN);
        }

        $pendingTests = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $department->id)
            ->where('order_test.status', 'Created')
            ->count();

        $testsInProgress = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $department->id)
            ->where('order_test.status', 'InProgress')
            ->where('order_test.testedBy', $user->id)
            ->count();

        $pendingVerification = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $department->id)
            ->where('order_test.status', 'Unverified')
            ->where('order_test.testedBy', $user->id)
            ->count();

        $completedToday = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->where('tests.departmentId', $department->id)
            ->where('order_test.status', 'Verified')
            ->whereDate('order_test.updated_at', Carbon::today())
            ->count();

        return response()->json([
            'status' => true,
            'message' => 'Dashboard stats retrieved successfully.',
            'data' => [
                'pendingTests' => $pendingTests,
                'testsInProgress' => $testsInProgress,
                'pendingVerification' => $pendingVerification,
                'completedToday' => $completedToday
            ]
        ], Response::HTTP_OK);
    }

    public function HumanTechnicianPendingWorklist()
    {
        $user = Auth::user();
        $department = $user->department;

        if (!$department || $department->type !== 'human_based') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized or invalid department type.'
            ], Response::HTTP_FORBIDDEN);
        }

        $orders = Order::whereHas('tests', function ($query) use ($department) {
            $query->where('tests.departmentId', $department->id)
                ->where('order_test.status', 'Created');
        })->with([
                    'tests' => function ($query) use ($department) {
                        $query->where('tests.departmentId', $department->id)
                            ->where('order_test.status', 'Created')
                            ->with(['parameters', 'requirements']);
                    }
                ])->get();

        return response()->json([
            'status' => true,
            'message' => 'Pending worklist retrieved successfully.',
            'data' => $orders
        ], Response::HTTP_OK);
    }

    public function StartHumanTest(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        $user = Auth::user();
        $department = $user->department;

        if (!$department || $department->type !== 'human_based') {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized or invalid department type.'
            ], Response::HTTP_FORBIDDEN);
        }

        $orderTest = DB::table('order_test')
            ->join('tests', 'order_test.testId', '=', 'tests.id')
            ->select('order_test.*')
            ->where('tests.departmentId', $department->id)
            ->where('order_test.vialBarcode', $request->barcode)
            ->first();

        if (!$orderTest) {
            return response()->json([
                'status' => false,
                'message' => 'Test not found for this barcode.'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($orderTest->status !== 'Created') {
            return response()->json([
                'status' => false,
                'message' => 'Test is not in Pending/Created state.'
            ], Response::HTTP_BAD_REQUEST);
        }

        DB::table('order_test')->where('id', $orderTest->id)->update([
            'status' => 'InProgress',
            'testedBy' => $user->id,
            'updated_at' => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Test started successfully. Moved to Active Worklist.'
        ], Response::HTTP_OK);
    }

    public function uploadHumanResultFile(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:10240', // max 10MB per file
        ]);

        if ($request->hasFile('files')) {
            $paths = [];
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . rand(1000, 9999) . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('results', $filename, 'public');
                $paths[] = '/storage/results/' . $filename;
            }

            return response()->json([
                'status' => true,
                'message' => 'Files uploaded successfully',
                'data' => [
                    'paths' => $paths
                ]
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => false,
            'message' => 'No files uploaded'
        ], Response::HTTP_BAD_REQUEST);
    }
    public function getOrderTestParameters($orderTestId)
    {
        if (empty($orderTestId)) {
            return response()->json([
                'status' => false,
                'message' => 'orderTestId is required.'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Get the order_test pivot row
        $orderTest = DB::table('order_test')->where('id', $orderTestId)->first();

        if (!$orderTest) {
            return response()->json([
                'status' => false,
                'message' => 'Order test not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        // Get the test with its parameters
        $test = Test::with('parameters')->find($orderTest->testId);

        if (!$test) {
            return response()->json([
                'status' => false,
                'message' => 'Test not found.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => true,
            'message' => 'Parameters fetched successfully.',
            'data' => [
                'orderTestId' => (int) $orderTestId,
                'testId' => $test->id,
                'testName' => $test->name,
                'parameters' => $test->parameters
            ]
        ], Response::HTTP_OK);
    }
}

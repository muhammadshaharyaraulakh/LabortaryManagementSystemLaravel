<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    // =========================
    // MONTHLY DETAILS
    // =========================
    public function fetchMonthlyDetails()
    {
        $orders = Order::withTrashed()
            ->with('tests')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No records found for this month',
                'data' => [
                    'activeOrders' => 0,
                    'completedTests' => 0,
                    'pendingTests' => 0,
                    'totalRevenue' => 0,
                    'totalTax' => 0,
                    'deletedOrders' => 0,
                ],
            ], Response::HTTP_OK);
        }

        $activeOrders = $orders->whereNull('deleted_at');
        $deletedOrders = $orders->whereNotNull('deleted_at');

        $allTests = $activeOrders->flatMap(function ($order) {
            return $order->tests;
        });

        $completedTests = $allTests->where('pivot.status', 'Completed');
        $pendingTests = $allTests->where('pivot.status', '!=', 'Completed');

        return response()->json([
            'success' => true,
            'message' => 'Monthly statistics retrieved successfully',
            'data' => [
                'activeOrders' => $activeOrders->count(),
                'completedTests' => $completedTests->count(),
                'pendingTests' => $pendingTests->count(),
                'totalRevenue' => $activeOrders->sum('grandTotal'),
                'totalTax' => $activeOrders->sum('tax'),
                'deletedOrders' => $deletedOrders->count(),
            ]
        ], Response::HTTP_OK);
    }

    // =========================
    // DATE RANGE SEARCH
    // =========================
    public function Search(Request $request)
    {
        $validation = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $startDate = Carbon::parse($validation['startDate'])->startOfDay();
        $endDate = Carbon::parse($validation['endDate'])->endOfDay();

        $orders = Order::withTrashed()
            ->with('tests')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No records found for given range',
                'data' => [
                    'activeOrders' => 0,
                    'completedTests' => 0,
                    'pendingTests' => 0,
                    'totalRevenue' => 0,
                    'totalTax' => 0,
                    'deletedOrders' => 0,
                ],
            ], Response::HTTP_OK);
        }

        $activeOrders = $orders->whereNull('deleted_at');
        $deletedOrders = $orders->whereNotNull('deleted_at');

        $allTests = $activeOrders->flatMap(fn($order) => $order->tests);

        $completedTests = $allTests->where('pivot.status', 'Completed');
        $pendingTests = $allTests->where('pivot.status', '!=', 'Completed');

        return response()->json([
            'success' => true,
            'message' => 'Statistics calculated successfully',
            'data' => [
                'activeOrders' => $activeOrders->count(),
                'completedTests' => $completedTests->count(),
                'pendingTests' => $pendingTests->count(),
                'totalRevenue' => $activeOrders->sum('grandTotal'),
                'totalTax' => $activeOrders->sum('tax'),
                'deletedOrders' => $deletedOrders->count(),
            ]
        ], Response::HTTP_OK);
    }
    // =========================
    // DAILY  STATS FOR RECEPTIONIST
    // =========================
    public function fetchDailyStats()
    {
        $orders = Order::withTrashed()
            ->whereDate('created_at', today())
            ->where('userId', auth()->id())
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No records found for today',
                'data' => [
                    'orderCreatedToday' => 0,
                    'moneyCollectedToday' => 0,
                    'deletedOrders' => 0
                ],
            ], Response::HTTP_OK);
        }

        $activeOrders = $orders->whereNull('deleted_at');
        $deletedOrders = $orders->whereNotNull('deleted_at');

        return response()->json([
            'success' => true,
            'message' => 'Statistics calculated successfully',
            'data' => [
                'orderCreatedToday' => $orders->count(),
                'moneyCollectedToday' => $activeOrders->sum('grandTotal'),
                'deletedOrders' => $deletedOrders->count(),
            ]
        ], Response::HTTP_OK);
    }
    // =========================
    // DATE RANGE SEARCH FOR RECEPTIONIST
    // =========================
    public function SearchForReceptionist(Request $request)
    {
        $validation = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $startDate = Carbon::parse($validation['startDate'])->startOfDay();
        $endDate = Carbon::parse($validation['endDate'])->endOfDay();

        $orders = Order::withTrashed()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('userId', auth()->id())
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No records found for given range',
                'data' => [
                    'orderCreated' => 0,
                    'moneyCollected' => 0,
                    'deletedOrders' => 0,
                ],
            ], Response::HTTP_OK);
        }

        $activeOrders = $orders->whereNull('deleted_at');
        $deletedOrders = $orders->whereNotNull('deleted_at');

        return response()->json([
            'success' => true,
            'message' => 'Statistics calculated successfully',
            'data' => [
                'orderCreated' => $orders->count(),
                'moneyCollected' => $activeOrders->sum('grandTotal'),
                'deletedOrders' => $deletedOrders->count(),
            ]
        ], Response::HTTP_OK);
    }

}

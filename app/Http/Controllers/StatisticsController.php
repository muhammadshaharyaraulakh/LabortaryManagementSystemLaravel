<?php

namespace App\Http\Controllers;

use Hamcrest\Core\IsNot;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Department;
use App\Models\User;
use App\Models\TestParameter;
use App\Models\TestRequirement;
use App\Models\Order;
use Carbon\Carbon;
use function PHPUnit\Framework\assertNotEmpty;
class StatisticsController extends Controller
{
    public function fetchMonthlyDetails()
    {
        $monthOrders = Order::withTrashed()
            ->with('tests')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        if ($monthOrders->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No data']);
        }

        $active = $monthOrders->whereNull('deleted_at');
        $allTests = $active->flatMap(fn($o) => $o->tests);

        return response()->json([
            'status' => 200,
            'data' => [
                'activeOrders' => $active->count(),
                'completedTests' => $allTests->where('pivot.status', 'completed')->count(),
                'pendingTests' => $allTests->where('pivot.status', '!==', 'completed')->count(),
                'totalRevenue' => $active->sum('grandTotal'),
                'totalTax' => $active->sum('tax'),
                'deletedOrders' => $monthOrders->whereNotNull('deleted_at')->count(),
            ]
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

        $allFetched = Order::withTrashed()->with('tests')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
        $activeOrders = $allFetched->whereNull('deleted_at');
        $deletedOrders = $allFetched->whereNotNull('deleted_at');
        $allActiveTests = $activeOrders->flatMap(function (Order $order) {
            return $order->tests;
        });
        $completedTests = $allActiveTests->filter(function ($test) {
            return $test->pivot->status === 'completed';
        });
        $pendingTests = $allActiveTests->filter(function ($test) {
            return $test->pivot->status !== 'completed';
        });
        return response()->json([
            'status' => 200,
            'message' => 'Statistics calculated successfully',
            'data' => [
                'activeOrders' => $activeOrders->count(),
                'completedTests' => $completedTests->count(),
                'pendingTests' => $pendingTests->count(),
                'totalRevenue' => $activeOrders->sum('grandTotal'),
                'totalTax' => $activeOrders->sum('tax'),
                'deletedOrders' => $deletedOrders->count(),
            ]
        ]);
    }
}

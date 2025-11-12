<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function dashboard()
    {
        $userId     = Auth::id();
        $orderCount = Order::where('user_id', $userId)->count();

        // Pending order
        $pendingOrderCount = Order::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        // Received Order
        $receivedOrderCount = Order::where('user_id', $userId)
            ->where('status', 'received')
            ->count();

        // Completed Order
        $completedOrderCount = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        // cancelled Order
        $cancelledOrderCount = Order::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->count();

        // Total amount sum
        $totalAmount = Order::where('user_id', $userId)->sum('total_amount');

        // 4) Recent orders with pagination (3 per page)
        $recentOrders = Order::where('user_id', $userId)
            ->latest()
            ->paginate(3);

        // Current month orders
        $currentMonthOrders = Order::where('user_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Previous month orders
        $previousMonthOrders = Order::where('user_id', $userId)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        // Percentage Change Calculation
        if ($previousMonthOrders > 0) {
            $percentageChange = (($currentMonthOrders - $previousMonthOrders) / $previousMonthOrders) * 100;
        } else {
            $percentageChange = $currentMonthOrders > 0 ? 100 : 0; // যদি আগের মাসে কোনো order না থাকে
        }

        $percentageChange = round($percentageChange, 2); // 2 decimal

        return view('website.customer.dashboard', compact('orderCount', 'percentageChange', 'pendingOrderCount', 'totalAmount', 'recentOrders', 'receivedOrderCount', 'completedOrderCount', 'cancelledOrderCount'));
    }

    public function invoiceShow($id)
    {
        $order = Order::with(['items'])->findOrFail($id);

        // return a blade partial (HTML fragment) for modal body
        return view('website.customer.dashboard', compact('order'));
    }

}

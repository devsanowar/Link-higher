<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Visitor;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $totalOrderCount  = Order::count();
        $pendingOrders    = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'received')->count();
        $deliveredOrders  = Order::where('status', 'completed')->count();

        $totalUsers   = User::where('system_admin', 'customer')->count();
        $totalRevenue = Order::sum('total_amount'); // change column if needed

        $todayOrders = Order::whereDate('created_at', today())->count();

        $revenueRate    = $totalRevenue > 0 ? ($totalRevenue / 100000) * 100 : 0;
        $orderRate      = $totalOrderCount > 0 ? ($totalOrderCount / 1000) * 100 : 0;
        $userRate       = $totalUsers > 0 ? ($totalUsers / 1000) * 100 : 0;
        $todayOrderRate = $todayOrders > 0 ? ($todayOrders / 100) * 100 : 0;

        // Calculate percentages for knob
        $deliveryRate   = $totalOrderCount > 0 ? ($deliveredOrders / $totalOrderCount) * 100 : 0;
        $pendingRate    = $totalOrderCount > 0 ? ($pendingOrders / $totalOrderCount) * 100 : 0;
        $processingRate = $totalOrderCount > 0 ? ($processingOrders / $totalOrderCount) * 100 : 0;

        // Annual Revenue (sum of total)
        $annualRevenue = Order::whereYear('created_at', date('Y'))
            ->sum('total_amount');

        // Annual Sales (count)
        $annualSales = Order::whereYear('created_at', date('Y'))
            ->count();

        // Annual Profit (example 20% profit margin)
        $annualProfit = $annualRevenue * 0.20;

        // Monthly report for Area Chart
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_amount')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total_amount', 'month');

        // Ensure all 12 months exist
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlySales[$i] ?? 0;
        }

        // === This Week Orders ===
        $thisWeekOrders = Order::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ])->count();

        // === This Month Orders ===
        $thisMonthOrders = Order::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        // === Average per Month (Last 6 Months) ===
        $averageOrders = Order::where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('COUNT(*) / 6 as avg_order')
            ->value('avg_order');

        // Country wise total visitors (current year)
        $visitorStats = Visitor::selectRaw('country,
            COUNT(*) as total_2025,
            SUM(CASE WHEN YEAR(created_at) = YEAR(CURRENT_DATE) - 1 THEN 1 ELSE 0 END) as total_2024
        ')
            ->groupBy('country')
            ->orderByDesc('total_2025')
            ->get();

        // Map data for vector map
        $mapData = Visitor::selectRaw('country, COUNT(*) as total')
            ->groupBy('country')
            ->pluck('total', 'country');

        return view("admin.dashboard", compact(
            "totalOrderCount",
            "pendingOrders",
            "processingOrders",
            "deliveredOrders",
            "deliveryRate",
            "pendingRate",
            "processingRate",
            "totalOrderCount",
            "totalUsers",
            "totalRevenue",
            "todayOrders",
            "revenueRate",
            "orderRate",
            "userRate",
            "todayOrderRate",
            "annualSales",
            "annualRevenue",
            "annualProfit",
            "chartData",
            'thisWeekOrders',
            'thisMonthOrders',
            'averageOrders',
            'visitorStats',
            'mapData'
        ));
    }

}

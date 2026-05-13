<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $monthlySales = Order::selectRaw("DATE_FORMAT(placed_at, '%b %Y') as month_label, SUM(total_amount) as total_sales")
            ->whereNotNull('placed_at')
            ->groupByRaw("YEAR(placed_at), MONTH(placed_at), DATE_FORMAT(placed_at, '%b %Y')")
            ->orderByRaw('YEAR(placed_at), MONTH(placed_at)')
            ->take(6)
            ->get();

        $statusBreakdown = Order::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.dashboard', [
            'stats' => [
                'customers' => User::where('role', 'customer')->count(),
                'admins' => User::where('role', 'admin')->count(),
                'categories' => Category::count(),
                'products' => Product::count(),
                'orders' => Order::count(),
                'sales' => Order::sum('total_amount'),
                'messages' => ContactMessage::count(),
            ],
            'recentOrders' => Order::with('user')->latest('placed_at')->take(8)->get(),
            'lowStockProducts' => Product::with('category')->where('stock', '<=', 10)->orderBy('stock')->take(6)->get(),
            'monthlySales' => $monthlySales,
            'statusBreakdown' => $statusBreakdown,
            'topProducts' => OrderItem::select('product_name', DB::raw('SUM(quantity) as units_sold'), DB::raw('SUM(line_total) as revenue'))
                ->groupBy('product_name')
                ->orderByDesc('units_sold')
                ->take(5)
                ->get(),
            'topCustomers' => User::where('role', 'customer')
                ->withCount('orders')
                ->withSum('orders', 'total_amount')
                ->orderByDesc('orders_sum_total_amount')
                ->take(5)
                ->get(),
            'quickActions' => [
                ['label' => 'Add Product', 'route' => route('admin.products.create')],
                ['label' => 'Manage Products', 'route' => route('admin.products.index')],
                ['label' => 'Add Admin User', 'route' => route('admin.admins.create')],
                ['label' => 'Customer Records', 'route' => route('admin.customers.index')],
            ],
        ]);
    }
}

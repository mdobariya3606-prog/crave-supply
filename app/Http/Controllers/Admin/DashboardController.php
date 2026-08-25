<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $this->admin($request);

        return view('admin.dashboard', [
            'orderCount' => Order::count(),
            'currentOrderCount' => Order::whereIn('status', ['order_received', 'processing', 'ready', 'out_for_delivery'])->count(),
            'completedOrderCount' => Order::where('status', 'delivered')->count(),
            'customerCount' => User::where('role', 'customer')->count(),
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'recentOrders' => Order::with('user')->latest()->take(8)->get(),
            'lowStockProducts' => Product::where('stock', '<=', 10)->orderBy('stock')->take(6)->get(),
        ]);
    }

    private function admin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}

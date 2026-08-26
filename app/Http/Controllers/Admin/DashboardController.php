<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard', [
            'orderCount' => Order::count(),
            'receivedOrderCount' => Order::where('status', 'order_received')->count(),
            'currentOrderCount' => Order::whereIn('status', ['order_received', 'processing', 'ready', 'out_for_delivery'])->count(),
            'completedOrderCount' => Order::where('status', 'delivered')->count(),
            'customerCount' => User::where('role', 'customer')->count(),
            'productCount' => Product::count(),
            'categoryCount' => Category::count(),
            'unreadMessageCount' => ContactMessage::where('is_read', false)->count(),
            'recentOrders' => Order::with('user')->latest()->take(8)->get(),
            'lowStockProducts' => Product::where('stock', '<=', 10)->orderBy('stock')->take(6)->get(),
        ]);
    }
}

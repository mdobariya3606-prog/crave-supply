<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $status = $request->query('status');

        $orders = Order::with(['user', 'orderItems', 'orderStatusHistories.user'])
            ->when($status && in_array($status, array_column(OrderStatus::cases(), 'value'), true), fn($query) => $query->where('status', $status))
            ->when($search, fn($query) => $query->where(fn($query) => $query
                ->where('order_number', 'like', "%{$search}%")
                ->orWhereHas('user', fn($query) => $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => OrderStatus::cases(),
            'search' => $search,
            'selectedStatus' => $status,
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $currentStatus = $order->status;
        $allowedStatuses = array_map(
            fn(OrderStatus $status) => $status->value,
            [$currentStatus, ...$currentStatus->nextStatuses()]
        );

        $validated = $request->validate([
            'status' => ['required', Rule::enum(OrderStatus::class), Rule::in($allowedStatuses)],
        ], [
            'status.in' => 'This order can only move to its next valid status.',
        ]);

        if ($currentStatus->value !== $validated['status']) {
            DB::transaction(function () use ($request, $order, $validated) {
                $lockedOrder = Order::with('orderItems')->lockForUpdate()->findOrFail($order->id);

                if ($validated['status'] === OrderStatus::CANCELLED->value) {
                    foreach ($lockedOrder->orderItems as $item) {
                        Product::whereKey($item->product_id)->increment('stock', $item->quantity);
                    }
                }

                $lockedOrder->update(['status' => $validated['status']]);
                $lockedOrder->orderStatusHistories()->create([
                    'status' => $validated['status'],
                    'changed_by' => $request->user()->id,
                ]);
            });
        }

        return back()->with('success', 'Order status updated.');
    }
}

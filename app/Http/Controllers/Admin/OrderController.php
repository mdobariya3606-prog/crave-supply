<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $this->admin($request);

        return view('admin.orders.index', [
            'orders' => Order::with(['user', 'orderItems', 'orderStatusHistories.user'])->latest()->paginate(20),
            'statuses' => OrderStatus::cases(),
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $this->admin($request);
        $currentStatus = $order->status;
        $allowedStatuses = array_map(
            fn (OrderStatus $status) => $status->value,
            [$currentStatus, ...$currentStatus->nextStatuses()]
        );

        $validated = $request->validate([
            'status' => ['required', Rule::enum(OrderStatus::class), Rule::in($allowedStatuses)],
        ], [
            'status.in' => 'This order can only move to its next valid status.',
        ]);

        if ($currentStatus->value !== $validated['status']) {
            $order->update(['status' => $validated['status']]);
            $order->orderStatusHistories()->create([
                'status' => $validated['status'],
                'changed_by' => $request->user()->id,
            ]);
        }

        return back()->with('success', 'Order status updated.');
    }

    private function admin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}

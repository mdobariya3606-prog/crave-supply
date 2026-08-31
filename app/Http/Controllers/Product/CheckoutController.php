<?php

namespace App\Http\Controllers\Product;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function orders(Request $request)
    {
        $this->customer($request);

        $orders = Order::where('user_id', $request->user()->id)
            ->with('orderItems')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function review(Request $request)
    {
        $this->customer($request);
        [$items, $subtotal] = $this->cartItems($request);

        if (empty($items)) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Your cart is empty.']);
        }

        return view('product.review-order', [
            'items' => $items,
            'subtotal' => $subtotal,
            'delivery' => $subtotal >= 2000 ? 0 : 100,
        ]);
    }

    public function submit(Request $request)
    {
        $this->customer($request);
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->withErrors(['cart' => 'Your cart is empty.']);
        }

        $order = DB::transaction(function () use ($request, $cart) {
            $products = Product::whereIn('id', array_keys($cart))->lockForUpdate()->get()->keyBy('id');
            $items = [];
            $subtotal = 0;

            foreach ($cart as $productId => $cartItem) {
                $product = $products->get($productId);
                $quantity = (int) ($cartItem['quantity'] ?? 0);

                if (!$product || !$product->is_available || $quantity < 1 || $product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'cart' => 'One or more products are no longer available in the requested quantity.',
                    ]);
                }

                $unitPrice = array_key_exists('price', $cartItem)
                    ? (float) $cartItem['price']
                    : (float) $product->price;
                $subtotal += $unitPrice * $quantity;
                $items[] = compact('product', 'quantity', 'unitPrice');
            }

            $order = Order::create([
                'order_number' => $this->uniqueOrderNumber(),
                'user_id' => $request->user()->id,
                'status' => OrderStatus::ORDER_RECEIVED,
                'total_amount' => $subtotal + ($subtotal >= 2000 ? 0 : 100),
            ]);

            foreach ($items as $item) {
                $order->orderItems()->create([
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unitPrice'],
                ]);
                $item['product']->decrement('stock', $item['quantity']);
            }

            $order->orderStatusHistories()->create([
                'status' => OrderStatus::ORDER_RECEIVED,
                'changed_by' => $request->user()->id,
            ]);

            return $order;
        });

        $request->session()->forget('cart');
        return redirect()->route('orders.confirmation', $order)->with('success', 'Your order was submitted successfully.');
    }

    public function confirmation(Request $request, Order $order)
    {
        abort_unless($request->user()->id === $order->user_id || $request->user()->role === 'admin', 403);
        $order->load(['orderItems', 'orderStatusHistories' => fn ($query) => $query->latest()]);

        return view('orders.confirmation', compact('order'));
    }

    public function bill(Request $request, Order $order)
    {
        abort_unless($request->user()->id === $order->user_id || $request->user()->role === 'admin', 403);
        $order->load(['user', 'orderItems']);

        return Pdf::loadView('orders.bill', compact('order'))
            ->setPaper('a4')
            ->download('cravesupply-' . $order->order_number . '-bill.pdf');
    }

    private function customer(Request $request): void
    {
        abort_unless($request->user()?->role === 'customer', 403);
    }

    private function uniqueOrderNumber(): string
    {
        do {
            // The unique database index remains the final safeguard; the existence
            // check avoids generating the same number during the same second.
            $orderNumber = 'CS-' . now()->format('ymdHis') . '-' . Str::upper(Str::random(10));
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    private function cartItems(Request $request): array
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::with('productImages')->whereIn('id', array_keys($cart))->get()->keyBy('id');
        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $cartItem) {
            $product = $products->get($productId);
            $quantity = (int) ($cartItem['quantity'] ?? 0);
            if (!$product || $quantity < 1) {
                continue;
            }

            $unitPrice = array_key_exists('price', $cartItem)
                ? (float) $cartItem['price']
                : (float) $product->price;
            $subtotal += $unitPrice * $quantity;
            $items[] = compact('product', 'quantity', 'unitPrice');
        }

        return [$items, $subtotal];
    }
}

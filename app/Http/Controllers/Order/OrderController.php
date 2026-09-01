<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, Product $product)
    {
        abort_unless(! $request->user() || $request->user()->role === 'customer', 403);
        if (! $product->is_available || $product->stock < 1) {
            return back()->withErrors([
                'quantity' => 'This product is currently unavailable or out of stock.',
            ], 'order');
        }

        $validated = $request->validateWithBag('order', [
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $existingQuantity = (int) data_get($request->session()->get('cart', []), $product->id.'.quantity', 0);
        $remainingStock = max(0, $product->stock - $existingQuantity);

        if ($validated['quantity'] > $remainingStock) {
            return back()->withErrors([
                'quantity' => 'You can order up to '.$remainingStock.' more of this product.',
            ], 'order');
        }

        $quantity = $validated['quantity'];
        $cart = $request->session()->get('cart', []);
        $cartPrice = array_key_exists('price', $cart[$product->id] ?? [])
            ? (float) $cart[$product->id]['price']
            : (float) $product->price;
        $cart[$product->id] = [
            'product_id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'price' => $cartPrice,
            'current_price' => (float) $product->price,
            'image_path' => $product->productImages()->value('image_path'),
            'quantity' => $existingQuantity + $quantity,
        ];
        $request->session()->put('cart', $cart);

        return back()->with('success', $product->name.' added to your order.');
    }
}

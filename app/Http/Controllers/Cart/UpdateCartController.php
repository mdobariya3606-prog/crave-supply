<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class UpdateCartController extends Controller
{
    private function canUseCart(Request $request): void
    {
        abort_unless(! $request->user() || $request->user()->role === 'customer', 403);
    }

    public function update(Request $request, Product $product)
    {
        $this->canUseCart($request);
        $validated = $request->validateWithBag('cart', [
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        if (! $product->is_available) {
            return response()->json(['message' => 'This product is currently unavailable.'], 422);
        } elseif (($product->stock < 1 || $validated['quantity'] > $product->stock)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Only '.max(0, $product->stock).' item(s) are available.'], 422);
            }

            return back()->withErrors(['quantity' => 'Only '.max(0, $product->stock).' item(s) are available.'], 'cart');
        }

        $cart = $request->session()->get('cart', []);
        if ($validated['quantity'] === 0) {
            unset($cart[$product->id]);
            $request->session()->put('cart', $cart);

            return $request->expectsJson()
                ? response()->json(['success' => true, 'quantity' => 0, 'cart_count' => collect($cart)->sum('quantity')])
                : back()->with('success', 'Cart updated.');
        }
        // Preserve the price captured when this item was added to the cart.
        $cartPrice = array_key_exists('price', $cart[$product->id] ?? [])
            ? (float) $cart[$product->id]['price']
            : (float) $product->price;
        $cart[$product->id] = array_merge($cart[$product->id] ?? [], [
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'price' => $cartPrice,
            'current_price' => (float) $product->price,
            'name' => $product->name,
            'slug' => $product->slug,
            'image_path' => $product->productImages()->value('image_path'),
        ]);
        $request->session()->put('cart', $cart);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'quantity' => $validated['quantity'], 'cart_count' => collect($cart)->sum('quantity')]);
        }

        return back()->with('success', 'Cart updated.');
    }
}

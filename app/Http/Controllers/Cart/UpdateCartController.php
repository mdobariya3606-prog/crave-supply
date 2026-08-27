<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class UpdateCartController extends Controller
{
    private function canUseCart(Request $request): void
    {
        abort_unless(!$request->user() || $request->user()->role === 'customer', 403);
    }
    
    public function update(Request $request, Product $product)
    {
        $this->canUseCart($request);
        $validated = $request->validateWithBag('cart', [
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if (!$product->is_available || $product->stock < 1 || $validated['quantity'] > $product->stock) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Only ' . max(0, $product->stock) . ' item(s) are available.'], 422);
            }
            return back()->withErrors(['quantity' => 'Only ' . max(0, $product->stock) . ' item(s) are available.'], 'cart');
        }

        $cart = $request->session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $validated['quantity'];
            $cart[$product->id]['price'] = (float) $product->price;
            $cart[$product->id]['current_price'] = (float) $product->price;
            $cart[$product->id]['name'] = $product->name;
            $cart[$product->id]['slug'] = $product->slug;
            $cart[$product->id]['image_path'] = $product->productImages()->value('image_path');
            $request->session()->put('cart', $cart);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'quantity' => $validated['quantity']]);
        }
        return back()->with('success', 'Cart updated.');
    }
}

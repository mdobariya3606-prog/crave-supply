<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DeleteCartController extends Controller
{
    public function remove(Request $request, Product $product)
    {
        $this->canUseCart($request);
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }

    public function clear(Request $request)
    {
        $this->canUseCart($request);
        $request->session()->forget('cart');

        return back()->with('success', 'Cart cleared.');
    }

    private function canUseCart(Request $request): void
    {
        abort_unless(! $request->user() || $request->user()->role === 'customer', 403);
    }
}

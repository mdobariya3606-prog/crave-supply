<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function canUseCart(Request $request): void
    {
        abort_unless(!$request->user() || $request->user()->role === 'customer', 403);
    }

    public function index(Request $request)
    {
        $this->canUseCart($request);
        $cart = $request->session()->get('cart', []);
        $products = Product::with('productImages')
            ->whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        foreach ($cart as $productId => &$item) {
            $product = $products->get($productId);
            if (!$product) {
                unset($cart[$productId]);
                continue;
            }

            $item['product_id'] = $product->id;
            $item['slug'] = $product->slug;
            $item['name'] = $product->name;
            $item['current_price'] = (float) $product->price;
            $item['price'] = $item['current_price'];
            $item['image_path'] = $product->productImages->first()?->image_path;
        }
        unset($item);
        $request->session()->put('cart', $cart);

        return view('product.cart', [
            'cart' => $cart,
            'total' => collect($cart)->sum(fn ($item) => $item['current_price'] * $item['quantity']),
        ]);
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
}

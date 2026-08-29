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
            $item['image_path'] = $product->productImages->first()?->image_path;
        }
        unset($item);
        $request->session()->put('cart', $cart);

        return view('product.cart', [
            'cart' => $cart,
            'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
        ]);
    }
}

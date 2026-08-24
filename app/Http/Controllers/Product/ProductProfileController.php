<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductProfileController extends Controller
{
    public function show(Product $product)
    {
        $product->load([
            'category',
            'reviews' => fn ($query) => $query->where('is_approved', true)->with('user')->latest(),
        ]);

        return view('product.profile', [
            'product' => $product,
            'relatedProducts' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_available', true)
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }
}

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
            'productImages',
            'reviews' => fn($query) => $query->where('is_approved', true)->with('user')->latest(),
        ]);

        $reviewsQuery = $product->reviews()->with('user')->latest();

        if (!auth()->check() || auth()->user()?->role !== 'admin') {
            $reviewsQuery->where('is_approved', true);
        }

        $reviews = $reviewsQuery->paginate(4)->withQueryString();

        return view('product.profile', [
            'product' => $product,
            'reviews' => $reviews,
            'relatedProducts' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_available', true)
                ->with('productImages')
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }
}

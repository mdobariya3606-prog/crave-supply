<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $term = trim((string) $request->query('q', ''));
        if (mb_strlen($term) < 2) {
            return response()->json(['products' => [], 'categories' => []]);
        }

        return response()->json([
            'products' => Product::where('name', 'like', "%{$term}%")
                ->orWhere('sku', 'like', "%{$term}%")->orderBy('name')->limit(6)
                ->orWhere('slug', 'like', "%{$term}%")->orderBy('name')->limit(6)->get()
                ->map(fn($product) => ['label' => $product->name, 'meta' => 'Product · ₹' . number_format((float) $product->price, 2), 'url' => route('products.profile', $product)]),
            'categories' => Category::where('name', 'like', "%{$term}%")->orderBy('name')->limit(4)->get()
                ->map(fn($category) => ['label' => $category->name, 'meta' => 'Category', 'url' => route('products.category', $category)]),
        ]);
    }
}

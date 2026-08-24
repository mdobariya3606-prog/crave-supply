<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Product;

class AddProductController extends Controller
{
    public function create() {
        abort_unless(auth()->user()?->role === 'admin', 403);

        return view('product.add', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(ProductRequest $request) {
        Product::create([
            ...$request->validated(),
            'is_available' => $request->boolean('is_available'),
        ]);

        return redirect()->route('products.add')->with('success', 'Product added successfully.');
    }
}

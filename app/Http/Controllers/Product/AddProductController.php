<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class AddProductController extends Controller
{
    public function create()
    {
        abort_unless(auth()->user()?->role === 'admin', 403);

        return view('product.add', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            ...$request->validated(),
            'is_available' => $request->boolean('is_available'),
        ]);
        self::storeImages($request, $product);

        return redirect()->route('products.add')->with('success', 'Product added successfully.');
    }

    public static function storeImages(ProductRequest $request, Product $product): void
    {
        foreach ($request->file('images', []) as $index => $image) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $image->store('products', 'public'),
                'is_primary' => $product->productImages()->doesntExist() && $index === 0,
                'sort_order' => $index,
            ]);
        }
    }
}

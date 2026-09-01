<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UpdateProductController extends Controller
{
    public function edit(Product $product)
    {
        return view('product.edit', compact('product') + ['categories' => Category::orderBy('name')->get()]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $oldCategoryId = $product->category_id;
        $product->update([...$request->validated(), 'is_available' => $request->boolean('is_available')]);
        AddProductController::storeImages($request, $product);
        if ($request->filled('primary_image')) {
            $product->productImages()->update(['is_primary' => false]);
            $product->productImages()->whereKey($request->integer('primary_image'))->update(['is_primary' => true]);
        }

        Cache::forget("product.{$product->id}");
        Cache::forget("product.{$product->id}.related");
        Cache::forget("category.{$oldCategoryId}.products");
        Cache::forget("category.{$product->category_id}.products");

        return redirect()->route('products.profile', $product)->with('success', 'Product updated successfully.');
    }

    public function destroyImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $product = $image->product;
        $image->delete();
        if (! $product->productImages()->where('is_primary', true)->exists() && $product->productImages()->exists()) {
            $product->productImages()->first()->update(['is_primary' => true]);
        }
        Cache::forget("product.{$product->id}");
        Cache::forget("product.{$product->id}.related");

        return back()->with('success', 'Product image removed.');
    }

    public function destroy(Product $product)
    {
        $categoryId = $product->category_id;
        $product->delete();
        Cache::forget('categories.all');
        Cache::forget("category.{$categoryId}.products");
        Cache::forget("product.{$product->id}");
        Cache::forget("product.{$product->id}.related");

        return redirect()->route('products.dashboard')->with('success', 'Product deleted successfully.');
    }
}

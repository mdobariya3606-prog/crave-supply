<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Requests\Product\ProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Product\AddProductController;

class UpdateProductController extends Controller
{
    public function edit(Product $product)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
        return view('product.edit', compact('product') + ['categories' => Category::orderBy('name')->get()]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
        $product->update([...$request->validated(), 'is_available' => $request->boolean('is_available')]);
        AddProductController::storeImages($request, $product);
        if ($request->filled('primary_image')) {
            $product->productImages()->update(['is_primary' => false]);
            $product->productImages()->whereKey($request->integer('primary_image'))->update(['is_primary' => true]);
        }
        return redirect()->route('products.profile', $product)->with('success', 'Product updated successfully.');
    }

    public function destroyImage(ProductImage $image)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
        Storage::disk('public')->delete($image->image_path);
        $product = $image->product;
        $image->delete();
        if (!$product->productImages()->where('is_primary', true)->exists() && $product->productImages()->exists()) {
            $product->productImages()->first()->update(['is_primary' => true]);
        }
        return back()->with('success', 'Product image removed.');
    }

    public function destroy(Product $product)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
        $product->delete();

        return redirect()->route('products.dashboard')->with('success', 'Product deleted successfully.');
    }
}

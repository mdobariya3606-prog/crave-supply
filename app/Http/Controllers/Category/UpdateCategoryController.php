<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CategoryRequest;
use App\Models\Category;
use App\Support\Cache\ProductCache;

class UpdateCategoryController extends Controller
{
    public function edit(Category $category)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);

        return view('product.category-add', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        abort_unless($request->user()?->role === 'admin', 403);
        $categoryId = $category->id;
        $category->update($request->validated());
        ProductCache::forgetCategory($categoryId);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }
}

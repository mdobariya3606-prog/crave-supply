<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

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
        $category->update($request->validated());
        Cache::forget('categories.all');
        Cache::forget("category.{$category->id}.products");

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }
}

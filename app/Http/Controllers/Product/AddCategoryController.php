<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CategoryRequest;
use App\Models\Category;

class AddCategoryController extends Controller
{
    public function create()
    {
        abort_unless(auth()->user()?->role === 'admin', 403);

        return view('product.category-add', ['category' => null]);
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('products.dashboard')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);

        return view('product.category-add', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('products.category', $category->slug)
            ->with('success', 'Category updated successfully.');
    }
}

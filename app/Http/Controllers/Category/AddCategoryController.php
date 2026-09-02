<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class AddCategoryController extends Controller
{
    public function create()
    {
        return view('product.category-add', ['category' => null]);
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        Cache::forget('categories.all');

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category added successfully.');
    }
}

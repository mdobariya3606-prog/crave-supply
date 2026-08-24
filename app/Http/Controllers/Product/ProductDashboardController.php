<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDashboardController extends Controller
{
    public function index(Request $request)
    {
        $allCategories = Category::orderBy('name')->get();

        return view('product.index', [
            'categories' => $request->boolean('all') ? $allCategories : $allCategories->take(4),
            'products' => Product::with(['category', 'productImages'])->latest()->get(),
            'selectedCategory' => null,
            'showAllCategories' => $request->boolean('all'),
        ]);
    }

    public function category(Category $category)
    {
        return view('product.index', [
            'categories' => Category::orderBy('name')->take(4)->get(),
            'products' => $category->products()->with(['category', 'productImages'])->latest()->get(),
            'selectedCategory' => $category,
            'showAllCategories' => false,
        ]);
    }
}

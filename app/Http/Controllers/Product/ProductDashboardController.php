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
        $categories = $request->boolean('all') ? $allCategories : $allCategories->take(4);
        $categoryProducts = $categories->mapWithKeys(fn (Category $category) => [
            $category->id => $category->products()
                ->with(['category', 'productImages'])
                ->latest()
                ->take(5)
                ->get(),
        ]);

        return view('product.index', [
            'categories' => $categories,
            'categoryProducts' => $categoryProducts,
            'products' => collect(),
            'selectedCategory' => null,
            'showAllCategories' => $request->boolean('all'),
        ]);
    }

    public function category(Request $request, Category $category)
    {
        return view('product.index', [
            'categories' => Category::orderBy('name')->take(4)->get(),
            'categoryProducts' => collect(),
            'products' => $category->products()->with(['category', 'productImages'])->latest()->paginate(15)->withQueryString(),
            'selectedCategory' => $category,
            'showAllCategories' => false,
        ]);
    }
}

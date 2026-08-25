<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Only show categories with enough products to make a useful catalogue section.
        $allCategories = Cache::remember(
            'categories.all',
            now()->addMinutes(30),
            function () {
                return Category::withCount('products')
                    ->orderBy('name')
                    ->get()
                    ->filter(fn(Category $category) => $category->products_count > 3)
                    ->values();
            }
        );

        // The default view is limited; the "all" query parameter shows every eligible category.
        $categories = $request->boolean('all')
            ? $allCategories
            : $allCategories->take(4);

        // Load only the products needed for each catalogue preview.
        $categoryProducts = $categories->mapWithKeys(fn(Category $category) => [
            $category->id => Cache::remember(
                "category.{$category->id}.products",
                now()->addMinutes(30),
                function () use ($category) {
                    return $category->products()
                        ->with(['category', 'productImages'])
                        ->latest()
                        ->take(5)
                        ->get();
                }
            )
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
            'products' => $category->products()->with(['category', 'productImages'])->latest()->paginate(5)->withQueryString(),
            'selectedCategory' => $category,
            'showAllCategories' => false,
        ]);
    }
}

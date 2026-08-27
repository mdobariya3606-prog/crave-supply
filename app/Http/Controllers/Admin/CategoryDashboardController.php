<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryDashboardController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::withCount('products')->orderBy('name')->get(),
        ]);
    }
}

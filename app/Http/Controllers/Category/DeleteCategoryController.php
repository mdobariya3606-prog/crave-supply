<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DeleteCategoryController extends Controller
{
    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->back()->with([
                'error' => 'Deletion not allowed: This category contains active products.',
            ]);
        }

        $category->delete();
        Cache::forget('categories.all');
        Cache::forget("category.{$category->id}.products");

        return redirect()->route('admin.categories.index');
    }
}

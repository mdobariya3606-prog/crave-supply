<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\Cache\ProductCache;

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
        ProductCache::forgetCategory($category->id);

        return redirect()->route('admin.categories.index');
    }
}

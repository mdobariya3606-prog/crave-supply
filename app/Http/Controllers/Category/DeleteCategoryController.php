<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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

        return redirect()->route('admin.categories.index');
    }
}

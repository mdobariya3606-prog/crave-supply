<?php

use App\Http\Controllers\Category\DeleteCategoryController;
use App\Http\Controllers\Category\UpdateCategoryController;
use App\Http\Controllers\Category\AddCategoryController;
use App\Http\Controllers\Admin\CategoryDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
    Route::get('/admin/categories', [CategoryDashboardController::class, 'index'])->name('admin.categories.index');

    Route::prefix('/categories')
        ->name('categories.')
        ->group(function () {
            Route::get('/add', [AddCategoryController::class, 'create'])->name('add');
            Route::post('/add', [AddCategoryController::class, 'store'])->name('add');

            Route::get('/{category}/edit', [UpdateCategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [UpdateCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [DeleteCategoryController::class, 'destroy'])->name('destroy');
        });
});

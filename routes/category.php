<?php

use App\Http\Controllers\Category\DeleteCategoryController;
use App\Http\Controllers\Category\UpdateCategoryController;
use App\Http\Controllers\Category\AddCategoryController;
use App\Http\Controllers\Admin\CategoryDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
    Route::get('/admin/categories', [CategoryDashboardController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/add', [AddCategoryController::class, 'create'])->name('categories.add');
    Route::post('/categories/add', [AddCategoryController::class, 'store'])->name('categories.add');

    Route::get('/categories/{category}/edit', [UpdateCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [UpdateCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [DeleteCategoryController::class, 'destroy'])->name('categories.destroy');
});

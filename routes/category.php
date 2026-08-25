<?php

use App\Http\Controllers\Product\AddCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
    Route::get('/categories/add', [AddCategoryController::class, 'create'])->name('categories.add');
    Route::post('/categories/add', [AddCategoryController::class, 'store'])->name('categories.add');

    Route::get('/categories/{category}/edit', [AddCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AddCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AddCategoryController::class, 'update'])->name('categories.destroy');
});

<?php

use App\Http\Controllers\Product\AddProductController;
use App\Http\Controllers\Product\AddCategoryController;
use App\Http\Controllers\Product\ProductDashboardController;
use App\Http\Controllers\Product\ProductProfileController;
use App\Http\Controllers\Product\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductDashboardController::class, 'index'])->name('products.dashboard');
Route::get('/products/category/{category:slug}', [ProductDashboardController::class, 'category'])->name('products.category');

Route::middleware('auth')->group(function () {
    Route::get('/products/add', [AddProductController::class, 'create'])->name('products.add');
    Route::post('/products/add', [AddProductController::class, 'store'])->name('products.add');
    Route::get('/categories/add', [AddCategoryController::class, 'create'])->name('categories.add');
    Route::post('/categories/add', [AddCategoryController::class, 'store'])->name('categories.add');
    Route::get('/categories/{category}/edit', [AddCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AddCategoryController::class, 'update'])->name('categories.update');
    Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
});

Route::get('/products/{product:slug}', [ProductProfileController::class, 'show'])->name('products.profile');

<?php

use App\Http\Controllers\Product\AddProductController;
use App\Http\Controllers\Product\AddCategoryController;
use App\Http\Controllers\Product\ProductDashboardController;
use App\Http\Controllers\Product\ProductProfileController;
use App\Http\Controllers\Product\ReviewController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Product\OrderController;
use App\Http\Controllers\Product\CartController;
use App\Http\Controllers\Product\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureAccountIsActive;

Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/products', [ProductDashboardController::class, 'index'])->name('products.dashboard');
Route::get('/products/category/{category:slug}', [ProductDashboardController::class, 'category'])->name('products.category');

Route::middleware(['auth', EnsureAccountIsActive::class])->group(function () {
    Route::get('/products/add', [AddProductController::class, 'create'])->name('products.add');
    Route::post('/products/add', [AddProductController::class, 'store'])->name('products.add');

    Route::get('/products/{product:slug}/edit', [UpdateProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product:slug}', [UpdateProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product:slug}', [UpdateProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/product-images/{image}', [UpdateProductController::class, 'destroyImage'])->name('products.images.destroy');

    Route::get('/categories/add', [AddCategoryController::class, 'create'])->name('categories.add');
    Route::post('/categories/add', [AddCategoryController::class, 'store'])->name('categories.add');

    Route::get('/categories/{category}/edit', [AddCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AddCategoryController::class, 'update'])->name('categories.update');

    Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
});

Route::post('/products/{product:slug}/order', [OrderController::class, 'store'])->middleware(['auth', EnsureAccountIsActive::class])->name('products.order.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::put('/cart/{product:slug}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product:slug}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/products/{product:slug}', [ProductProfileController::class, 'show'])->name('products.profile');

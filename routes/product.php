<?php

use App\Http\Controllers\Product\AddProductController;
use App\Http\Controllers\Product\ProductDashboardController;
use App\Http\Controllers\Product\ProductProfileController;
use App\Http\Controllers\Product\ReviewController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Product\OrderController;
use App\Http\Controllers\Product\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureAccountIsActive;

Route::middleware(['auth', EnsureAccountIsActive::class])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('/products/add', [AddProductController::class, 'create'])->name('products.add');
        Route::post('/products/add', [AddProductController::class, 'store'])->name('products.add');

        Route::get('/products/{product:slug}/edit', [UpdateProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product:slug}', [UpdateProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product:slug}', [UpdateProductController::class, 'destroy'])->name('products.destroy');
        Route::delete('/product-images/{image}', [UpdateProductController::class, 'destroyImage'])->name('products.images.destroy');
    });

    Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
});

Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/products', [ProductDashboardController::class, 'index'])->name('products.dashboard');
Route::get('/products/category/{category:slug}', [ProductDashboardController::class, 'category'])->name('products.category');

Route::post('/products/{product:slug}/order', [OrderController::class, 'store'])->middleware(['auth', EnsureAccountIsActive::class])->name('products.order.store');
Route::get('/products/{product:slug}', [ProductProfileController::class, 'show'])->name('products.profile');

<?php

use App\Http\Controllers\Product\AddProductController;
use App\Http\Controllers\Product\ProductDashboardController;
use App\Http\Controllers\Product\ProductProfileController;
use App\Http\Controllers\Product\ReviewController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Product\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureAccountIsActive;

Route::get('/products', [ProductDashboardController::class, 'index'])->name('products.dashboard');

Route::middleware(['auth', EnsureAccountIsActive::class])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::prefix('products')->group(function () {
            Route::get('/add', [AddProductController::class, 'create'])->name('products.add');
            Route::post('/add', [AddProductController::class, 'store'])->name('products.add');

            Route::get('/{product:slug}/edit', [UpdateProductController::class, 'edit'])->name('products.edit');
            Route::put('/{product:slug}', [UpdateProductController::class, 'update'])->name('products.update');
            Route::delete('/{product:slug}', [UpdateProductController::class, 'destroy'])->name('products.destroy');
        });
        Route::delete('/product-images/{image}', [UpdateProductController::class, 'destroyImage'])->name('products.images.destroy');
        Route::patch('/reviews/{review}/toggle-visibility', [ReviewController::class, 'toggleVisibility'])->name('reviews.toggle-visibility');
    });

    Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
});

Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/products/category/{category:slug}', [ProductDashboardController::class, 'category'])->name('products.category');

Route::get('/products/{product:slug}', [ProductProfileController::class, 'show'])->name('products.profile');

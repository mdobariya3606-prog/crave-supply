<?php

use App\Http\Controllers\Product\AddProductController;
use App\Http\Controllers\Product\ProductDashboardController;
use App\Http\Controllers\Product\ProductProfileController;
use App\Http\Controllers\Product\ReviewController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Product\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureAccountIsActive;

Route::middleware(['auth', EnsureAccountIsActive::class])->group(function () {

    Route::middleware(['admin'])->group(function () {

        Route::prefix('products')
            ->name('products.')
            ->group(function () {
                Route::get('/add', [AddProductController::class, 'create'])->name('add');
                Route::post('/add', [AddProductController::class, 'store'])->name('add');

                Route::get('/{product:slug}/edit', [UpdateProductController::class, 'edit'])->name('edit');
                Route::put('/{product:slug}', [UpdateProductController::class, 'update'])->name('update');
                Route::delete('/{product:slug}', [UpdateProductController::class, 'destroy'])->name('destroy');
            });

        Route::delete('/product-images/{image}', [UpdateProductController::class, 'destroyImage'])->name('products.images.destroy');
        Route::patch('/reviews/{review}/toggle-visibility', [ReviewController::class, 'toggleVisibility'])->name('reviews.toggle-visibility');
});

    Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
});

Route::prefix('/products')
    ->name('products.')
    ->group(function () {
        Route::get('/', [ProductDashboardController::class, 'index'])->name('dashboard');
        Route::get('/{product:slug}', [ProductProfileController::class, 'show'])->name('profile');
        Route::get('/category/{category:slug}', [ProductDashboardController::class, 'category'])->name('category');
    });

Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

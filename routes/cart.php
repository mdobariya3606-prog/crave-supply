<?php

use App\Http\Controllers\Cart\DeleteCartController;
use App\Http\Controllers\Cart\UpdateCartController;
use App\Http\Controllers\Product\CartController;
use App\Http\Controllers\Product\CheckoutController;
use App\Http\Middleware\EnsureAccountIsActive;
use Illuminate\Support\Facades\Route;

Route::prefix('/cart')
    ->name('cart.')
    ->group(function () {

        Route::middleware(['auth', EnsureAccountIsActive::class])
            ->controller(CheckoutController::class)
            ->group(function () {
                Route::get('/review', 'review')->name('review');
                Route::post('/submit', 'submit')->name('submit');
            });

        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::put('/{product:slug}', [UpdateCartController::class, 'update'])->name('update');
        Route::delete('/{product:slug}', [DeleteCartController::class, 'remove'])->name('remove');
        Route::delete('/', [DeleteCartController::class, 'clear'])->name('clear');
    });

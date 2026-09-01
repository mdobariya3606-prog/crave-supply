<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\EnsureAccountIsActive;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', EnsureAccountIsActive::class])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['admin'])
        ->prefix('/admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

            Route::controller(CustomerController::class)
                ->prefix('/customers')
                ->name('customers.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{user}', 'show')->name('show');
                    Route::get('/deleted', 'deleted')->name('deleted');

                    Route::patch('/deleted/{userId}/restore', 'restore')->name('restore');
                    Route::patch('/deleted/restore-all', 'restoreAll')->name('restore-all');
                    
                    Route::delete('/deleted/{userId}', 'forceDestroy')->name('force-destroy');
                    Route::delete('/deleted/delete-all', 'forceDestroyAll')->name('force-destroy-all');

                    Route::patch('/{user}/toggle', 'toggle')->name('toggle');
                    Route::delete('/{user}', 'destroy')->name('destroy');
                });

            Route::get('/messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
            Route::post('/messages/{contactMessage}/reply', [ContactMessageController::class, 'reply'])->name('contact-messages.reply');
        });
});

Route::middleware('guest')
    ->group(function () {

        Route::controller(RegisterController::class)
            ->prefix('/register')
            ->name('register')
            ->group(function () {
                Route::get('/', 'create');
                Route::post('/', 'store');
                Route::get('/verify', 'showVerify')->name('.verify');
                Route::post('/verify', 'verify')->name('.verify');
                Route::post('/verify/resend', 'resend')->name('.verify.resend');
            });

        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

        Route::controller(PasswordResetController::class)
            ->name('password.')
            ->group(function () {
                Route::get('/forgot-password', 'requestForm')->name('request');
                Route::post('/forgot-password', 'email')->name('email');
                Route::get('/reset-password/{token}', 'resetForm')->name('reset');
                Route::post('/reset-password', 'reset')->name('update');
            });
    });

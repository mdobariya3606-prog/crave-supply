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

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('/admin/customers/deleted', [CustomerController::class, 'deleted'])->name('admin.customers.deleted');
        Route::patch('/admin/customers/deleted/{userId}/restore', [CustomerController::class, 'restore'])->name('admin.customers.restore');
        Route::delete('/admin/customers/deleted/{userId}', [CustomerController::class, 'forceDestroy'])->name('admin.customers.force-destroy');
        Route::patch('/admin/customers/deleted/restore-all', [CustomerController::class, 'restoreAll'])->name('admin.customers.restore-all');
        Route::delete('/admin/customers/deleted/delete-all', [CustomerController::class, 'forceDestroyAll'])->name('admin.customers.force-destroy-all');
        Route::get('/admin/customers/{user}', [CustomerController::class, 'show'])->name('admin.customers.show');

        Route::patch('/admin/customers/{user}/toggle', [CustomerController::class, 'toggle'])->name('admin.customers.toggle');
        Route::delete('/admin/customers/{user}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
        Route::get('/admin/messages', [ContactMessageController::class, 'index'])->name('admin.contact-messages.index');
        Route::post('/admin/messages/{contactMessage}/reply', [ContactMessageController::class, 'reply'])->name('admin.contact-messages.reply');
    });
});

Route::middleware('guest')
    ->group(function () {
        Route::get('/register', [RegisterController::class, 'create'])->name('register');
        Route::post('/register', [RegisterController::class, 'store']);

        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

        Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
        Route::post('/forgot-password', [PasswordResetController::class, 'email'])->name('password.email');
        Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
        Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
    });

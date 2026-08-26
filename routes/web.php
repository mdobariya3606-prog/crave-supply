<?php

use App\Models\Review;
use App\Models\Product;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

require_once 'auth.php';
require_once 'product.php';
require_once 'order.php';
require_once 'category.php';
require_once 'cart.php';

Route::get('/', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view(
        'dashboard',
        [
            'topReviews' => Review::query()
                ->where('is_approved', true)
                ->whereNotNull('comment')
                ->where('comment', '!=', '')
                ->with(['product', 'user'])
                ->orderByDesc('rating')
                ->latest()
                ->take(6)
                ->get(),
            'randomProducts' => Product::query()
                ->where('is_available', true)
                ->with(['productImages', 'category'])
                ->inRandomOrder()
                ->take(10)
                ->get(),
        ]
    );
})->name('dashboard');

Route::get('/account-disabled', fn() => view('account-disabled'))->name('account.disabled');

Route::view('/about', 'about')->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'business_name' => ['nullable', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['nullable', 'string', 'max:30'],
        'message' => ['required', 'string', 'max:2000'],
    ]);

    ContactMessage::create($validated);

    return back()->with('contact_success', 'Thanks for reaching out. Our team will get back to you shortly.');
})->name('contact.submit');

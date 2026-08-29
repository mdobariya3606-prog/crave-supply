<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function create()
    {
        return view('user.login');
    }

    public function store(LoginRequest $request)
    {
        if (User::withTrashed()->where('email', $request->input('email'))->whereNotNull('deleted_at')->exists()) {
            return back()
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        $emailKey = 'login-email:' . strtolower($request->string('email')->toString());
        $ipKey = 'login-ip:' . $request->ip();

        if (RateLimiter::tooManyAttempts($emailKey, 5)) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Too many failed login attempts for this email address. Please try again in ' . RateLimiter::availableIn($emailKey) . ' seconds.']);
        }

        if (RateLimiter::tooManyAttempts($ipKey, 10)) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Too many failed login attempts from this IP address. Please try again in ' . RateLimiter::availableIn($ipKey) . ' seconds.']);
        }

        if (! Auth::attempt([...$request->only('email', 'password'), 'is_active' => true], $request->boolean('remember'))) {
            RateLimiter::hit($emailKey, 120);
            RateLimiter::hit($ipKey, 120);

            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        RateLimiter::clear($emailKey);
        RateLimiter::clear($ipKey);

        // Preserve a guest cart while rotating the session ID after login.
        $guestCart = $request->session()->get('cart', []);
        $request->session()->regenerate();
        if ($guestCart) {
            $request->session()->put('cart', $guestCart);
        }

        return redirect()->intended(route('dashboard'));
    }
}

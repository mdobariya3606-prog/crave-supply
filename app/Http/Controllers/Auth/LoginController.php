<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\QueuedRawMail;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Throwable;

class LoginController extends Controller
{
    public function create()
    {
        return view('user.login');
    }

    public function store(LoginRequest $request)
    {
        if (
            User::withTrashed()
            ->where('email', $request->input('email'))
            ->whereNotNull('deleted_at')
            ->exists()
        ) {
            return back()
                ->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
        }

        $emailKey = 'login-email:' . strtolower(
            $request->string('email')->toString()
        );

        $ipKey = 'login-ip:' . $request->ip();

        if (RateLimiter::tooManyAttempts($emailKey, 5)) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'Too many failed login attempts for this email address. Please try again in ' .
                        RateLimiter::availableIn($emailKey) .
                        ' seconds.',
                ]);
        }

        if (RateLimiter::tooManyAttempts($ipKey, 10)) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'Too many failed login attempts from this IP address. Please try again in ' .
                        RateLimiter::availableIn($ipKey) .
                        ' seconds.',
                ]);
        }

        $unverifiedUser = User::where(
            'email',
            $request->input('email')
        )
            ->where('role', 'customer')
            ->where('is_active', false)
            ->whereNull('email_verified_at')
            ->first();

        if (
            $unverifiedUser &&
            Hash::check(
                $request->input('password'),
                $unverifiedUser->password
            )
        ) {
            $otp = (string) random_int(100000, 999999);

            $request->session()->put('registration_verification', [
                'user_id' => $unverifiedUser->id,
                'otp' => Hash::make($otp),
                'expires_at' => now()->addMinutes(10)->timestamp,
            ]);

            $request->session()->put(
                'registration_verification_last_sent_at',
                now()->timestamp
            );

            try {
                Mail::to($unverifiedUser->email)->queue(new QueuedRawMail(
                    "Your CraveSupply verification code is {$otp}. It expires in 10 minutes.",
                    'Verify your CraveSupply account',
                ));
            } catch (Throwable $exception) {
                report($exception);
            }

            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'Please verify your email before logging in.',
                ]);
        }

        if (
            !Auth::attempt(
                [
                    ...$request->only('email', 'password'),
                    'is_active' => true,
                ],
                $request->boolean('remember')
            )
        ) {
            RateLimiter::hit($emailKey, 120);
            RateLimiter::hit($ipKey, 120);

            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
        }

        if (
            Auth::user()->role === 'customer' &&
            !Auth::user()->email_verified_at
        ) {
            $unverifiedUser = Auth::user();

            Auth::logout();

            $otp = (string) random_int(100000, 999999);

            $request->session()->put('registration_verification', [
                'user_id' => $unverifiedUser->id,
                'otp' => Hash::make($otp),
                'expires_at' => now()->addMinutes(10)->timestamp,
            ]);

            $request->session()->put(
                'registration_verification_last_sent_at',
                now()->timestamp
            );

            try {
                Mail::to($unverifiedUser->email)->queue(new QueuedRawMail(
                    "Your CraveSupply verification code is {$otp}. It expires in 10 minutes.",
                    'Verify your CraveSupply account',
                ));
            } catch (Throwable $exception) {
                report($exception);
            }

            return back()->withErrors([
                'email' => 'Please verify your email before logging in.',
            ]);
        }

        RateLimiter::clear($emailKey);
        RateLimiter::clear($ipKey);

        // Preserve a guest cart while rotating the session ID after login.
        $guestCart = $request->session()->get('cart', []);

        $request->session()->regenerate();

        if ($guestCart) {
            $request->session()->put('cart', $guestCart);
        }

        $destination = Auth::user()->role === 'admin'
            ? route('admin.dashboard')
            : route('dashboard');

        return redirect()->intended($destination);
    }
}

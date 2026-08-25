<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function requestForm()
    {
        return view('user.forgot-password');
    }

    public function email(ForgotPasswordRequest $request)
    {
        $token = DB::table('password_reset_tokens')->where('email', $request->only('email'))->first();

        if ($token) {
            $expiresAt = Carbon::parse($token->created_at)->addMinutes(60);
            if (!$expiresAt->isPast()) {
                return back()->withInput()->withErrors(['email' => 'Email already sent.']);
            }
        }

        $status = Password::sendResetLink($request->only('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            return back()->withInput()->withErrors(['email' => __($status)]);
        }

        return back()->with('status', 'We sent a password reset link to your email address.');
    }

    public function resetForm(string $token)
    {
        return view('user.reset-password', ['token' => $token, 'email' => request()->query('email', '')]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $status = Password::reset($request->validated(), function (User $user, string $password): void {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
        }

        return redirect()->route('login')->with('status', 'Your password has been reset. You can now log in.');
    }
}

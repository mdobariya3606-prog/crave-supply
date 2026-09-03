<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\QueuedRawMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class RegisterController extends Controller
{
    public function create()
    {
        return view('user.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::withTrashed()
            ->where('email', $data['email'])
            ->first();

        if (
            $user &&
            $user->trashed() &&
            $user->deleted_at->addDays(15)->isPast()
        ) {
            $user->restore();
            $user->update(array_merge($data, ['is_active' => true]));
        } else {
            $user = User::create(
                array_merge($data, ['is_active' => false])
            );
        }

        $otp = (string) random_int(100000, 999999);

        $request->session()->put('registration_verification', [
            'user_id' => $user->id,
            'otp' => Hash::make($otp),
            'expires_at' => now()->addMinutes(10)->timestamp,
        ]);

        $request->session()->put(
            'registration_verification_last_sent_at',
            now()->timestamp
        );

        try {
            Mail::to($user->email)->queue(new QueuedRawMail(
                "Your CraveSupply verification code is {$otp}. It expires in 10 minutes.",
                'Verify your CraveSupply account',
            ));
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('register.verify')
                ->with(
                    'error',
                    'We could not send the verification email. Please contact support or try again later.'
                );
        }

        return redirect()
            ->route('register.verify')
            ->with(
                'status',
                'We sent a verification code to your email address.'
            );
    }

    public function showVerify()
    {
        abort_unless(
            session()->has('registration_verification'),
            404
        );

        return view('user.verify-email');
    }

    public function resend(Request $request)
    {
        $verification = $request->session()->get(
            'registration_verification'
        );

        abort_unless($verification, 404);

        $lastSentAt = $request->session()->get(
            'registration_verification_last_sent_at'
        );

        $secondsSinceLastSend = $lastSentAt
            ? now()->timestamp - $lastSentAt
            : 120;

        if ($secondsSinceLastSend < 120) {
            $wait = 120 - $secondsSinceLastSend;

            return back()->withErrors([
                'otp' => "Please wait {$wait} seconds before requesting another code.",
            ]);
        }

        $user = User::findOrFail($verification['user_id']);
        $otp = (string) random_int(100000, 999999);

        $request->session()->put('registration_verification', [
            'user_id' => $user->id,
            'otp' => Hash::make($otp),
            'expires_at' => now()->addMinutes(10)->timestamp,
        ]);

        $request->session()->put(
            'registration_verification_last_sent_at',
            now()->timestamp
        );

        Mail::to($user->email)->queue(new QueuedRawMail(
            "Your CraveSupply verification code is {$otp}. It expires in 10 minutes.",
            'Your new CraveSupply verification code',
        ));

        return back()->with(
            'status',
            'A new verification code will be sent to your email.'
        );
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $verification = $request->session()->get(
            'registration_verification'
        );

        if (
            ! $verification ||
            now()->timestamp > $verification['expires_at'] ||
            ! Hash::check(
                $request->input('otp'),
                $verification['otp']
            )
        ) {
            return back()->withErrors([
                'otp' => 'The verification code is invalid or has expired.',
            ]);
        }

        $user = User::findOrFail($verification['user_id']);

        $user->update([
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        $request->session()->forget('registration_verification');

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with(
                'status',
                'Your email has been verified successfully.'
            );
    }
}

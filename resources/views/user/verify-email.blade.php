<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify email — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('layouts.header')
    <main class="register-container">
        <section class="card" aria-labelledby="verify-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>
                <p class="brand-name">CraveSupply</p>
                <h1 id="verify-title">Verify your email</h1>
                <p>Enter the six-digit code sent to your email address.</p>
            </header>
            @if (session('status'))<div class="alert-success" role="status">{{ session('status') }}</div>@endif
            @if (session('error'))<div class="alert-error" role="alert">{{ session('error') }}</div>@endif
            <form action="{{ route('register.verify') }}" method="POST">
                @csrf
                <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                    <label for="otp">Verification code</label>
                    <input id="otp" name="otp" type="text" inputmode="numeric" autocomplete="one-time-code"
                        pattern="[0-9]{6}" maxlength="6" required autofocus>
                    @error('otp')<small class="field-error">{{ $message }}</small>@enderror
                </div>
                <button type="submit" class="btn-submit">Verify email</button>
            </form>
            <form action="{{ route('register.verify.resend') }}" method="POST" style="margin-top:16px;text-align:center">
                @csrf
                <button type="submit" class="secondary-btn">Send a new code</button>
            </form>
        </section>
    </main>
    @include('layouts.footer')
</body>
</html>

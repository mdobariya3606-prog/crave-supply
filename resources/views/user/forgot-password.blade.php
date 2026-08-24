<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password — CraveSupply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="register-container">
        <section class="card" aria-labelledby="forgot-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>
                <p class="brand-name">CraveSupply</p>
                <h1 id="forgot-title">Reset your password</h1>
                <p>Enter your account email and we’ll send you a secure reset link so you can get back to your snack supplies.</p>
            </header>

            <div class="auth-snack-note">
                <img src="https://images.unsplash.com/photo-1499636136210-6f4ee915583e?auto=format&amp;fit=crop&amp;w=240&amp;q=78" alt="Freshly baked cookies">
                <div>
                    <strong>Your snack shelf is waiting.</strong>
                    <span>Reset your password and get back to your next restock.</span>
                </div>
            </div>

            @if (session('status'))
                <div class="alert-success" role="status">{{ session('status') }}</div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" id="forgotForm" novalidate>
                @csrf
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email address <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email" placeholder="you@company.com" aria-describedby="emailError">
                        <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><polyline points="3,7 12,13 21,7"/></svg>
                    </div>
                    @include('user.partials.field-error', ['field' => 'email'])
                </div>
                <button type="submit" class="btn-submit">Send reset link</button>
            </form>

            <footer class="form-footer"><a href="{{ route('login') }}">Back to login</a></footer>
        </section>
    </main>
    <script>
        const forgotForm = document.getElementById('forgotForm');
        const email = document.getElementById('email');
        function validateEmail() {
            const message = email.validity.valueMissing ? 'This field is required.' : email.validity.typeMismatch ? 'Enter a valid email address.' : '';
            const error = document.getElementById('emailError');
            error.querySelector('span').textContent = message;
            error.classList.toggle('is-visible', Boolean(message));
            email.closest('.form-group').classList.toggle('has-error', Boolean(message));
            email.classList.toggle('has-error', Boolean(message));
            return !message;
        }
        email.addEventListener('input', validateEmail);
        email.addEventListener('blur', validateEmail);
        forgotForm.addEventListener('submit', (event) => { if (!validateEmail()) { event.preventDefault(); email.focus(); } });
    </script>
</body>
</html>

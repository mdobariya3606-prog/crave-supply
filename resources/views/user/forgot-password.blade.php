<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password — CraveSupply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .btn-submit.is-sending {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: wait;
            opacity: .78
        }

        .mail-submit-spinner {
            width: 13px;
            height: 13px;
            border: 2px solid rgba(255, 255, 255, .45);
            border-top-color: #fff;
            border-radius: 50%;
            animation: mail-submit-spin .7s linear infinite
        }

        @keyframes mail-submit-spin {
            to {
                transform: rotate(360deg)
            }
        }
    </style>
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

            <form action="{{ route('password.email') }}" method="POST" id="forgotForm" novalidate>
                @csrf
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email address <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email" placeholder="you@company.com" aria-describedby="emailError">
                        <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <polyline points="3,7 12,13 21,7" />
                        </svg>
                    </div>
                    @php($message = session('status') ?: $errors->first('email'))
                    <div id="emailError" class="error-text{{ $message ? ' is-visible' : '' }}" role="alert"><svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg><span>{{ $message }}</span></div>
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
        forgotForm.addEventListener('submit', (event) => {
            if (!validateEmail()) {
                event.preventDefault();
                email.focus();
                return;
            }

            const button = forgotForm.querySelector('button[type="submit"]');
            button.disabled = true;
            button.classList.add('is-sending');
            button.innerHTML = '<span class="mail-submit-spinner" aria-hidden="true"></span>Sending…';
        });
    </script>
</body>

</html>

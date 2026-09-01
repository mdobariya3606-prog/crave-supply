<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in — CraveSupply</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    @include ('layouts.header')

    <main class="register-container">
        <section class="card" aria-labelledby="login-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>

                <p class="brand-name">CraveSupply</p>

                <h1 id="login-title">Welcome back</h1>

                <p>Log in to manage your supplies and keep your next restock simple.</p>
            </header>

            @if (session('status'))
                <div class="alert-success" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @if (
            session()->has('registration_verification') &&
            $errors->first('email') === 'Please verify your email before logging in.'
            )
                <p class="alert-error" role="alert">Your email is not verified.
                <a href="{{ route('register.verify') }}">Verify it now</a>.</p>
            @endif

            <form
                action="{{ url('/login') }}"
                method="POST"
                id="loginForm"
                novalidate
            >
                @csrf

                <div class="login-fields">
                    <div
                        class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"
                    >
                        <label for="email">
                            Email address
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                maxlength="255"
                                autocomplete="email"
                                placeholder="you@company.com"
                                aria-describedby="emailError"
                            />

                            <svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                />
                                <polyline points="3,7 12,13 21,7" />
                            </svg>
                        </div>

                        <div
                            id="emailError"
                            class="error-text{{ $errors->has('email') ? ' is-visible' : '' }}"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>

                            <span>
                                @error ('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div
                        class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"
                    >
                        <label for="password">
                            Password
                            <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                maxlength="255"
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                aria-describedby="passwordError"
                            />

                            <svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <rect
                                    x="4"
                                    y="10"
                                    width="16"
                                    height="11"
                                    rx="2"
                                />
                                <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                            </svg>

                            <button
                                type="button"
                                class="pass-toggle"
                                onclick="togglePassword('password', this)"
                                aria-label="Show password"
                            >
                                <svg
                                    class="eye-icon eye-open"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>

                                <svg
                                    class="eye-icon eye-closed"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path d="m3 3 18 18M10.6 6.2A10.8 10.8 0 0 1 12 6c6 0 9.5 6 9.5 6a17 17 0 0 1-3.1 3.8M6.5 6.7C3.9 8.4 2.5 12 2.5 12s3.5 6 9.5 6c1.1 0 2.1-.2 3-.6" />
                                    <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" />
                                </svg>
                            </button>
                        </div>

                        <div
                            id="passwordError"
                            class="error-text{{ $errors->has('password') ? ' is-visible' : '' }}"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>

                            <span>
                                @error ('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="login-options">
                    <label class="remember-option" for="remember">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        />

                        <span>Remember me</span>
                    </label>

                    <a href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                </div>

                <button type="submit" class="btn-submit">Log in</button>
            </form>

            <footer class="form-footer">
                New to CraveSupply?
                <a href="{{ url('/register') }}">Create an account</a>
            </footer>
        </section>
    </main>

    @include ('layouts.footer')

    <script>
        const loginForm = document.getElementById("loginForm");
        const email = document.getElementById("email");
        const password = document.getElementById("password");

        function setFieldError(field, message = "") {
            const error = document.getElementById(`${field.name}Error`);
            const group = field.closest(".form-group");

            if (!error || !group) return;

            const hasError = Boolean(message);

            error.querySelector("span").textContent = message;
            error.classList.toggle("is-visible", hasError);
            group.classList.toggle("has-error", hasError);
            field.classList.toggle("has-error", hasError);
            field.setAttribute("aria-invalid", hasError ? "true" : "false");
        }

        function validateField(field) {
            let message = "";

            if (field.validity.valueMissing) {
                message = "This field is required.";
            } else if (field.validity.typeMismatch) {
                message = "Enter a valid email address.";
            } else if (field.validity.tooLong) {
                message = `Use no more than ${field.maxLength} characters.`;
            }

            setFieldError(field, message);

            return !message;
        }

        [email, password].forEach((field) => {
            field.addEventListener("input", () => validateField(field));
            field.addEventListener("blur", () => validateField(field));
        });

        loginForm.addEventListener("submit", (event) => {
            const valid = [email, password].map(validateField).every(Boolean);

            if (!valid) {
                event.preventDefault();

                [email, password]
                    .find((field) => !validateField(field))
                    ?.focus();
            }
        });

        function togglePassword(fieldId, button) {
            const input = document.getElementById(fieldId);
            const visible = input.type === "text";

            input.type = visible ? "password" : "text";

            button.classList.toggle("is-visible", !visible);

            button.setAttribute(
                "aria-label",
                visible ? "Show password" : "Hide password",
            );
        }
    </script>
</body>
</html>

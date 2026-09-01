<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Choose a new password — CraveSupply</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <main class="register-container">
        <section class="card" aria-labelledby="reset-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>
                <p class="brand-name">CraveSupply</p>
                <h1 id="reset-title">Choose a new password</h1>
                <p>Use a strong password you’ll remember for your next visit.</p>
            </header>

            <form
                action="{{ route('password.update') }}"
                method="POST"
                id="resetForm"
                novalidate
            >
                @csrf
                <input type="hidden" name="token" value="{{ $token }}" />
                <div
                    class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"
                >
                    <label for="email"
                        >Email address <span class="required">*</span></label
                    >
                    <div class="input-wrapper">
                        {{-- Email address --}}
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $email) }}"
                            required
                            maxlength="255"
                            autocomplete="email"
                            placeholder="you@company.com"
                            readonly
                            aria-describedby="emailError"
                        /><svg
                            class="input-icon"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <polyline points="3,7 12,13 21,7" />
                        </svg>
                    </div>
                    @include ('user.partials.field-error', ['field' => 'email'])
                </div>
                <hr style="opacity: 0.5" />

                <div class="login-fields">
                    <div
                        class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"
                    >
                        <label for="password"
                            >New password <span class="required">*</span></label
                        >
                        <div class="input-wrapper">
                            {{-- New password --}}
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                minlength="8"
                                maxlength="255"
                                autocomplete="new-password"
                                placeholder="At least 8 characters"
                                aria-describedby="passwordError"
                            /><svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <rect x="4" y="10" width="16" height="11" rx="2" />
                                <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                            </svg
                            ><button
                                type="button"
                                class="pass-toggle"
                                onclick="togglePassword('password', this)"
                                aria-label="Show password"
                            >
                                <svg class="eye-icon eye-open" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>
                                <svg class="eye-icon eye-closed" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="m3 3 18 18M10.6 6.2A10.8 10.8 0 0 1 12 6c6 0 9.5 6 9.5 6a17 17 0 0 1-3.1 3.8M6.5 6.7C3.9 8.4 2.5 12 2.5 12s3.5 6 9.5 6c1.1 0 2.1-.2 3-.6" />
                                    <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" />
                                </svg>
                            </button>
                        </div>
                        @include ('user.partials.field-error', ['field' => 'password'])
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation"
                            >Confirm new password
                            <span class="required">*</span></label
                        >
                        <div class="input-wrapper">
                            {{-- Confirm password --}}
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                minlength="8"
                                maxlength="255"
                                autocomplete="new-password"
                                placeholder="Re-enter your password"
                                aria-describedby="password_confirmationError"
                            /><svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M12 3 4 6v5c0 5 3.5 8.5 8 10 4.5-1.5 8-5 8-10V6l-8-3Z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg
                            ><button
                                type="button"
                                class="pass-toggle"
                                onclick="
                                    togglePassword(
                                        'password_confirmation',
                                        this,
                                    )
                                "
                                aria-label="Show password"
                            >
                                <svg class="eye-icon eye-open" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" />
                                    <circle cx="12" cy="12" r="2.5" />
                                </svg>
                                <svg class="eye-icon eye-closed" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="m3 3 18 18M10.6 6.2A10.8 10.8 0 0 1 12 6c6 0 9.5 6 9.5 6a17 17 0 0 1-3.1 3.8M6.5 6.7C3.9 8.4 2.5 12 2.5 12s3.5 6 9.5 6c1.1 0 2.1-.2 3-.6" />
                                    <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" />
                                </svg>
                            </button>
                        </div>
                        <div
                            id="password_confirmationError"
                            class="error-text"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg
                            ><span></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Reset password</button>
            </form>
            <footer class="form-footer">
                <a href="{{ route('login') }}">Back to login</a>
            </footer>
        </section>
    </main>
    <script>
        const resetForm = document.getElementById("resetForm");
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const confirmation = document.getElementById("password_confirmation");
        const fields = [email, password, confirmation];

        function validateField(field) {
            let message = "";
            if (field.validity.valueMissing)
                message = "This field is required.";
            else if (field.validity.typeMismatch)
                message = "Enter a valid email address.";
            else if (field.validity.tooShort)
                message = `Use at least ${field.minLength} characters.`;
            else if (
                field.name === "password_confirmation" &&
                field.value !== password.value
            )
                message = "Passwords do not match.";
            const error = document.getElementById(`${field.name}Error`);
            error.querySelector("span").textContent = message;
            error.classList.toggle("is-visible", Boolean(message));
            field
                .closest(".form-group")
                .classList.toggle("has-error", Boolean(message));
            field.classList.toggle("has-error", Boolean(message));
            return !message;
        }
        fields.forEach((field) => {
            field.addEventListener("input", () => {
                validateField(field);
                if (field === password) validateField(confirmation);
            });
            field.addEventListener("blur", () => validateField(field));
        });
        resetForm.addEventListener("submit", (event) => {
            if (!fields.map(validateField).every(Boolean)) {
                event.preventDefault();
                fields.find((field) => !validateField(field))?.focus();
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

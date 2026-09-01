<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Account — CraveSupply</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    @include ('layouts.header')
    <main class="register-container">
        <section class="card" aria-labelledby="register-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>
                <p class="brand-name">CraveSupply</p>
                <h1 id="register-title">Create your account</h1>
                <p>Set up your business account to manage your supplies.</p>
            </header>

            <form
                action="{{ route('register') }}"
                method="POST"
                id="registerForm"
                novalidate
            >
                @csrf

                <div
                    id="formStatus"
                    class="form-status"
                    role="status"
                    aria-live="polite"
                    hidden
                ></div>

                <div class="form-grid">
                    <div
                        class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"
                    >
                        <label for="name"
                            >Full name <span class="required">*</span></label
                        >
                        <div class="input-wrapper">
                            {{-- Full name --}}
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                minlength="3"
                                maxlength="255"
                                autocomplete="name"
                                placeholder="Alex Morgan"
                                aria-describedby="nameError"
                            />
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <div
                            id="nameError"
                            class="error-text{{ $errors->has('name') ? ' is-visible' : '' }}"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg
                            ><span>
                                @error ('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div
                        class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}"
                    >
                        <label for="business_name">Business name</label>
                        <div class="input-wrapper">
                            {{-- Business name --}}
                            <input
                                id="business_name"
                                name="business_name"
                                type="text"
                                value="{{ old('business_name') }}"
                                maxlength="255"
                                autocomplete="organization"
                                placeholder="Morgan Foods Ltd."
                                aria-describedby="business_nameError"
                            />
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M3 21h18" />
                                <path d="M5 21V5l7-3 7 3v16" />
                                <path d="M9 21v-5h6v5" />
                                <path d="M9 9h.01M15 9h.01M9 12h.01M15 12h.01" />
                            </svg>
                        </div>
                        <div
                            id="business_nameError"
                            class="error-text{{ $errors->has('business_name') ? ' is-visible' : '' }}"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg
                            ><span>
                                @error ('business_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div
                        class="form-group full-width{{ $errors->has('business_address') ? ' has-error' : '' }}"
                    >
                        <label for="business_address">Business address</label>
                        <div class="input-wrapper">
                            {{-- Business address --}}
                            <textarea
                                id="business_address"
                                name="business_address"
                                maxlength="255"
                                autocomplete="street-address"
                                placeholder="123 Market Street, City, State"
                                aria-describedby="business_addressError"
                                >{{ old('business_address') }}</textarea
                            >
                            <svg class="input-icon input-icon-top" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                        </div>
                        <div
                            id="business_addressError"
                            class="error-text{{ $errors->has('business_address') ? ' is-visible' : '' }}"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg
                            ><span>
                                @error ('business_address')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div
                        class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"
                    >
                        <label for="email"
                            >Email address
                            <span class="required">*</span></label
                        >
                        <div class="input-wrapper">
                            {{-- Email address --}}
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
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
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
                            </svg
                            ><span>
                                @error ('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div
                        class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}"
                    >
                        <label for="phone">Phone number</label>
                        <div class="input-wrapper">
                            {{-- Phone number --}}
                            <input
                                id="phone"
                                name="phone"
                                type="tel"
                                maxlength="10"
                                value="{{ old('phone') }}"
                                maxlength="30"
                                autocomplete="tel"
                                placeholder="+91 98765 43210"
                                aria-describedby="phoneError"
                            />
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="6" y="3" width="12" height="18" rx="2" />
                                <path d="M10 18h4" />
                            </svg>
                        </div>
                        <div
                            id="phoneError"
                            class="error-text{{ $errors->has('phone') ? ' is-visible' : '' }}"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg
                            ><span>
                                @error ('phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div
                        class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"
                    >
                        <label for="password"
                            >Password <span class="required">*</span></label
                        >
                        <div class="input-wrapper">
                            {{-- Password input --}}
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
                            />
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="4" y="10" width="16" height="11" rx="2" />
                                <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                            </svg>
                            <button
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
                        <div
                            id="passwordError"
                            class="error-text{{ $errors->has('password') ? ' is-visible' : '' }}"
                            role="alert"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg
                            ><span>
                                @error ('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div
                        class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}"
                    >
                        <label for="password_confirmation"
                            >Confirm password
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
                            />
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3 4 6v5c0 5 3.5 8.5 8 10 4.5-1.5 8-5 8-10V6l-8-3Z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>

                            {{-- Password toggle button --}}
                            <button
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

                    {{-- Create account button --}}
                    <div class="full-width">
                        <button type="submit" class="btn-submit">
                            Create account
                        </button>
                    </div>
                </div>
            </form>

            <footer class="form-footer">
                Already have an account?
                <a href="{{ url('/login') }}">Log in</a>
            </footer>
        </section>
    </main>
    @include ('layouts.footer')

    <script>
        const registerForm = document.getElementById("registerForm");
        const formStatus = document.getElementById("formStatus");
        const submitButton = registerForm.querySelector(".btn-submit");
        const password = document.getElementById("password");
        const passwordConfirmation = document.getElementById(
            "password_confirmation",
        );
        const fields = [
            ...registerForm.querySelectorAll("input[name], textarea[name]"),
        ];

        function showStatus(message, type = "success") {
            formStatus.hidden = false;
            formStatus.className = `form-status alert-${type}`;
            formStatus.textContent = message;
        }

        function getErrorMessage(field) {
            const emptyFieldMessages = {
                name: "Please enter your full name.",
                email: "Please enter your email address.",
                password: "Please create a password.",
                password_confirmation: "Please confirm your password.",
            };

            if (
                field.name === "password_confirmation" &&
                field.value &&
                field.value !== password.value
            ) {
                return "Passwords do not match.";
            }

            if (field.validity.valueMissing)
                return emptyFieldMessages[field.name] || "";
            if (field.validity.typeMismatch)
                return "Enter a valid email address.";
            if (field.validity.tooShort)
                return `Use at least ${field.minLength} characters.`;
            if (field.validity.tooLong)
                return `Use no more than ${field.maxLength} characters.`;
            return "";
        }

        function setFieldError(field, message = "") {
            const error = document.getElementById(`${field.name}Error`);
            if (!error) return;

            const hasError = Boolean(message);
            error.querySelector("span").textContent = message;
            error.classList.toggle("is-visible", hasError);
            field.classList.toggle("has-error", hasError);
            field
                .closest(".form-group")
                ?.classList.toggle("has-error", hasError);
            field.setAttribute("aria-invalid", hasError ? "true" : "false");
        }

        function validateField(field) {
            const message = getErrorMessage(field);
            setFieldError(field, message);
            return !message;
        }

        fields.forEach((field) => {
            field.addEventListener("input", () => {
                validateField(field);
                if (field === password) validateField(passwordConfirmation);
            });
            field.addEventListener("blur", () => validateField(field));
        });

        registerForm.addEventListener("submit", async (event) => {
            event.preventDefault();

            const isValid = fields.map(validateField).every(Boolean);
            if (!isValid) {
                fields.find((field) => getErrorMessage(field))?.focus();
                return;
            }

            submitButton.disabled = true;
            submitButton.textContent = "Creating account...";
            formStatus.hidden = true;

            try {
                const response = await fetch(registerForm.action, {
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: new FormData(registerForm),
                });

                if (response.redirected) {
                    window.location.assign(response.url);
                    return;
                }

                const data = await response.json().catch(() => ({}));

                if (!response.ok) {
                    let firstServerErrorField = null;
                    Object.entries(data.errors || {}).forEach(
                        ([fieldName, messages]) => {
                            const field = registerForm.elements[fieldName];
                            if (field) {
                                setFieldError(field, messages[0]);
                                firstServerErrorField ??= field;
                            }
                        },
                    );
                    (
                        firstServerErrorField ||
                        fields.find((field) => getErrorMessage(field))
                    )?.focus();
                    return;
                }

                showStatus(
                    data.message || "Registration submitted successfully.",
                );
                registerForm.reset();
            } catch (error) {
                showStatus(
                    "Unable to connect right now. Please try again.",
                    "error",
                );
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = "Create account";
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

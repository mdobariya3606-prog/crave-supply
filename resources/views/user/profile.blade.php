<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile — CraveSupply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.header')
    <main class="register-container">
        <section class="card" aria-labelledby="profile-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>
                <p class="brand-name">CraveSupply</p>
                <h1 id="profile-title">Edit your profile</h1>
                <p>Keep your business details current for a smoother restocking experience.</p>
            </header>

            @if (session('status'))
                <div class="alert-success" role="status">{{ session('status') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" id="profileForm" novalidate>
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Full name <span class="required">*</span></label>
                        <div class="input-wrapper">

                            {{-- Name  --}}
                            <input id="name" name="name" type="text"
                                value="{{ old('name', auth()->user()->name) }}" required minlength="3" maxlength="255"
                                autocomplete="name" placeholder="Alex Morgan" aria-describedby="nameError"><svg
                                class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        @include('user.partials.field-error', ['field' => 'name'])
                    </div>
                    <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                        <label for="business_name">Business name</label>
                        <div class="input-wrapper">

                            {{-- Business name --}}
                            <input id="business_name" name="business_name" type="text"
                                value="{{ old('business_name', auth()->user()->business_name) }}" maxlength="255"
                                autocomplete="organization" placeholder="Morgan Foods Ltd."
                                aria-describedby="business_nameError"><svg class="input-icon" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path d="M3 21h18" />
                                <path d="M5 21V5l7-3 7 3v16" />
                                <path d="M9 21v-5h6v5" />
                            </svg>
                        </div>
                        @include('user.partials.field-error', ['field' => 'business_name'])
                    </div>
                    <div class="form-group full-width{{ $errors->has('business_address') ? ' has-error' : '' }}">
                        <label for="business_address">Business address</label>
                        <div class="input-wrapper">

                            {{-- Business address --}}
                            <textarea id="business_address" name="business_address" maxlength="255" autocomplete="street-address"
                                placeholder="123 Market Street, City, State" aria-describedby="business_addressError">{{ old('business_address', auth()->user()->business_address) }}</textarea><svg class="input-icon input-icon-top" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                        </div>
                        @include('user.partials.field-error', ['field' => 'business_address'])
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email address <span class="required">*</span></label>
                        <div class="input-wrapper">

                            {{-- Email  --}}
                            <input id="email" name="email" type="email"
                                value="{{ old('email', auth()->user()->email) }}" required maxlength="255"
                                autocomplete="email" placeholder="you@company.com" aria-describedby="emailError"><svg
                                class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <polyline points="3,7 12,13 21,7" />
                            </svg>
                        </div>
                        @include('user.partials.field-error', ['field' => 'email'])
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone">Phone number</label>
                        <div class="input-wrapper">

                            {{-- Phone no. --}}
                            <input id="phone" name="phone" type="tel"
                                value="{{ old('phone', auth()->user()->phone) }}" maxlength="10" inputmode="numeric"
                                autocomplete="tel" placeholder="9876543210" aria-describedby="phoneError"><svg
                                class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="6" y="3" width="12" height="18" rx="2" />
                                <path d="M10 18h4" />
                            </svg>
                        </div>
                        @include('user.partials.field-error', ['field' => 'phone'])
                    </div>
                </div>
                <div class="profile-actions"><a class="secondary-btn"
                        href="{{ route('dashboard') }}">Cancel</a><button type="submit" class="btn-submit">Save
                        changes</button></div>
            </form>
            <footer class="form-footer">Need to update something else? <a href="mailto:hello@cravesupply.test">Contact
                    support</a></footer>
        </section>
    </main>
    @include('layouts.footer')
    <script>
        const profileForm = document.getElementById('profileForm');
        const fields = [...profileForm.querySelectorAll('input[name], textarea[name]')];
        const password = document.getElementById('password');
        const confirmation = document.getElementById('password_confirmation');

        function errorMessage(field) {
            if (field.name === 'password_confirmation' && field.value && field.value !== password.value)
                return 'Passwords do not match.';
            if (field.validity.valueMissing) return 'This field is required.';
            if (field.validity.typeMismatch) return 'Enter a valid email address.';
            if (field.validity.tooShort) return `Use at least ${field.minLength} characters.`;
            if (field.validity.tooLong) return `Use no more than ${field.maxLength} characters.`;
            if (field.name === 'phone' && field.value && !/^[6-9][0-9]{9}$/.test(field.value))
                return 'Enter a valid 10-digit phone number.';
            return '';
        }

        function validateField(field) {
            const error = document.getElementById(`${field.name}Error`);
            const message = errorMessage(field);
            if (!error) return !message;
            error.querySelector('span').textContent = message;
            error.classList.toggle('is-visible', Boolean(message));
            field.classList.toggle('has-error', Boolean(message));
            field.closest('.form-group')?.classList.toggle('has-error', Boolean(message));
            field.setAttribute('aria-invalid', message ? 'true' : 'false');
            return !message;
        }

        fields.forEach((field) => {
            field.addEventListener('input', () => {
                validateField(field);
                if (field === password) validateField(confirmation);
            });
            field.addEventListener('blur', () => validateField(field));
        });
        profileForm.addEventListener('submit', (event) => {
            if (!fields.map(validateField).every(Boolean)) {
                event.preventDefault();
                fields.find((field) => errorMessage(field))?.focus();
            }
        });

        function togglePassword(fieldId, button) {
            const input = document.getElementById(fieldId);
            const visible = input.type === 'text';
            input.type = visible ? 'password' : 'text';
            button.textContent = visible ? 'Show' : 'Hide';
            button.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');
        }
    </script>
</body>

</html>

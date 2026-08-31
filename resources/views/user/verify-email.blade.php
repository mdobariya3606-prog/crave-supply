<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify email — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .card .form-group .otp-boxes {
            display: flex;
            gap: 6px;
            margin-bottom: 8px;
        }

        .card .form-group input.otp-box {
            box-sizing: border-box;
            flex: 0 0 34px;
            width: 34px !important;
            height: 38px !important;
            margin: 0;
            padding: 0 !important;
            border: 1px solid #cbd5e1;
            border-radius: 7px !important;
            text-align: center;
            font-size: 16px;
            font-weight: 700;
        }

        .card .form-group input.otp-box:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .14);
        }

        .card .form-group.has-error input.otp-box {
            border-color: #f87171;
            background: #fffafa;
        }

        @media (max-width:420px) {
            .card .form-group .otp-boxes {
                gap: 4px;
            }

            .card .form-group input.otp-box {
                flex-basis: 30px;
                width: 30px !important;
                height: 34px !important;
            }
        }
    </style>
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
            @if ($errors->has('otp'))<div class="alert-error" role="alert">{{ $errors->first('otp') }}</div>@endif
            <form action="{{ route('register.verify') }}" method="POST">
                @csrf
                <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                    <label for="otp">Verification code</label>
                    <div class="otp-boxes" role="group" aria-label="Six-digit verification code">
                        @for ($i = 0; $i < 6; $i++)
                            <input class="otp-box" type="text" inputmode="numeric" maxlength="1" autocomplete="one-time-code"
                            aria-label="Digit {{ $i + 1 }}" data-otp-digit>
                            @endfor
                    </div>
                    <input id="otp" name="otp" type="hidden" required>
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
    <script>
        (() => {
            const form = document.querySelector('form[action="{{ route('register.verify') }}"]');
            const boxes = [...document.querySelectorAll('[data-otp-digit]')];
            const hidden = document.getElementById('otp');
            if (!form || boxes.length !== 6 || !hidden) return;

            const sync = () => {
                hidden.value = boxes.map(box => box.value).join('');
            };
            boxes.forEach((box, index) => {
                box.addEventListener('input', () => {
                    box.value = box.value.replace(/\D/g, '').slice(-1);
                    sync();
                    if (box.value && boxes[index + 1]) boxes[index + 1].focus();
                });
                box.addEventListener('keydown', event => {
                    if (event.key === 'Backspace' && !box.value && boxes[index - 1]) boxes[index - 1].focus();
                });
                box.addEventListener('paste', event => {
                    event.preventDefault();
                    const digits = (event.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, 6);
                    digits.split('').forEach((digit, offset) => {
                        if (boxes[index + offset]) boxes[index + offset].value = digit;
                    });
                    sync();
                    boxes[Math.min(index + digits.length, 5)].focus();
                });
            });
            form.addEventListener('submit', sync);
        })();
    </script>
</body>

</html>

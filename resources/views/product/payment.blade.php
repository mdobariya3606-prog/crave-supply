<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment details — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        .payment-page {
            width: min(620px, calc(100% - 40px));
            margin: auto;
            padding: 48px 0 72px;
        }

        .payment-card {
            padding: 30px;
            border: 1px solid #ded4c8;
            border-radius: 36px;
            background: #fffdf9;
        }

        h1 {
            margin: 0 0 8px;
            color: #133458;
            font-size: 32px;
            letter-spacing: -.05em;
        }

        .intro,
        .notice {
            color: #64748b;
            font-size: 13px;
        }

        .notice {
            margin: 18px 0;
            padding: 12px;
            border-radius: 9px;
            background: #eff6ff;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            color: #133458;
            font-size: 13px;
            font-weight: 700;
        }

        .field {
            margin: 0;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font: inherit;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .payment-card button {
            width: 100%;
            margin-top: 22px;
            padding: 13px;
            border: 0;
            border-radius: 10px;
            color: #fff;
            background: #133458;
            font: inherit;
            font-weight: 800;
            cursor: pointer;
        }

        .error {
            display: block;
            margin-top: 5px;
            color: #991b1b;
            font-size: 12px;
        }

        html[data-theme="dark"] .payment-card {
            border-color: #5c5147;
            background: #2c2722;
        }

        html[data-theme="dark"] h1,
        html[data-theme="dark"] label {
            color: #dbeafe;
        }

        html[data-theme="dark"] .intro {
            color: #cbd5e1;
        }

        html[data-theme="dark"] .notice {
            color: #dbeafe;
            background: #1e3a5f;
        }

        html[data-theme="dark"] input {
            border-color: #64748b;
            color: #f8fafc;
            background: #1e293b;
        }

        html[data-theme="dark"] input::placeholder {
            color: #9d9fa0;
        }

        html[data-theme="dark"] input:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, .18);
        }

        html[data-theme="dark"] .error {
            color: #fca5a5;
        }

        @media (max-width: 520px) {
            .payment-page {
                width: calc(100% - 28px);
                padding-top: 30px;
            }

            .payment-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="payment-page">
        <div class="payment-card">
            <h1>Payment details</h1>
            <p class="intro">Enter dummy payment details to continue. No payment will be processed.</p>
            <p class="notice">Total due: <strong>₹{{ number_format($subtotal + $delivery, 2) }}</strong></p>
            <form id="payment-form" class="form-group" action="{{ route('orders.payment.submit') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" name="delivery_address" value="{{ $deliveryAddress }}" />
                <div class="field">
                    <label for="card_name">Name on card</label>
                    <input id="card_name" name="card_name" value="{{ old('card_name') }}" placeholder="Alex Example" autocomplete="cc-name" />
                    @error('card_name') <small class="error">{{ $message }}</small> @enderror
                </div>
                <div class="field">
                    <label for="card_number">Card number</label>
                    <input id="card_number" name="card_number" inputmode="numeric" maxlength="19" placeholder="4242 4242 4242 4242" autocomplete="cc-number" />
                    @error('card_number') <small class="error">{{ $message }}</small> @enderror
                </div>
                <div class="row">
                    <div><label for="expiry">Expiry</label><input id="expiry" name="expiry" placeholder="12/30" maxlength="5" inputmode="numeric" /> @error('expiry') <small class="error">{{ $message }}</small> @enderror</div>
                    <div><label for="cvv">CVV</label><input id="cvv" name="cvv" inputmode="numeric" maxlength="4" placeholder="123" autocomplete="cc-csc" /> @error('cvv') <small class="error">{{ $message }}</small> @enderror</div>
                </div>
                <button type="submit">Complete order</button>
            </form>
        </div>
    </main>
    @include('layouts.footer')
    <script>
        document.getElementById('payment-form').addEventListener('submit', function(event) {
            const form = event.currentTarget;
            const fields = {
                card_name: [value => value.length > 1, 'Please enter the name on your card.'],
                card_number: [value => /^\d{16}$/.test(value.replace(/\s/g, '')), 'Please enter a valid 16-digit card number.'],
                expiry: [value => {
                    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(value)) return false;
                    const [month, year] = value.split('/').map(Number);
                    const now = new Date();
                    return year > now.getFullYear() % 100 || (year === now.getFullYear() % 100 && month >= now.getMonth() + 1);
                }, 'Enter a valid future expiry date in MM/YY format.'],
                cvv: [value => /^\d{3,4}$/.test(value), 'Please enter a valid 3 or 4-digit CVV.']
            };
            let valid = true;

            Object.entries(fields).forEach(([name, [check, message]]) => {
                const input = form.elements[name];
                const oldError = input.parentElement.querySelector('.js-error');
                if (oldError) oldError.remove();
                input.style.borderColor = '';
                if (!check(input.value.trim())) {
                    valid = false;
                    input.style.borderColor = '#991b1b';
                    const error = document.createElement('small');
                    error.className = 'error js-error';
                    error.textContent = message;
                    input.parentElement.appendChild(error);
                }
            });

            if (!valid) {
                event.preventDefault();
                form.querySelector('.js-error').previousElementSibling.focus();
            }
        });

        document.getElementById('expiry').addEventListener('input', function() {
            const digits = this.value.replace(/\D/g, '').slice(0, 4);
            this.value = digits.length > 2 ? digits.slice(0, 2) + '/' + digits.slice(2) : digits;
        });

        document.getElementById('card_number').addEventListener('input', function() {
            const digits = this.value.replace(/\D/g, '').slice(0, 16);
            this.value = digits.replace(/(\d{4})(?=\d)/g, '$1 ');
        });
    </script>
</body>

</html>

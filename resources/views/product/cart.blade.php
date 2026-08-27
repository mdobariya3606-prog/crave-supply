<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your cart — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <style>
        body {
            color: #1e293b;
            background: #f1f5f9;
            font-family: Inter, sans-serif;
        }

        .cart-page {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            padding: 52px 0 80px;
        }

        .cart-header {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 26px;
        }

        .cart-kicker {
            margin: 0 0 8px;
            color: #3b82f6;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .cart-header h1 {
            margin: 0;
            color: #133458;
            font-size: clamp(30px, 4vw, 42px);
            letter-spacing: -.06em;
        }

        .cart-header p {
            margin: 9px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .continue-shopping {
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            color: #133458;
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .continue-shopping:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 22px;
            align-items: start;
        }

        html[data-theme='dark'] .cart-card {
            border: 1px solid #4a4037;
            background: #2c2722;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .06);
        }

        .cart-card {
            padding: 8px 24px 24px;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .06);
        }

        .cart-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto auto;
            gap: 24px;
            align-items: center;
            padding: 18px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .cart-row:last-child {
            border-bottom: 0;
        }

        .cart-product {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .cart-product-image {
            width: 72px;
            height: 72px;
            flex: 0 0 72px;
            overflow: hidden;
            border-radius: 12px;
            background: #eef4f8;
        }

        .cart-product-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .cart-name {
            color: #1e293b;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .cart-name:hover {
            color: #3b82f6;
        }

        .cart-price {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
        }

        .cart-quantity {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .cart-stepper {
            display: flex;
            align-items: center;
            overflow: hidden;
            border: 1px solid #000;
            border-radius: 18px;
            background: transparent;
        }

        .cart-stepper button {
            width: 28px;
            height: 28px;
            border: 0;
            color: #133458;
            background: #fff;
            font-size: 18px;
            line-height: 1;
            cursor: pointer;
        }

        .cart-stepper button:hover {
            background: #fef9c3;
        }

        .cart-quantity input {
            width: 58px;
            padding: 9px 6px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            color: #1e293b;
            text-align: center;
        }

        .cart-stepper input {
            width: 34px;
            padding: 5px 0;
            border: 0;
            text-align: center;
        }

        .cart-stepper input:focus {
            outline: 0;
        }

        .cart-quantity input:focus {
            outline: 3px solid rgba(59, 130, 246, .18);
            border-color: #3b82f6;
        }

        .cart-button {
            display: none;
        }

        .cart-button:hover {
            background: #0f2946;
        }

        .cart-remove {
            border: 0;
            color: #991b1b;
            background: transparent;
            font-size: 12px;
            cursor: pointer;
        }

        .cart-remove:hover {
            text-decoration: underline;
        }

        .cart-footer {
            display: none;
        }

        .cart-total-label {
            color: #64748b;
            font-size: 12px;
        }

        .cart-total {
            color: #133458;
            font-size: 22px;
            font-weight: 800;
        }

        .cart-clear {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 12px;
            border: 1px solid #dc8b82 !important;
            border-radius: 8px;
            color: #991b1b !important;
            background: #fff !important;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .cart-clear:hover {
            color: #991b1b !important;
            background: #fef2f2 !important;
        }

        .cart-alert {
            margin-bottom: 16px;
            padding: 11px 13px;
            border-radius: 9px;
            color: #166534;
            background: #f0fdf4;
            font-size: 12px;
        }

        .cart-error {
            margin-top: 8px;
            color: #991b1b;
            font-size: 12px;
        }

        .cart-empty {
            padding: 58px 20px;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            color: #64748b;
            background: #fff;
            text-align: center;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .04);
        }

        html[data-theme='dark'] .cart-empty,
        html[data-theme='dark'] .continue-shopping {
            color: #cdbfb1;
            background: #4a4037;
        }

        .cart-empty a {
            color: #133458;
            font-weight: 700;
        }

        .cart-summary {
            position: sticky;
            top: 92px;
            padding: 22px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
        }

        .cart-summary h2 {
            margin: 0 0 18px;
            color: #133458;
            font-size: 18px;
        }

        .delivery-note {
            margin: 0 0 18px;
            color: #166534;
            font-size: 12px;
            line-height: 1.45;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin: 10px 0;
            color: #475569;
            font-size: 13px;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            color: #133458;
            font-size: 18px;
            font-weight: 800;
        }

        .checkout {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .cart-checkout {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            border: 0;
            border-radius: 20px;
            color: #133458;
            background: #facc15;
            font-weight: 800;
            cursor: pointer;
        }

        .cart-checkout:hover {
            background: #eab308;
        }

        @media(max-width:760px) {
            .cart-page {
                width: calc(100% - 28px);
                padding-top: 30px
            }

            .cart-header {
                align-items: flex-start;
                flex-direction: column
            }

            .cart-layout {
                grid-template-columns: 1fr
            }

            .cart-summary {
                position: static;
                order: -1
            }

            .cart-row {
                grid-template-columns: 1fr auto;
                gap: 14px
            }

            .cart-quantity {
                grid-column: 1
            }

            .cart-row>form:last-child {
                grid-column: 2;
                grid-row: 2
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="cart-page">
        <div class="cart-header">
            <div>
                <p class="cart-kicker">Your selection</p>
                <h1>Your cart</h1>
                <p>Review and adjust your products before placing an order.</p>
            </div><a class="continue-shopping" href="{{ route('products.dashboard') }}">Continue shopping</a>
        </div>
        @if(session('success'))
        <div class="cart-alert" role="status">{{ session('success') }}</div>@endif
        @if(empty($cart))
        <div class="cart-empty">Your cart is empty. <a href="{{ route('products.dashboard') }}">Browse products</a>.
        </div>
        @else
        <div class="cart-layout">
            <section class="cart-card" aria-label="Cart items">
                @foreach($cart as $item)
                <div class="cart-row" data-cart-row data-price="{{ $item['current_price'] ?? $item['price'] }}">
                    <div class="cart-product">
                        <div class="cart-product-image">
                            <img src="{{ !empty($item['image_path']) ? asset('storage/' . $item['image_path']) : asset('images/product-placeholder.svg') }}"
                                alt="{{ $item['name'] }}">
                        </div>
                        <div><a class="cart-name"
                                href="{{ route('products.profile', $item['slug'] ?? $item['product_id']) }}">{{ $item['name'] }}</a><span
                                class="cart-price">₹{{ number_format($item['current_price'] ?? $item['price'], 2) }}
                                each</span></div>
                    </div>
                    <form class="cart-quantity"
                        action="{{ route('cart.update', $item['slug'] ?? $item['product_id']) }}" method="POST">
                        @csrf @method('PUT')
                        <label class="sr-only" for="quantity-{{ $item['product_id'] }}" style="margin-right: 10px;">Quantity</label>
                        <div class="cart-stepper">
                            <button type="button" data-step="-1" aria-label="Decrease quantity">−</button>
                            <input id="quantity-{{ $item['product_id'] }}" name="quantity" type="number" min="1"
                                value="{{ $item['quantity'] }}" data-quantity>
                            <button type="button" data-step="1" aria-label="Increase quantity">+</button>
                        </div>
                        <button class="cart-button" type="submit">Update</button>
                        @error('quantity', 'cart')<span class="cart-error" role="alert">{{ $message }}</span>@enderror
                    </form>
                    <form action="{{ route('cart.remove', $item['slug'] ?? $item['product_id']) }}" method="POST"><input
                            type="hidden" name="_token" value="{{ csrf_token() }}"> @method('DELETE')<button
                            class="cart-remove" type="submit">Remove</button></form>
                    <strong
                        data-line-total>₹{{ number_format(($item['current_price'] ?? $item['price']) * $item['quantity'], 2) }}</strong>
                </div>
                @endforeach
            </section>
            <aside class="cart-summary" aria-label="Order summary">
                <h2>Order summary</h2>
                <p class="delivery-note" data-delivery-note>
                    {{ $total >= 2000 ? '✓ Your order is eligible for free delivery.' : 'Add ₹' . number_format(2000 - $total, 2) . ' worth more products for free delivery.' }}
                </p>
                <div class="summary-line"><span>Subtotal</span><strong
                        data-cart-subtotal>₹{{ number_format($total, 2) }}</strong></div>
                <div class="summary-line"><span>Delivery</span><strong
                        data-delivery>{{ $total >= 2000 ? 'FREE' : '₹100.00' }}</strong></div>
                <div class="summary-total"><span>Total</span><strong
                        data-cart-total>₹{{ number_format($total + ($total >= 2000 ? 0 : 100), 2) }}</strong></div>
                @auth
                <form action="{{ route('cart.review') }}" method="GET">
                    <button class="cart-checkout" type="submit">Review order</button>
                </form>
                @else
                <div class="checkout">
                    <a class="cart-checkout" style="display:block;text-align:center;text-decoration:none"
                        href="{{ route('login') }}">Log in to submit order</a>
                </div>
                @endauth
                <form action="{{ route('cart.clear') }}" method="POST" style="margin-top:12px;text-align:center">
                    @csrf @method('DELETE')
                    <button class="cart-clear" type="submit">Clear cart</button>
                </form>
            </aside>
        </div>
        @endif
    </main>
    @include('layouts.footer')
    @if(!empty($cart))
    <script>
        (() => {
            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            const money = value => '₹' + value.toLocaleString('en-IN', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            const sync = (form, quantity) => {
                const body = new FormData(form);
                body.set('quantity', quantity);
                fetch(form.action, {
                    method: 'POST',
                    body,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrf
                    }
                }).catch(() => {});
            };
            const refresh = (input) => {
                const row = input.closest('[data-cart-row]');
                const quantity = Math.max(1, parseInt(input.value || '1', 10));
                input.value = quantity;
                const subtotal = Number(row.dataset.price) * quantity;
                row.querySelector('[data-line-total]').textContent = money(subtotal);
                let total = 0;
                document.querySelectorAll('[data-cart-row]').forEach(item => total += Number(item.dataset.price) * Number(item.querySelector('[data-quantity]').value));
                document.querySelector('[data-cart-subtotal]').textContent = money(total);
                const deliveryNote = document.querySelector('[data-delivery-note]');
                const delivery = document.querySelector('[data-delivery]');
                let deliveryCost = 100;
                if (total >= 2000) {
                    deliveryNote.textContent = '✓ Your order is eligible for free delivery.';
                    delivery.textContent = 'FREE';
                    deliveryCost = 0;
                } else {
                    deliveryNote.textContent = 'Add ' + money(2000 - total) + ' more for free delivery.';
                    delivery.textContent = money(100);
                }
                document.querySelector('[data-cart-total]').textContent = money(total + deliveryCost);
                sync(row.querySelector('.cart-quantity'), quantity);
            };
            document.querySelectorAll('[data-cart-row]').forEach(row => {
                const input = row.querySelector('[data-quantity]');
                row.querySelectorAll('[data-step]').forEach(button => button.addEventListener('click', () => {
                    input.value = Math.max(1, Number(input.value) + Number(button.dataset.step));
                    refresh(input);
                }));
                input.addEventListener('change', () => refresh(input));
            });
        })();
    </script>
    @endif
</body>

</html>
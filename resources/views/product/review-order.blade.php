<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Review order — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <style>
        body {
            margin: 0;
            color: #1e293b;
            background: #f1f5f9;
            font-family: Inter, sans-serif;
        }

        .review-page {
            width: min(980px, calc(100% - 40px));
            margin: auto;
            padding: 48px 0 72px;
        }

        .review-page h1 {
            margin: 0;
            color: #133458;
            font-size: 34px;
            letter-spacing: -0.05em;
        }

        .review-page > p {
            margin: 9px 0 24px;
            color: #64748b;
            font-size: 14px;
        }

        .review-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 290px;
            gap: 20px;
            align-items: start;
        }

        .review-card,
        .review-summary {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.05);
        }

        html[data-theme="dark"] .review-summary {
            background: #2c2722;
        }

        .review-card {
            padding: 8px 20px;
        }

        .review-item {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 17px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .review-item:last-child {
            border: 0;
        }

        .review-item strong {
            display: block;
            font-size: 14px;
        }

        .review-item span {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
        }

        .review-item-price {
            color: #133458;
            font-size: 14px;
            font-weight: 800;
            white-space: nowrap;
        }

        html[data-theme="dark"] .review-item-price {
            color: #9bcfff;
        }

        .review-summary {
            position: sticky;
            top: 92px;
            padding: 22px;
        }

        .review-summary h2 {
            margin: 0 0 18px;
            color: #133458;
            font-size: 18px;
        }

        .summary-line,
        .summary-total {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin: 12px 0;
            color: #475569;
            font-size: 13px;
        }

        .summary-total {
            margin-top: 18px;
            padding-top: 17px;
            border-top: 1px solid #e2e8f0;
            color: #133458;
            font-size: 18px;
            font-weight: 800;
        }

        .submit-order {
            width: 100%;
            margin-top: 18px;
            padding: 13px;
            border: 0;
            border-radius: 10px;
            color: #fff;
            background: #133458;
            font: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
        }

        .submit-order:hover {
            background: #0f2946;
        }

        .delivery-address {
            width: 100%;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
        }

        .delivery-address label {
            display: block;
            margin-bottom: 7px;
            color: #133458;
            font-size: 13px;
            font-weight: 700;
        }

        .delivery-address textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            min-height: 96px;
            padding: 12px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            color: #1e293b;
            background: #f8fafc;
            font: inherit;
            font-size: 13px;
            line-height: 1.5;
            resize: vertical;
            transition:
                border-color 0.2s,
                box-shadow 0.2s,
                background 0.2s;
        }

        .review-summary > form {
            width: 100%;
        }

        .delivery-address textarea:focus {
            outline: none;
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.14);
        }

        .delivery-address .error {
            display: block;
            margin-top: 6px;
            color: #991b1b;
            font-size: 12px;
        }

        html[data-theme="dark"] .delivery-address {
            border-color: #475569;
        }

        html[data-theme="dark"] .delivery-address label {
            color: #dbeafe;
        }

        html[data-theme="dark"] .delivery-address textarea {
            border-color: #64748b;
            color: #f8fafc;
            background: #1e293b;
        }

        html[data-theme="dark"] .delivery-address textarea:focus {
            background: #273449;
        }

        .back-link {
            display: inline-block;
            margin-top: 16px;
            color: #3b82f6;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        @media (max-width: 720px) {
            .review-page {
                width: calc(100% - 28px);
                padding-top: 30px;
            }

            .review-layout {
                grid-template-columns: 1fr;
            }

            .review-summary {
                position: static;
                order: -1;
            }
        }
    </style>
</head>

<body>
    @include ('layouts.header')
    <main class="review-page">
        <h1>Review your order</h1>
        <p>Check your products and quantities, then submit your order. No payment is required.</p>
        @if ($errors->has('cart'))
            <p style="
                    padding: 12px;
                    border-radius: 9px;
                    color: #991b1b !important;
                    background: #fef2f2;
                ">{{ $errors->first('cart') }}</p>
        @endif
        <div class="review-layout">
            <section class="review-card" aria-label="Order items">
                @foreach ($items as $item)
                    <div class="review-item">
                        <div>
                            <strong>{{ $item['product']->name }}</strong
                            ><span
                                >Quantity: {{ $item['quantity'] }} × ₹{{ number_format($item['unitPrice'], 2) }}</span
                            >
                        </div>
                        <div class="review-item-price">
                            ₹{{ number_format($item['unitPrice'] * $item['quantity'], 2) }}
                        </div>
                    </div>
                @endforeach
            </section>
            <aside class="review-summary">
                <h2>Order summary</h2>
                <div class="summary-line">
                    <span>Subtotal</span
                    ><strong>₹{{ number_format($subtotal, 2) }}</strong>
                </div>
                <div class="summary-line">
                    <span>Delivery</span
                    ><strong
                        >{{ $delivery ? '₹'.number_format($delivery, 2) : 'FREE' }}</strong
                    >
                </div>
                <div class="summary-total">
                    <span>Total</span
                    ><strong
                        >₹{{ number_format($subtotal + $delivery, 2) }}</strong
                    >
                </div>
                <form action="{{ route('cart.submit') }}" method="POST">
                    @csrf
                    <div class="delivery-address">
                        <label for="delivery_address">Delivery address</label>
                        <textarea
                            id="delivery_address"
                            name="delivery_address"
                            maxlength="255"
                            required
                            placeholder="Enter your delivery address"
                            >{{ old('delivery_address', auth()->user()->business_address) }}</textarea
                        >
                        @error ('delivery_address')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="submit-order" type="submit">
                        Submit order
                    </button>
                </form>
                <a class="back-link" href="{{ route('cart.index') }}"
                    >← Back to cart</a
                >
            </aside>
        </div>
    </main>
    @include ('layouts.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order {{ $order->order_number }} — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <style>
        body {
            margin: 0;
            color: #1e293b;
            background: #f1f5f9;
            font-family: Inter, sans-serif;
        }

        .confirmation {
            width: min(760px, calc(100% - 40px));
            margin: auto;
            padding: 52px 0 76px;
        }

        .confirmation-card {
            padding: 32px;
            border: 1px solid #bbf7d0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        }

        .success-mark {
            display: grid;
            width: 48px;
            height: 48px;
            place-items: center;
            border-radius: 50%;
            color: #166534;
            background: #dcfce7;
            font-size: 24px;
        }

        h1 {
            margin: 18px 0 8px;
            color: #133458;
            font-size: 32px;
            letter-spacing: -0.05em;
        }

        p {
            color: #64748b;
            line-height: 1.6;
        }

        .order-number {
            margin: 20px 0;
            padding: 15px;
            border-radius: 10px;
            color: #133458;
            background: #eff6ff;
            font-size: 14px;
            font-weight: 800;
        }

        .order-list {
            margin: 22px 0;
            padding: 0;
            list-style: none;
        }

        .order-list li {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 99px;
            color: #166534;
            background: #dcfce7;
            font-size: 11px;
            font-weight: 800;
        }

        .tracking {
            margin: 26px 0 12px;
            padding: 20px 18px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #f8fafc;
        }

        .tracking-header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
            color: #133458;
            font-size: 13px;
            font-weight: 700;
        }

        .track-progress {
            position: relative;
            height: 10px;
            overflow: hidden;
            border-radius: 999px;
            background: #e2e8f0;
        }

        @keyframes fillProgress {
            from {
                width: 0;
            }

            to {
                width: var(--progress, 0%);
            }
        }

        .track-progress-bar {
            position: absolute;
            inset: 0 auto 0 0;
            width: 0;
            border-radius: inherit;
            background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%);
            animation: fillProgress 1.1s ease-out forwards;
        }

        .track-steps {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 8px;
            margin-top: 14px;
        }

        .track-step {
            padding-top: 10px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-align: center;
            text-transform: capitalize;
        }

        .track-step.active {
            color: #166534;
        }

        .track-step.complete {
            color: #0f766e;
        }

        .track-step .dot {
            display: block;
            width: 10px;
            height: 10px;
            margin: 0 auto 8px;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            background: #fff;
        }

        .track-step.active .dot,
        .track-step.complete .dot {
            border-color: #22c55e;
            background: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.15);
        }

        .button {
            display: inline-block;
            margin-top: 14px;
            padding: 11px 14px;
            border-radius: 9px;
            color: #fff;
            background: #133458;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }
    </style>
</head>

<body>
    @include ('layouts.header')
    <main class="confirmation">
        <section class="confirmation-card">
            <div class="success-mark">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    style="width: 25px; height: 25px; color: #22c55e">
                    <path
                        d="M5 12.5L9.5 17L19 7"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="square"
                        stroke-linejoin="miter" />
                </svg>
            </div>
            <h1>Order submitted successfully</h1>
            <p>Thank you. Your order has been received and is now visible to our team.</p>
            <div class="order-number">
                Order number: {{ $order->order_number }}
            </div>
            <p>Current status: <span class="status">{{ ucwords(str_replace('_', ' ', $order->status->value)) }}</span></p>

            @php
            $trackingSteps = \App\Enums\OrderStatus::trackingSteps();
            $currentIndex = array_search($order->status->value, array_map(fn ($step) => $step->value, $trackingSteps), true);
            $trackingProgress = $order->status->progressPercentage();
            @endphp

            <div class="tracking" aria-label="Order tracking progress">
                <div class="tracking-header">
                    <span>Order tracking</span>
                    <span>{{ $trackingProgress }}%</span>
                </div>
                <div class="track-progress" aria-hidden="true">
                    <div class="track-progress-bar" style="--progress: {{ $trackingProgress }}%;"></div>
                </div>
                <div class="track-steps">
                    @foreach ($trackingSteps as $step)
                    @php
                    $stepIndex = array_search($step, $trackingSteps, true);
                    $stepClass = 'pending';
                    if ($currentIndex !== false && $stepIndex < $currentIndex) {
                        $stepClass='complete' ;
                        } elseif ($step===$order->status) {
                        $stepClass = 'active';
                        }
                        @endphp
                        <div class="track-step {{ $stepClass }}">
                            <span class="dot"></span>
                            {{ str_replace('_', ' ', $step->value) }}
                        </div>
                        @endforeach
                </div>
            </div>

            <p class="delivery-address"><strong>Delivery address:</strong><br />{{ $order->delivery_address ?: '—' }}</p>
            <ul class="order-list">
                @foreach ($order->orderItems as $item)
                <li>
                    <span>{{ $item->product_name }} × {{ $item->quantity }}</span><strong>₹{{ number_format($item->unit_price * $item->quantity, 2) }}</strong>
                </li>
                @endforeach
            </ul>
            <p><strong>Total:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
            <a class="button" href="{{ route('orders.bill', $order) }}">Download bill (PDF)</a>
            <a class="button" href="{{ route('orders.index') }}">View my orders</a>
        </section>
    </main>
    @include ('layouts.footer')
</body>

</html>
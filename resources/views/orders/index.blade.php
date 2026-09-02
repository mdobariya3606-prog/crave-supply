<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My orders — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <style>
        body {
            margin: 0;
            color: #1e293b;
            background: #f6f8fb;
            font-family: Inter, sans-serif;
        }

        .orders-page {
            width: min(960px, calc(100% - 40px));
            margin: auto;
            padding: 52px 0 76px;
        }

        .orders-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            color: #133458;
            font-size: 36px;
            letter-spacing: -0.055em;
        }

        .orders-heading p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .orders-list {
            display: grid;
            gap: 16px;
        }

        .order-card {
            padding: 22px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.05);
        }

        .order-card-header {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #eef2f7;
        }

        .order-number {
            display: block;
            color: #133458;
            font-size: 15px;
            font-weight: 800;
        }

        .order-date {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
        }

        .status {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 999px;
            color: #166534;
            background: #dcfce7;
            font-size: 11px;
            font-weight: 800;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .mini-tracker {
            margin: 16px 0 10px;
            padding-top: 8px;
        }

        .mini-tracker-progress {
            position: relative;
            height: 8px;
            overflow: hidden;
            border-radius: 999px;
            background: #e2e8f0;
        }
        html[data-theme="dark"] .mini-tracker-progress {
            background: #475569;

        }

        @keyframes fillMiniProgress {
            from {
                width: 0;
            }

            to {
                width: var(--mini-progress, 0%);
            }
        }

        .mini-tracker-progress>span {
            position: absolute;
            inset: 0 auto 0 0;
            display: block;
            width: 0;
            border-radius: inherit;
            background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%);
            animation: fillMiniProgress 1s ease-out forwards;
        }

        .mini-tracker-label {
            display: flex;
            justify-content: space-between;
            margin-top: 6px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .order-items {
            margin: 0;
            padding: 15px 0 4px;
            list-style: none;
        }

        .order-items li {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 7px 0;
            color: #475569;
            font-size: 13px;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            padding-top: 14px;
            border-top: 1px solid #eef2f7;
            color: #133458;
            font-size: 14px;
        }

        .order-link {
            display: inline-block;
            margin-top: 14px;
            color: #2563eb;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .pagination {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        .pagination nav {
            display: flex;
            gap: 5px;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            min-width: 34px;
            height: 34px;
            align-items: center;
            justify-content: center;
            padding: 0 9px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #334155;
            background: #fff;
            font-size: 12px;
            text-decoration: none;
        }

        .pagination [aria-current="page"] span {
            color: #fff;
            border-color: #133458;
            background: #133458;
        }

        .empty-orders {
            padding: 46px 24px;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            color: #64748b;
            background: #fff;
            text-align: center;
        }

        @media (max-width: 600px) {
            .orders-page {
                width: calc(100% - 28px);
                padding-top: 32px;
            }

            .orders-heading,
            .order-card-header {
                display: block;
            }

            .status {
                margin-top: 14px;
            }
        }
    </style>
</head>

<body>
    @include ('layouts.header')
    <main class="orders-page">
        <div class="orders-heading">
            <div>
                <h1>My orders</h1>
                <p>Track your snack orders and view what you’ve purchased.</p>
            </div>
            <a class="order-link" href="{{ route('products.dashboard') }}">Continue shopping →</a>
        </div>
        @if ($orders->isEmpty())
        <div class="empty-orders">
            You haven’t placed an order yet. Browse our snack range to get
            started.
        </div>
        @else
        <div class="orders-list">
            @foreach ($orders as $order)
            <article class="order-card">
                <div class="order-card-header">
                    <div>
                        <span
                            class="order-number">{{ $order->order_number }}</span><span
                            class="order-date">{{ $order->created_at->format('M j, Y · g:i A') }}</span>
                    </div>
                    <span
                        class="status">{{ str_replace('_', ' ', $order->status->value) }}</span>
                </div>
                <div class="mini-tracker" aria-label="Order tracking progress">
                    @php
                    $progress = $order->status->progressPercentage();
                    @endphp
                    <div class="mini-tracker-progress">
                        <span style="--mini-progress: {{ $progress }}%;"></span>
                    </div>
                    <div class="mini-tracker-label">
                        <span>{{ str_replace('_', ' ', $order->status->value) }}</span>
                        <span>{{ $progress }}%</span>
                    </div>
                </div>
                <ul class="order-items">
                    @foreach ($order->orderItems as $item)
                    <li>
                        <span>{{ $item->product_name }} × {{ $item->quantity }}</span><strong>₹{{ number_format($item->unit_price * $item->quantity, 2) }}</strong>
                    </li>
                    @endforeach
                </ul>
                <div class="order-total">
                    <span>Total</span><strong>₹{{ number_format($order->total_amount, 2) }}</strong>
                </div>
                <a
                    class="order-link"
                    href="{{ route('orders.confirmation', $order) }}">View order details →</a>
                <a
                    class="order-link"
                    href="{{ route('orders.bill', $order) }}">Download bill (PDF) ↓</a>
            </article>
            @endforeach
        </div>
        @if ($orders->hasPages())
        <div class="pagination">{{ $orders->links() }}</div>
        @endif
        @endif
    </main>
    @include ('layouts.footer')
</body>

</html>

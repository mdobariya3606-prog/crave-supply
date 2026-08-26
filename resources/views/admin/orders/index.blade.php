<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <style>
        body {
            margin: 0;
            color: #1e293b;
            background: #f1f5f9;
            font-family: Inter, sans-serif;
        }

        .admin-orders {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            padding: 48px 0 72px;
        }

        h1 {
            margin: 0;
            color: #133458;
            font-size: 34px;
            letter-spacing: -.05em;
        }

        .intro {
            margin: 8px 0 24px;
            color: #64748b;
        }

        .notice {
            margin-bottom: 16px;
            padding: 11px 13px;
            border-radius: 9px;
            color: #166534;
            background: #f0fdf4;
            font-size: 13px;
        }

        .error-notice {
            margin-bottom: 16px;
            padding: 11px 13px;
            border-radius: 9px;
            color: #991b1b;
            background: #fef2f2;
            font-size: 13px;
        }

        .orders-table-wrap {
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(15, 23, 42, .05);
        }

        table {
            width: 100%;
            min-width: 880px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 16px;
            border-bottom: 1px solid #f1f5f9;
            text-align: left;
            font-size: 13px;
            vertical-align: top;
        }

        th {
            color: #64748b;
            background: #f8fafc;
            font-size: 11px;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .download-link {
            display: inline-block;
            margin-top: 8px;
            color: #2563eb !important;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        html[data-theme="dark"] .download-link {
            color: #60A5FA !important;
        }

        html[data-theme="dark"] th {
            color: #f8fafc !important;
            background-color: #64748b;
        }

        html[data-theme="dark"] li,
        html[data-theme="dark"] .total,
        html[data-theme="dark"] .history,
        html[data-theme="dark"] input::placeholder {
            color: #f8fafc;
        }

        .order-table a {
            color: #8d6c4a;
            font-weight: 700;
            text-decoration: none;
        }

        .item-list {
            margin: 0;
            padding-left: 16px;
            color: #475569;
            font-size: 12px;
            line-height: 1.6;
        }

        .status-form {
            display: flex;
            gap: 7px;
        }

        .order-filters {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .order-filters input,
        .order-filters select {
            min-height: 38px;
            padding: 0 11px;
            border: 1px solid #ded4c8;
            background: #fffdf9;
        }

        .order-filters button {
            padding: 0 15px;
            border: 0;
            color: #fff;
            background: #2c2722;
            cursor: pointer;
        }

        select,
        button {
            padding: 8px 9px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            font: inherit;
            font-size: 12px;
        }

        .btn-save {
            border: 0;
            color: #fff;
            background: #133458;
            font-weight: 700;
            cursor: pointer;
        }

        details {
            margin-top: 8px;
            color: #64748b;
            font-size: 12px;
        }

        summary {
            cursor: pointer;
        }

        .history {
            margin: 8px 0 0;
            padding-left: 16px;
            line-height: 1.6;
        }

        @media(max-width:600px) {
            .admin-orders {
                width: calc(100% - 28px);
                padding-top: 30px
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="admin-orders">
        <h1>Orders</h1>
        <p class="intro">Review new customer orders and update their fulfilment status.</p>
        @if(session('success'))
        <div class="notice">{{ session('success') }}</div>@endif
        @if($errors->any())
        <div class="error-notice">{{ $errors->first('status') }}</div>@endif
        <form class="order-filters" method="GET">
            <input name="q" value="{{ $search }}" placeholder="Search order or customer">
            <select name="status">
                <option value="">All statuses</option>@foreach($statuses as $status)
                <option value="{{ $status->value }}" @selected($selectedStatus===$status->value)>
                    {{ ucwords(str_replace('_', ' ', $status->value)) }}
                </option>@endforeach
            </select>
            <button type="submit">Filter</button>
        </form>
        <div class="orders-table-wrap">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr> {{-- Aug 24, 2026 8:11 AM --}}
                        <td><strong><a href="{{ route('orders.confirmation',$order) }}">{{ $order->order_number }}</a></strong><br><small>{{ $order->created_at->format('M j, Y g:i A') }}</small>
                        </td>
                        <td><a
                                href="{{ route('admin.customers.show', $order->user) }}">{{ $order->user?->name ?: 'Customer' }}</a><br><small>{{ $order->user?->email }}</small>
                        </td>
                        <td>
                            <ul class="item-list">@foreach($order->orderItems as $item)
                                <li>{{ $item->product_name }} × {{ $item->quantity }}</li>@endforeach
                            </ul>
                        </td>
                        <td class="total">₹{{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <form class="status-form" action="{{ route('admin.orders.status', $order) }}" method="POST">
                                @csrf @method('PUT')
                                <select name="status">
                                    <option value="{{ $order->status->value }}">
                                        {{ ucwords(str_replace('_', ' ', $order->status->value)) }}
                                    </option>
                                    @foreach($order->status->nextStatuses() as $status)
                                    <option value="{{ $status->value }}">
                                        {{ ucwords(str_replace('_', ' ', $status->value)) }}
                                    </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn-save">Save</button>
                            </form>
                            <details>
                                <summary class="history">History</summary>
                                <ul class="history">
                                    @foreach($order->orderStatusHistories->sortBy('created_at') as $history)
                                    <li>{{ $history->created_at->format('M j, g:i A') }} —
                                        {{ ucwords(str_replace('_', ' ', $history->status->value)) }}
                                    </li>@endforeach
                                </ul>
                            </details>
                            <a href="{{ route('orders.bill', $order) }}" class="download-link">Download
                                bill (PDF)</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No orders have been submitted yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div style="margin-top:20px">{{ $orders->links() }}</div>@endif
    </main>
    @include('layouts.footer')
</body>

</html>
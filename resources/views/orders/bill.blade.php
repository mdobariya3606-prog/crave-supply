<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bill {{ $order->order_number }}</title>
    <style>
        @page {
            margin: 34px 42px 48px;
        }

        body {
            margin: 0;
            color: #29251f;
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .header {
            padding-bottom: 18px;
            border-bottom: 2px solid #2c2722;
        }

        .brand {
            color: #2c2722;
            font-size: 25px;
            font-weight: bold;
            letter-spacing: -1px;
        }

        .tagline {
            margin-top: 4px;
            color: #8d6c4a;
            font-size: 9px;
            letter-spacing: 1.6px;
            text-transform: uppercase;
        }

        .document-label {
            float: right;
            margin-top: -28px;
            color: #8d8376;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.4px;
            text-align: right;
            text-transform: uppercase;
        }

        h1 {
            margin: 28px 0 6px;
            color: #29251f;
            font-size: 28px;
            font-weight: normal;
        }

        .meta {
            margin: 0;
            color: #8d8376;
            line-height: 1.8;
        }

        .summary {
            width: 100%;
            margin-top: 25px;
            border-spacing: 0;
        }

        .summary td {
            width: 50%;
            padding: 14px 16px;
            border: 1px solid #ded4c8;
            background: #f8f4ed;
            vertical-align: top;
        }

        .summary td+td {
            border-left: 0;
        }

        .summary-label {
            display: block;
            margin-bottom: 6px;
            color: #8d6c4a;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .summary-value {
            color: #29251f;
            line-height: 1.6;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
        }

        th {
            padding: 11px 9px;
            color: #fffdf9;
            background: #2c2722;
            text-align: left;
            font-size: 10px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        td {
            padding: 13px 9px;
            border-bottom: 1px solid #ded4c8;
        }

        tbody tr:nth-child(even) td {
            background: #fcfaf6;
        }

        .right {
            text-align: right;
        }

        .total {
            width: 280px;
            margin: 22px 0 0 auto;
        }

        .total div {
            display: flex;
            justify-content: space-between;
            padding: 7px 0;
            color: #71695f;
        }

        .grand-total {
            margin-top: 6px;
            padding: 12px 0 !important;
            border-top: 2px solid #2c2722;
            color: #2c2722 !important;
            font-size: 16px;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            margin-top: 22px;
            padding: 7px 12px;
            color: #49603b;
            background: #e8eddf;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .note {
            margin-top: 32px;
            padding: 14px 16px;
            color: #71695f;
            background: #f8f4ed;
            line-height: 1.6;
        }

        .footer {
            position: fixed;
            right: 0;
            bottom: -25px;
            left: 0;
            padding-top: 10px;
            border-top: 1px solid #ded4c8;
            color: #8d8376;
            text-align: center;
            font-size: 9px;
        }
    </style>
</head>

<body>
    @php($itemsSubtotal = $order->orderItems->sum(fn ($item) => $item->unit_price * $item->quantity))
    <div class="header">
        <div class="brand">CraveSupply</div>
        <div class="tagline">Better breaks, made simple</div>
        <div class="document-label">Order bill<br>{{ $order->created_at->format('M j, Y') }}</div>
    </div>
    <h1>Thank you for your order</h1>
    <p class="meta">A clear summary of your CraveSupply purchase.</p>
    <table class="summary">
        <tr>
            <td><span class="summary-label">Bill to</span><span class="summary-value">{{ $order->user?->name ?: 'Customer' }}<br>{{ $order->user?->email }}</span></td>
            <td><span class="summary-label">Order details</span><span class="summary-value"><strong>{{ $order->order_number }}</strong><br>Status: {{ ucwords(str_replace('_', ' ', $order->status->value)) }}</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="summary-label">Delivery address</span><span class="summary-value">{{ $order->delivery_address ?: '—' }}</span></td>
        </tr>
    </table>
    <table class="items">
        <thead>
            <tr>
                <th>Item</th>
                <th class="right">Qty</th>
                <th class="right">Unit price</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>@foreach($order->orderItems as $item)<tr>
                <td>{{ $item->product_name }}</td>
                <td class="right">{{ $item->quantity }}</td>
                <td class="right">₹{{ number_format($item->unit_price, 2) }}</td>
                <td class="right">₹{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
            </tr>@endforeach</tbody>
    </table>
    <div class="total">
        <div><span>Items subtotal</span><span>₹{{ number_format($itemsSubtotal, 2) }}</span></div>
        <div><span>Delivery</span><span>{{ $itemsSubtotal >= 2000 ? 'FREE' : '₹100.00' }}</span></div>
        <div class="grand-total"><span>Total</span><span>₹{{ number_format($order->total_amount, 2) }}</span></div>
    </div>
    <div class="status">{{ ucwords(str_replace('_', ' ', $order->status->value)) }}</div>
    <div class="note"><strong>Need help?</strong><br>For questions about this order, contact hello@cravesupply.test. Please keep your order number handy.</div>
    <div class="footer">CraveSupply | hello@cravesupply.test | Thank you for choosing us</div>
</body>

</html>

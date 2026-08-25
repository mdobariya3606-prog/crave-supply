<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} — Customer</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}">
    <style>
        .customer-detail {
            width: min(900px, calc(100% - 40px));
            margin: auto;
            padding: 52px 0 80px
        }

        h1,
        h2 {
            font-family: Georgia, serif;
            font-weight: 400;
            color: #29251f
        }

        h1 {
            font-size: 42px
        }

        .profile-box,
        .customer-order {
            padding: 22px;
            margin-top: 20px;
            border: 1px solid #ded4c8;
            background: #fffdf9
        }

        .profile-box p {
            color: #71695f;
            line-height: 1.7
        }

        .customer-order header {
            display: flex;
            justify-content: space-between;
            gap: 15px
        }

        .customer-order ul {
            margin: 16px 0 0;
            padding: 0;
            list-style: none
        }

        .customer-order li {
            padding: 7px 0;
            border-top: 1px solid #eee5da;
            font-size: 12px
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 18px
        }

        .actions form button,
        .actions a {
            padding: 10px 13px;
            border: 0;
            color: #fff;
            background: #2c2722;
            font-size: 12px;
            text-decoration: none;
            cursor: pointer
        }

        .actions .danger {
            background: #a04338
        }
    </style>
</head>

<body>@include('layouts.header')<main class="customer-detail">
        <h1>{{ $user->name }}</h1>
        <div class="profile-box">
            <p><strong>Email:</strong> {{ $user->email }}<br><strong>Phone:</strong> {{ $user->phone ?: '—' }}<br><strong>Business:</strong> {{ $user->business_name ?: '—' }}<br><strong>Address:</strong> {{ $user->business_address ?: '—' }}<br><strong>Account:</strong> {{ $user->is_active ? 'Active' : 'Disabled' }}</p>
            <div class="actions">
                <form method="POST" action="{{ route('admin.customers.toggle',$user) }}">@csrf @method('PATCH')<button type="submit">{{ $user->is_active ? 'Disable account' : 'Enable account' }}</button></form>
                <form method="POST" action="{{ route('admin.customers.destroy',$user) }}" onsubmit="return confirm('Delete this customer account?')">@csrf @method('DELETE')<button class="danger" type="submit">Delete account</button></form>
            </div>
        </div>
        <h2>Order history</h2>@forelse($user->orders as $order)<article class="customer-order">
            <header><strong>{{ $order->order_number }}</strong><span>{{ ucwords(str_replace('_',' ',$order->status->value)) }} · ₹{{ number_format($order->total_amount,2) }}</span></header>
            <ul>@foreach($order->orderItems as $item)<li>{{ $item->product_name }} × {{ $item->quantity }}</li>@endforeach</ul>
        </article>@empty<p>No orders found.</p>@endforelse
    </main>@include('layouts.footer')</body>

</html>
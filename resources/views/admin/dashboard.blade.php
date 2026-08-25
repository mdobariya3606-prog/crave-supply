<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}">
    <style>
        .admin-page {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            padding: 52px 0 80px
        }

        .admin-head {
            margin-bottom: 26px
        }

        h1,
        h2 {
            font-family: Georgia, serif;
            font-weight: 400;
            color: #29251f
        }

        h1 {
            margin: 0;
            font-size: 42px
        }

        h2 {
            font-size: 25px
        }

        .admin-head p {
            color: #8d8376
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px
        }

        .stat {
            padding: 20px;
            border: 1px solid #ded4c8;
            background: #fffdf9
        }

        .stat strong {
            display: block;
            color: #8d6c4a;
            font: 400 30px Georgia, serif
        }

        .stat span {
            display: block;
            margin-top: 6px;
            color: #8d8376;
            font-size: 11px
        }

        .feature-section {
            margin-top: 30px
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px
        }

        .feature-card {
            display: block;
            padding: 20px;
            border: 1px solid #ded4c8;
            background: #fffdf9;
            color: #29251f;
            text-decoration: none
        }

        .feature-card:hover {
            background: #f1e9df
        }

        .feature-card strong {
            display: block;
            margin-bottom: 8px;
            font-size: 14px
        }

        .feature-card span {
            display: block;
            color: #8d8376;
            font-size: 12px;
            line-height: 1.6
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.25fr .75fr;
            gap: 20px;
            margin-top: 30px
        }

        .panel {
            padding: 22px;
            border: 1px solid #ded4c8;
            background: #fffdf9
        }

        .panel h2 {
            margin: 0 0 16px
        }

        .order-row,
        .stock-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 0;
            border-top: 1px solid #eee5da;
            font-size: 12px
        }

        .order-row a {
            color: #8d6c4a;
            font-weight: 700;
            text-decoration: none
        }

        .badge {
            padding: 5px 8px;
            color: #49603b;
            background: #e8eddf;
            font-size: 10px;
            text-transform: capitalize
        }

        .low {
            color: #a04338
        }

        .panel-link {
            display: inline-block;
            margin-top: 14px;
            color: #8d6c4a;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none
        }

        @media(max-width:800px) {
            .stat-grid {
                grid-template-columns: repeat(3, 1fr)
            }

            .feature-grid,
            .dashboard-grid {
                grid-template-columns: 1fr 1fr
            }
        }

        @media(max-width:560px) {
            .admin-page {
                width: calc(100% - 28px);
                padding-top: 34px
            }

            .stat-grid,
            .feature-grid {
                grid-template-columns: 1fr 1fr
            }
        }
        @media(max-width:900px){.admin-page{width:calc(100% - 32px)}.stat-grid{grid-template-columns:repeat(3,minmax(0,1fr))}.feature-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.dashboard-grid{grid-template-columns:1fr}}
        @media(max-width:600px){.admin-page{width:calc(100% - 28px);padding:34px 0 56px}.admin-head{margin-bottom:22px}.admin-head h1{font-size:34px;line-height:1.05}.admin-head p:last-child{line-height:1.6}.stat-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:8px}.stat{padding:15px}.stat strong{font-size:25px}.feature-grid{grid-template-columns:1fr;gap:8px}.feature-card{padding:16px}.dashboard-grid{gap:12px;margin-top:22px}.panel{padding:17px;overflow:hidden}.order-row,.stock-row{align-items:flex-start}.order-row span,.stock-row strong{flex-shrink:0}}
        @media(max-width:380px){.stat-grid{grid-template-columns:1fr}.admin-head h1{font-size:30px}}
    </style>
</head>

<body>@include('layouts.header')<main class="admin-page">
        <div class="admin-head">
            <div>
                <p class="eyebrow">Secure administration</p>
                <h1>Admin dashboard</h1>
                <p>Manage the CraveSupply catalogue, customers, orders, and enquiries from one place.</p>
            </div>
        </div>
        <div class="stat-grid">
            <div class="stat"><strong>{{ $orderCount }}</strong><span>Total orders</span></div>
            <div class="stat"><strong>{{ $currentOrderCount }}</strong><span>Current orders</span></div>
            <div class="stat"><strong>{{ $completedOrderCount }}</strong><span>Completed</span></div>
            <div class="stat"><strong>{{ $customerCount }}</strong><span>Customers</span></div>
            <div class="stat"><strong>{{ $productCount }}</strong><span>Products</span></div>
        </div>
        <section class="feature-section">
            <h2>Admin features</h2>
            <div class="feature-grid"><a class="feature-card" href="{{ route('products.dashboard') }}"><strong>Catalogue</strong><span>Manage products, stock, and categories.</span></a><a class="feature-card" href="{{ route('products.add') }}"><strong>Add product</strong><span>Create a new catalogue product.</span></a><a class="feature-card" href="{{ route('categories.add') }}"><strong>Manage categories</strong><span>Add and organise product categories.</span></a><a class="feature-card" href="{{ route('admin.orders.index') }}"><strong>Orders</strong><span>Review orders and update statuses.</span></a><a class="feature-card" href="{{ route('admin.customers.index') }}"><strong>Customers</strong><span>Manage customer accounts and access.</span></a><a class="feature-card" href="{{ route('admin.customers.deleted') }}"><strong>Deleted customers</strong><span>Restore or permanently remove deleted accounts.</span></a><a class="feature-card" href="{{ route('admin.contact-messages.index') }}"><strong>Messages</strong><span>Read enquiries and send email replies.</span></a></div>
        </section>
        <div class="dashboard-grid">
            <section class="panel">
                <h2>Recent orders</h2>@forelse($recentOrders as $order)<div class="order-row">
                    <div><a href="{{ route('orders.confirmation',$order) }}">{{ $order->order_number }}</a><br><span>{{ $order->user?->name ?: 'Customer' }}</span></div><span class="badge">{{ str_replace('_',' ',$order->status->value) }}</span>
                </div>@empty<p>No orders yet.</p>@endforelse<a class="panel-link" href="{{ route('admin.orders.index') }}">Open order management →</a>
            </section>
            <section class="panel">
                <h2>Stock watch</h2>@forelse($lowStockProducts as $product)<div class="stock-row"><span>{{ $product->name }}</span><strong class="{{ $product->stock < 1 ? 'low' : '' }}">{{ $product->stock }}</strong></div>@empty<p>All products have healthy stock.</p>@endforelse<a class="panel-link" href="{{ route('products.dashboard') }}">Manage catalogue →</a>
            </section>
        </div>
    </main>@include('layouts.footer')</body>

</html>

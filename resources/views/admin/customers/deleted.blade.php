<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Deleted customers — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}" />
    <style>
        .deleted-page {
            width: min(1100px, calc(100% - 40px));
            margin: auto;
            padding: 52px 0 80px;
        }

        .deleted-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
        }

        .deleted-head h1 {
            margin: 0;
            color: #29251f;
            font:
                400 42px Georgia,
                serif;
        }

        .deleted-head p {
            color: #8d8376;
        }

        .deleted-actions,
        .row-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .deleted-actions button,
        .row-actions button {
            padding: 10px 13px;
            border: 0;
            color: #fff;
            background: #2c2722;
            font-size: 12px;
            cursor: pointer;
        }

        .deleted-actions .danger,
        .row-actions .danger {
            background: #a04338;
        }

        .deleted-table {
            overflow: auto;
            margin-top: 24px;
            border: 1px solid #ded4c8;
            border-radius: 18px;
            background: #fffdf9;
        }

        .deleted-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .deleted-table th,
        .deleted-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee5da;
            font-size: 12px;
            white-space: nowrap;
        }

        .deleted-table th {
            color: #8d8376;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .empty-deleted {
            padding: 28px;
            color: #8d8376;
            font-size: 13px;
        }

        .deleted-success {
            margin-top: 18px;
            color: #49603b;
            font-size: 13px;
        }

        .deleted-error {
            margin-top: 18px;
            color: #a04338;
            font-size: 13px;
        }

        @media (max-width: 650px) {
            .deleted-page {
                width: calc(100% - 28px);
                padding: 34px 0 60px;
            }

            .deleted-head {
                display: block;
            }

            .deleted-actions {
                margin-top: 18px;
            }

            .deleted-head h1 {
                font-size: 34px;
            }
        }
    </style>
</head>

<body>
    @include ('layouts.header')
    <main class="deleted-page">
        <div class="deleted-head">
            <div>
                <p>Customer management</p>
                <h1>Deleted customers</h1>
                <p>Restore accounts or permanently remove them.</p>
            </div>
            @if ($deletedCustomers->isNotEmpty())
                <div class="deleted-actions">
                    <form
                        method="POST"
                        action="{{ route('admin.customers.restore-all') }}"
                    >
                        @csrf
                        @method ('PATCH')
                        <button type="submit">Restore all</button>
                    </form>
                    <form
                        method="POST"
                        action="{{ route('admin.customers.force-destroy-all') }}"
                        onsubmit="
                            return confirm(
                                'Permanently delete all deleted customer accounts?',
                            );
                        "
                    >
                        @csrf
                        @method ('DELETE')
                        <button class="danger" type="submit">
                            Delete all permanently
                        </button>
                    </form>
                </div>
            @endif
        </div>
        @if (session('success'))
            <p class="deleted-success" role="status">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="deleted-error" role="alert">{{ session('error') }}</p>
        @endif
        <div class="deleted-table">
            @forelse ($deletedCustomers as $customer)
                @if ($loop->first)
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Business</th>
                                <th>Email</th>
                                <th>Deleted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->business_name ?: '—' }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->deleted_at?->format('d M Y, H:i') }}</td>
                    <td>
                        <div class="row-actions">
                            <form
                                method="POST"
                                action="{{ route('admin.customers.restore', $customer->id) }}"
                            >
                                @csrf
                                @method ('PATCH')
                                <button type="submit">Restore</button>
                            </form>
                            <form
                                method="POST"
                                action="{{ route('admin.customers.force-destroy', $customer->id) }}"
                                onsubmit="
                                    return confirm(
                                        'Permanently delete this customer?',
                                    );
                                "
                            >
                                @csrf
                                @method ('DELETE')
                                <button class="danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @if ($loop->last)
                    </tbody>
                    </table>
                @endif
            @empty
                <div class="empty-deleted">No deleted customer accounts.</div>
            @endforelse
        </div>
        {{ $deletedCustomers->links() }}
    </main>
    @include ('layouts.footer')
</body>
</html>

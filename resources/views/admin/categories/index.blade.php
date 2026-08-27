<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage categories — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}">
    <style>
        .category-admin-page {
            max-width: 1120px;
            margin: 0 auto;
            padding: 52px 24px 80px;
        }

        .category-admin-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 28px;
        }

        .category-admin-head h1 {
            margin: 0 0 8px;
            letter-spacing: -.05em;
        }

        .category-admin-head p {
            margin: 0;
            color: var(--layout-muted);
        }

        .category-admin-table {
            overflow: hidden;
            border: 1px solid var(--layout-line);
            border-radius: 16px;
            background: var(--layout-surface);
            box-shadow: 0 8px 26px rgba(44, 39, 34, .06);
        }

        .category-admin-name {
            font-weight: 700;
            font-size: 14px;
        }

        .category-admin-meta {
            color: var(--layout-muted);
            font-size: 13px;
        }

        .category-admin-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }

        .category-admin-actions a {
            color: var(--layout-blue);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .category-admin-actions a:hover {
            text-decoration: underline;
        }

        .category-add-button {
            padding: 10px 20px;
            border: 1px solid #17362a !important;
            border-radius: 18px;
            color: #fffdf9 !important;
            background: #17362a !important;
            box-shadow: 0 6px 14px rgba(23, 54, 42, .15);
            text-decoration: none;
            font-size: 12px;
        }

        .category-add-button:hover {
            background: #2f5a45 !important;
            transform: translateY(-1px);
            box-shadow: 0 9px 18px rgba(23, 54, 42, .2);
        }

        .category-admin-table-wrap {
            overflow-x: auto;
            border: 1px solid var(--layout-line);
            border-radius: 16px;
            background: var(--layout-surface);
            box-shadow: 0 8px 26px rgba(44, 39, 34, .06);
        }

        .category-admin-table {
            width: 100%;
            min-width: 540px;
            border-collapse: collapse;
        }

        .category-admin-table th,
        .category-admin-table td {
            padding: 18px 22px;
            border-bottom: 1px solid var(--layout-line);
            text-align: left;
        }

        .category-admin-table th {
            color: var(--layout-muted);
            background: var(--layout-page);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .category-admin-table tbody tr:last-child td {
            border-bottom: 0;
        }

        @media(max-width:600px) {
            .category-admin-page {
                padding: 32px 16px 60px;
            }

            .category-admin-head {
                align-items: start;
                flex-direction: column;
            }

            .category-admin-table {
                min-width: 500px;
            }

            .category-admin-table th,
            .category-admin-table td {
                padding: 14px 16px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="category-admin-page">
        <div class="category-admin-head">
            <div>
                <p class="eyebrow">Catalogue administration</p>
                <h1>Manage categories</h1>
                <p>Review every product category and keep your catalogue organised.</p>
            </div>
            <a class="category-add-button" href="{{ route('categories.add') }}">Add category</a>
        </div>
        @if (session('success')) <div class="alert-success" role="status">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert-error" role="alert">{{ session('error') }}</div> @endif
        <div class="category-admin-table-wrap">
            <table class="category-admin-table">
                <thead>
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Products</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td class="category-admin-name">{{ $category->name }}</td>
                        <td class="category-admin-meta">{{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}</td>
                        <td class="category-admin-actions"><a href="{{ route('categories.edit', $category) }}">Edit</a><a href="{{ route('products.category', $category->slug) }}">View</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td class="category-admin-meta" colspan="3">No categories have been added yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
    @include('layouts.footer')
</body>

</html>
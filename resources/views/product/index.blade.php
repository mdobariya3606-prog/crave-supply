<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --products-ink: #1e293b;
            --products-muted: #64748b;
            --products-line: #e2e8f0;
            --products-blue: #3b82f6;
            --products-navy: #133458;
        }

        .products-page {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            padding: 48px 0 72px;
        }

        .products-hero {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 28px;
            padding: 34px 38px;
            border-radius: 24px;
            color: #fff;
            background: linear-gradient(120deg, #102d25, #244b35 58%, #366624);
            box-shadow: 0 16px 40px rgba(36, 75, 53, .16);
        }

        .products-eyebrow {
            margin: 0 0 9px;
            color: #e8c66f;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .products-hero h1 {
            margin: 0;
            font-size: clamp(28px, 4vw, 42px);
            letter-spacing: -.05em;
        }

        .products-hero p {
            max-width: 560px;
            margin: 11px 0 0;
            color: #d7e4dc;
            line-height: 1.6;
            font-size: 14px;
        }

        .manage-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .manage-actions a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 15px;
            border-radius: 10px;
            color: #17362a;
            background: #e8c66f;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .manage-actions a.secondary {
            color: #fff;
            background: rgba(255, 255, 255, .14);
            border: 1px solid rgba(255, 255, 255, .28);
        }

        .products-section {
            margin-top: 30px;
        }

        .products-section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 14px;
        }

        .products-section-heading h2 {
            margin: 0;
            color: var(--products-ink);
            font-size: 21px;
            letter-spacing: -.03em;
        }

        .products-section-heading p {
            margin: 4px 0 0;
            color: var(--products-muted);
            font-size: 13px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .category-card,
        .products-table-wrap {
            border: 1px solid var(--products-line);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .category-card {
            padding: 0;
        }

        .category-card a {
            display: block;
            padding: 20px;
            text-decoration: none;
        }

        .category-card span {
            display: block;
            margin-bottom: 14px;
            color: var(--products-blue);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .category-card h3 {
            margin: 0 0 7px;
            color: var(--products-ink);
            font-size: 16px;
        }

        .category-card p {
            margin: 0;
            color: var(--products-muted);
            font-size: 12px;
        }

        .category-card:hover {
            border-color: #93c5fd;
            box-shadow: 0 8px 24px rgba(59, 130, 246, .1);
        }

        .category-more {
            display: inline-flex;
            margin-top: 14px;
            color: var(--products-blue);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .category-detail .category-card {
            max-width: 520px;
        }

        .category-edit {
            display: inline-flex;
            margin-top: 14px;
            color: var(--products-blue);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .products-table-wrap {
            overflow-x: auto;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 680px;
        }

        .products-table th,
        .products-table td {
            padding: 16px 18px;
            border-bottom: 1px solid #f1f5f9;
            text-align: left;
            font-size: 13px;
        }

        .products-table th {
            color: var(--products-muted);
            background: #f8fafc;
            font-size: 11px;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .products-table tr:last-child td {
            border-bottom: 0;
        }

        .product-name {
            color: var(--products-ink);
            font-weight: 700;
        }

        .product-index-image {
            width: 52px;
            height: 52px;
            display: block;
            object-fit: cover;
            border-radius: 10px;
            background: #eef4f8;
        }

        .product-meta {
            display: block;
            margin-top: 4px;
            color: var(--products-muted);
            font-size: 11px;
            font-weight: 400;
        }

        .status-pill {
            display: inline-flex;
            padding: 5px 9px;
            border-radius: 99px;
            color: #166534;
            background: #dcfce7;
            font-size: 11px;
            font-weight: 700;
        }

        .status-pill.unavailable {
            color: #991b1b;
            background: #fee2e2;
        }

        .empty-state {
            padding: 34px 20px;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            color: var(--products-muted);
            background: rgba(255, 255, 255, .6);
            text-align: center;
            font-size: 13px;
        }

        .alert-success {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid #bbf7d0;
            border-radius: 11px;
            color: #166534;
            background: #f0fdf4;
            font-size: 13px;
        }

        @media (max-width: 800px) {
            .products-hero {
                display: block;
                padding: 28px;
            }

            .manage-actions {
                margin-top: 22px;
            }

            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 520px) {
            .products-page {
                width: calc(100% - 28px);
                padding-top: 28px;
            }

            .category-grid {
                grid-template-columns: 1fr;
            }

            .products-hero h1 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="products-page">
        @if (session('success'))
            <div class="alert-success" role="status">{{ session('success') }}</div>
        @endif

        <section class="products-hero" aria-labelledby="products-title">
            <div>
                <p class="products-eyebrow">CraveSupply catalogue</p>
                <h1 id="products-title">{{ $selectedCategory ? $selectedCategory->name : 'Products, made manageable.' }}
                </h1>
                <p>{{ $selectedCategory ? 'Explore the premium products in this category.' : 'Browse your supply catalogue by category and keep the essentials easy to find.' }}
                </p>
            </div>
            @if (auth()->user()?->role === 'admin')
                <div class="manage-actions" aria-label="Product management actions">
                    <a href="{{ route('categories.add') }}">Add category</a>
                    <a class="secondary" href="{{ route('products.add') }}">Add product</a>
                </div>
            @endif
        </section>

        <section class="products-section" aria-labelledby="categories-title">
            <div class="products-section-heading">
                <div>
                    <h2 id="categories-title">Categories</h2>
                    <p>Organised for faster discovery.</p>
                </div>
            </div>

            @if ($selectedCategory)
                <div class="category-detail">
                    <article class="category-card">
                        <div style="padding: 20px">
                            <h3>{{ $selectedCategory->name }}</h3>
                            <p>{{ $selectedCategory->description ?: 'A curated CraveSupply collection.' }}</p>
                            @if (auth()->user()?->role === 'admin')
                                <a class="category-edit" href="{{ route('categories.edit', $selectedCategory) }}">Edit
                                    category →</a>
                            @endif
                        </div>
                    </article>
                </div>
            @elseif ($categories->isNotEmpty())
                <div class="category-grid">
                    @foreach ($categories as $category)
                        <article class="category-card">
                            <a href="{{ route('products.category', $category->slug) }}">
                                <h3>{{ $category->name }}</h3>
                                <p>{{ $category->description ?: 'A curated CraveSupply collection.' }}</p>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">No categories have been added yet.</div>
            @endif
            @if (!$selectedCategory && !$showAllCategories && $categories->count() === 4)
                <a class="category-more" href="{{ route('products.dashboard', ['all' => 1]) }}">More categories →</a>
            @endif
        </section>

        <section class="products-section" aria-labelledby="catalogue-title">
            <div class="products-section-heading">
                <div>
                    <h2 id="catalogue-title">
                        {{ $selectedCategory ? $selectedCategory->name . ' products' : 'Catalogue' }}</h2>
                    <p>{{ $selectedCategory ? 'Premium products in this collection.' : 'Current products and stock levels.' }}
                    </p>
                </div>
            </div>
            @if ($products->isNotEmpty())
                <div class="products-table-wrap">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img class="product-index-image"
                                            src="{{ $product->productImages->first() ? asset('storage/'.$product->productImages->first()->image_path) : asset('images/product-placeholder.svg') }}"
                                            alt="{{ $product->name }}">
                                    </td>
                                    <td><a class="product-name"
                                            href="{{ route('products.profile', $product) }}">{{ $product->name }}</a><span
                                            class="product-meta">{{ $product->sku ?: $product->slug }}</span></td>
                                    <td>{{ $product->category?->name ?: 'Uncategorised' }}</td>
                                    <td>₹{{ number_format((float) $product->price, 2) }}</td>
                                    <td>{{ number_format($product->stock) }}</td>
                                    <td><span
                                            class="status-pill{{ !$product->is_available || $product->stock < 1 ? ' unavailable' : '' }}">{{ $product->is_available && $product->stock > 0 ? 'Available' : 'Out of stock' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">No products have been added yet. Admins can start by adding a product.</div>
            @endif
        </section>
    </main>
    @include('layouts.footer')
</body>

</html>

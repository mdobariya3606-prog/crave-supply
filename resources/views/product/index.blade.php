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
            --products-ink: #29251f;
            --products-muted: #8d8376;
            --products-line: #ded4c8;
            --products-blue: #8d6c4a;
            --products-navy: #2c2722;
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
            color: #fff;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 400;
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
            border-radius: 2px;
            color: #17362a;
            background: #e8c66f;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .manage-actions a.secondary:hover {
            color: #e8c66f;
            background: #17362a;
            transition: 0.5s;
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

        .catalogue-pagination {
            margin-top: 30px
        }

        .catalogue-pagination nav {
            display: flex;
            justify-content: center
        }

        .catalogue-pagination nav>div:first-child {
            display: none
        }

        .catalogue-pagination nav>div:last-child {
            display: flex;
            align-items: center;
            gap: 6px
        }

        .catalogue-pagination nav>div:last-child>* {
            display: grid;
            min-width: 34px;
            height: 34px;
            padding: 0 9px;
            place-items: center;
            border: 1px solid #ded4c8;
            color: #51483e;
            background: #fffdf9;
            font-size: 12px;
            text-decoration: none
        }

        .catalogue-pagination nav>div:last-child>span[aria-current="page"] {
            border-color: #2c2722;
            color: #fff;
            background: #2c2722
        }

        .catalogue-pagination nav>div:last-child>a:hover {
            border-color: #8d6c4a;
            color: #8d6c4a;
            background: #f8f4ed
        }

        .catalogue-pagination nav>div:last-child>span[aria-disabled="true"] {
            color: #b9aa9b
        }

        .catalogue-pagination svg {
            width: 14px;
            height: 14px
        }

        @media(max-width:500px) {
            .catalogue-pagination nav>div:last-child {
                flex-wrap: wrap;
                justify-content: center
            }
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 16px;
        }

        .product-scroller-wrap {
            position: relative;
            width: 100%;
            margin-top: 10px;
        }

        .product-scroller-track {
            display: flex;
            gap: 18px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 6px 2px 14px;
        }

        .product-scroller-track::-webkit-scrollbar {
            display: none;
        }

        .product-scroller-track .product-card {
            flex: 0 0 calc(25% - 14px);
            min-width: 230px;
        }

        .scroller-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-top: 14px;
            padding: 0 4px;
        }

        .scroller-progress-wrap {
            flex: 0 1 300px;
            height: 4px;
            background: #ded4c8;
            position: relative;
            border-radius: 2px;
            overflow: hidden;
        }

        .scroller-progress-bar {
            height: 100%;
            width: 25%;
            background: #2c2722;
            border-radius: 2px;
            transition: width 0.12s ease-out;
        }

        .scroller-nav-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .scroller-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid #ded4c8;
            background: #fffdf9;
            color: #2c2722;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, .04);
            user-select: none;
        }

        .scroller-btn svg {
            width: 18px;
            height: 18px;
            transition: transform 0.15s ease;
        }

        .scroller-btn.prev:hover:not(:disabled) svg {
            transform: translateX(-2px);
        }

        .scroller-btn.next:hover:not(:disabled) svg {
            transform: translateX(2px);
        }

        .scroller-btn:hover:not(:disabled) {
            border-color: #8d6c4a;
            background: #2c2722;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(44, 39, 34, .15);
        }

        .scroller-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            box-shadow: none;
            background: #f8f4ed;
            border-color: #ded4c8;
        }

        html[data-theme="dark"] .scroller-progress-wrap {
            background: #4a4037;
        }

        html[data-theme="dark"] .scroller-progress-bar {
            background: #e8c66f;
        }

        html[data-theme="dark"] .scroller-btn {
            background: #2a241f;
            border-color: #51463c;
            color: #f1e9df;
        }

        html[data-theme="dark"] .scroller-btn:hover:not(:disabled) {
            background: #e8c66f;
            border-color: #e8c66f;
            color: #17362a;
        }

        @media (max-width: 900px) {
            .product-scroller-track .product-card {
                flex: 0 0 calc(33.333% - 12px);
                min-width: 210px;
            }
        }

        @media (max-width: 600px) {
            .product-scroller-track .product-card {
                flex: 0 0 calc(50% - 9px);
                min-width: 170px;
            }
            .scroller-progress-wrap {
                flex: 0 1 160px;
            }
        }

        .product-card {
            display: flex;
            min-width: 0;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid var(--products-line);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .product-card:hover {
            border-color: #bfdbfe;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .09);
            transform: translateY(-2px);
        }

        .product-card-image {
            width: 100%;
            aspect-ratio: 1 / .8;
            object-fit: cover;
            background: #eef4f8;
        }

        .product-card-body {
            display: flex;
            min-height: 205px;
            flex: 1;
            flex-direction: column;
            padding: 14px;
        }

        .product-card-category {
            margin: 0 0 7px;
            color: var(--products-blue);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .product-card-name {
            color: var(--products-ink);
            font-size: 14px;
            font-weight: 750;
            line-height: 1.35;
            text-decoration: none;
        }

        .product-card-description {
            display: -webkit-box;
            margin: 8px 0 12px;
            overflow: hidden;
            color: var(--products-muted);
            font-size: 12px;
            line-height: 1.45;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 4;
        }

        .product-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: auto;
            padding-top: 11px;
            border-top: 1px solid #f1f5f9;
        }

        .product-card-price {
            color: var(--products-ink);
            font-size: 14px;
            font-weight: 800;
        }

        .product-card-status {
            padding: 4px 7px;
            border-radius: 99px;
            color: #166534;
            background: #dcfce7;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        html[data-theme="dark"] .product-card-status {
            color: #dcfce7;
            background: #166534;
        }

        .product-card-status.unavailable {
            color: #991b1b;
            background: #fee2e2;
        }

        html[data-theme="dark"] .product-card-status.unavailable {
            color: #fee2e2;
            background: #991b1b;
        }

        .catalogue-pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .catalogue-pagination a,
        .catalogue-pagination span {
            display: inline-grid;
            min-width: 36px;
            height: 36px;
            place-items: center;
            padding: 0 9px;
            border: 1px solid var(--products-line);
            border-radius: 9px;
            color: var(--products-ink);
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .catalogue-pagination svg {
            width: 14px;
            height: 14px;
        }

        .catalogue-pagination a:hover {
            border-color: var(--products-blue);
            color: var(--products-blue);
        }

        .catalogue-pagination .active {
            border-color: var(--products-navy);
            color: #fff;
            background: var(--products-navy);
        }

        .catalogue-pagination .disabled {
            color: #94a3b8;
            background: #f8fafc;
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

        .products-pagination {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .products-pagination nav>div:first-child {
            display: none;
        }

        .products-pagination nav>div:last-child {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .products-pagination a,
        .products-pagination span {
            display: inline-flex;
            min-width: 36px;
            height: 36px;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border: 1px solid var(--products-line);
            border-radius: 9px;
            color: var(--products-ink);
            background: #fff;
            font-size: 12px;
            text-decoration: none;
        }

        .products-pagination a:hover {
            border-color: #93c5fd;
            color: var(--products-blue);
        }

        .products-pagination span[aria-current="page"] {
            border-color: var(--products-blue);
            color: #fff;
            background: var(--products-blue);
        }

        .products-pagination span[aria-disabled="true"] {
            color: #cbd5e1;
            background: #f8fafc;
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

            .product-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
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

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .products-hero h1 {
                font-size: 30px;
            }
        }

        .category-product-section {
            margin-top: 38px;
            padding-top: 26px;
            border-top: 1px solid var(--products-line);
        }

        .category-product-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 15px;
        }

        .category-product-heading h3 {
            margin: 0;
            color: var(--products-ink);
            font: 400 25px Georgia, serif;
        }

        .category-product-heading a {
            color: var(--products-blue);
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .category-product-heading a:hover {
            color: var(--products-navy);
        }

        @media(max-width:600px) {
            .category-product-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 7px;
            }
        }

        /* Laravel's pagination has nested wrappers; only the inner links are buttons. */
        .catalogue-pagination nav {
            display: flex;
            justify-content: center
        }

        .catalogue-pagination nav>div:first-child {
            display: none
        }

        .catalogue-pagination nav>div:last-child {
            display: flex;
            align-items: center;
            gap: 6px
        }

        .catalogue-pagination nav>div:last-child>span,
        .catalogue-pagination nav>div:last-child>a {
            display: inline-flex;
            align-items: center;
            gap: 4px
        }

        .catalogue-pagination nav>div:last-child>a,
        .catalogue-pagination nav>div:last-child>span[aria-current="page"] span,
        .catalogue-pagination nav>div:last-child>span[aria-disabled="true"] span {
            min-width: 34px;
            height: 34px;
            padding: 0 9px;
            box-sizing: border-box;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ded4c8;
            border-radius: 8px;
            color: #51483e;
            background: #fffdf9;
            font-size: 12px;
            text-decoration: none
        }

        .catalogue-pagination nav>div:last-child>a:hover {
            border-color: #8d6c4a;
            color: #8d6c4a;
            background: #f8f4ed
        }

        .catalogue-pagination nav>div:last-child>span[aria-current="page"] span {
            border-color: #2c2722;
            color: #fff;
            background: #2c2722
        }

        .catalogue-pagination nav>div:last-child>span[aria-disabled="true"] span {
            color: #b9aa9b;
            background: #f8f4ed
        }

        .catalogue-pagination svg {
            width: 14px;
            height: 14px
        }

        @media(max-width:500px) {
            .catalogue-pagination nav>div:last-child {
                flex-wrap: wrap;
                justify-content: center
            }
        }

        .manual-pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 30px
        }

        .manual-pagination-pages {
            display: flex;
            gap: 7px
        }

        .manual-pagination-button {
            display: inline-flex;
            min-width: 36px;
            height: 36px;
            box-sizing: border-box;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border: 1px solid var(--products-line);
            border-radius: 9px;
            color: var(--products-ink);
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none
        }

        .manual-pagination-button:hover {
            border-color: var(--products-blue);
            color: var(--products-blue)
        }

        .manual-pagination-button.active {
            border-color: var(--products-blue);
            color: #fff;
            background: var(--products-blue)
        }

        .manual-pagination-button.disabled {
            color: #cbd5e1;
            background: #f8fafc;
            cursor: not-allowed
        }

        @media(max-width:500px) {
            .manual-pagination {
                flex-wrap: wrap
            }

            .manual-pagination-pages {
                flex-wrap: wrap;
                justify-content: center
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
                <a class="secondary" href="{{ route('categories.add') }}">Add category</a>
                <a class="secondary"
                    href="{{ route('products.add', $selectedCategory ? ['category' => $selectedCategory->id] : []) }}">Add
                    product</a>
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
                        {{ $selectedCategory ? $selectedCategory->name . ' products' : 'Catalogue' }}
                    </h2>
                    <p>{{ $selectedCategory ? 'Premium products in this collection.' : 'Current products and stock levels.' }}
                    </p>
                </div>
            </div>
            @if (!$selectedCategory)
            @foreach ($categories as $category)
            @php($categoryItems = $categoryProducts->get($category->id, collect()))
            <section class="category-product-section" aria-labelledby="cat  egory-products-{{ $category->id }}">
                <div class="category-product-heading">
                    <h3 id="category-products-{{ $category->id }}">{{ $category->name }}</h3>
                    <a href="{{ route('products.category', $category->slug) }}">View all products →</a>
                </div>
                @if ($categoryItems->isNotEmpty())
                <div class="product-scroller-wrap">
                    <div class="product-scroller-track">
                        @foreach ($categoryItems as $product)
                        <article class="product-card">
                            <a href="{{ route('products.profile', $product) }}"><img class="product-card-image"
                                    src="{{ $product->productImages->first() ? asset('storage/' . $product->productImages->first()->image_path) : asset('images/product-placeholder.svg') }}"
                                    alt="{{ $product->name }}"></a>
                            <div class="product-card-body">
                                <p class="product-card-category">{{ $product->category?->name ?: 'Uncategorised' }}</p><a
                                    class="product-card-name"
                                    href="{{ route('products.profile', $product) }}">{{ $product->name }}</a>
                                <p class="product-card-description">
                                    {{ $product->description ?: 'A carefully selected CraveSupply product for your everyday needs.' }}
                                </p>
                                <div class="product-card-footer"><strong
                                        class="product-card-price">₹{{ number_format((float) $product->price, 2) }}</strong><span
                                        class="product-card-status{{ !$product->is_available || $product->stock < 1 ? ' unavailable' : '' }}">{{ $product->is_available && $product->stock > 0 ? 'Available' : 'Out of stock' }}</span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    <div class="scroller-controls">
                        <div class="scroller-progress-wrap">
                            <div class="scroller-progress-bar"></div>
                        </div>
                        <div class="scroller-nav-buttons">
                            <button type="button" class="scroller-btn prev" aria-label="Previous products">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            </button>
                            <button type="button" class="scroller-btn next" aria-label="Next products">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @else
                <div class="empty-state">No products in this category yet.</div>
                @endif
            </section>
            @endforeach
            @else
            @if ($products->isNotEmpty())
            <div class="product-scroller-wrap">
                <div class="product-scroller-track">
                    @foreach ($products as $product)
                    <article class="product-card">
                        <a href="{{ route('products.profile', $product) }}">
                            <img class="product-card-image"
                                src="{{ $product->productImages->first() ? asset('storage/' . $product->productImages->first()->image_path) : asset('images/product-placeholder.svg') }}"
                                alt="{{ $product->name }}">
                        </a>
                        <div class="product-card-body">
                            <p class="product-card-category">{{ $product->category?->name ?: 'Uncategorised' }}</p>
                            <a class="product-card-name"
                                href="{{ route('products.profile', $product) }}">{{ $product->name }}</a>
                            <p class="product-card-description">
                                {{ $product->description ?: 'A carefully selected CraveSupply product for your everyday needs.' }}
                            </p>
                            <div class="product-card-footer">
                                <strong class="product-card-price">₹{{ number_format((float) $product->price, 2) }}</strong>
                                <span
                                    class="product-card-status{{ !$product->is_available || $product->stock < 1 ? ' unavailable' : '' }}">{{ $product->is_available && $product->stock > 0 ? 'Available' : 'Out of stock' }}</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="scroller-controls">
                    <div class="scroller-progress-wrap">
                        <div class="scroller-progress-bar"></div>
                    </div>
                    <div class="scroller-nav-buttons">
                        <button type="button" class="scroller-btn prev" aria-label="Previous products">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" class="scroller-btn next" aria-label="Next products">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            @if ($products->hasPages())
            <nav class="manual-pagination" aria-label="Product pagination">
                @if ($products->onFirstPage())
                <span class="manual-pagination-button disabled" aria-disabled="true">‹</span>
                @else
                <a class="manual-pagination-button" href="{{ $products->previousPageUrl() }}" rel="prev">‹</a>
                @endif
                <div class="manual-pagination-pages">
                    @for ($page = 1; $page <= $products->lastPage(); $page++)
                        @if ($page === $products->currentPage())
                        <span class="manual-pagination-button active" aria-current="page">{{ $page }}</span>
                        @else
                        <a class="manual-pagination-button" href="{{ $products->url($page) }}">{{ $page }}</a>
                        @endif
                        @endfor
                </div>
                @if ($products->hasMorePages())
                <a class="manual-pagination-button" href="{{ $products->nextPageUrl() }}" rel="next">›</a>
                @else
                <span class="manual-pagination-button disabled" aria-disabled="true">›</span>
                @endif
            </nav>
            @endif
            @else
            <div class="empty-state">No products have been added yet. Admins can start by adding a product.</div>
            @endif
            @endif
        </section>
    </main>
    @include('layouts.footer')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const initScroller = (wrap) => {
                const track = wrap.querySelector('.product-scroller-track');
                const bar = wrap.querySelector('.scroller-progress-bar');
                const prevBtn = wrap.querySelector('.scroller-btn.prev');
                const nextBtn = wrap.querySelector('.scroller-btn.next');

                if (!track || !bar) return;

                const update = () => {
                    const scrollLeft = track.scrollLeft;
                    const maxScroll = track.scrollWidth - track.clientWidth;

                    if (maxScroll <= 0) {
                        bar.style.width = '100%';
                        if (prevBtn) prevBtn.disabled = true;
                        if (nextBtn) nextBtn.disabled = true;
                        return;
                    }

                    const currentRight = scrollLeft + track.clientWidth;
                    const progressRatio = currentRight / track.scrollWidth;
                    const fillPercent = Math.min(100, Math.max(15, progressRatio * 100));

                    bar.style.width = fillPercent + '%';

                    if (prevBtn) prevBtn.disabled = scrollLeft <= 5;
                    if (nextBtn) nextBtn.disabled = scrollLeft >= maxScroll - 5;
                };

                track.addEventListener('scroll', update, { passive: true });
                window.addEventListener('resize', update, { passive: true });

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        track.scrollBy({ left: -track.clientWidth * 0.75, behavior: 'smooth' });
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        track.scrollBy({ left: track.clientWidth * 0.75, behavior: 'smooth' });
                    });
                }

                update();
            };

            document.querySelectorAll('.product-scroller-wrap').forEach(initScroller);
        });
    </script>
</body>

</html>
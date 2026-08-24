<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — CraveSupply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <style>
        :root {
            --navy: #133458;
            --blue: #3b82f6;
            --ink: #1e293b;
            --muted: #64748b;
            --line: #e2e8f0;
            --page: #f6f8fb;
            --orange: #e85d04;
            --forest: #244b35;
            --cream: #fbfaf6;
            --gold: #d6a84f;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--cream);
            font-family: 'Inter', sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .dashboard {
            max-width: 1180px;
            margin: auto;
            padding: 48px 24px 72px;
        }

        .welcome {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 18px;
            padding: 44px 46px;
            border-radius: 26px;
            color: #fff;
            background: linear-gradient(120deg, #102d25 0%, #244b35 55%, #366624 100%);
            box-shadow: 0 18px 44px rgba(36, 75, 53, .18);
        }

        .welcome::after {
            content: '';
            position: absolute;
            width: 330px;
            height: 330px;
            right: -100px;
            bottom: -190px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 50%;
            box-shadow: 0 0 0 34px rgba(255, 255, 255, .05), 0 0 0 68px rgba(255, 255, 255, .035);
            pointer-events: none;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #e8c66f;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: var(--ink);
            font-size: clamp(30px, 5vw, 46px);
            line-height: 1.05;
            letter-spacing: -.055em;
        }

        .welcome h1 {
            position: relative;
            z-index: 1;
            max-width: 710px;
            color: #fff;
        }

        .welcome p:last-child {
            position: relative;
            z-index: 1;
            max-width: 590px;
            margin: 12px 0 0;
            color: #d7e4dc;
            line-height: 1.7;
        }

        .primary-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 11px;
            color: #fff;
            background: #e8c66f;
            color: #17362a;
            font-size: 14px;
            font-weight: 700;
            transition: .2s ease;
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            background: #f2d98e;
            box-shadow: 0 8px 18px rgba(19, 52, 88, .2);
        }

        .premium-proof {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            margin-bottom: 42px;
            overflow: hidden;
            border: 1px solid #e7e4d9;
            border-radius: 16px;
            background: #e7e4d9;
        }

        .proof-item {
            padding: 17px 20px;
            background: rgba(255, 255, 255, .72);
        }

        .proof-item strong {
            display: block;
            margin-bottom: 4px;
            color: var(--forest);
            font-size: 13px;
        }

        .proof-item span {
            color: var(--muted);
            font-size: 12px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 42px;
        }

        .quick-card {
            padding: 22px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .quick-icon {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            margin-bottom: 18px;
            border-radius: 11px;
            color: var(--forest);
            background: #edf4ed;
        }

        .quick-card h2 {
            margin: 0 0 7px;
            font-size: 17px;
            letter-spacing: -.02em;
        }

        .quick-card p {
            margin: 0 0 16px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
        }

        .quick-card,
        .snack-card,
        .guide-card {
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .quick-card:hover,
        .snack-card:hover,
        .guide-card:hover {
            transform: translateY(-3px);
            border-color: #bfdbfe;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
        }

        .text-link {
            color: var(--blue);
            font-size: 13px;
            font-weight: 700;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 16px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: -.035em;
        }

        .section-heading h2 span {
            color: var(--forest);
        }

        .section-heading p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .snack-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        #catalogue {
            scroll-margin-top: 96px;
        }

        #catalogue.catalogue-focus {
            animation: catalogueFocus 1.1s ease;
        }

        @keyframes catalogueFocus {
            0% {
                transform: translateY(8px);
                opacity: .55;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            #catalogue.catalogue-focus {
                animation: none;
            }
        }

        .snack-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .snack-card img {
            width: 100%;
            height: 190px;
            display: block;
            object-fit: cover;
        }

        .snack-image {
            width: 100%;
            height: 132px;
            display: block;
            object-fit: cover;
        }

        .snack-body {
            padding: 18px;
        }

        .snack-label {
            margin: 0 0 7px;
            color: var(--forest);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .snack-body h3 {
            margin: 0 0 8px;
            font-size: 17px;
        }

        .snack-body p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .explore-section {
            margin-top: 56px;
        }

        .premium-callout {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-top: 56px;
            padding: 30px 34px;
            border-radius: 20px;
            color: #fff;
            background: var(--forest);
        }

        .premium-callout h2 {
            margin: 0 0 7px;
            font-size: 24px;
            letter-spacing: -.035em;
        }

        .premium-callout p {
            margin: 0;
            color: #d7e4dc;
            font-size: 13px;
            line-height: 1.6;
        }

        .premium-callout .text-link {
            color: #f1d586;
            white-space: nowrap;
        }

        .explore-intro {
            max-width: 560px;
            margin: 0 0 22px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .explore-grid {
            display: grid;
            grid-template-columns: 1.35fr .65fr;
            gap: 18px;
        }

        .explore-card {
            position: relative;
            min-height: 260px;
            overflow: hidden;
            border-radius: 18px;
            color: #fff;
            background: var(--navy);
        }

        .explore-card img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .explore-card:first-child {
            background: linear-gradient(135deg, #133458, #2563eb);
        }

        .explore-card:last-child {
            background: linear-gradient(135deg, #164e63, #0f766e);
        }

        .explore-card::before {
            content: '';
            position: absolute;
            width: 190px;
            height: 190px;
            top: -70px;
            right: 10%;
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 50%;
            box-shadow: 0 0 0 28px rgba(255, 255, 255, .06), 0 0 0 56px rgba(255, 255, 255, .04);
        }

        .explore-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 22%, rgba(15, 23, 42, .86) 100%);
        }

        .explore-card-content {
            position: absolute;
            z-index: 1;
            right: 24px;
            bottom: 22px;
            left: 24px;
        }

        .explore-card-content p {
            margin: 0 0 6px;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .explore-card-content h3 {
            margin: 0;
            font-size: 22px;
            letter-spacing: -.03em;
        }

        .review-section {
            margin-top: 56px;
            padding: 30px;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: #fff;
        }

        .review-slider {
            overflow: hidden;
        }

        .review-track {
            display: flex;
            transition: transform .35s ease;
        }

        .review-card {
            min-width: 100%;
            padding: 8px 42px 10px 0;
        }

        .review-stars {
            margin-bottom: 16px;
            color: var(--orange);
            font-size: 18px;
            letter-spacing: .12em;
        }

        .review-card blockquote {
            max-width: 760px;
            margin: 0 0 18px;
            color: var(--ink);
            font-size: 15px;
            line-height: 1.35;
            letter-spacing: -.035em;
        }

        .review-author {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .review-product {
            display: inline-block;
            margin-top: 7px;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .review-product:hover {
            text-decoration: underline;
        }

        .review-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 18px;
        }

        .review-buttons {
            display: flex;
            gap: 8px;
        }


        .review-button {
            width: 28px;
            height: 28px;
            padding: 0;
            border: 0;
            border-radius: 8px;
            color: var(--muted);
            background: transparent;
            font-size: 16px;
            line-height: 1;
            cursor: pointer;
            transition: color .2s ease, background .2s ease;
        }

        .review-button:hover {
            color: var(--forest);
            background: #edf4ed;
        }

        .review-dots {
            display: flex;
            gap: 6px;
        }

        .review-dot {
            width: 7px;
            height: 7px;
            padding: 0;
            border: 0;
            border-radius: 50%;
            background: #cbd5e1;
            cursor: pointer;
        }

        .review-dot.active {
            width: 20px;
            border-radius: 8px;
            background: var(--blue);
        }

        .guide-section {
            margin-top: 56px;
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .guide-card {
            padding: 22px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
        }

        .guide-number {
            color: var(--blue);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .12em;
        }

        .guide-card h3 {
            margin: 18px 0 8px;
            font-size: 17px;
        }

        .guide-card p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .service-band {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            margin-top: 56px;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--line);
        }

        .customer-orders {
            margin-top: 28px;
            padding: 24px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
        }

        .customer-orders-header {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 12px;
        }

        .customer-orders h2 {
            margin: 0;
            color: var(--ink);
            font-size: 20px;
            letter-spacing: -.04em;
        }

        .customer-orders p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .customer-order-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 14px 0;
            border-top: 1px solid var(--line);
        }

        .customer-order-number {
            color: var(--ink);
            font-size: 13px;
            font-weight: 800;
        }

        .customer-order-date {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: 11px;
        }

        .customer-order-status {
            padding: 6px 10px;
            border-radius: 99px;
            color: #166534;
            background: #dcfce7;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .service-item {
            padding: 24px;
            background: #fff;
        }

        .service-item strong {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .service-item span {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        @media (max-width:760px) {
            .dashboard {
                padding: 34px 16px 52px;
            }

            .welcome {
                display: block;
                padding: 32px 24px;
            }

            .welcome .primary-btn {
                margin-top: 22px;
                width: 100%;
            }

            .quick-grid,
            .snack-grid,
            .explore-grid,
            .guide-grid,
            .service-band {
                grid-template-columns: 1fr;
            }

            .premium-proof {
                grid-template-columns: 1fr;
            }

            .customer-orders-header,
            .customer-order-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            .premium-callout {
                display: block;
                padding: 26px 22px;
            }

            .premium-callout .text-link {
                display: inline-block;
                margin-top: 18px;
            }

            .snack-card img {
                height: 210px;
            }

            .review-section {
                padding: 22px;
            }

            .review-card {
                padding-right: 0;
            }

        }
    </style>
</head>

<body>
    @include('layouts.header')

    <main class="dashboard">
        <section class="welcome">
            <div>
                <p class="eyebrow">Premium business supply</p>
                <h1>Premium snacks for the way your business works.</h1>
                <p>Welcome back, {{ auth()->user()->name ?? 'there' }}. Discover a curated range of quality products,
                    selected for better shelves, better breaks, and smarter restocking.</p>
            </div>
            <a class="primary-btn" href="#catalogue">Explore premium range</a>
        </section>

        <section class="premium-proof" aria-label="CraveSupply benefits">
            <div class="proof-item"><strong>Curated premium range</strong><span>Products chosen for quality and everyday
                    appeal.</span></div>
            <div class="proof-item"><strong>Wholesale-ready selection</strong><span>Practical options for offices,
                    cafés, and retailers.</span></div>
            <div class="proof-item"><strong>Smarter restocking</strong><span>Clear categories that make repeat orders
                    easier.</span></div>
        </section>

        @if ($customerOrders->isNotEmpty())
            <section class="customer-orders" aria-labelledby="customer-orders-title">
                <div class="customer-orders-header">
                    <div>
                        <h2 id="customer-orders-title">Your recent orders</h2>
                        <p>Track the current status of your submitted orders.</p>
                    </div>
                </div>
                @foreach ($customerOrders as $order)
                    <div class="customer-order-row">
                        <div>
                            <span class="customer-order-number">{{ $order->order_number }}</span>
                            <span class="customer-order-date">{{ $order->created_at->format('M j, Y') }} · ₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <span class="customer-order-status">{{ ucwords(str_replace('_', ' ', $order->status->value)) }}</span>
                    </div>
                @endforeach
            </section>
        @endif

        <section class="quick-grid" aria-label="Dashboard shortcuts">
            <article class="quick-card">
                <div class="quick-icon">✦</div>
                <h2>Explore premium foods</h2>
                <p>Find refined snacks, drinks, and pantry favourites for your business.</p>
                <a class="text-link" href="#catalogue">View catalogue →</a>
            </article>
            <article class="quick-card">
                <div class="quick-icon">▣</div>
                <h2>Stock with confidence</h2>
                <p>Build a dependable range that keeps your shelves ready for every workday.</p>
                <a class="text-link" href="#restock-guide">Plan a restock →</a>
            </article>
            <article class="quick-card">
                <div class="quick-icon">◇</div>
                <h2>Made for modern teams</h2>
                <p>Choose thoughtful products that make shared spaces feel considered.</p>
                <a class="text-link" href="#about">Learn more →</a>
            </article>
        </section>

        <section id="catalogue" aria-labelledby="featured-snacks">
            <div class="section-heading">
                <div>
                    <h2 id="featured-snacks">Explore our <span>premium range</span></h2>
                    <p>Curated categories for retailers, cafés, offices, and growing teams.</p>
                </div>
                <a class="text-link" href="/products">View all →</a>
            </div>

            <div class="snack-grid">
                <article class="snack-card">
                    <img class="snack-image" loading="lazy"
                        src="https://images.unsplash.com/photo-1499636136210-6f4ee915583e?auto=format&amp;fit=crop&amp;w=720&amp;q=75"
                        alt="Freshly baked cookies">
                    <div class="snack-body">
                        <p class="snack-label">Sweet treats</p>
                        <h3>Cookies &amp; biscuits</h3>
                        <p>Reliable favourites for office shelves, cafés, and stores.</p>
                    </div>
                </article>
                <article class="snack-card">
                    <img class="snack-image" loading="lazy"
                        src="https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&amp;fit=crop&amp;w=720&amp;q=75"
                        alt="Chocolate pieces">
                    <div class="snack-body">
                        <p class="snack-label">Confectionery</p>
                        <h3>Chocolate &amp; candy</h3>
                        <p>Stock up on familiar treats your customers already love.</p>
                    </div>
                </article>
                <article class="snack-card">
                    <img class="snack-image" loading="lazy"
                        src="https://images.unsplash.com/photo-1566478989037-eec170784d0b?auto=format&amp;fit=crop&amp;w=720&amp;q=75"
                        alt="Crispy savoury snack bites">
                    <div class="snack-body">
                        <p class="snack-label">Savoury snacks</p>
                        <h3>Chips &amp; quick bites</h3>
                        <p>Everyday savoury options for counters, pantries, and events.</p>
                    </div>
                </article>
            </div>
        </section>

        <section class="premium-callout" aria-label="Premium supply call to action">
            <div>
                <h2>Stock smarter. Serve better.</h2>
                <p>Bring premium everyday choices to your shelves without complicating your weekly routine.</p>
            </div>
            <a class="text-link" href="#restock-guide">See the restock guide →</a>
        </section>

        <section class="explore-section" aria-labelledby="explore-title">
            <div class="section-heading">
                <div>
                    <h2 id="explore-title">A little more to explore</h2>
                    <p class="explore-intro">Build a better break room, refresh your counter, and keep your regulars
                        coming back.</p>
                </div>
            </div>

            <div class="explore-grid">
                <article class="explore-card">
                    <div class="explore-card-content">
                        <p>Everyday refreshment</p>
                        <h3>Drinks for every kind of workday.</h3>
                    </div>
                </article>
                <article class="explore-card">
                    <div class="explore-card-content">
                        <p>Made for teams</p>
                        <h3>Stock the moments people remember.</h3>
                    </div>
                </article>
            </div>
        </section>

        <section id="restock-guide" class="guide-section" aria-labelledby="guide-title">
            <div class="section-heading">
                <div>
                    <h2 id="guide-title">A simpler restock routine</h2>
                    <p>Keep the essentials moving with a process your team can repeat every week.</p>
                </div>
            </div>

            <div class="guide-grid">
                <article class="guide-card">
                    <span class="guide-number">01 / DISCOVER</span>
                    <h3>Start with the essentials</h3>
                    <p>Choose familiar snacks, drinks, and pantry staples that suit your team and customers.</p>
                </article>
                <article class="guide-card">
                    <span class="guide-number">02 / ORGANISE</span>
                    <h3>Build a repeatable list</h3>
                    <p>Keep your regular items together so the next order takes minutes instead of guesswork.</p>
                </article>
                <article class="guide-card">
                    <span class="guide-number">03 / REFRESH</span>
                    <h3>Review what works</h3>
                    <p>Notice what disappears first and use that insight to make every restock more useful.</p>
                </article>
            </div>
        </section>

        <section id="about" class="service-band" aria-label="CraveSupply service details">
            <div class="service-item"><strong>Built for busy teams</strong><span>Clear choices and practical categories
                    for offices, cafés, and small businesses.</span></div>
            <div class="service-item"><strong>Easy to get started</strong><span>Browse the catalogue, create an account,
                    and keep your everyday supplies in one place.</span></div>
            <div class="service-item"><strong>Support when you need it</strong><span>Our team is here to help with
                    product questions and your next replenishment.</span></div>
        </section>

        @if ($topReviews->isNotEmpty())
        <section class="review-section" aria-labelledby="reviews-title">
            <div class="section-heading">
                <div>
                    <h2 id="reviews-title">What businesses are saying</h2>
                    <p>Real routines, made a little easier.</p>
                </div>
            </div>

            <div class="review-slider" aria-live="polite">
                <div class="review-track" id="reviewTrack">
                    @foreach ($topReviews as $review)
                        <article class="review-card">
                            <div class="review-stars" aria-label="{{ $review->rating }} out of 5 stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
                            <blockquote>“{{ $review->comment }}”</blockquote>
                            <p class="review-author">{{ $review->user?->name ?: 'Customer' }}</p>
                            @if ($review->product)
                                <a class="review-product" href="{{ route('products.profile', $review->product) }}">Reviewed: {{ $review->product->name }}</a>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="review-controls">
                <div class="review-dots" aria-label="Choose a review">
                    @foreach ($topReviews as $index => $review)
                        <button class="review-dot{{ $index === 0 ? ' active' : '' }}" type="button"
                            aria-label="Show review {{ $index + 1 }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"></button>
                    @endforeach
                </div>
                <div class="review-buttons">
                    <button class="review-button" id="reviewPrevious" type="button"
                        aria-label="Previous review">←</button>
                    <button class="review-button" id="reviewNext" type="button" aria-label="Next review">→</button>
                </div>
            </div>
        </section>
        @endif
    </main>

    @include('layouts.footer')

    <script>
        (() => {
            document.querySelectorAll('a[href="#catalogue"]').forEach((link) => {
                link.addEventListener('click', (event) => {
                    const catalogue = document.getElementById('catalogue');
                    if (!catalogue) return;

                    event.preventDefault();
                    catalogue.scrollIntoView({
                        behavior: window.matchMedia('(prefers-reduced-motion: reduce)')
                            .matches ? 'auto' : 'smooth',
                        block: 'start'
                    });
                    catalogue.classList.remove('catalogue-focus');
                    window.requestAnimationFrame(() => catalogue.classList.add('catalogue-focus'));
                    window.setTimeout(() => catalogue.classList.remove('catalogue-focus'), 1200);
                });
            });

            const track = document.getElementById('reviewTrack');
            const dots = [...document.querySelectorAll('.review-dot')];
            const previous = document.getElementById('reviewPrevious');
            const next = document.getElementById('reviewNext');
            const reviewSection = document.querySelector('.review-section');
            if (!track || !previous || !next || !reviewSection || dots.length === 0) return;
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            let current = 0;
            let autoplay = null;

            function showReview(index) {
                current = (index + dots.length) % dots.length;
                track.style.transform = `translateX(-${current * 100}%)`;
                dots.forEach((dot, dotIndex) => {
                    const active = dotIndex === current;
                    dot.classList.toggle('active', active);
                    dot.setAttribute('aria-current', active ? 'true' : 'false');
                });
            }

            function stopAutoplay() {
                if (autoplay) {
                    window.clearInterval(autoplay);
                    autoplay = null;
                }
            }

            function startAutoplay() {
                if (reduceMotion || autoplay) return;
                autoplay = window.setInterval(() => showReview(current + 1), 5000);
            }

            function restartAutoplay() {
                stopAutoplay();
                startAutoplay();
            }

            previous.addEventListener('click', () => {
                showReview(current - 1);
                restartAutoplay();
            });
            next.addEventListener('click', () => {
                showReview(current + 1);
                restartAutoplay();
            });
            dots.forEach((dot, index) => dot.addEventListener('click', () => {
                showReview(index);
                restartAutoplay();
            }));
            reviewSection.addEventListener('mouseenter', stopAutoplay);
            reviewSection.addEventListener('mouseleave', startAutoplay);
            reviewSection.addEventListener('focusin', stopAutoplay);
            reviewSection.addEventListener('focusout', (event) => {
                if (!reviewSection.contains(event.relatedTarget)) startAutoplay();
            });
            startAutoplay();
        })();
    </script>
</body>

</html>

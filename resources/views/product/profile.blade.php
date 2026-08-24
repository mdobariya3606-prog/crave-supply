<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — CraveSupply</title>

    <style>
        :root {
            --profile-ink: #1e293b;
            --profile-muted: #64748b;
            --profile-line: #e2e8f0;
            --profile-blue: #3b82f6;
            --profile-navy: #133458;
        }

        .product-profile {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            padding: 44px 0 72px;
        }

        .breadcrumb {
            margin-bottom: 22px;
            color: var(--profile-muted);
            font-size: 12px;
        }

        .breadcrumb a {
            color: var(--profile-blue);
            text-decoration: none;
        }

        .product-main {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
            gap: 54px;
            align-items: start;
        }

        .gallery {
            position: sticky;
            top: 102px;
            width: min(100%, 430px);
            margin-inline: auto;
        }

        .gallery-main {
            position: relative;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            max-height: 325px;
            border-radius: 14px;
            background: #f1f5f4;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
        }

        .gallery-track {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform .65s cubic-bezier(.22, .61, .36, 1);
            will-change: transform;
        }

        .gallery-track img {
            display: block;
            flex: 0 0 100%;
            width: 100%;
            height: 100%;
            padding: 0;
            object-fit: cover;
        }

        .gallery-arrow {
            position: absolute;
            top: 50%;
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 50%;
            color: var(--profile-navy);
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 5px 15px rgba(15, 23, 42, .12);
            cursor: pointer;
            transform: translateY(-50%);
        }

        .gallery-arrow:hover {
            background: #fff;
        }

        .gallery-arrow.previous {
            left: 15px;
        }

        .gallery-arrow.next {
            right: 15px;
        }

        .gallery-thumbs {
            display: flex;
            gap: 10px;
            margin-top: 12px;
            padding: 2px 1px 5px;
            overflow-x: auto;
            overscroll-behavior-inline: contain;
            scrollbar-width: thin;
        }

        .gallery-thumb {
            overflow: hidden;
            padding: 0;
            flex: 0 0 84px;
            border: 2px solid transparent;
            border-radius: 12px;
            background: #eef4f8;
            cursor: pointer;
        }

        .gallery-thumb.active {
            border-color: var(--profile-blue);
        }

        .gallery-thumb img {
            display: block;
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            padding: 0;
        }

        .product-info {
            padding-top: 10px;
        }

        .product-label {
            margin: 0 0 12px;
            color: var(--profile-blue);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .product-info h1 {
            margin: 0;
            color: var(--profile-ink);
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.08;
            letter-spacing: -.055em;
        }

        .product-subtitle {
            margin: 16px 0 0;
            color: var(--profile-muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 22px 0;
            padding-bottom: 22px;
            border-bottom: 1px solid var(--profile-line);
        }

        .stars {
            color: #d99d24;
            letter-spacing: 2px;
        }

        .rating-summary span:last-child {
            color: var(--profile-muted);
            font-size: 13px;
        }

        .price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .price {
            color: var(--profile-navy);
            font-size: 27px;
            font-weight: 800;
        }

        .availability {
            color: #166534;
            background: #dcfce7;
            border-radius: 99px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: 700;
        }

        .availability.unavailable {
            color: #991b1b;
            background: #fee2e2;
        }

        .detail-list {
            display: grid;
            gap: 13px;
            margin: 0;
            padding: 22px 0;
            border-top: 1px solid var(--profile-line);
            border-bottom: 1px solid var(--profile-line);
        }

        .detail-list div {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            font-size: 13px;
        }

        .detail-list dt {
            color: var(--profile-muted);
        }

        .detail-list dd {
            margin: 0;
            color: var(--profile-ink);
            font-weight: 600;
            text-align: right;
        }

        .service-highlights {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            margin-top: 46px;
            overflow: hidden;
            border: 1px solid var(--profile-line);
            border-radius: 16px;
            background: var(--profile-line);
        }

        .service-highlight {
            display: grid;
            justify-items: center;
            gap: 11px;
            padding: 25px 18px;
            background: #fff;
            text-align: center;
        }

        .service-highlight svg {
            width: 38px;
            height: 38px;
            fill: none;
            stroke: #c8861a;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 1.5;
        }

        .service-highlight strong {
            color: var(--profile-ink);
            font-size: 12px;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .service-highlight span {
            color: var(--profile-muted);
            font-size: 11px;
        }

        .reviews-section,
        .related-section {
            margin-top: 60px;
        }

        .section-title {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
        }

        .section-title h2 {
            margin: 0;
            color: var(--profile-ink);
            font-size: 24px;
            letter-spacing: -.04em;
        }

        .section-title p {
            margin: 5px 0 0;
            color: var(--profile-muted);
            font-size: 13px;
        }

        .review-layout {
            display: grid;
            grid-template-columns: minmax(260px, .7fr) minmax(0, 1.3fr);
            gap: 18px;
        }

        .review-card,
        .review-form,
        .related-card {
            border: 1px solid var(--profile-line);
            border-radius: 16px;
            background: #fff;
        }

        .review-card {
            padding: 22px;
        }

        .review-card h3 {
            margin: 0 0 12px;
            color: var(--profile-ink);
            font-size: 15px;
        }

        .review-score {
            color: var(--profile-navy);
            font-size: 38px;
            font-weight: 800;
        }

        .review-note {
            margin: 7px 0 0;
            color: var(--profile-muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .review-list {
            display: grid;
            gap: 12px;
        }

        .review-item {
            padding: 18px;
            border: 1px solid var(--profile-line);
            border-radius: 14px;
            background: #fff;
        }

        .review-item header {
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }

        .review-item strong {
            color: var(--profile-ink);
            font-size: 13px;
        }

        .review-item time {
            color: var(--profile-muted);
            font-size: 11px;
        }

        .review-item p {
            margin: 9px 0 0;
            color: var(--profile-muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .review-form {
            margin-top: 18px;
            padding: 20px;
        }

        .review-form h3 {
            margin: 0 0 14px;
            font-size: 15px;
        }

        .review-form label {
            display: block;
            margin-bottom: 7px;
            color: var(--profile-ink);
            font-size: 12px;
            font-weight: 700;
        }

        .review-form select,
        .review-form textarea {
            width: 100%;
            margin-bottom: 12px;
            padding: 10px 12px;
            border: 1px solid var(--profile-line);
            border-radius: 9px;
            color: var(--profile-ink);
            font: inherit;
            font-size: 13px;
        }

        .review-form textarea {
            min-height: 82px;
            resize: vertical;
        }

        .review-submit {
            padding: 10px 15px;
            border: 0;
            border-radius: 9px;
            color: #fff;
            background: var(--profile-navy);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .review-submit:hover {
            background: #0f2946;
        }

        .review-message {
            margin-bottom: 14px;
            padding: 11px 13px;
            border-radius: 9px;
            color: #166534;
            background: #f0fdf4;
            font-size: 12px;
        }

        .order-error {
            display: block;
            margin: -4px 0 12px;
            padding: 10px 12px;
            border: 1px solid #fecaca;
            border-radius: 9px;
            color: #991b1b;
            background: #fef2f2;
            font-size: 12px;
            line-height: 1.45;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .related-card {
            padding: 18px;
            text-decoration: none;
        }

        .related-card:hover {
            border-color: #93c5fd;
        }

        .related-card h3 {
            margin: 0 0 8px;
            color: var(--profile-ink);
            font-size: 14px;
        }

        .related-card p {
            margin: 0;
            color: var(--profile-blue);
            font-size: 13px;
            font-weight: 700;
        }

        @media (max-width: 800px) {

            .product-main,
            .review-layout {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .gallery {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .service-highlights {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .product-profile {
                width: calc(100% - 28px);
                padding-top: 28px;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="product-profile">
        @if (session('success'))
            <div class="review-message" role="status">{{ session('success') }}</div>
        @endif

        <div class="breadcrumb"><a href="{{ route('products.dashboard') }}">Products</a> / {{ $product->name }}</div>

        <section class="product-main" aria-labelledby="product-title">
            <div class="gallery" data-gallery>
                <div class="gallery-main">
                    <div class="gallery-track" data-gallery-track>
                        @forelse ($product->productImages as $index => $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->name }} view {{ $index + 1 }}">
                        @empty
                            <img src="{{ asset('images/product-placeholder.svg') }}"
                                alt="{{ $product->name }} product image">
                        @endforelse
                    </div>
                    <button class="gallery-arrow previous" type="button" data-gallery-previous
                        aria-label="Previous image">‹</button>
                    <button class="gallery-arrow next" type="button" data-gallery-next
                        aria-label="Next image">›</button>
                </div>
                <div class="gallery-thumbs">
                    @foreach ($product->productImages as $index => $image)
                        <button class="gallery-thumb{{ $index === 0 ? ' active' : '' }}" type="button"
                            data-gallery-thumb="{{ $index }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->name }} view {{ $index + 1 }}">
                        </button>
                    @endforeach
                    @if ($product->productImages->isEmpty())
                        <button class="gallery-thumb active" type="button" data-gallery-thumb="0">
                            <img src="{{ asset('images/product-placeholder.svg') }}"
                                alt="{{ $product->name }} placeholder">
                        </button>
                    @endif
                </div>
            </div>

            <div class="product-info">
                <p class="product-label">{{ $product->category?->name ?: 'Premium collection' }}</p>
                <h1 id="product-title">{{ $product->name }}</h1>
                <p class="product-subtitle">
                    {{ $product->description ?: 'A thoughtfully selected premium product for your business and shared spaces.' }}
                </p>
                <div class="rating-summary"><span
                        class="stars">★★★★★</span><span>{{ number_format((float) $product->reviews->avg('rating'), 1) }}
                        from {{ $product->reviews->count() }} reviews</span></div>
                <div class="price-row"><span
                        class="price">₹{{ number_format((float) $product->price, 2) }}</span><span
                        class="availability{{ !$product->is_available || $product->stock < 1 ? ' unavailable' : '' }}">{{ $product->is_available && $product->stock > 0 ? 'In stock' : 'Out of stock' }}</span>
                </div>
                <dl class="detail-list">
                    <div>
                        <dt>SKU</dt>
                        <dd>{{ $product->sku ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt>Available quantity</dt>
                        <dd>{{ number_format($product->stock) }}</dd>
                    </div>
                    <div>
                        <dt>Collection</dt>
                        <dd>{{ $product->category?->name ?: 'Premium collection' }}</dd>
                    </div>
                </dl>
                @if (auth()->user()?->role === 'admin')
                    <a class="review-submit" style="display:inline-block;text-decoration:none;margin-top:18px"
                        href="{{ route('products.edit', $product) }}">Edit product</a>
                @endif
                @if ($product->is_available && $product->stock > 0)
                    @if (auth()->user()?->role === 'customer')
                        <form class="order-form" action="{{ route('products.order.store', $product) }}" method="POST">
                            @csrf
                            <label for="quantity">Quantity</label>
                            <input id="quantity" name="quantity" type="number" min="1"
                                max="{{ $product->stock }}" value="1">
                            @error('quantity', 'order')
                                <span class="order-error" role="alert">{{ $message }}</span>
                            @enderror
                            <button class="review-submit" type="submit">Add to Order</button>
                        </form>
                    @endif
                @else
                    <span class="availability unavailable" style="display:inline-block;margin-top:18px">Out of
                        stock</span>
                @endif
            </div>
        </section>

        <section class="service-highlights" aria-label="CraveSupply service benefits">
            <article class="service-highlight">
                <svg viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M24 4 38 10v11c0 9-5.8 17.2-14 21-8.2-3.8-14-12-14-21V10l14-6Z" />
                    <path d="m17 24 5 5 10-11" />
                </svg>
                <strong>Curated quality</strong>
                <span>Selected for dependable everyday use</span>
            </article>
            <article class="service-highlight">
                <svg viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M11 18h26v22H11z" />
                    <path d="M17 18v-5h14v5M20 27h8M24 23v8" />
                    <path d="M8 24H4m4-6-3-3m3 12-3 3" />
                </svg>
                <strong>Simple returns</strong>
                <span>Easy support when plans change</span>
            </article>
            <article class="service-highlight">
                <svg viewBox="0 0 48 48" aria-hidden="true">
                    <path
                        d="M5 31h25V16H5zM30 23h7l6 6v2H30zM12 37a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm25 0a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                    <path d="M35 16V9m-4 4 4-4 4 4" />
                </svg>
                <strong>Reliable delivery</strong>
                <span>Carefully packed for your business</span>
            </article>
        </section>

        <section class="reviews-section" aria-labelledby="reviews-title">
            <div class="section-title">
                <div>
                    <h2 id="reviews-title">Customer reviews</h2>
                    <p>What customers say about this product.</p>
                </div>
            </div>
            <div class="review-layout">
                <div>
                    <article class="review-card">
                        <h3>Overall rating</h3>
                        <div class="review-score">
                            {{ $product->reviews->count() ? number_format((float) $product->reviews->avg('rating'), 1) : '—' }}
                        </div>
                        <div class="stars">
                            <?php $avgRating = (int) $product->reviews->avg('rating'); ?>
                            {{ str_repeat('★', $avgRating) }}{{ str_repeat('☆', 5 - $avgRating) }}
                        </div>
                        <p class="review-note">{{ $product->reviews->count() }} verified
                            review{{ $product->reviews->count() === 1 ? '' : 's' }} shared so far.</p>
                    </article>
                    @auth
                        @if (session('review_success'))
                            <div class="review-message" role="status">{{ session('review_success') }}</div>
                        @endif
                        <form class="review-form" action="{{ route('products.reviews.store', $product) }}" method="POST">
                            @csrf
                            <h3>Share your experience</h3>
                            <label for="rating">Your rating</label>
                            <select id="rating" name="rating" required>
                                <option value="">Select a rating</option>
                                <option value="5">★★★★★ Excellent</option>
                                <option value="4">★★★★☆ Very good</option>
                                <option value="3">★★★☆☆ Good</option>
                                <option value="2">★★☆☆☆ Fair</option>
                                <option value="1">★☆☆☆☆ Needs improvement</option>
                            </select>
                            <label for="comment">Review</label>
                            <textarea id="comment" name="comment" maxlength="1000" placeholder="Tell us about the product..."></textarea>
                            <button class="review-submit" type="submit">Submit review</button>
                        </form>
                    @else
                        <p class="review-note">Please <a href="{{ route('login') }}">log in</a> to leave a review.</p>
                    @endauth
                </div>
                <div class="review-list">
                    @forelse ($product->reviews as $review)
                        <article class="review-item">
                            <header>
                                <strong>{{ $review->user?->name ?: 'Customer' }}</strong><time>{{ $review->created_at->format('M j, Y') }}</time>
                            </header>
                            <div class="stars">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                            @if ($review->comment)
                                <p>{{ $review->comment }}</p>
                            @endif
                        </article>
                    @empty
                        <div class="empty-state">No reviews yet. Be the first to share your experience.</div>
                    @endforelse
                </div>
            </div>
        </section>

        @if ($relatedProducts->isNotEmpty())
            <section class="related-section" aria-labelledby="related-title">
                <div class="section-title">
                    <div>
                        <h2 id="related-title">You may also like</h2>
                        <p>More premium products from this collection.</p>
                    </div>
                </div>
                <div class="related-grid">
                    @foreach ($relatedProducts as $relatedProduct)
                        <a class="related-card" href="{{ route('products.profile', $relatedProduct) }}">
                            <h3>{{ $relatedProduct->name }}</h3>
                            <p>₹{{ number_format((float) $relatedProduct->price, 2) }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
    @include('layouts.footer')

    <script>
        (() => {
            const gallery = document.querySelector('[data-gallery]');
            if (!gallery) return;
            const images = @json(
                $product->productImages->map(fn($image) => asset('storage/' . $image->image_path))->values()->all() ?: [
                    asset('images/product-placeholder.svg'),
                ]
            );
            const track = gallery.querySelector('[data-gallery-track]');
            const thumbs = [...gallery.querySelectorAll('[data-gallery-thumb]')];
            let current = 0;
            let timer;
            if (images.length > 1) track.appendChild(track.firstElementChild.cloneNode(true));
            const show = (index) => {
                const next = (index + images.length) % images.length;
                const isForwardWrap = current === images.length - 1 && next === 0;
                current = next;
                track.style.transform = 'translateX(-' + ((isForwardWrap ? images.length : current) * 100) + '%)';
                if (isForwardWrap) {
                    window.setTimeout(() => {
                        track.style.transition = 'none';
                        track.style.transform = 'translateX(0)';
                        window.requestAnimationFrame(() => track.style.transition = '');
                    }, 650);
                }
                thumbs.forEach((thumb, thumbIndex) => thumb.classList.toggle('active', thumbIndex === current));
            };
            const restart = () => {
                window.clearInterval(timer);
                if (images.length > 1) timer = window.setInterval(() => show(current + 1), 5000);
            };
            gallery.querySelector('[data-gallery-previous]').addEventListener('click', () => {
                show(current - 1);
                restart();
            });
            gallery.querySelector('[data-gallery-next]').addEventListener('click', () => {
                show(current + 1);
                restart();
            });
            thumbs.forEach((thumb, index) => thumb.addEventListener('click', () => {
                show(index);
                restart();
            }));
            gallery.addEventListener('mouseenter', () => window.clearInterval(timer));
            gallery.addEventListener('mouseleave', restart);
            gallery.addEventListener('keydown', (event) => {
                if (event.key === 'ArrowLeft') {
                    show(current - 1);
                    restart();
                }
                if (event.key === 'ArrowRight') {
                    show(current + 1);
                    restart();
                }
            });
            gallery.tabIndex = 0;
            restart();
        })();
    </script>
</body>

</html>

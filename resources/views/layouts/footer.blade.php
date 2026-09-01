<link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
<footer class="site-footer">
    <div class="footer-wrap">
        <div class="footer-grid">
            <div class="footer-brand">
                <a class="brand" href="{{ route('home') }}"
                    ><span class="brand-mark">CS</span
                    ><span class="cravesupply-title">CraveSupply</span></a
                >
                <p>Thoughtful snacks and drinks for better breaks, fuller shelves, and happier teams.</p>
            </div>
            <div class="footer-column">
                <h3>Useful links</h3>
                <a href="{{ route('products.dashboard') }}">Products</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a href="{{ route('about') }}#privacy">Privacy</a>
                <a href="{{ route('about') }}#terms">Terms</a>
                <a href="{{ url('/register') }}">Create account</a>
            </div>
            <div class="footer-column footer-categories">
                <h3>Categories</h3>
                @foreach (\App\Models\Category::orderBy('name')->get() as $category)
                    <a
                        href="{{ route('products.category', $category->slug) }}"
                        >{{ $category->name }}</a
                    >
                @endforeach
            </div>
            <div class="footer-column">
                <h3>Support</h3>
                <a href="mailto:hello@cravesupply.test"
                    >hello@cravesupply.test</a
                >
                <p>Mon&ndash;Fri, 9:00&ndash;18:00</p>
                <p>We usually reply within one business day.</p>
            </div>
            <div class="footer-column">
                <h3>Our promise</h3>
                <p>Practical products.</p>
                <p>Clear service.</p>
                <p>Less time spent restocking.</p>
            </div>
        </div>
        <div class="footer-social" aria-label="Social media links">
            <span class="footer-social-label">Stay in the loop?</span>
            <div class="footer-social-links">
                <a href="#" aria-label="Facebook"
                    ><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8h3V4h-3c-3.3 0-5 2-5 5v3H6v4h3v4h4v-4h3l1-4h-4V9c0-.7.3-1 1-1Z" /></svg
                ></a>
                <a href="#" aria-label="X"
                    ><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 4 14 16M19 4 5 20" /></svg
                ></a>
                <a href="#" aria-label="Instagram"
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3.5" y="3.5" width="17" height="17" rx="5" />
                        <circle cx="12" cy="12" r="4" />
                        <circle class="social-dot" cx="17.5" cy="6.7" r="1" />
                    </svg>
                ></a>
                <a href="#" aria-label="YouTube"
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path class="social-fill" d="M21 8.2a2.7 2.7 0 0 0-1.9-1.9C17.4 6 12 6 12 6s-5.4 0-7.1.3A2.7 2.7 0 0 0 3 8.2 28 28 0 0 0 2.7 12 28 28 0 0 0 3 15.8a2.7 2.7 0 0 0 1.9 1.9c1.7.3 7.1.3 7.1.3s5.4 0 7.1-.3a2.7 2.7 0 0 0 1.9-1.9 28 28 0 0 0 .3-3.8 28 28 0 0 0-.3-3.8Z" />
                        <path class="social-cutout" d="m10 9 5 3-5 3V9Z" />
                    </svg>
                ></a>
                <a href="#" aria-label="LinkedIn"
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path class="social-fill" d="M4 4h4v16H4zM10 9h4v2.2c.8-1.5 2.2-2.6 4.4-2.6 3.8 0 4.6 2.5 4.6 5.8V20h-4v-5c0-1.2 0-2.8-1.8-2.8S15 13.5 15 15v5h-5V9ZM6 2.5A2.5 2.5 0 1 1 6 7a2.5 2.5 0 0 1 0-4.5Z" /></svg>
                ></a>
                <a href="#" aria-label="WhatsApp"
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path class="social-fill" d="M12 2.5a9.5 9.5 0 0 0-8.2 14.3L2.5 21.5l4.9-1.3A9.5 9.5 0 1 0 12 2.5Z" />
                        <path class="social-cutout" d="M8.4 7.5c.3-.3.7-.3 1-.1l1.2 1.8c.2.3.2.6 0 .8l-.7.7c.5 1 1.3 1.8 2.3 2.3l.7-.7c.2-.2.5-.2.8 0l1.8 1.2c.3.2.3.7.1 1-.5.7-1.2 1-2 1-2.9-.4-5.9-3.4-6.3-6.3 0-.7.4-1.4 1.1-1.7Z" />
                    </svg>
                ></a>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-copy">
                &copy; {{ date('Y') }} CraveSupply. Business supplies, made
                simpler.
            </div>
            <div class="footer-links">
                <a href="{{ route('about') }}">About</a>
                @if (auth()->user()?->role !== 'admin')
                    <a href="{{ route('contact') }}">Contact</a>
                @endif
                <a href="{{ route('about') }}#privacy">Privacy</a>
            </div>
        </div>
    </div>
</footer>
<script>
    document
        .querySelectorAll('form[action*="contact"], form[action*="/messages/"]')
        .forEach((form) => {
            form.addEventListener("submit", () => {
                const button = form.querySelector('button[type="submit"]');
                if (!button || button.disabled) return;

                button.disabled = true;
                button.classList.add("mail-submit", "is-sending");
                button.innerHTML =
                    '<span class="mail-submit-spinner" aria-hidden="true"></span>Sending…';
            });
        });
</script>

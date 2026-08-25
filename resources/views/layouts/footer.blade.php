<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<footer class="site-footer">
    <div class="footer-wrap">
        <div class="footer-grid">
            <div class="footer-brand">
                <a class="brand" href="{{ route('home') }}"><span class="brand-mark">CS</span><span>CraveSupply</span></a>
                <p>Thoughtful snacks and drinks for better breaks, fuller shelves, and happier teams.</p>
            </div>
            <div class="footer-column">
                <h3>Explore</h3>
                <a href="{{ route('home') }}#catalogue">Catalogue</a>
                <a href="{{ route('home') }}#restock-guide">Restock guide</a>
                <a href="{{ url('/register') }}">Create account</a>
            </div>
            <div class="footer-column">
                <h3>Support</h3>
                <a href="mailto:hello@cravesupply.test">hello@cravesupply.test</a>
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
        <div class="footer-bottom">
            <div class="footer-copy">&copy; {{ date('Y') }} CraveSupply. Business supplies, made simpler.</div>
            <div class="footer-links"><a href="{{ route('about') }}">About</a>@if (auth()->user()?->role !== 'admin')<a href="{{ route('contact') }}">Contact</a>@endif<a href="{{ route('about') }}#privacy">Privacy</a></div>
        </div>
    </div>
</footer>
<script>
    document.querySelectorAll('form[action*="contact"], form[action*="/messages/"]').forEach(form => {
        form.addEventListener('submit', () => {
            const button = form.querySelector('button[type="submit"]');
            if (!button || button.disabled) return;

            button.disabled = true;
            button.classList.add('mail-submit', 'is-sending');
            button.innerHTML = '<span class="mail-submit-spinner" aria-hidden="true"></span>Sending…';
        });
    });
</script>

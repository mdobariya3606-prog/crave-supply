<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<footer class="site-footer">
    <div class="footer-wrap">
        <div class="footer-grid">
            <div class="footer-brand">
                <a class="brand" href="{{ url('/dashboard') }}"><span class="brand-mark">CS</span><span>CraveSupply</span></a>
                <p>Thoughtful business supplies for better breaks, fuller shelves, and simpler weekly routines.</p>
            </div>
            <div class="footer-column">
                <h3>Explore</h3>
                <a href="{{ url('/dashboard#catalogue') }}">Catalogue</a>
                <a href="{{ url('/dashboard#restock-guide') }}">Restock guide</a>
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
            <div class="footer-links"><a href="{{ url('/dashboard#about') }}">About</a><a href="mailto:hello@cravesupply.test">Contact</a><a href="{{ url('/dashboard#about') }}">Privacy</a></div>
        </div>
    </div>
</footer>

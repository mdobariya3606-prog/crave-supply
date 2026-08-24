<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<header class="site-header">
    <nav class="nav-wrap" aria-label="Main navigation">
        <a class="brand" href="{{ url('/dashboard') }}">
            <span class="brand-mark">CS</span>
            <span>CraveSupply</span>
        </a>
        <div class="global-search" data-global-search>
            <form action="{{ route('products.dashboard') }}" method="GET" role="search">
                <label class="search-label" for="global-search-input">Search products and categories</label>
                <input id="global-search-input" name="q" type="search" autocomplete="off"
                    placeholder="Search products or categories" data-search-input>
                <button type="submit" aria-label="Search">⌕</button>
            </form>
            <div class="search-results" data-search-results hidden></div>
        </div>
        <div class="nav-links">
            <a href="{{ url('/dashboard') }}" class={{ request()->routeIs('dashboard') ? 'active' : '' }}>Dashboard</a>
            <a href="{{ url('/dashboard#catalogue') }}"
                class={{ request()->routeIs('#catalogue') ? 'active' : '' }}>Catalogue</a>
            <a href="{{ url('/dashboard#restock-guide') }}"class={{ request()->routeIs('login') ? 'active' : '' }}>Restock
                guide</a>
            <a href="{{ url('/products') }}" class={{ request()->routeIs('products.*') ? 'active' : '' }}>Products</a>
            @if (auth()->user()?->role === 'customer')
                <a href="{{ route('cart.index') }}" class={{ request()->routeIs('cart.*') ? 'active' : '' }}>
                    Cart{{ ($cartCount ?? collect(session('cart', []))->sum('quantity')) ? ' (' . ($cartCount ?? collect(session('cart', []))->sum('quantity')) . ')' : '' }}
                </a>
            @endif
            <a href="{{ url('/register') }}" class={{ request()->routeIs('register') ? 'active' : '' }}>Register</a>
        </div>
        <div class="user-menu">
            <span>{{ auth()->user()->name ?? 'Customer' }}</span>
            <div class="profile-dropdown">
                <button type="button" class="avatar profile-trigger" aria-label="Open user menu" aria-expanded="false"
                    aria-controls="profileMenu">
                    {{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}
                </button>
                <div id="profileMenu" class="profile-menu" hidden>
                    <a href="{{ url('/profile') }}">Profile</a>
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" onclick='return confirm("Are you sure to logout?")'>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    .global-search { position:relative; flex:0 1 300px; order:1; }
    .global-search form { display:flex; align-items:center; height:38px; overflow:hidden; border:1px solid #cbd5e1; border-radius:9px; background:#fff; }
    .search-label { position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0 0 0 0); }
    .global-search input { min-width:0; flex:1; padding:0 11px; border:0; outline:0; color:#1e293b; font:inherit; font-size:12px; }
    .global-search form:focus-within { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.14); }
    .global-search button { width:38px; height:100%; border:0; color:#133458; background:#f8fafc; font-size:20px; cursor:pointer; }
    .search-results { position:absolute; z-index:30; top:calc(100% + 8px); left:0; right:0; overflow:hidden; border:1px solid #e2e8f0; border-radius:12px; background:#fff; box-shadow:0 16px 34px rgba(15,23,42,.16); }
    .search-group-title { padding:10px 12px 6px; color:#64748b; font-size:10px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; }
    .search-result { display:block; padding:10px 12px; color:#1e293b; text-decoration:none; }
    .search-result:hover { background:#eff6ff; }
    .search-result strong { display:block; font-size:12px; }
    .search-result span { display:block; margin-top:3px; color:#64748b; font-size:11px; }
    .search-empty { padding:14px 12px; color:#64748b; font-size:12px; }
    @media (max-width:760px) {
        .global-search { flex:0 0 100%; order:4; }
        .global-search form { height:36px; }
        .global-search input { font-size:12px; }
    }
</style>

<script>
    (() => {
        const trigger = document.querySelector('.profile-trigger');
        const menu = document.getElementById('profileMenu');

        if (!trigger || !menu) return;

        trigger.addEventListener('click', () => {
            const isOpen = !menu.hidden;
            menu.hidden = isOpen;
            trigger.setAttribute('aria-expanded', String(!isOpen));
        });

        document.addEventListener('click', (event) => {
            if (!event.target.closest('.profile-dropdown')) {
                menu.hidden = true;
                trigger.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>

<script>
(() => {
    const search = document.querySelector('[data-global-search]');
    if (!search) return;
    const input = search.querySelector('[data-search-input]');
    const results = search.querySelector('[data-search-results]');
    let timer;
    const escapeHtml = value => String(value).replace(/[&<>"']/g, character => ({
        '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#039;'
    }[character]));
    const render = data => {
        const groups = [['Products', data.products || []], ['Categories', data.categories || []]];
        const html = groups.filter(([, items]) => items.length).map(([title, items]) =>
            '<div class="search-group-title">' + title + '</div>' +
            items.map(item => '<a class="search-result" href="' + encodeURI(item.url) + '"><strong>' + escapeHtml(item.label) + '</strong><span>' + escapeHtml(item.meta) + '</span></a>').join('')
        ).join('');
        results.innerHTML = html || '<div class="search-empty">No products or categories found.</div>';
        results.hidden = false;
    };
    input.addEventListener('input', () => {
        clearTimeout(timer);
        const term = input.value.trim();
        if (term.length < 2) { results.hidden = true; return; }
        timer = setTimeout(async () => {
            try {
                const response = await fetch('{{ route('search.suggestions') }}?q=' + encodeURIComponent(term), { headers: { Accept: 'application/json' } });
                render(await response.json());
            } catch { results.hidden = true; }
        }, 220);
    });
    input.addEventListener('focus', () => { if (input.value.trim().length >= 2) results.hidden = false; });
    document.addEventListener('click', event => { if (!search.contains(event.target)) results.hidden = true; });
})();
</script>

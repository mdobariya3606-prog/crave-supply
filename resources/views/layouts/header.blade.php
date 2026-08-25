<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}">
<header class="site-header">
    <nav class="nav-wrap" aria-label="Main navigation">
        {{-- Brand and global search stay visible at every breakpoint. --}}
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark">CS</span>
            <span>CraveSupply</span>
        </a>
        <div class="global-search" data-global-search>
            <form action="{{ route('products.dashboard') }}" method="GET" role="search">
                <label class="search-label" for="global-search-input">Search products and categories</label>
                <input id="global-search-input" name="q" type="search" autocomplete="off"
                    placeholder="Search products or categories" data-search-input>
            </form>
            <div class="search-results" data-search-results hidden></div>
        </div>
        {{-- Desktop navigation links; hidden on narrow screens. --}}
        <div class="nav-links">
            <a href="{{ route('home') }}" class={{ request()->routeIs('home') || request()->routeIs('dashboard') ? 'active' : '' }}>Home</a>
            <a href="{{ url('/products') }}" class={{ request()->routeIs('products.*') ? 'active' : '' }}>Products</a>
            <a href="{{ route('about') }}" class={{ request()->routeIs('about') ? 'active' : '' }}>About</a>
            @if (!auth()->check() || auth()->user()?->role === 'customer')
                <a href="{{ route('cart.index') }}" class={{ request()->routeIs('cart.*') ? 'active' : '' }}>
                    Cart{{ ($cartCount ?? collect(session('cart', []))->sum('quantity')) ? ' (' . ($cartCount ?? collect(session('cart', []))->sum('quantity')) . ')' : '' }}
                </a>
            @endif
            @if (auth()->user()?->role === 'customer')
                <a href="{{ route('orders.index') }}" class={{ request()->routeIs('orders.index') ? 'active' : '' }}>Orders</a>
            @endif
            @guest
                <a href="{{ route('login') }}" class={{ request()->routeIs('login') ? 'active' : '' }}>Login</a>
                <a class="nav-cta" href="{{ route('register') }}" class={{ request()->routeIs('register') ? 'active' : '' }}>Register</a>
            @endguest
        </div>
        {{-- Account trigger and popup. The popup is positioned outside the header flow. --}}
        <div class="user-menu">
            <span>{{ auth()->user()->name ?? 'Customer' }}</span>
            <div class="profile-dropdown">
                <button type="button" class="avatar profile-trigger" aria-label="Open navigation menu" aria-expanded="false"
                    aria-controls="profileMenu">
                    <svg class="menu-icon" viewBox="0 0 20 20" aria-hidden="true">
                        <path class="menu-bar menu-bar-one" d="M2 4h16" />
                        <path class="menu-bar menu-bar-two" d="M2 10h16" />
                        <path class="menu-bar menu-bar-three" d="M2 16h16" />
                        <path class="menu-cross menu-cross-one" d="M4 4 16 16" />
                        <path class="menu-cross menu-cross-two" d="M16 4 4 16" />
                    </svg>
                </button>
                <div id="profileMenu" class="profile-menu" hidden>
                    <a href="{{ route('home') }}">Dashboard</a>
                    <a href="{{ route('products.dashboard') }}">Products</a>
                    <a href="{{ route('about') }}">About us</a>
                    @auth
                    <a href="{{ route('profile') }}">Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" onclick='return confirm("Are you sure to logout?")'>
                                Logout
                            </button>
                        </form>
                    @else
                    <a href="{{ route('login') }}">Login</a>
                    @endauth
                    <button type="button" class="theme-menu-item" data-theme-toggle aria-label="Switch to dark mode"
                        aria-pressed="false"><span data-theme-icon>☾</span><span data-theme-label>Dark mode</span></button>
                </div>
            </div>
        </div>
    </nav>
</header>

{{-- Header-only styles are kept here because this partial owns these elements. --}}
<style>
    .global-search {
        position: relative;
        flex: 0 1 300px;
        order: 1;
    }

    .global-search form {
        display: flex;
        align-items: center;
        height: 36px;
        overflow: hidden;
        border: 1px solid #cfc3b4;
        border-radius: 0;
        background: #fffdf9;
    }

    .search-label {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip: rect(0 0 0 0);
    }

    .global-search input {
        min-width: 0;
        flex: 1;
        padding: 0 11px;
        border: 0;
        outline: 0;
        color: #29251f;
        font: inherit;
        font-size: 12px;
    }

    .global-search form:focus-within {
        border-color: #8d6c4a;
        box-shadow: 0 0 0 3px rgba(141, 108, 74, .14);
    }

    .global-search button {
        width: 36px;
        height: 100%;
        border: 0;
        color: #fffdf9;
        background: #2c2722;
        font-size: 17px;
        cursor: pointer;
    }

    .nav-cta {
        padding: 8px 12px;
        border-radius: 0;
        color: #fff !important;
        background: #2c2722;
    }

    .search-results {
        position: absolute;
        z-index: 30;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        overflow: hidden;
        border: 1px solid #ded4c8;
        border-radius: 0;
        background: #fffdf9;
        box-shadow: 0 16px 34px rgba(68, 48, 31, .14);
    }

    .search-group-title {
        padding: 10px 12px 6px;
        color: #8d8376;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .search-result {
        display: block;
        padding: 10px 12px;
        color: #29251f;
        text-decoration: none;
    }

    .search-result:hover {
        background: #f1e9df;
    }

    .search-result strong {
        display: block;
        font-size: 12px;
    }

    .search-result span {
        display: block;
        margin-top: 3px;
        color: #8d8376;
        font-size: 11px;
    }

    .search-empty {
        padding: 14px 12px;
        color: #8d8376;
        font-size: 12px;
    }

    @media (max-width:760px) {
        .global-search {
            flex: 0 0 100%;
            order: 4;
        }

        .global-search form {
            height: 36px;
        }

        .global-search input {
            font-size: 12px;
        }
    }
</style>

{{-- Profile menu open/close behavior. --}}
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
        const root = document.documentElement;
        const toggle = document.querySelector('[data-theme-toggle]');
        const icon = document.querySelector('[data-theme-icon]');
        const label = document.querySelector('[data-theme-label]');
        const savedTheme = localStorage.getItem('cravesupply-theme');
        const prefersDark = window.matchMedia?.('(prefers-color-scheme: dark)').matches;
        const applyTheme = theme => {
            const dark = theme === 'dark';
            root.dataset.theme = dark ? 'dark' : 'light';
            if (toggle) {
                toggle.setAttribute('aria-pressed', String(dark));
                toggle.setAttribute('aria-label', dark ? 'Switch to light mode' : 'Switch to dark mode');
            }
            if (icon) icon.textContent = dark ? '☀' : '☾';
            if (label) label.textContent = dark ? 'Light mode' : 'Dark mode';
        };
        applyTheme(savedTheme || (prefersDark ? 'dark' : 'light'));
        toggle?.addEventListener('click', () => {
            const next = root.dataset.theme === 'dark' ? 'light' : 'dark';
            localStorage.setItem('cravesupply-theme', next);
            applyTheme(next);
        });
    })();
</script>

{{-- Debounced product/category search suggestions. --}}
<script>
    (() => {
        const search = document.querySelector('[data-global-search]');
        if (!search) return;
        const input = search.querySelector('[data-search-input]');
        const results = search.querySelector('[data-search-results]');
        let timer;
        const escapeHtml = value => String(value).replace(/[&<>"']/g, character => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[character]));
        const render = data => {
            const groups = [
                ['Products', data.products || []],
                ['Categories', data.categories || []]
            ];
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
            if (term.length < 2) {
                results.hidden = true;
                return;
            }
            timer = setTimeout(async () => {
                try {
                    const response = await fetch('{{ route('search.suggestions') }}?q=' + encodeURIComponent(term), {
                        headers: {
                            Accept: 'application/json'
                        }
                    });
                    render(await response.json());
                } catch {
                    results.hidden = true;
                }
            }, 220);
        });
        input.addEventListener('focus', () => {
            if (input.value.trim().length >= 2) results.hidden = false;
        });
        document.addEventListener('click', event => {
            if (!search.contains(event.target)) results.hidden = true;
        });
    })();
</script>

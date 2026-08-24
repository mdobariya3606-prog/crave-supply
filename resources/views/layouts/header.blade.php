<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
<header class="site-header">
    <nav class="nav-wrap" aria-label="Main navigation">
        <a class="brand" href="{{ url('/dashboard') }}">
            <span class="brand-mark">CS</span>
            <span>CraveSupply</span>
        </a>
        <div class="nav-links">
            <a href="{{ url('/dashboard') }}" class={{ request()->routeIs('dashboard') ? 'active' : '' }}>Dashboard</a>
            <a href="{{ url('/dashboard#catalogue') }}"
                class={{ request()->routeIs('#catalogue') ? 'active' : '' }}>Catalogue</a>
            <a href="{{ url('/dashboard#restock-guide') }}"class={{ request()->routeIs('login') ? 'active' : '' }}>Restock
                guide</a>
            <a href="{{ url('/products') }}" class={{ request()->routeIs('products.*') ? 'active' : '' }}>Products</a>
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

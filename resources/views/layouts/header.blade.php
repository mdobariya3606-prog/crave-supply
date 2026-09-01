<script>
    (function () {
        var savedTheme = localStorage.getItem("cravesupply-theme");
        var prefersDark =
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches;
        document.documentElement.dataset.theme =
            savedTheme || (prefersDark ? "dark" : "light");
    })();
</script>
<link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
<link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}" />
<header class="site-header">
    <nav class="nav-wrap" aria-label="Main navigation">
        {{-- Brand and global search stay visible at every breakpoint. --}}
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark">CS</span>
            <span class="cravesupply-title">CraveSupply</span>
        </a>
        <div class="global-search" data-global-search>
            <form
                action="{{ route('products.dashboard') }}"
                method="GET"
                role="search"
            >
                <label class="search-label" for="global-search-input"
                    >Search products and categories</label
                >
                <input
                    id="global-search-input"
                    name="q"
                    type="search"
                    autocomplete="off"
                    placeholder="Search products or categories"
                    data-search-input
                />
            </form>
            <div class="search-results" data-search-results hidden></div>
        </div>
        {{-- Desktop navigation links; hidden on narrow screens. --}}
        <div class="nav-links">
            <a
                href="{{ url('/products') }}"
                class={{ request()->routeIs('products.*') ? 'active' : '' }}
                >Products</a
            >
            @if (!auth()->check() || auth()->user()?->role === 'customer')
                <a
                    href="{{ route('cart.index') }}"
                    class={{ request()->routeIs('cart.*') ? 'active' : '' }}
                >
                    Cart
                    <span
                        data-cart-count
                        >{{ ($cartCount ?? collect(session('cart', []))->sum('quantity')) ? '(' . ($cartCount ?? collect(session('cart', []))->sum('quantity')) . ')' : '' }}</span
                    >
                </a>
            @endif
            @if (auth()->user()?->role === 'customer')
                <a
                    href="{{ route('orders.index') }}"
                    class={{ request()->routeIs('orders.index') ? 'active' : ''
                                            }}
                    >Orders</a
                >
            @endif
            @guest
                <a
                    href="{{ route('login') }}"
                    class={{ request()->routeIs('login') ? 'active' : '' }}
                    >Login</a
                >
                <a
                    class="nav-cta"
                    href="{{ route('register') }}"
                    class={{ request()->routeIs('register') ? 'active' : ''
                                            }}
                    >Register</a
                >
            @endguest
        </div>
        @if (auth()->user()?->role === 'customer')
            <a
                class="mobile-cart-link"
                href="{{ route('cart.index') }}"
                aria-label="Open cart"
            >
                Cart
                <span
                    data-cart-count
                    >{{ ($cartCount ?? collect(session('cart', []))->sum('quantity')) ? '(' . ($cartCount ?? collect(session('cart', []))->sum('quantity')) . ')' : '' }}</span
                >
            </a>
        @endif
        {{-- Account trigger and popup. The popup is positioned outside the header flow. --}}
        <div class="user-menu">
            <span>{{ auth()->user()->name ?? 'Customer' }}</span>
            <div class="profile-dropdown">
                <button
                    type="button"
                    class="avatar profile-trigger"
                    aria-label="Open navigation menu"
                    aria-expanded="false"
                    aria-controls="profileMenu"
                >
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
                    <a href="{{ route('cache.clear') }}">Clear cache</a>
                    @auth
                        <a href="{{ route('profile') }}">Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                class="btn-logout"
                                type="submit"
                                onclick="
                                    return confirm('Are you sure to logout?');
                                "
                                style="border-radius: 8px !important"
                            >
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                    <button
                        type="button"
                        class="theme-menu-item"
                        data-theme-toggle
                        aria-label="Switch to dark mode"
                        aria-pressed="false"
                    >
                        <span data-theme-icon>☾</span
                        ><span data-theme-label>Dark mode</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        document
            .querySelectorAll(".nav-category-trigger")
            .forEach((trigger) => {
                trigger.addEventListener("click", () => {
                    const menu = trigger.closest(".nav-category-menu");
                    const open = menu.classList.toggle("is-open");
                    trigger.setAttribute(
                        "aria-expanded",
                        open ? "true" : "false",
                    );
                });
            });
        document.addEventListener("click", (event) => {
            document
                .querySelectorAll(".nav-category-menu.is-open")
                .forEach((menu) => {
                    if (!menu.contains(event.target)) {
                        menu.classList.remove("is-open");
                        menu.querySelector(
                            ".nav-category-trigger",
                        )?.setAttribute("aria-expanded", "false");
                    }
                });
        });
        document.addEventListener("keydown", (event) => {
            if (event.key !== "Escape") return;
            document
                .querySelectorAll(".nav-category-menu.is-open")
                .forEach((menu) => {
                    menu.classList.remove("is-open");
                    menu.querySelector(".nav-category-trigger")?.setAttribute(
                        "aria-expanded",
                        "false",
                    );
                });
        });
    });
</script>

{{-- Header-only styles are kept here because this partial owns these elements. --}}
<style>
    .global-search {
        position: relative;
        flex: 0 1 300px;
        order: 1;
    }

    .nav-category-menu {
        position: relative;
    }

    .nav-category-trigger {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 0;
        border: 0;
        color: inherit !important;
        background: transparent !important;
        font: inherit;
        letter-spacing: inherit;
        text-transform: inherit;
        cursor: pointer;
    }

    html[data-theme="dark"] .nav-category-trigger,
    html[data-theme="dark"] .nav-category-trigger:hover {
        color: inherit !important;
        background: transparent !important;
    }

    .nav-category-chevron {
        width: 13px;
        height: 13px;
        transition: transform .2s ease;
    }

    .nav-category-trigger:hover,
    .nav-category-trigger.active {
        color: var(--layout-blue);
        background: transparent !important;
    }

    .nav-category-menu.is-open .nav-category-chevron {
        transform: rotate(180deg);
    }

    .profile-category-menu {
        position: relative;
    }

    .profile-category-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 10px 12px;
        border: 0;
        border-radius: 8px !important;
        color: var(--layout-ink) !important;
        background: transparent !important;
        font: inherit;
        font-size: 13px;
        text-align: left;
        cursor: pointer;
    }

    .profile-category-trigger:hover,
    .profile-category-menu.is-open .profile-category-trigger {
        color: var(--layout-navy);
        background: #f1e9df !important;
    }

    .profile-category-trigger svg {
        width: 13px;
        height: 13px;
        transform: rotate(90deg);
        transition: transform .2s ease;
    }

    .profile-category-menu.is-open .profile-category-trigger svg {
        transform: rotate(270deg);
    }

    .profile-category-list {
        position: absolute;
        z-index: 30;
        top: -7px;
        right: calc(100% + 8px);
        display: none;
        width: 210px;
        max-width: calc(100vw - 44px);
        max-height: min(70vh, 420px);
        overflow-y: auto;
        overscroll-behavior: contain;
        padding: 6px;
        border: 1px solid var(--layout-line);
        border-radius: 12px;
        background: var(--layout-surface);
        box-shadow: 0 12px 30px rgba(15, 23, 42, .14);
    }

    .profile-category-menu.is-open .profile-category-list {
        display: block;
    }

    .profile-category-list a {
        padding: 10px 12px;
        font-size: 13px;
    }

    @media (max-width: 760px) {
        .profile-category-list {
            top: -7px;
            right: calc(100% + 8px);
            max-width: calc(100vw - 44px);
            max-height: calc(100vh - 150px);
        }
    }

    .nav-category-dropdown {
        position: absolute;
        z-index: 20;
        top: calc(100% + 10px);
        left: 50%;
        display: grid;
        min-width: 210px;
        padding: 8px;
        border: 1px solid #ded4c8;
        border-radius: 12px;
        background: #fffdf9;
        box-shadow: 0 14px 30px rgba(44, 39, 34, .14);
        opacity: 0;
        pointer-events: none;
        transform: translate(-50%, -6px);
        transition: opacity .18s ease, transform .18s ease;
    }

    html[data-theme="dark"] .nav-category-dropdown {
        background: #1d1916 !important;
    }

    .nav-category-menu.is-open .nav-category-dropdown {
        opacity: 1;
        pointer-events: auto;
        transform: translate(-50%, 0);
    }

    .nav-category-dropdown a,
    .nav-category-empty {
        padding: 9px 11px;
        border-radius: 7px;
        color: #51483e;
        font-size: 12px;
        text-decoration: none;
    }

    .nav-category-dropdown a:hover {
        color: #17362a;
        background: #f3eee6;
    }

    html[data-theme='dark'] .nav-category-dropdown a:hover {
        color: #f3eee6;
        background: #17362a;
    }

    .nav-category-empty {
        color: #8d8376;
    }

    @media (max-width: 760px) {
        .nav-category-menu {
            width: 100%;
        }

        .nav-category-trigger {
            width: 100%;
            justify-content: space-between;
        }

        .nav-category-dropdown {
            position: static;
            display: none;
            width: 100%;
            margin-top: 4px;
            transform: none;
            box-shadow: none;
        }

        .nav-category-menu.is-open .nav-category-dropdown {
            display: grid;
            opacity: 1;
            pointer-events: auto;
            transform: none;
        }
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
        height: 100%;
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
        border-radius: 15px;
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

    html[data-theme='dark'] .search-result:hover {
        background: #503c20;
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
        const trigger = document.querySelector(".profile-trigger");
        const menu = document.getElementById("profileMenu");

        if (!trigger || !menu) return;

        document
            .querySelector(".profile-category-trigger")
            ?.addEventListener("click", (event) => {
                event.stopPropagation();
                const categoryMenu = event.currentTarget.closest(
                    ".profile-category-menu",
                );
                const isOpen = categoryMenu.classList.toggle("is-open");
                event.currentTarget.setAttribute(
                    "aria-expanded",
                    String(isOpen),
                );
            });

        trigger.addEventListener("click", () => {
            const isOpen = !menu.hidden;
            menu.hidden = isOpen;
            trigger.setAttribute("aria-expanded", String(!isOpen));
            if (isOpen) {
                menu.querySelector(".profile-category-menu")?.classList.remove(
                    "is-open",
                );
                menu.querySelector(".profile-category-trigger")?.setAttribute(
                    "aria-expanded",
                    "false",
                );
            }
        });

        document.addEventListener("click", (event) => {
            if (!event.target.closest(".profile-dropdown")) {
                menu.hidden = true;
                trigger.setAttribute("aria-expanded", "false");
                menu.querySelector(".profile-category-menu")?.classList.remove(
                    "is-open",
                );
                menu.querySelector(".profile-category-trigger")?.setAttribute(
                    "aria-expanded",
                    "false",
                );
            }
        });
    })();
</script>

<script>
    (() => {
        const root = document.documentElement;
        const toggle = document.querySelector("[data-theme-toggle]");
        const icon = document.querySelector("[data-theme-icon]");
        const label = document.querySelector("[data-theme-label]");
        const savedTheme = localStorage.getItem("cravesupply-theme");
        const prefersDark = window.matchMedia?.(
            "(prefers-color-scheme: dark)",
        ).matches;
        const applyTheme = (theme) => {
            const dark = theme === "dark";
            root.dataset.theme = dark ? "dark" : "light";
            if (toggle) {
                toggle.setAttribute("aria-pressed", String(dark));
                toggle.setAttribute(
                    "aria-label",
                    dark ? "Switch to light mode" : "Switch to dark mode",
                );
            }
            if (icon) icon.textContent = dark ? "☀" : "☾";
            if (label) label.textContent = dark ? "Light mode" : "Dark mode";
        };
        applyTheme(savedTheme || (prefersDark ? "dark" : "light"));
        toggle?.addEventListener("click", () => {
            const next = root.dataset.theme === "dark" ? "light" : "dark";
            localStorage.setItem("cravesupply-theme", next);
            applyTheme(next);
        });
    })();
</script>

{{-- Debounced product/category search suggestions. --}}
<script>
    (() => {
        const search = document.querySelector("[data-global-search]");
        if (!search) return;
        const input = search.querySelector("[data-search-input]");
        const results = search.querySelector("[data-search-results]");
        let timer;
        const escapeHtml = (value) =>
            String(value).replace(
                /[&<>"']/g,
                (character) =>
                    ({
                        "&": "&amp;",
                        "<": "&lt;",
                        ">": "&gt;",
                        '"': "&quot;",
                        "'": "&#039;",
                    })[character],
            );
        const render = (data) => {
            const groups = [
                ["Products", data.products || []],
                ["Categories", data.categories || []],
            ];
            const html = groups
                .filter(([, items]) => items.length)
                .map(
                    ([title, items]) =>
                        '<div class="search-group-title">' +
                        title +
                        "</div>" +
                        items
                            .map(
                                (item) =>
                                    '<a class="search-result" href="' +
                                    encodeURI(item.url) +
                                    '"><strong>' +
                                    escapeHtml(item.label) +
                                    "</strong><span>" +
                                    escapeHtml(item.meta) +
                                    "</span></a>",
                            )
                            .join(""),
                )
                .join("");
            results.innerHTML =
                html ||
                '<div class="search-empty">No products or categories found.</div>';
            results.hidden = false;
        };
        input.addEventListener("input", () => {
            clearTimeout(timer);
            const term = input.value.trim();
            if (term.length < 2) {
                results.hidden = true;
                return;
            }
            timer = setTimeout(async () => {
                try {
                    const response = await fetch(
                        "{{ route('search.suggestions') }}?q=" +
                            encodeURIComponent(term),
                        {
                            headers: {
                                Accept: "application/json",
                            },
                        },
                    );
                    render(await response.json());
                } catch {
                    results.hidden = true;
                }
            }, 220);
        });
        input.addEventListener("focus", () => {
            if (input.value.trim().length >= 2) results.hidden = false;
        });
        document.addEventListener("click", (event) => {
            if (!search.contains(event.target)) results.hidden = true;
        });
    })();
</script>

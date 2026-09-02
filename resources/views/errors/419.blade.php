<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page Expired — CraveSupply</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/error-pages.css') }}" />
    <script>document.documentElement.dataset.theme = localStorage.getItem('cravesupply-theme') === 'dark' ? 'dark' : 'light';</script>
</head>

<body>
    <main class="error-page">
        <section class="error-card">
            <a class="brand" href="{{ url('/') }}"
                ><span class="brand-mark">CS</span> CraveSupply</a
            >
            <div class="snack-icon" aria-hidden="true">⏳</div>
            <p class="error-code">419</p>
            <h1>This page has expired.</h1>
            <p>Your session timed out or the form was open too long. Please return to the page and try again.</p>
            <div class="error-actions">
                <a
                    class="btn btn-primary"
                    href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}"
                    >Try again</a
                ><a class="btn btn-secondary" href="{{ route('login') }}"
                    >Log in</a
                >
            </div>
            <div class="error-footer">
                Your account and orders are still safe.
            </div>
        </section>
    </main>
</body>
</html>

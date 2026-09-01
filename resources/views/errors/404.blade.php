<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page Not Found — CraveSupply</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/error-pages.css') }}" />
</head>

<body>
    <main class="error-page">
        <section class="error-card">
            <a class="brand" href="{{ url('/') }}"
                ><span class="brand-mark">CS</span> CraveSupply</a
            >
            <div class="snack-icon" aria-hidden="true">🍪</div>
            <p class="error-code">404</p>
            <h1>Looks like this snack is out of stock.</h1>
            <p>We couldn’t find the page you were looking for. It may have moved, or the link may be incorrect.</p>
            <div class="error-actions">
                <a class="btn btn-primary" href="{{ url('/dashboard') }}"
                    >Back to dashboard</a
                ><a class="btn btn-secondary" href="{{ url('/products') }}"
                    >Browse products</a
                >
            </div>
            <div class="error-footer">
                Let’s get you back to something good.
            </div>
        </section>
    </main>
</body>
</html>

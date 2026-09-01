<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Something Went Wrong — CraveSupply</title>
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
            <div class="snack-icon" aria-hidden="true">📦</div>
            <p class="error-code">500</p>
            <h1>We hit a small delivery delay.</h1>
            <p>Something went wrong on our side. Please try again in a moment, or return to your dashboard while we check the issue.</p>
            <div class="error-actions">
                <a class="btn btn-primary" href="{{ url('/dashboard') }}"
                    >Back to dashboard</a
                ><a class="btn btn-secondary" href="{{ url('/') }}"
                    >Return home</a
                >
            </div>
            <div class="error-footer">Thanks for your patience.</div>
        </section>
    </main>
</body>
</html>

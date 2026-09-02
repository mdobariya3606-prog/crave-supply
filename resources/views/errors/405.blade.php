<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Method Not Allowed — CraveSupply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/error-pages.css') }}" />
    <script>document.documentElement.dataset.theme = localStorage.getItem('cravesupply-theme') === 'dark' ? 'dark' : 'light';</script>
</head>
<body>
    <main class="error-page">
        <section class="error-card">
            <a class="brand" href="{{ url('/') }}"><span class="brand-mark">CS</span> CraveSupply</a>
            <div class="snack-icon" aria-hidden="true">🛑</div>
            <p class="error-code">405</p>
            <h1>This method isn’t allowed here.</h1>
            <p>The request method used for this page is not supported. Please return and try again.</p>
            <div class="error-actions">
                <a class="btn btn-primary" href="{{ url('/') }}">Return Home</a>
            </div>
            <div class="error-footer">Your account and orders are still safe.</div>
        </section>
    </main>
</body>
</html>

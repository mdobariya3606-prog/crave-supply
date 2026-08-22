<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted — CraveSupply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/error-pages.css') }}">
</head>

<body>
    <main class="error-page">
        <section class="error-card">
            <a class="brand" href="{{ url('/') }}"><span class="brand-mark">CS</span> CraveSupply</a>
            <div class="snack-icon" aria-hidden="true">🔒</div>
            <p class="error-code">403</p>
            <h1>This shelf is for authorized users only.</h1>
            <p>You don’t have permission to view this page. If you believe this is a mistake, please contact the
                CraveSupply team.</p>
            <div class="error-actions"><a class="btn btn-primary" href="{{ url('/dashboard') }}">Go to dashboard</a><a
                    class="btn btn-secondary" href="{{ url('/contact') }}">Contact support</a></div>
            <div class="error-footer">Your account and orders are still safe.</div>
        </section>
    </main>
</body>

</html>
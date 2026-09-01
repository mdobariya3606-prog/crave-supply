<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account disabled — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}" />
    <style>
        .disabled-page {
            min-height: calc(100vh - 160px);
            display: grid;
            place-items: center;
            width: min(620px, calc(100% - 28px));
            margin: auto;
            padding: 50px 0;
        }
        .disabled-card {
            padding: 44px 38px;
            border: 1px solid #ded4c8;
            background: #fffdf9;
            text-align: center;
            box-shadow: 0 18px 42px rgba(68, 48, 31, 0.08);
        }
        .disabled-mark {
            width: 54px;
            height: 54px;
            margin: 0 auto 20px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #8d6c4a;
            background: #f1e9df;
            font-size: 25px;
            font-weight: 700;
        }
        h1 {
            margin: 0;
            color: #29251f;
            font:
                400 38px Georgia,
                serif;
        }
        p {
            margin: 14px auto 0;
            max-width: 470px;
            color: #71695f;
            font-size: 14px;
            line-height: 1.8;
        }
        .disabled-note {
            margin-top: 24px;
            padding: 14px;
            color: #8d8376;
            background: #f8f4ed;
            font-size: 12px;
        }
        .logout-button {
            margin-top: 24px;
            padding: 12px 18px;
            border: 0;
            color: #fffdf9;
            background: #2c2722;
            cursor: pointer;
            font: inherit;
            font-size: 12px;
            font-weight: 700;
        }
        @media (max-width: 520px) {
            .disabled-card {
                padding: 32px 22px;
            }
            h1 {
                font-size: 31px;
            }
        }
    </style>
</head>
<body>
    @include ('layouts.header')
    <main class="disabled-page">
        <section class="disabled-card">
            <div class="disabled-mark">!</div>
            <h1>Your account is disabled</h1>
            <p>Your CraveSupply account has been temporarily disabled by an administrator. You have been logged out and cannot access account operations until your access is restored.</p>
            <div class="disabled-note">
                Please contact the CraveSupply team or your account
                administrator to request access again.
            </div>
            <a class="logout-button" href="{{ route('login') }}"
                >Return to login</a
            >
        </section>
    </main>
    @include ('layouts.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}">
    <style>
        .contact-page {
            width: min(980px, calc(100% - 40px));
            margin: auto;
            padding: 70px 0 90px
        }

        .contact-grid {
            display: grid;
            grid-template-columns: .8fr 1.2fr;
            gap: 56px;
            align-items: start
        }

        .eyebrow {
            margin: 0 0 12px;
            color: #8d6c4a;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase
        }

        h1,
        h2 {
            color: #29251f;
            font-family: Georgia, 'Times New Roman', serif;
            font-weight: 400
        }

        h1 {
            margin: 0;
            font-size: clamp(42px, 6vw, 68px);
            line-height: 1;
            letter-spacing: -.05em
        }

        .contact-intro p {
            color: #71695f;
            line-height: 1.8
        }

        .contact-details {
            margin-top: 32px;
            padding-top: 22px;
            border-top: 1px solid #ded4c8
        }

        .contact-details strong,
        .contact-details span {
            display: block
        }

        .contact-details strong {
            margin-bottom: 5px;
            color: #29251f
        }

        .contact-details span {
            margin-bottom: 18px;
            color: #8d8376;
            font-size: 13px
        }

        .contact-form {
            padding: 30px;
            border: 1px solid #ded4c8;
            background: #fffdf9
        }

        .contact-form h2 {
            margin: 0 0 22px;
            font-size: 28px
        }

        .contact-form label {
            display: block;
            margin-bottom: 8px;
            color: #51483e;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase
        }

        .contact-form input,
        .contact-form textarea {
            width: 90%;
            margin-bottom: 18px;
            padding: 13px 14px;
            border: 1px solid #ded4c8;
            outline: 0;
            color: #29251f;
            background: #f8f4ed;
            font: inherit
        }

        .contact-form textarea {
            min-height: 140px;
            resize: vertical
        }

        .contact-form button {
            padding: 13px 18px;
            border: 0;
            color: #fffdf9;
            background: #2c2722;
            cursor: pointer
        }

        .contact-success {
            margin-bottom: 18px;
            padding: 13px 15px;
            color: #49603b;
            background: #e8eddf;
            font-size: 13px
        }

        .contact-error {
            margin-bottom: 18px;
            color: #a04338;
            font-size: 13px
        }

        @media(max-width:700px) {
            .contact-page {
                width: calc(100% - 28px);
                padding: 42px 0 60px
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 34px
            }

            .contact-form {
                padding: 22px
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="contact-page">
        <div class="contact-grid">
            <section class="contact-intro">
                <p class="eyebrow">We’re here to help</p>
                <h1>Let’s talk snacks.</h1>
                <p>Need help choosing products, planning a restock, or finding something specific? Send us a note and
                    our team will get back to you.</p>
                <div class="contact-details">
                    <strong>Email</strong><span>hello@cravesupply.test</span><strong>Hours</strong><span>Monday–Friday,
                        9:00–18:00</span><strong>Response time</strong><span>Usually within one business day.</span>
                </div>
            </section>
            <section class="contact-form">
                <h2>Send us a message</h2>@if(session('contact_success'))
                <div class="contact-success" role="status">{{ session('contact_success') }}</div>@endif
                @if($errors->any())
                <div class="contact-error" role="alert">{{ $errors->first() }}</div>@endif
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <label for="contact-name">Name</label>
                    <input id="contact-name" name="name" value="{{ old('name') }}" required>
                    <label for="contact-email">Email</label>
                    <input id="contact-email" name="email" type="email" value="{{ old('email') }}" required>
                    <label for="contact-message">Message</label>
                    <textarea id=" contact-message" name="message" required>{{ old('message') }}</textarea>
                    <button type="submit">Send message</button>
                </form>
            </section>
        </div>
    </main>
    @include('layouts.footer')
</body>

</html>

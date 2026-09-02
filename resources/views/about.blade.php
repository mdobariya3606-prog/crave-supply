<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About us — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}" />
    <style>
        .about-page {
            width: min(1080px, calc(100% - 40px));
            margin: auto;
            padding: 70px 0 90px
        }

        .about-hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 56px;
            align-items: center;
            padding-bottom: 70px
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
            font-size: clamp(42px, 6vw, 72px);
            line-height: .98;
            letter-spacing: -.05em
        }

        h2 {
            margin: 0 0 14px;
            font-size: 34px
        }

        .about-hero p,
        .about-copy p {
            color: #71695f;
            line-height: 1.8
        }

        .about-visual {
            min-height: 360px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, #dba8a3, #8d6c4a)
        }

        .about-visual:before,
        .about-visual:after {
            content: '';
            position: absolute;
            border: 1px solid rgba(255, 255, 255, .55);
            border-radius: 50%
        }

        .about-visual:before {
            width: 320px;
            height: 320px;
            right: -80px;
            top: -60px;
            box-shadow: 0 0 0 35px rgba(255, 255, 255, .1), 0 0 0 70px rgba(255, 255, 255, .08)
        }

        .about-visual:after {
            width: 160px;
            height: 160px;
            left: 50px;
            bottom: -70px
        }

        .about-values {
            overflow: hidden;
            display: grid;
            grid-template-columns: repeat(3, 3fr);
            gap: 1px;
            margin-top: 18px;
            background: #ded4c8;
            border: 1px solid #e7e4d9;
            border-radius: 16px;
        }

        .value {
            padding: 28px 24px;
            background: #fffdf9
        }

        .value strong {
            display: block;
            margin-bottom: 8px;
            color: #5b6840;
        }

        .value span {
            color: #8d8376;
            font-size: 13px;
            line-height: 1.6
        }

        .about-copy {
            max-width: 720px;
            margin: 76px auto 0
        }

        @media(max-width:700px) {
            .about-page {
                width: calc(100% - 28px);
                padding: 42px 0 60px
            }

            .about-hero {
                grid-template-columns: 1fr;
                gap: 30px
            }

            .about-visual {
                min-height: 230px
            }

            .about-values {
                grid-template-columns: 1fr
            }

            .about-copy {
                margin-top: 52px
            }
        }

        .about-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 56px;
            margin-top: 82px;
            padding-top: 58px;
            border-top: 1px solid #ded4c8
        }

        .about-section h2 {
            margin: 0 0 16px
        }

        .about-section p {
            color: #71695f;
            line-height: 1.8
        }

        .about-list {
            display: grid;
            gap: 12px;
            margin: 24px 0 0;
            padding: 0;
            list-style: none
        }

        .about-list li {
            padding: 14px 0;
            border-top: 1px solid #ded4c8;
            color: #51483e;
            font-size: 13px
        }

        .about-list strong {
            display: block;
            margin-bottom: 4px;
            color: #29251f
        }

        .about-note {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-top: 82px;
            padding: 32px;
            background: #2c2722;
            color: #f8f4ed;
            border-radius: 24px;
        }

        .about-note h2 {
            margin: 0;
            color: #f8f4ed
        }

        .about-note p {
            margin: 8px 0 0;
            color: #cbbeb0;
            font-size: 13px;
            line-height: 1.6
        }

        .about-note a {
            display: inline-block;
            padding: 13px 18px;
            color: #29251f;
            background: #dba8a3;
            border-radius: 18px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none
        }

        .about-stat-grid {
            overflow: hidden;
            display: grid;
            grid-template-columns: repeat(3, 3fr);
            gap: 1px;
            margin-top: 82px;
            background: #ded4c8;
            border: 1px solid #e7e4d9;
            border-radius: 16px;
        }

        .about-stat {
            padding: 26px 20px;
            background: #fffdf9
        }

        .about-stat strong {
            display: block;
            color: #8d6c4a;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 31px;
            font-weight: 400
        }

        .about-stat span {
            display: block;
            margin-top: 6px;
            color: #8d8376;
            font-size: 12px
        }

        @media(max-width:700px) {
            .about-section {
                grid-template-columns: 1fr;
                gap: 22px
            }

            .about-stat-grid {
                grid-template-columns: 1fr
            }

            .about-note {
                display: block
            }

            .about-note a {
                display: inline-block;
                margin-top: 20px
            }
        }

        .about-contact {
            display: grid;
            grid-template-columns: .8fr 1.2fr;
            gap: 56px;
            margin-top: 82px;
            padding-top: 58px;
            border-top: 1px solid #ded4c8
        }

        .about-contact h2 {
            margin: 0 0 14px
        }

        .about-contact p {
            color: #71695f;
            line-height: 1.8
        }

        .about-contact-form {
            padding: 30px;
            border: 1px solid #ded4c8;
            border-radius: 36px;
            background: #fffdf9
        }

        .about-contact-form label {
            display: block;
            margin-bottom: 7px;
            color: #51483e;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase
        }

        .about-contact-form input,
        .about-contact-form textarea {
            outline: none;
            box-sizing: border-box;
            width: 100%;
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ded4c8;
            border-radius: 18px;
            background: #f8f4ed;
            font: inherit;
            transition: 0.2s ease;
        }

        .about-contact-form textarea {
            min-height: 130px;
            resize: vertical
        }

        .about-contact-form button {
            padding: 13px 18px;
            border: 0;
            cursor: pointer
        }

        .about-contact-error {
            margin: 0 0 16px;
            color: #a04338;
            font-size: 13px
        }

        .about-contact-success {
            margin: 0 0 16px;
            padding: 12px;
            color: #49603b;
            background: #e8eddf;
            font-size: 13px
        }

        .about-field-error {
            display: block;
            margin: -9px 0 14px;
            color: #a04338;
            font-size: 12px
        }

        @media(max-width:700px) {
            .about-contact {
                grid-template-columns: 1fr;
                gap: 28px
            }
        }
    </style>
</head>

<body>
    @include ('layouts.header')
    <main class="about-page">
        <section class="about-hero">
            <div>
                <p class="eyebrow">A better way to stock the everyday</p>
                <h1>Good snacks. Thoughtful supply.</h1>
                <p>CraveSupply helps offices, cafés, retailers, and growing teams keep the things people reach for most close at hand.</p>
            </div>
            <div
                class="about-visual"
                aria-label="Abstract CraveSupply brand artwork"></div>
        </section>
        <section class="about-values" aria-label="Our values">
            <div class="value">
                <strong>Curated with care</strong><span>Dependable products that earn their place on your
                    shelf.</span>
            </div>
            <div class="value">
                <strong>Simple by design</strong><span>Clear categories, easy ordering, and service that respects
                    your time.</span>
            </div>
            <div class="value">
                <strong>Made for real teams</strong><span>Practical choices for shared spaces, customers, and
                    everyday breaks.</span>
            </div>
        </section>
        <section class="about-copy" id="privacy">
            <p class="eyebrow">Our promise</p>
            <h2>Small details make a better break.</h2>
            <p>From the first browse to the next restock, we want CraveSupply to feel considered, calm, and useful. We are building a dependable catalogue for the moments between the big moments.</p>
        </section>
        <section class="about-stat-grid">
            <div class="about-stat">
                <strong>01</strong><span>Curated catalogue</span>
            </div>
            <div class="about-stat">
                <strong>24/7</strong><span>Simple online ordering</span>
            </div>
            <div class="about-stat">
                <strong>100%</strong><span>Focused on better breaks</span>
            </div>
        </section>
        <section class="about-section">
            <div>
                <p class="eyebrow">Why we started</p>
                <h2>Snacks should be easy to get right.</h2>
            </div>
            <div>
                <p>Stocking a pantry, counter, or office shelf should not require hours of searching or guesswork. CraveSupply was created to make everyday replenishment feel more thoughtful and much less complicated.</p>
                <p>We bring together familiar favourites and considered discoveries in one calm, easy-to-use place, so teams can spend less time managing supplies and more time getting on with their work.</p>
            </div>
        </section>
        <section class="about-section">
            <div>
                <p class="eyebrow">What we look for</p>
                <h2>Good products earn their place.</h2>
            </div>
            <div>
                <ul class="about-list">
                    <li>
                        <strong>Reliable quality</strong>
                        <p>Products people enjoy today and are happy to choose again tomorrow.</p>
                    </li>
                    <li>
                        <strong>Everyday usefulness</strong>
                        <p>Snacks and drinks that work for real teams, counters, meetings, and breaks.</p>
                    </li>
                    <li>
                        <strong>Clear value</strong>
                        <p>Thoughtful choices that make sense for your shelves and your routine.</p>
                    </li>
                </ul>
            </div>
        </section>
        <section class="about-section">
            <div>
                <p class="eyebrow">Made for your kind of day</p>
                <h2>From first coffee to last call.</h2>
            </div>
            <div>
                <p>Whether you run a growing office, a busy café, a neighbourhood store, or a hospitality space, your people deserve better choices within reach.</p>
                <p>Our catalogue is designed around the way businesses actually buy: browse by category, build a dependable repeat list, and restock without friction.</p>
            </div>
        </section>
        <section class="about-note">
            <div>
                <h2>Ready to make your shelves feel considered?</h2>
                <p>Explore the CraveSupply range and find a better rhythm for your next restock.</p>
            </div>
            <a href="{{ route('products.dashboard') }}">Explore products →</a>
        </section>
        <section class="about-contact" aria-labelledby="about-contact-title">
            <div>
                <p class="eyebrow">Get in touch</p>
                <h2 id="about-contact-title">Tell us how we can help.</h2>
                <p>Have a question about stocking your business or finding the right products? Send us a message and our team will get back to you.</p>
            </div>
            <form
                class="about-contact-form"
                action="{{ route('contact.submit') }}"
                method="POST">
                @csrf
                @if (session('contact_success'))
                <p class="about-contact-success" role="status">{{ session('contact_success') }}</p>
                @endif
                @if ($errors->any())
                <p class="about-contact-error" role="alert">Please correct the highlighted fields.</p>
                @endif
                <label for="about-name">Name *</label>
                <input
                    id="about-name"
                    name="name"
                    value="{{ old('name') }}"
                    required />
                @error ('name')
                <small class="about-field-error">{{ $message }}</small>
                @enderror
                <label for="about-business-name">Business name</label>
                <input
                    id="about-business-name"
                    name="business_name"
                    value="{{ old('business_name') }}" />
                @error ('business_name')
                <small class="about-field-error">{{ $message }}</small>
                @enderror
                <label for="about-email">Email *</label>
                <input
                    id="about-email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required />
                @error ('email')
                <small class="about-field-error">{{ $message }}</small>
                @enderror
                <label for="about-phone">Phone</label>
                <input
                    id="about-phone"
                    name="phone"
                    type="tel"
                    value="{{ old('phone') }}" />
                @error ('phone')
                <small class="about-field-error">{{ $message }}</small>
                @enderror
                <label for="about-message">Message *</label>
                <textarea
                    id="about-message"
                    name="message"
                    required>{{ old('message') }}</textarea>
                @error ('message')
                <small class="about-field-error">{{ $message }}</small>
                @enderror
                <button type="submit">Send message</button>
            </form>
        </section>
    </main>
    @include ('layouts.footer')
</body>

</html>

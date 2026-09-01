<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CraveSupply — Better snacks for every break</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <style>
        :root {
            --navy: #2c2722;
            --blue: #8d6c4a;
            --ink: #29251f;
            --muted: #8d8376;
            --line: #ded4c8;
            --page: #f8f4ed;
            --orange: #e85d04;
            --forest: #5b6840;
            --cream: #f8f4ed;
            --gold: #dba8a3;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--cream);
            font-family: 'DM Sans', sans-serif;
        }

        .login-popup {
            position: fixed;
            z-index: 1000;
            inset: 0;
            display: grid;
            padding: 20px;
            place-items: center;
            background: rgba(23, 54, 42, .48);
        }

        .login-popup[hidden] {
            display: none;
        }

        .login-popup-card {
            position: relative;
            width: min(100%, 430px);
            padding: 34px;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: #fffdf9;
            box-shadow: 0 24px 70px rgba(23, 54, 42, .24);
        }

        html[data-theme='dark'] .login-popup-card {
            background: #1d1916 !important;

        }

        .login-popup-card h2 {
            margin: 0 0 10px;
            color: var(--ink);
            font-size: 28px;
            letter-spacing: -.05em;
        }

        .login-popup-card p {
            margin: 0 0 24px;
            color: var(--muted);
            line-height: 1.5;
        }

        .login-popup-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
        }

        /*
        .login-popup-actions a {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px !important;
            color: var(--layout-ink);
            background: #2c2722 !important;
            font: inherit;
            font-size: 13px;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
        } */

        .text-link {
            border-radius: 8px !important;
        }

        .login-popup-close {
            position: absolute;
            top: 14px;
            right: 16px;
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 50% !important;
            color: var(--muted) !important;
            background: transparent !important;
            font-size: 24px;
            cursor: pointer;
        }

        .login-popup-close:hover {
            background: transparent !important;
        }

        html[data-theme="dark"] .login-popup-close {
            color: #fff8ef !important;
            background: transparent !important;
        }

        html[data-theme="dark"] .login-popup-close:hover {
            background: transparent !important;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .dashboard {
            max-width: 1180px;
            margin: auto;
            padding: 48px 24px 72px;
        }

        .welcome {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 18px;
            padding: 44px 46px;
            border-radius: 26px;
            color: #fff;
            background: linear-gradient(120deg, #102d25 0%, #244b35 55%, #366624 100%);
            box-shadow: 0 18px 44px rgba(36, 75, 53, .18);
        }

        .hero-copy {
            position: relative;
            z-index: 1;
        }

        .hero-image {
            position: relative;
            z-index: 1;
            flex: 0 0 260px;
            height: 190px;
            overflow: hidden;
            border: 5px solid rgba(255, 255, 255, .18);
            border-radius: 22px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, .18);
            transform: rotate(2deg);
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .welcome::after {
            content: '';
            position: absolute;
            width: 330px;
            height: 330px;
            right: -100px;
            bottom: -190px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 50%;
            box-shadow: 0 0 0 34px rgba(255, 255, 255, .05), 0 0 0 68px rgba(255, 255, 255, .035);
            pointer-events: none;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #e8c66f;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: var(--ink);
            font-size: clamp(30px, 5vw, 46px);
            line-height: 1.05;
            letter-spacing: -.055em;
        }

        .welcome h1 {
            position: relative;
            z-index: 1;
            max-width: 710px;
            color: #fff;
        }

        .welcome p:last-child {
            position: relative;
            z-index: 1;
            max-width: 590px;
            margin: 12px 0 0;
            color: #d7e4dc;
            line-height: 1.7;
        }

        .primary-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 11px;
            color: #fff;
            background: #e8c66f;
            color: #17362a;
            font-size: 14px;
            font-weight: 700;
            transition: .2s ease;
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            background: #f2d98e;
            box-shadow: 0 8px 18px rgba(19, 52, 88, .2);
        }

        .premium-proof {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            margin-bottom: 42px;
            overflow: hidden;
            border: 1px solid #e7e4d9;
            border-radius: 16px;
            background: #e7e4d9;
        }

        .proof-item {
            padding: 17px 20px;
            background: rgba(255, 255, 255, .72);
        }

        .proof-item strong {
            display: block;
            margin-bottom: 4px;
            color: var(--forest);
            font-size: 13px;
        }

        .proof-item span {
            color: var(--muted);
            font-size: 12px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 42px;
        }

        .quick-card {
            padding: 22px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .quick-icon {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            margin-bottom: 18px;
            border-radius: 11px;
            color: var(--forest);
            background: #edf4ed;
        }

        .quick-card h2 {
            margin: 0 0 7px;
            font-size: 17px;
            letter-spacing: -.02em;
        }

        .quick-card p {
            margin: 0 0 16px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
        }

        .quick-card,
        .snack-card,
        .guide-card {
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .quick-card:hover,
        .snack-card:hover,
        .guide-card:hover {
            transform: translateY(-3px);
            border-color: #bfdbfe;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 16px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: -.035em;
        }

        .section-heading h2 span {
            color: var(--forest);
        }

        .section-heading p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .snack-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        #catalogue {
            scroll-margin-top: 96px;
        }

        #catalogue.catalogue-focus {
            animation: catalogueFocus 1.1s ease;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity .7s ease, transform .7s cubic-bezier(.22, 1, .36, 1);
        }

        .scroll-reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (prefers-reduced-motion: reduce) {
            .scroll-reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }

        @keyframes catalogueFocus {
            0% {
                transform: translateY(8px);
                opacity: .55;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            #catalogue.catalogue-focus {
                animation: none;
            }
        }

        .snack-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .snack-card img {
            width: 100%;
            height: 190px;
            display: block;
            object-fit: cover;
        }

        .snack-image {
            width: 100%;
            height: 132px;
            display: block;
            object-fit: cover;
        }

        .snack-body {
            padding: 18px;
        }

        .snack-label {
            margin: 0 0 7px;
            color: var(--forest);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .snack-body h3 {
            margin: 0 0 8px;
            font-size: 17px;
        }

        .snack-body p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .explore-section,
        .guide-section {
            margin-top: 56px;
        }

        .premium-callout {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-top: 56px;
            padding: 30px 34px;
            border-radius: 20px;
            color: #fff;
            background: var(--forest);
        }

        .premium-callout h2 {
            margin: 0 0 7px;
            color: #fff;
            font-size: 24px;
            letter-spacing: -.035em;
        }

        .premium-callout p {
            margin: 0;
            color: #d7e4dc;
            font-size: 13px;
            line-height: 1.6;
        }

        .premium-callout .text-link {
            color: #f1d586;
            white-space: nowrap;
        }

        .explore-intro {
            max-width: 560px;
            margin: 0 0 22px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .explore-grid {
            display: grid;
            grid-template-columns: 1.35fr .65fr;
            gap: 18px;
        }

        .explore-card {
            position: relative;
            min-height: 260px;
            overflow: hidden;
            border-radius: 18px;
            color: #fff;
            background: var(--navy);
        }

        .explore-card img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .explore-card:first-child {
            background: linear-gradient(135deg, #133458, #2563eb);
        }

        .explore-card:last-child {
            background: linear-gradient(135deg, #164e63, #0f766e);
        }

        .explore-card::before {
            content: '';
            position: absolute;
            width: 190px;
            height: 190px;
            top: -70px;
            right: 10%;
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 50%;
            box-shadow: 0 0 0 28px rgba(255, 255, 255, .06), 0 0 0 56px rgba(255, 255, 255, .04);
        }

        .explore-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 22%, rgba(15, 23, 42, .86) 100%);
        }

        .explore-card-content {
            position: absolute;
            z-index: 1;
            right: 24px;
            bottom: 22px;
            left: 24px;
        }

        .explore-card-content p {
            margin: 0 0 6px;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .explore-card-content h3 {
            margin: 0;
            color: #fff;
            font-size: 22px;
            letter-spacing: -.03em;
        }

        .review-section {
            margin-top: 56px;
            padding: 30px;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: #fff;
        }

        .review-slider {
            overflow: hidden;
            touch-action: pan-y;
            cursor: grab;
        }

        .review-slider.is-dragging {
            cursor: grabbing;
            user-select: none;
        }

        .review-track {
            display: flex;
            transition: transform .35s ease;
        }

        .review-card {
            min-width: 100%;
            padding: 8px 42px 10px 0;
        }

        .review-stars {
            margin-bottom: 16px;
            color: var(--orange);
            font-size: 18px;
            letter-spacing: .12em;
        }

        .review-card blockquote {
            max-width: 760px;
            margin: 0 0 18px;
            color: var(--ink);
            font-size: 15px;
            line-height: 1.35;
            letter-spacing: -.035em;
        }

        .review-author {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .review-product {
            display: inline-block;
            margin-top: 7px;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .review-product:hover {
            text-decoration: underline;
        }

        .review-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 18px;
        }


        .review-button:hover {
            color: var(--forest);
            background: #edf4ed;
        }

        .review-dots {
            display: flex;
            gap: 6px;
        }

        .review-dot {
            width: 7px;
            height: 7px;
            padding: 0;
            border: 0;
            border-radius: 50%;
            background: #cbd5e1;
            cursor: pointer;
        }

        .review-dot.active {
            width: 20px;
            border-radius: 8px;
            background: var(--blue);
        }

        .product-scroller-wrap {
            position: relative;
            width: 100%;
            margin-top: 18px;
        }

        .product-scroller-track {
            display: flex;
            gap: 18px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 6px 2px 14px;
        }

        .product-scroller-track::-webkit-scrollbar {
            display: none;
        }

        .product-scroller-track .product-card {
            flex: 0 0 calc(25% - 14px);
            min-width: 230px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #ded4c8;
            border-radius: 14px;
            background: #fffdf9;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .product-scroller-track .product-card:hover {
            border-color: #bfdbfe;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .09);
            transform: translateY(-2px);
        }

        .product-card-image {
            width: 100%;
            aspect-ratio: 1 / .8;
            object-fit: cover;
            background: #eef4f8;
        }

        .product-card-body {
            display: flex;
            min-height: 190px;
            flex: 1;
            flex-direction: column;
            padding: 14px;
        }

        .product-card-category {
            margin: 0 0 7px;
            color: #8d6c4a;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .product-card-name {
            color: #2c2722;
            font-size: 14px;
            font-weight: 750;
            line-height: 1.35;
            text-decoration: none;
        }

        .product-card-description {
            display: -webkit-box;
            margin: 8px 0 12px;
            overflow: hidden;
            color: #8d8376;
            font-size: 12px;
            line-height: 1.45;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: auto;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        .product-card-price {
            color: #2c2722;
            font-size: 14px;
            font-weight: 800;
        }

        .product-card-status {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 999px;
            color: #166534;
            background: #dcfce7;
            font-size: 11px;
            font-weight: 700;
        }

        html[data-theme="dark"] .product-card-status {
            color: #dcfce7;
            background: #166534;
        }

        .product-card-status.unavailable {
            color: #991b1b;
            background: #fee2e2;
        }

        .scroller-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-top: 14px;
            padding: 0 4px;
        }

        .scroller-progress-wrap {
            flex: 0 1 300px;
            height: 2px;
            background: #ded4c8;
            position: relative;
            border-radius: 2px;
            overflow: hidden;
        }

        .scroller-progress-bar {
            height: 100%;
            width: 25%;
            background: #2c2722;
            border-radius: 2px;
            transition: width 0.12s ease-out;
        }

        .scroller-nav-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .scroller-btn,
        .review-button {
            width: 38px;
            height: 38px;
            border-radius: 15px !important;
            border: 1px solid #ded4c8;
            background: #fffdf9;
            color: #2c2722;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, .04);
            user-select: none;
        }

        .scroller-btn svg,
        .review-button svg {
            width: 18px;
            height: 18px;
            transition: transform 0.15s ease;
        }

        .scroller-btn:hover:not(:disabled),
        .review-button:hover:not(:disabled) {
            border-color: #8d6c4a;
            background: #2c2722;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(44, 39, 34, .15);
        }

        .scroller-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            box-shadow: none;
            background: #f8f4ed;
            border-color: #ded4c8;
        }

        html[data-theme="dark"] .product-scroller-track .product-card {
            background: #2a241f;
            border-color: #51463c;
        }

        html[data-theme="dark"] .product-card-name,
        html[data-theme="dark"] .product-card-price {
            color: #f1e9df;
        }

        html[data-theme="dark"] .product-card-description {
            color: #b9aa9b;
        }

        html[data-theme="dark"] .scroller-progress-wrap {
            background: #4a4037;
        }

        html[data-theme="dark"] .scroller-progress-bar {
            background: #e8c66f;
        }

        html[data-theme="dark"] .scroller-btn {
            background: #2a241f;
            border-color: #51463c;
            color: #f1e9df;
        }

        html[data-theme="dark"] .scroller-btn:hover:not(:disabled) {
            background: #e8c66f;
            border-color: #e8c66f;
            color: #17362a;
        }

        @media (max-width: 900px) {
            .product-scroller-track .product-card {
                flex: 0 0 calc(33.333% - 12px);
                min-width: 210px;
            }
        }

        @media (max-width: 600px) {
            .product-scroller-track .product-card {
                flex: 0 0 calc(50% - 9px);
                min-width: 170px;
            }

            .scroller-progress-wrap {
                flex: 0 1 160px;
            }
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .guide-card {
            padding: 22px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
        }

        .guide-number {
            color: var(--blue);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .12em;
        }

        .guide-card h3 {
            margin: 18px 0 8px;
            font-size: 17px;
        }

        .guide-card p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .service-band {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            margin-top: 56px;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--line);
        }

        .customer-orders {
            margin-top: 28px;
            padding: 24px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: #fff;
        }

        .customer-orders-header {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 12px;
        }

        .customer-orders h2 {
            margin: 0;
            color: var(--ink);
            font-size: 20px;
            letter-spacing: -.04em;
        }

        .customer-orders p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .customer-order-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 14px 0;
            border-top: 1px solid var(--line);
        }

        .customer-order-number {
            color: var(--ink);
            font-size: 13px;
            font-weight: 800;
        }

        .customer-order-date {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: 11px;
        }

        .customer-order-status {
            padding: 6px 10px;
            border-radius: 99px;
            color: #166534;
            background: #dcfce7;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .service-item {
            padding: 24px;
            background: #fff;
        }

        .service-item strong {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .service-item span {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        @media (max-width:760px) {
            .dashboard {
                padding: 34px 16px 52px;
            }

            .welcome {
                display: block;
                padding: 32px 24px;
            }

            .hero-image {
                width: 100%;
                height: 170px;
                margin-top: 28px;
                transform: none;
            }

            .welcome .primary-btn {
                margin-top: 22px;
                width: 100%;
            }

            .quick-grid,
            .snack-grid,
            .explore-grid,
            .guide-grid,
            .service-band {
                grid-template-columns: 1fr;
            }

            .premium-proof {
                grid-template-columns: 1fr;
            }

            .customer-orders-header,
            .customer-order-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            .premium-callout {
                display: block;
                padding: 26px 22px;
            }

            .premium-callout .text-link {
                display: inline-block;
                margin-top: 18px;
            }

            .snack-card img {
                height: 210px;
            }

            .review-section {
                padding: 22px;
            }

            .review-card {
                padding-right: 0;
            }

        }
    </style>
</head>

<body>
    @include ('layouts.header')

    <main class="dashboard">
        <section class="welcome">
            <div class="hero-copy">
                <p class="eyebrow">CraveSupply · snacks made simple</p>
                <h1>Make every break taste better.</h1>
                <p>Discover thoughtfully selected snacks, drinks, and pantry favourites for offices, cafés, retailers, and the people they serve.</p>
                <a class="primary-btn" href="#catalogue"
                    >Shop the snack range <span aria-hidden="true">→</span></a
                >
            </div>
            <div class="hero-image">
                <img
                    src="{{ asset('images/snack-hero.svg') }}"
                    alt="Colourful snacks arranged for sharing"
                />
            </div>
        </section>

        <section class="premium-proof" aria-label="CraveSupply benefits">
            <div class="proof-item">
                <strong>Curated premium range</strong
                ><span>Products chosen for quality and everyday appeal.</span>
            </div>
            <div class="proof-item">
                <strong>Wholesale-ready selection</strong
                ><span
                    >Practical options for offices, cafés, and retailers.</span
                >
            </div>
            <div class="proof-item">
                <strong>Smarter restocking</strong
                ><span>Clear categories that make repeat orders easier.</span>
            </div>
        </section>

        <section class="quick-grid" aria-label="Dashboard shortcuts">
            <article class="quick-card">
                <div class="quick-icon">✦</div>
                <h2>Explore premium foods</h2>
                <p>Find refined snacks, drinks, and pantry favourites for your business.</p>
                <a class="text-link" href="#catalogue">View catalogue →</a>
            </article>
            <article class="quick-card">
                <div class="quick-icon">▣</div>
                <h2>Stock with confidence</h2>
                <p>Build a dependable range that keeps your shelves ready for every workday.</p>
                <a class="text-link" href="#restock-guide">Plan a restock →</a>
            </article>
            <article class="quick-card">
                <div class="quick-icon">◇</div>
                <h2>Made for modern teams</h2>
                <p>Choose thoughtful products that make shared spaces feel considered.</p>
                <a class="text-link" href="#about">Learn more →</a>
            </article>
        </section>

        <section id="catalogue" aria-labelledby="featured-snacks">
            <div class="section-heading">
                <div>
                    <h2 id="featured-snacks">
                        Explore our <span>premium range</span>
                    </h2>
                    <p>Curated categories for retailers, cafés, offices, and growing teams.</p>
                </div>
                <a class="text-link" href="/products">View all →</a>
            </div>

            <div class="snack-grid">
                <article class="snack-card">
                    <a
                        href="{{ route('products.category', 'artisan-beverages') }}"
                    >
                        <img
                            class="snack-image"
                            loading="lazy"
                            src="http://127.0.0.1:8000/storage/products/jwwKuoUM0ybse44TBLGFB8JYRY5VzMWHvOs9SJyp.jpg"
                            alt="Cold Brew Concentrate"
                        />
                        <div class="snack-body">
                            <p class="snack-label">Premium Beverages</p>
                            <h3>Artisan Beverages</h3>
                            <p>Small-batch coffees, teas, and refreshments for every setting.</p>
                        </div>
                    </a>
                </article>

                <article class="snack-card">
                    <a
                        href="{{ route('products.category', 'premium-confectionery') }}"
                    >
                        <img
                            class="snack-image"
                            loading="lazy"
                            src="http://127.0.0.1:8000/storage/products/mF1EsVw31FzgdpSnFRmpJHave0BOt8xuC6jMq6sl.webp"
                            alt="Godiva Milk Chocolate Assortment"
                        />
                        <div class="snack-body">
                            <p class="snack-label">Confectionery</p>
                            <h3>Premium Confectionery</h3>
                            <p>High-quality chocolate and confectionery products sourced from premium brands, suitable for retail, gifting, and specialty distribution.</p>
                        </div>
                    </a>
                </article>
                <article class="snack-card">
                    <a
                        href="{{ route('products.category', 'gourmet-pantry') }}"
                    >
                        <img
                            class="snack-image"
                            loading="lazy"
                            src="http://127.0.0.1:8000/storage/products/jazIFilyTjQos1e5IzNpaxDolOOFqLPL9lnOzEpd.jpg"
                            alt="Wild Orchard Preserve"
                        />
                        <div class="snack-body">
                            <p class="snack-label">Premium Pantry Essentials</p>
                            <h3>Gourmet Pantry</h3>
                            <p>Premium staples and ingredients for considered kitchens.</p>
                        </div>
                    </a>
                </article>
        </section>

        @guest
            <div
                class="login-popup"
                id="catalogueLoginPopup"
                role="dialog"
                aria-modal="true"
                aria-labelledby="catalogue-login-title"
                hidden
            >
                <div class="login-popup-card">
                    <button
                        class="login-popup-close"
                        type="button"
                        aria-label="Close login popup"
                    >
                        &times;
                    </button>
                    <p class="snack-label">Welcome to CraveSupply</p>
                    <h2 id="catalogue-login-title">
                        Sign in for a smoother restock.
                    </h2>
                    <p>You can continue browsing as a guest, or log in to keep your catalogue and ordering experience close at hand.</p>
                    <div class="login-popup-actions">
                        <a
                            class="nav-cta"
                            href="{{ route('login') }}"
                            style="
                                border-radius: 20px !important;
                                padding: 6px 9px;
                                width: 50%;
                                text-align: center;
                            "
                            >Log in</a
                        >
                    </div>
                </div>
            </div>
        @endguest

        @if (!empty($randomProducts) && $randomProducts->isNotEmpty())
            <section
                class="products-section"
                aria-labelledby="featured-products-title"
                style="margin-top: 48px"
            >
                <div class="section-heading">
                    <div>
                        <h2 id="featured-products-title">
                            Featured <span>products</span>
                        </h2>
                        <p>Randomly selected items for your everyday supply needs.</p>
                    </div>
                    <a
                        class="text-link"
                        href="{{ route('products.dashboard') }}"
                        >View all products →</a
                    >
                </div>

                <div class="product-scroller-wrap">
                    <div class="product-scroller-track">
                        @foreach ($randomProducts as $product)
                            <article class="product-card">
                                <a
                                    href="{{ route('products.profile', $product) }}"
                                >
                                    <img
                                        class="product-card-image"
                                        src="{{ $product->productImages->first() ? asset('storage/' . $product->productImages->first()->image_path) : asset('images/product-placeholder.svg') }}"
                                        alt="{{ $product->name }}"
                                    />
                                </a>
                                <div class="product-card-body">
                                    <p class="product-card-category">{{ $product->category?->name ?: 'Uncategorised' }}</p>
                                    <a
                                        class="product-card-name"
                                        href="{{ route('products.profile', $product) }}"
                                        >{{ $product->name }}</a
                                    >
                                    <p class="product-card-description">
                                        {{ $product->description ?: 'A carefully selected CraveSupply product for your everyday needs.' }}
                                    </p>
                                    <div class="product-card-footer">
                                        <strong class="product-card-price"
                                            >₹{{ number_format((float) $product->price, 2) }}</strong
                                        >
                                        <span
                                            class="product-card-status{{ !$product->is_available || $product->stock < 1 ? ' unavailable' : '' }}"
                                            >{{ $product->is_available && $product->stock > 0 ? 'Available' : 'Out of stock' }}</span
                                        >
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="scroller-controls">
                        <div class="scroller-progress-wrap">
                            <div class="scroller-progress-bar"></div>
                        </div>
                        <div class="scroller-nav-buttons">
                            <button
                                type="button"
                                class="scroller-btn prev"
                                aria-label="Previous products"
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button
                                type="button"
                                class="scroller-btn next"
                                aria-label="Next products"
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section
            class="premium-callout"
            aria-label="Premium supply call to action"
        >
            <div>
                <h2>Stock smarter. Serve better.</h2>
                <p>Bring premium everyday choices to your shelves without complicating your weekly routine.</p>
            </div>
            <a class="text-link" href="#restock-guide"
                >See the restock guide →</a
            >
        </section>

        <section class="explore-section" aria-labelledby="explore-title">
            <div class="section-heading">
                <div>
                    <h2 id="explore-title">A little more to explore</h2>
                    <p class="explore-intro">Build a better break room, refresh your counter, and keep your regulars coming back.</p>
                </div>
            </div>

            <div class="explore-grid">
                <a href="">
                    <article class="explore-card">
                        <div class="explore-card-content">
                            <p>Everyday refreshment</p>
                            <h3>Drinks for every kind of workday.</h3>
                        </div>
                    </article>
                </a>
                <a href="{{ route('products.dashboard') }}">
                    <article class="explore-card">
                        <div class="explore-card-content">
                            <p>Made for teams</p>
                            <h3>Stock the moments people remember.</h3>
                        </div>
                    </article>
                </a>
            </div>
        </section>

        <section
            id="restock-guide"
            class="guide-section"
            aria-labelledby="guide-title"
        >
            <div class="section-heading">
                <div>
                    <h2 id="guide-title">A simpler restock routine</h2>
                    <p>Keep the essentials moving with a process your team can repeat every week.</p>
                </div>
            </div>

            <div class="guide-grid">
                <article class="guide-card">
                    <span class="guide-number">01 / DISCOVER</span>
                    <h3>Start with the essentials</h3>
                    <p>Choose familiar snacks, drinks, and pantry staples that suit your team and customers.</p>
                </article>
                <article class="guide-card">
                    <span class="guide-number">02 / ORGANISE</span>
                    <h3>Build a repeatable list</h3>
                    <p>Keep your regular items together so the next order takes minutes instead of guesswork.</p>
                </article>
                <article class="guide-card">
                    <span class="guide-number">03 / REFRESH</span>
                    <h3>Review what works</h3>
                    <p>Notice what disappears first and use that insight to make every restock more useful.</p>
                </article>
            </div>
        </section>

        <section
            id="about"
            class="service-band"
            aria-label="CraveSupply service details"
        >
            <div class="service-item">
                <strong>Built for busy teams</strong
                ><span
                    >Clear choices and practical categories for offices, cafés,
                    and small businesses.</span
                >
            </div>
            <div class="service-item">
                <strong>Easy to get started</strong
                ><span
                    >Browse the catalogue, create an account, and keep your
                    everyday supplies in one place.</span
                >
            </div>
            <div class="service-item">
                <strong>Support when you need it</strong
                ><span
                    >Our team is here to help with product questions and your
                    next replenishment.</span
                >
            </div>
        </section>

        @if (auth()->user()?->role !== 'admin')
            <section
                id="contact"
                class="premium-callout contact-callout"
                aria-labelledby="contact-title"
            >
                <div>
                    <p class="eyebrow">Have a question?</p>
                    <h2 id="contact-title">
                        Let’s make your next restock easier.
                    </h2>
                    <p>Tell us what you need for your shelves, team, or café and we’ll help you find the right range.</p>
                </div>
                <a class="primary-btn" href="mailto:hello@cravesupply.test"
                    >Contact us</a
                >
            </section>
        @endif

        @if ($topReviews->isNotEmpty())
            <section class="review-section" aria-labelledby="reviews-title">
                <div class="section-heading">
                    <div>
                        <h2 id="reviews-title">What businesses are saying</h2>
                        <p>Real routines, made a little easier.</p>
                    </div>
                </div>

                <div class="review-slider" aria-live="polite">
                    <div class="review-track" id="reviewTrack">
                        @foreach ($topReviews as $review)
                            <article class="review-card">
                                <div
                                    class="review-stars"
                                    aria-label="{{ $review->rating }} out of 5 stars"
                                >
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </div>
                                <blockquote>
                                    “{{ $review->comment }}”
                                </blockquote>
                                <p class="review-author">{{ $review->user?->name ?: 'Customer' }}</p>
                                @if ($review->product)
                                    <a
                                        class="review-product"
                                        href="{{ route('products.profile', $review->product) }}"
                                        >Reviewed: {{ $review->product->name }}</a
                                    >
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="review-controls">
                    <div class="review-dots" aria-label="Choose a review">
                        @foreach ($topReviews as $index => $review)
                            <button
                                class="review-dot{{ $index === 0 ? ' active' : '' }}"
                                type="button"
                                aria-label="Show review {{ $index + 1 }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            ></button>
                        @endforeach
                    </div>
                    <div class="review-buttons">
                        <button
                            class="review-button"
                            id="reviewPrevious"
                            type="button"
                            aria-label="Previous review"
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 12H5M12 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button
                            class="review-button"
                            id="reviewNext"
                            type="button"
                            aria-label="Next review"
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        @endif
    </main>

    @include ('layouts.footer')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const section = document.getElementById("catalogue");
            const popup = document.getElementById("catalogueLoginPopup");
            if (!section || !popup) return;
            const close = () => {
                popup.hidden = true;
                document.body.style.overflow = "";
            };
            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        popup.hidden = false;
                        document.body.style.overflow = "hidden";
                        observer.disconnect();
                    }
                },
                {
                    threshold: 0.2,
                },
            );
            observer.observe(section);
            popup
                .querySelector(".login-popup-close")
                .addEventListener("click", close);
            popup
                .querySelector(".login-popup-continue")
                .addEventListener("click", close);
            popup.addEventListener("click", (event) => {
                if (event.target === popup) close();
            });
            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape" && !popup.hidden) close();
            });
        });
    </script>
    <script>
        (() => {
            const sections = document.querySelectorAll(
                ".dashboard > section:not(.welcome), .dashboard > .welcome",
            );
            if (!sections.length) return;

            if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
                sections.forEach((section) =>
                    section.classList.add("is-visible"),
                );
                return;
            }

            sections.forEach((section) =>
                section.classList.add("scroll-reveal"),
            );

            const observer = new IntersectionObserver(
                (entries, revealObserver) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;
                        entry.target.classList.add("is-visible");
                        revealObserver.unobserve(entry.target);
                    });
                },
                {
                    threshold: 0.12,
                    rootMargin: "0px 0px -40px",
                },
            );

            sections.forEach((section) => observer.observe(section));
        })();

        (() => {
            document
                .querySelectorAll('a[href="#catalogue"]')
                .forEach((link) => {
                    link.addEventListener("click", (event) => {
                        const catalogue = document.getElementById("catalogue");
                        if (!catalogue) return;

                        event.preventDefault();
                        catalogue.scrollIntoView({
                            behavior: window.matchMedia(
                                "(prefers-reduced-motion: reduce)",
                            ).matches
                                ? "auto"
                                : "smooth",
                            block: "start",
                        });
                        catalogue.classList.remove("catalogue-focus");
                        window.requestAnimationFrame(() =>
                            catalogue.classList.add("catalogue-focus"),
                        );
                        window.setTimeout(
                            () => catalogue.classList.remove("catalogue-focus"),
                            1200,
                        );
                    });
                });

            const track = document.getElementById("reviewTrack");
            const dots = [...document.querySelectorAll(".review-dot")];
            const previous = document.getElementById("reviewPrevious");
            const next = document.getElementById("reviewNext");
            const reviewSection = document.querySelector(".review-section");
            if (
                !track ||
                !previous ||
                !next ||
                !reviewSection ||
                dots.length === 0
            )
                return;
            const reduceMotion = window.matchMedia(
                "(prefers-reduced-motion: reduce)",
            ).matches;
            let current = 0;
            let autoplay = null;
            let pointerStartX = 0;
            let pointerStartY = 0;
            let pointerActive = false;
            let draggingHorizontally = false;

            const slider = reviewSection.querySelector(".review-slider");

            function showReview(index) {
                current = (index + dots.length) % dots.length;
                track.style.transform = `translateX(-${current * 100}%)`;
                dots.forEach((dot, dotIndex) => {
                    const active = dotIndex === current;
                    dot.classList.toggle("active", active);
                    dot.setAttribute("aria-current", active ? "true" : "false");
                });
            }

            function stopAutoplay() {
                if (autoplay) {
                    window.clearInterval(autoplay);
                    autoplay = null;
                }
            }

            function startAutoplay() {
                if (reduceMotion || autoplay) return;
                autoplay = window.setInterval(
                    () => showReview(current + 1),
                    5000,
                );
            }

            function restartAutoplay() {
                stopAutoplay();
                startAutoplay();
            }

            previous.addEventListener("click", () => {
                showReview(current - 1);
                restartAutoplay();
            });
            next.addEventListener("click", () => {
                showReview(current + 1);
                restartAutoplay();
            });
            dots.forEach((dot, index) =>
                dot.addEventListener("click", () => {
                    showReview(index);
                    restartAutoplay();
                }),
            );
            slider.addEventListener("pointerdown", (event) => {
                if (event.pointerType === "mouse" && event.button !== 0) return;
                pointerStartX = event.clientX;
                pointerStartY = event.clientY;
                pointerActive = true;
                draggingHorizontally = false;
                track.setPointerCapture?.(event.pointerId);
                stopAutoplay();
            });
            slider.addEventListener("pointermove", (event) => {
                if (!pointerActive) return;
                const deltaX = event.clientX - pointerStartX;
                const deltaY = event.clientY - pointerStartY;
                if (!draggingHorizontally && Math.abs(deltaX) < 8) return;
                if (
                    !draggingHorizontally &&
                    Math.abs(deltaX) <= Math.abs(deltaY)
                )
                    return;
                draggingHorizontally = true;
                event.preventDefault();
                slider.classList.add("is-dragging");
                track.style.transition = "none";
                track.style.transform = `translateX(calc(-${current * 100}% + ${deltaX}px))`;
            });
            const finishPointer = (event) => {
                if (!pointerActive) return;
                const deltaX = event.clientX - pointerStartX;
                pointerActive = false;
                slider.classList.remove("is-dragging");
                track.style.transition = "";
                if (draggingHorizontally && Math.abs(deltaX) > 45) {
                    showReview(current + (deltaX < 0 ? 1 : -1));
                } else {
                    showReview(current);
                }
                draggingHorizontally = false;
                restartAutoplay();
            };
            slider.addEventListener("pointerup", finishPointer);
            slider.addEventListener("pointercancel", finishPointer);
            reviewSection.addEventListener("mouseenter", stopAutoplay);
            reviewSection.addEventListener("mouseleave", startAutoplay);
            reviewSection.addEventListener("focusin", stopAutoplay);
            reviewSection.addEventListener("focusout", (event) => {
                if (!reviewSection.contains(event.relatedTarget))
                    startAutoplay();
            });
            startAutoplay();
        })();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const initScroller = (wrap) => {
                const track = wrap.querySelector(".product-scroller-track");
                const bar = wrap.querySelector(".scroller-progress-bar");
                const prevBtn = wrap.querySelector(".scroller-btn.prev");
                const nextBtn = wrap.querySelector(".scroller-btn.next");

                if (!track || !bar) return;

                const update = () => {
                    const scrollLeft = track.scrollLeft;
                    const maxScroll = track.scrollWidth - track.clientWidth;

                    if (maxScroll <= 0) {
                        bar.style.width = "100%";
                        if (prevBtn) prevBtn.disabled = true;
                        if (nextBtn) nextBtn.disabled = true;
                        return;
                    }

                    const currentRight = scrollLeft + track.clientWidth;
                    const progressRatio = currentRight / track.scrollWidth;
                    const fillPercent = Math.min(
                        100,
                        Math.max(15, progressRatio * 100),
                    );

                    bar.style.width = fillPercent + "%";

                    if (prevBtn) prevBtn.disabled = scrollLeft <= 5;
                    if (nextBtn) nextBtn.disabled = scrollLeft >= maxScroll - 5;
                };

                track.addEventListener("scroll", update, {
                    passive: true,
                });
                window.addEventListener("resize", update, {
                    passive: true,
                });

                if (prevBtn) {
                    prevBtn.addEventListener("click", () => {
                        track.scrollBy({
                            left: -track.clientWidth * 0.75,
                            behavior: "smooth",
                        });
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener("click", () => {
                        track.scrollBy({
                            left: track.clientWidth * 0.75,
                            behavior: "smooth",
                        });
                    });
                }

                update();
            };

            document
                .querySelectorAll(".product-scroller-wrap")
                .forEach(initScroller);
        });
    </script>
</body>
</html>

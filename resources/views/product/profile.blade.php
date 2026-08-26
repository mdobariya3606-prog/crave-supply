<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — CraveSupply</title>

    <style>
        :root {
            --profile-ink: #1e293b;
            --profile-muted: #64748b;
            --profile-line: #e2e8f0;
            --profile-blue: #3b82f6;
            --profile-navy: #133458;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        @keyframes profile-page-in {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-profile {
            animation: profile-page-in .32s ease-out both;
        }

        .product-profile {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            padding: 44px 0 72px;
            overflow-x: clip;
        }

        .breadcrumb {
            margin-bottom: 22px;
            color: var(--profile-muted);
            font-size: 12px;
        }

        .breadcrumb a {
            color: var(--profile-blue);
            text-decoration: none;
        }

        .product-main {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
            gap: 54px;
            align-items: start;
        }

        .product-main>* {
            min-width: 0;
        }

        .gallery {
            position: sticky;
            top: 102px;
            width: min(100%, 430px);
            margin-inline: auto;
            min-width: 0;
        }

        .gallery-main {
            position: relative;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            max-height: 325px;
            border-radius: 14px;
            background: #f1f5f4;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
        }

        .gallery-track {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform .65s cubic-bezier(.22, .61, .36, 1);
            will-change: transform;
            cursor: grab;
            user-select: none;
            touch-action: pan-y;
        }

        .gallery-track.is-dragging {
            cursor: grabbing;
            transition: none;
        }

        .gallery-track img {
            display: block;
            flex: 0 0 100%;
            width: 100%;
            height: 100%;
            padding: 0;
            object-fit: cover;
        }

        .gallery-arrow {
            position: absolute;
            top: 50%;
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 50%;
            color: var(--profile-navy);
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 5px 15px rgba(15, 23, 42, .12);
            cursor: pointer;
            transform: translateY(-50%);
        }

        .gallery-arrow:hover {
            background: #fff;
        }

        .gallery-arrow.previous {
            left: 15px;
        }

        .gallery-arrow.next {
            right: 15px;
        }

        .gallery-thumbs {
            display: flex;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            gap: 10px;
            margin-top: 12px;
            padding: 2px 1px 5px;
            overflow-x: auto;
            overflow-y: hidden;
            overscroll-behavior-inline: contain;
            scrollbar-width: thin;
            touch-action: pan-x;
        }

        .gallery-thumb {
            overflow: hidden;
            padding: 0;
            flex: 0 0 84px;
            border: 2px solid transparent;
            border-radius: 12px;
            background: #eef4f8;
            cursor: pointer;
        }

        .gallery-thumb.active {
            border-color: var(--profile-blue);
        }

        .gallery-thumb img {
            display: block;
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            padding: 0;
        }

        .product-info {
            padding-top: 10px;
        }

        .product-label {
            margin: 0 0 12px;
            color: var(--profile-blue);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .product-info h1 {
            margin: 0;
            color: var(--profile-ink);
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.08;
            letter-spacing: -.055em;
        }

        .product-subtitle {
            margin: 16px 0 0;
            color: var(--profile-muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 22px 0;
            padding-bottom: 22px;
            border-bottom: 1px solid var(--profile-line);
        }

        .stars {
            color: #d99d24;
            letter-spacing: 2px;
        }

        .rating-summary span:last-child {
            color: var(--profile-muted);
            font-size: 13px;
        }

        .price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .price {
            color: var(--profile-navy);
            font-size: 27px;
            font-weight: 800;
        }

        .availability {
            color: #166534;
            background: #dcfce7;
            border-radius: 99px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: 700;
        }

        .availability.unavailable {
            color: #991b1b;
            background: #fee2e2;
        }

        .detail-list {
            display: grid;
            gap: 13px;
            margin: 0;
            padding: 22px 0;
            border-top: 1px solid var(--profile-line);
            border-bottom: 1px solid var(--profile-line);
        }

        .detail-list div {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            font-size: 13px;
        }

        .detail-list dt {
            color: var(--profile-muted);
        }

        .detail-list dd {
            margin: 0;
            color: var(--profile-ink);
            font-weight: 600;
            text-align: right;
        }

        .order-form {
            display: flex;
            align-items: end;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .order-form label {
            flex: 0 0 100%;
            color: var(--profile-ink);
            font-size: 12px;
            font-weight: 700;
        }

        .order-form input {
            width: 78px;
            height: 40px;
            padding: 7px;
            border: 1px solid var(--profile-line);
            border-radius: 9px;
            color: var(--profile-ink);
            background: #fff;
            font: inherit;
            text-align: center;
        }

        .order-form input:focus {
            outline: 3px solid rgba(59, 130, 246, .16);
            border-color: var(--profile-blue);
        }

        .review-submit {
            height: 40px;
        }

        .service-highlights {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            margin-top: 46px;
            overflow: hidden;
            border: 1px solid var(--profile-line);
            border-radius: 16px;
            background: var(--profile-line);
        }

        .service-highlight {
            display: grid;
            justify-items: center;
            gap: 11px;
            padding: 25px 18px;
            background: #fff;
            text-align: center;
        }

        .service-highlight svg {
            width: 38px;
            height: 38px;
            fill: none;
            stroke: #c8861a;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 1.5;
        }

        .service-highlight strong {
            color: var(--profile-ink);
            font-size: 12px;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .service-highlight span {
            color: var(--profile-muted);
            font-size: 11px;
        }

        .reviews-section,
        .related-section {
            margin-top: 60px;
        }

        .section-title {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
        }

        .section-title h2 {
            margin: 0;
            color: var(--profile-ink);
            font-size: 24px;
            letter-spacing: -.04em;
        }

        .section-title p {
            margin: 5px 0 0;
            color: var(--profile-muted);
            font-size: 13px;
        }

        .review-layout {
            display: grid;
            grid-template-columns: minmax(260px, .7fr) minmax(0, 1.3fr);
            gap: 18px;
        }

        .review-card,
        .review-form,
        .related-card {
            border: 1px solid var(--profile-line);
            border-radius: 16px;
            background: #fff;
        }

        .review-card {
            padding: 22px;
        }

        .review-card h3 {
            margin: 0 0 12px;
            color: var(--profile-ink);
            font-size: 15px;
        }

        .review-score {
            color: var(--profile-navy);
            font-size: 38px;
            font-weight: 800;
        }

        .review-note {
            margin: 7px 0 0;
            color: var(--profile-muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .review-list {
            display: grid;
            gap: 12px;
        }

        .review-pagination {
            margin-top: 8px;
            display: flex;
            justify-content: center;
        }

        .review-pagination nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .review-pagination nav>div:first-child {
            display: none;
        }

        .review-pagination nav>div:last-child>span,
        .review-pagination nav>div:last-child>a {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .review-pagination a,
        .review-pagination span[aria-current="page"] span,
        .review-pagination span[aria-disabled="true"] span {
            min-width: 34px;
            height: 34px;
            padding: 0 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--profile-line);
            border-radius: 8px;
            color: var(--profile-ink);
            background: #fff;
            font-size: 12px;
            text-decoration: none;
        }

        .review-pagination a:hover {
            border-color: var(--profile-blue);
            color: var(--profile-blue);
        }

        .review-pagination span[aria-current="page"] span {
            border-color: var(--profile-blue);
            color: #fff;
            background: var(--profile-blue);
        }

        .review-pagination span[aria-disabled="true"] span {
            color: #cbd5e1;
            background: #f8fafc;
        }

        .review-pagination svg {
            width: 14px;
            height: 14px;
        }

        .review-item {
            padding: 18px;
            border: 1px solid var(--profile-line);
            border-radius: 14px;
            background: #fff;
        }

        .review-item header {
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }

        .review-item strong {
            color: var(--profile-ink);
            font-size: 13px;
        }

        .review-item time {
            color: var(--profile-muted);
            font-size: 11px;
        }

        .review-item p {
            margin: 9px 0 0;
            color: var(--profile-muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .review-form {
            margin-top: 18px;
            padding: 20px;
        }

        .review-form h3 {
            margin: 0 0 14px;
            font-size: 15px;
        }

        .review-form label {
            display: block;
            margin-bottom: 7px;
            color: var(--profile-ink);
            font-size: 12px;
            font-weight: 700;
        }

        .review-form select,
        .review-form textarea {
            width: 100%;
            margin-bottom: 12px;
            padding: 10px 12px;
            border: 1px solid var(--profile-line);
            border-radius: 9px;
            color: var(--profile-ink);
            font: inherit;
            font-size: 13px;
            outline: none;
        }

        .review-form textarea {
            min-height: 82px;
            resize: vertical;
        }

        .review-submit {
            padding: 10px 15px;
            border: 0;
            border-radius: 9px;
            color: #fff;
            background: var(--profile-navy);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .review-submit:hover {
            background: #0f2946;
        }

        .review-message {
            margin-bottom: 14px;
            padding: 11px 13px;
            border-radius: 9px;
            color: #166534;
            background: #f0fdf4;
            font-size: 12px;
        }

        .order-error {
            display: block;
            margin: -4px 0 12px;
            padding: 10px 12px;
            border: 1px solid #fecaca;
            border-radius: 9px;
            color: #991b1b;
            background: #fef2f2;
            font-size: 12px;
            line-height: 1.45;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .related-card {
            padding: 18px;
            text-decoration: none;
        }

        .related-card-image {
            display: block;
            width: calc(100% + 36px);
            aspect-ratio: 1.25;
            margin: -18px -18px 16px;
            object-fit: contain;
            background: #eee6d9;
            mix-blend-mode: multiply;
        }

        .related-card:hover {
            border-color: #93c5fd;
        }


        html[data-theme="dark"] .related-card:hover {
            border-color: #fff;
        }

        .related-card h3 {
            margin: 0 0 8px;
            color: var(--profile-ink);
            font-size: 14px;
        }

        .related-card p {
            margin: 0;
            color: var(--profile-blue);
            font-size: 13px;
            font-weight: 700;
        }

        @media (max-width: 1000px) {
            .product-main {
                grid-template-columns: minmax(0, .9fr) minmax(320px, 1fr);
                gap: 34px;
            }
        }

        @media (max-width: 800px) {

            .product-main,
            .review-layout {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .gallery {
                position: static;
                width: min(100%, 540px);
                margin-left: 0;
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .product-profile {
                width: min(100% - 28px, 560px);
                padding: 28px 0 54px;
            }

            .breadcrumb {
                margin-bottom: 16px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .gallery-main {
                border-radius: 14px;
            }

            .gallery-arrow {
                width: 34px;
                height: 34px;
            }

            .gallery-arrow.previous {
                left: 10px;
            }

            .gallery-arrow.next {
                right: 10px;
            }

            .gallery-thumb {
                flex-basis: 68px;
            }

            .product-info {
                padding-top: 0;
            }

            .product-info h1 {
                font-size: clamp(28px, 9vw, 38px);
            }

            .product-subtitle {
                margin-top: 12px;
                font-size: 14px;
                line-height: 1.6;
            }

            .rating-summary {
                align-items: flex-start;
                flex-direction: column;
                gap: 6px;
                margin: 18px 0;
                padding-bottom: 18px;
            }

            .price-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
                margin-bottom: 18px;
            }

            .detail-list {
                padding: 18px 0;
            }

            .service-highlights {
                grid-template-columns: 1fr;
            }

            .service-highlight {
                grid-template-columns: 42px 1fr;
                justify-items: start;
                column-gap: 13px;
                padding: 18px;
                text-align: left;
            }

            .service-highlight svg {
                grid-row: span 2;
                width: 32px;
                height: 32px;
            }

            .service-highlight strong,
            .service-highlight span {
                align-self: end;
            }

            .reviews-section,
            .related-section {
                margin-top: 42px;
            }
        }

        @media (max-width: 520px) {
            .product-profile {
                width: calc(100% - 28px);
            }

            .related-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .section-title h2 {
                font-size: 22px;
            }

            .detail-list div {
                align-items: flex-start;
                flex-direction: column;
                gap: 4px;
            }

            .detail-list dd {
                text-align: left;
            }

            .order-form {
                display: grid;
                grid-template-columns: 78px 1fr;
            }

            .order-form label,
            .order-form .order-error {
                grid-column: 1 / -1;
            }

            .order-form .review-submit {
                width: 100%;
            }
        }

        /* Premium editorial product treatment */
        body {
            color: #29251f;
            background: #f8f4ed;
        }

        .product-profile {
            width: min(1240px, calc(100% - 48px));
            padding-top: 30px;
        }

        .breadcrumb {
            color: #8d8376;
            font-size: 10px;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .breadcrumb a {
            color: #6e685f;
        }

        .product-main {
            grid-template-columns: minmax(0, 1.06fr) minmax(360px, .94fr);
            gap: 70px;
            padding: 18px 0 64px;
        }

        .gallery {
            width: 100%;
            top: 92px;
        }

        .gallery-main {
            aspect-ratio: 1 / 1;
            max-height: none;
            border-radius: 0;
            background: #eee6d9;
            box-shadow: none;
        }

        .gallery-track img {
            object-fit: contain;
            padding: 26px;
            mix-blend-mode: multiply;
        }

        .gallery-arrow {
            width: 42px;
            height: 42px;
            color: #29251f;
            background: rgba(255, 255, 255, .82);
            box-shadow: none;
        }

        .gallery-thumb {
            flex-basis: 76px;
            border-radius: 0;
            border-color: transparent;
            background: #eee6d9;
        }

        .gallery-thumb.active {
            border-color: #29251f;
        }

        .product-info {
            padding: 28px 0 0;
        }

        .product-label {
            color: #8d6c4a;
            font-size: 10px;
            letter-spacing: .2em;
        }

        .product-info h1 {
            max-width: 560px;
            color: #29251f;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(38px, 5vw, 64px);
            font-weight: 400;
            letter-spacing: -.045em;
            line-height: .98;
        }

        .product-subtitle {
            max-width: 560px;
            margin-top: 22px;
            color: #71695f;
            font-size: 14px;
            line-height: 1.8;
        }

        .rating-summary {
            margin-top: 22px;
            color: #8d8376;
            font-size: 11px;
        }

        .stars {
            color: #b48a44;
            letter-spacing: .12em;
        }

        .price-row {
            margin-top: 26px;
            padding: 22px 0;
            border-top: 1px solid #ddd3c6;
            border-bottom: 1px solid #ddd3c6;
        }

        .price {
            color: #29251f;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 25px;
        }

        .availability {
            color: #607044;
            background: #e8eddf;
        }

        .availability.unavailable {
            color: #9b4338;
            background: #f4e2dc;
        }

        .detail-list {
            margin-top: 22px;
            border-bottom: 1px solid #ddd3c6;
        }

        .detail-list div {
            padding: 12px 0;
            border-top: 1px solid #ddd3c6;
        }

        .detail-list dt {
            color: #8d8376;
            font-size: 10px;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .detail-list dd {
            color: #3c372f;
            font-size: 12px;
        }

        .order-form {
            margin-top: 24px;
        }

        .order-form label {
            color: #51483e;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .order-form input {
            border-color: #cfc3b4;
            border-radius: 0;
            background: #fffdf9;
        }

        .review-submit {
            border-radius: 0;
            color: #fff;
            background: #29251f;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .review-submit:hover {
            background: #8d6c4a;
        }

        .service-highlights {
            margin: 46px 0 72px;
            padding: 34px 24px;
            border-top: 1px solid #e2d9cd;
            border-bottom: 1px solid #e2d9cd;
            background: #f1eadf;
        }

        .service-highlight {
            color: #51483e;
            background: transparent;
        }

        .service-highlight svg {
            stroke: #8d6c4a;
        }

        .service-highlight strong {
            color: #29251f;
        }

        .service-highlight span {
            color: #8d8376;
        }

        .editorial-story {
            display: grid;
            grid-template-columns: minmax(0, .85fr) minmax(0, 1.15fr);
            min-height: 310px;
            margin: 0 0 76px;
            background: #2c2722;
            color: #f8f4ed;
        }

        .editorial-story-copy {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 42px;
            background: #dba8a3;
            color: #29251f;
        }

        .editorial-story-copy h2 {
            max-width: 320px;
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 34px;
            font-weight: 400;
            line-height: 1;
        }

        .editorial-story-copy p {
            max-width: 370px;
            margin: 18px 0 0;
            color: #5d4d47;
            font-size: 13px;
            line-height: 1.7;
        }

        .editorial-story-visual {
            min-height: 310px;
            background: radial-gradient(circle at 70% 30%, #795c42, #211c18 65%);
        }

        .editorial-story-visual::after {
            content: 'CRAFTED FOR THE EVERYDAY';
            display: grid;
            height: 100%;
            place-items: center;
            color: rgba(248, 244, 237, .28);
            font-size: 11px;
            letter-spacing: .3em;
            transform: rotate(-12deg);
        }

        .reviews-section,
        .related-section {
            padding-top: 0;
        }

        .section-title h2,
        .reviews-section h2,
        .related-section h2 {
            color: #29251f;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 32px;
            font-weight: 400;
        }

        .section-title p {
            color: #8d8376;
        }

        .review-card,
        .review-form,
        .review-item,
        .related-card {
            border-color: #e2d9cd;
            border-radius: 0;
            background: #fffdf9;
            box-shadow: none;
        }

        .review-score {
            color: #29251f;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .manual-review-pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 24px
        }

        .review-page-numbers {
            display: flex;
            gap: 7px
        }

        .review-page-button {
            display: inline-flex;
            min-width: 34px;
            height: 34px;
            align-items: center;
            justify-content: center;
            padding: 0 9px;
            border: 1px solid #e2d9cd;
            border-radius: 0;
            color: #51483e;
            background: #fffdf9;
            font-size: 12px;
            text-decoration: none
        }

        .review-page-button:hover {
            border-color: #8d6c4a;
            color: #8d6c4a
        }

        .review-page-button.active {
            border-color: #2c2722;
            color: #fff;
            background: #2c2722
        }

        .review-page-button.disabled {
            color: #b9aa9b;
            background: #f1e9df
        }

        @media(max-width:520px) {
            .manual-review-pagination {
                flex-wrap: wrap
            }

            .review-page-numbers {
                flex-wrap: wrap;
                justify-content: center
            }
        }

        html[data-theme="dark"] .gallery-main,
        html[data-theme="dark"] .related-card-image {
            background: #29251f;
        }

        html[data-theme="dark"] dt,
        html[data-theme="dark"] dd,
        html[data-theme="dark"] time,
        html[data-theme="dark"] .review-score,
        html[data-theme="dark"] .review-page-button {
            color: #f5ede4 !important;
        }

        html[data-theme="dark"] .review-page-button {
            background: #2a241f;
            border-color: #51463c;
        }

        html[data-theme="dark"] .review-page-button.active {
            color: #fff !important;
            background: #604a35;
            border-color: #806348;
        }

        html[data-theme='dark'] .service-highlights {
            border-top: 1px solid #8d6c4a;
            border-bottom: 1px solid #8d6c4a;
            background: #8d6c4a;
        }

        html[data-theme='dark'] .service-highlight {
            color: #f1eadf;
            background: transparent;
        }

        html[data-theme='dark'] .service-highlight svg {
            stroke: #f1eadf;
        }

        /* Keep all three service articles visible in a desktop row. */
        .service-highlights {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        @media (max-width: 760px) {
            .product-profile {
                width: calc(100% - 28px);
            }

            .product-main {
                grid-template-columns: minmax(0, 1fr);
                gap: 28px;
                padding-bottom: 42px;
            }

            .gallery {
                position: static;
                width: 100%;
            }

            .gallery-main {
                max-height: none;
            }

            .product-info {
                padding-top: 0;
            }

            .service-highlights {
                margin: 28px 0 42px;
                padding: 24px 14px;
                grid-template-columns: 1fr;
            }

            .editorial-story {
                grid-template-columns: 1fr;
            }

            .editorial-story-visual {
                min-height: 180px;
            }

            .review-layout {
                grid-template-columns: minmax(0, 1fr);
            }

            .related-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .review-form input,
            .review-form select,
            .review-form textarea,
            .order-form input {
                max-width: 100%;
            }
        }

        @media (max-width: 520px) {
            .related-grid {
                grid-template-columns: minmax(0, 1fr);
            }

            .editorial-story-copy {
                padding: 28px 22px;
            }

            .section-title h2,
            .reviews-section h2,
            .related-section h2 {
                font-size: 26px;
            }

            .review-item header {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="product-profile">
        @if (session('success'))
            <div class="review-message" role="status">{{ session('success') }}</div>
        @endif

        <div class="breadcrumb"><a href="{{ route('products.dashboard') }}">Products</a> / {{ $product->name }}</div>

        <section class="product-main" aria-labelledby="product-title">
            <div class="gallery" data-gallery>
                <div class="gallery-main">
                    <div class="gallery-track" data-gallery-track>
                        @forelse ($product->productImages as $index => $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->name }} view {{ $index + 1 }}">
                        @empty
                            <img src="{{ asset('images/product-placeholder.svg') }}"
                                alt="{{ $product->name }} product image">
                        @endforelse
                    </div>
                    <button class="gallery-arrow previous" type="button" data-gallery-previous
                        aria-label="Previous image">‹</button>
                    <button class="gallery-arrow next" type="button" data-gallery-next
                        aria-label="Next image">›</button>
                </div>
                <div class="gallery-thumbs">
                    @foreach ($product->productImages as $index => $image)
                        <button class="gallery-thumb{{ $index === 0 ? ' active' : '' }}" type="button"
                            data-gallery-thumb="{{ $index }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->name }} view {{ $index + 1 }}">
                        </button>
                    @endforeach
                    @if ($product->productImages->isEmpty())
                        <button class="gallery-thumb active" type="button" data-gallery-thumb="0">
                            <img src="{{ asset('images/product-placeholder.svg') }}" alt="{{ $product->name }} placeholder">
                        </button>
                    @endif
                </div>
            </div>

            <div class="product-info">
                <p class="product-label">{{ $product->category?->name ?: 'Premium collection' }}</p>
                <h1 id="product-title">{{ $product->name }}</h1>
                <p class="product-subtitle">
                    {{ $product->description ?: 'A thoughtfully selected premium product for your business and shared spaces.' }}
                </p>
                <div class="rating-summary"><span class="stars"><?php
$avgRating = (int) $product->reviews->avg('rating'); ?>
                        {{ str_repeat('★', $avgRating) }}{{ str_repeat('☆', 5 - $avgRating) }}</span><span>{{ number_format((float) $product->reviews->avg('rating'), 1) }}
                        from {{ $product->reviews->count() }} reviews</span></div>
                <div class="price-row"><span class="price">₹{{ number_format((float) $product->price, 2) }}</span><span
                        class="availability{{ $product->stock < 1 || !$product->is_available ? ' unavailable' : '' }}">{{ $product->stock < 1 ? 'Out of stock' : ($product->is_available ? 'In stock' : 'Currently unavailable') }}</span>
                </div>
                <dl class="detail-list">
                    <div>
                        <dt>SKU</dt>
                        <dd>{{ $product->sku ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt>Available quantity</dt>
                        <dd>{{ number_format($product->stock) }}</dd>
                    </div>
                    <div>
                        <dt>Collection</dt>
                        <dd>{{ $product->category?->name ?: 'Premium collection' }}</dd>
                    </div>
                </dl>
                @if (auth()->user()?->role === 'admin')
                    <a class="review-submit" style="display:inline-block;text-decoration:none;margin-top:18px"
                        href="{{ route('products.edit', $product) }}">Edit product</a>
                @endif
                @if ($product->is_available && $product->stock > 0)
                    @if (!auth()->check() || auth()->user()?->role === 'customer')
                        <form class="order-form" action="{{ route('products.order.store', $product) }}" method="POST">
                            @csrf
                            <label for="quantity">Quantity</label>
                            <div class="input-wrapper"><input id="quantity" name="quantity" type="number" min="1"
                                    max="{{ $product->stock }}" value="1"></div>
                            @error('quantity', 'order')
                                <span class="order-error" role="alert">{{ $message }}</span>
                            @enderror
                            <button class="review-submit" type="submit">Add to Order</button>
                        </form>
                    @endif
                @elseif ($product->stock < 1 && auth()->user()?->role !== 'admin')
                    <span class="availability unavailable" style="display:inline-block;margin-top:18px">Out of stock</span>
                @elseif (!$product->is_available && auth()->user()?->role !== 'admin')
                    <span class="availability unavailable" style="display:inline-block;margin-top:18px">Currently
                        unavailable</span>
                @endif
            </div>
        </section>

        <section class="service-highlights" aria-label="CraveSupply service benefits">
            <article class="service-highlight">
                <svg viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M24 4 38 10v11c0 9-5.8 17.2-14 21-8.2-3.8-14-12-14-21V10l14-6Z" />
                    <path d="m17 24 5 5 10-11" />
                </svg>
                <strong>Curated quality</strong>
                <span>Selected for dependable everyday use</span>
            </article>
            <article class="service-highlight">
                <svg viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M11 18h26v22H11z" />
                    <path d="M17 18v-5h14v5M20 27h8M24 23v8" />
                    <path d="M8 24H4m4-6-3-3m3 12-3 3" />
                </svg>
                <strong>Simple returns</strong>
                <span>Easy support when plans change</span>
            </article>
            <article class="service-highlight">
                <svg viewBox="0 0 48 48" aria-hidden="true">
                    <path
                        d="M5 31h25V16H5zM30 23h7l6 6v2H30zM12 37a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm25 0a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                    <path d="M35 16V9m-4 4 4-4 4 4" />
                </svg>
                <strong>Reliable delivery</strong>
                <span>Carefully packed for your business</span>
            </article>
        </section>

        <section class="editorial-story" aria-labelledby="story-title">
            <div class="editorial-story-copy">
                <p class="product-label">The CraveSupply standard</p>
                <h2 id="story-title">Good choices, beautifully considered.</h2>
                <p>We look for products that earn their place on the shelf: dependable quality, thoughtful details, and
                    a little joy in every everyday moment.</p>
            </div>
            <div class="editorial-story-visual" aria-hidden="true"></div>
        </section>

        <section class="reviews-section" aria-labelledby="reviews-title">
            <div class="section-title">
                <div>
                    <h2 id="reviews-title">Customer reviews</h2>
                    <p>What customers say about this product.</p>
                </div>
            </div>
            <div class="review-layout">
                <div>
                    <article class="review-card">
                        <h3>Overall rating</h3>
                        <div class="review-score">
                            {{ $product->reviews->count() ? number_format((float) $product->reviews->avg('rating'), 1) : '—' }}
                        </div>
                        <div class="stars">
                            {{ str_repeat('★', $avgRating) }}{{ str_repeat('☆', 5 - $avgRating) }}
                        </div>
                        <p class="review-note">{{ $product->reviews->count() }} verified
                            review{{ $product->reviews->count() === 1 ? '' : 's' }} shared so far.</p>
                    </article>
                    @auth
                        @if (session('review_success'))
                            <div class="review-message" role="status">{{ session('review_success') }}</div>
                        @endif
                        <form class="review-form" action="{{ route('products.reviews.store', $product) }}" method="POST">
                            @csrf
                            <h3>Share your experience</h3>
                            <label for="rating">Your rating</label>
                            <div class="input-wrapper"><select id="rating" name="rating" required>
                                    <option value="">Select a rating</option>
                                    <option value="5">★★★★★ Excellent</option>
                                    <option value="4">★★★★☆ Very good</option>
                                    <option value="3">★★★☆☆ Good</option>
                                    <option value="2">★★☆☆☆ Fair</option>
                                    <option value="1">★☆☆☆☆ Needs improvement</option>
                                </select></div>
                            <label for="comment">Review</label>
                            <div class="input-wrapper"><textarea id="comment" name="comment" maxlength="1000"
                                    placeholder="Tell us about the product..."></textarea></div>
                            <button class="review-submit" type="submit">Submit review</button>
                        </form>
                    @else
                        <p class="review-note">Please <a href="{{ route('login') }}">log in</a> to leave a review.</p>
                    @endauth
                </div>
                <div class="review-list">
                    @forelse ($reviews as $review)
                        <article class="review-item" data-review-id="{{ $review->id }}" @if(!$review->is_approved) style="opacity:0.75;border:1px dashed #cbd5e1;" @endif>
                            <header style="display:flex;align-items:center;justify-content:space-between;">
                                <div>
                                    <strong>{{ $review->user?->name ?: 'Customer' }}</strong><time>{{ $review->created_at->format('M j, Y') }}</time>
                                    <span class="review-hidden-badge" style="display:{{ $review->is_approved ? 'none' : 'inline-block' }};margin-left:8px;padding:2px 8px;background:#fee2e2;color:#991b1b;border-radius:4px;font-size:11px;font-weight:600;">Hidden</span>
                                </div>
                                @if (auth()->check() && auth()->user()->role === 'admin')
                                    <form class="admin-review-toggle-form" action="{{ route('reviews.toggle-visibility', $review) }}" method="POST" style="margin:0;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="admin-review-toggle-btn" style="display:inline-flex;align-items:center;padding:4px 10px;font-size:11px;font-weight:600;cursor:pointer;border-radius:4px;border:none;background:{{ $review->is_approved ? '#fee2e2' : '#dcfce7' }};color:{{ $review->is_approved ? '#991b1b' : '#166534' }};">
                                            {{ $review->is_approved ? 'Turn off visibility' : 'Turn on visibility' }}
                                        </button>
                                    </form>
                                @endif
                            </header>
                            <div class="stars">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                            @if ($review->comment)
                                <p>{{ $review->comment }}</p>
                            @endif
                        </article>
                    @empty
                        <div class="empty-state">No reviews yet. Be the first to share your experience.</div>
                    @endforelse
                    @if ($reviews->hasPages())
                        <nav class="review-pagination manual-review-pagination" aria-label="Reviews pagination">
                            @if ($reviews->onFirstPage())
                                <span class="review-page-button disabled" aria-disabled="true">‹</span>
                            @else
                                <a class="review-page-button" href="{{ $reviews->previousPageUrl() }}" rel="prev">‹</a>
                            @endif
                            <div class="review-page-numbers">
                                @for ($page = 1; $page <= $reviews->lastPage(); $page++)
                                    @if ($page === $reviews->currentPage())
                                        <span class="review-page-button active" aria-current="page">{{ $page }}</span>
                                    @else
                                        <a class="review-page-button" href="{{ $reviews->url($page) }}">{{ $page }}</a>
                                    @endif
                                @endfor
                            </div>
                            @if ($reviews->hasMorePages())
                                <a class="review-page-button" href="{{ $reviews->nextPageUrl() }}" rel="next">›</a>
                            @else
                                <span class="review-page-button disabled" aria-disabled="true">›</span>
                            @endif
                        </nav>
                    @endif
                </div>
            </div>
        </section>

        @if ($relatedProducts->isNotEmpty())
        <section class="related-section" aria-labelledby="related-title">
            <div class="section-title">
                <div>
                    <h2 id="related-title">You may also like</h2>
                    <p>More premium products from this collection.</p>
                </div>
            </div>
            <div class="related-grid">
                @foreach ($relatedProducts as $relatedProduct)
                <a class="related-card" href="{{ route('products.profile', $relatedProduct) }}">
                    @php($relatedImage = $relatedProduct->productImages->firstWhere('is_primary', true) ?: $relatedProduct->productImages->first())
                    <img class="related-card-image"
                        src="{{ $relatedImage ? asset('storage/' . $relatedImage->image_path) : asset('images/product-placeholder.svg') }}"
                        alt="{{ $relatedProduct->name }}">
                    <div class="related-card-desc">
                        <h3>{{ $relatedProduct->name }}</h3>
                        <p>₹{{ number_format((float) $relatedProduct->price, 2) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </main>
    @include('layouts.footer')

    <script>
        (() => {
            const gallery = document.querySelector('[data-gallery]');
            if (!gallery) return;
            const images = @json(
                $product->productImages->map(fn($image) => asset('storage/' . $image->image_path))->values()->all() ?: [
                    asset('images/product-placeholder.svg'),
                ]
            );
            const track = gallery.querySelector('[data-gallery-track]');
            const thumbs = [...gallery.querySelectorAll('[data-gallery-thumb]')];
            let current = 0;
            let timer;
            let dragStartX = null;
            let dragStartY = null;
            let dragged = false;
            if (images.length > 1) track.appendChild(track.firstElementChild.cloneNode(true));
            const show = (index) => {
                const next = (index + images.length) % images.length;
                const isForwardWrap = current === images.length - 1 && next === 0;
                current = next;
                track.style.transform = 'translateX(-' + ((isForwardWrap ? images.length : current) * 100) + '%)';
                if (isForwardWrap) {
                    window.setTimeout(() => {
                        track.style.transition = 'none';
                        track.style.transform = 'translateX(0)';
                        window.requestAnimationFrame(() => track.style.transition = '');
                    }, 650);
                }
                thumbs.forEach((thumb, thumbIndex) => thumb.classList.toggle('active', thumbIndex === current));
            };
            const restart = () => {
                window.clearInterval(timer);
                if (images.length > 1) timer = window.setInterval(() => show(current + 1), 5000);
            };
            gallery.querySelector('[data-gallery-previous]').addEventListener('click', () => {
                show(current - 1);
                restart();
            });
            gallery.querySelector('[data-gallery-next]').addEventListener('click', () => {
                show(current + 1);
                restart();
            });
            thumbs.forEach((thumb, index) => thumb.addEventListener('click', () => {
                show(index);
                restart();
            }));
            track.addEventListener('pointerdown', (event) => {
                if (event.pointerType === 'mouse' && event.button !== 0) return;
                dragStartX = event.clientX;
                dragStartY = event.clientY;
                dragged = false;
                track.classList.add('is-dragging');
                track.setPointerCapture?.(event.pointerId);
                window.clearInterval(timer);
            });
            track.addEventListener('pointermove', (event) => {
                if (dragStartX === null) return;
                if (Math.abs(event.clientX - dragStartX) > 8 || Math.abs(event.clientY - dragStartY) > 8) {
                    dragged = true;
                }
            });
            track.addEventListener('pointerup', (event) => {
                if (dragStartX === null) return;
                const distanceX = event.clientX - dragStartX;
                const distanceY = event.clientY - dragStartY;
                track.classList.remove('is-dragging');
                dragStartX = null;
                dragStartY = null;
                if (Math.abs(distanceX) > 45 && Math.abs(distanceX) > Math.abs(distanceY)) {
                    show(distanceX < 0 ? current + 1 : current - 1);
                }
                restart();
            });
            track.addEventListener('pointercancel', () => {
                track.classList.remove('is-dragging');
                dragStartX = null;
                dragStartY = null;
                restart();
            });
            gallery.addEventListener('mouseenter', () => window.clearInterval(timer));
            gallery.addEventListener('mouseleave', restart);
            gallery.addEventListener('keydown', (event) => {
                if (event.key === 'ArrowLeft') {
                    show(current - 1);
                    restart();
                }
                if (event.key === 'ArrowRight') {
                    show(current + 1);
                    restart();
                }
            });
            gallery.tabIndex = 0;
            restart();
        })();

        document.querySelectorAll('.admin-review-toggle-form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const button = form.querySelector('.admin-review-toggle-btn');
                if (!button) return;
                button.disabled = true;

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]')?.value || ''
                        },
                        body: new FormData(form)
                    });

                    if (response.ok) {
                        const data = await response.json();
                        const article = form.closest('.review-item');
                        const badge = article ? article.querySelector('.review-hidden-badge') : null;

                        if (data.is_approved) {
                            button.textContent = 'Turn off visibility';
                            button.style.background = '#fee2e2';
                            button.style.color = '#991b1b';
                            if (badge) badge.style.display = 'none';
                            if (article) {
                                article.style.opacity = '1';
                                article.style.border = '';
                            }
                        } else {
                            button.textContent = 'Turn on visibility';
                            button.style.background = '#dcfce7';
                            button.style.color = '#166534';
                            if (badge) badge.style.display = 'inline-block';
                            if (article) {
                                article.style.opacity = '0.75';
                                article.style.border = '1px dashed #cbd5e1';
                            }
                        }
                    }
                } catch (err) {
                    console.error('Error updating review visibility:', err);
                } finally {
                    button.disabled = false;
                }
            });
        });
    </script>
</body>

</html>
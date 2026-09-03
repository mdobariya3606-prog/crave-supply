<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messages — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/premium-theme.css') }}" />
    <style>
        .messages-page {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
            padding: 52px 0 80px;
        }

        .messages-page h1 {
            margin: 0;
            color: #29251f;
            font:
                400 42px Georgia,
                serif;
        }

        .messages-layout {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 20px;
            margin-top: 24px;
        }

        .message-list,
        .message-detail {
            border: 1px solid #ded4c8;
            background: #fffdf9;
        }

        .message-list {
            overflow: hidden;
            border-radius: 18px;
        }

        .message-item {
            display: block;
            padding: 17px 18px;
            border-bottom: 1px solid #eee5da;
            color: #29251f;
            text-decoration: none;
        }

        .message-item:last-child {
            border-bottom: 0;
        }

        .message-entry:last-child .message-item {
            border-bottom: 0;
        }

        .message-item:hover,
        .message-item.selected {
            background: #f8f4ed;
        }

        .message-item.unread {
            border-left: 4px solid #8d6c4a;
            padding-left: 14px;
        }

        .message-item strong {
            display: block;
            font-size: 13px;
        }

        .message-item span {
            display: block;
            margin-top: 5px;
            color: #8d8376;
            font-size: 11px;
        }

        .message-preview {
            display: block;
            margin-top: 9px;
            overflow: hidden;
            color: #71695f;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .message-detail {
            padding: 28px;
            border-radius: 18px;
        }

        .message-detail-mobile {
            display: none;
        }

        .message-detail h2 {
            margin: 0;
            color: #29251f;
            font:
                400 30px Georgia,
                serif;
        }

        .message-meta {
            margin: 8px 0 24px;
            color: #8d8376;
            font-size: 12px;
            line-height: 1.8;
        }

        .message-body {
            padding: 18px;
            background: #f8f4ed;
            color: #51483e;
            line-height: 1.7;
            border: 1px solid #ded4c8;
            border-radius: 18px;
        }

        .reply-form {
            margin-top: 26px;
        }

        .reply-form label {
            display: block;
            margin-bottom: 8px;
            color: #51483e;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .reply-form textarea {
            box-sizing: border-box;
            width: 100%;
            min-height: 130px;
            padding: 12px;
            border: 1px solid #ded4c8;
            border-radius: 18px;
            background: #fffdf9;
            font: inherit;
            resize: vertical;
            outline: none;
        }

        .reply-form button {
            margin-top: 12px;
            padding: 12px 17px;
            border: 0;
            cursor: pointer;
        }

        .message-success {
            margin-top: 16px;
            color: #49603b;
            font-size: 13px;
        }

        .message-error {
            margin-top: 8px;
            color: #a04338;
            font-size: 12px;
        }

        .empty-messages {
            padding: 28px;
            color: #8d8376;
            font-size: 13px;
        }

        .unread-badge {
            display: inline-grid;
            place-items: center;
            width: 18px;
            min-width: 18px;
            height: 18px;
            margin-left: 5px;
            padding: 0;
            border-radius: 50%;
            color: #fff;
            background: #a04338;
            font-size: 10px;
        }

        @media (max-width: 760px) {
            .messages-page {
                width: calc(100% - 28px);
                padding: 42px 0 60px;
            }

            .messages-layout {
                grid-template-columns: 1fr;
            }

            .message-detail {
                display: none;
            }

            .message-detail-mobile {
                display: block;
                padding: 22px 18px;
                border-bottom: 1px solid #eee5da;
                background: #fffdf9;
            }

            .message-detail-mobile h2 {
                margin: 0;
                color: #29251f;
                font: 400 25px Georgia, serif;
            }
        }
    </style>
</head>

<body>
    @include ('layouts.header')
    <main class="messages-page">
        <h1>Messages</h1>
        <p>Review customer enquiries and reply directly by email.</p>
        @if (session('success'))
            <p class="message-success" role="status">{{ session('success') }}</p>
        @endif
        <div class="messages-layout">
            <div class="message-list">
                @forelse ($messages as $message)
                    <div class="message-entry">
                        <a
                            class="message-item {{ !$message->is_read ? 'unread' : '' }} {{ $selectedMessage?->id === $message->id ? 'selected' : '' }}"
                            href="{{ route('admin.contact-messages.index', ['message' => $message->id]) }}"
                        >
                            <strong>{{ $message->name }}</strong>
                            <span
                                >{{ $message->email }} · {{ optional($message->created_at)->format('d M Y, H:i') }}</span
                            >
                            <span
                                class="message-preview"
                                >{{ $message->message }}</span
                            >
                        </a>
                        @if ($selectedMessage?->id === $message->id)
                            <section class="message-detail-mobile" aria-live="polite">
                                @include('admin.contact-messages._detail', [
                                    'detailMessage' => $selectedMessage,
                                    'replyFieldId' => 'mobile-reply',
                                ])
                            </section>
                        @endif
                    </div>
                @empty
                    <div class="empty-messages">No messages yet.</div>
                @endforelse
            </div>
            <section class="message-detail" aria-live="polite">
                @if ($selectedMessage)
                    @include('admin.contact-messages._detail', [
                        'detailMessage' => $selectedMessage,
                        'replyFieldId' => 'reply',
                    ])
                @else
                    <div class="empty-messages">
                        Select a message to view it and mark it as seen.
                    </div>
                @endif
            </section>
        </div>
    </main>
    @include ('layouts.footer')
</body>
</html>

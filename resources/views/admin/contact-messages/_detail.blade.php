<h2>{{ $detailMessage->name }}</h2>
<div class="message-meta">
    {{ $detailMessage->email }}<br />
    Business: {{ $detailMessage->business_name ?: 'Not provided' }} ·
    Phone: {{ $detailMessage->phone ?: 'Not provided' }}<br />
    Received {{ optional($detailMessage->created_at)->format('d M Y, H:i') }}
</div>
<div class="message-body">
    {{ $detailMessage->message }}
</div>
<form
    class="reply-form"
    action="{{ route('admin.contact-messages.reply', $detailMessage) }}"
    method="POST"
>
    @csrf
    <label for="{{ $replyFieldId }}">Reply message</label>
    <textarea
        id="{{ $replyFieldId }}"
        name="reply"
        required
    >{{ old('reply') }}</textarea>
    @error ('reply')
        <div class="message-error">{{ $message }}</div>
    @enderror
    <button type="submit">Send reply</button>
</form>

@extends('admin.layout')

@section('title', 'Message details')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Message details</p>
            <h1>{{ $contactMessage->name }}</h1>
            <p class="muted" style="margin: 8px 0 0; font-size: 13px;">Received {{ $contactMessage->created_at->format('F j, Y \a\t g:i a') }}</p>
        </div>
        <a class="button button-secondary" href="{{ route('admin.messages.index') }}">← Back to inbox</a>
    </div>

    <section class="panel" style="max-width: 800px; padding: clamp(22px, 5vw, 40px);">
        <p class="eyebrow">From</p>
        <p style="margin: 0 0 27px; font-size: 15px;">
            <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
        </p>
        <p class="eyebrow">Message</p>
        <p style="margin: 0; color: #354b3f; font-size: 15px; line-height: 1.85; white-space: pre-wrap;">{{ $contactMessage->message }}</p>

        <form method="POST" action="{{ route('admin.messages.status', $contactMessage) }}" style="display: flex; flex-wrap: wrap; align-items: end; gap: 13px; margin-top: 34px; padding-top: 24px; border-top: 1px solid rgb(49 89 71 / 11%);">
            @csrf
            @method('PATCH')
            <div class="form-field" style="width: min(100%, 220px); margin: 0;">
                <label for="status">Message status</label>
                <select id="status" name="status" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected(old('status', $contactMessage->status) === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @error('status') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <button class="button" type="submit">Update status</button>
            <a class="button button-secondary" href="mailto:{{ $contactMessage->email }}?subject={{ rawurlencode('Re: message to Bhavdarpan') }}">Reply by email ↗</a>
        </form>
    </section>
@endsection

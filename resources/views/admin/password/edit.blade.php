<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>
@extends('admin.layout')

@section('title', 'Change password')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Account security</p>
            <h1>Change password</h1>
            <p class="muted">Confirm your current password before choosing a new one.</p>
        </div>
    </div>

    <form class="panel form-panel" method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        @method('PUT')

        <div class="form-field">
            <label for="current_password">Current password</label>
            <input id="current_password" name="current_password" type="password" autocomplete="current-password" required>
            @error('current_password')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-field">
            <label for="password">New password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" minlength="12" required>
            <p class="muted field-hint">Use at least 12 characters.</p>
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-field">
            <label for="password_confirmation">Confirm new password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="12" required>
        </div>

        <button class="button" type="submit">Update password</button>
    </form>
@endsection

@push('styles')
    <style>
        .form-panel { max-width: 620px; padding: 28px; }
        .field-hint { margin: 0; font-size: 12px; }
        @media (max-width: 600px) { .form-panel { padding: 20px; } }
    </style>
@endpush

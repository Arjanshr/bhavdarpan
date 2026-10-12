<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div>
@extends('admin.layout')

@section('title', 'Add administrator')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Team access</p>
            <h1>Add an administrator</h1>
            <p class="muted">Create a new account with access to the admin panel.</p>
        </div>
    </div>

    <form class="panel form-panel" method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="form-field">
            <label for="name">Full name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" maxlength="255" required>
            @error('name')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-field">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" maxlength="255" required>
            @error('email')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-field">
            <label for="password">Temporary password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" minlength="12" required>
            <p class="muted field-hint">Use at least 12 characters. The new administrator can change it after signing in.</p>
            @error('password')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-field">
            <label for="password_confirmation">Confirm temporary password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="12" required>
        </div>

        <button class="button" type="submit">Create administrator</button>
    </form>
@endsection

@push('styles')
    <style>
        .form-panel { max-width: 620px; padding: 28px; }
        .field-hint { margin: 0; font-size: 12px; line-height: 1.6; }
        @media (max-width: 600px) { .form-panel { padding: 20px; } }
    </style>
@endpush

@extends('admin.layout')

@section('title', 'Admin sign in')

@section('content')
    <section style="width: min(100%, 430px); margin: 30px auto 0;">
        <p class="eyebrow">Private workspace</p>
        <h1 style="margin-bottom: 10px;">Admin sign in</h1>
        <p class="muted" style="margin: 0 0 25px; font-size: 13px; line-height: 1.7;">Sign in to manage incoming messages and homepage content.</p>
        <form class="panel" style="padding: 26px;" method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="form-field">
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
                @error('email') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="form-field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
                @error('password') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <button class="button" type="submit">Sign in</button>
        </form>
    </section>
@endsection

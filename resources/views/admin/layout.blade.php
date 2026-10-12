<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f6f7f1">
        <title>@yield('title', 'Admin') · Bhavdarpan</title>
        <style>
            :root { font-family: Arial, sans-serif; color: #21382e; background: #f6f7f1; font-synthesis: none; text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; --green: #315947; --dark: #1d3a2f; --muted: #68756c; }
            *, *::before, *::after { box-sizing: border-box; }
            body { min-width: 320px; margin: 0; }
            a { color: inherit; }
            a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible, select:focus-visible { outline: 3px solid #bd8d37; outline-offset: 3px; }
            .shell { width: min(100% - 40px, 1160px); margin-inline: auto; }
            .admin-header { display: flex; min-height: 80px; align-items: center; justify-content: space-between; gap: 24px; border-bottom: 1px solid rgb(49 89 71 / 13%); }
            .brand { display: inline-flex; align-items: center; text-decoration: none; }
            .brand img { display: block; width: 142px; height: auto; }
            .admin-nav { display: flex; align-items: center; gap: 19px; color: #56685d; font-size: 13px; }
            .admin-nav a { text-decoration: none; }
            .admin-nav a:hover { color: var(--green); }
            .logout-form { margin: 0; }
            .logout-button { padding: 9px 13px; border: 1px solid rgb(49 89 71 / 20%); border-radius: 999px; background: transparent; color: var(--dark); font: inherit; cursor: pointer; }
            main { padding-block: 42px 75px; }
            .page-heading { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 29px; }
            .eyebrow { margin: 0 0 10px; color: #647e59; font-size: 10px; font-weight: 700; letter-spacing: .17em; text-transform: uppercase; }
            h1, h2 { margin: 0; font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif; font-weight: 400; letter-spacing: -.04em; }
            h1 { font-size: clamp(35px, 5vw, 48px); }
            h2 { font-size: 27px; }
            .muted { color: var(--muted); }
            .panel { border: 1px solid rgb(49 89 71 / 11%); border-radius: 16px; background: #fffefa; }
            .notice { margin-bottom: 21px; padding: 13px 16px; border: 1px solid #c5dbc3; border-radius: 10px; background: #f0f7ed; color: #315947; font-size: 13px; line-height: 1.6; }
            .error-summary { margin-bottom: 20px; padding: 13px 16px; border: 1px solid #e3c2be; border-radius: 10px; background: #fff5f3; color: #9b3935; font-size: 13px; line-height: 1.6; }
            .button { display: inline-flex; min-height: 43px; align-items: center; justify-content: center; gap: 8px; padding: 0 16px; border: 1px solid transparent; border-radius: 999px; background: var(--green); color: white; font-size: 12px; font-weight: 600; text-decoration: none; cursor: pointer; }
            .button:hover { background: var(--dark); }
            .button-secondary { border-color: rgb(49 89 71 / 20%); background: #fffefa; color: var(--dark); }
            .button-secondary:hover { background: #edf1e8; color: var(--dark); }
            .status { display: inline-flex; align-items: center; gap: 7px; padding: 6px 10px; border-radius: 999px; background: #edf1e8; color: #49674c; font-size: 10px; font-weight: 700; text-transform: capitalize; }
            .status::before { width: 6px; height: 6px; border-radius: 50%; background: currentColor; content: ""; }
            .status-new { background: #fff3dc; color: #926626; }
            .status-replied { background: #e9eff9; color: #47628d; }
            .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
            .form-field { display: grid; gap: 8px; margin-bottom: 17px; }
            label { color: #354b3f; font-size: 12px; font-weight: 600; }
            input, textarea, select { width: 100%; border: 1px solid #dbe1d7; border-radius: 9px; background: white; color: #21382e; font: inherit; font-size: 14px; }
            input, select { min-height: 44px; padding-inline: 12px; }
            textarea { min-height: 145px; padding: 12px; line-height: 1.65; resize: vertical; }
            .field-error { margin: 0; color: #a33d39; font-size: 11px; }
            .admin-footer { padding-block: 20px; border-top: 1px solid rgb(49 89 71 / 12%); color: var(--muted); font-size: 11px; }
            .admin-footer p { margin: 0; }
            @media (max-width: 650px) {
                .shell { width: min(100% - 30px, 1160px); }
                .admin-header { min-height: 70px; flex-wrap: wrap; padding-block: 12px; }
                .brand img { width: 122px; }
                .admin-nav { gap: 13px; font-size: 11px; }
                .page-heading { align-items: flex-start; flex-direction: column; }
                main { padding-block: 30px 55px; }
            }
            @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; } }
        </style>
        @stack('styles')
    </head>
    <body>
        <header class="admin-header shell">
            <a class="brand" href="{{ route('home') }}" aria-label="Bhavdarpan home">
                <img src="{{ asset('images/logo.png') }}" alt="Bhavdarpan">
            </a>
            @if (auth()->user()?->is_admin)
                <nav class="admin-nav" aria-label="Admin navigation">
                    <a href="{{ route('admin.messages.index') }}">Messages</a>
                    <a href="{{ route('admin.home-page.edit') }}">Homepage editor</a>
                    <a href="{{ route('admin.users.create') }}">Add admin</a>
                    <a href="{{ route('admin.password.edit') }}">Password</a>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener">View site ↗</a>
                    <form class="logout-form" method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="logout-button" type="submit">Sign out</button>
                    </form>
                </nav>
            @else
                <a class="muted" href="{{ route('home') }}">Back to website</a>
            @endif
        </header>

        <main class="shell">
            @if (session('success'))
                <div class="notice" role="status">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="error-summary" role="alert">Please review the highlighted fields and try again.</div>
            @endif
            @yield('content')
        </main>

        <footer class="admin-footer shell">
            <p>Bhavdarpan admin · Confidential information — handle with care.</p>
        </footer>
        @stack('scripts')
</body>

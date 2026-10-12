<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f6f7f1">
        <meta name="description" content="Contact Bhavdarpan in Kirtipur, Nepal, or send us a message about mental health support.">
        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="512x512">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" type="image/png">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <title>Contact Bhavdarpan</title>
        <style>
            :root {
                font-family: Arial, sans-serif;
                color: #21382e;
                background: #f6f7f1;
                font-synthesis: none;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
                --green: #315947;
                --muted: #68756c;
            }

            *, *::before, *::after { box-sizing: border-box; }
            body { min-width: 320px; margin: 0; }
            a { color: inherit; }
            a:focus-visible, input:focus-visible, textarea:focus-visible, button:focus-visible { outline: 3px solid #bd8d37; outline-offset: 3px; }
            .shell { width: min(100% - 48px, 1120px); margin-inline: auto; }
            .header { display: flex; min-height: 88px; align-items: center; justify-content: space-between; gap: 24px; border-bottom: 1px solid rgb(49 89 71 / 12%); }
            .brand img { display: block; width: 158px; height: auto; }
            .back-link { color: #52645a; font-size: 13px; text-decoration-color: rgb(49 89 71 / 25%); text-underline-offset: 5px; }
            main { padding-block: 75px 100px; }
            .intro { max-width: 670px; margin-bottom: 44px; }
            .eyebrow { display: flex; align-items: center; gap: 10px; margin: 0 0 22px; color: #647e59; font-size: 11px; font-weight: 700; letter-spacing: .19em; text-transform: uppercase; }
            .eyebrow::before { width: 25px; height: 1px; background: #a7b39d; content: ""; }
            h1, h2 { margin-top: 0; font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif; font-weight: 400; letter-spacing: -.05em; }
            h1 { margin-bottom: 18px; font-size: clamp(48px, 7vw, 74px); line-height: 1; }
            .intro > p:last-child { margin: 0; color: var(--muted); font-size: 15px; line-height: 1.85; }
            .contact-grid { display: grid; grid-template-columns: .82fr 1.18fr; gap: 24px; align-items: start; }
            .details, .form-card { border: 1px solid rgb(49 89 71 / 11%); border-radius: 20px; background: #fffefa; }
            .details { display: grid; gap: 0; padding: 30px; }
            .details h2, .form-card h2 { margin-bottom: 22px; font-size: 31px; }
            .detail { display: flex; gap: 15px; padding-block: 19px; border-top: 1px solid rgb(49 89 71 / 10%); }
            .detail-icon { display: grid; width: 42px; height: 42px; flex: 0 0 auto; place-items: center; border-radius: 13px; background: #edf1e8; color: var(--green); font-size: 18px; }
            .detail h3 { margin: 1px 0 7px; color: #657469; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
            .detail p, .detail a { margin: 0; color: #263d32; font-size: 14px; line-height: 1.7; }
            .detail a { display: block; text-decoration-color: rgb(49 89 71 / 25%); text-underline-offset: 4px; }
            .form-card { padding: clamp(24px, 4vw, 42px); }
            .form-card h2 { margin-bottom: 9px; }
            .form-intro { margin-bottom: 25px; color: var(--muted); font-size: 13px; line-height: 1.75; }
            .field { display: grid; gap: 8px; margin-bottom: 18px; }
            label { color: #354b3f; font-size: 12px; font-weight: 600; }
            input, textarea { width: 100%; border: 1px solid #dbe1d7; border-radius: 10px; background: #fff; color: #21382e; font: inherit; font-size: 14px; }
            input { min-height: 48px; padding: 0 14px; }
            textarea { min-height: 160px; padding: 13px 14px; resize: vertical; line-height: 1.7; }
            input::placeholder, textarea::placeholder { color: #9aa49a; }
            .error { margin: 0; color: #a33d39; font-size: 12px; }
            .notice { margin-bottom: 23px; padding: 14px 16px; border: 1px solid #c5dbc3; border-radius: 10px; background: #f0f7ed; color: #315947; font-size: 13px; line-height: 1.6; }
            .button { display: inline-flex; min-height: 49px; align-items: center; justify-content: center; gap: 10px; padding: 0 21px; border: 0; border-radius: 999px; background: var(--green); color: white; font-size: 13px; font-weight: 600; cursor: pointer; }
            .button:hover { background: #1d3a2f; }
            .honeypot { position: absolute; left: -10000px; width: 1px; height: 1px; overflow: hidden; }
            .footer { display: flex; min-height: 82px; align-items: center; justify-content: space-between; gap: 20px; border-top: 1px solid rgb(49 89 71 / 12%); color: var(--muted); font-size: 11px; }
            .footer p { margin: 0; }
            @media (max-width: 760px) {
                .contact-grid { grid-template-columns: 1fr; }
                .details { grid-template-columns: 1fr 1fr; column-gap: 20px; }
                .details h2 { grid-column: 1 / -1; }
                .detail:nth-of-type(2) { border-top: 1px solid rgb(49 89 71 / 10%); }
                .detail:nth-of-type(3) { border-top: 1px solid rgb(49 89 71 / 10%); }
            }
            @media (max-width: 520px) {
                .shell { width: min(100% - 36px, 1120px); }
                .header { min-height: 76px; }
                .brand img { width: 135px; }
                main { padding-block: 55px 70px; }
                .intro { margin-bottom: 30px; }
                .details { grid-template-columns: 1fr; padding: 23px; }
                .details h2 { grid-column: auto; }
                .detail { border-top: 1px solid rgb(49 89 71 / 10%); }
                .form-card { padding: 24px; }
                .footer { flex-wrap: wrap; padding-block: 18px; }
            }
            @media (prefers-reduced-motion: reduce) {
                *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; }
            }
        </style>
    </head>
    <body>
        <header class="header shell">
            <a class="brand" href="{{ route('home') }}" aria-label="Bhavdarpan home">
                <img src="{{ asset('images/logo.png') }}" alt="Bhavdarpan — Reflect. Acknowledge. Heal.">
            </a>
            <a class="back-link" href="{{ route('home') }}">← Back to home</a>
        </header>

        <main class="shell">
            <div class="intro">
                <p class="eyebrow">We're here to listen</p>
                <h1>Get in touch.</h1>
                <p>Have a question or want to learn more about support? Send us a message and our team will be in touch.</p>
            </div>

            <div class="contact-grid">
                <section class="details" aria-labelledby="contact-details-title">
                    <h2 id="contact-details-title">Contact details</h2>
                    <div class="detail">
                        <span class="detail-icon" aria-hidden="true">⌖</span>
                        <div>
                            <h3>Visit us</h3>
                            <p>Kirtipur-5, Chardhara<br>Nepal</p>
                        </div>
                    </div>
                    <div class="detail">
                        <span class="detail-icon" aria-hidden="true">✉</span>
                        <div>
                            <h3>Email us</h3>
                            <a href="mailto:info@bhavdarpan.com">info@bhavdarpan.com</a>
                            <a href="mailto:bhavdarpan@gmail.com">bhavdarpan@gmail.com</a>
                        </div>
                    </div>
                </section>

                <section class="form-card" aria-labelledby="message-title">
                    <h2 id="message-title">Send us a message</h2>
                    <p class="form-intro">Share a little about what brings you here. Your message will be handled with care.</p>

                    @if (session('success'))
                        <div class="notice" role="status">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="honeypot" aria-hidden="true">
                            <label for="company">Leave this field blank</label>
                            <input id="company" name="company" type="text" tabindex="-1" autocomplete="off">
                        </div>
                        <div class="field">
                            <label for="name">Your name</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" maxlength="120" required>
                            @error('name') <p class="error">{{ $message }}</p> @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email address</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" maxlength="255" required>
                            @error('email') <p class="error">{{ $message }}</p> @enderror
                        </div>
                        <div class="field">
                            <label for="message">How can we help?</label>
                            <textarea id="message" name="message" maxlength="5000" required>{{ old('message') }}</textarea>
                            @error('message') <p class="error">{{ $message }}</p> @enderror
                        </div>
                        @error('company') <p class="error">{{ $message }}</p> @enderror
                        <button class="button" type="submit">Send message <span aria-hidden="true">→</span></button>
                    </form>
                </section>
            </div>
        </main>

        <footer class="footer shell">
            <p>Bhavdarpan · Reflect. Acknowledge. Heal.</p>
            <p>Made with care · {{ date('Y') }}</p>
        </footer>
    </body>
</html>

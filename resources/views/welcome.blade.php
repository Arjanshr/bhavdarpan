<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f5f3eb">
        <meta name="description" content="Bhavdarpan is a new space for reflection, acknowledgement, and healing. Coming soon.">

        <title>Bhavdarpan — Coming soon</title>

        <style>
            :root {
                color-scheme: light;
                font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif;
                color: #243529;
                background: #f5f3eb;
                font-synthesis: none;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            * {
                box-sizing: border-box;
            }

            body {
                min-width: 320px;
                min-height: 100vh;
                margin: 0;
                background:
                    radial-gradient(ellipse at 85% 8%, rgb(221 226 207 / 48%), transparent 32rem),
                    #f5f3eb;
            }

            .page {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
                padding: 28px clamp(24px, 6vw, 88px) 22px;
            }

            .topbar,
            .footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .topbar {
                width: min(100%, 1440px);
                margin: 0 auto;
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 13px;
                color: inherit;
                text-decoration: none;
            }

            .brand img {
                display: block;
                width: 88px;
                height: 56px;
                object-fit: cover;
                object-position: center;
                border-radius: 5px;
                mix-blend-mode: multiply;
            }

            .brand-name {
                font-family: Arial, sans-serif;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 0.16em;
                text-transform: uppercase;
            }

            .top-note,
            .footer {
                color: #677365;
                font-family: Arial, sans-serif;
                font-size: 11px;
                letter-spacing: 0.08em;
            }

            .top-note {
                display: inline-flex;
                align-items: center;
                gap: 9px;
                text-transform: uppercase;
            }

            .status-dot {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: #647a4d;
                box-shadow: 0 0 0 4px rgb(100 122 77 / 12%);
            }

            main {
                display: grid;
                width: min(100%, 1180px);
                flex: 1;
                grid-template-columns: 1.05fr 0.95fr;
                align-items: center;
                gap: clamp(44px, 8vw, 120px);
                margin: 0 auto;
                padding: 12px 0;
            }

            .copy {
                position: relative;
                z-index: 1;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 11px;
                margin: 0 0 22px;
                color: #667a55;
                font-family: Arial, sans-serif;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 0.22em;
                text-transform: uppercase;
            }

            .eyebrow::before {
                width: 28px;
                height: 1px;
                content: "";
                background: #9aa78d;
            }

            h1 {
                max-width: 660px;
                margin: 0;
                color: #243529;
                font-size: clamp(52px, 6.4vw, 88px);
                font-weight: 400;
                letter-spacing: -0.065em;
                line-height: 0.99;
            }

            h1 span {
                color: #788866;
                font-style: italic;
                font-weight: 400;
            }

            .description {
                max-width: 390px;
                margin: 21px 0 0;
                color: #687164;
                font-family: Arial, sans-serif;
                font-size: 15px;
                line-height: 1.85;
            }

            .promise {
                display: flex;
                align-items: center;
                gap: 13px;
                margin-top: 27px;
                color: #3e523d;
                font-size: 17px;
                letter-spacing: 0.02em;
            }

            .promise::before {
                width: 34px;
                height: 1px;
                content: "";
                background: #a5ad99;
            }

            .artwork {
                position: relative;
                display: grid;
                min-height: 340px;
                place-items: center;
                isolation: isolate;
            }

            .artwork::before,
            .artwork::after {
                position: absolute;
                z-index: -1;
                border: 1px solid rgb(101 121 82 / 18%);
                border-radius: 50%;
                content: "";
            }

            .artwork::before {
                width: min(35vw, 410px);
                aspect-ratio: 1;
                background: rgb(222 226 208 / 40%);
            }

            .artwork::after {
                width: min(43vw, 500px);
                aspect-ratio: 1;
            }

            .logo-card {
                width: min(100%, 480px);
                padding: 15px;
                overflow: hidden;
                border: 1px solid rgb(73 91 62 / 12%);
                border-radius: 14px;
                background: #f8f6ef;
                box-shadow: 0 28px 80px rgb(53 64 44 / 11%);
                transform: rotate(1.5deg);
                animation: arrive 900ms ease-out both;
            }

            .logo-card img {
                display: block;
                width: 100%;
                height: auto;
                border-radius: 7px;
            }

            .footer {
                width: min(100%, 1440px);
                gap: 16px;
                margin: 0 auto;
                padding-top: 18px;
                border-top: 1px solid rgb(82 99 70 / 17%);
                letter-spacing: 0.04em;
            }

            .footer p {
                margin: 0;
            }

            @keyframes arrive {
                from {
                    opacity: 0;
                    transform: translateY(14px) rotate(1.5deg);
                }

                to {
                    opacity: 1;
                    transform: translateY(0) rotate(1.5deg);
                }
            }

            @media (max-width: 760px) {
                .page {
                    padding: 18px 22px 16px;
                }

                .brand img {
                    width: 72px;
                    height: 46px;
                }

                .brand-name {
                    font-size: 11px;
                }

                .top-note {
                    font-size: 9px;
                    letter-spacing: 0.05em;
                }

                main {
                    grid-template-columns: 1fr;
                    gap: 28px;
                    padding: 70px 0 54px;
                }

                .eyebrow {
                    margin-bottom: 21px;
                }

                h1 {
                    max-width: 560px;
                    font-size: clamp(52px, 12vw, 76px);
                }

                .description {
                    margin-top: 21px;
                    font-size: 14px;
                }

                .promise {
                    margin-top: 25px;
                    font-size: 15px;
                }

                .artwork {
                    min-height: auto;
                    padding: 14px 0 25px;
                }

                .artwork::before {
                    width: min(67vw, 330px);
                }

                .artwork::after {
                    width: min(80vw, 390px);
                }

                .logo-card {
                    width: min(100%, 420px);
                    padding: 10px;
                }

                .footer {
                    font-size: 9px;
                }
            }

            @media (max-width: 390px) {
                .brand {
                    gap: 8px;
                }

                .brand img {
                    width: 58px;
                    height: 38px;
                }

                .top-note {
                    gap: 7px;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                *,
                *::before,
                *::after {
                    scroll-behavior: auto !important;
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <header class="topbar">
                <a class="brand" href="{{ url('/') }}" aria-label="Bhavdarpan home">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Bhavdarpan — Reflect. Acknowledge. Heal.">
                    <span class="brand-name">Bhavdarpan</span>
                </a>
                <span class="top-note"><span class="status-dot" aria-hidden="true"></span>Something thoughtful is taking shape</span>
            </header>

            <main>
                <section class="copy" aria-labelledby="coming-soon-title">
                    <p class="eyebrow">A new beginning</p>
                    <h1 id="coming-soon-title">A little more balance is <span>on its way.</span></h1>
                    <p class="description">We’re creating a space to pause, understand what you’re feeling, and find a gentler way forward.</p>
                    <p class="promise">Reflect. Acknowledge. Heal.</p>
                </section>

                <div class="artwork" aria-label="Bhavdarpan brand artwork">
                    <div class="logo-card">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Bhavdarpan logo with the words Reflect. Acknowledge. Heal.">
                    </div>
                </div>
            </main>

            <footer class="footer">
                <p>Bhavdarpan</p>
                <p>Made with care · {{ date('Y') }}</p>
            </footer>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f6f7f1">
        <meta name="description" content="Compassionate, confidential mental health support across Nepal. Reflect. Acknowledge. Heal.">
        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="512x512">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" type="image/png">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        <title>Bhavdarpan — A gentler space for mental well-being</title>

        <style>
            :root {
                color-scheme: light;
                font-family: Arial, sans-serif;
                color: #21382e;
                background: #f6f7f1;
                font-synthesis: none;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                font-optical-sizing: auto;
                scroll-behavior: smooth;
                --ink: #21382e;
                --muted: #68756c;
                --green: #315947;
                --green-dark: #1d3a2f;
                --sage: #e6ecdf;
                --paper: #f6f7f1;
                --gold: #c79a49;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                min-width: 320px;
                margin: 0;
            }

            a {
                color: inherit;
            }

            a:focus-visible {
                outline: 3px solid #bd8d37;
                outline-offset: 4px;
            }

            .skip-link {
                position: absolute;
                z-index: 10;
                top: 12px;
                left: 12px;
                padding: 12px 16px;
                transform: translateY(-160%);
                border-radius: 8px;
                background: white;
                color: var(--ink);
            }

            .skip-link:focus {
                transform: translateY(0);
            }

            .shell {
                width: min(100% - 48px, 1200px);
                margin-inline: auto;
            }

            .site-header {
                position: relative;
                z-index: 2;
                display: flex;
                min-height: 92px;
                align-items: center;
                justify-content: space-between;
                gap: 32px;
                border-bottom: 1px solid rgb(49 89 71 / 12%);
            }

            .brand {
                display: inline-flex;
                flex: 0 0 auto;
                align-items: center;
                text-decoration: none;
            }

            .brand img {
                display: block;
                width: 166px;
                height: auto;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: clamp(18px, 3vw, 38px);
                color: #52645a;
                font-size: 13px;
            }

            .nav-links a {
                text-decoration: none;
                transition: color 160ms ease;
            }

            .nav-links a:hover {
                color: var(--green);
            }

            .nav-links .nav-cta {
                padding: 12px 17px;
                border: 1px solid rgb(49 89 71 / 25%);
                border-radius: 999px;
                color: var(--green-dark);
                font-weight: 600;
            }

            .nav-links .nav-contact {
                padding: 12px 17px;
                border-radius: 999px;
                background: var(--green);
                color: white;
                font-weight: 600;
            }

            .nav-links .nav-contact:hover {
                background: var(--green-dark);
                color: white;
            }

            .hero {
                position: relative;
                display: grid;
                min-height: 620px;
                grid-template-columns: 1.02fr 0.98fr;
                align-items: center;
                gap: clamp(36px, 7vw, 92px);
                padding-block: 76px 88px;
            }

            .hero::before {
                position: absolute;
                z-index: -1;
                top: 2%;
                right: 0;
                width: 68%;
                aspect-ratio: 1;
                border-radius: 50%;
                background: radial-gradient(circle, rgb(222 231 215 / 64%), rgb(222 231 215 / 0%) 69%);
                content: "";
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                margin: 0 0 24px;
                color: #647e59;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.19em;
                line-height: 1.5;
                text-transform: uppercase;
            }

            .eyebrow::before {
                width: 25px;
                height: 1px;
                background: #a7b39d;
                content: "";
            }

            h1,
            h2,
            h3,
            p {
                margin-top: 0;
            }

            h1,
            h2,
            .step-number {
                font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif;
                font-weight: 400;
            }

            h1 {
                max-width: 650px;
                margin-bottom: 24px;
                color: var(--ink);
                font-size: clamp(54px, 6.6vw, 82px);
                letter-spacing: -0.065em;
                line-height: 0.99;
            }

            h1 em {
                color: #788b69;
                font-weight: 400;
            }

            .hero-copy {
                max-width: 500px;
                margin-bottom: 30px;
                color: var(--muted);
                font-size: 16px;
                line-height: 1.85;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 12px;
            }

            .button {
                display: inline-flex;
                min-height: 49px;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 0 20px;
                border: 1px solid transparent;
                border-radius: 999px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                transition: background-color 160ms ease, border-color 160ms ease, transform 160ms ease;
            }

            .button:hover {
                transform: translateY(-2px);
            }

            .button-primary {
                background: var(--green);
                color: white;
            }

            .button-primary:hover {
                background: var(--green-dark);
            }

            .button-secondary {
                border-color: rgb(49 89 71 / 22%);
                background: rgb(255 255 255 / 35%);
                color: var(--green-dark);
            }

            .hero-art {
                position: relative;
                display: grid;
                min-height: 400px;
                place-items: center;
                isolation: isolate;
            }

            .hero-art::before,
            .hero-art::after {
                position: absolute;
                z-index: -1;
                border: 1px solid rgb(72 101 72 / 15%);
                border-radius: 50%;
                content: "";
            }

            .hero-art::before {
                width: min(88%, 400px);
                aspect-ratio: 1;
                background: rgb(226 233 219 / 66%);
            }

            .hero-art::after {
                width: min(105%, 480px);
                aspect-ratio: 1;
            }

            .logo-panel {
                width: min(100%, 450px);
                padding: clamp(18px, 4vw, 34px);
                border: 1px solid rgb(49 89 71 / 10%);
                border-radius: 24px;
                background: #fffefa;
                box-shadow: 0 28px 75px rgb(37 59 44 / 11%);
                transform: rotate(1deg);
            }

            .logo-panel img {
                display: block;
                width: 100%;
                height: auto;
            }

            .hero-note {
                position: absolute;
                right: -4%;
                bottom: 9%;
                display: flex;
                align-items: center;
                gap: 12px;
                max-width: 230px;
                padding: 15px 18px;
                border: 1px solid rgb(49 89 71 / 10%);
                border-radius: 14px;
                background: #fffefa;
                box-shadow: 0 12px 36px rgb(37 59 44 / 9%);
                color: #455d4c;
                font-size: 12px;
                line-height: 1.5;
            }

            .note-mark {
                display: grid;
                width: 32px;
                height: 32px;
                flex: 0 0 auto;
                place-items: center;
                border-radius: 50%;
                background: #e8eee1;
                color: var(--green);
                font-family: Georgia, serif;
                font-size: 19px;
            }

            .section {
                padding-block: 104px;
            }

            .section-intro {
                max-width: 690px;
                margin-bottom: 48px;
            }

            .section-intro h2,
            .about-copy h2,
            .support-copy h2 {
                margin-bottom: 18px;
                color: var(--ink);
                font-size: clamp(38px, 5vw, 58px);
                letter-spacing: -0.05em;
                line-height: 1.06;
            }

            .section-intro > p:last-child,
            .about-copy > p,
            .section-intro > div,
            .about-copy > div,
            .support-heading > div,
            .support-heading > p,
            .value-card > div,
            .support-card > div > div {
                margin-bottom: 0;
                color: var(--muted);
                font-size: 15px;
                line-height: 1.9;
            }

            .hero-copy p,
            .section-intro > div p,
            .about-copy > div p,
            .support-heading > div p,
            .value-card > div p,
            .support-card > div > div p {
                margin: 0;
            }

            .about-copy > div + div {
                margin-top: 16px;
            }

            .values {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
            }

            .value-card {
                min-height: 238px;
                padding: 29px;
                border: 1px solid rgb(49 89 71 / 10%);
                border-radius: 18px;
                background: #fffefa;
            }

            .card-index {
                display: inline-flex;
                width: 38px;
                height: 38px;
                align-items: center;
                justify-content: center;
                margin-bottom: 25px;
                border-radius: 50%;
                background: #edf1e8;
                color: #5e7854;
                font-family: Georgia, serif;
                font-size: 16px;
            }

            .value-card h3,
            .support-card h3 {
                margin-bottom: 10px;
                color: var(--ink);
                font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif;
                font-size: 25px;
                font-weight: 400;
                letter-spacing: -0.025em;
            }

            .value-card p,
            .support-card p {
                margin-bottom: 0;
                color: var(--muted);
                font-size: 13px;
                line-height: 1.8;
            }

            .about-section {
                position: relative;
                overflow: hidden;
                background: #e9eee4;
            }

            .about-grid {
                display: grid;
                grid-template-columns: 0.88fr 1.12fr;
                align-items: center;
                gap: clamp(45px, 9vw, 120px);
            }

            .about-art {
                position: relative;
                display: grid;
                min-height: 360px;
                place-items: center;
            }

            .about-art::before {
                position: absolute;
                width: min(100%, 350px);
                aspect-ratio: 1;
                border: 1px solid rgb(49 89 71 / 18%);
                border-radius: 50%;
                background: rgb(255 255 255 / 22%);
                content: "";
            }

            .motto {
                position: relative;
                display: grid;
                width: min(100%, 295px);
                aspect-ratio: 1;
                align-content: center;
                justify-items: center;
                gap: 9px;
                border-radius: 50%;
                background: var(--green);
                box-shadow: 0 25px 55px rgb(37 59 44 / 18%);
                color: #fffefa;
                text-align: center;
            }

            .motto span {
                font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif;
                font-size: clamp(28px, 3.5vw, 39px);
                letter-spacing: -0.04em;
            }

            .motto span:nth-child(2) {
                color: #e2c47e;
            }

            .motto span:nth-child(3) {
                color: #d6e0ce;
            }

            .about-copy h2 {
                max-width: 520px;
            }

            .about-copy > p + p {
                margin-top: 16px;
            }

            .support-section {
                padding-bottom: 112px;
            }

            .support-heading {
                display: flex;
                align-items: end;
                justify-content: space-between;
                gap: 40px;
                margin-bottom: 44px;
            }

            .support-heading .section-intro {
                max-width: 650px;
                margin-bottom: 0;
            }

            .support-heading .section-intro h2 {
                margin-bottom: 0;
            }

            .support-heading > p,
            .support-heading > div {
                max-width: 300px;
                margin: 0 0 4px;
                color: var(--muted);
                font-size: 13px;
                line-height: 1.8;
            }

            .support-cards {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .support-card {
                display: flex;
                min-height: 190px;
                gap: 20px;
                padding: 28px;
                border: 1px solid rgb(49 89 71 / 11%);
                border-radius: 18px;
                background: #fffefa;
            }

            .support-icon {
                display: grid;
                width: 48px;
                height: 48px;
                flex: 0 0 auto;
                place-items: center;
                border-radius: 14px;
                background: #edf1e8;
                color: var(--green);
            }

            .support-icon svg {
                width: 23px;
                height: 23px;
                fill: none;
                stroke: currentColor;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-width: 1.6;
            }

            .closing {
                padding-block: 68px;
                background: var(--green-dark);
                color: white;
            }

            .closing-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 36px;
            }

            .closing h2 {
                max-width: 670px;
                margin-bottom: 12px;
                font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif;
                font-size: clamp(34px, 4.7vw, 52px);
                font-weight: 400;
                letter-spacing: -0.045em;
                line-height: 1.08;
            }

            .closing p {
                margin: 0;
                color: rgb(255 255 255 / 72%);
                font-size: 13px;
                line-height: 1.7;
            }

            .closing .button {
                flex: 0 0 auto;
                background: #f6f3e8;
                color: var(--green-dark);
            }

            .closing .button:hover {
                background: white;
            }

            .site-footer {
                display: flex;
                min-height: 100px;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                color: #69756c;
                font-size: 11px;
            }

            .footer-brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                color: var(--ink);
                font-weight: 700;
                text-decoration: none;
            }

            .footer-brand img {
                width: 104px;
                height: auto;
            }

            .site-footer p {
                margin: 0;
            }

            .site-footer > a:last-child {
                text-decoration-color: rgb(49 89 71 / 30%);
                text-underline-offset: 4px;
            }

            @media (max-width: 820px) {
                .site-header {
                    min-height: 78px;
                }

                .nav-links {
                    gap: 18px;
                }

                .nav-links > a:not(.nav-cta):not(.nav-contact) {
                    display: none;
                }

                .hero {
                    min-height: auto;
                    grid-template-columns: 1fr;
                    gap: 28px;
                    padding-block: 74px 62px;
                }

                .hero-copy {
                    max-width: 600px;
                }

                .hero-art {
                    min-height: 350px;
                }

                .logo-panel {
                    width: min(84%, 430px);
                }

                .hero-note {
                    right: 2%;
                    bottom: 3%;
                }

                .section {
                    padding-block: 78px;
                }

                .about-grid {
                    grid-template-columns: 0.8fr 1.2fr;
                    gap: 38px;
                }

                .about-art {
                    min-height: 290px;
                }

                .motto {
                    width: min(100%, 250px);
                }
            }

            @media (max-width: 600px) {
                .shell {
                    width: min(100% - 36px, 1200px);
                }

                .brand img {
                    width: 145px;
                }

                .nav-links > a:not(.nav-contact) {
                    display: none;
                }

                .nav-links {
                    gap: 0;
                }

                .nav-links .nav-cta {
                    padding: 10px 13px;
                    font-size: 11px;
                }

                .hero {
                    padding-block: 62px 42px;
                }

                h1 {
                    font-size: clamp(48px, 13vw, 68px);
                }

                .hero-copy {
                    font-size: 14px;
                }

                .hero-art {
                    min-height: 290px;
                }

                .logo-panel {
                    width: min(86%, 390px);
                    padding: 18px;
                    border-radius: 18px;
                }

                .hero-note {
                    right: 0;
                    bottom: 0;
                    max-width: 205px;
                    padding: 11px 13px;
                    font-size: 11px;
                }

                .section {
                    padding-block: 66px;
                }

                .section-intro {
                    margin-bottom: 32px;
                }

                .section-intro h2,
                .about-copy h2,
                .support-copy h2 {
                    font-size: 42px;
                }

                .values,
                .support-cards {
                    grid-template-columns: 1fr;
                }

                .value-card {
                    min-height: auto;
                    padding: 24px;
                }

                .card-index {
                    margin-bottom: 18px;
                }

                .about-grid {
                    grid-template-columns: 1fr;
                    gap: 25px;
                }

                .about-art {
                    min-height: 275px;
                    order: 2;
                }

                .about-copy {
                    order: 1;
                }

                .motto {
                    width: 240px;
                }

                .support-heading {
                    display: block;
                }

                .support-heading > p,
                .support-heading > div {
                    margin-top: 18px;
                }

                .support-card {
                    min-height: auto;
                    padding: 23px;
                }

                .closing {
                    padding-block: 52px;
                }

                .closing-inner {
                    align-items: flex-start;
                    flex-direction: column;
                    gap: 24px;
                }

                .site-footer {
                    min-height: 85px;
                    flex-wrap: wrap;
                    padding-block: 19px;
                    font-size: 10px;
                }
            }

            @media (max-width: 360px) {
                .shell {
                    width: min(100% - 28px, 1200px);
                }

                .brand img {
                    width: 125px;
                }

                .nav-links .nav-cta {
                    padding-inline: 10px;
                    font-size: 10px;
                }

                .hero-actions {
                    align-items: stretch;
                    flex-direction: column;
                }

                .button {
                    width: 100%;
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
        <a class="skip-link" href="#main-content">Skip to content</a>
        <header class="site-header shell">
            <a class="brand" href="{{ route('home') }}" aria-label="Bhavdarpan home">
                <img src="{{ asset('images/logo.png') }}" alt="Bhavdarpan — Reflect. Acknowledge. Heal.">
            </a>
            <nav class="nav-links" aria-label="Main navigation">
                <a href="#about">About us</a>
                <a href="#approach">Our approach</a>
                <a class="nav-cta" href="#support">Ways to connect <span aria-hidden="true">↗</span></a>
                <a class="nav-contact" href="{{ route('contact') }}">Contact us</a>
            </nav>
        </header>

        <main id="main-content">
            <section class="hero shell" aria-labelledby="hero-title">
                <div>
                    <p class="eyebrow">{{ $content['hero_eyebrow'] }}</p>
                    <h1 id="hero-title">{{ $content['hero_title'] }}</h1>
                    <div class="hero-copy">{!! $content['hero_description'] !!}</div>
                    <div class="hero-actions">
                        <a class="button button-primary" href="#approach">Explore our approach <span aria-hidden="true">→</span></a>
                        <a class="button button-secondary" href="#support">Ways to connect</a>
                        <a class="button button-secondary" href="{{ route('contact') }}">Contact us</a>
                    </div>
                </div>
                <div class="hero-art" aria-label="Bhavdarpan brand artwork">
                    <div class="logo-panel">
                        <img src="{{ asset('images/logo.png') }}" alt="Bhavdarpan logo with the words Reflect. Acknowledge. Heal.">
                    </div>
                    <div class="hero-note"><span class="note-mark" aria-hidden="true">“</span><span>A respectful space, centered around you.</span></div>
                </div>
            </section>

            <section class="section shell" id="approach" aria-labelledby="approach-title">
                <div class="section-intro">
                    <p class="eyebrow">{{ $content['approach_eyebrow'] }}</p>
                    <h2 id="approach-title">{{ $content['approach_title'] }}</h2>
                    <div>{!! $content['approach_description'] !!}</div>
                </div>
                <div class="values">
                    <article class="value-card">
                        <span class="card-index" aria-hidden="true">01</span>
                        <h3>{{ $content['value_1_title'] }}</h3>
                        <div>{!! $content['value_1_description'] !!}</div>
                    </article>
                    <article class="value-card">
                        <span class="card-index" aria-hidden="true">02</span>
                        <h3>{{ $content['value_2_title'] }}</h3>
                        <div>{!! $content['value_2_description'] !!}</div>
                    </article>
                    <article class="value-card">
                        <span class="card-index" aria-hidden="true">03</span>
                        <h3>{{ $content['value_3_title'] }}</h3>
                        <div>{!! $content['value_3_description'] !!}</div>
                    </article>
                </div>
            </section>

            <section class="section about-section" id="about" aria-labelledby="about-title">
                <div class="about-grid shell">
                    <div class="about-art" aria-hidden="true">
                        <div class="motto">
                            <span>Reflect.</span>
                            <span>Acknowledge.</span>
                            <span>Heal.</span>
                        </div>
                    </div>
                    <div class="about-copy">
                        <p class="eyebrow">{{ $content['about_eyebrow'] }}</p>
                        <h2 id="about-title">{{ $content['about_title'] }}</h2>
                        <div>{!! $content['about_paragraph_one'] !!}</div>
                        <div>{!! $content['about_paragraph_two'] !!}</div>
                    </div>
                </div>
            </section>

            <section class="section support-section shell" id="support" aria-labelledby="support-title">
                <div class="support-heading">
                    <div class="section-intro">
                        <p class="eyebrow">{{ $content['support_eyebrow'] }}</p>
                        <h2 id="support-title">{{ $content['support_title'] }}</h2>
                    </div>
                    <div>{!! $content['support_description'] !!}</div>
                </div>
                <div class="support-cards">
                    <article class="support-card">
                        <span class="support-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M4 20V9l8-5 8 5v11M8 20v-6h8v6M2.5 20h19" /></svg>
                        </span>
                        <div>
                            <h3>{{ $content['in_person_title'] }}</h3>
                            <div>{!! $content['in_person_description'] !!}</div>
                        </div>
                    </article>
                    <article class="support-card">
                        <span class="support-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="13" rx="2" /><path d="M8 22h8M12 18v4M8 11h.01M12 11h.01M16 11h.01" /></svg>
                        </span>
                        <div>
                            <h3>{{ $content['virtual_title'] }}</h3>
                            <div>{!! $content['virtual_description'] !!}</div>
                        </div>
                    </article>
                </div>
            </section>

            <section class="closing" aria-labelledby="closing-title">
                <div class="closing-inner shell">
                    <div>
                        <h2 id="closing-title">{{ $content['closing_title'] }}</h2>
                        <p>{{ $content['closing_description'] }}</p>
                    </div>
                    <a class="button" href="{{ route('coming-soon') }}">Visit our coming-soon page <span aria-hidden="true">→</span></a>
                </div>
            </section>
        </main>

        <footer class="site-footer shell">
            <a class="footer-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="">
                <span>Bhavdarpan</span>
            </a>
            <p>Reflect. Acknowledge. Heal.</p>
            <a href="{{ route('contact') }}">Contact us</a>
            <a href="#main-content">Back to top ↑</a>
        </footer>
    </body>
</html>

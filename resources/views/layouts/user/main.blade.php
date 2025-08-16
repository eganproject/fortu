<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Fortu - Solusi Digital Interaktif')</title>
    <link rel="icon" href="{{ get_logo_header_url() }}" type="image/png">

    <!-- Common CSS, Fonts, and Scripts (Keep this in all files) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Urbanist', 'Inter', 'ui-sans-serif', 'system-ui'],
                        body: ['Inter', 'ui-sans-serif', 'system-ui']
                    },
                    colors: {
                        silver: {
                            25: '#fcfdff',
                            50: '#f6f8fb',
                            100: '#eef2f7',
                            200: '#dfe6ef',
                            300: '#cbd6e3',
                            400: '#aebaca',
                            500: '#95a3b2',
                            600: '#7b8896',
                            700: '#636e7a',
                            800: '#4f5862',
                            900: '#3b424a',
                            950: '#23282e'
                        },
                        accent: {
                            400: '#BEEAFF',
                            500: '#9BDCFB',
                            600: '#78CFF7'
                        }
                    },
                    boxShadow: {
                        neo: '0 10px 30px rgba(155, 220, 251, .25)',
                        ring: 'inset 0 1px 0 rgba(255,255,255,.9), 0 10px 25px rgba(0,0,0,.06)'
                    },
                    animation: {
                        'gradient-bg': 'gradient-bg 15s ease infinite'
                    },
                    keyframes: {
                        'gradient-bg': {
                            '0%, 100%': {
                                backgroundPosition: '0% 50%'
                            },
                            '50%': {
                                backgroundPosition: '100% 50%'
                            }
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Urbanist:wght@600;700;800&display=swap&family=Dosis:wght@300..700&display=swap"
        rel="stylesheet" />

    <style>
        /* Common styles */
        .metal {
            background: linear-gradient(140deg, #f5f8fc, #dfe6ef 38%, #f4f7fb 55%, #cbd6e3 78%, #eef2f7 100%);
        }

        .metal-dark {
            background: linear-gradient(160deg, #e6ecf4, #c3cfdd 44%, #e9eef5 66%, #b4c2d2 90%);
        }

        .noise {
            position: relative;
        }

        .noise::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" viewBox="0 0 140 140"><filter id="n"><feTurbulence type="fractalNoise" baseFrequency="0.8" numOctaves="2" stitchTiles="stitch"/></filter><rect width="100%" height="100%" filter="url(%23n)" opacity=".04"/></svg>');
            pointer-events: none;
            mix-blend: overlay;
        }

        .glass {
            background: linear-gradient(180deg, rgba(255, 255, 255, .7), rgba(255, 255, 255, .55));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .7);
        }

        .g-border {
            position: relative;
        }

        .g-border::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 1px;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(255, 255, 255, .9), rgba(161, 227, 249, .9), rgba(255, 255, 255, .9));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .sheen {
            position: relative;
            overflow: hidden;
        }

        .sheen::after {
            content: "";
            position: absolute;
            inset: -150% -150% auto auto;
            width: 60%;
            height: 300%;
            transform: rotate(25deg);
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .6), transparent);
            animation: sheen 6.5s linear infinite;
        }

        @keyframes sheen {
            0% {
                transform: translateX(-220%) rotate(25deg);
            }

            60% {
                transform: translateX(130%) rotate(25deg);
            }

            100% {
                transform: translateX(130%) rotate(25deg);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(26px) scale(.98);
            transition: all .9s cubic-bezier(.2, .6, .2, 1);
            transition-delay: var(--reveal-delay, 0s);
        }

        .reveal.in {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .magnet {
            transition: transform .2s ease;
            will-change: transform;
        }

        .spy a[aria-current="true"] {
            color: #0f172a;
        }

        .spy a[aria-current="true"] .u {
            width: 60%;
        }

        .u {
            display: block;
            height: 2px;
            width: 0;
            background: linear-gradient(90deg, #78CFF7, #BEEAFF, transparent);
            border-radius: 999px;
            transition: width .35s ease;
        }

        .u-accent {
            position: relative;
        }

        .u-accent::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 62%;
            height: 4px;
            background: linear-gradient(90deg, #7ED3F1, #A1E3F9, transparent);
            border-radius: 999px;
            background-size: 200% 100%;
            animation: underlineFlow 6s ease-in-out infinite;
        }

        @keyframes underlineFlow {

            0%,
            100% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }
        }

        .connector-path {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            transition: stroke-dashoffset 2s cubic-bezier(.6, .1, .4, 1);
        }

        .journey-container.in .connector-path {
            stroke-dashoffset: 0;
        }

        .connector-path.delay-1 {
            transition-delay: 0.3s;
        }

        .connector-path.delay-2 {
            transition-delay: 0.6s;
        }

        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #cbd6e3, #aebaca);
            border-radius: 999px
        }

        nav a.active {
            color: #0f172a;
            font-weight: 600;
        }

        nav a.active .u {
            width: 60%;
        }
    </style>
</head>

<body class="bg-silver-50 text-silver-900 font-body selection:bg-accent-500/30">

    @include('layouts.user.header')

    <main class="">
        @yield('content')
    </main>

    @include('layouts.user.footer')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <button id="toTop" aria-label="Kembali ke atas"
        class="fixed bottom-6 right-6 hidden p-3 rounded-full bg-silver-900 text-white shadow-lg hover:shadow-neo"><i
            data-lucide="arrow-up"></i></button>

    <script>
        const toTop = document.getElementById('toTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 800) {
                toTop.classList.remove('hidden');
            } else {
                toTop.classList.add('hidden');
            }
        });
        toTop.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));
    </script>

    @stack('jsOnPage')
</body>

</html>

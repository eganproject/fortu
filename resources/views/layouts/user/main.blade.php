<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul halaman bisa dinamis --}}
    <title>@yield('title', 'Fortu - Solusi Digital Interaktif')</title>
    <link rel="icon" href="{{ get_logo_header_url() }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 25px;
            right: 25px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.25);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .whatsapp-icon {
            width: 32px;
            height: 32px;
        }
    </style>
    @stack('cssOnPage')
</head>

<body class="bg-white text-gray-800">

    {{-- Memanggil Header --}}
    @include('layouts.user.header')

    <main class="">
        {{-- Area konten utama yang akan diisi oleh halaman lain --}}
        @yield('content')
    </main>

    {{-- Memanggil Footer --}}
    <section class="">

        @include('layouts.user.footer')
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // JavaScript untuk menu mobile
        document.addEventListener("DOMContentLoaded", () => {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });

        // JavaScript untuk Carousel (hanya akan berjalan jika elemennya ada)
    </script>

    @stack('jsOnPage')
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fortu - Admin Panel')</title>
    <link rel="icon" href="{{ get_logo_header_url() }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dropdown-menu {
            transition: opacity 0.2s ease-out, transform 0.2s ease-out;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('cssOnPage')
</head>

<body x-data="{ desktopSidebarOpen: true }" class="bg-gradient-to-br from-slate-100 to-slate-300">

    <button @click="desktopSidebarOpen = true" x-show="!desktopSidebarOpen"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="hidden md:block fixed top-5 left-4 z-40 p-2 bg-white/80 backdrop-blur-lg rounded-full shadow-lg text-slate-600 hover:text-slate-900"
        x-cloak>
        <i data-lucide="panel-right-open"></i>
    </button>

    <div class="flex h-screen bg-white md:bg-transparent">

        @include('layouts.admin.sidebar')

        <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 hidden z-20" onclick="toggleSidebar()"></div>

        <div class="flex-1 flex flex-col overflow-hidden">

            @include('layouts.admin.navbar')

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-6 lg:p-8">
                @yield('content')
                @include('layouts.admin.footer')
            </main>

        </div>
    </div>


    <script src="https://unpkg.com/lucide@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <script>
        // Render Lucide Icons
        lucide.createIcons();

        // JavaScript untuk toggle sidebar di tampilan mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

    @stack('jsOnPage')
</body>

</html>

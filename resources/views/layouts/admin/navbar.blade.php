<header
    class="relative z-10 flex justify-between items-center p-4 md:p-5 bg-white/80 backdrop-blur-lg md:bg-transparent md:backdrop-blur-none border-b border-slate-200/80 shadow-sm md:border-none md:shadow-none">
    <div class="flex items-center">
        <button id="hamburger-btn" class="md:hidden mr-4 text-slate-600 hover:text-slate-900" onclick="toggleSidebar()">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
        <div>
            <h1 class="text-xl font-bold text-slate-800">Selamat Datang, {{ auth()->user()->name}}!</h1>
            <nav class="text-xs text-slate-500 mt-1" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="#" class="hover:text-blue-600">Admin Panel</a>
                    </li>
                    {{-- <li class="flex items-center mx-2">
                        <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    </li> --}}
                    {{-- <li class="flex items-center">
                        <span class="text-slate-700">Halaman Utama</span>
                    </li> --}}
                </ol>
            </nav>
        </div>
    </div>
    <div class="flex items-center space-x-2 md:space-x-4">

        @include('layouts.admin.notification')

        <div x-data="{ open: false }" @click.away="open = false" class="relative">
            <button @click="open = !open" class="flex items-center space-x-3 p-1 rounded-full hover:bg-slate-100">
                <img src="https://placehold.co/40x40/E2E8F0/475569?text={{ substr(auth()->user()->name, 0, 1) }}" alt="Avatar Pengguna"
                    class="w-10 h-10 rounded-full">
                <div class="hidden md:block text-left">
                    <div class="font-semibold text-slate-800 text-sm"> {{ auth()->user()->name}}</div>
                    <div class="text-xs text-slate-500">{{ auth()->user()->role->name }}</div>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500 hidden md:block"></i>
            </button>
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="dropdown-menu absolute right-0 mt-2 w-48 bg-white/90 backdrop-blur-lg rounded-xl shadow-xl z-50 overflow-hidden">
                <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-100/80">
                    <i data-lucide="user-circle" class="w-4 h-4 mr-2"></i> Profil
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-100/80">
                    <i data-lucide="sliders-horizontal" class="w-4 h-4 mr-2"></i> Akun
                </a>
                <hr class="border-slate-200/80">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                    class="flex items-center px-4 py-2 text-sm text-red-500 hover:bg-red-50">
                    <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>

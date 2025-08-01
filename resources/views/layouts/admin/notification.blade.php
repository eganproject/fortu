<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <button @click="open = !open" class="relative p-2 text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-full">
        <i data-lucide="bell" class="w-6 h-6"></i>
        <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
    </button>
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="dropdown-menu absolute right-0 mt-2 w-80 bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl z-50 overflow-hidden">
        <div class="p-4 font-semibold border-b">Notifikasi</div>
        <div class="divide-y">
            {{-- <a href="#" class="flex items-start p-4 space-x-3 hover:bg-slate-100/80">
                <div class="bg-blue-100 text-blue-600 p-2 rounded-full"><i data-lucide="shopping-cart" class="w-5 h-5"></i></div>
                <div>
                    <p class="text-sm font-semibold">Pesanan baru #ORD-00125</p>
                    <p class="text-xs text-slate-500">Dari Rina Amelia</p>
                    <p class="text-xs text-slate-400 mt-1">15 menit yang lalu</p>
                </div>
            </a>
            <a href="#" class="flex items-start p-4 space-x-3 hover:bg-slate-100/80">
                <div class="bg-emerald-100 text-emerald-600 p-2 rounded-full"><i data-lucide="user-plus" class="w-5 h-5"></i></div>
                <div>
                    <p class="text-sm font-semibold">Pengguna baru terdaftar</p>
                    <p class="text-xs text-slate-500">Email: joko@example.com</p>
                    <p class="text-xs text-slate-400 mt-1">1 jam yang lalu</p>
                </div>
            </a>
            <a href="#" class="flex items-start p-4 space-x-3 hover:bg-slate-100/80">
                <div class="bg-amber-100 text-amber-600 p-2 rounded-full"><i data-lucide="server" class="w-5 h-5"></i></div>
                <div>
                    <p class="text-sm font-semibold">Server hampir penuh</p>
                    <p class="text-xs text-slate-500">Kapasitas disk mencapai 90%</p>
                    <p class="text-xs text-slate-400 mt-1">3 jam yang lalu</p>
                </div>
            </a> --}}
        </div>
        <a href="#" class="block text-center text-sm font-semibold text-blue-600 p-3 hover:bg-slate-100/80 border-t">Lihat Semua Notifikasi</a>
    </div>
</div>
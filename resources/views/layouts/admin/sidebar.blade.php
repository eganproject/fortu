<aside id="sidebar"
    class="w-64 bg-white/80 backdrop-blur-lg shadow-xl fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-all duration-300 ease-in-out z-30 overflow-hidden"
    :class="desktopSidebarOpen ? 'md:w-64' : 'md:w-0'">
    <div class="flex items-center justify-between p-6 border-b border-slate-200/80 h-20">
        <div class="flex items-center space-x-3">
            <i data-lucide="club" class="w-8 h-8 text-yellow-300"></i>
            <span
                class="text-sm font-bold text-slate-800 bg-gradient-to-r from-yellow-300 to-orange-500 bg-clip-text text-transparent">Cahaya
                Optima</span>
        </div>
        <button @click="desktopSidebarOpen = false" class="hidden md:block text-slate-500 hover:text-slate-800">
            <i data-lucide="panel-left-close" :class="{ 'hidden': desktopSidebarOpen }"></i>
            <i data-lucide="panel-right" :class="{ 'hidden': !desktopSidebarOpen }"></i>
        </button>
    </div>

    {{-- Navigasi baru disesuaikan di sini --}}
    <nav class="flex-1 mt-4 px-4 space-y-1">

        {{-- Dashboard --}}
        <a href="/admin"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors text-sm {{ Route::is('admin.dashboard') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-200/60' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        {{-- Dropdown Web Preference --}}
        <div x-data="{ isOpen: false }" class="space-y-1">
            <button @click="isOpen = !isOpen" type="button" x-init="isOpen = {{ Route::is('admin.web_preferences.*') ? 'true' : 'false' }}"
                class="w-full flex items-center justify-between gap-3 px-4 py-2.5 rounded-lg transition-colors text-sm text-slate-600 hover:bg-slate-200/60">
                <div class="flex items-center gap-3">
                    <i data-lucide="chevrons-left-right" class="w-5 h-5"></i>
                    <span>Web Preference</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
                    :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-transition class="pl-7 space-y-1">
                <a href="/admin/web-preferences/informasi"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.informasi') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="book-marked" class="w-5 h-5"></i>
                    <span>Informasi</span>
                </a>
                <a href="/admin/web-preferences/hero"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.hero') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="tv" class="w-5 h-5"></i>
                    <span>Hero</span>
                </a>
                <a href="/admin/web-preferences/carousel"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.carousel') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="gallery-thumbnails" class="w-5 h-5"></i>
                    <span>Carousel</span>
                </a>
                <a href="/admin/web-preferences/sorotan"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.sorotan') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="fullscreen" class="w-5 h-5"></i>
                    <span>Sorotan</span>
                </a>
                <a href="/admin/web-preferences/client-experience"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.client-experience') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="flame" class="w-5 h-5"></i>
                    <span>Client Expreience</span>
                </a>
                <a href="/admin/web-preferences/about"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.about') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="info" class="w-5 h-5"></i>
                    <span>About Us</span>
                </a>
                <a href="/admin/web-preferences/services"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs  {{ Route::is('admin.web_preferences.services') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="hand-platter" class="w-5 h-5"></i>
                    <span>Service</span>
                </a>
                <a href="/admin/web-preferences/blog"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.blog') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="rss" class="w-5 h-5"></i>
                    <span>Blog</span>
                </a>
                <a href="/admin/web-preferences/kategori"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.kategori') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="tag" class="w-4 h-4"></i>
                    <span>Kategori Produk</span>
                </a>
                <a href="/admin/web-preferences/produk"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.web_preferences.produk') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="list" class="w-4 h-4"></i>
                    <span>Daftar Produk</span>
                </a>
            </div>
        </div>

        {{-- User Management --}}
        <div x-data="{ isOpen: false }" class="space-y-1">
            <button @click="isOpen = !isOpen" type="button" x-init="isOpen = {{ Route::is('admin.user-management.*') ? 'true' : 'false' }}"
                class="w-full flex items-center justify-between gap-3 px-4 py-2.5 rounded-lg transition-colors text-sm text-slate-600 hover:bg-slate-200/60">
                <div class="flex items-center gap-3">
                    <i data-lucide="shield-user" class="w-5 h-5"></i>
                    <span>User Management</span>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
                    :class="{ 'rotate-180': isOpen }"></i>
            </button>
            <div x-show="isOpen" x-transition class="pl-7 space-y-1">
                @if (auth()->user()->role->name === 'Super Admin')
                    <a href="/admin/user-management/role"
                        class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.user-management.role') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                        <i data-lucide="user-pen" class="w-5 h-5"></i>
                        <span>Role</span>
                    </a>
                    <a href="/admin/user-management/users"
                        class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.user-management.users') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Users</span>
                    </a>
                @endif
                <a href="/admin/user-management/users-activity"
                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-lg transition-colors text-xs {{ Route::is('admin.user-management.users_activity') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-500 hover:text-slate-800' }}">
                    <i data-lucide="user-round-search" class="w-5 h-5"></i>
                    <span>Users Activity</span>
                </a>
            </div>
        </div>
        {{-- Analytic --}}
        <a href="#"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors text-sm text-slate-600 hover:bg-slate-200/60">
            <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
            <span>Analytic</span>
        </a>
        <a href="/admin/contact"
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors text-sm {{ Route::is('admin.contact') ? 'bg-slate-200/60 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-200/60' }}">
            <i data-lucide="contact-round" class="w-5 h-5"></i>
            <span>Contact Us</span>
        </a>
    </nav>
</aside>

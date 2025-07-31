<header id="site-header" class="bg-gray-100 bg-opacity-100 sticky top-0 z-50 shadow-sm px-12 transition-all duration-300">
    {{-- Jarak samping diubah dari px-4 menjadi px-8 --}}
    <nav class="container mx-auto px-8 py-4 flex justify-between items-center">
        <div class="flex-shrink-0">
            <a href="/" class="flex items-center">
                <img src="{{ get_logo_url() }}" alt="Fortu Logo" class="object-cover h-12 transition-transform duration-300 hover:scale-110">
            </a>
        </div>
        <div class="hidden md:flex items-center space-x-12 text-base">
            <a href="/about"
                class="{{ request()->is('about') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">About
                Us</a>
            <a href="/service"
                class="{{ request()->is('service') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">Service</a>
            {{-- <a href="/smartos"
                class="{{ request()->is('smartos') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">Smart
                Office Solution</a> --}}
            <a href="/product"
                class="{{ request()->is('product') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">Product</a>
            <a href="/blog"
                class="{{ request()->is('blog') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">Blog</a>
            <a href="/contact"
                class="{{ request()->is('contact') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">Contact</a>
            {{-- <a href="/bcap"
                class="{{ request()->is('bcap') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">Become
                a Partner</a>
            <a href="/career"
                class="{{ request()->is('career') ? 'text-gray-400' : 'text-gray-700 hover:bg-black hover:text-white  rounded-full px-3 py-2 transition-colors duration-300' }} font-semibold">Career</a> --}}
        </div>

        <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-menu-icon lucide-menu">
                <path d="M4 12h16" />
                <path d="M4 18h16" />
                <path d="M4 6h16" />
            </svg>
        </button>

        <button id="mobile-menu-close-button" class="hidden md:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden">
        {{-- Ukuran font mobile juga diubah menjadi text-xs --}}
        <a href="/about"
            class="block py-2 px-4  {{ request()->is('about') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">About
            us</a>
        <a href="/service"
            class="block py-2 px-4 {{ request()->is('service') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">Service</a>
        {{-- <a href="/smartos"
            class="block py-2 px-4 {{ request()->is('smartos') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">Smart
            Office Solution</a> --}}
        <a href="/product"
            class="block py-2 px-4 {{ request()->is('product') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">Product</a>
        <a href="/blog"
            class="block py-2 px-4 {{ request()->is('blog') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">Blog</a>
        <a href="/contact"
            class="block py-2 px-4 {{ request()->is('contact') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">Contact</a>
        {{-- <a href="/bcap"
            class="block py-2 px-4 {{ request()->is('bcap') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">Become
            a Partner</a>
        <a href="/career"
            class="block py-2 px-4 {{ request()->is('career') ? 'text-sm text-purple-600' : 'text-xs text-gray-700' }} hover:bg-gray-200">Career</a> --}}
    </div>
</header>

@push('jsOnPage')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenuCloseButton = document.getElementById('mobile-menu-close-button');
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
                mobileMenuButton.classList.add('hidden');
                mobileMenuCloseButton.classList.remove('hidden');
            });
            mobileMenuCloseButton.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                mobileMenuButton.classList.remove('hidden');
                mobileMenuCloseButton.classList.add('hidden');
            });
        });
    </script>
@endpush

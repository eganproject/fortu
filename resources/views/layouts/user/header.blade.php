<header class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <a href="/" class="flex items-center gap-3 group">
        <div class="h-9 w-9 rounded-xl metal-dark ring-1 ring-white/70 group-hover:shadow-neo transition"></div>
        <span class="font-display text-xl tracking-tight">FORTU</span>
      </a>
      <nav class="hidden md:flex items-center gap-2 text-sm " id="">
        <a href="/" class="px-3 py-2 rounded-xl hover:bg-silver-100/70 relative {{ request()->path() === '/' ? 'active' : '' }}"><span>Beranda</span><span class="u absolute left-3 -bottom-0.5"></span></a>
        <a href="/about" class="px-3 py-2 rounded-xl hover:bg-silver-100/70 relative {{ request()->is('about') ? 'active' : '' }}"><span>Tentang</span><span class="u absolute left-3 -bottom-0.5"></span></a>
        <a href="/service" class="px-3 py-2 rounded-xl hover:bg-silver-100/70 relative {{ request()->is('service') ? 'active' : '' }}"><span>Services</span><span class="u absolute left-3 -bottom-0.5"></span></a>
        <a href="/product" class="px-3 py-2 rounded-xl hover:bg-silver-100/70 relative {{ request()->is('product') ? 'active' : '' }}"><span>Produk</span><span class="u absolute left-3 -bottom-0.5"></span></a>
        <a href="/blog" class="px-3 py-2 rounded-xl hover:bg-silver-100/70 relative {{ request()->is('blog') ? 'active' : '' }}"><span>Blog</span><span class="u absolute left-3 -bottom-0.5"></span></a>
        <a href="/contact" class="px-3 py-2 rounded-xl hover:bg-silver-100/70 relative {{ request()->is('contact') ? 'active' : '' }}"><span>Kontak</span><span class="u absolute left-3 -bottom-0.5"></span></a>
      </nav>
      <div class="flex items-center gap-2">
        <a href="https://wa.wizard.id/fd9164" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-silver-900 text-white hover:shadow-neo"><i data-lucide="sparkles"></i> Konsultasi</a>
        <button id="menuBtn" class="md:hidden p-2 rounded-lg hover:bg-silver-100" aria-label="Buka menu"><i data-lucide="menu"></i></button>
      </div>
    </div>
    <div id="mobileMenu" class="md:hidden hidden border-t bg-white/80 backdrop-blur-xl">
      <div class="max-w-7xl mx-auto px-4 py-3 flex flex-col gap-2 text-sm">
        <a href="/" class="px-3 py-2 rounded-lg hover:bg-silver-100">Beranda</a>
        <a href="/about" class="px-3 py-2 rounded-lg hover:bg-silver-100">Tentang</a>
        <a href="/service" class="px-3 py-2 rounded-lg hover:bg-silver-100">Services</a>
        <a href="/product" class="px-3 py-2 rounded-lg hover:bg-silver-100">Produk</a>
        <a href="/blog" class="px-3 py-2 rounded-lg hover:bg-silver-100">Blog</a>
        <a href="/contact" class="px-3 py-2 rounded-lg hover:bg-silver-100">Kontak</a>
      </div>
    </div>
  </header>

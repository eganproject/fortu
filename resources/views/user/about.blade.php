      @extends('layouts.user.main')

      @section('title', 'About Us - Fortu Digital Teknologi')
      <!-- Hero Section -->
      @section('cssOnPage')
          <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
      @endsection
      @section('content')

          <section class="relative overflow-hidden py-24 lg:py-32">
              <div class="absolute inset-0 metal noise"></div>
              <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
                  <div class="reveal">
                      <span
                          class="inline-flex items-center gap-2 text-xs tracking-wide uppercase text-silver-700 bg-white/70 rounded-full px-3 py-1 g-border">
                          <i data-lucide="gem" class="w-4 h-4 text-accent-600"></i>
                          Elevate Your Vision
                      </span>
                      <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl tracking-tight mt-4">
                          {{ $hero?->title }}
                      </h1>
                      <p class="mt-5 text-lg text-silver-700 max-w-xl">
                          {!! $hero?->text !!}
                      </p>
                      <div class="mt-8 flex items-center gap-3">
                          <a href="#tentang"
                              class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-silver-900 text-white hover:shadow-neo transition-shadow">
                              <i data-lucide="arrow-down-circle"></i>
                              Jelajahi Lebih Lanjut
                          </a>
                      </div>
                  </div>
                  <!-- PERUBAHAN: Elemen visual diganti dengan gambar -->
                  <div class="relative hidden lg:block reveal" style="--reveal-delay: 0.2s;">
                      <div class="relative w-full max-w-md mx-auto group">
                          <div
                              class="absolute -inset-4 bg-gradient-to-tr from-accent-600/20 via-white/20 to-accent-400/20 blur-2xl rounded-[2.5rem] transform rotate-3 transition-transform duration-500 group-hover:rotate-0">
                          </div>
                          <div
                              class="relative h-[450px] rounded-3xl metal-dark border border-white/70 shadow-ring overflow-hidden sheen transform rotate-3 transition-transform duration-500 group-hover:rotate-0 group-hover:scale-105">
                              <img src=""
                                  alt="Tim FORTU di ruang kerja modern" class="w-full h-full object-cover">
                              <div class="absolute inset-0 bg-gradient-to-t from-silver-900/20 to-transparent"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>


          <section id="tentang" class="relative py-20">
              <div
                  class="absolute inset-0 pointer-events-none bg-gradient-to-b from-transparent via-silver-100/70 to-transparent">
              </div>
              <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-5 gap-10 items-center">
                  <div class="lg:col-span-2 reveal">
                      <h2 class="font-display text-3xl sm:text-4xl">Tentang <span
                              class="bg-clip-text text-transparent bg-gradient-to-r from-silver-900 to-silver-700 u-accent">FORTU</span>
                      </h2>
                      <p class="mt-4 text-silver-700">{!! $about?->text !!}</p>
                      <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                          <div class="p-4 rounded-2xl border bg-white hover:shadow-neo transition">
                              <div class="flex items-center gap-2 font-medium"><i data-lucide="trophy"></i>Premium Build
                              </div>
                              <p class="mt-2 text-silver-700">Material dan finishing berkelas.</p>
                          </div>
                          <div class="p-4 rounded-2xl border bg-white hover:shadow-neo transition">
                              <div class="flex items-center gap-2 font-medium"><i data-lucide="wand-2"></i>Easy Ops</div>
                              <p class="mt-2 text-silver-700">CMS intuitif & scheduler.</p>
                          </div>
                          <div class="p-4 rounded-2xl border bg-white hover:shadow-neo transition">
                              <div class="flex items-center gap-2 font-medium"><i data-lucide="layers"></i>Fleksibel</div>
                              <p class="mt-2 text-silver-700">Ukuran & orientasi variatif.</p>
                          </div>
                          <div class="p-4 rounded-2xl border bg-white hover:shadow-neo transition">
                              <div class="flex items-center gap-2 font-medium"><i data-lucide="line-chart"></i>Terukur</div>
                              <p class="mt-2 text-silver-700">Analytics & PoP.</p>
                          </div>
                      </div>
                  </div>
                  <div class="lg:col-span-3 reveal" style="--reveal-delay: 0.15s;">
                      <div class="metal-dark rounded-3xl border border-white/70 p-6 lg:p-8 sheen">
                          <dl class="grid sm:grid-cols-2 gap-6">
                              <div>
                                  <dt class="text-sm text-silver-700">Klien Aktif</dt>
                                  <dd class="text-3xl font-display counter" data-target="250">0</dd>
                              </div>
                              <div>
                                  <dt class="text-sm text-silver-700">Perangkat Terpasang</dt>
                                  <dd class="text-3xl font-display counter" data-target="1200">0</dd>
                              </div>
                              <div>
                                  <dt class="text-sm text-silver-700">SLA Uptime</dt>
                                  <dd class="text-3xl font-display">99.5%</dd>
                              </div>
                              <div>
                                  <dt class="text-sm text-silver-700">Retensi</dt>
                                  <dd class="text-3xl font-display">92%</dd>
                              </div>
                          </dl>
                      </div>
                  </div>
              </div>
          </section>
      @endsection

      @push('jsOnPage')
          <script>
              lucide.createIcons();

              // Mobile menu toggle
              const menuBtn = document.getElementById('menuBtn');
              const mobileMenu = document.getElementById('mobileMenu');
              menuBtn?.addEventListener('click', () => {
                  mobileMenu.classList.toggle('hidden');
                  const isOpen = !mobileMenu.classList.contains('hidden');
                  menuBtn.innerHTML = isOpen ? '<i data-lucide="x"></i>' : '<i data-lucide="menu"></i>';
                  lucide.createIcons();
              });

              // Reveal on scroll
              const observer = new IntersectionObserver((entries) => {
                  entries.forEach(entry => {
                      if (entry.isIntersecting) {
                          entry.target.classList.add('in');
                          observer.unobserve(entry.target);
                      }
                  });
              }, {
                  threshold: 0.1
              });
              document.querySelectorAll('.reveal').forEach(el => observer.observe(el));


              // Year
              document.getElementById('year').textContent = new Date().getFullYear();

              // Page-specific script for counters
              const counters = document.querySelectorAll('.counter');
              const animateCounter = (el) => {
                  const target = +el.dataset.target;
                  let current = 0;
                  const step = Math.ceil(target / 60);
                  const inc = () => {
                      current += step;
                      if (current > target) current = target;
                      el.textContent = current.toLocaleString('id-ID');
                      if (current < target) requestAnimationFrame(inc);
                  };
                  inc();
              };
              counters.forEach(el => {
                  const io = new IntersectionObserver(([e]) => {
                      if (e.isIntersecting) {
                          animateCounter(el);
                          io.disconnect();
                      }
                  }, {
                      threshold: 0.6
                  });
                  io.observe(el);
              });
          </script>
      @endpush

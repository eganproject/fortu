{{-- Menggunakan layout utama --}}
@extends('layouts.user.main')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Beranda - Fortu Digital')

{{-- Mendefinisikan konten untuk bagian 'content' di layout utama --}}
@section('content')
    <!-- Modify Hero Section -->
    <section id="beranda" class="relative">
        <div class="absolute inset-0 metal noise"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-24 lg:py-28 grid lg:grid-cols-2 gap-8 lg:gap-10 items-center">
            <div class="reveal text-center lg:text-left">
                <p class="inline-flex items-center gap-2 text-[10px] sm:text-xs tracking-wide uppercase text-silver-700 bg-white/70 rounded-full px-3 py-1 g-border">
                    <i data-lucide="cpu" class="w-3 h-3 sm:w-4 sm:h-4"></i> FORTU • Elevate Your Vision
                </p>
                <h1 class="font-display text-3xl sm:text-5xl lg:text-6xl leading-[1.15] sm:leading-[1.05] mt-4">
                    Komunikasi Visual <span class="bg-clip-text text-transparent bg-gradient-to-r from-silver-900 to-silver-700">Kelas Premium</span>
                </h1>
                <p class="mt-4 sm:mt-5 text-silver-700 text-base sm:text-lg max-w-2xl mx-auto lg:mx-0">
                    FORTU merancang ekosistem digital signage yang memadukan perangkat mewah, software intuitif, dan layanan terkelola — untuk hasil yang rapi, cepat, dan berdampak.
                </p>
                <div class="mt-6 sm:mt-8 flex flex-wrap justify-center lg:justify-start gap-3">
                    <a href="/product" class="magnet w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-silver-900 text-white hover:shadow-neo">
                        <i data-lucide="monitor-smartphone"></i> Lihat Produk
                    </a>
                    <a href="/service" class="magnet w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-silver-300 hover:bg-white">
                        <i data-lucide="wand-2"></i> Layanan End-to-End
                    </a>
                </div>
                <div class="mt-8 sm:mt-10 flex flex-wrap justify-center lg:justify-start gap-4 sm:gap-6 text-xs sm:text-sm text-silver-700">
                    <div class="flex items-center gap-2"><i data-lucide="shield-check"></i> Garansi Resmi</div>
                    <div class="flex items-center gap-2"><i data-lucide="rocket"></i> Installasi Cepat</div>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="reveal lg:justify-self-end mt-8 lg:mt-0" style="--reveal-delay: 0.15s;">
                <div class="relative w-full max-w-sm sm:max-w-xl mx-auto group">
                    <div class="absolute -inset-6 bg-gradient-to-tr from-accent-600/30 via-white/30 to-accent-400/30 blur-2xl rounded-[2rem] transform rotate-3 transition-transform duration-500 group-hover:rotate-0">
                    </div>
                    <div class="relative h-[300px] sm:h-[460px] rounded-3xl metal-dark border border-white/70 shadow-ring overflow-hidden sheen transform rotate-3 transition-transform duration-500 group-hover:rotate-0 group-hover:scale-105">
                        <img src="{{ $hero ? asset('public/storage/' . $hero->image_1) : 'https://placehold.co/800x600/e0e0e0/333?text=Fortu+Display' }}"
                            alt="Digital signage FORTU — Totem 55" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modify Gallery Section -->
    <section id="gallery" class="py-12 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center max-w-3xl mx-auto px-4 sm:px-0">
                <h2 class="font-display text-2xl sm:text-3xl md:text-4xl">Galeri <span class="u-accent">Implementasi</span></h2>
                <p class="mt-3 sm:mt-4 text-sm sm:text-base text-silver-700">
                    Lihat bagaimana solusi kami mentransformasi berbagai ruang menjadi media komunikasi yang dinamis dan modern.
                </p>
            </div>
        </div>
        <div class="reveal mt-12 relative max-w-5xl mx-auto">
            <div class="relative overflow-hidden rounded-3xl metal-dark border border-white/70 shadow-ring">
                <div id="gallery-track" class="flex transition-transform duration-500 ease-in-out">
                    <!-- Slides will be injected here by JS -->
                </div>
            </div>
            <button id="gallery-prev"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-10 p-3 rounded-full bg-white/70 hover:bg-white g-border backdrop-blur-md transition hover:shadow-neo disabled:opacity-50 disabled:cursor-not-allowed"><i
                    data-lucide="chevron-left"></i></button>
            <button id="gallery-next"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-10 p-3 rounded-full bg-white/70 hover:bg-white g-border backdrop-blur-md transition hover:shadow-neo disabled:opacity-50 disabled:cursor-not-allowed"><i
                    data-lucide="chevron-right"></i></button>
            <div id="gallery-dots" class="flex justify-center gap-2 mt-6">
                <!-- Dots will be injected here by JS -->
            </div>
        </div>
    </section>

    <!-- Modify Journey Section -->
    <section id="journey" class="py-12 sm:py-20 bg-gradient-to-b from-silver-50 to-silver-100/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="reveal text-center max-w-3xl mx-auto px-4 sm:px-0">
                <h2 class="font-display text-2xl sm:text-3xl md:text-4xl">Tahap <span class="u-accent">Pembelian</span></h2>
                <p class="mt-3 sm:mt-4 text-sm sm:text-base text-silver-700">
                    Dari ide hingga implementasi, kami memastikan setiap langkah berjalan mulus, transparan, dan sesuai jadwal.
                </p>
            </div>
            <div class="journey-container relative mt-12 sm:mt-20 max-w-5xl mx-auto">
                <!-- SVG Connectors for Desktop -->
                <svg aria-hidden="true" class="absolute inset-0 w-full h-full hidden md:block" width="944" height="544"
                    viewBox="0 0 944 544" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="connector-path"
                        d="M40 88C40 88 214 88 284 88C354 88 432 88 432 178C432 268 432 366 432 366" stroke="#9BDCFB"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path class="connector-path delay-1"
                        d="M894 178C894 178 720 178 650 178C580 178 502 178 502 268C502 358 502 456 502 456"
                        stroke="#9BDCFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path class="connector-path delay-2" d="M40 456C40 456 214 456 284 456C354 456 432 456 432 366"
                        stroke="#9BDCFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="relative grid md:grid-cols-2 gap-x-16 gap-y-20">
                    <div class="reveal relative md:ml-auto md:max-w-sm">
                        <div
                            class="relative p-6 rounded-2xl glass g-border hover:shadow-neo transition-shadow duration-300">
                            <div
                                class="absolute -top-5 -left-5 h-14 w-14 rounded-xl metal flex items-center justify-center text-silver-800">
                                <i data-lucide="search"></i></div>
                            <p class="absolute top-4 right-5 font-display text-5xl text-silver-200/90">01</p>
                            <h3 class="font-medium text-lg mt-10">Konsultasi</h3>
                            <p class="text-sm text-silver-700 mt-2">Memahami kebutuhan advertising.</p>
                        </div>
                    </div>
                    <div></div>
                    <div></div>
                    <div class="reveal relative md:max-w-sm" style="--reveal-delay: 0.15s;">
                        <div
                            class="relative p-6 rounded-2xl glass g-border hover:shadow-neo transition-shadow duration-300">
                            <div
                                class="absolute -top-5 -left-5 h-14 w-14 rounded-xl metal flex items-center justify-center text-silver-800">
                                <i data-lucide="palette"></i></div>
                            <p class="absolute top-4 right-5 font-display text-5xl text-silver-200/90">02</p>
                            <h3 class="font-medium text-lg mt-10">Penyesuaian produk</h3>
                            <p class="text-sm text-silver-700 mt-2">Menganalisis kecocokan produk dengan kebutuhan advertising.</p>
                        </div>
                    </div>
                    <div class="reveal relative md:ml-auto md:max-w-sm" style="--reveal-delay: 0.3s;">
                        <div
                            class="relative p-6 rounded-2xl glass g-border hover:shadow-neo transition-shadow duration-300">
                            <div
                                class="absolute -top-5 -left-5 h-14 w-14 rounded-xl metal flex items-center justify-center text-silver-800">
                                <i data-lucide="hard-hat"></i></div>
                            <p class="absolute top-4 right-5 font-display text-5xl text-silver-200/90">03</p>
                            <h3 class="font-medium text-lg mt-10">Instalasi</h3>
                            <p class="text-sm text-silver-700 mt-2">instalasi oleh tim profesional.</p>
                        </div>
                    </div>
                    <div></div>
                    <div></div>
                    <div class="reveal relative md:max-w-sm" style="--reveal-delay: 0.45s;">
                        <div
                            class="relative p-6 rounded-2xl glass g-border hover:shadow-neo transition-shadow duration-300">
                            <div
                                class="absolute -top-5 -left-5 h-14 w-14 rounded-xl metal flex items-center justify-center text-silver-800">
                                <i data-lucide="lifeline"></i></div>
                            <p class="absolute top-4 right-5 font-display text-5xl text-silver-200/90">04</p>
                            <h3 class="font-medium text-lg mt-10">Dukungan & Supporting </h3>
                            <p class="text-sm text-silver-700 mt-2">Dukungan teknis dan monitoring.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modify Video Section -->
    <section id="intro" class="py-12 sm:py-20 bg-gradient-to-b from-silver-50 to-silver-100/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-5 gap-6 sm:gap-10 items-center">
            <div class="lg:col-span-2 text-center lg:text-left">
                <h2 class="font-display text-2xl sm:text-3xl md:text-4xl">Video <span class="u-accent">Introduction</span></h2>
                <p class="mt-3 sm:mt-4 text-sm sm:text-base text-silver-700">
                    Gambaran cepat ekosistem FORTU: perangkat, software, dan layanan—ringkas & berdampak.
                </p>
                <div class="mt-4 sm:mt-6 flex items-center justify-center lg:justify-start gap-4 text-xs sm:text-sm text-silver-700">
                    <div class="flex items-center gap-2"><i data-lucide="play-circle"></i> 90 detik</div>
                    <div class="flex items-center gap-2"><i data-lucide="sparkles"></i> Overview</div>
                </div>
            </div>
            <div class="lg:col-span-3">
                <div class="relative w-full overflow-hidden rounded-2xl shadow-lg" style="padding-top: 56.25%;">
                    <iframe class="absolute inset-0 w-full h-full"
                        src="https://www.youtube-nocookie.com/embed/{{ getYoutubeUrl() ?? 'bGsjD8IGE48' }}?rel=0&modestbranding=1&controls=1&playsinline=1&autoplay=1&mute=1"
                        title="FORTU Introduction" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('jsOnPage')
 
  <script>
    // Lucide
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
    const observer = new IntersectionObserver((entries, observerInstance) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          if (entry.target.classList.contains('journey-container')) {
            entry.target.querySelectorAll('.connector-path').forEach(path => {
              const length = path.getTotalLength();
              path.style.strokeDasharray = length;
              path.style.strokeDashoffset = length;
            });
          }
          observerInstance.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    
    document.querySelectorAll('.reveal, .journey-container').forEach(el => observer.observe(el));

    // Magnetic hover
    document.querySelectorAll('.magnet').forEach(btn=>{
      btn.addEventListener('mousemove', (e)=>{
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width/2;
        const y = e.clientY - rect.top - rect.height/2;
        btn.style.transform = `translate(${x*0.05}px, ${y*0.05}px)`;
      });
      btn.addEventListener('mouseleave', ()=>{ btn.style.transform = 'translate(0,0)'; });
    });


    // Year
    document.getElementById('year').textContent = new Date().getFullYear();

    // Scrollspy
    // const sections = ['beranda','gallery','journey','intro'];
    // const nav = document.getElementById('spy');
    // const spyObs = new IntersectionObserver((entries)=>{
    //   entries.forEach(({isIntersecting, target})=>{
    //     if(isIntersecting){
    //       const id = target.id;
    //       nav.querySelectorAll('a').forEach(a=>{ a.removeAttribute('aria-current'); a.querySelector('.u').style.width='0'; });
    //       const active = nav.querySelector(`a[href="#${id}"]`);
    //       if(active){ active.setAttribute('aria-current','true'); active.querySelector('.u').style.width='60%'; }
    //     }
    //   });
    // },{ rootMargin: '-40% 0px -55% 0px', threshold: 0 });
    // sections.forEach(id=>{ const sec = document.getElementById(id); if(sec) spyObs.observe(sec); });

    // Gallery Carousel Logic
    document.addEventListener('DOMContentLoaded', () => {
      const galleryTrack = document.getElementById('gallery-track');
      if (galleryTrack) {
        const images = @json($carousel); // Data dari controller
        const dotsContainer = document.getElementById('gallery-dots');
        let currentIndex = 0;

        images.forEach((item, index) => {
          const slide = document.createElement('div');
          slide.className = "flex-shrink-0 w-full";
          slide.innerHTML = `
            <div class="aspect-[16/9]">
              <img 
                src="${item.images ? '{{ asset('public/storage') }}/' + item.images : 'https://placehold.co/800x500/dfe6ef/4f5862?text=No+Image'}" 
                class="w-full h-full object-cover">
            </div>`;
          galleryTrack.appendChild(slide);

          const dot = document.createElement('button');
          dot.className = "h-2 w-6 rounded-full transition-colors duration-300";
          dot.addEventListener('click', () => goToSlide(index));
          dotsContainer.appendChild(dot);
        });

        const prevBtn = document.getElementById('gallery-prev');
        const nextBtn = document.getElementById('gallery-next');
        const dots = dotsContainer.children;

        function updateUI() {
          galleryTrack.style.transform = `translateX(-${currentIndex * 100}%)`;
          Array.from(dots).forEach((dot, index) => {
            dot.className = "h-2 w-6 rounded-full transition-colors duration-300 " + 
              (index === currentIndex ? 'bg-silver-800' : 'bg-silver-300 hover:bg-silver-400');
          });
          prevBtn.disabled = currentIndex === 0;
          nextBtn.disabled = currentIndex === images.length - 1;
        }

        function goToSlide(index) {
          currentIndex = index;
          updateUI();
        }

        prevBtn.addEventListener('click', () => {
          if (currentIndex > 0) goToSlide(currentIndex - 1);
        });
        nextBtn.addEventListener('click', () => {
          if (currentIndex < images.length - 1) goToSlide(currentIndex + 1);
        });

        updateUI();
      }
    });
  </script>
@endpush

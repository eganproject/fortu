        @extends('layouts.user.main')
        @section('title', 'Product - Fortu Digital Teknologi')

        @push('cssOnPage')
            <style>
                .card-glow {
                    position: relative;
                    overflow: hidden;
                }

                .card-glow::before {
                    content: '';
                    position: absolute;
                    top: -50%;
                    left: -50%;
                    width: 200%;
                    height: 200%;
                    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
                    transform: rotate(15deg);
                    transition: transform 0.5s;
                }

                .card-glow:hover::before {
                    transform: rotate(30deg) scale(1.1);
                }

                /* CSS untuk Animasi Scroll pada Ikon */
                .scroll-animate-icon .icon-circle {
                    opacity: 0;
                    /* Atur transisi untuk semua properti transform dan opacity */
                    transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.4s ease-out;
                }

                /* Posisi Awal Lingkaran (sebelum terlihat) */
                .scroll-animate-icon .icon-circle-1 {
                    transform: translateX(-25px) scale(0.5);
                    transition-delay: 0s;
                }

                .scroll-animate-icon .icon-circle-2 {
                    transform: translateX(-25px) scale(0.5);
                    transition-delay: 0.1s;
                }

                .scroll-animate-icon .icon-circle-3 {
                    transform: translateX(-25px) scale(0.5);
                    transition-delay: 0.2s;
                }

                /* Posisi Akhir Lingkaran (setelah terlihat) */
                .scroll-animate-icon.is-visible .icon-circle {
                    opacity: 1;
                    transform: translateX(0) scale(1);
                }


                /* PERUBAHAN: CSS untuk animasi klik */
                #image-swap-container.swapped #image1 {
                    transform: translateX(25%) translateY(-20%) scale(0.8) rotate(5deg);
                    z-index: 10;
                }

                #image-swap-container.swapped #image2 {
                    transform: translateX(-25%) translateY(20%) scale(1);
                    z-index: 20;
                }
            </style>
        @endpush

        @section('content')
            <!-- Hero Section -->
            <section class="relative overflow-hidden py-24 lg:py-32">
                <div class="absolute inset-0 metal noise"></div>
                <div class="absolute -bottom-1/3 -left-16 w-96 h-96 bg-accent-400/30 rounded-full blur-3xl"></div>
                <div class="absolute -top-1/4 -right-16 w-96 h-96 bg-accent-500/30 rounded-full blur-3xl"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
                    <div class="reveal">
                        <span
                            class="inline-flex items-center gap-2 text-xs tracking-wide uppercase text-silver-700 bg-white/70 rounded-full px-3 py-1 g-border">
                            <i data-lucide="cpu" class="w-4 h-4 text-accent-600"></i>
                            Koleksi Produk
                        </span>
                        <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl tracking-tight mt-4">
                            {{ $hero->title }}
                        </h1>
                        <p class="mt-5 text-lg text-silver-700 max-w-xl">
                            {!! $hero->text !!}
                        </p>
                        <div class="mt-8 flex items-center gap-3">
                            <a href="#"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-silver-900 text-white hover:shadow-neo transition-shadow">
                                <i data-lucide="arrow-down-circle"></i>
                                Lihat Semua Produk
                            </a>
                        </div>
                    </div>

                    <div class="relative h-96 hidden lg:flex items-center justify-center reveal"
                        style="--reveal-delay: 0.2s;">
                        <!-- PERUBAHAN: Menghilangkan 'group' dan menambahkan ID -->
                        <div id="image-swap-container" class="w-full max-w-xl h-full relative">
                            <!-- Gambar 1 (Awalnya di depan) -->
                            <div id="image1"
                                class="absolute inset-0 w-full h-full transition-all duration-700 ease-in-out z-20">
                                <div
                                    class="w-[80%] h-[70%] absolute bottom-0 left-0 rounded-3xl metal-dark border border-white/70 shadow-ring overflow-hidden">
                                    <img src="{{ $hero ? asset('public/storage/' . $hero->image_1) : 'https://placehold.co/600x400/eef2f7/4f5862?text=Smartboard' }}"
                                        class="w-full h-full object-cover" alt="Produk Smartboard" />
                                </div>
                            </div>
                            <!-- Gambar 2 (Awalnya di belakang) -->
                            <div id="image2"
                                class="absolute inset-0 w-full h-full transition-all duration-700 ease-in-out z-10">
                                <div
                                    class="w-[80%] h-[70%] absolute top-0 right-0 rounded-3xl metal-dark border border-white/70 shadow-ring overflow-hidden">
                                    <img src="{{ $hero ? asset('public/storage/' . $hero->image_2) : 'https://placehold.co/600x400/eef2f7/4f5862?text=Smartboard' }}"
                                        class="w-full h-full object-cover" alt="Produk Videowall" />
                                </div>
                            </div>
                        </div>
                        <!-- PERUBAHAN: Menambahkan Tombol Swap -->
                        <button id="swap-btn" aria-label="Tukar Tampilan Produk"
                            class="absolute bottom-4 right-4 z-30 p-3 rounded-full bg-white/70 hover:bg-white g-border backdrop-blur-md transition hover:shadow-neo">
                            <i data-lucide="refresh-cw" class="w-5 h-5 text-silver-800"></i>
                        </button>
                    </div>
                </div>
            </section>
            @forelse ($kategoriProduk as $kat)
                <section class="py-12">
                    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                        <div class="flex items-center mb-8 scroll-animate-icon">
                            <div class="flex items-center mr-3">
                                <div class="w-7 h-7 rounded-full bg-slate-400 icon-circle icon-circle-1"></div>
                                <div class="w-7 h-7 rounded-full bg-slate-300 -ml-2 icon-circle icon-circle-2"></div>
                                <div class="w-7 h-7 rounded-full bg-slate-500 -ml-2 icon-circle icon-circle-3"></div>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $kat->nama_kategori }}</h2>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-{{ $kat->layout }} gap-8">
                            @forelse ($kat->produk as $prod)
                                <div class="metal rounded-3xl shadow-xl p-5 flex flex-col sm:flex-row items-center space-y-5 sm:space-y-0 sm:space-x-5 sm:h-[420px] reveal"
                                    style="--reveal-delay: 0.2s">

                                    <div class="w-full h-64 sm:h-full {{ $kat->layout == 2 ? 'sm:w-8/12' : 'sm:w-7/12' }}">
                                        <img src="{{ asset('public/storage/' . $prod->thumbnail) }}" alt="Fortu Smart Board"
                                            class="w-full h-full object-cover drop-shadow-lg">
                                    </div>

                                    <div
                                        class="w-full {{ $kat->layout == 2 ? 'sm:w-4/12' : 'sm:w-5/12' }} flex flex-col h-full">
                                        <div class="flex-grow">
                                            <h3 class="text-xl font-bold text-gray-800 mb-3">
                                                {{ $prod->nama }}
                                            </h3>
                                            <div class="space-y-3">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-500 mb-1">Device Inch</p>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach ($prod->scopeDeviceInch($prod->id) as $spek)
                                                            <span
                                                                class="bg-gray-800 text-white text-xs font-bold px-3 py-1 rounded-lg">{{ $spek->spesifikasi }}</span>
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-500 mb-1">Screen Type</p>
                                                    @forelse ($prod->scopeScreenType($prod->id) as $spek)
                                                        <span
                                                            class="{{ $spek->spesifikasi == 'Touch Screen' ? 'bg-blue-500' : 'bg-red-500' }}  text-white text-sm font-semibold px-3 py-1.5 rounded-lg">{{ $spek->spesifikasi }}</span>
                                                    @empty
                                                        <span
                                                            class="bg-gray-800 text-white text-sm font-semibold px-3 py-1.5 rounded-lg">-</span>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-3">
                                            <a href="/product/{{ $prod->slug }}"
                                                class="bg-transparent text-black text-xs font-semibold px-2.5 py-1.5 rounded-lg border border-black hover:bg-black hover:text-white transition-all duration-200 shadow-sm">
                                                Selengkapnya >
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="col-span-1 lg:col-span-2 bg-gray-200 rounded-3xl shadow-xl p-5 flex flex-col items-center">
                                    <div class="text-center">
                                        <h3 class="text-xl font-bold text-gray-800 mb-3">Belum ada produk</h3>
                                        <p class="text-sm font-medium text-gray-500">Mohon maaf, saat ini belum ada produk
                                            yang
                                            terdaftar di kategori ini.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            @empty
                <section class="py-12">
                    <div class="container mx-auto px-4">
                        <div class="bg-gray-200 rounded-3xl shadow-xl p-5 flex flex-col items-center">
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Belum ada kategori</h3>
                                <p class="text-sm font-medium text-gray-500">Mohon maaf, saat ini belum ada kategori yang
                                    terdaftar.</p>
                            </div>
                        </div>
                    </div>
                </section>
            @endforelse

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


                const animatedElements = document.querySelectorAll('.scroll-animate-icon');

                if (animatedElements.length > 0) {
                    const observer = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-visible');
                                // Hentikan pengamatan setelah animasi berjalan sekali
                                observer.unobserve(entry.target);
                            }
                        });
                    }, {
                        // Atur threshold ke 0.1, artinya animasi akan berjalan
                        // saat 10% dari elemen terlihat
                        threshold: 0.1
                    });

                    animatedElements.forEach(el => {
                        observer.observe(el);
                    });
                }




                // PERUBAHAN: JavaScript untuk animasi klik
                const swapBtn = document.getElementById('swap-btn');
                const imageContainer = document.getElementById('image-swap-container');

                if (swapBtn && imageContainer) {
                    swapBtn.addEventListener('click', () => {
                        imageContainer.classList.toggle('swapped');
                    });
                }
            </script>
        @endpush

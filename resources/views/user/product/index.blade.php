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
            </style>
        @endpush

        @section('content')
            <!-- Hero Section -->
            <section class="h-[60vh] md:h-[90vh] metal">
                <img src="{{ $hero ? asset('public/storage/' . $hero->image_1) : 'https://placehold.co/1200x600/94a3b8/080808?text=Hero+Image' }}"
                    alt="Main Hero" class="w-full h-full object-cover">
            </section>

            @forelse ($kategoriProduk as $kat)
                <section class="py-12">
                    <div class="container mx-auto px-4">
                        <div class="flex items-center mb-8 scroll-animate-icon">
                            <div class="flex items-center mr-3">
                                <div class="w-7 h-7 rounded-full bg-gray-400 icon-circle icon-circle-1"></div>
                                <div class="w-7 h-7 rounded-full bg-gray-500 -ml-2 icon-circle icon-circle-2"></div>
                                <div class="w-7 h-7 rounded-full bg-gray-600 -ml-2 icon-circle icon-circle-3"></div>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $kat->nama_kategori }}</h2>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-{{ $kat->layout }} gap-8">
                            @forelse ($kat->produk as $prod)
                                <div
                                    class="metal rounded-3xl shadow-xl p-5 flex flex-col sm:flex-row items-center space-y-5 sm:space-y-0 sm:space-x-5 sm:h-[420px]">

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
                                                class="bg-transparent text-black text-sm font-semibold px-4 py-2 rounded-lg border border-black hover:bg-black hover:text-white transition-all duration-200 shadow-sm">
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
            </script>
        @endpush

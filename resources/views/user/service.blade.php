        @extends('layouts.user.main')

        @section('title', 'Service - Fortu Digital Teknologi')

        @section('content')
            <!-- Hero Section -->
            <section id="beranda" class="relative">
                <div class="absolute inset-0 metal noise"></div>
                <div
                    class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-28 grid lg:grid-cols-2 gap-10 items-center">
                    <div class="reveal">
                        <p
                            class="inline-flex items-center gap-2 text-xs tracking-wide uppercase text-silver-700 bg-white/70 rounded-full px-3 py-1 g-border">
                            <i data-lucide="cpu"></i> Digital Signage OS • Proof-of-Play • Scheduler
                        </p>
                        <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl leading-[1.05] mt-4"><span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-silver-900 to-silver-700">{{ $hero ? $hero->title : '' }}</span>
                        </h1>
                        <p class="mt-5 text-silver-700 text-lg max-w-2xl">{!! $hero ? $hero->text : '' !!}
                        </p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="/product"
                                class="magnet inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-silver-900 text-white hover:shadow-neo"><i
                                    data-lucide="monitor-smartphone"></i> Lihat Produk</a>
                            {{-- <a href="/service"
                                class="magnet inline-flex items-center gap-2 px-5 py-3 rounded-xl border border-silver-300 hover:bg-white"><i
                                    data-lucide="wand-2"></i> Layanan End-to-End</a> --}}
                        </div>

                    </div>
                    <div class="reveal lg:justify-self-end" style="--reveal-delay: 0.15s;">
                        <div class="relative w-full max-w-xl mx-auto group">
                            <div
                                class="absolute -inset-6 bg-gradient-to-tr from-accent-600/30 via-white/30 to-accent-400/30 blur-2xl rounded-[2rem] transform rotate-3 transition-transform duration-500 group-hover:rotate-0">
                            </div>
                            <div
                                class="relative h-[460px] rounded-3xl metal-dark border border-white/70 shadow-ring overflow-hidden sheen transform rotate-3 transition-transform duration-500 group-hover:rotate-0 group-hover:scale-105">
                                <img src="{{ $hero ? asset('public/storage/' . $hero->image_1) : 'https://placehold.co/800x600/e0e0e0/333?text=Fortu+Display' }}"
                                    alt="Digital signage FORTU — Totem 55”" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="services" class="py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="reveal text-center max-w-3xl mx-auto">
                        <h2 class="font-display text-3xl sm:text-4xl">Layanan <span class="u-accent">End-to-End</span></h2>
                        <p class="mt-4 text-silver-700">Kami menyediakan ekosistem lengkap yang dirancang untuk beroperasi
                            secara sinergis, memberikan hasil yang mulus dan berdampak.</p>
                    </div>
                    <div class="mt-20 space-y-20">

                        <!-- Service Block 1 -->
                        @foreach ($services as $item)
                            <div class="group grid md:grid-cols-2 gap-10 items-center">
                                <div class="reveal relative {{ $loop->even ? 'md:order-last' : '' }}"
                                    {{ $loop->even ? 'style="--reveal-delay: 0.15s;"' : '' }}>
                                    <div
                                        class="relative h-96 rounded-3xl metal-dark border border-white/70 shadow-ring overflow-hidden sheen">
                                        <img src="{{ asset('public/storage/' . $item->image_2) }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                            alt="Konsultasi dan Strategi">
                                    </div>
                                </div>
                                <div class="reveal relative" style="--reveal-delay: 0.15s;">
                                    <div
                                        class="p-8 rounded-3xl glass g-border transition-all duration-300 group-hover:shadow-neo">
                                        <p class="absolute top-8 right-8 font-display text-8xl text-silver-200/80 -z-10">
                                            0{{ $loop->iteration }}</p>
                                        <div
                                            class="inline-flex items-center gap-2 text-xs tracking-wide uppercase text-silver-700 bg-white/70 rounded-full px-3 py-1">
                                            <i data-lucide="wrench" class="w-4 h-4"></i> {{ $item->title }}
                                        </div>
                                        <h3 class="font-display text-2xl mt-4">{{ $item->subtitle }}</h3>
                                        <p class="text-silver-700 mt-2">{{ $item->description }}</p>
                                        {{-- <a href="#"
                                            class="inline-flex items-center gap-2 text-sm font-medium mt-6 group/link">Selengkapnya
                                            <i data-lucide="arrow-right"
                                                class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </section>



            <!-- Valuable Solution Section -->
            <section class="bg-gray-50 py-16 lg:py-24">
                <div class="container mx-auto px-4 text-center ">
                    <div class="reveal" style="--reveal-delay: 0.15s;">

                        <h2 class="text-3xl font-bold">Our Valuable <span class="u-accent">Solution</span></h2>
                        <p class="text-gray-500 mb-12 mt-4">Solusi Bernilai Kami</p>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 max-w-5xl mx-auto reveal"
                        style="--reveal-delay: 0.15s;">
                        <!-- Icon Box Template -->
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-handshake-icon lucide-handshake w-12 h-12 mx-auto mb-3 text-black">
                                <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                                <path
                                    d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                                <path d="m21 3 1 11h-2" />
                                <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                                <path d="M3 4h8" />
                            </svg>
                            <p class=" text-sm text-black">Product Services</p>
                        </div>
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-cpu-icon lucide-cpu w-12 h-12 mx-auto mb-3 text-black">
                                <path d="M12 20v2" />
                                <path d="M12 2v2" />
                                <path d="M17 20v2" />
                                <path d="M17 2v2" />
                                <path d="M2 12h2" />
                                <path d="M2 17h2" />
                                <path d="M2 7h2" />
                                <path d="M20 12h2" />
                                <path d="M20 17h2" />
                                <path d="M20 7h2" />
                                <path d="M7 20v2" />
                                <path d="M7 2v2" />
                                <rect x="4" y="4" width="16" height="16" rx="2" />
                                <rect x="8" y="8" width="8" height="8" rx="1" />
                            </svg>
                            <p class=" text-sm text-black">Own Software & Hardware Developement</p>
                        </div>
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-infinity-icon lucide-infinity w-12 h-12 mx-auto mb-3 text-black">
                                <path d="M6 16c5 0 7-8 12-8a4 4 0 0 1 0 8c-5 0-7-8-12-8a4 4 0 1 0 0 8" />
                            </svg>
                            <p class=" text-sm text-black">Flexible Developement</p>
                        </div>
                        <div class="metal p-6 rounded-lg">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-tv-minimal-play-icon lucide-tv-minimal-play w-12 h-12 mx-auto mb-3 text-black">
                                <path
                                    d="M10 7.75a.75.75 0 0 1 1.142-.638l3.664 2.249a.75.75 0 0 1 0 1.278l-3.664 2.25a.75.75 0 0 1-1.142-.64z" />
                                <path d="M7 21h10" />
                                <rect width="20" height="14" x="2" y="3" rx="2" />
                            </svg>
                            <p class=" text-sm text-black">Display Technology Solution Indonesian Information</p>
                        </div>
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-circle-check-big-icon lucide-circle-check-big w-12 h-12 mx-auto mb-3 text-black">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                <path d="m9 11 3 3L22 4" />
                            </svg>
                            <p class=" text-sm text-black">Quality Check</p>
                        </div>
                        <div class="metal p-6 rounded-lg">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-git-graph-icon lucide-git-graph w-12 h-12 mx-auto mb-3 text-black">
                                <circle cx="5" cy="6" r="3" />
                                <path d="M5 9v6" />
                                <circle cx="5" cy="18" r="3" />
                                <path d="M12 3v18" />
                                <circle cx="19" cy="6" r="3" />
                                <path d="M16 15.7A9 9 0 0 0 19 9" />
                            </svg>
                            <p class=" text-sm text-black">Commitment to Trends Technology & The Upcoming</p>
                        </div>
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-workflow-icon lucide-workflow w-12 h-12 mx-auto mb-3 text-black">
                                <rect width="8" height="8" x="3" y="3" rx="2" />
                                <path d="M7 11v4a2 2 0 0 0 2 2h4" />
                                <rect width="8" height="8" x="13" y="13" rx="2" />
                            </svg>
                            <p class=" text-sm text-black">System Integration</p>
                        </div>
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-shield-plus-icon lucide-shield-plus w-12 h-12 mx-auto mb-3 text-black">
                                <path
                                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                                <path d="M9 12h6" />
                                <path d="M12 9v6" />
                            </svg>
                            <p class=" text-sm text-black">Professional Based Product</p>
                        </div>
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-user-round-check-icon lucide-user-round-check w-12 h-12 mx-auto mb-3 text-black">
                                <path d="M2 21a8 8 0 0 1 13.292-6" />
                                <circle cx="10" cy="8" r="5" />
                                <path d="m16 19 2 2 4-4" />
                            </svg>
                            <p class=" text-sm text-black">User Friendly</p>
                        </div>
                        <div class="metal p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-shield-check-icon lucide-shield-check w-12 h-12 mx-auto mb-3 text-black">
                                <path
                                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>
                            <p class=" text-sm text-black">After Sales Service</p>
                        </div>
                    </div>
                </div>
            </section>
        @endsection
        <!-- End of content section -->

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
            </script>
        @endpush

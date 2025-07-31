        @extends('layouts.user.main')

        @section('title', 'Service - Fortu Digital Teknologi')

        @section('content')
            <!-- Hero Section -->
            <style>
                .hero-bg {
                    background-image: url('{{ $hero ? asset('storage/' . $hero->image_1) : 'https://placehold.co/1200x600/C7C7C7/080808?text=Hero' }}');
                    background-size: cover;
                    background-position: center;
                }
            </style>
            <section class="relative hero-bg text-white">
                <div class="absolute inset-0 bg-gray-800 bg-opacity-80"></div>
                <div class="relative container mx-auto px-4 py-24 lg:py-32 flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $hero ? $hero->title : '' }}</h1>
                        <p class="text-lg text-white max-w-lg">
                            {!! $hero ? $hero->text : '' !!}
                        </p>
                    </div>
                    <div class="md:w-1/2 flex justify-center mt-10 md:mt-0">
                        <img src="{{ $hero ? asset('storage/' . $hero->image_2) : 'https://placehold.co/450x300/C7C7C7/080808?text=Grafik+Isometric' }}"
                            alt="Isometric Graphic" class="w-full max-w-md opacity-80">
                    </div>
                </div>
            </section>

            <!-- After Sales Service Section -->
            <section class="py-8 lg:py-16">
                <h2 class="text-3xl font-bold text-center">Our Services</h2>
                <p class="text-gray-500 mb-12 text-center">Solusi Berbagai Cara</p>

                <div class="container mx-auto px-4">
                    @foreach ($services as $item)
                        {{-- Kontainer utama dibuat relatif untuk pemosisian absolut anak-anaknya --}}
                        <div class="relative flex items-center min-h-[450px] my-12">

                            {{-- Kontainer Teks dengan Gambar Latar Belakang (Lapisan Bawah) --}}
                            <div
                                class="w-full md:w-2/3 relative rounded-2xl overflow-hidden shadow-2xl z-10 
                            {{-- Mendorong panel teks ke kanan jika loop genap, atau ke kiri jika ganjil --}}
                            {{ $loop->even ? 'ml-auto' : 'mr-auto' }}">

                                {{-- Gambar Latar Belakang --}}
                                <img src="{{ asset('storage/' . $item->image_1) }}"
                                    alt="Latar belakang untuk {{ $item->title }}"
                                    class="absolute inset-0 w-full h-full object-cover">

                                {{-- Lapisan Gelap (Overlay) --}}
                                <div class="absolute inset-0 bg-black bg-opacity-60"></div>

                                {{-- Kontainer untuk memposisikan blok teks --}}
                                <div class="relative p-8 md:p-12 flex h-full items-center">
                                    {{-- Blok teks yang sebenarnya, selalu rata kiri --}}
                                    <div class="w-full {{ $loop->even ? 'md:w-1/2 md:ml-auto' : 'md:w-1/2' }}">
                                        <h2 class="text-3xl lg:text-4xl text-white font-bold mb-2">{{ $item->title }}</h2>
                                        <p class="font-semibold text-gray-200 mb-4">{{ $item->subtitle }}</p>
                                        <p class="text-gray-300 leading-relaxed">
                                            {{ $item->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kontainer Gambar Isometrik (Lapisan Atas/Floating) --}}
                            <div
                                class="hidden md:block absolute inset-y-0 z-20
                            {{-- Posisikan wadah di tepi panel teks (yang dimulai dari 1/3 lebar) --}}
                            {{ $loop->even ? 'left-1/3' : 'right-1/3' }}">
                                <img src="{{ asset('storage/' . $item->image_2) }}"
                                    alt="Ilustrasi untuk {{ $item->title }}"
                                    class="max-w-sm lg:max-w-md xl:max-w-lg transform transition-transform duration-500 hover:scale-105
                                {{-- Geser gambar sebesar setengah lebarnya sendiri untuk menengahkan & menumpuknya di tepi --}}
                                {{ $loop->even ? '-translate-x-1/2' : 'translate-x-1/2' }}">
                            </div>

                        </div>
                    @endforeach
                </div>
            </section>



            <!-- Valuable Solution Section -->
            <section class="bg-gray-50 py-16 lg:py-24">
                <div class="container mx-auto px-4 text-center">
                    <h2 class="text-3xl font-bold">Our Valuable Solution</h2>
                    <p class="text-gray-500 mb-12">Solusi Bernilai Kami</p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 max-w-5xl mx-auto">
                        <!-- Icon Box Template -->
                        <div class="bg-black p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-handshake-icon lucide-handshake w-12 h-12 mx-auto mb-3 text-white">
                                <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                                <path
                                    d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                                <path d="m21 3 1 11h-2" />
                                <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                                <path d="M3 4h8" />
                            </svg>
                            <p class=" text-sm text-white">Product Services</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-cpu-icon lucide-cpu w-12 h-12 mx-auto mb-3 text-white">
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
                            <p class=" text-sm text-white">Own Software & Hardware Developement</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-infinity-icon lucide-infinity w-12 h-12 mx-auto mb-3 text-white">
                                <path d="M6 16c5 0 7-8 12-8a4 4 0 0 1 0 8c-5 0-7-8-12-8a4 4 0 1 0 0 8" />
                            </svg>
                            <p class=" text-sm text-white">Flexible Developement</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-tv-minimal-play-icon lucide-tv-minimal-play w-12 h-12 mx-auto mb-3 text-white">
                                <path
                                    d="M10 7.75a.75.75 0 0 1 1.142-.638l3.664 2.249a.75.75 0 0 1 0 1.278l-3.664 2.25a.75.75 0 0 1-1.142-.64z" />
                                <path d="M7 21h10" />
                                <rect width="20" height="14" x="2" y="3" rx="2" />
                            </svg>
                            <p class=" text-sm text-white">Display Technology Solution Indonesian Information</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-circle-check-big-icon lucide-circle-check-big w-12 h-12 mx-auto mb-3 text-white">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                <path d="m9 11 3 3L22 4" />
                            </svg>
                            <p class=" text-sm text-white">Quality Check</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-git-graph-icon lucide-git-graph w-12 h-12 mx-auto mb-3 text-white">
                                <circle cx="5" cy="6" r="3" />
                                <path d="M5 9v6" />
                                <circle cx="5" cy="18" r="3" />
                                <path d="M12 3v18" />
                                <circle cx="19" cy="6" r="3" />
                                <path d="M16 15.7A9 9 0 0 0 19 9" />
                            </svg>
                            <p class=" text-sm text-white">Commitment to Trends Technology & The Upcoming</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-workflow-icon lucide-workflow w-12 h-12 mx-auto mb-3 text-white">
                                <rect width="8" height="8" x="3" y="3" rx="2" />
                                <path d="M7 11v4a2 2 0 0 0 2 2h4" />
                                <rect width="8" height="8" x="13" y="13" rx="2" />
                            </svg>
                            <p class=" text-sm text-white">System Integration</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-plus-icon lucide-shield-plus w-12 h-12 mx-auto mb-3 text-white"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M9 12h6"/><path d="M12 9v6"/></svg>
                            <p class=" text-sm text-white">Professional Based Product</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-check-icon lucide-user-round-check w-12 h-12 mx-auto mb-3 text-white"><path d="M2 21a8 8 0 0 1 13.292-6"/><circle cx="10" cy="8" r="5"/><path d="m16 19 2 2 4-4"/></svg>
                            <p class=" text-sm text-white">User Friendly</p>
                        </div>
                        <div class="bg-black p-6 rounded-lg">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check w-12 h-12 mx-auto mb-3 text-white"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                            <p class=" text-sm text-white">After Sales Service</p>
                        </div>
                    </div>
                </div>
            </section>
        @endsection
        <!-- End of content section -->

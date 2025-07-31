{{-- Menggunakan layout utama --}}
@extends('layouts.user.main')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Beranda - Fortu Digital')

@push('cssOnPage')
    <style>
        .carousel-container {
            position: relative;
        }

        .carousel-slide {
            display: none;
        }

        .carousel-slide.active {
            display: block;
        }

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
{{-- Mendefinisikan konten untuk bagian 'content' di layout utama --}}
@section('content')

    <section class="h-[60vh] md:h-[90vh] bg-gray-200">
        <img src="{{ $hero ? asset('storage/' . $hero->image_1) : 'https://placehold.co/1200x600/94a3b8/080808?text=Hero+Image' }}"
            alt="Main Hero" class="w-full h-full object-cover">
    </section>

    <section class="py-16 lg:py-24 px-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center mb-8 scroll-animate-icon">
                <div class="flex items-center mr-3">
                    <div class="w-7 h-7 rounded-full bg-gray-400 icon-circle icon-circle-1"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-500 -ml-2 icon-circle icon-circle-2"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-600 -ml-2 icon-circle icon-circle-3"></div>
                </div>
                <h2 class="text-2xl font-bold">Interactive Display Canggih Buatan Anak Bangsa</h2>
            </div>

            <div id="interactive-carousel" class="carousel-container">
                @forelse ($carousel as $item)
                    <div class="carousel-slide {{ $loop->first ? 'active' : '' }}">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $item->images ?? 'https://placehold.co/1200x600/94a3b8/080808?text=Hero+Image') }}"
                                alt="Fortu Video Wall" class="w-full rounded-lg">
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No data available</p>
                @endforelse
                <button
                    class="carousel-prev absolute top-1/2 left-4 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button
                    class="carousel-next absolute top-1/2 right-4 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <section class="bg-stone-500 text-white py-16 px-4">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="md:w-1/4 flex items-start gap-4">
                <div class="bg-white p-2 rounded-md">
                    <svg class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold">-</h2>
                    <p class="text-gray-300">Elevate Your Vision </p>
                    <p class="mt-4 text-sm max-w-md">
                        PT. Fortu Digital Teknologi adalah perusahaan yang sudah besertifikasi TKDN >40% untuk
                        produk-produknya. Kami yakin dengan tingkat komponen dalam negeri yang ada pada produk kami
                        menjadikan produk kami dapat bersaing dengan produk lokal maupun global.
                    </p>
                </div>
            </div>
            <div class="md:w-3/2 flex flex-col items-center justify-center md:items-end">
                <img src="{{ asset('storage/carousel/4.png' ?? 'https://placehold.co/1200x600/94a3b8/080808?text=Hero+Image') }}"
                    alt="Smart Board" class="h-[500px] rounded-lg">
            </div>
        </div>
    </section>

    <section class="py-20 px-4">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 text-center">
                @forelse ($sorotan as $item)
                    <div class="bg-gradient-to-t from-stone-300 to-stone-100 p-6 rounded-2xl h-50px shadow-xl">
                        <p class="text-gray-500 text-sm">{{ $item->title }}</p>
                        <p class="text-5xl font-bold text-gray-800 my-2">{{ $item->subtitle }}</p>
                        <img src="{{ asset('storage/' . $item->images ?? 'https://placehold.co/1200x600/94a3b8/080808?text=Hero+Image') }}"
                            alt="Robot icon" class="mx-auto w-16">
                    </div>
                @empty
                    <p class="text-center text-gray-500">No data available</p>
                @endforelse
            </div>
        </div>
    </section>

    <section style="background-image: url('{{ asset('storage/background/bg_1_1.png') }}')"
        class="py-16 lg:py-24 bg-no-repeat bg-cover bg-center px-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center mb-8 scroll-animate-icon">
                <div class="flex items-center mr-3">
                   <div class="w-7 h-7 rounded-full bg-gray-400 icon-circle icon-circle-1"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-500 -ml-2 icon-circle icon-circle-2"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-600 -ml-2 icon-circle icon-circle-3"></div>
                </div>
                <h2 class="text-2xl font-bold">Client Experience</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach ($clientExperience as $item)
                    <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden">

                        <div class="py-4 flex justify-center">
                            <img src="{{ asset('storage/' . $item->logo) }}" alt="Logo Klien" class="h-10 w-auto">
                        </div>

                        <div class="h-56 w-full">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="p-6 text-center">
                            <p class="font-bold text-xl">{{ $item->title }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $item->description }}</p>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="#"
                    class="inline-block bg-black text-white font-bold py-3 px-8 rounded-full hover:bg-gray-800 transition-colors duration-300">
                    See More
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-24 px-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center mb-8 scroll-animate-icon">
                <div class="flex items-center mr-3">
                    <div class="w-7 h-7 rounded-full bg-gray-400 icon-circle icon-circle-1"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-500 -ml-2 icon-circle icon-circle-2"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-600 -ml-2 icon-circle icon-circle-3"></div>
                </div>
                <h2 class="text-2xl font-bold">Smart Device for Smart Collaboration</h2>
            </div>
            <div class="relative rounded-lg overflow-hidden shadow-2xl">
                <iframe width="100%" height="600"
                    src="https://www.youtube.com/embed/{{ getYoutubeUrl() ?? 'dQw4w9WgXcQ' }}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </section>

@endsection

@push('jsOnPage')
    <script>
        console.log('ad')
        const carousel = document.getElementById('interactive-carousel');
        if (carousel) {
            const slides = carousel.querySelectorAll('.carousel-slide');
            const prevButton = carousel.querySelector('.carousel-prev');
            const nextButton = carousel.querySelector('.carousel-next');
            let currentIndex = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                });
            }

            if (prevButton && nextButton) {
                prevButton.addEventListener('click', () => {
                    currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
                    showSlide(currentIndex);
                });

                nextButton.addEventListener('click', () => {
                    currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
                    showSlide(currentIndex);
                });
            }
        }
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

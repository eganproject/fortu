@extends('layouts.user.main')
@section('title', 'Product - Fortu Digital Teknologi')
@push('cssOnPage')
    <style>
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
    <!-- Hero Section - Digital Signage -->
    @push('cssOnPage')
        <style>
            .hero-gradient {
                background: linear-gradient(to right, #afafaf, #f3f3f3);
            }

            .feature-card {
                background-color: #ffffff;
                border-radius: 1.5rem;
                box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.05), 0 8px 10px -6px rgb(0 0 0 / 0.05);
                border: 1px solid #f3f4f6;
            }
        </style>
    @endpush
    <section class="hero-gradient py-16 lg:py-6">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
            <div class="md:w-5/12">
                <h1 class="text-5xl font-bold mb-4" style="font-family: inter; color: #333;">{{ $product->nama }}
                </h1>
                <p class="text-gray-600 leading-relaxed mb-4">
                    {{ $product->deskripsi }}
                </p>
                <h2 class="text-xl font-bold text-gray-800">Elevate Your Vision</h2>
            </div>
            <div class="md:w-7/12 relative">
                <img src="{{ asset('public/storage/' . $product->thumbnail) }}" alt="Digital Signage Products"
                    class="rounded-lg w-full">

                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                    @foreach ($product->scopeDeviceInch($product->id) as $item)
                        <span
                            class="bg-gray-800 text-white text-sm font-semibold px-4 py-2 rounded">{{ $item->spesifikasi }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- 3D Icons Feature Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-y-12 text-center">
                <!-- Feature Item -->
                @forelse ($product->scopeXFeatures($product->id) as $item)
                    <div class="flex flex-col items-center">
                        <div class="bg-gray-100 rounded-full p-4 mb-4 inline-block shadow-md">
                            <img src="{{ asset('public/storage/' . $item->image) }}" alt="" class="w-24 h-24">
                        </div>
                        <h3 class="font-semibold text-gray-800 italic" style="font-family: inter; color: #333;">
                            {{ $item->spesifikasi }}</h3>
                    </div>
                @empty
                @endforelse
                <!-- Feature Item -->

            </div>
        </div>
    </section>

    <!-- Detailed Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 scroll-animate-icon">
                <div class="flex items-center justify-center mb-2">
                    <div class="w-7 h-7 rounded-full bg-gray-400 icon-circle icon-circle-1"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-500 -ml-2 icon-circle icon-circle-2"></div>
                    <div class="w-7 h-7 rounded-full bg-gray-600 -ml-2 icon-circle icon-circle-3"></div>
                </div>
                <h2 class="text-3xl font-bold">Fitur</h2>
            </div>

            <div class="space-y-8 max-w-5xl mx-auto">
                <!-- Feature 1 -->
                @forelse ($product->scopeFeatures($product->id) as $item)
                    <div @class([
                        'feature-card flex flex-col md:flex-row items-center gap-8 bg-gradient-to-r from-stone-50 via-stone-200 to-stone-50 p-6 rounded-xl',
                        'md:flex-row-reverse' => $loop->even, // Gunakan 'flex-row-reverse' untuk iterasi genap (2, 4, dst.)
                    ])>
                        {{-- Kolom Gambar --}}
                        <div class="w-full md:w-1/2">
                            {{-- Tambahkan w-full, h-full, dan object-cover agar gambar responsif --}}
                            <img src="{{ asset('public/storage/' . $item->image) }}" alt="Feature Image"
                                class="w-full h-full max-h-[250px] md:max-h-[300px] object-cover rounded-xl">
                        </div>

                        {{-- Kolom Teks --}}
                        <div class="w-full md:w-1/2">
                            <h3 class="text-xl font-bold mb-2 text-gray-900" style="font-family: inter; color: #333;">
                                {{ $item->spesifikasi }}</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                @empty
                    {{-- Tidak ada fitur untuk ditampilkan --}}
                @endforelse
            </div>
        </div>
    </section>

    <!-- Specification Download Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div
                class="max-w-5xl mx-auto bg-gray-800 text-white rounded-3xl p-8 flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h2 class="text-3xl font-bold" style="font-family: cursive;">Spesifikasi</h2>
                    <p class="text-gray-300 mt-1">Silahkan Download Brochure untuk mendapatkan spesifikasi produk {{$product->nama}}</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="#"
                        class="inline-flex items-center justify-center px-6 py-3 border border-green-400 text-base font-medium rounded-full text-green-400 hover:bg-green-400 hover:text-gray-900 transition-colors">
                        Download
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V9a2 2 0 012-2h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

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

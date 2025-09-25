@extends('layouts.user.main')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-silver-50 text-center p-4">
    <div class="bg-white/50 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-12 flex flex-col items-center ring-1 ring-black/10 max-w-lg mx-auto">
        
        <div class="animate-gentle-wobble mb-6">
            <i data-lucide="bot" class="w-28 h-28 md:w-32 md:h-32 text-slate-600"></i>
        </div>
        
        <h1 class="text-7xl md:text-8xl font-black text-slate-800 tracking-tighter text-shadow">
            404
        </h1>
        
        <p class="text-2xl md:text-3xl font-semibold text-slate-700 mt-4 text-shadow">
            Halaman Tidak Ditemukan
        </p>
        <p class="text-base text-slate-500 mt-3 max-w-sm mx-auto">
            Maaf, halaman yang Anda cari tidak dapat ditemukan atau mungkin telah dipindahkan.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10 w-full">
            {{-- Tombol untuk kembali ke halaman sebelumnya --}}
            <button onclick="window.history.back()"
               class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-base font-semibold text-slate-800 bg-white rounded-xl shadow-lg
                      hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-200
                      transition-all duration-300 ease-in-out transform hover:scale-105">
                <i data-lucide="arrow-left" class="w-5 h-5 mr-2.5"></i>
                Kembali
            </button>

            {{-- Tombol untuk kembali ke halaman utama --}}
            <a href="{{ url('/') }}"
               class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-base font-semibold text-white bg-slate-800 rounded-xl shadow-lg
                      hover:bg-black focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-200
                      transition-all duration-300 ease-in-out transform hover:scale-105">
                <i data-lucide="home" class="w-5 h-5 mr-2.5"></i>
                Ke Beranda
            </a>
        </div>

    </div>
</div>
@endsection

@push('jsOnPage')
{{-- Memanggil script Lucid Icons dari CDN dan menginisialisasinya --}}
<script>
    // Pastikan lucide diinisialisasi setelah DOM dimuat
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>

{{-- CSS Kustom untuk animasi --}}
<style>
    @keyframes gentle-wobble {
        0%, 100% {
            transform: rotate(-2deg);
        }
        50% {
            transform: rotate(2deg);
        }
    }

    .animate-gentle-wobble {
        animation: gentle-wobble 2.5s ease-in-out infinite;
    }

    .text-shadow {
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
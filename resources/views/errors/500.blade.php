@extends('layouts.user.main')

@section('title', 'Sistem Dalam Perbaikan')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-silver-50 text-center p-4">
    <div class="bg-white/50 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-12 flex flex-col items-center ring-1 ring-black/10 max-w-lg mx-auto">
        
        <div class="animate-pulse mb-6">
            <i data-lucide="database-zap" class="w-28 h-28 md:w-32 md:h-32 text-slate-600"></i>
        </div>
        
        <h1 class="text-5xl md:text-6xl font-black text-slate-800 tracking-tighter text-shadow">
            Sistem Dalam Perbaikan
        </h1>
        
        <p class="text-xl md:text-2xl font-semibold text-slate-700 mt-4 text-shadow">
            Kami sedang mengalami kendala teknis.
        </p>
        <p class="text-base text-slate-500 mt-3 max-w-sm mx-auto">
            Tim kami sedang bekerja keras untuk memperbaikinya. Mohon coba lagi dalam beberapa saat.
        </p>
        
        <div class="mt-10">
            <a href="{{ url('/') }}"
               class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-base font-semibold text-white bg-slate-800 rounded-xl shadow-lg
                      hover:bg-black focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-200
                      transition-all duration-300 ease-in-out transform hover:scale-105">
                <i data-lucide="refresh-cw" class="w-5 h-5 mr-2.5"></i>
                Coba Lagi
            </a>
        </div>

    </div>
</div>
@endsection

@push('jsOnPage')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>

<style>
    .text-shadow {
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

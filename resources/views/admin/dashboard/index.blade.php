@extends('layouts.admin.main')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Kunjungan Hari Ini</p>
                    <p class="text-2xl font-bold text-slate-800 mt-3">0</p>
                </div>
                <div class="bg-blue-100 text-yellow-500 p-2 rounded-lg">
                    <i data-lucide="eye" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-xs text-green-500 flex items-center mt-2">
                <i data-lucide="arrow-up" class="w-3 h-3 mr-1"></i>
                ?% dari kemarin
            </p>
        </div>
        <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Kunjungan Unik Hari Ini</p>
                    <p class="text-2xl font-bold text-slate-800 mt-3">0</p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                    <i data-lucide="view" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-xs text-green-500 flex items-center mt-2">
                <i data-lucide="arrow-up" class="w-3 h-3 mr-1"></i>
                ?% dari kemarin
            </p>
        </div>
        <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Kunjungan</p>
                    <p class="text-2xl font-bold text-slate-800 mt-3">0</p>
                </div>
                <div class="bg-blue-100 text-yellow-500 p-2 rounded-lg">
                    <i data-lucide="arrow-down-up" class="w-5 h-5"></i>
                </div>
            </div>

        </div>
        <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Kunjungan Unik</p>
                    <p class="text-2xl font-bold text-slate-800 mt-3">0</p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                    <i data-lucide="hat-glasses" class="w-5 h-5"></i>
                </div>
            </div>
        </div>
    </div>
@endsection

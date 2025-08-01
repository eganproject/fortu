@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Manajemen Hero Image - AdminPanel')

@section('content')
    {{-- Alpine.js component wrapper --}}
    <div x-data="{
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showDeleteModal: false,
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
        deleteFormAction: ''
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)">



        {{-- Main Content Table --}}
        <div
            class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden min-h-[500px]">
            <div class="flex justify-between items-center p-6">
                <h2 class="text-2xl font-bold text-slate-800">Manajemen Hero Image</h2>
                <a href="/admin/web-preferences/hero/create"
                    class="bg-black hover:bg-gray-800 hover:border hover:border-white text-white hover:text-gray-100 font-bold py-2 px-4 rounded-lg transition-all duration-300 flex items-center gap-2 shadow-md">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span>Tambah Baru</span>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Modul</th>
                            <th scope="col" class="px-6 py-3">Teks</th>
                            <th scope="col" class="px-6 py-3">Gambar Latar</th>
                            <th scope="col" class="px-6 py-3">Gambar Isometrik</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($heroImages as $image)
                            <tr class="bg-transparent border-b border-slate-200/80 hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-slate-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $image->modul }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ Str::limit($image->text, 50) }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('public/storage/' . $image->image_1) }}"
                                        alt="Image 1 for {{ $image->modul }}"
                                        class="w-24 h-12 object-cover rounded-md border border-slate-200">
                                </td>
                                <td class="px-6 py-4">
                                    @if ($image->image_2)
                                        <img src="{{ asset('public/storage/' . $image->image_2) }}"
                                            alt="Image 2 for {{ $image->modul }}"
                                            class="w-24 h-12 object-cover rounded-md border border-slate-200">
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-4">
                                        <a href="/admin/web-preferences/hero/{{ $image->id }}"
                                            class="font-medium text-blue-600 hover:text-blue-800 transition-colors"
                                            title="Edit">
                                            <i data-lucide="edit" class="w-5 h-5"></i>
                                        </a>
                                        <button type="button"
                                            @click.prevent="deleteFormAction = '/admin/web-preferences/hero/{{ $image->id }}'; showDeleteModal = true"
                                            class="font-medium text-red-500 hover:text-red-700 transition-colors"
                                            title="Hapus">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                        {{-- Form dihapus dari sini untuk UI yang lebih bersih, logikanya ditangani oleh AlpineJS --}}
                                        <form id="delete-form-{{ $image->id }}"
                                            action="/admin/web-preferences/hero/{{ $image->id }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-6 text-slate-500">
                                    Belum ada data hero image.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.modalNotif')

    </div>
@endsection

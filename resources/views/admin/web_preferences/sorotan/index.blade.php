@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Manajemen Client Experience')
@push('cssOnPage')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    {{-- Alpine.js component wrapper --}}
    <div x-data="{
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showDeleteModal: false,
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
        showEditModal: false,
        deleteFormAction: ''
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)">

        {{-- Main Content Table --}}
        <div
            class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden min-h-[500px]">
            <div class="flex justify-between items-center p-6">
                <h2 class="text-2xl font-bold text-slate-800">Daftar sorotan</h2>
                <a href="/admin/web-preferences/sorotan/create"
                    class="bg-black hover:bg-gray-800 hover:border hover:border-white text-white hover:text-gray-100 font-bold py-2 px-4 rounded-lg transition-all duration-300 flex items-center gap-2 shadow-md">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span>Tambah Baru</span>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left" id="indexTable">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Sub Title</th>
                            <th scope="col" class="px-6 py-3">Images</th>
                            <th scope="col" class="px-6 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sorotan as $item)
                            <tr>
                                <td class="px-6 py-3">{{ $loop->iteration }}</td>
                                <td class="px-6 py-3">{{ $item->title }}</td>
                                <td class="px-6 py-3">{{ $item->subtitle }}</td>
                                <td class="px-6 py-3">
                                    <img src="{{ asset('storage/' . $item->images) }}" alt="{{ $item->id }}"
                                        class="h-16 w-16">
                                </td>
                                <td class="px-6 py-3 text-center">
                                   <div class="flex justify-center items-center gap-4">
                                    <a href="/admin/web-preferences/sorotan/{{ $item->id }}" 
                                        class="font-medium text-blue-600 hover:text-blue-800 transition-colors" title="Edit">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </a>
                                    <button type="button"
                                        @click.prevent="deleteFormAction = '/admin/web-preferences/sorotan/{{ $item->id }}'; showDeleteModal = true"
                                        class="font-medium text-red-500 hover:text-red-700 transition-colors"
                                        title="Hapus">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}"
                                        action="/admin/web-preferences/sorotan/{{ $item->id }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                   </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b">
                                <td colspan="5" class="px-6 py-4 text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.modalNotif')
       
    </div>
@endsection

@push('jsOnPage')
@endpush

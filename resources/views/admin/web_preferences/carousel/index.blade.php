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
                <h2 class="text-2xl font-bold text-slate-800">Daftar Carousel</h2>
                <a href="/admin/web-preferences/carousel/create"
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
                            <th scope="col" class="px-6 py-3">Images</th>
                            <th scope="col" class="px-6 py-3">status</th>
                            <th scope="col" class="px-6 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carousel as $item)
                            <tr>
                                <td class="px-6 py-3">{{ $loop->iteration }}</td>
                                <td class="px-6 py-3">
                                    <img src="{{ asset('public/storage/' . $item->images) }}" alt="{{ $item->id }}"
                                        class="h-[150px]">
                                </td>
                                <td class="px-6 py-3">{{ $item->status }}</td>
                                <td class="px-6 py-3 text-center">
                                    <button type="button"
                                        @click.prevent="showEditModal = true; document.querySelector('#edit-form').setAttribute('action', '/admin/web-preferences/carousel/{{ $item->id }}');"
                                        class="font-medium text-blue-500 hover:text-blue-700 transition-colors"
                                        title="Edit">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </button>
                                    <button type="button"
                                        @click.prevent="deleteFormAction = '/admin/web-preferences/carousel/{{ $item->id }}'; showDeleteModal = true"
                                        class="font-medium text-red-500 hover:text-red-700 transition-colors"
                                        title="Hapus">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}"
                                        action="/admin/web-preferences/carousel/{{ $item->id }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b">
                                <td colspan="4" class="px-6 py-4 text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.modalNotif')

        <div x-show="showEditModal" class="fixed inset-0 bg-black/50 flex items-center justify-center"
            style="display: none;">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 text-center">
                <h3 class="text-2xl font-bold text-slate-800 mb-4">Edit Carousel</h3>
                <form id="edit-form" @submit.prevent="document.querySelector('#edit-form').submit()" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="status" class="block mb-2 text-sm font-medium text-slate-700">Status</label>
                        <select id="status" name="status"
                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="flex justify-center gap-4 mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300">
                            Simpan
                        </button>
                        <button type="button" @click="showEditModal = false"
                            class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-6 rounded-lg transition-all duration-300">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection

@push('jsOnPage')
@endpush

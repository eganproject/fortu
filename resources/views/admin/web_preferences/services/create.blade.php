@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Tambah Service - AdminPanel')

@push('cssOnPage')
    {{-- CSS untuk Quill Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        /* Menyesuaikan Quill Editor dengan tema terang */
        .ql-toolbar {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            border-color: #cbd5e1 !important;
            /* slate-300 */
        }

        .ql-container {
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
            border-color: #cbd5e1 !important;
            /* slate-300 */
            background-color: #ffffff;
            color: #1e293b;
            /* slate-800 */
            min-height: 250px;
        }

        .ql-editor {
            font-family: 'Inter', sans-serif;
        }

        .ql-editor.ql-blank::before {
            color: #94a3b8;
            /* slate-400 */
            font-style: normal;
        }
    </style>
@endpush

@section('content')


    <div x-data="{
        image_1: null,
        image_2: null,
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showDeleteModal: false,
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
        deleteFormAction: ''
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)"
        class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden min-h-[500px]">
        <h2 class="text-2xl font-bold text-slate-800 p-6">Tambah Service</h2>
        <div class="md:px-8">
            <form action="/admin/web-preferences/services" method="POST" enctype="multipart/form-data"
                class="space-y-6" id="service-form">
                @csrf

                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-slate-700">Title</label>
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="text" name="title" id="title" placeholder="Masukkan Title"
                        value="{{ old('title') }}" />
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="subtitle" class="block mb-2 text-sm font-medium text-slate-700">Sub Title</label>
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="text" name="subtitle" id="subtitle" placeholder="Masukkan subtitle"
                        value="{{ old('subtitle') }}" />
                    @error('subtitle')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-slate-700">Deskripsi</label>
                    <textarea
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="text" name="description" id="description" placeholder="Masukkan Deskripsi"
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image_1" class="block mb-2 text-sm font-medium text-slate-700">Gambar Latar</label>
                    <div
                        class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                        <template x-if="!image_1">
                            <div class="text-center text-slate-500">
                                <i data-lucide="image" class="w-10 h-10 mx-auto mb-2 opacity-50"></i>
                                <p>Pratinjau image_1</p>
                            </div>
                        </template>
                        <template x-if="image_1">
                            <img :src="image_1" alt="Pratinjau Gambar Latar" class="w-full h-full object-cover">
                        </template>
                    </div>
                    <input type="file" id="image_1" name="image_1"
                        class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                        required @change="image_1 = URL.createObjectURL($event.target.files[0])">
                    <p class="mt-1 text-xs text-slate-500">PNG, JPG, WEBP, SVG (MAX. 2MB). Rekomendasi rasio 16:9.</p>
                    @error('image_1')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image_2" class="block mb-2 text-sm font-medium text-slate-700">Gambar Samping</label>
                    <div
                        class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                        <template x-if="!image_2">
                            <div class="text-center text-slate-500">
                                <i data-lucide="image_2" class="w-10 h-10 mx-auto mb-2 opacity-50"></i>
                                <p>Pratinjau Gambar</p>
                            </div>
                        </template>
                        <template x-if="image_2">
                            <img :src="image_2" alt="Pratinjau Gambar" class="w-full h-full object-cover">
                        </template>
                    </div>
                    <input type="file" id="image_2" name="image_2"
                        class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                        required @change="image_2 = URL.createObjectURL($event.target.files[0])">
                    <p class="mt-1 text-xs text-slate-500">PNG, JPG, WEBP, SVG (MAX. 2MB). Rekomendasi rasio 4:3 atau 1:1.
                    </p>
                    @error('image_2')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 pt-4 pb-8">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg transition-all duration-300">
                        Simpan
                    </button>
                    <a href="/admin/web-preferences/services"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-5 rounded-lg transition-all duration-300">
                        Batal
                    </a>
                </div>

            </form>
        </div>
        @include('admin.modalNotif')
    </div>
@endsection

@push('jsOnPage')

@endpush

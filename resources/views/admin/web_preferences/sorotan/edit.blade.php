@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Edit Sorotan - AdminPanel')

@section('content')

    <div x-data="{
        images: null,
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showDeleteModal: false,
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
        deleteFormAction: ''
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)"
        class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden min-h-[500px]">
        <h2 class="text-2xl font-bold text-slate-800 p-6">Edit Sorotan</h2>
        <div class="md:px-8">
            <form action="/admin/web-preferences/sorotan/{{ $sorotan->id }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-slate-700">Title</label>
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="text" name="title" id="title" placeholder="Masukkan Title"
                        value="{{ old('title', $sorotan->title) }}" required/>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="subtitle" class="block mb-2 text-sm font-medium text-slate-700">Sub Title</label>
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="text" name="subtitle" id="subtitle" placeholder="Masukkan subtitle"
                        value="{{ old('subtitle', $sorotan->subtitle) }}" required/>
                    @error('subtitle')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="images" class="block mb-2 text-sm font-medium text-slate-700">Gambar</label>
                    <div
                        class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                        <template x-if="!images">
                            <img src="{{ asset('storage/' . $sorotan->images) }}" alt="Pratinjau Gambar"
                                class="w-full h-full object-cover">
                        </template>
                        <template x-if="images">
                            <img :src="images" alt="Pratinjau Gambar" class="w-full h-full object-cover">
                        </template>
                    </div>
                    <input type="file" id="images" name="images"
                        class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                        @change="images = URL.createObjectURL($event.target.files[0])">
                    <p class="mt-1 text-xs text-slate-500">PNG, JPG, WEBP, SVG (MAX. 2MB). Rekomendasi rasio 16:9.</p>
                    @error('images')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 pt-4 pb-8">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg transition-all duration-300">
                        Simpan
                    </button>
                    <a href="/admin/web-preferences/sorotan"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-5 rounded-lg transition-all duration-300">
                        Batal
                    </a>
                </div>

            </form>
        </div>
        @include('admin.modalNotif')
    </div>
@endsection


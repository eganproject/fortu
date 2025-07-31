@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Tambah Produk - AdminPanel')

@section('content')

    {{-- Main container with Alpine.js state management --}}
    <div x-data="productForm()" x-init="init()"
        class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden min-h-[500px]">
        <h2 class="text-2xl font-bold text-slate-800 p-6 border-b border-slate-200">Tambah Produk Baru</h2>
        <div class="md:px-8 p-6">
            <form action="/admin/web-preferences/produk" method="POST" enctype="multipart/form-data" class="space-y-6"
                id="product-form">
                @csrf

                {{-- Product Category --}}
                <div>
                    <label for="thumbnail" class="block mb-2 text-sm font-medium text-slate-700">Thumbnail Produk</label>
                    <div class="flex items-center gap-6">
                        <div
                            class="w-48 h-48 bg-slate-200 rounded-lg flex items-center justify-center overflow-hidden border-2 border-dashed border-slate-400">
                            <template x-if="thumbnailPreviewUrl">
                                <img :src="thumbnailPreviewUrl" alt="Thumbnail Preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!thumbnailPreviewUrl">
                                <span class="text-slate-500 text-sm text-center p-4">Preview Gambar Utama</span>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input name="thumbnail" id="thumbnail" @change="handleThumbnailPreview($event)"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-300"
                                type="file" accept="image/*" required />
                            <p class="mt-2 text-xs text-slate-500">Wajib diisi. PNG, JPG, GIF hingga 2MB.</p>
                            @error('thumbnail')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <label for="kategori_id" class="block mb-2 text-sm font-medium text-slate-700">Pilih Kategori
                        Produk</label>
                    <select id="kategori_id" name="kategori_id"
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                        required>
                        <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>
                            -- Pilih salah satu Kategori --</option>
                        @foreach ($kategoris as $item)
                            <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product Name --}}
                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-slate-700">Nama Produk</label>
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                        type="text" name="nama" id="nama" placeholder="Masukkan nama produk"
                        value="{{ old('nama') }}" required />
                    @error('nama')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product Description --}}
                <div>
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-slate-700">Deskripsi Produk</label>
                    <textarea
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                        name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi lengkap produk" rows="4">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dynamic Product Specifications Section --}}
                <div class="space-y-4 pt-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-slate-700">Spesifikasi Produk</h3>
                        <button @click="addSpecification" type="button"
                            class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Tambah Spesifikasi
                        </button>
                    </div>

                    {{-- Warning message when no specifications are present --}}
                    <template x-if="specifications.length === 0">
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                            <p class="font-bold">Peringatan</p>
                            <p>Anda harus menambahkan setidaknya satu spesifikasi produk untuk dapat menyimpan.</p>
                        </div>
                    </template>

                    {{-- Container for dynamic specification forms --}}
                    <div class="space-y-6">
                        <template x-for="(spec, index) in specifications" :key="index">
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 relative animate-fade-in">
                                {{-- Remove Button --}}
                                <button @click="removeSpecification(index)" type="button"
                                    class="absolute top-4 right-4 text-slate-400 hover:text-red-500 hover:bg-red-100 rounded-full p-1.5 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>

                                <div class="grid md:grid-cols-2 gap-6">
                                    {{-- Specification Category --}}
                                    <div>
                                        <label :for="'spec_kategori_' + index"
                                            class="block mb-2 text-sm font-medium text-slate-700">Kategori
                                            Spesifikasi</label>
                                        <select :name="'specifications[' + index + '][kategori_spesifikasi_id]'"
                                            :id="'spec_kategori_' + index"
                                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                                            required>
                                            <option value="" disabled selected>-- Pilih Kategori --</option>
                                            {{-- Assuming $kategoriSpesifikasi is passed from controller --}}
                                            @forelse ($kategoriSpesifikasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @empty
                                                <option value="" disabled>No categories available</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    {{-- Specification Name --}}
                                    <div>
                                        <label :for="'spec_nama_' + index"
                                            class="block mb-2 text-sm font-medium text-slate-700">Nama Spesifikasi</label>
                                        <input :name="'specifications[' + index + '][spesifikasi]'"
                                            :id="'spec_nama_' + index"
                                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                                            type="text" placeholder="Contoh: Warna, Ukuran, Material" required />
                                    </div>
                                </div>

                                {{-- Specification Description --}}
                                <div class="mt-6">
                                    <label :for="'spec_deskripsi_' + index"
                                        class="block mb-2 text-sm font-medium text-slate-700">Deskripsi Spesifikasi</label>
                                    <textarea :name="'specifications[' + index + '][deskripsi_spesifikasi]'" :id="'spec_deskripsi_' + index"
                                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                                        placeholder="Contoh: Merah Maroon, 15 inch, Katun Combed 30s" rows="3"></textarea>
                                </div>

                                {{-- Specification Image with Preview --}}
                                <div class="mt-6">
                                    <label :for="'spec_image_' + index"
                                        class="block mb-2 text-sm font-medium text-slate-700">Gambar Spesifikasi
                                        (Opsional)</label>
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-32 h-32 bg-slate-200 rounded-lg flex items-center justify-center overflow-hidden border border-dashed border-slate-400">
                                            <template x-if="spec.imagePreviewUrl">
                                                <img :src="spec.imagePreviewUrl" alt="Image Preview"
                                                    class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!spec.imagePreviewUrl">
                                                <span class="text-slate-500 text-sm text-center">Preview</span>
                                            </template>
                                        </div>
                                        <div class="flex-1">
                                            <input :name="'specifications[' + index + '][image]'"
                                                :id="'spec_image_' + index" @change="handleImagePreview($event, index)"
                                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-300"
                                                type="file" accept="image/*" />
                                            <p class="mt-1 text-xs text-slate-500">PNG, JPG, GIF up to 2MB.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>


                {{-- Form Action Buttons --}}
                <div class="flex items-center gap-4 pt-8 pb-4 border-t border-slate-200">
                    <button type="submit" :disabled="specifications.length === 0"
                        :class="{
                            'bg-blue-600 hover:bg-blue-700 focus:ring-blue-300': specifications.length > 0,
                            'bg-slate-400 cursor-not-allowed': specifications.length === 0
                        }"
                        class="text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4">
                        Simpan Produk
                    </button>
                    <a href="/admin/web-preferences/produk" {{-- Adjust the cancel link if needed --}}
                        class="bg-slate-200 hover:bg-slate-300 text-slate-800 font-medium py-3 px-6 rounded-lg transition-all duration-300">
                        Batal
                    </a>
                </div>

            </form>
        </div>
        {{-- Include any modals if necessary --}}
        {{-- @include('admin.modalNotif') --}}
    </div>
@endsection

@push('jsOnPage')
    {{-- Load Alpine.js from CDN. Place this before your custom script. --}}
    <script>
        function productForm() {
            return {
                // Flag to ensure init() runs only once
                initialized: false,
                thumbnailPreviewUrl: '', // For the main product thumbnail
                // Start with an empty array
                specifications: [],
                // Holds success/error modal states from session
                showSuccessModal: {{ session('success') ? 'true' : 'false' }},
                showErrorModal: {{ session('error') ? 'true' : 'false' }},

                // Initializer function
                init() {
                    // Prevent this from running more than once
                    if (this.initialized) {
                        return;
                    }
                    this.initialized = true;

                    // Automatically hide success/error modals after 5 seconds
                    if (this.showSuccessModal || this.showErrorModal) {
                        setTimeout(() => {
                            this.showSuccessModal = false;
                            this.showErrorModal = false;
                        }, 5000);
                    }

                    // Add the first specification form safely
                    this.addSpecification();
                },
                handleThumbnailPreview(event) {
                    const file = event.target.files[0];
                    if (!file) {
                        this.thumbnailPreviewUrl = '';
                        return;
                    }
                    this.thumbnailPreviewUrl = URL.createObjectURL(file);
                },

                // Adds a new specification object to the array
                addSpecification() {
                    this.specifications.push({
                        kategori_spesifikasi_id: '',
                        spesifikasi: '',
                        deskripsi_spesifikasi: '',
                        image: null,
                        imagePreviewUrl: '' // URL for image preview
                    });
                },

                // Removes a specification from the array by its index
                removeSpecification(index) {
                    this.specifications.splice(index, 1);
                },

                // Handles file input change to generate a preview
                handleImagePreview(event, index) {
                    const file = event.target.files[0];
                    if (!file) {
                        this.specifications[index].imagePreviewUrl = '';
                        return;
                    }

                    // Create a temporary URL for the selected image
                    this.specifications[index].imagePreviewUrl = URL.createObjectURL(file);
                }
            }
        }
    </script>

    {{-- Add custom CSS for animations if needed --}}
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }
    </style>
@endpush

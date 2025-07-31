@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Edit Produk - AdminPanel')

@section('content')

    {{-- Main container with Alpine.js state management --}}
    <div x-data="productForm()" x-init="init()"
        class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden min-h-[500px]">
        <h2 class="text-2xl font-bold text-slate-800 p-6 border-b border-slate-200">Edit Produk</h2>
        <div class="md:px-8 p-6">
            <form action="/admin/web-preferences/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data"
                class="space-y-6" id="product-form">
                @csrf
                @method('PUT') {{-- Method spoofing untuk request UPDATE --}}

                {{-- Product Thumbnail --}}
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
                                type="file" accept="image/*" />
                            <p class="mt-2 text-xs text-slate-500">Kosongkan jika tidak ingin mengganti thumbnail.</p>
                            @error('thumbnail')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Product Category --}}
                <div>
                    <label for="kategori_id" class="block mb-2 text-sm font-medium text-slate-700">Pilih Kategori
                        Produk</label>
                    <select id="kategori_id" name="kategori_id"
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                        required>
                        <option value="" disabled>-- Pilih salah satu Kategori --</option>
                        @foreach ($kategoris as $item)
                            <option value="{{ $item->id }}"
                                {{ old('kategori_id', $produk->kategori_id) == $item->id ? 'selected' : '' }}>
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
                        value="{{ old('nama', $produk->nama) }}" required />
                    @error('nama')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product Description --}}
                <div>
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-slate-700">Deskripsi Produk</label>
                    <textarea
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition duration-300"
                        name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi lengkap produk" rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
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
                            <span>Tambah Spesifikasi</span>
                        </button>
                    </div>

                    <template x-if="specifications.length === 0">
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                            <p class="font-bold">Peringatan</p>
                            <p>Produk harus memiliki setidaknya satu spesifikasi.</p>
                        </div>
                    </template>

                    <div class="space-y-6">
                        <template x-for="(spec, index) in specifications" :key="spec.id || index">
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 relative animate-fade-in">
                                <input type="hidden" :name="'specifications[' + index + '][id]'" :value="spec.id"
                                    x-if="spec.id">
                                <button @click="removeSpecification(index)" type="button"
                                    class="absolute top-4 right-4 text-slate-400 hover:text-red-500 hover:bg-red-100 rounded-full p-1.5 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label :for="'spec_kategori_' + index"
                                            class="block mb-2 text-sm font-medium text-slate-700">Kategori
                                            Spesifikasi</label>
                                        <select :name="'specifications[' + index + '][kategori_spesifikasi_id]'"
                                            :id="'spec_kategori_' + index" x-model="spec.kategori_spesifikasi_id"
                                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            required>
                                            <option value="" disabled>-- Pilih Kategori --</option>
                                            @foreach ($kategoriSpesifikasis as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label :for="'spec_nama_' + index"
                                            class="block mb-2 text-sm font-medium text-slate-700">Nama Spesifikasi</label>
                                        <input :name="'specifications[' + index + '][spesifikasi]'"
                                            :id="'spec_nama_' + index" x-model="spec.spesifikasi"
                                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            type="text" placeholder="Contoh: Warna, Ukuran" required />
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <label :for="'spec_deskripsi_' + index"
                                        class="block mb-2 text-sm font-medium text-slate-700">Deskripsi Spesifikasi</label>
                                    <textarea :name="'specifications[' + index + '][deskripsi_spesifikasi]'" :id="'spec_deskripsi_' + index"
                                        x-model="spec.deskripsi"
                                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Contoh: Merah Maroon, 15 inch" rows="3"></textarea>
                                </div>
                                <div class="mt-6">
                                    <label class="block mb-2 text-sm font-medium text-slate-700">Gambar Spesifikasi</label>
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-32 h-32 bg-slate-200 rounded-lg flex items-center justify-center overflow-hidden border border-dashed border-slate-400">
                                            <img :src="spec.imagePreviewUrl" alt="Preview"
                                                class="w-full h-full object-cover" x-show="spec.imagePreviewUrl">
                                            <span class="text-slate-500 text-sm text-center"
                                                x-show="!spec.imagePreviewUrl">Preview</span>
                                        </div>
                                        <div class="flex-1">
                                            <input :name="'specifications[' + index + '][image]'"
                                                :id="'spec_image_' + index" @change="handleImagePreview($event, index)"
                                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                                type="file" accept="image/*" />
                                            <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengganti
                                                gambar.</p>
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
                        :class="{ 'bg-blue-600 hover:bg-blue-700': specifications.length >
                            0, 'bg-slate-400 cursor-not-allowed': specifications.length === 0 }"
                        class="text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg">
                        Update Produk
                    </button>
                    <a href="/admin/web-preferences/produk/"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-800 font-medium py-3 px-6 rounded-lg transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('jsOnPage')
    
    <script>
        // Menyiapkan data spesifikasi di dalam blok PHP untuk menghindari error parsing Blade.
        @php
            $specsForJs = $produk->spesifikasiProduks->map(function ($spec) {
                return [
                    'id' => $spec->id,
                    'kategori_spesifikasi_id' => $spec->kategori_spesifikasi_id,
                    'spesifikasi' => $spec->spesifikasi,
                    'deskripsi' => $spec->deskripsi ?? '', // Menambahkan fallback untuk nilai null
                    'imagePreviewUrl' => $spec->image ? asset('storage/' . $spec->image) : '',
                ];
            });
        @endphp

        function productForm() {
            return {
                initialized: false,
                thumbnailPreviewUrl: '{{ $produk->thumbnail ? asset('storage/' . $produk->thumbnail) : '' }}',
                // Menginisialisasi spesifikasi langsung dengan data yang sudah disiapkan.
                specifications: @json($specsForJs),

                init() {
                    if (this.initialized) return;
                    this.initialized = true;

                    // Jika setelah inisialisasi tidak ada spesifikasi, tambahkan satu form kosong.
                    if (this.specifications.length === 0) {
                        this.addSpecification();
                    }
                },

                handleThumbnailPreview(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    this.thumbnailPreviewUrl = URL.createObjectURL(file);
                },

                addSpecification() {
                    this.specifications.push({
                        id: null, // ID null untuk menandakan ini adalah spesifikasi baru.
                        kategori_spesifikasi_id: '',
                        spesifikasi: '',
                        deskripsi: '',
                        imagePreviewUrl: ''
                    });
                },

                removeSpecification(index) {
                    // Cukup hapus dari array di frontend. Logika penghapusan di backend
                    // akan ditangani oleh controller saat update.
                    this.specifications.splice(index, 1);
                },

                handleImagePreview(event, index) {
                    const file = event.target.files[0];
                    if (!file) return;
                    this.specifications[index].imagePreviewUrl = URL.createObjectURL(file);
                }
            }
        }
    </script>
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

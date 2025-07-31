@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Informasi Web')

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
        company_header: '{{ $comIn ? asset('storage/' . $comIn->company_header) : null }}',
        company_logo: '{{ $comIn ? asset('storage/' . $comIn->company_logo) : null }}',
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)">

        <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">

            <h2 class="p-6 text-2xl font-bold text-slate-800">Informasi</h2>
            <div class="md:px-8">

                <form action="/admin/web-preferences/informasi" method="POST" enctype="multipart/form-data" class="space-y-6"
                    id="article-form">
                    @csrf
                    <div>
                        <label for="company_header" class="block mb-2 text-sm font-medium text-slate-700">Logo</label>
                        <div
                            class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                            <template x-if="!company_header">
                                <div class="text-center text-slate-500">
                                    <i data-lucide="image" class="w-10 h-10 mx-auto mb-2 opacity-50"></i>
                                    <p>Pratinjau Logo</p>
                                </div>
                            </template>
                            <template x-if="company_header">
                                <img :src="company_header" alt="Pratinjau Gambar" class="w-full h-full object-cover">
                            </template>
                        </div>
                        <input type="file" id="company_header" name="company_header"
                            class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                            @change="company_header = URL.createObjectURL($event.target.files[0])">
                        <p class="mt-1 text-xs text-slate-500">PNG, JPG, WEBP, SVG (MAX. 2MB). Rekomendasi rasio 16:9.
                        </p>
                        @error('company_header')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="company_logo" class="block mb-2 text-sm font-medium text-slate-700">Logo</label>
                            <div
                                class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                                <template x-if="!company_logo">
                                    <div class="text-center text-slate-500">
                                        <i data-lucide="image" class="w-10 h-10 mx-auto mb-2 opacity-50"></i>
                                        <p>Pratinjau Logo</p>
                                    </div>
                                </template>
                                <template x-if="company_logo">
                                    <img :src="company_logo" alt="Pratinjau Gambar" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <input type="file" id="company_logo" name="company_logo"
                                class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                                @change="company_logo = URL.createObjectURL($event.target.files[0])">
                            <p class="mt-1 text-xs text-slate-500">PNG, JPG, WEBP, SVG (MAX. 2MB). Rekomendasi rasio 16:9.
                            </p>
                            @error('company_logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-6">
                            <div>
                                <label for="company_name" class="block mb-2 text-sm font-medium text-slate-700">Nama</label>
                                <input
                                    class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="text" name="company_name" id="company_name" placeholder="Masukkan nama usaha"
                                    value="{{ old('company_name', $comIn?->company_name) }}" required />
                                @error('company_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-slate-700">Email</label>
                                <input
                                    class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="email" name="email" id="email" placeholder="Masukkan email"
                                    value="{{ old('email', $comIn?->email) }}" required />
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="contact_number" class="block mb-2 text-sm font-medium text-slate-700">Nomor
                                    Telepon</label>
                                <input
                                    class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="text" name="contact_number" id="contact_number"
                                    placeholder="Masukkan nomor telepon"
                                    value="{{ old('contact_number', $comIn?->contact_number) }}" required />
                                @error('contact_number')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="youtube" class="block mb-2 text-sm font-medium text-slate-700">YouTube Link on Index
                            Page</label>
                        <input
                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            type="text" name="youtube_link_index" id="youtube_link_index"
                            placeholder="Masukkan Link Youtube"
                            value="{{ old('youtube_link_index', $comIn?->youtube_link_index) }}" />
                        @error('youtube_link_index')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="address_1" class="block mb-2 text-sm font-medium text-slate-700">Alamat 1</label>
                        <textarea
                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            type="text" name="address_1" id="address_1" placeholder="Masukkan alamat" rows="3" required>{{ old('address_1', $comIn?->address_1) }}</textarea>
                        @error('address_1')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="address_2" class="block mb-2 text-sm font-medium text-slate-700">Alamat 2</label>
                        <textarea
                            class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            type="text" name="address_2" id="address_2" placeholder="Masukkan alamat" rows="3">{{ old('address_2', $comIn?->address_2) }}</textarea>
                        @error('address_2')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="instagram" class="block mb-2 text-sm font-medium text-slate-700">Instagram</label>
                            <input
                                class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                type="text" name="instagram" id="instagram" placeholder="Masukkan Instagram"
                                value="{{ old('instagram', $comIn?->instagram) }}" />
                            @error('instagram')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="whatsapp" class="block mb-2 text-sm font-medium text-slate-700">WhatsApp</label>
                            <input
                                class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                type="text" name="whatsapp" id="whatsapp" placeholder="Masukkan WhatsApp"
                                value="{{ old('whatsapp', $comIn?->whatsapp) }}" required />
                            @error('whatsapp')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="youtube" class="block mb-2 text-sm font-medium text-slate-700">YouTube</label>
                            <input
                                class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                type="text" name="youtube" id="youtube" placeholder="Masukkan YouTube"
                                value="{{ old('youtube', $comIn?->youtube) }}" />
                            @error('youtube')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="linkedIn" class="block mb-2 text-sm font-medium text-slate-700">LinkedIn</label>
                            <input
                                class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                type="text" name="linkedIn" id="linkedIn" placeholder="Masukkan LinkedIn"
                                value="{{ old('linkedIn', $comIn?->linkedIn) }}" />
                            @error('linkedIn')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Menampilkan Informasi pengubah dan terakhir diubah --}}
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="user" class="w-5 h-5 text-slate-500"></i>
                                <span class="text-xs text-slate-500">

                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-5 h-5 text-slate-500"></i>
                                <span class="text-xs text-slate-500">
                                    {{ $comIn?->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 pt-4 pb-8">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg transition-all duration-300">
                                Simpan
                            </button>
                            <a href="/admin/web-preferences/hero"
                                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-5 rounded-lg transition-all duration-300">
                                Batal
                            </a>
                        </div>
                </form>
            </div>
        </div>
        <div x-show="showSuccessModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50"
            style="display: none;">
            <div @click.away="showSuccessModal = false"
                class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                    <i data-lucide="check" class="w-8 h-8 text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">Berhasil!</h3>
                <p class="text-slate-600">{{ session('success') }}</p>
                <button @click="showSuccessModal = false"
                    class="mt-6 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 w-full">
                    Tutup
                </button>
            </div>
        </div>
        <div x-show="showErrorModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50"
            style="display: none;">
            <div @click.away="showErrorModal = false"
                class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <i data-lucide="alert-triangle" class="w-8 h-8 text-red-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">Gagal!</h3>
                <p class="text-slate-600">{{ session('error') }}</p>
                <button @click="showErrorModal = false"
                    class="mt-6 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 w-full">
                    Tutup
                </button>
            </div>
        </div>

    </div>


@endsection

@push('jsOnPage')
@endpush

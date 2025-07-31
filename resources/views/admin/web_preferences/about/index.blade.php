@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Manajemen About')

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
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)">

        <div x-data="{ image1Preview: null, image2Preview: null }" class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">

            <h2 class="p-6 text-2xl font-bold text-slate-800">About Us</h2>
            <div class="md:px-8">

                <form action="/admin/web-preferences/about" method="POST" enctype="multipart/form-data" class="space-y-6"
                    id="article-form">
                    @csrf

                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-slate-700">Teks Deskripsi</label>
                        <input type="hidden" name="text" id="text-input">
                        <div id="editor-container">
                            {!! old('text', $aboutUs?->text) !!} {{-- Mengisi editor dengan data lama jika ada --}}
                        </div>
                        @error('text')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Menampilkan Informasi pengubah dan terakhir diubah --}}
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5 text-slate-500"></i>
                            <span class="text-xs text-slate-500">
                                {{ $aboutUs?->user->email }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="clock" class="w-5 h-5 text-slate-500"></i>
                            <span class="text-xs text-slate-500">
                                {{ $aboutUs?->updated_at->diffForHumans() }}
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
            x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
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
            x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
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
    {{-- JS untuk Quill --}}
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        // Inisialisasi Quill Editor
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tulis deskripsi atau konten di sini...',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, false]
                    }],
                    [{
                        'font': []
                    }],
                    ['bold', 'italic', 'underline'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'align': []
                    }],
                ]
            }
        });

        // Menghubungkan Quill dengan Form
        const form = document.querySelector('#article-form');
        const textInput = document.querySelector('#text-input');

        form.addEventListener('submit', function(e) {
            // Saat form disubmit, ambil konten HTML dari Quill...
            const htmlContent = quill.root.innerHTML;

            // Periksa jika kontennya default (kosong), maka set nilainya jadi string kosong
            if (htmlContent === '<p><br></p>') {
                textInput.value = '';
            } else {
                textInput.value = htmlContent;
            }
        });
    </script>
@endpush

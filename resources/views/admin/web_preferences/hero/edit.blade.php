@extends('layouts.admin.main')

@section('title', 'Edit Hero Image - AdminPanel')

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
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Edit Hero Image: {{ $heroImage->modul }}</h2>

    <div x-data="{
        image1Preview: '{{ asset('public/storage/' . $heroImage->image_1) }}',
        image2Preview: '{{ $heroImage->image_2 ? asset('public/storage/' . $heroImage->image_2) : null }}'
    }"
        class="bg-white/70 backdrop-blur-lg p-6 md:p-8 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">

        <form action="/admin/web-preferences/hero/update" method="POST" enctype="multipart/form-data" class="space-y-6"
            id="article-form">
            @csrf
            @method('POST')

            <div>
                <input type="hidden" name="id" id="id-input" value="{{ $heroImage->id }}">

                <label for="modul" class="block mb-2 text-sm font-medium text-slate-700">Pilih Modul</label>
                <select id="modul" name="modul"
                    class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="index" {{ old('modul', $heroImage->modul) == 'index' ? 'selected' : '' }}>Index /
                        Beranda</option>
                    <option value="about" {{ old('modul', $heroImage->modul) == 'about' ? 'selected' : '' }}>About Us
                    </option>
                    <option value="service" {{ old('modul', $heroImage->modul) == 'service' ? 'selected' : '' }}>Service
                    </option>
                    <option value="blog" {{ old('modul', $heroImage->modul) == 'blog' ? 'selected' : '' }}>Blog</option>
                    <option value="product" {{ old('modul', $heroImage->modul) == 'product' ? 'selected' : '' }}>Product</option>
                </select>
                @error('modul')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div id="titleContainer">
                <label for="modul" class="block mb-2 text-sm font-medium text-slate-700">Judul</label>
                <input
                    class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    type="text" name="title" id="title" placeholder="Masukkan Judul (Opsional)"
                    value="{{ old('title', $heroImage->title) }}" />
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div id="descContainer">
                <label for="text-input" class="block mb-2 text-sm font-medium text-slate-700">Teks Deskripsi</label>
                <input type="hidden" name="text" id="text-input">
                <div id="editor-container">
                    {{-- Mengisi editor dengan data lama, gunakan {!! !!} untuk render HTML --}}
                    {!! old('text', $heroImage->text) !!}
                </div>
                @error('text')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image_1_edit" class="block mb-2 text-sm font-medium text-slate-700">Ganti Gambar Latar</label>
                <div
                    class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                    <template x-if="image1Preview">
                        <img :src="image1Preview" alt="Pratinjau Gambar Latar" class="w-full h-full object-cover">
                    </template>
                </div>
                <input type="file" id="image_1_edit" name="image_1"
                    class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                    @change="image1Preview = URL.createObjectURL($event.target.files[0])">
                <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengubah gambar.</p>
                @error('image_1')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="image2Container">
                <label for="image_2_edit" class="block mb-2 text-sm font-medium text-slate-700">Ganti Gambar
                    Isometrik</label>
                <div
                    class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                    <template x-if="!image2Preview">
                        <div class="text-center text-slate-500">
                            <i data-lucide="image" class="w-10 h-10 mx-auto mb-2 opacity-50"></i>
                            <p>Tidak ada gambar isometrik.</p>
                        </div>
                    </template>
                    <template x-if="image2Preview">
                        <img :src="image2Preview" alt="Pratinjau Gambar Isometrik" class="w-full h-full object-cover">
                    </template>
                </div>
                <input type="file" id="image_2_edit" name="image_2"
                    class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                    @change="image2Preview = URL.createObjectURL($event.target.files[0])">
                <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengubah gambar.</p>
                @error('image_2')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4 pt-4 pb-8">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg transition-all duration-300">
                    Update
                </button>
                <a href="/admin/web-preferences/hero"
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-5 rounded-lg transition-all duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@push('jsOnPage')
    {{-- JS untuk Quill --}}
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });

            // Menghubungkan Quill dengan Form
            const form = document.querySelector('#article-form');
            const textInput = document.querySelector('#text-input');

            form.addEventListener('submit', function(e) {
                const htmlContent = quill.root.innerHTML;
                if (htmlContent === '<p><br></p>') {
                    textInput.value = '';
                } else {
                    textInput.value = htmlContent;
                }
            });

            const image2Container = document.querySelector('#image2Container');
            const titleContainer = document.querySelector('#titleContainer');
            const descContainer = document.querySelector('#descContainer');
            const modul = document.querySelector('#modul');
            if (modul.value === 'about' || modul.value === 'service' || modul.value === 'blog') {
                image2Container.classList.remove('hidden');
                descContainer.classList.remove('hidden');
                titleContainer.classList.remove('hidden');
            } else {
                image2Container.classList.add('hidden');
                descContainer.classList.add('hidden');
                titleContainer.classList.add('hidden');
            }


            modul.addEventListener('change', function() {
                if (modul.value === 'about' || modul.value === 'service' || modul.value === 'blog') {
                    image2Container.classList.remove('hidden');
                    descContainer.classList.remove('hidden');
                    titleContainer.classList.remove('hidden');
                } else {
                    image2Container.classList.add('hidden');
                    descContainer.classList.add('hidden');
                    titleContainer.classList.add('hidden');
                }
            });
        });
    </script>
@endpush

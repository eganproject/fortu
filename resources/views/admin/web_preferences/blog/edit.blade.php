@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

{{-- Ubah judul halaman menjadi 'Edit' --}}
@section('title', 'Edit Post - ' . $blog->title)

@push('cssOnPage')
    {{-- CSS untuk Quill Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        /* (CSS tidak berubah, tetap sama seperti sebelumnya) */
        .ql-toolbar {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            border-color: #cbd5e1 !important;
        }

        .ql-container {
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
            border-color: #cbd5e1 !important;
            background-color: #ffffff;
            color: #1e293b;
            min-height: 250px;
        }

        .ql-editor {
            font-family: 'Inter', sans-serif;
        }

        .ql-editor.ql-blank::before {
            color: #94a3b8;
            font-style: normal;
        }
    </style>
@endpush

@section('content')
    {{-- Ubah judul header menjadi 'Ubah' --}}

    {{-- Atur pratinjau gambar awal dengan gambar yang sudah ada dari $blog --}}
    <div x-data="{ image1Preview: '{{ $blog->image ? asset('public/storage/' . $blog->image) : null }}' }"
        class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <h2 class="text-2xl font-bold text-slate-800">Ubah Post</h2>
        <div class="md:px-8">

            {{-- Ubah action form ke route update dan tambahkan method spoofing 'PUT' --}}
            <form action="/admin/web-preferences/blog/{{ $blog->id }}" method="POST" enctype="multipart/form-data"
                class="space-y-6" id="article-form">
                @csrf
                @method('PUT')

                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-slate-700">Gambar</label>
                    <div
                        class="mt-2 w-full max-w-sm h-40 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center bg-slate-50 overflow-hidden">
                        {{-- Template ini akan menampilkan placeholder HANYA jika tidak ada gambar sama sekali --}}
                        <template x-if="!image1Preview">
                            <div class="text-center text-slate-500">
                                <i data-lucide="image" class="w-10 h-10 mx-auto mb-2 opacity-50"></i>
                                <p>Pratinjau Gambar Latar</p>
                            </div>
                        </template>
                        {{-- Template ini akan menampilkan gambar yang sudah ada atau pratinjau gambar baru --}}
                        <template x-if="image1Preview">
                            <img :src="image1Preview" alt="Pratinjau Gambar" class="w-full h-full object-cover">
                        </template>
                    </div>
                    {{-- Hapus 'required' karena gambar tidak wajib diubah saat edit --}}
                    <input type="file" id="image" name="image"
                        class="mt-4 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"
                        @change="image1Preview = URL.createObjectURL($event.target.files[0])">
                    <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengubah gambar. PNG, JPG, WEBP, SVG
                        (MAX. 2MB). Rekomendasi rasio 16:9.</p>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-slate-700">Judul</label>
                    {{-- Isi 'value' dengan data dari database. Fungsi old() tetap ada untuk menangani error validasi --}}
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="text" name="title" id="title" placeholder="Masukkan Judul" maxlength="150"
                        value="{{ old('title', $blog->title) }}" />
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="text" class="block mb-2 text-sm font-medium text-slate-700">Teks Deskripsi</label>
                    <input type="hidden" name="text" id="text-input">
                    {{-- Isi editor dengan data dari database. Fungsi old() tetap ada --}}
                    <div id="editor-container">
                        {!! old('text', $blog->text) !!}
                    </div>
                    @error('text')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p id="editor-error" class="mt-2 text-sm text-red-600" style="display: none;">
                        Teks deskripsi tidak boleh kosong.
                    </p>
                </div>

                <div class="flex items-center gap-4 pt-4 pb-8">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg transition-all duration-300">
                        Simpan Perubahan
                    </button>
                    <a href="/admin/web-preferences/blog"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-5 rounded-lg transition-all duration-300">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('jsOnPage')
    {{-- JS untuk Quill --}}
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        // Inisialisasi Quill Editor (Tidak ada perubahan pada bagian JS)
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

        // Menghubungkan Quill dengan Form (Tidak ada perubahan pada bagian JS)
        const form = document.querySelector('#article-form');
        const textInput = document.querySelector('#text-input');
        const editorError = document.querySelector('#editor-error');
        form.addEventListener('submit', function(e) {
            // Saat form disubmit, ambil konten HTML dari Quill...
            const htmlContent = quill.root.innerHTML;

            // Periksa jika kontennya default (kosong), maka set nilainya jadi string kosong
            if (htmlContent === '<p><br></p>') {
                textInput.value = '';
            } else {
                textInput.value = htmlContent;
            }

            if (quill.getText().trim().length === 0) {
                // Mencegah form untuk disubmit
                e.preventDefault();

                // Tampilkan pesan error frontend
                editorError.style.display = 'block';

                // Beri border merah pada editor untuk feedback visual
                document.querySelector('.ql-container').style.borderColor = 'red';
            } else {
                // Sembunyikan pesan error jika sudah terisi
                editorError.style.display = 'none';
                document.querySelector('.ql-container').style.borderColor = ''; // Kembalikan warna border
            }
        });
    </script>
@endpush

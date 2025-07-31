@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Edit User - AdminPanel')

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
        image1Preview: null,
        image2Preview: null,
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showDeleteModal: false,
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
        deleteFormAction: ''
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)"
        class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <h2 class="text-2xl font-bold text-slate-800">Edit User</h2>
        <div class="md:p-8">
            <form action="/admin/user-management/users/{{ $user->id }}" method="POST" class="space-y-6" id="category-form">
                @csrf
                @method('PUT')

                <div>
                    <label for="role_id" class="block mb-2 text-sm font-medium text-slate-700">Role</label>
                    <select name="role_id" id="role_id"
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" disabled selected>-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="modul" class="block mb-2 text-sm font-medium text-slate-700">Nama </label>
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="text" name="name" id="name" placeholder="Masukkan Nama" value="{{ old('name', $user->name) }}"
                        required />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-slate-700">Email</label>
                    <input
                        class="bg-white border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        type="email" name="email" id="email" placeholder="Masukkan Email"
                        value="{{ old('email', $user->email) }}" required />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-slate-700">Kata Sandi (Opsional)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </span>
                        <input
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                            type="password" name="password" id="password" placeholder="Masukkan Kata Sandi Lagi"
                            autocomplete="new-password" />
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-slate-700">Konfirmasi Kata
                        Sandi (Opsional)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </span>
                        <input
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                            type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Masukkan Kata Sandi Lagi" autocomplete="new-password" />
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 pt-4 pb-8">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg transition-all duration-300">
                        Simpan
                    </button>
                    <a href="/admin/user-management/users"
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
    <script>
        document.getElementById('category-form').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password.length < 8 && password.length > 0) {
                event.preventDefault(); // Prevent form submission
                alert('Kata sandi harus minimal 8 karakter!');
            }

            if (password !== passwordConfirmation && password.length > 0 && passwordConfirmation.length > 0) {
                event.preventDefault(); // Prevent form submission
                alert('Kata sandi dan konfirmasi kata sandi harus sama!');
            }
        });
    </script>
@endpush


@extends('layouts.auth.main')

@section('title', 'Login - Admin Panel')

@section('content')
    <div class="bg-gray-900/50 backdrop-blur-xl p-8 rounded-2xl border border-purple-800/50 shadow-2xl">

        <div class="text-center mb-8">
            <div class="inline-block p-3 bg-purple-600/20 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-purple-300">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white">Daftarkan akunmu</h1>
            <p class="text-gray-400 mt-2">Silakan daftar.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                    </span>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        autocomplete="name" autofocus
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-800/50 rounded-lg text-white placeholder-gray-500 focus:outline-none transition-all duration-300
                           @error('name')
                                border-red-500/80 focus:ring-2 focus:ring-red-500
                           @else
                                border-purple-800/60 focus:ring-2 focus:ring-purple-500
                           @enderror"
                        placeholder="Nama Anda">
                </div>
                @error('name')
                    <div role="alert" class="flex items-center mt-2 text-red-400 text-xs">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1.5 flex-shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        autocomplete="email"
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-800/50 rounded-lg text-white placeholder-gray-500 focus:outline-none transition-all duration-300
                           @error('email')
                                border-red-500/80 focus:ring-2 focus:ring-red-500
                           @else
                                border-purple-800/60 focus:ring-2 focus:ring-purple-500
                           @enderror"
                        placeholder="akun@email.com">
                </div>
                @error('email')
                    <div role="alert" class="flex items-center mt-2 text-red-400 text-xs">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1.5 flex-shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                    </span>
                    <input type="password" id="password" name="password" required autocomplete="new-password"
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-800/50 rounded-lg text-white placeholder-gray-500 focus:outline-none transition-all duration-300
                           @error('password')
                                border-red-500/80 focus:ring-2 focus:ring-red-500
                           @else
                                border-purple-800/60 focus:ring-2 focus:ring-purple-500
                           @enderror"
                        placeholder="••••••••">
                </div>
                @error('password')
                    <div role="alert" class="flex items-center mt-2 text-red-400 text-xs">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1.5 flex-shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div>
                <label for="password-confirm" class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi
                    Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                    </span>
                    <input type="password" id="password-confirm" name="password_confirmation" required
                        autocomplete="new-password"
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-800/50 rounded-lg text-white placeholder-gray-500 focus:outline-none transition-all duration-300 border-purple-800/60 focus:ring-2 focus:ring-purple-500"
                        placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg shadow-purple-600/30
                       transition-all duration-300 transform hover:scale-105">
                    Daftar
                </button>
            </div>
        </form>

        <div class="text-center mt-8">
            <p class="text-sm text-gray-400">
                Sudah punya akun?
                <a href="/login" class="font-medium text-purple-400 hover:text-purple-300 transition-colors">Masuk
                    sini</a>
            </p>
        </div>
    </div>
@endsection

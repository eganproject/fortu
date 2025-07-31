@extends('layouts.auth.main')

@section('title', 'Login - Admin Panel')

@section('content')
    {{-- Main container with a semi-transparent dark background, blurred backdrop, silver/gray border, and shadow --}}
    <div class="bg-gray-900/50 backdrop-blur-xl p-8 rounded-2xl border border-gray-700/50 shadow-2xl">

        {{-- Header section --}}
        <div class="text-center mb-8">
            {{-- Icon wrapper with a light gray background --}}
            <div class="inline-block p-3 bg-gray-500/20 rounded-full mb-4">
                {{-- SVG Icon with a light silver/gray color --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-gray-300">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white">Selamat Datang Kembali</h1>
            <p class="text-gray-400 mt-2">Silakan masuk untuk melanjutkan ke panel admin.</p>
        </div>

        {{-- Login form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email input field --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        autocomplete="email" autofocus
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-800/50 rounded-lg text-white placeholder-gray-500 focus:outline-none transition-all duration-300 
                               @error('email') 
                                   border-red-500/80 focus:ring-2 focus:ring-red-500 
                               @else 
                                   border-gray-700/60 focus:ring-2 focus:ring-gray-500 
                               @enderror"
                        placeholder="akun@email.com">
                </div>

                {{-- Modern error message for email --}}
                @error('email')
                    <div role="alert" class="flex items-center mt-2 text-red-400 text-xs">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1.5 flex-shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Password input field --}}
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-gray-400 hover:text-gray-300 transition-colors">
                            Lupa password?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                    </span>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-800/50 rounded-lg text-white placeholder-gray-500 focus:outline-none transition-all duration-300 
                               @error('password') 
                                   border-red-500/80 focus:ring-2 focus:ring-red-500 
                               @else 
                                   border-gray-700/60 focus:ring-2 focus:ring-gray-500 
                               @enderror"
                        placeholder="••••••••">
                </div>

                {{-- Modern error message for password --}}
                @error('password')
                    <div role="alert" class="flex items-center mt-2 text-red-400 text-xs">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1.5 flex-shrink-0"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Submit button --}}
            <div>
                <button type="submit"
                    class="w-full bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg shadow-gray-700/30
                           transition-all duration-300 transform hover:scale-105">
                    Masuk
                </button>
            </div>
        </form>

        {{-- Link to registration page --}}
        {{-- <div class="text-center mt-8">
            <p class="text-sm text-gray-400">
                Belum punya akun?
                <a href="/register" class="font-medium text-gray-400 hover:text-gray-300 transition-colors">Daftar di
                    sini</a>
            </p>
        </div> --}}
    </div>
@endsection

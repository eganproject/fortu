{{-- Simpan file ini di resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>

    {{-- Memanggil Tailwind CSS dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Memanggil Font Inter dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">

    {{-- CSS Kustom untuk efek dan font --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Efek bayangan halus pada teks untuk memberikan kedalaman */
        .text-shadow {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Animasi goyang halus untuk si robot */
        @keyframes gentle-wobble {
            0%, 100% {
                transform: rotate(-2deg);
            }
            50% {
                transform: rotate(2deg);
            }
        }

        .animate-gentle-wobble {
            animation: gentle-wobble 2.5s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-200 to-slate-400 text-slate-800 antialiased">

    <div class="flex items-center justify-center min-h-screen text-center p-4">
        
        {{-- Kartu utama dengan efek "frosted glass" untuk kesan mewah --}}
        <div class="bg-white/50 backdrop-blur-xl rounded-3xl shadow-2xl p-8 md:p-12 flex flex-col items-center ring-1 ring-black/10 max-w-lg mx-auto">
            
            <!-- Ikon Robot dengan warna yang lebih kalem -->
            <div class="animate-gentle-wobble mb-6">
                <i data-lucide="bot" class="w-28 h-28 md:w-32 md:h-32 text-slate-600"></i>
            </div>
            
            <!-- Judul Error dengan efek shadow --}}
            <h1 class="text-7xl md:text-8xl font-black text-slate-800 tracking-tighter text-shadow">
                404
            </h1>
            
            <-- Pesan yang lebih elegan -->
            <p class="text-2xl md:text-3xl font-semibold text-slate-700 mt-4 text-shadow">
                Koneksi Terputus
            </p>
            <p class="text-base text-slate-500 mt-3 max-w-sm mx-auto">
                Sepertinya halaman yang Anda tuju sedang bersembunyi atau tidak pernah ada di alam semesta ini.
            </p>
            
            <!-- Tombol Kembali dengan desain premium -->
            <a href="{{ url('/') }}" 
               class="inline-flex items-center mt-10 px-8 py-3 text-base font-semibold text-white bg-slate-800 rounded-xl shadow-lg
                      hover:bg-black focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-200
                      transition-all duration-300 ease-in-out transform hover:scale-105">
                <i data-lucide="home" class="w-5 h-5 mr-2.5"></i>
                Kembali ke Beranda
            </a>

        </div>
    </div>

    {{-- Memanggil script Lucid Icons dari CDN --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Inisialisasi semua ikon Lucid
        lucide.createIcons();
    </script>

</body>
</html>

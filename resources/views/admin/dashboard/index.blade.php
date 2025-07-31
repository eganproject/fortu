@extends('layouts.admin.main')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Pendapatan</p>
                <p class="text-2xl font-bold text-slate-800 mt-1">Rp 1.2M</p>
            </div>
            <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                <i data-lucide="dollar-sign" class="w-5 h-5"></i>
            </div>
        </div>
        <p class="text-xs text-green-500 flex items-center mt-2">
            <i data-lucide="arrow-up" class="w-3 h-3 mr-1"></i>
            12.5% dari bulan lalu
        </p>
    </div>
    <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Pesanan Baru</p>
                <p class="text-2xl font-bold text-slate-800 mt-1">3,456</p>
            </div>
            <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
            </div>
        </div>
         <p class="text-xs text-green-500 flex items-center mt-2">
            <i data-lucide="arrow-up" class="w-3 h-3 mr-1"></i>
            8.2% dari minggu lalu
        </p>
    </div>
    <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Pengguna</p>
                <p class="text-2xl font-bold text-slate-800 mt-1">89,4k</p>
            </div>
            <div class="bg-emerald-100 text-emerald-600 p-2 rounded-lg">
                <i data-lucide="users" class="w-5 h-5"></i>
            </div>
        </div>
         <p class="text-xs text-red-500 flex items-center mt-2">
            <i data-lucide="arrow-down" class="w-3 h-3 mr-1"></i>
            1.5% dari bulan lalu
        </p>
    </div>
    <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Kunjungan Unik</p>
                <p class="text-2xl font-bold text-slate-800 mt-1">21,7k</p>
            </div>
            <div class="bg-amber-100 text-amber-600 p-2 rounded-lg">
                <i data-lucide="line-chart" class="w-5 h-5"></i>
            </div>
        </div>
         <p class="text-xs text-green-500 flex items-center mt-2">
            <i data-lucide="arrow-up" class="w-3 h-3 mr-1"></i>
            22.8% dari minggu lalu
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <h3 class="text-lg font-semibold text-slate-800 mb-4">Grafik Penjualan</h3>
        <div class="h-80 flex items-end space-x-2 sm:space-x-4">
            <div class="flex-1 h-[60%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Jan"></div>
            <div class="flex-1 h-[75%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Feb"></div>
            <div class="flex-1 h-[50%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Mar"></div>
            <div class="flex-1 h-[85%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Apr"></div>
            <div class="flex-1 h-[95%] bg-gradient-to-t from-blue-500 to-blue-600 rounded-t-lg shadow-lg" title="Mei"></div>
            <div class="flex-1 h-[70%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Jun"></div>
            <div class="flex-1 h-[65%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Jul"></div>
            <div class="flex-1 h-[80%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Agu"></div>
            <div class="flex-1 h-[60%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Sep"></div>
            <div class="flex-1 h-[70%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Okt"></div>
            <div class="flex-1 h-[55%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Nov"></div>
            <div class="flex-1 h-[45%] bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg" title="Des"></div>
        </div>
    </div>

    <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)]">
        <h3 class="text-lg font-semibold text-slate-800 mb-4">Pesanan Terbaru</h3>
        <div class="space-y-4">
            <div class="flex items-center text-sm">
                <img src="https://placehold.co/40x40/E0F2FE/0891B2?text=PS" alt="Produk" class="w-10 h-10 rounded-lg mr-4">
                <div class="flex-1">
                    <p class="font-semibold text-slate-700">PlayStation 5</p>
                    <p class="text-xs text-slate-500">#ORD-00124</p>
                </div>
                <p class="font-bold text-slate-800">Rp 8.7jt</p>
            </div>
            <div class="flex items-center text-sm">
                <img src="https://placehold.co/40x40/FEE2E2/B91C1C?text=MB" alt="Produk" class="w-10 h-10 rounded-lg mr-4">
                <div class="flex-1">
                    <p class="font-semibold text-slate-700">Macbook Pro 14"</p>
                    <p class="text-xs text-slate-500">#ORD-00123</p>
                </div>
                <p class="font-bold text-slate-800">Rp 32.5jt</p>
            </div>
             <div class="flex items-center text-sm">
                <img src="https://placehold.co/40x40/FEF9C3/A16207?text=IP" alt="Produk" class="w-10 h-10 rounded-lg mr-4">
                <div class="flex-1">
                    <p class="font-semibold text-slate-700">iPhone 15 Pro</p>
                    <p class="text-xs text-slate-500">#ORD-00122</p>
                </div>
                <p class="font-bold text-slate-800">Rp 21.1jt</p>
            </div>
             <div class="flex items-center text-sm">
                <img src="https://placehold.co/40x40/ECFDF5/059669?text=SM" alt="Produk" class="w-10 h-10 rounded-lg mr-4">
                <div class="flex-1">
                    <p class="font-semibold text-slate-700">Smart Monitor M8</p>
                    <p class="text-xs text-slate-500">#ORD-00121</p>
                </div>
                <p class="font-bold text-slate-800">Rp 9.8jt</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-slate-800">Daftar Pengguna</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50/50">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Pengguna</th>
                    <th scope="col" class="px-6 py-3">Jabatan</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Tanggal Bergabung</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-transparent border-b border-slate-200/80 hover:bg-slate-50/50">
                    <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap flex items-center">
                        <img src="https://placehold.co/32x32/E2E8F0/475569?text=DI" class="w-8 h-8 rounded-full mr-3" alt="Dian">
                        Dian Lestari
                    </th>
                    <td class="px-6 py-4">Product Manager</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Aktif</span>
                    </td>
                    <td class="px-6 py-4">2023-03-15</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="bg-transparent border-b border-slate-200/80 hover:bg-slate-50/50">
                    <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap flex items-center">
                         <img src="https://placehold.co/32x32/E2E8F0/475569?text=AG" class="w-8 h-8 rounded-full mr-3" alt="Agung">
                        Agung Wijaya
                    </th>
                    <td class="px-6 py-4">Frontend Developer</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Aktif</span>
                    </td>
                    <td class="px-6 py-4">2022-11-20</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="bg-transparent border-b border-slate-200/80 hover:bg-slate-50/50">
                    <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap flex items-center">
                         <img src="https://placehold.co/32x32/E2E8F0/475569?text=CI" class="w-8 h-8 rounded-full mr-3" alt="Citra">
                        Citra Dewi
                    </th>
                    <td class="px-6 py-4">UI/UX Designer</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full">Cuti</span>
                    </td>
                    <td class="px-6 py-4">2023-01-10</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="bg-transparent hover:bg-slate-50/50">
                    <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap flex items-center">
                         <img src="https://placehold.co/32x32/E2E8F0/475569?text=RI" class="w-8 h-8 rounded-full mr-3" alt="Rian">
                        Rian Hidayat
                    </th>
                    <td class="px-6 py-4">Backend Developer</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Nonaktif</span>
                    </td>
                    <td class="px-6 py-4">2022-09-01</td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection
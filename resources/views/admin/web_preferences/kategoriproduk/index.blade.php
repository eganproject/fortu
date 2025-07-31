@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Kategori Produk')
@push('cssOnPage')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
    {{-- Alpine.js component wrapper --}}
    <div x-data="{
        showSuccessModal: {{ session('success') ? 'true' : 'false' }},
        showDeleteModal: false,
        showErrorModal: {{ session('error') ? 'true' : 'false' }},
        deleteFormAction: ''
    }" x-init="setTimeout(() => showSuccessModal = false, 5000)">

        {{-- Main Content Table --}}
        <div
            class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.1)] overflow-hidden min-h-[500px]">
            <div class="flex justify-between items-center p-6">
                <h2 class="text-2xl font-bold text-slate-800">Manajemen Kategori Produk</h2>
                <a href="/admin/web-preferences/kategori/create"
                    class="bg-black hover:bg-gray-800 hover:border hover:border-white text-white hover:text-gray-100 font-bold py-2 px-4 rounded-lg transition-all duration-300 flex items-center gap-2 shadow-md">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span>Tambah Baru</span>
                </a>
            </div>
            <div class="p-4 flex justify-between items-center">
                <input type="text" id="customSearch" placeholder="Cari..."
                    class="border border-slate-300 rounded-lg p-2 text-sm">
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left" id="indexTable">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama Kategori</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-6 py-3">Layout</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

       @include('admin.modalNotif')


    </div>
@endsection

@push('jsOnPage')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#indexTable').DataTable({
                // AKTIFKAN SERVER-SIDE
                "processing": true, // Menampilkan indikator "processing"
                "serverSide": true, // Mengaktifkan mode server-side
                "ajax": {
                    "url": "/admin/web-preferences/kategori/lists", // URL endpoint API Anda untuk mengambil data
                    "type": "POST", // atau 'GET', sesuaikan dengan backend Anda
                    "data": function(d) {
                        d._token = '{{ csrf_token() }}';
                    }
                },

                // MENGHILANGKAN FITUR BAWAAN DATATABLES
                "dom": 't<"flex justify-between items-center p-4"ip>', // 't' = tabel, 'i' = info, 'p' = pagination
                "pagingType": "simple_numbers", // Tipe pagination
                "searching": true, // Tetap aktifkan searching, tapi kita kontrol dari input sendiri

                // DEFINISIKAN KOLOM DARI DATA JSON SERVER
                "columns": [{
                        "data": "no",
                        "orderable": false,
                        "searchable": false,
                        "className": "px-6 py-4 font-medium text-slate-900"
                    }, // Kolom nomor
                    {
                        "data": "nama_kategori",
                        "className": "px-6 py-4 font-medium text-slate-900"
                    },
                    {
                        "data": "deskripsi",
                        "className": "px-6 py-4 font-medium text-slate-900"
                    },
                    {
                        "data": "layout",
                        "className": "px-6 py-4 font-medium text-slate-900"
                    },
                    {
                        "data": "aksi",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data) {
                            return `
                                <div class="flex justify-center items-center gap-4">
                                    <a href="/admin/web-preferences/kategori/${data}" 
                                        class="font-medium text-blue-600 hover:text-blue-800 transition-colors" title="Edit">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </a>
                                    <button type="button"
                                        @click.prevent="deleteFormAction = '/admin/web-preferences/kategori/${data}'; showDeleteModal = true"
                                        class="font-medium text-red-500 hover:text-red-700 transition-colors" title="Hapus">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                    <form id="delete-form-${data}"
                                        action="/admin/web-preferences/kategori/${data}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            `;
                        },
                        "className": "px-6 py-4 font-medium text-slate-900"
                    } // Kolom aksi
                ],

                // FUNGSI UNTUK MENAMBAHKAN CLASS TAILWIND SETELAH TABEL DI-RENDER
                "initComplete": function(settings, json) {
                    // Menambahkan class ke pagination container
                    $('.dt-paging').addClass('flex items-center');

                    // Menambahkan class ke setiap tombol pagination
                    $('.dt-paging-button').addClass(
                        'px-3 py-1 mx-1 border border-slate-300 rounded-md hover:bg-slate-100');

                    // Menambahkan class ke tombol yang aktif
                    $('.dt-paging-button.current').addClass('bg-blue-500 text-white').removeClass(
                        'border-slate-300');

                    // Menambahkan class ke info "Showing x to y of z entries"
                    $('.dt-info').addClass('text-sm text-slate-600');
                    lucide.createIcons();
                },
                "drawCallback": function(settings, json) {
                    // Menambahkan class ke pagination container
                    $('.dt-paging').addClass('flex items-center');

                    // Menambahkan class ke setiap tombol pagination
                    $('.dt-paging-button').addClass(
                        'px-3 py-1 mx-1 border border-slate-300 rounded-md hover:bg-slate-100');

                    // Menambahkan class ke tombol yang aktif
                    $('.dt-paging-button.current').addClass('bg-blue-500 text-white').removeClass(
                        'border-slate-300');

                    // Menambahkan class ke info "Showing x to y of z entries"
                    $('.dt-info').addClass('text-sm text-slate-600');
                    lucide.createIcons();
                },

                // Mengganti teks default
                "language": {
                    "processing": '<div class="text-center">Memuat...</div>',
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "zeroRecords": "Data tidak ditemukan",
                    "paginate": {
                        "next": "›",
                        "previous": "‹"
                    }
                }
            });

            // HUBUNGKAN INPUT PENCARIAN KUSTOM
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });


        });
    </script>
@endpush

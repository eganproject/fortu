@extends('layouts.admin.main') {{-- Pastikan ini menunjuk ke layout utama yang benar --}}

@section('title', 'Manajemen Produk - AdminPanel')
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
                <h2 class="text-2xl font-bold text-slate-800">Role</h2>
                <a href="/admin/user-management/role/create"
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
                            <th scope="col" class="px-6 py-3">Nama Role</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $role->name }}</td>
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $role->deskripsi }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-4">
                                        <a href="/admin/user-management/role/{{ $role->id }}"
                                            class="font-medium text-blue-600 hover:text-blue-800 transition-colors"
                                            title="Edit">
                                            <i data-lucide="edit" class="w-5 h-5"></i>
                                        </a>
                                        <button type="button"
                                            @click.prevent="deleteFormAction = '/admin/user-management/role/{{ $role->id }}'; showDeleteModal = true"
                                            class="font-medium text-red-500 hover:text-red-700 transition-colors"
                                            title="Hapus">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                        <form id="delete-form-{{ $role->id }}"
                                            action="/admin/user-management/role/{{ $role->id }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b">
                                <td colspan="4" class="px-6 py-4 text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
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
                paging: false,
                info: false,
                searching: true, // Fitur pencarian tetap diaktifkan untuk API
                dom: 'rt' // Hanya render tabel dan processing indicator, tanpa search box bawaan
            });

            // Kode untuk custom search Anda tidak perlu diubah dan akan tetap berfungsi
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });


        });
    </script>
@endpush

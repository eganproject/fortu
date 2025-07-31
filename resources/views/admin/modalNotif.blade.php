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

<div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50"
    style="display: none;">
    <div @click.away="showDeleteModal = false"
        class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6 text-center">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
            <i data-lucide="alert-triangle" class="w-8 h-8 text-red-600"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 mb-2">Anda Yakin?</h3>
        <p class="text-slate-600">Data yang telah dihapus tidak dapat dikembalikan lagi. Lanjutkan untuk menghapus
            data ini secara permanen.</p>
        <div class="mt-6 flex justify-center gap-4">
            <button @click="document.querySelector(`form[action='${deleteFormAction}']`).submit()"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 w-1/2">
                Ya, Hapus
            </button>
            <button @click="showDeleteModal = false"
                class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-6 rounded-lg transition-all duration-300 w-1/2">
                Batal
            </button>
        </div>
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

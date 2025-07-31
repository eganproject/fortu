<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;

use App\Models\KategoriSpesifikasi;
use App\Models\Produk;
use App\Models\SpesifikasiProduk;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;


class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = KategoriProduk::all();
        return view('admin.web_preferences.produk.index', compact('kategoris'));
    }

    public function lists(Request $request)
    {
        // Memulai query dengan eager loading untuk efisiensi
        $query = Produk::with(['kategoriProduk', 'spesifikasiProduks'])->select('produks.*');

        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('produks.nama', 'like', "%{$searchValue}%")
                    ->orWhere('produks.deskripsi', 'like', "%{$searchValue}%")
                    ->orWhereHas('kategoriProduk', function ($subq) use ($searchValue) {
                        // Mencari berdasarkan nama kategori di tabel relasi
                        $subq->where('nama_kategori', 'like', "%{$searchValue}%");
                    });
            });
        }

        // --- MENGHITUNG TOTAL DATA ---
        // Hitung total sebelum ada limit/offset
        $totalRecords = Produk::count();
        // Hitung total setelah filter pencarian
        $filteredRecords = $query->count();

        // --- PENGURUTAN (ORDERING) ---
        if ($request->filled('order')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDir = $request->input('order.0.dir');
            $columns = $request->input('columns');
            $orderColumnName = $columns[$orderColumnIndex]['data'];

            // Mapping nama kolom dari DataTables ke nama kolom database
            $columnMap = [
                'nama' => 'nama',
                'kategori' => 'kategori_id', // Akan diurutkan berdasarkan relasi
            ];

            if (isset($columnMap[$orderColumnName])) {
                if ($orderColumnName === 'kategori') {
                    // Pengurutan khusus untuk kolom relasi 'kategoriProduk'
                    $query->join('kategori_produks', 'produks.kategori_id', '=', 'kategori_produks.id')
                        ->orderBy('kategori_produks.nama_kategori', $orderDir)
                        ->select('produks.*'); // Re-select untuk menghindari konflik kolom
                } else {
                    $query->orderBy($columnMap[$orderColumnName], $orderDir);
                }
            }
        } else {
            // Default order jika tidak ada pengurutan dari user
            $query->latest();
        }

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $produks = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($produks as $produk) {
            $data[] = [
                'no' => $no++,
                'id' => $produk->id, // Kirim ID untuk tombol aksi
                'thumbnail' => $produk->thumbnail,
                'nama' => $produk->nama,
                'kategori' => $produk->kategoriProduk->nama_kategori ?? 'N/A',
                'spesifikasi_count' => $produk->spesifikasiProduks->count(),
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }

    public function create()
    {
        $kategoris = KategoriProduk::all();
        $kategoriSpesifikasi = KategoriSpesifikasi::all();
        return view('admin.web_preferences.produk.create', compact('kategoris', 'kategoriSpesifikasi'));
    }
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|uuid|exists:kategori_produks,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'specifications' => 'required|array|min:1',
            'specifications.*.kategori_spesifikasi_id' => 'required|uuid|exists:kategori_spesifikasis,id',
            'specifications.*.spesifikasi' => 'required|string|max:255',
            'specifications.*.deskripsi_spesifikasi' => 'nullable|string',
            'specifications.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ], [
            'specifications.required' => 'Minimal harus ada satu spesifikasi produk.',
            'specifications.min' => 'Minimal harus ada satu spesifikasi produk.',
            'specifications.*.kategori_spesifikasi_id.required' => 'Kategori spesifikasi wajib diisi.',
            'specifications.*.spesifikasi.required' => 'Nama spesifikasi wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Array untuk melacak gambar yang berhasil diunggah
        $uploadedThumbnailPath = null;
        $uploadedImagePaths = [];
        // 2. Memulai Database Transaction
        DB::beginTransaction();

        try {
            // 3. Membuat dan Menyimpan Produk Utama
            $thumbnailPathForDatabase = null;
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = 'thumb_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('asset/product/thumbnails', $fileName, 'public');

                $uploadedThumbnailPath = $path; // Lacak path untuk rollback
                $thumbnailPathForDatabase = $path;
            }
            $produk = Produk::create([
                'kategori_id' => $request->kategori_id,
                'thumbnail' => $thumbnailPathForDatabase,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'status' => 1,
            ]);

            // 4. Memproses dan Menyimpan Setiap Spesifikasi
            foreach ($request->specifications as $specData) {
                $imagePathForDatabase = null;

                // Cek dan proses jika ada file gambar yang diunggah
                if (isset($specData['image']) && $specData['image']->isValid()) {
                    $file = $specData['image'];
                    $fileName = 'spec_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                    // Menggunakan storeAs untuk menyimpan file ke storage/app/public/asset/product
                    // 'public' adalah nama disk
                    $path = $file->storeAs('asset/product/spesifikasi', $fileName, 'public');

                    // Menambahkan path ke array untuk tracking
                    $uploadedImagePaths[] = $path;

                    // Path yang disimpan di database tidak menyertakan 'public'
                    $imagePathForDatabase = $path;
                }

                // Menyimpan data spesifikasi ke database
                SpesifikasiProduk::create([
                    'produk_id' => $produk->id,
                    'kategori_spesifikasi_id' => $specData['kategori_spesifikasi_id'],
                    'spesifikasi' => $specData['spesifikasi'],
                    'deskripsi' => $specData['deskripsi_spesifikasi'],
                    'image' => $imagePathForDatabase,
                ]);
            }
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Produk',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah Produk: ' . $request->nama,
                'ip_address' => request()->ip()
            ]);
            // 5. Commit Transaksi
            DB::commit();

            // 6. Redirect dengan Pesan Sukses
            return redirect('admin/web-preferences/produk')
                ->with('success', 'Produk baru berhasil ditambahkan.');

        } catch (Exception $e) {
            // 7. Rollback Transaksi Jika Terjadi Error
            DB::rollBack();
            if ($uploadedThumbnailPath) {
                Storage::disk('public')->delete($uploadedThumbnailPath);
            }
            // 8. Hapus semua gambar yang sudah terunggah jika terjadi error
            foreach ($uploadedImagePaths as $path) {
                Storage::disk('public')->delete($path);
            }

            // Catat error untuk debugging (opsional, tapi sangat disarankan)
            // Log::error('Gagal menyimpan produk baru: ' . $e->getMessage());

            // 9. Redirect dengan Pesan Error
            return redirect('admin/web-preferences/produk')
                ->with('error', 'Terjadi kesalahan saat menyimpan produk. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function edit($id)
    {
        // 1. Cari produk berdasarkan ID beserta relasinya (spesifikasi)
        // Menggunakan findOrFail akan otomatis menampilkan halaman 404 jika produk tidak ditemukan.
        $produk = Produk::with('spesifikasiProduks')->findOrFail($id);

        // 2. Ambil semua data master untuk form
        // Mengambil semua kategori produk untuk dropdown
        $kategoris = KategoriProduk::orderBy('nama_kategori', 'asc')->get();

        // Mengambil semua kategori spesifikasi untuk dropdown di form dinamis
        $kategoriSpesifikasis = KategoriSpesifikasi::orderBy('nama_kategori', 'asc')->get();

        // 3. Tampilkan view 'edit' dan kirimkan semua data yang diperlukan
        return view('admin.web_preferences.produk.edit', [
            'produk' => $produk,
            'kategoris' => $kategoris,
            'kategoriSpesifikasis' => $kategoriSpesifikasis,
        ]);
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thumbnail opsional saat update
            'kategori_id' => 'required|uuid|exists:kategori_produks,id',
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('produks')->ignore($id), // Nama boleh sama dengan data saat ini, tapi harus unik dari yang lain
            ],
            'deskripsi' => 'nullable|string',
            'specifications' => 'required|array|min:1',
            'specifications.*.id' => 'nullable|uuid|exists:spesifikasi_produks,id', // ID spesifikasi yang sudah ada
            'specifications.*.kategori_spesifikasi_id' => 'required|uuid|exists:kategori_spesifikasis,id',
            'specifications.*.spesifikasi' => 'required|string|max:255',
            'specifications.*.deskripsi_spesifikasi' => 'nullable|string',
            'specifications.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Array untuk melacak file yang baru diunggah dalam transaksi ini
        $newlyUploadedFiles = [];

        // 2. Memulai Database Transaction
        DB::beginTransaction();

        try {
            // Cari produk yang akan diupdate
            $produk = Produk::findOrFail($id);

            // 3. Update Thumbnail Utama (jika ada yang baru)
            $thumbnailPath = $produk->thumbnail;
            if ($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama jika ada
                if ($produk->thumbnail) {
                    Storage::disk('public')->delete($produk->thumbnail);
                }
                // Simpan thumbnail baru
                $file = $request->file('thumbnail');
                $fileName = 'thumb_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $thumbnailPath = $file->storeAs('asset/product/thumbnails', $fileName, 'public');
                $newlyUploadedFiles[] = $thumbnailPath; // Lacak file baru
            }

            // 4. Update Data Produk Utama
            $produk->update([
                'kategori_id' => $request->kategori_id,
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama) . '-' . Str::lower(Str::random(6)),
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $thumbnailPath,
            ]);

            // 5. Sinkronisasi Spesifikasi
            $incomingSpecIds = collect($request->specifications)->pluck('id')->filter();
            $existingSpecs = $produk->spesifikasiProduks;

            // Hapus spesifikasi yang tidak ada lagi di request
            foreach ($existingSpecs as $existingSpec) {
                if (!$incomingSpecIds->contains($existingSpec->id)) {
                    // Hapus gambar terkait jika ada
                    if ($existingSpec->image) {
                        Storage::disk('public')->delete($existingSpec->image);
                    }
                    // Hapus record spesifikasi
                    $existingSpec->delete();
                }
            }

            // Update atau Buat Spesifikasi Baru
            foreach ($request->specifications as $specData) {
                $specImagePath = null;
                $specToUpdate = isset($specData['id']) ? SpesifikasiProduk::find($specData['id']) : null;

                // Jika ada gambar baru diunggah
                if (isset($specData['image']) && $specData['image']->isValid()) {
                    // Hapus gambar lama jika ada
                    if ($specToUpdate && $specToUpdate->image) {
                        Storage::disk('public')->delete($specToUpdate->image);
                    }
                    // Simpan gambar baru
                    $file = $specData['image'];
                    $fileName = 'spec_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                    $specImagePath = $file->storeAs('asset/product/spesifikasi', $fileName, 'public');
                    $newlyUploadedFiles[] = $specImagePath; // Lacak file baru
                } else {
                    // Jika tidak ada gambar baru, pertahankan gambar lama
                    $specImagePath = $specToUpdate->image ?? null;
                }

                // Gunakan updateOrCreate untuk menangani update dan create sekaligus
                SpesifikasiProduk::updateOrCreate(
                    ['id' => $specData['id'] ?? null], // Kondisi pencarian
                    [ // Data untuk diupdate atau dibuat
                        'produk_id' => $produk->id,
                        'kategori_spesifikasi_id' => $specData['kategori_spesifikasi_id'],
                        'spesifikasi' => $specData['spesifikasi'],
                        'deskripsi' => $specData['deskripsi_spesifikasi'],
                        'image' => $specImagePath,
                    ]
                );
            }
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Produk',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Produk: ' . $produk->nama,
                'ip_address' => request()->ip()
            ]);

            // 6. Commit Transaksi
            DB::commit();

            return redirect('admin/web-preferences/produk')->with('success', 'Produk berhasil diperbarui.');

        } catch (Exception $e) {
            // 7. Rollback Transaksi Jika Terjadi Error
            DB::rollBack();

            // Hapus semua file yang BARU diunggah dalam transaksi yang gagal ini
            foreach ($newlyUploadedFiles as $path) {
                Storage::disk('public')->delete($path);
            }

            // Redirect dengan pesan error
            return redirect('admin/web-preferences/produk')
                ->with('error', 'Terjadi kesalahan saat memperbarui produk: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Cari produk beserta relasi spesifikasinya
            $produk = Produk::with('spesifikasiProduks')->findOrFail($id);

            // 1. Hapus gambar thumbnail utama dari storage
            if ($produk->thumbnail) {
                Storage::disk('public')->delete($produk->thumbnail);
            }

            // 2. Hapus semua gambar spesifikasi terkait dari storage
            foreach ($produk->spesifikasiProduks as $spec) {
                if ($spec->image) {
                    Storage::disk('public')->delete($spec->image);
                }
            }

            // 3. Hapus record produk dari database.
            // Relasi (spesifikasi) akan terhapus otomatis jika menggunakan onDelete('cascade') di migrasi.
            // Jika tidak, Anda bisa menghapusnya manual: $produk->spesifikasiProduks()->delete();
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Produk',
                'aksi' => 'Hapus',
                'deskripsi' => 'Menghapus Produk: ' . $produk->nama,
                'ip_address' => request()->ip()
            ]);

            $produk->spesifikasiProduks()->delete();
            $produk->delete();

            // 4. Commit transaksi jika semua berhasil
            DB::commit();

            return redirect('admin/web-preferences/produk')->with('success', 'Produk berhasil dihapus.');

        } catch (Exception $e) {
            // 5. Rollback transaksi jika terjadi error
            DB::rollBack();

            return redirect('admin/web-preferences/produk')
                ->with('error', 'Terjadi kesalahan saat menghapus produk: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KategoriProduk;
use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;

class KategoriProdukController extends Controller
{
    public function index()
    {
        // Logic to display the list of product categories
        return view('admin.web_preferences.kategoriproduk.index');
    }

    public function lists(Request $request)
    {
        $query = KategoriProduk::select('kategori_produks.*');


        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('nama_kategori', 'like', "%{$searchValue}%");
            });
        }

        // --- PENGURUTAN (ORDERING) ---
        if ($request->filled('order')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDir = $request->input('order.0.dir');
            $columns = $request->input('columns');
            $orderColumnName = $columns[$orderColumnIndex]['data'];

            // Mapping nama kolom dari DataTables ke nama kolom database
            $columnMap = [
                'nama_kategori' => 'nama_kategori',
                'layout' => 'layout',
            ];

            if (isset($columnMap[$orderColumnName])) {
                $query->orderBy($columnMap[$orderColumnName], $orderDir);
            }
        }

        // --- MENGHITUNG TOTAL DATA ---
        $totalRecords = KategoriProduk::count();
        $filteredRecords = $query->count();

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $kategoris = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($kategoris as $kategori) {
            $data[] = [
                'no' => $no++,
                'nama_kategori' => $kategori->nama_kategori,
                'deskripsi' => $kategori->deskripsi,
                'layout' => $kategori->layout . " Layout",
                'aksi' => $kategori->id
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
        // Logic to show the form for creating a new product category
        return view('admin.web_preferences.kategoriproduk.create');
    }


    public function store(Request $request)
    {
        // Logic to store a new product category
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'layout' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            // Create the category
            KategoriProduk::create($request->all());
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Kategori Produk',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah Kategori Produk : ' . $request->nama_kategori,
                'ip_address' => request()->ip()
            ]);
            DB::commit();

            return redirect('/admin/web-preferences/kategori')->with('success', 'Kategori Produk berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin/web-preferences/kategori')->withErrors(['error' => 'Terjadi kesalahan saat membuat kategori produk.']);
        }
    }

    public function edit($id)
    {
        // Logic to show the form for editing a product category
        $kategori = KategoriProduk::findOrFail($id);
        return view('admin.web_preferences.kategoriproduk.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        // Logic to store a new product category
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'layout' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            // Update the category
            KategoriProduk::findOrFail($id)->update($request->all());
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Kategori Produk',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Kategori Produk : ' . $request->nama_kategori,
                'ip_address' => request()->ip()
            ]);
            DB::commit();

            return redirect('/admin/web-preferences/kategori')->with('success', 'Kategori Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin/web-preferences/kategori')->withErrors(['error' => 'Terjadi kesalahan saat memperbarui kategori produk.']);
        }
    }

    public function destroy($id)
    {
        // Logic to delete a product category
        try {
            DB::beginTransaction();

            $kategori = KategoriProduk::findOrFail($id);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Kategori Produk',
                'aksi' => 'Hapus',
                'deskripsi' => 'Menghapus Kategori Produk : ' . $kategori->nama_kategori,
                'ip_address' => request()->ip()
            ]);
            $kategori->delete();

            DB::commit();

            return redirect('/admin/web-preferences/kategori')->with('success', 'Kategori Produk berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin/web-preferences/kategori')->withErrors(['error' => 'Terjadi kesalahan saat menghapus kategori produk.']);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\UserActivity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogArticleController extends Controller
{
    public function index()
    {
        $blog = BlogArticle::first();
        return view('admin.web_preferences.blog.index', compact('blog'));
    }

    public function lists(Request $request)
    {
        $query = BlogArticle::with('user')->select('blog_articles.*')->orderByDesc('blog_articles.tanggal');


        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('blog_articles.title', 'like', "%{$searchValue}%")
                    ->orWhere('blog_articles.text', 'like', "%{$searchValue}%")
                    ->orWhere('blog_articles.tanggal', 'like', "%{$searchValue}%")
                    ->orWhereHas('user', function ($subq) use ($searchValue) {
                        // Mencari berdasarkan nama penulis di tabel relasi
                        $subq->where('name', 'like', "%{$searchValue}%");
                    });
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
                'tanggal' => 'tanggal',
                'judul' => 'title',
                'penulis' => 'uuid_writer', // Kita akan urutkan berdasarkan relasi di bawah
                'status' => 'views', // Contoh: urutkan status berdasarkan views
            ];

            if (isset($columnMap[$orderColumnName])) {
                if ($orderColumnName === 'penulis') {
                    // Pengurutan khusus untuk kolom relasi
                    $query->join('users', 'blog_articles.uuid_writer', '=', 'users.id')
                        ->orderBy('users.name', $orderDir)
                        ->select('blog_articles.*'); // Re-select untuk menghindari konflik
                } else {
                    $query->orderBy($columnMap[$orderColumnName], $orderDir);
                }
            }
        }

        // --- MENGHITUNG TOTAL DATA ---
        $totalRecords = BlogArticle::count();
        $filteredRecords = $query->count();

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $articles = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($articles as $article) {
            $data[] = [
                'no' => $no++,
                'tanggal' => \Carbon\Carbon::parse($article->tanggal)->format('d M Y, H:i'),
                'judul' => $article->title,
                // Pastikan path gambar benar
                'gambar' => asset('public/storage/' . $article->image),
                'artikel' => $article->text,
                // Ambil nama penulis dari relasi, beri fallback jika tidak ada
                'penulis' => $article->user->name ?? 'N/A',
                // Contoh logika status berdasarkan jumlah views
                'status' => '<div class="flex items-center space-x-2">
                    <i data-lucide="eye" class="w-4 h-4 text-gray-500" title="Views"></i>
                    <span class="text-gray-500">' . $article->views . '</span>
                    <i data-lucide="message-circle" class="w-4 h-4 text-gray-500" title="Komentar"></i>
                    <span class="text-gray-500">' . $article->comments . '</span>
                    <i data-lucide="thumbs-up" class="w-4 h-4 text-gray-500" title="Suka"></i>
                    <span class="text-gray-500">' . $article->likes . '</span>
                </div>',
                // Tombol aksi (edit, delete, dll)
                'aksi' => $article->id
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
        return view('admin.web_preferences.blog.create');
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $data = $request->only(['title', 'text']);
            $data['tanggal'] = date('Y-m-d H:i:s');
            $data['uuid_writer'] = auth()->id();

            if ($request->hasFile('image')) {
                $image1 = $request->file('image');
                $image1Name = Str::slug($request->modul) . '-1-' . time() . '.' . $image1->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImage1Path = $image1->storeAs('blog-images', $image1Name, 'public');
                $data['image'] = 'blog-images/' . $image1Name;
            }

            BlogArticle::create($data);

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Blog',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah Post Blog : ' . $request->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/blog')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($uploadedImage1Path) {
                Storage::disk('public')->delete($uploadedImage1Path);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $blog = BlogArticle::find($id);
        return view('admin.web_preferences.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);


        $post = BlogArticle::findOrFail($id);

        DB::beginTransaction();
        $uploadedImage1Path = null;

        try {
            $data = $request->only(['title', 'text']);
            // 'tanggal' diupdate untuk mencerminkan waktu modifikasi terakhir
            $data['tanggal'] = date('Y-m-d H:i:s');
            // 'uuid_writer' tidak perlu diubah karena penulisnya tetap sama

            // 2. Cek apakah ada file gambar baru yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar lama dari storage jika ada
                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }

                // Proses dan simpan gambar baru
                $image1 = $request->file('image');
                // Menggunakan Str::slug dari title untuk nama file yang konsisten
                $image1Name = Str::slug($request->title) . '-' . time() . '.' . $image1->getClientOriginalExtension();

                // Simpan file baru dan catat path-nya untuk kemungkinan rollback
                $uploadedImage1Path = $image1->storeAs('blog-images', $image1Name, 'public');
                $data['image'] = $uploadedImage1Path;
            }

            // 3. Update data post di database
            $post->update($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Blog',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Post Blog : ' . $request->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/blog')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Jika terjadi error SETELAH gambar baru diunggah, hapus gambar baru tersebut
            if ($uploadedImage1Path) {
                Storage::disk('public')->delete($uploadedImage1Path);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $blog = BlogArticle::find($id);
        DB::beginTransaction();
        try {
            $path1 = $blog->image;

            // Hapus record dari database terlebih dahulu
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Blog',
                'aksi' => 'Hapus',
                'deskripsi' => 'Menghapus Post Blog : ' . $blog->title,
                'ip_address' => request()->ip()
            ]);

            $blog->delete();

            // Hapus file dari storage setelah record DB berhasil dihapus
            if ($path1) {
                // Memberitahu Laravel untuk menghapus dari disk 'public'
                Storage::disk('public')->delete($path1);
            }


            // Jika semua berhasil, commit transaksi
            DB::commit();


            return  redirect('admin/web-preferences/blog')->with('success', 'Hero Image berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika ada error, batalkan penghapusan record DB
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}

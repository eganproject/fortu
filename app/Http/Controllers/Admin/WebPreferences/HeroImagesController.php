<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;
use App\Models\HeroImages;
use App\Models\UserActivity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HeroImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroImages = HeroImages::latest()->get();
        return view('admin.web_preferences.hero.index', compact('heroImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.web_preferences.hero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'modul' => 'required|string|max:255|unique:hero_images,modul',
            'text' => 'nullable|string',
            'image_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Memulai transaksi database
        DB::beginTransaction();

        $uploadedImage1Path = null;
        $uploadedImage2Path = null;

        try {
            $data = $request->only(['title', 'modul', 'text']);

            // Handle Image 1 upload
            if ($request->hasFile('image_1')) {
                $image1 = $request->file('image_1');
                $image1Name = Str::slug($request->modul) . '-1-' . time() . '.' . $image1->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImage1Path = $image1->storeAs('hero-images', $image1Name, 'public');
                $data['image_1'] = 'hero-images/' . $image1Name;
            }

            // Handle Image 2 upload
            if ($request->hasFile('image_2')) {
                $image2 = $request->file('image_2');
                $image2Name = Str::slug($request->modul) . '-2-' . time() . '.' . $image2->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImage2Path = $image2->storeAs('hero-images', $image2Name, 'public');
                $data['image_2'] = 'hero-images/' . $image2Name;
            }

            // Membuat record di database
            HeroImages::create($data); // Menggunakan model HeroImage

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Hero Image',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambahkan Hero Image: ' . $request->modul,
                'ip_address' => request()->ip()
            ]);

            // Jika semua berhasil, commit transaksi
            DB::commit();

            return redirect('admin/web-preferences/hero')->with('success', 'Hero Image berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Jika terjadi error, batalkan semua perubahan
            DB::rollBack();
            // Hapus file yang sudah terlanjur di-upload untuk mencegah file sampah
            if ($uploadedImage1Path) {
                Storage::disk('public')->delete($uploadedImage1Path);
            }
            if ($uploadedImage2Path) {
                Storage::disk('public')->delete($uploadedImage2Path);
            }

            // Catat error untuk debugging
            Log::error('Gagal menyimpan Hero Image: ' . $e->getMessage());

            // Redirect kembali ke form dengan pesan error
            return redirect('admin/web-preferences/hero')->withInput()->with('error', 'Terjadi kesalahan. Gagal menambahkan Hero Image.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroImages $heroImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $heroImage = HeroImages::find($id);

        return view('admin.web_preferences.hero.edit', compact('heroImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $heroImage = HeroImages::find($request->id);
        // Disarankan untuk menambahkan transaksi di sini juga
        $request->validate([
            'modul' => 'required|string|max:255',
            'title' => 'nullable|string',
            'text' => 'nullable|string',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        DB::beginTransaction();
        $uploadedImage1Path = null;
        $uploadedImage2Path = null;

        try {
            $data = $request->only(['title', 'modul', 'text']);

            if ($request->hasFile('image_1')) {
                if ($heroImage->image_1) {
                    Storage::disk('public')->delete($heroImage->image_1);
                }
                $image1 = $request->file('image_1');
                $image1Name = Str::slug($request->modul) . '-1-' . time() . '.' . $image1->getClientOriginalExtension();
                $uploadedImage1Path =  $image1->storeAs('hero-images', $image1Name, 'public');
                $data['image_1'] = 'hero-images/' . $image1Name;
            }

            if ($request->hasFile('image_2')) {
                if ($heroImage->image_2) {
                    Storage::disk('public')->delete($heroImage->image_2);
                }
                $image2 = $request->file('image_2');
                $image2Name = Str::slug($request->modul) . '-2-' . time() . '.' . $image2->getClientOriginalExtension();
                $uploadedImage2Path = $image2->storeAs('hero-images', $image2Name, 'public');
                $data['image_2'] = 'hero-images/' . $image2Name;
            }

            $heroImage->update($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Hero Image',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Hero Image: ' . $request->modul,
                'ip_address' => request()->ip()
            ]);

            // Jika semua berhasil, commit transaksi
            DB::commit();
            return redirect('/admin/web-preferences/hero')->with('success', 'Hero Image berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi error, batalkan semua perubahan
            DB::rollBack();
            // Hapus file yang sudah terlanjur di-upload untuk mencegah file sampah
            if ($uploadedImage1Path) {
                Storage::disk('public')->delete($uploadedImage1Path);
            }
            if ($uploadedImage2Path) {
                Storage::disk('public')->delete($uploadedImage2Path);
            }

            // Catat error untuk debugging
            Log::error('Gagal menyimpan Hero Image: ' . $e->getMessage());

            // Redirect kembali ke form dengan pesan error
            return redirect('admin/web-preferences/hero')->withInput()->with('error', 'Terjadi kesalahan. Gagal menambahkan Hero Image.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $heroImage = HeroImages::find($id);
        DB::beginTransaction();
        try {
            $path1 = $heroImage->image_1;
            $path2 = $heroImage->image_2;

            // Hapus record dari database terlebih dahulu
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Hero Image',
                'aksi' => 'Hapus',
                'deskripsi' => 'Hapus Hero Image: ' . $heroImage->modul,
                'ip_address' => request()->ip()
            ]);
            $heroImage->delete();

            // Hapus file dari storage setelah record DB berhasil dihapus
            if ($path1) {
                // Memberitahu Laravel untuk menghapus dari disk 'public'
                Storage::disk('public')->delete($path1);
            }
            if ($path2) {
                Storage::disk('public')->delete($path2);
            }


            // Jika semua berhasil, commit transaksi
            DB::commit();


            return  redirect('admin/web-preferences/hero')->with('success', 'Hero Image berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika ada error, batalkan penghapusan record DB
            DB::rollBack();
            Log::error('Gagal menghapus Hero Image: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}

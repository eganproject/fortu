<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;

use App\Models\CarouselIndex;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarouselIndexController extends Controller
{
        public function index()
    {
        $carousel = CarouselIndex::latest()->get();
        return view('admin.web_preferences.carousel.index', compact('carousel'));
    }

        public function create()
    {
        return view('admin.web_preferences.carousel.create');
    }

    public function store(Request $request){
        DB::beginTransaction();
        $uploadedImagePath = null;
        try {

            

            // Handle Image 2 upload
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = Str::slug($request->modul) . '-2-' . time() . '.' . $image->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImagePath = $image->storeAs('carousel', $imageName, 'public');
                $data['images'] = 'carousel/' . $imageName;
            }

            // Membuat record di database
            CarouselIndex::create($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Carousel',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah Gambar Carousel : ' . $request->id,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/carousel')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($uploadedImagePath) {
                Storage::disk('public')->delete($uploadedImagePath);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $carousel = CarouselIndex::findOrFail($id);
            if ($carousel->images) {
                Storage::disk('public')->delete($carousel->images);
            }
           
            $carousel->delete();
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Carousel',
                'aksi' => 'Hapus',
                'deskripsi' => 'Menghapus Gambar Carousel : ' . $carousel->id,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/carousel')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update($id, Request $request){
        $carousel = CarouselIndex::findOrFail($id);
        $carousel->update($request->all());
        UserActivity::create([
            'user_id' => auth()->user()->id,
            'modul' => 'Carousel',
            'aksi' => 'Ubah',
            'deskripsi' => 'Mengubah Status Carousel : ' . $carousel->id,
            'ip_address' => request()->ip()
        ]);
        return redirect('admin/web-preferences/carousel')->with('success', 'Data berhasil diubah.');
    }
}

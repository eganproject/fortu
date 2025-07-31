<?php


namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;
use App\Models\Sorotan;
use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SorotanController extends Controller
{
    public function index()
    {
        $sorotan = Sorotan::latest()->get();
        return view('admin.web_preferences.sorotan.index', compact('sorotan'));
    }

    public function create()
    {
        return view('admin.web_preferences.sorotan.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $uploadedImagePath = null;
        try {

            $data = $request->only(['title', 'subtitle']);

            // Handle Image 2 upload
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = Str::slug($request->title) . '-2-' . time() . '.' . $image->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImagePath = $image->storeAs('sorotan', $imageName, 'public');
                $data['images'] = 'sorotan/' . $imageName;
            }

            // Membuat record di database
            Sorotan::create($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Sorotan',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah Gambar Sorotan : ' . $request->id,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/sorotan')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($uploadedImagePath) {
                Storage::disk('public')->delete($uploadedImagePath);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $sorotan = Sorotan::findOrFail($id);
        return view('admin.web_preferences.sorotan.edit', compact('sorotan'));
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        $uploadedImagePath = null;
        try {
            $data = $request->only(['title', 'subtitle']);
            $sorotan = Sorotan::findOrFail($id);
            // Handle Image upload
            if ($request->hasFile('images')) {
                if ($sorotan->images) {
                    Storage::disk('public')->delete($sorotan->images);
                }
                $image = $request->file('images');
                $imageName = Str::slug($request->title) . '-2-' . time() . '.' . $image->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImagePath = $image->storeAs('sorotan', $imageName, 'public');
                $data['images'] = 'sorotan/' . $imageName;
            }



            // Hapus gambar lama jika ada


            $sorotan->update($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Sorotan',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Gambar Sorotan : ' . $id,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/sorotan')->with('success', 'Data berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($uploadedImagePath) {
                Storage::disk('public')->delete($uploadedImagePath);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $sorotan = Sorotan::findOrFail($id);
        $sorotan->delete();
        Storage::disk('public')->delete($sorotan->images);
        return redirect('admin/web-preferences/sorotan')->with('success', 'Berhasil Menghapus Data');
    }
}

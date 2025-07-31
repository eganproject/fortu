<?php
namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;
use App\Models\ClientExperience;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientExperienceController extends Controller
{
     public function index()
    {
        // Logic to display the list of product categories
        return view('admin.web_preferences.clientexperience.index');
    }

    public function lists(Request $request)
    {
        $query = ClientExperience::select('client_experiences.*');

        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('title', 'like', "%{$searchValue}%")
                  ->orWhere('description', 'like', "%{$searchValue}%");
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
                'title' => 'title',
                'slug' => 'slug',
            ];

            if (isset($columnMap[$orderColumnName])) {
                $query->orderBy($columnMap[$orderColumnName], $orderDir);
            }
        }

        // --- MENGHITUNG TOTAL DATA ---
        $totalRecords = ClientExperience::count();
        $filteredRecords = $query->count();

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $clientExperiences = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($clientExperiences as $clientExperience) {
            $data[] = [
                'no' => $no++,
                'title' => $clientExperience->title,
                'description' => $clientExperience->description,
                'logo' => $clientExperience->logo,
                'image' => $clientExperience->image,
                'aksi' => $clientExperience->id
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
        return view('admin.web_preferences.clientexperience.create');
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        $uploadedLogoPath = null;
        $uploadedImagePath = null;
        try {
            $data = $request->only(['title', 'description']);

            // Handle Logo
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = Str::slug($request->title) . '-1-' . time() . '.' . $logo->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedLogoPath = $logo->storeAs('clientexperience', $logoName, 'public');
                $data['logo'] = 'clientexperience/' . $logoName;
            }

            // Handle Image 2 upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::slug($request->modul) . '-2-' . time() . '.' . $image->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImagePath = $image->storeAs('clientexperience', $imageName, 'public');
                $data['image'] = 'clientexperience/' . $imageName;
            }

            // Membuat record di database
            ClientExperience::create($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Client Experience',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah Client Experience : ' . $request->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/client-experience')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($uploadedLogoPath) {
                Storage::disk('public')->delete($uploadedLogoPath);
            }
            if ($uploadedImagePath) {
                Storage::disk('public')->delete($uploadedImagePath);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
public function edit($id)
    {
        $clientExperience = ClientExperience::findOrFail($id);
        return view('admin.web_preferences.clientexperience.edit', compact('clientExperience'));
    }

     public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $uploadedLogoPath = null;
        $uploadedImagePath = null;
        try {
            $clientExperience = ClientExperience::findOrFail($id);
            $data = $request->only(['title', 'description']);

            // Handle Logo
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = Str::slug($request->title) . '-1-' . time() . '.' . $logo->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedLogoPath = $logo->storeAs('clientexperience', $logoName, 'public');
                $data['logo'] = 'clientexperience/' . $logoName;
                // Delete old logo if exists
                if ($clientExperience->logo) {
                    Storage::disk('public')->delete($clientExperience->logo);
                }
            }

            // Handle Image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Str::slug($request->title) . '-2-' . time() . '.' . $image->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImagePath = $image->storeAs('clientexperience', $imageName, 'public');
                $data['image'] = 'clientexperience/' . $imageName;
                // Delete old image if exists
                if ($clientExperience->image) {
                    Storage::disk('public')->delete($clientExperience->image);
                }
            }

            // Update record in database
            $clientExperience->update($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Client Experience',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Client Experience : ' . $request->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/client-experience')->with('success', 'Data berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($uploadedLogoPath) {
                Storage::disk('public')->delete($uploadedLogoPath);
            }
            if ($uploadedImagePath) {
                Storage::disk('public')->delete($uploadedImagePath);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $clientExperience = ClientExperience::findOrFail($id);
            // Delete logo and image if they exist
            if ($clientExperience->logo) {
                Storage::disk('public')->delete($clientExperience->logo);
            }
            if ($clientExperience->image) {
                Storage::disk('public')->delete($clientExperience->image);
            }
            $clientExperience->delete();

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Client Experience',
                'aksi' => 'Hapus',
                'deskripsi' => 'Menghapus Client Experience : ' . $clientExperience->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/client-experience')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

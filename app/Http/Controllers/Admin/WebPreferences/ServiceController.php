<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {

        // Logic to display the list of services
        return view('admin.web_preferences.services.index');
    }

    public function lists(Request $request)
    {
        $query = Service::select('services.*');


        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('services.title', 'like', "%{$searchValue}%")
                    ->orWhere('services.subtitle', 'like', "%{$searchValue}%")
                    ->orWhere('services.description', 'like', "%{$searchValue}%");
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
                'subtitle' => 'subtitle',
                'description' => 'description',
            ];

            if (isset($columnMap[$orderColumnName])) {
                $query->orderBy($columnMap[$orderColumnName], $orderDir);
            }
        }

        // --- MENGHITUNG TOTAL DATA ---
        $totalRecords = Service::count();
        $filteredRecords = $query->count();

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $services = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($services as $service) {
            $data[] = [
                'no' => $no++,
                'title' => $service->title,
                'subtitle' => $service->subtitle,
                'description' => $service->description,
                'image_1' => $service->image_1,
                'image_2' => $service->image_2,
                // Tombol aksi (edit, delete, dll)
                'aksi' => $service->id
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
        return view('admin.web_preferences.services.create');
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        $uploadedImage1Path = null;
        $uploadedImage2Path = null;
        try {
            $data = $request->only(['title', 'subtitle', 'description']);

            // Handle Logo
            if ($request->hasFile('image_1')) {
                $image_1 = $request->file('image_1');
                $image_1Name = Str::slug($request->title) . '-1-' . time() . '.' . $image_1->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImage1Path = $image_1->storeAs('servicesImg', $image_1Name, 'public');
                $data['image_1'] = 'servicesImg/' . $image_1Name;
            }

            // Handle Image 2 upload
            if ($request->hasFile('image_2')) {
                $image_2 = $request->file('image_2');
                $image_2Name = Str::slug($request->modul) . '-2-' . time() . '.' . $image_2->getClientOriginalExtension();
                // Simpan file dan catat path-nya untuk kemungkinan rollback
                $uploadedImage2Path = $image_2->storeAs('servicesImg', $image_2Name, 'public');
                $data['image_2'] = 'servicesImg/' . $image_2Name;
            }

            // Membuat record di database
            Service::create($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Services',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah Services : ' . $request->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/services')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($uploadedImage1Path) {
                Storage::disk('public')->delete($uploadedImage1Path);
            }
            if ($uploadedImage2Path) {
                Storage::disk('public')->delete($uploadedImage2Path);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.web_preferences.services.edit', compact('service'));
    }


    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        DB::beginTransaction();
        $uploadedImage1Path = null;
        $uploadedImage2Path = null;
        try {
            $data = $request->only(['title', 'subtitle', 'description']);

            // Handle Logo
            if ($request->hasFile('image_1')) {
                if ($service->image_1) {
                    Storage::disk('public')->delete($service->image_1);
                }
                $image1 = $request->file('image_1');
                $image1Name = Str::slug($request->title) . '-1-' . time() . '.' . $image1->getClientOriginalExtension();
                $uploadedImage1Path = $image1->storeAs('servicesImg', $image1Name, 'public');
                $data['image_1'] = 'servicesImg/' . $image1Name;
            }

            if ($request->hasFile('image_2')) {
                if ($service->image_2) {
                    Storage::disk('public')->delete($service->image_2);
                }
                $image2 = $request->file('image_2');
                $image2Name = Str::slug($request->title) . '-2-' . time() . '.' . $image2->getClientOriginalExtension();
                $uploadedImage2Path = $image2->storeAs('servicesImg', $image2Name, 'public');
                $data['image_2'] = 'servicesImg/' . $image2Name;
            }


            // Membuat record di database
            Service::where('id', $id)->update($data);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Services',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Services : ' . $request->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/services')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($uploadedImage1Path) {
                Storage::disk('public')->delete($uploadedImage1Path);
            }
            if ($uploadedImage2Path) {
                Storage::disk('public')->delete($uploadedImage2Path);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $service = Service::findOrFail($id);
            // Delete logo and image if they exist
            if ($service->image_1) {
                Storage::disk('public')->delete($service->image_1);
            }
            if ($service->image_2) {
                Storage::disk('public')->delete($service->image_2);
            }
            $service->delete();

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Services',
                'aksi' => 'Hapus',
                'deskripsi' => 'Menghapus Services : ' . $service->title,
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect('admin/web-preferences/services')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


}

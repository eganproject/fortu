<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('admin.web_preferences.about.index', compact('aboutUs'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only(['text']);
            $data['user_id'] = auth()->id();

            $request->validate([]);

            // Check if there is existing data in the AboutUs model
            $aboutUs = AboutUs::first();

            if ($aboutUs) {
                // Update the existing record
                UserActivity::create([
                    'user_id' => auth()->user()->id,
                    'modul' => 'About Us',
                    'aksi' => 'Ubah',
                    'deskripsi' => 'Ubah About Us: ',
                    'ip_address' => request()->ip()
                ]);
                $aboutUs->update($data);
            } else {
                UserActivity::create([
                    'user_id' => auth()->user()->id,
                    'modul' => 'About Us',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Tambah About Us: ',
                    'ip_address' => request()->ip()
                ]);
                // Create a new record if not found
                AboutUs::create($data);
            }

            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

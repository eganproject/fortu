<?php

namespace App\Http\Controllers\Admin\WebPreferences;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyInformationController extends Controller
{
    public function index()
    {
        $comIn = CompanyInformation::first();
        return view("admin.web_preferences.company_information.index", compact("comIn"));
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        $uploadedLogoPath = null;
        try {
            $data = $request->all();
            $data['user_id'] = auth()->id();

            $request->validate([]);

            // Check if there is existing data in the CompanyInformation model
            $comIn = CompanyInformation::first();

            if ($comIn) {
                if ($comIn->company_logo && $request->hasFile('company_logo')) {
                    // Delete the old company_logo first
                    Storage::disk('public')->delete($comIn->company_logo);

                    $company_logo = $request->file('company_logo');
                    $company_logoName = Str::slug($request->modul) . '-1-' . time() . '.' . $company_logo->getClientOriginalExtension();
                    // Simpan file dan catat path-nya untuk kemungkinan rollback
                    $uploadedcompany_logoPath = $company_logo->storeAs('company_logothumb', $company_logoName, 'public');
                    $data['company_logo'] = 'company_logothumb/' . $company_logoName;
                }

                  if ($comIn->company_header && $request->hasFile('company_header')) {
                    // Delete the old company_header first
                    Storage::disk('public')->delete($comIn->company_header);

                    $company_header = $request->file('company_header');
                    $company_headerName = Str::slug($request->modul) . '-1-' . time() . '.' . $company_header->getClientOriginalExtension();
                    // Simpan file dan catat path-nya untuk kemungkinan rollback
                    $uploadedcompany_headerPath = $company_header->storeAs('company_headerthumb', $company_headerName, 'public');
                    $data['company_header'] = 'company_headerthumb/' . $company_headerName;
                }
                // Update the existing record
                UserActivity::create([
                    'user_id' => auth()->user()->id,
                    'modul' => 'Company Information',
                    'aksi' => 'Ubah',
                    'deskripsi' => 'Ubah Company Information: ' . $request->text,
                    'ip_address' => request()->ip()
                ]);
                $comIn->update($data);
            } else {
                if ($request->hasFile('company_logo')) {
                    $company_logo = $request->file('company_logo');
                    $company_logoName = Str::slug($request->modul) . '-1-' . time() . '.' . $company_logo->getClientOriginalExtension();
                    // Simpan file dan catat path-nya untuk kemungkinan rollback
                    $uploadedcompany_logoPath = $company_logo->storeAs('company_logothumb', $company_logoName, 'public');
                    $data['company_logo'] = 'company_logothumb/' . $company_logoName;
                }
                if ($request->hasFile('company_header')) {
                    $company_header = $request->file('company_header');
                    $company_headerName = Str::slug($request->modul) . '-1-' . time() . '.' . $company_header->getClientOriginalExtension();
                    // Simpan file dan catat path-nya untuk kemungkinan rollback
                    $uploadedcompany_headerPath = $company_header->storeAs('company_headerthumb', $company_headerName, 'public');
                    $data['company_header'] = 'company_headerthumb/' . $company_headerName;
                }
                UserActivity::create([
                    'user_id' => auth()->user()->id,
                    'modul' => 'Company Information',
                    'aksi' => 'Tambah',
                    'deskripsi' => 'Tambah Company Information: ' . $request->text,
                    'ip_address' => request()->ip()
                ]);
                // Create a new record if not found
                CompanyInformation::create($data);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($uploadedcompany_logoPath) {
                Storage::disk('public')->delete($uploadedcompany_logoPath);
            }
            if ($uploadedcompany_headerPath) {
                Storage::disk('public')->delete($uploadedcompany_headerPath);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

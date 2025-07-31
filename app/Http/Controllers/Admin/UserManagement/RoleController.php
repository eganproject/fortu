<?php


namespace App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.user_management.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.user_management.role.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
            ]);

            $role = new Role();
            $role->name = $request->name;
            $role->deskripsi = $request->deskripsi;
            $role->save();

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Role',
                'aksi' => 'Tambah',
                'deskripsi' => 'Tambah Role: ' . $request->name,
                'ip_address' => request()->ip()
            ]);



            DB::commit();

            return redirect('admin/user-management/role')->with([
                'success' => 'Berhasil menambahkan role baru'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('admin/user-management/role')->with([
                'error' => 'Gagal menambahkan role baru: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('admin.user_management.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
            ]);

            $role = Role::find($id);
            $role->name = $request->name;
            $role->deskripsi = $request->deskripsi;
            $role->save();

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'Role',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah Role: ' . $request->name,
                'ip_address' => request()->ip()
            ]);



            DB::commit();

            return redirect('admin/user-management/role')->with([
                'success' => 'Berhasil mengupdate role'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('admin/user-management/role')->with([
                'error' => 'Gagal mengupdate role: ' . $e->getMessage()
            ]);
        }
    }

public function destroy($id)
{
    DB::beginTransaction();
    try {
        $role = Role::findOrFail($id);
        $role->delete();

        UserActivity::create([
            'user_id' => auth()->user()->id,
            'modul' => 'Role',
            'aksi' => 'Hapus',
            'deskripsi' => 'Menghapus Role: ' . $role->name,
            'ip_address' => request()->ip()
        ]);

        DB::commit();

        return redirect('admin/user-management/role')->with([
            'success' => 'Berhasil menghapus role'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect('admin/user-management/role')->with([
            'error' => 'Gagal menghapus role: ' . $e->getMessage()
        ]);
    }
}

}

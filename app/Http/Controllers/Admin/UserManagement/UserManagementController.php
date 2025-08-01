<?php

namespace App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\Controller;
use App\Models\Role;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('admin.user_management.user.index');
    }

    public function lists(Request $request)
    {
        $query = User::with('role')->select('users.*');

        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('users.name', 'like', "%{$searchValue}%")
                    ->orWhere('users.email', 'like', "%{$searchValue}%");
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
                'name' => 'name',
                'email' => 'email',
                'role' => 'role_id',
            ];

            if (isset($columnMap[$orderColumnName])) {
                $query->orderBy($columnMap[$orderColumnName], $orderDir);
            }
        }

        // --- MENGHITUNG TOTAL DATA ---
        $totalRecords = User::count();
        $filteredRecords = $query->count();

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $users = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($users as $user) {
            $data[] = [
                'no' => $no++,
                'name' => $user->name,
                'email' => $user->email,
                // Ambil nama role dari relasi, beri fallback jika tidak ada
                'role' => $user->role->name ?? 'N/A',
                // Tombol aksi (edit, delete, dll)
                'aksi' => $user->id
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
        $roles = Role::all();
        return view('admin.user_management.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'role_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Simpan user baru ke database
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id
            ]);
            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'User',
                'aksi' => 'Tambah',
                'deskripsi' => 'Menambah User: ' . $request->name,
                'ip_address' => request()->ip()
            ]);

            DB::commit();

            return redirect('admin/user-management/users')->with([
                'success' => 'Berhasil menambahkan user baru'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'error' => 'Gagal menambahkan user baru: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.user_management.user.edit', compact('roles', 'user'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'role_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->role_id = $request->role_id;
            $user->save();

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'User',
                'aksi' => 'Ubah',
                'deskripsi' => 'Mengubah User: ' . $request->name,
                'ip_address' => request()->ip()
            ]);

            DB::commit();

            return redirect('admin/user-management/users')->with([
                'success' => 'Berhasil mengupdate user'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'error' => 'Gagal mengupdate user: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->delete();

            UserActivity::create([
                'user_id' => auth()->user()->id,
                'modul' => 'User',
                'aksi' => 'Hapus',
                'deskripsi' => 'Menghapus User: ' . $user->name,
                'ip_address' => request()->ip()
            ]);

            DB::commit();

            return redirect('admin/user-management/users')->with([
                'success' => 'Berhasil menghapus user'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'error' => 'Gagal menghapus user: ' . $e->getMessage()
            ]);
        }
    }

}

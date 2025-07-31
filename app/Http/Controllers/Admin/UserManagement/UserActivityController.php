<?php

namespace App\Http\Controllers\Admin\UserManagement;
use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function index()
    {
        return view('admin.user_management.user_activity.index', );
    }

    public function lists(Request $request)
    {
        // Memulai query dengan eager loading untuk efisiensi
        $query = UserActivity::with('user')->select("user_activities.*");

        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('user_activities.modul', 'like', "%{$searchValue}%")
                    ->orWhere('user_activities.aksi', 'like', "%{$searchValue}%")
                    ->orWhere('user_activities.deskripsi', 'like', "%{$searchValue}%")
                    ->orWhereHas('user', function ($subq) use ($searchValue) {
                        // Mencari berdasarkan nama user di tabel relasi
                        $subq->where('name', 'like', "%{$searchValue}%");
                    });
            });
        }

        // --- MENGHITUNG TOTAL DATA ---
        // Hitung total sebelum ada limit/offset
        $totalRecords = UserActivity::count();
        // Hitung total setelah filter pencarian
        $filteredRecords = $query->count();

        // --- PENGURUTAN (ORDERING) ---
        if ($request->filled('order')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDir = $request->input('order.0.dir');
            $columns = $request->input('columns');
            $orderColumnName = $columns[$orderColumnIndex]['data'];

            // Mapping nama kolom dari DataTables ke nama kolom database
            $columnMap = [
                'modul' => 'modul',
                'aksi' => 'aksi',
                'user_name' => 'user_id', // Akan diurutkan berdasarkan relasi
            ];

            if (isset($columnMap[$orderColumnName])) {
                if ($orderColumnName === 'user_name') {
                    // Pengurutan khusus untuk kolom relasi 'user'
                    $query->join('users', 'user_activities.user_id', '=', 'users.id')
                        ->orderBy('users.name', $orderDir)
                        ->select('user_activities.*'); // Re-select untuk menghindari konflik kolom
                } else {
                    $query->orderBy($columnMap[$orderColumnName], $orderDir);
                }
            }
        } else {
            // Default order jika tidak ada pengurutan dari user
            $query->latest();
        }

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $produks = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($produks as $userActivity) {
            $data[] = [
                'no' => $no++,
                'id' => $userActivity->id, // Kirim ID untuk tombol aksi
                'modul' => $userActivity->modul,
                'deskripsi' => $userActivity->deskripsi,
                'aksi' => $userActivity->aksi,
                'user_name' => $userActivity->user->name ?? 'N/A',
                'created_at' => $userActivity->created_at->format('d-m-Y H:i:s'),
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }

}

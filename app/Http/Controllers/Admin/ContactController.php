<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view("admin.contact.index");
    }

    public function lists(Request $request)
    {
        // Memulai query dengan eager loading untuk efisiensi
        $query = ContactUs::select("*")->latest();

        // --- PENCARIAN (SEARCHING) ---
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');

            $query->where(function ($q) use ($searchValue) {
                $q->where('contact_us.name', 'like', "%{$searchValue}%")
                    ->orWhere('contact_us.phone_number', 'like', "%{$searchValue}%")
                    ->orWhere('contact_us.email', 'like', "%{$searchValue}%");
            });
        }

        // --- MENGHITUNG TOTAL DATA ---
        // Hitung total sebelum ada limit/offset
        $totalRecords = ContactUs::count();
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
                'name' => 'name',
                'phone_number' => 'phone_number',
                'email' => 'email',
            ];

            if (isset($columnMap[$orderColumnName])) {
                $query->orderBy($columnMap[$orderColumnName], $orderDir);
            }
        }

        // --- PAGINASI ---
        if ($request->filled('start') && $request->filled('length')) {
            $query->skip($request->input('start'))
                ->take($request->input('length'));
        }

        $contactUs = $query->get();

        // --- FORMATTING DATA ---
        $data = [];
        $no = $request->input('start', 0) + 1;
        foreach ($contactUs as $contact) {
            $data[] = [
                'no' => $no++,
                'id' => $contact->id, // Kirim ID untuk tombol aksi
                'name' => $contact->name,
                'phone_number' => $contact->phone_number,
                'email' => $contact->email,
                'message' => $contact->message,
                'tanggal' => $contact->tanggal,
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

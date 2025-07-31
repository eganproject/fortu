<?php

namespace Database\Seeders;

use App\Models\KategoriSpesifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSpesifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           
        KategoriSpesifikasi::create([
            'kode' => 'hero',
            'nama_kategori' => 'Hero',
            'deskripsi' => ''
        ]);
        KategoriSpesifikasi::create([
            'kode' => 'screen_type',
            'nama_kategori' => 'Screen Type',
            'deskripsi' => ''
        ]);

        KategoriSpesifikasi::create([
            'kode' => 'device_inch',
            'nama_kategori' => 'Device Inch',
            'deskripsi' => ''
        ]);

        KategoriSpesifikasi::create([
            'kode' => 'features',
            'nama_kategori' => 'Features',
            'deskripsi' => ''
        ]);

        KategoriSpesifikasi::create([
            'kode' => 'x_features',
            'nama_kategori' => 'X Features',
            'deskripsi' => ''
        ]);
    }
}

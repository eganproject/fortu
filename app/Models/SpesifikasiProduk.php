<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SpesifikasiProduk extends Model
{
    use HasUuids;
    protected $guarded = ['id'];

     public function kategoriSpesifikasi()
    {
        return $this->hasOne(KategoriSpesifikasi::class, 'id', 'kategori_spesifikasi_id');
    }

    
}

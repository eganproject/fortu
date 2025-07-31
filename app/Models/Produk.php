<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Produk extends Model
{
    use HasUuids, HasSlug;
    protected $guarded = ["id"];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama') // Sumber slug adalah kolom 'title'
            ->saveSlugsTo('slug');      // Slug akan disimpan di kolom 'slug'
    }

    public function kategoriProduk()
    {
        // Parameter kedua (foreign_key) dan ketiga (owner_key) bisa diabaikan jika mengikuti konvensi Laravel
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    /**
     * Mendefinisikan relasi "hasMany" ke model SpesifikasiProduk.
     * Setiap produk bisa memiliki banyak spesifikasi.
     */
    public function spesifikasiProduks()
    {
        return $this->hasMany(SpesifikasiProduk::class, 'produk_id');
    }

    public function scopeDeviceInch($id)
    {
        $data = $this->query()
        ->select('spesifikasi_produks.*')
            ->where('produks.id', $id)
            ->from('produks')
            ->join('spesifikasi_produks', 'produks.id', 'spesifikasi_produks.produk_id')
            ->join('kategori_spesifikasis', 'kategori_spesifikasis.id', 'spesifikasi_produks.kategori_spesifikasi_id')
            ->where('kategori_spesifikasis.kode', 'device_inch')->get();
        return $data;
    }
    public function scopeScreenType($id)
    {
        $data = $this->query()
        ->select('spesifikasi_produks.*')
            ->where('produks.id', $id)
            ->from('produks')
            ->join('spesifikasi_produks', 'produks.id', 'spesifikasi_produks.produk_id')
            ->join('kategori_spesifikasis', 'kategori_spesifikasis.id', 'spesifikasi_produks.kategori_spesifikasi_id')
            ->where('kategori_spesifikasis.kode', 'screen_type')->get();
        return $data;
    }

    public function scopeXFeatures($id)
    {
        $data = $this->query()
        ->select('spesifikasi_produks.*')
            ->where('produks.id', $id)
            ->from('produks')
            ->join('spesifikasi_produks', 'produks.id', 'spesifikasi_produks.produk_id')
            ->join('kategori_spesifikasis', 'kategori_spesifikasis.id', 'spesifikasi_produks.kategori_spesifikasi_id')
            ->where('kategori_spesifikasis.kode', 'x_features')->get();
        return $data;
    }

    public function scopeFeatures($id)
    {
        $data = $this->query()
        ->select('spesifikasi_produks.*')
            ->where('produks.id', $id)
            ->from('produks')
            ->join('spesifikasi_produks', 'produks.id', 'spesifikasi_produks.produk_id')
            ->join('kategori_spesifikasis', 'kategori_spesifikasis.id', 'spesifikasi_produks.kategori_spesifikasi_id')
            ->where('kategori_spesifikasis.kode', 'features')->get();
        return $data;
    }
}

<?php

namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions; 
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KategoriProduk extends Model
{
     use HasUuids, HasSlug;

    protected $guarded = ['id'];

     public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama_kategori') // Sumber slug adalah kolom 'title'
            ->saveSlugsTo('slug');      // Slug akan disimpan di kolom 'slug'
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}

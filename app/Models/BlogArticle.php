<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions; 
class BlogArticle extends Model
{
    use HasUuids, HasSlug;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'uuid_writer');
    }

     public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // Sumber slug adalah kolom 'title'
            ->saveSlugsTo('slug');      // Slug akan disimpan di kolom 'slug'
    }
}

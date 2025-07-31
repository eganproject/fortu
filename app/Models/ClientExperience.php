<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions; 

class ClientExperience extends Model
{
       use HasUuids,HasSlug;
       protected $guarded = ['id'];


       public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // Sumber slug adalah kolom 'title'
            ->saveSlugsTo('slug');      // Slug akan disimpan di kolom 'slug'
    }
}

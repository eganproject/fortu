<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KategoriSpesifikasi extends Model
{
    use HasUuids;
    protected $guarded = ['id'];
}

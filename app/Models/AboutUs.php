<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class AboutUs extends Model
{
   use HasUuids;

   protected $guarded = ['id'];

   // tambahkan relasi ke user
   public function user()
   {
      return $this->belongsTo(User::class);
   }
}

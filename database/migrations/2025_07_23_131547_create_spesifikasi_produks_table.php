<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spesifikasi_produks', function (Blueprint $table) {
           $table->uuid('id')->primary();
           $table->string('produk_id');
           $table->string('kategori_spesifikasi_id');
           $table->mediumText('spesifikasi');
           $table->mediumText('deskripsi')->nullable();
           $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesifikasi_produks');
    }
};

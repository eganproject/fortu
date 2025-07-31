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
        Schema::create('produks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->foreignId('kategori_id')->constrained('kategori_produks')->onDelete('cascade');
            $table->string('kategori_id');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->mediumText('deskripsi')->nullable();
            $table->mediumText('thumbnail');
            $table->integer('status')->default(1)->comment('1 aktif, 0 nonaktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

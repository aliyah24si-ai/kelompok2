<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lembaga_desa', function (Blueprint $table) {  // UBAH DI SINI
            $table->id('lembaga_id');
            $table->string('nama_lembaga', 100);
            $table->string('deskripsi', 225);
            $table->string('kontak')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga_desa');  // UBAH DI SINI JUGA
    }
};
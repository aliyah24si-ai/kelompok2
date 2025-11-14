<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jabatans', function (Blueprint $table) {
            // Tambahkan foreign key tanpa cek dulu (karena fresh migrate)
            $table->foreign('lembaga_id')
                  ->references('lembaga_id')
                  ->on('lembaga_desa')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('jabatans', function (Blueprint $table) {
            $table->dropForeign(['lembaga_id']);
        });
    }
};
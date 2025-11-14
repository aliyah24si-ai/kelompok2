<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('jabatans')) {
            Schema::create('jabatans', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('lembaga_id');
                $table->string('nama_jabatan');
                $table->string('level');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('jabatans');
    }
};
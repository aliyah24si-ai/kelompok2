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
    Schema::create('wargas', function (Blueprint $table) {
        $table->id('warga_id'); // ← AUTO-INCREMENT, tidak perlu diisi manual
        $table->string('no_ktp', 16)->unique();
        $table->string('nama', 100);
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->string('agama', 20);
        $table->string('pekerjaan', 50);
        $table->string('telp', 20)->nullable();
        $table->string('email', 100)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};

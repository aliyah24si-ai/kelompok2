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
        Schema::table('perangkat_desa', function (Blueprint $table) {
            // Add unique constraints to nip and kontak (allowing NULL values)
            // First, handle duplicate values by setting empty strings to NULL
            \DB::statement("UPDATE perangkat_desa SET nip = NULL WHERE nip = '' OR nip IS NULL");
            \DB::statement("UPDATE perangkat_desa SET kontak = NULL WHERE kontak = '' OR kontak IS NULL");
            
            // For actual duplicates, we'll handle by removing duplicates, keeping only the first
            \DB::statement("DELETE FROM perangkat_desa WHERE perangkat_id NOT IN (
                SELECT * FROM (
                    SELECT MIN(perangkat_id) FROM perangkat_desa WHERE nip IS NOT NULL GROUP BY nip
                ) AS temp1
            ) AND nip IS NOT NULL");
            
            $table->unique('nip');
            $table->unique('kontak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perangkat_desa', function (Blueprint $table) {
            // Drop the unique constraints
            $table->dropUnique(['nip']);
            $table->dropUnique(['kontak']);
        });
    }
};

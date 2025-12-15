<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // User dan Warga harus pertama karena dibutuhkan oleh seeder lain
            CreateFirstUser::class,
            CreateWargaDummy::class,
            
            // Lembaga dan Jabatan
            LembagaDesaSeeder::class,
            JabatanSeeder::class,
            
            // RW harus sebelum RT karena RT membutuhkan RW
            RwSeeder::class,
            RtSeeder::class,
            
            // Perangkat Desa membutuhkan Warga dan Jabatan
            PerangkatDesaSeeder::class,
            
            // Anggota Lembaga membutuhkan Warga, Lembaga, dan Jabatan
            AnggotaLembagaSeeder::class,
        ]);
    }
}

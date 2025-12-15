<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PerangkatDesa;
use App\Models\Warga;
use App\Models\Jabatan;

class PerangkatDesaSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil warga yang sudah ada
        $wargas = Warga::all();
        
        if ($wargas->isEmpty()) {
            $this->command->warn('Tidak ada data warga. Pastikan seeder Warga sudah dijalankan terlebih dahulu.');
            return;
        }
        
        $jabatanNames = [
            'Kepala Desa', 'Sekretaris Desa', 'Kepala Urusan Pemerintahan',
            'Kepala Urusan Pembangunan', 'Kepala Urusan Kesejahteraan Rakyat',
            'Kepala Urusan Keuangan', 'Kepala Urusan Umum', 'Kepala Dusun I',
            'Kepala Dusun II', 'Kepala Dusun III', 'Ketua BPD', 'Wakil Ketua BPD',
            'Sekretaris BPD', 'Ketua LPM', 'Ketua PKK', 'Ketua Karang Taruna',
            'Ketua RT 001', 'Ketua RT 002', 'Ketua RW 001', 'Ketua RW 002'
        ];
        
        $perangkatDesas = [];
        
        // Buat 20 data perangkat desa
        for ($i = 1; $i <= 20; $i++) {
            $warga = $wargas->random();
            $jabatan = $jabatanNames[array_rand($jabatanNames)];
            
            // Pastikan kombinasi warga_id dan jabatan unik
            $exists = collect($perangkatDesas)->contains(function ($item) use ($warga, $jabatan) {
                return $item['warga_id'] == $warga->warga_id && $item['jabatan'] == $jabatan;
            });
            
            if (!$exists) {
                $perangkatDesas[] = [
                    'warga_id' => $warga->warga_id,
                    'jabatan' => $jabatan,
                    'nip' => fake()->optional(0.7)->numerify('##########'),
                    'kontak' => fake()->optional(0.8)->phoneNumber(),
                    'periode_mulai' => fake()->dateTimeBetween('-5 years', '-1 year')->format('Y-m-d'),
                    'periode_selesai' => fake()->optional(0.3)->dateTimeBetween('now', '+2 years')?->format('Y-m-d'),
                    'foto' => null, // Foto akan diisi manual jika diperlukan
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } else {
                $i--; // Ulangi iterasi jika kombinasi sudah ada
            }
        }
        
        // Insert data ke database
        foreach ($perangkatDesas as $perangkat) {
            PerangkatDesa::create($perangkat);
        }
    }
}
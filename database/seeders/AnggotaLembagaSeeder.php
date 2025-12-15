<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\Warga;
use App\Models\Jabatan;

class AnggotaLembagaSeeder extends Seeder
{
    public function run()
    {
        $lembaga = LembagaDesa::first();
        $warga = Warga::first();
        $jabatan = Jabatan::first();

        if ($lembaga && $warga) {
            AnggotaLembaga::create([
                'lembaga_id' => $lembaga->lembaga_id,
                'warga_id' => $warga->warga_id,
                'jabatan_id' => $jabatan ? $jabatan->id : null,
                'tgl_mulai' => '2024-01-01',
                'tgl_selesai' => null
            ]);

            echo "Sample Anggota Lembaga created successfully!\n";
        } else {
            echo "Please create Lembaga and Warga data first\n";
        }
    }
}
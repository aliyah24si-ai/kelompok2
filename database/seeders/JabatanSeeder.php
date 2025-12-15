<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get lembaga IDs for foreign key
        $lembagaIds = \App\Models\LembagaDesa::pluck('lembaga_id')->toArray();
        
        $jabatans = [
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Desa',
                'level' => 'Tinggi'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Sekretaris Desa',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Urusan Pemerintahan',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Urusan Pembangunan',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Urusan Kesejahteraan Rakyat',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Urusan Keuangan',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Urusan Umum',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Dusun I',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Dusun II',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Kepala Dusun III',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua BPD',
                'level' => 'Tinggi'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Wakil Ketua BPD',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Sekretaris BPD',
                'level' => 'Rendah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua LPM',
                'level' => 'Tinggi'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua PKK',
                'level' => 'Tinggi'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua Karang Taruna',
                'level' => 'Tinggi'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua RT 001',
                'level' => 'Rendah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua RT 002',
                'level' => 'Rendah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua RW 001',
                'level' => 'Menengah'
            ],
            [
                'lembaga_id' => $lembagaIds[array_rand($lembagaIds)],
                'nama_jabatan' => 'Ketua RW 002',
                'level' => 'Menengah'
            ]
        ];

        foreach ($jabatans as $jabatan) {
            Jabatan::create($jabatan);
        }
    }
}
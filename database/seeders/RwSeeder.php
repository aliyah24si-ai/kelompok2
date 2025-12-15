<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rw;
use App\Models\Warga;

class RwSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa warga untuk dijadikan ketua RW
        $wargas = Warga::limit(20)->get();
        
        $rws = [
            [
                'nomor_rw' => '001',
                'ketua_rw_warga_id' => $wargas->get(0)?->warga_id ?? null,
                'keterangan' => 'RW 001 Desa Maju - Jl. Merdeka No. 1-50',
            ],
            [
                'nomor_rw' => '002',
                'ketua_rw_warga_id' => $wargas->get(1)?->warga_id ?? null,
                'keterangan' => 'RW 002 Desa Maju - Jl. Proklamasi No. 51-100',
            ],
            [
                'nomor_rw' => '003',
                'ketua_rw_warga_id' => $wargas->get(2)?->warga_id ?? null,
                'keterangan' => 'RW 003 Desa Maju - Jl. Pancasila No. 101-150',
            ],
            [
                'nomor_rw' => '004',
                'ketua_rw_warga_id' => $wargas->get(3)?->warga_id ?? null,
                'keterangan' => 'RW 004 Desa Maju - Jl. Garuda No. 151-200',
            ],
            [
                'nomor_rw' => '005',
                'ketua_rw_warga_id' => $wargas->get(4)?->warga_id ?? null,
                'keterangan' => 'RW 005 Desa Maju - Jl. Diponegoro No. 201-250',
            ],
            [
                'nomor_rw' => '006',
                'ketua_rw_warga_id' => $wargas->get(5)?->warga_id ?? null,
                'keterangan' => 'RW 006 Desa Sejahtera - Jl. Sudirman No. 1-40',
            ],
            [
                'nomor_rw' => '007',
                'ketua_rw_warga_id' => $wargas->get(6)?->warga_id ?? null,
                'keterangan' => 'RW 007 Desa Sejahtera - Jl. Thamrin No. 41-80',
            ],
            [
                'nomor_rw' => '008',
                'ketua_rw_warga_id' => $wargas->get(7)?->warga_id ?? null,
                'keterangan' => 'RW 008 Desa Sejahtera - Jl. Kartini No. 81-120',
            ],
            [
                'nomor_rw' => '009',
                'ketua_rw_warga_id' => $wargas->get(8)?->warga_id ?? null,
                'keterangan' => 'RW 009 Desa Makmur - Jl. Pahlawan No. 1-60',
            ],
            [
                'nomor_rw' => '010',
                'ketua_rw_warga_id' => $wargas->get(9)?->warga_id ?? null,
                'keterangan' => 'RW 010 Desa Makmur - Jl. Veteran No. 61-120',
            ],
            [
                'nomor_rw' => '011',
                'ketua_rw_warga_id' => $wargas->get(10)?->warga_id ?? null,
                'keterangan' => 'RW 011 Desa Damai - Jl. Melati No. 1-45',
            ],
            [
                'nomor_rw' => '012',
                'ketua_rw_warga_id' => $wargas->get(11)?->warga_id ?? null,
                'keterangan' => 'RW 012 Desa Damai - Jl. Mawar No. 46-90',
            ],
            [
                'nomor_rw' => '013',
                'ketua_rw_warga_id' => $wargas->get(12)?->warga_id ?? null,
                'keterangan' => 'RW 013 Desa Harmoni - Jl. Anggrek No. 1-50',
            ],
            [
                'nomor_rw' => '014',
                'ketua_rw_warga_id' => $wargas->get(13)?->warga_id ?? null,
                'keterangan' => 'RW 014 Desa Harmoni - Jl. Kenanga No. 51-100',
            ],
            [
                'nomor_rw' => '015',
                'ketua_rw_warga_id' => $wargas->get(14)?->warga_id ?? null,
                'keterangan' => 'RW 015 Desa Bahagia - Jl. Cempaka No. 1-40',
            ],
            [
                'nomor_rw' => '016',
                'ketua_rw_warga_id' => $wargas->get(15)?->warga_id ?? null,
                'keterangan' => 'RW 016 Desa Bahagia - Jl. Dahlia No. 41-80',
            ],
            [
                'nomor_rw' => '017',
                'ketua_rw_warga_id' => $wargas->get(16)?->warga_id ?? null,
                'keterangan' => 'RW 017 Desa Sentosa - Jl. Flamboyan No. 1-55',
            ],
            [
                'nomor_rw' => '018',
                'ketua_rw_warga_id' => $wargas->get(17)?->warga_id ?? null,
                'keterangan' => 'RW 018 Desa Sentosa - Jl. Bougenville No. 56-110',
            ],
            [
                'nomor_rw' => '019',
                'ketua_rw_warga_id' => $wargas->get(18)?->warga_id ?? null,
                'keterangan' => 'RW 019 Desa Indah - Jl. Sakura No. 1-65',
            ],
            [
                'nomor_rw' => '020',
                'ketua_rw_warga_id' => $wargas->get(19)?->warga_id ?? null,
                'keterangan' => 'RW 020 Desa Indah - Jl. Tulip No. 66-130',
            ]
        ];

        foreach ($rws as $rw) {
            Rw::create($rw);
        }
    }
}
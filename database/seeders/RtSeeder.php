<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;

class RtSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil RW yang sudah ada
        $rws = Rw::all();
        $wargas = Warga::all();
        
        $rtCounter = 1;
        
        foreach ($rws as $rw) {
            // Buat 1 RT untuk setiap RW (karena RW tidak memiliki jumlah_rt field)
            if ($rtCounter <= 20) {
                $nomorRt = str_pad($rtCounter, 3, '0', STR_PAD_LEFT);
                
                // Pilih ketua RT secara acak dari warga yang ada
                $ketuaRt = $wargas->random();
                
                Rt::create([
                    'rw_id' => $rw->rw_id,
                    'nomor_rt' => $nomorRt,
                    'ketua_rt_warga_id' => $ketuaRt->warga_id,
                    'keterangan' => "RT {$nomorRt} RW {$rw->nomor_rw} - {$rw->keterangan}",
                ]);
                
                $rtCounter++;
            }
            
            if ($rtCounter > 20) break;
        }
    }
}
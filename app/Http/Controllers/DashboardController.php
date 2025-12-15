<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\User;
use App\Models\LembagaDesa;
use App\Models\PerangkatDesa;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Jabatan;
use App\Models\AnggotaLembaga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalWarga = Warga::count();
        $totalUsers = User::count();
        $totalLembaga = LembagaDesa::count();
        $totalPerangkat = PerangkatDesa::count();
        $totalRt = Rt::count();
        $totalRw = Rw::count();
        $totalJabatan = Jabatan::count();
        $totalAnggotaLembaga = AnggotaLembaga::count();

       
        $laki_laki = Warga::where('jenis_kelamin', 'L')->count();
        $perempuan = Warga::where('jenis_kelamin', 'P')->count();

       
        $recentWarga = Warga::latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'totalWarga' => $totalWarga,
            'totalUsers' => $totalUsers,
            'totalLembaga' => $totalLembaga,
            'totalPerangkat' => $totalPerangkat,
            'totalRt' => $totalRt,
            'totalRw' => $totalRw,
            'totalJabatan' => $totalJabatan,
            'totalAnggotaLembaga' => $totalAnggotaLembaga,
            'laki_laki' => $laki_laki,
            'perempuan' => $perempuan,
            'recentWarga' => $recentWarga,
        ]);
    }
}

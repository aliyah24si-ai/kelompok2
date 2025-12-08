<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\User;
use App\Models\LembagaDesa;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Statistics
        $totalWarga = Warga::count();
        $totalUsers = User::count();
        $totalLembaga = LembagaDesa::count();
        $totalPerangkat = PerangkatDesa::count();

        // Gender Statistics
        $laki_laki = Warga::where('jenis_kelamin', 'L')->count();
        $perempuan = Warga::where('jenis_kelamin', 'P')->count();

        // Recent Warga (Latest 5)
        $recentWarga = Warga::latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'totalWarga' => $totalWarga,
            'totalUsers' => $totalUsers,
            'totalLembaga' => $totalLembaga,
            'totalPerangkat' => $totalPerangkat,
            'laki_laki' => $laki_laki,
            'perempuan' => $perempuan,
            'recentWarga' => $recentWarga,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;

class RwController extends Controller
{
    public function index(Request $request)
    {
        $query = Rw::with(['ketuaRw', 'rts']);
        
        // Search functionality - improved
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nomor_rw', 'like', '%' . $searchTerm . '%')
                  ->orWhere('keterangan', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('ketuaRw', function ($ketuaQuery) use ($searchTerm) {
                      $ketuaQuery->where('nama', 'like', '%' . $searchTerm . '%');
                  });
            });
        }
        
        // Filter by ketua status
        if ($request->filled('has_ketua')) {
            if ($request->has_ketua === 'yes') {
                $query->whereNotNull('ketua_rw_warga_id');
            } elseif ($request->has_ketua === 'no') {
                $query->whereNull('ketua_rw_warga_id');
            }
        }
        
        // Filter by RT count
        if ($request->filled('has_rt')) {
            if ($request->has_rt === 'yes') {
                $query->whereHas('rts');
            } elseif ($request->has_rt === 'no') {
                $query->whereDoesntHave('rts');
            }
        }
        
        $rws = $query->latest()->paginate(5);
        
        // Get filter options
        $ketuaOptions = [
            'yes' => 'Ada Ketua',
            'no' => 'Belum Ada Ketua'
        ];
        
        $rtOptions = [
            'yes' => 'Ada RT',
            'no' => 'Belum Ada RT'
        ];
        
        return view('rw.index', compact('rws', 'ketuaOptions', 'rtOptions'));
    }

    public function create()
    {
        $wargas = Warga::select('warga_id', 'nama')->orderBy('nama')->get();
        return view('rw.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rw' => 'required|numeric|unique:rw,nomor_rw',
            'ketua_rw_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string'
        ]);

        Rw::create($request->all());

        return redirect()->route('rw.index')
            ->with('success', 'RW berhasil ditambahkan!');
    }

    public function show($id)
    {
        $rw = Rw::with(['ketuaRw', 'rts.ketuaRt'])->findOrFail($id);
        return view('rw.show', compact('rw'));
    }

    public function edit($id)
    {
        $rw = Rw::findOrFail($id);
        $wargas = Warga::select('warga_id', 'nama')->orderBy('nama')->get();
        return view('rw.edit', compact('rw', 'wargas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_rw' => 'required|numeric|unique:rw,nomor_rw,' . $id . ',rw_id',
            'ketua_rw_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string'
        ]);

        $rw = Rw::findOrFail($id);
        $rw->update($request->all());

        return redirect()->route('rw.index')
            ->with('success', 'RW berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rw = Rw::findOrFail($id);
        
        // Check if RW has RT
        if ($rw->rts()->count() > 0) {
            return redirect()->route('rw.index')
                ->with('error', 'RW tidak dapat dihapus karena masih memiliki RT!');
        }
        
        $rw->delete();

        return redirect()->route('rw.index')
            ->with('success', 'RW berhasil dihapus!');
    }
}
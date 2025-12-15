<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use App\Rules\UniqueRtPerRw;
use Illuminate\Http\Request;

class RtController extends Controller
{
    public function index(Request $request)
    {
        $query = Rt::with(['rw', 'ketuaRt']);
        
        // Search functionality - improved
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nomor_rt', 'like', '%' . $searchTerm . '%')
                  ->orWhere('keterangan', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('rw', function ($rwQuery) use ($searchTerm) {
                      $rwQuery->where('nomor_rw', 'like', '%' . $searchTerm . '%');
                  })
                  ->orWhereHas('ketuaRt', function ($ketuaQuery) use ($searchTerm) {
                      $ketuaQuery->where('nama', 'like', '%' . $searchTerm . '%');
                  });
            });
        }
        
        // Filter by RW
        if ($request->filled('rw_id')) {
            $query->where('rw_id', $request->rw_id);
        }
        
        // Filter by ketua status
        if ($request->filled('has_ketua')) {
            if ($request->has_ketua === 'yes') {
                $query->whereNotNull('ketua_rt_warga_id');
            } elseif ($request->has_ketua === 'no') {
                $query->whereNull('ketua_rt_warga_id');
            }
        }
        
        $rts = $query->latest()->paginate(5);
        $rws = Rw::select('rw_id', 'nomor_rw')->orderBy('nomor_rw')->get();
        
        // Get ketua status options for filter
        $ketuaOptions = [
            'yes' => 'Ada Ketua',
            'no' => 'Belum Ada Ketua'
        ];
        
        return view('rt.index', compact('rts', 'rws', 'ketuaOptions'));
    }

    public function create()
    {
        $rws = Rw::select('rw_id', 'nomor_rw')->orderBy('nomor_rw')->get();
        $wargas = Warga::select('warga_id', 'nama')->orderBy('nama')->get();
        return view('rt.create', compact('rws', 'wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rw_id' => 'required|exists:rw,rw_id',
            'nomor_rt' => ['required', 'numeric', new UniqueRtPerRw($request->rw_id)],
            'ketua_rt_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string'
        ]);

        Rt::create($request->all());

        return redirect()->route('rt.index')
            ->with('success', 'RT berhasil ditambahkan!');
    }

    public function show($id)
    {
        $rt = Rt::with(['rw', 'ketuaRt'])->findOrFail($id);
        return view('rt.show', compact('rt'));
    }

    public function edit($id)
    {
        $rt = Rt::findOrFail($id);
        $rws = Rw::select('rw_id', 'nomor_rw')->orderBy('nomor_rw')->get();
        $wargas = Warga::select('warga_id', 'nama')->orderBy('nama')->get();
        return view('rt.edit', compact('rt', 'rws', 'wargas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rw_id' => 'required|exists:rw,rw_id',
            'nomor_rt' => ['required', 'numeric', new UniqueRtPerRw($request->rw_id, $id)],
            'ketua_rt_warga_id' => 'nullable|exists:wargas,warga_id',
            'keterangan' => 'nullable|string'
        ]);

        $rt = Rt::findOrFail($id);
        $rt->update($request->all());

        return redirect()->route('rt.index')
            ->with('success', 'RT berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rt = Rt::findOrFail($id);
        $rt->delete();

        return redirect()->route('rt.index')
            ->with('success', 'RT berhasil dihapus!');
    }
}
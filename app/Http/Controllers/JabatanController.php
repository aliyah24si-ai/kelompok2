<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Jabatan::with('lembaga');
        
        // Search functionality - improved
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_jabatan', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('lembaga', function ($lembagaQuery) use ($searchTerm) {
                      $lembagaQuery->where('nama_lembaga', 'like', '%' . $searchTerm . '%');
                  });
            });
        }
        
        // Filter by lembaga
        if ($request->filled('lembaga_id')) {
            $query->where('lembaga_id', $request->lembaga_id);
        }
        
        $jabatans = $query->latest()->paginate(5);
        $lembagas = LembagaDesa::select('lembaga_id', 'nama_lembaga')->orderBy('nama_lembaga')->get();
        
        return view('jabatan.index', compact('jabatans', 'lembagas'));
    }

    
    public function create()
    {
        $lembagas = LembagaDesa::all();
        return view('jabatan.create', compact('lembagas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:255',
            'level' => 'required|in:Pimpinan,Manager,Staff,Operator',
        ]);

        Jabatan::create($request->all());

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $jabatan = Jabatan::with('lembaga')->findOrFail($id);
        return view('jabatan.show', compact('jabatan'));
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $lembagas = LembagaDesa::all();
        return view('jabatan.edit', compact('jabatan', 'lembagas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'nama_jabatan' => 'required|string|max:255',
            'level' => 'required|string|max:255',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus!');
    }
}
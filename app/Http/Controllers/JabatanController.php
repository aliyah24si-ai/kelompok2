<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\LembagaDesa; // GANTI INI
use Illuminate\Http\Request;

class JabatanController extends Controller
{
     public function index()
    {
        $jabatans = Jabatan::with('lembaga')->get();
        return view('jabatan.index', compact('jabatans'))
            ->with('success', session('success'));
    }

    public function create()
    {
        $lembagas = LembagaDesa::all(); // GANTI INI
        return view('jabatan.create', compact('lembagas'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
        'nama_jabatan' => 'required|string|max:255',
        'level' => 'required|in:Pimpinan,Manager,Staff,Operator', // Validasi pilihan tetap
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
        $lembagas = LembagaDesa::all(); // PASTIKAN PAKAI LembagaDesa
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
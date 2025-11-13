<?php

namespace App\Http\Controllers;

use App\Models\LembagaDesa;
use Illuminate\Http\Request;

class LembagaDesaController extends Controller
{
    public function index()
    {
        $lembaga_desas = LembagaDesa::latest()->paginate(10);
        return view('lembaga_desas.index', compact('lembaga_desas'));
    }

    public function create()
    {
        return view('lembaga_desas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:225',
            'kontak' => 'nullable|string|max:255',
        ]);

        LembagaDesa::create($data);

        return redirect()->route('lembaga.index')->with('success', 'LembagaDesa created.');
    }

    public function show(LembagaDesa $lembaga) // UBAH: $lembagaDesa → $lembaga
    {
        return view('lembaga_desas.show', compact('lembaga'));
    }

    public function edit(LembagaDesa $lembaga) // UBAH: $lembagaDesa → $lembaga
    {
        return view('lembaga_desas.edit', compact('lembaga'));
    }

    public function update(Request $request, LembagaDesa $lembaga) // UBAH: $lembagaDesa → $lembaga
    {
        $data = $request->validate([
            'nama_lembaga' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:225',
            'kontak' => 'nullable|string|max:255',
        ]);

        $lembaga->update($data);

        return redirect()->route('lembaga.index')->with('success', 'Lembaga Desa Berhasil ditambahkan.');
    }

    public function destroy(LembagaDesa $lembaga) // UBAH: $lembagaDesa → $lembaga
    {
        $lembaga->delete();
        return redirect()->route('lembaga.index')->with('success', 'LembagaDesa deleted.');
    }
}
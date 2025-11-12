<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::latest()->paginate(10);
        return view('wargas.index', compact('wargas'));
    }

    public function create()
    {
        return view('wargas.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'no_ktp' => 'required|string|max:16|unique:wargas',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:50',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100|unique:wargas',
        ];

        $messages = [
            'no_ktp.unique' => 'No KTP ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah digunakan oleh warga lain.',
        ];

        $data = $request->validate($rules, $messages);

        Warga::create($data);

        return redirect()->route('wargas.index')->with('success', 'Warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        return view('wargas.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        return view('wargas.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $rules = [
            'no_ktp' => 'required|string|max:16|unique:wargas,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:50',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100|unique:wargas,email,' . $warga->warga_id . ',warga_id',
        ];

        $messages = [
            'no_ktp.unique' => 'No KTP ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah digunakan oleh warga lain.',
        ];

        $data = $request->validate($rules, $messages);

        $warga->update($data);

        return redirect()->route('wargas.index')->with('success', 'Warga berhasil diupdate.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('wargas.index')->with('success', 'Warga berhasil dihapus.');
    }
}

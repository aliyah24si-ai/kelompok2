<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $filterWarga = $request->get('warga_id', '');

        $query = PerangkatDesa::with('warga');

        if ($search) {
            $query->whereHas('warga', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            })->orWhere('jabatan', 'like', '%' . $search . '%');
        }

        if ($filterWarga) {
            $query->where('warga_id', $filterWarga);
        }

        $items = $query->orderBy('perangkat_id', 'desc')->paginate(10);
        $wargas = Warga::orderBy('nama')->get();

        return view('perangkat_desa.index', compact('items', 'search', 'filterWarga', 'wargas'));
    }

    public function create()
    {
        $wargas = Warga::orderBy('nama')->get();
        return view('perangkat_desa.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan' => 'required|string|max:191',
            'nip' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('perangkat_foto', 'public');
            $data['foto'] = $path;
        }

        PerangkatDesa::create($data);
        return redirect()->route('perangkat_desa.index')->with('success', 'Perangkat Desa berhasil ditambahkan.');
    }

    public function show(PerangkatDesa $perangkat_desa)
    {
        $perangkat_desa->load('warga');
        return view('perangkat_desa.show', ['item' => $perangkat_desa]);
    }

    public function edit(PerangkatDesa $perangkat_desa)
    {
        $wargas = Warga::orderBy('nama')->get();
        return view('perangkat_desa.edit', ['item' => $perangkat_desa, 'wargas' => $wargas]);
    }

    public function update(Request $request, PerangkatDesa $perangkat_desa)
    {
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan' => 'required|string|max:191',
            'nip' => 'nullable|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // delete old
            if ($perangkat_desa->foto) {
                Storage::disk('public')->delete($perangkat_desa->foto);
            }
            $path = $request->file('foto')->store('perangkat_foto', 'public');
            $data['foto'] = $path;
        }

        $perangkat_desa->update($data);
        return redirect()->route('perangkat_desa.index')->with('success', 'Perangkat Desa berhasil diubah.');
    }

    public function destroy(PerangkatDesa $perangkat_desa)
    {
        if ($perangkat_desa->foto) {
            Storage::disk('public')->delete($perangkat_desa->foto);
        }
        $perangkat_desa->delete();
        return redirect()->route('perangkat_desa.index')->with('success', 'Perangkat Desa berhasil dihapus.');
    }
}

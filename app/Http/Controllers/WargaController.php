<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'foto_profil' => 'nullable|image|max:2048',
            'dokumen' => 'nullable|array',
            'dokumen.*' => 'file|max:5120',
        ];

        $messages = [
            'no_ktp.unique' => 'No KTP ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah digunakan oleh warga lain.',
        ];

        $data = $request->validate($rules, $messages);

        DB::transaction(function () use ($request, &$data) {
            if ($request->hasFile('foto_profil')) {
                $data['foto_profil_path'] = $request->file('foto_profil')->store('warga/profiles', 'public');
            }

            $warga = Warga::create($data);

            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $file) {
                    $path = $file->store('warga/files', 'public');

                    $warga->files()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }
        });

        return redirect()->route('wargas.index')->with('success', 'Warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        $warga->load('files');
        return view('wargas.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        $warga->load('files');
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
            'foto_profil' => 'nullable|image|max:2048',
            'dokumen' => 'nullable|array',
            'dokumen.*' => 'file|max:5120',
        ];

        $messages = [
            'no_ktp.unique' => 'No KTP ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah digunakan oleh warga lain.',
        ];

        $data = $request->validate($rules, $messages);

        DB::transaction(function () use ($request, $warga, &$data) {
            if ($request->hasFile('foto_profil')) {
                if ($warga->foto_profil_path) {
                    Storage::disk('public')->delete($warga->foto_profil_path);
                }

                $data['foto_profil_path'] = $request->file('foto_profil')->store('warga/profiles', 'public');
            }

            $warga->update($data);

            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $file) {
                    $path = $file->store('warga/files', 'public');

                    $warga->files()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }
        });

        return redirect()->route('wargas.index')->with('success', 'Warga berhasil diupdate.');
    }

    public function destroy(Warga $warga)
    {
        $warga->load('files');

        if ($warga->foto_profil_path) {
            Storage::disk('public')->delete($warga->foto_profil_path);
        }

        foreach ($warga->files as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $warga->delete();
        return redirect()->route('wargas.index')->with('success', 'Warga berhasil dihapus.');
    }
}

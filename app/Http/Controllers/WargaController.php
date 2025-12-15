<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\WargaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::query();

        // Use model scope for searchable columns
        $query->search($request);

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('agama')) {
            $query->where('agama', $request->agama);
        }

        // PAGINATION FIX: Tambah withQueryString() untuk preserve filter
        $wargas = $query->paginate(10)->withQueryString();

        // Ambil agama unik dari database
        $agamas = Warga::select('agama')
            ->whereNotNull('agama')
            ->distinct()
            ->orderBy('agama')
            ->pluck('agama')
            ->toArray();

        // Jika tidak ada agama di database, beri default
        if (empty($agamas)) {
            $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        }

        return view('wargas.index', compact('wargas', 'agamas'));
    }

    public function create()
    {
        return view('wargas.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'no_ktp' => 'required|string|max:16|unique:wargas,no_ktp',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:50',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100|unique:wargas,email',
            'foto_profil' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'dokumen' => 'nullable|array',
            'dokumen.*' => 'file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png',
        ];

        $messages = [
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.unique' => 'No KTP ini sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'agama.required' => 'Agama wajib dipilih.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh warga lain.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.max' => 'Ukuran foto maksimal 2MB.',
            'dokumen.*.max' => 'Ukuran dokumen maksimal 5MB.',
        ];

        $validated = $request->validate($rules, $messages);

        try {
            DB::beginTransaction();

            $data = $validated;
            
            // Handle foto profil
            if ($request->hasFile('foto_profil')) {
                $fotoPath = $request->file('foto_profil')->store('warga/profiles', 'public');
                $data['foto_profil_path'] = $fotoPath;
            }

            // Generate warga_id otomatis
            $lastWarga = Warga::orderBy('warga_id', 'desc')->first();
            $data['warga_id'] = $lastWarga ? $lastWarga->warga_id + 1 : 1;

            // Create warga
            $warga = Warga::create($data);

            // Handle dokumen (gunakan wargaFiles bukan files)
            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $file) {
                    $path = $file->store('warga/files', 'public');

                    $warga->wargaFiles()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('wargas.index')
                ->with('success', 'Data warga berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Hapus file yang sudah diupload jika ada error
            if (isset($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data warga. Error: ' . $e->getMessage());
        }
    }

    public function show(Warga $warga)
    {
        $warga->load('wargaFiles'); // Ganti 'files' menjadi 'wargaFiles'
        return view('wargas.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        $warga->load('wargaFiles'); // Ganti 'files' menjadi 'wargaFiles'
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
            'foto_profil' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'dokumen' => 'nullable|array',
            'dokumen.*' => 'file|max:5120|mimes:pdf,doc,docx,jpg,jpeg,png',
        ];

        $messages = [
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.unique' => 'No KTP ini sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'agama.required' => 'Agama wajib dipilih.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh warga lain.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.max' => 'Ukuran foto maksimal 2MB.',
            'dokumen.*.max' => 'Ukuran dokumen maksimal 5MB.',
        ];

        $validated = $request->validate($rules, $messages);

        try {
            DB::beginTransaction();

            $data = $validated;
            
            // Handle foto profil update
            $oldFotoPath = null;
            if ($request->hasFile('foto_profil')) {
                // Simpan path foto lama untuk dihapus nanti
                $oldFotoPath = $warga->foto_profil_path;
                
                // Upload foto baru
                $fotoPath = $request->file('foto_profil')->store('warga/profiles', 'public');
                $data['foto_profil_path'] = $fotoPath;
            }

            // Update warga
            $warga->update($data);

            // Hapus foto lama jika ada foto baru
            if ($oldFotoPath && Storage::disk('public')->exists($oldFotoPath)) {
                Storage::disk('public')->delete($oldFotoPath);
            }

            // Handle dokumen tambahan (gunakan wargaFiles bukan files)
            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $file) {
                    $path = $file->store('warga/files', 'public');

                    $warga->wargaFiles()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('wargas.index')
                ->with('success', 'Data warga berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data warga. Error: ' . $e->getMessage());
        }
    }

    public function destroy(Warga $warga)
    {
        try {
            DB::beginTransaction();

            // Hapus foto profil jika ada
            if ($warga->foto_profil_path && Storage::disk('public')->exists($warga->foto_profil_path)) {
                Storage::disk('public')->delete($warga->foto_profil_path);
            }

            // Hapus semua dokumen terkait (gunakan wargaFiles bukan files)
            $warga->load('wargaFiles');
            foreach ($warga->wargaFiles as $file) {
                if (Storage::disk('public')->exists($file->file_path)) {
                    Storage::disk('public')->delete($file->file_path);
                }
                $file->delete();
            }

            // Hapus data warga
            $warga->delete();

            DB::commit();

            return redirect()->route('wargas.index')
                ->with('success', 'Data warga berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->with('error', 'Gagal menghapus data warga. Error: ' . $e->getMessage());
        }
    }

    /**
     * Hapus file dokumen spesifik
     */
    public function deleteFile($wargaId, $fileId)
    {
        try {
            $warga = Warga::findOrFail($wargaId);
            $file = $warga->wargaFiles()->findOrFail($fileId); // Ganti files() menjadi wargaFiles()

            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }

            $file->delete();

            return response()->json([
                'success' => true,
                'message' => 'File berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus file.'
            ], 500);
        }
    }

    /**
     * Serve file directly from storage
     */
    public function serveFile($fileId)
    {
        try {
            $file = \App\Models\WargaFile::findOrFail($fileId);
            $filePath = storage_path('app/public/' . $file->file_path);
            
            if (!file_exists($filePath)) {
                abort(404, 'File not found');
            }
            
            return response()->file($filePath, [
                'Content-Type' => $file->mime_type,
                'Content-Disposition' => 'inline; filename="' . $file->original_name . '"'
            ]);
            
        } catch (\Exception $e) {
            abort(404, 'File not found');
        }
    }
}
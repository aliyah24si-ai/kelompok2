<?php

namespace App\Http\Controllers;

use App\Models\AnggotaLembaga;
use App\Models\LembagaDesa;
use App\Models\Warga;
use App\Models\Jabatan;
use App\Rules\NoOverlappingPeriod;
use Illuminate\Http\Request;

class AnggotaLembagaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $filterLembaga = $request->get('lembaga_id', '');
        $filterJabatan = $request->get('jabatan_id', '');
        $filterStatus = $request->get('status', '');

        $query = AnggotaLembaga::with(['warga', 'lembaga', 'jabatan']);

        // Apply search
        if ($search) {
            $query->search($search);
        }

        // Apply filters
        if ($filterLembaga) {
            $query->filterByLembaga($filterLembaga);
        }

        if ($filterJabatan) {
            $query->filterByJabatan($filterJabatan);
        }

        if ($filterStatus) {
            $query->filterByStatus($filterStatus);
        }

        $items = $query->orderBy('anggota_id', 'desc')->paginate(5);
        
        // Get data for filters
        $lembagas = LembagaDesa::orderBy('nama_lembaga')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();

        return view('anggota_lembaga.index', compact(
            'items', 
            'search', 
            'filterLembaga', 
            'filterJabatan', 
            'filterStatus',
            'lembagas', 
            'jabatans'
        ));
    }

    public function create()
    {
        $lembagas = LembagaDesa::orderBy('nama_lembaga')->get();
        $wargas = Warga::orderBy('nama')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        
        return view('anggota_lembaga.create', compact('lembagas', 'wargas', 'jabatans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tgl_mulai',
                new NoOverlappingPeriod(
                    $request->warga_id,
                    $request->lembaga_id,
                    $request->jabatan_id,
                    $request->tgl_mulai
                )
            ],
        ], [
            'lembaga_id.required' => 'Lembaga harus dipilih.',
            'warga_id.required' => 'Warga harus dipilih.',
            'tgl_mulai.required' => 'Tanggal mulai harus diisi.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ]);

        AnggotaLembaga::create($data);
        
        return redirect()->route('anggota-lembaga.index')
            ->with('success', 'Anggota Lembaga berhasil ditambahkan.');
    }

    public function show(AnggotaLembaga $anggotaLembaga)
    {
        $anggotaLembaga->load(['warga', 'lembaga', 'jabatan']);
        return view('anggota_lembaga.show', ['item' => $anggotaLembaga]);
    }

    public function edit(AnggotaLembaga $anggotaLembaga)
    {
        $lembagas = LembagaDesa::orderBy('nama_lembaga')->get();
        $wargas = Warga::orderBy('nama')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        
        return view('anggota_lembaga.edit', [
            'item' => $anggotaLembaga,
            'lembagas' => $lembagas,
            'wargas' => $wargas,
            'jabatans' => $jabatans
        ]);
    }

    public function update(Request $request, AnggotaLembaga $anggotaLembaga)
    {
        $data = $request->validate([
            'lembaga_id' => 'required|exists:lembaga_desa,lembaga_id',
            'warga_id' => 'required|exists:wargas,warga_id',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tgl_mulai',
                new NoOverlappingPeriod(
                    $request->warga_id,
                    $request->lembaga_id,
                    $request->jabatan_id,
                    $request->tgl_mulai,
                    $anggotaLembaga->anggota_id
                )
            ],
        ], [
            'lembaga_id.required' => 'Lembaga harus dipilih.',
            'warga_id.required' => 'Warga harus dipilih.',
            'tgl_mulai.required' => 'Tanggal mulai harus diisi.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ]);

        $anggotaLembaga->update($data);
        
        return redirect()->route('anggota-lembaga.index')
            ->with('success', 'Anggota Lembaga berhasil diperbarui.');
    }

    public function destroy(AnggotaLembaga $anggotaLembaga)
    {
        $anggotaLembaga->delete();
        
        return redirect()->route('anggota-lembaga.index')
            ->with('success', 'Anggota Lembaga berhasil dihapus.');
    }
}
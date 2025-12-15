<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AnggotaLembaga extends Model
{
    use HasFactory;

    protected $table = 'anggota_lembaga';
    protected $primaryKey = 'anggota_id';

    protected $fillable = [
        'lembaga_id',
        'warga_id',
        'jabatan_id',
        'tgl_mulai',
        'tgl_selesai'
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
    ];

    /**
     * Relasi ke Lembaga
     */
    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * Relasi ke Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * Relasi ke Jabatan
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->whereHas('warga', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('lembaga', function ($q) use ($search) {
                    $q->where('nama_lembaga', 'like', '%' . $search . '%');
                })
                ->orWhereHas('jabatan', function ($q) use ($search) {
                    $q->where('nama_jabatan', 'like', '%' . $search . '%');
                });
            });
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan lembaga
     */
    public function scopeFilterByLembaga($query, $lembagaId)
    {
        if ($lembagaId) {
            return $query->where('lembaga_id', $lembagaId);
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan jabatan
     */
    public function scopeFilterByJabatan($query, $jabatanId)
    {
        if ($jabatanId) {
            return $query->where('jabatan_id', $jabatanId);
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeFilterByStatus($query, $status)
    {
        if ($status === 'aktif') {
            return $query->where(function ($q) {
                $q->whereNull('tgl_selesai')
                  ->orWhere('tgl_selesai', '>=', Carbon::now()->format('Y-m-d'));
            });
        } elseif ($status === 'tidak_aktif') {
            return $query->where('tgl_selesai', '<', Carbon::now()->format('Y-m-d'));
        }
        return $query;
    }

    /**
     * Accessor untuk status
     */
    public function getStatusAttribute()
    {
        if (!$this->tgl_selesai || $this->tgl_selesai >= Carbon::now()) {
            return 'aktif';
        }
        return 'tidak_aktif';
    }

    /**
     * Accessor untuk periode formatted
     */
    public function getPeriodeFormattedAttribute()
    {
        $mulai = $this->tgl_mulai ? $this->tgl_mulai->format('d/m/Y') : '-';
        $selesai = $this->tgl_selesai ? $this->tgl_selesai->format('d/m/Y') : 'Sekarang';
        
        return $mulai . ' s/d ' . $selesai;
    }

    /**
     * Check if there's overlapping period for same warga and lembaga
     */
    public static function hasOverlappingPeriod($wargaId, $lembagaId, $jabatanId, $tglMulai, $tglSelesai = null, $excludeId = null)
    {
        $query = self::where('warga_id', $wargaId)
                     ->where('lembaga_id', $lembagaId)
                     ->where('jabatan_id', $jabatanId);

        if ($excludeId) {
            $query->where('anggota_id', '!=', $excludeId);
        }

        // Check for overlapping periods
        $query->where(function ($q) use ($tglMulai, $tglSelesai) {
            if ($tglSelesai) {
                // New period has end date
                $q->where(function ($subQ) use ($tglMulai, $tglSelesai) {
                    $subQ->where(function ($innerQ) use ($tglMulai, $tglSelesai) {
                        // Existing period has no end date (ongoing)
                        $innerQ->whereNull('tgl_selesai')
                               ->where('tgl_mulai', '<=', $tglSelesai);
                    })
                    ->orWhere(function ($innerQ) use ($tglMulai, $tglSelesai) {
                        // Existing period has end date
                        $innerQ->whereNotNull('tgl_selesai')
                               ->where('tgl_mulai', '<=', $tglSelesai)
                               ->where('tgl_selesai', '>=', $tglMulai);
                    });
                });
            } else {
                // New period has no end date (ongoing)
                $q->where(function ($subQ) use ($tglMulai) {
                    $subQ->whereNull('tgl_selesai')
                         ->orWhere('tgl_selesai', '>=', $tglMulai);
                });
            }
        });

        return $query->exists();
    }
}
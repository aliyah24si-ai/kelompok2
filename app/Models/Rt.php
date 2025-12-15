<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $primaryKey = 'rt_id';

    protected $fillable = [
        'rw_id',
        'nomor_rt',
        'ketua_rt_warga_id',
        'keterangan'
    ];

    /**
     * Relasi ke RW (Many to One)
     */
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'rw_id');
    }

    /**
     * Relasi ke Warga sebagai Ketua RT (Many to One)
     */
    public function ketuaRt()
    {
        return $this->belongsTo(Warga::class, 'ketua_rt_warga_id', 'warga_id');
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nomor_rt', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%')
                  ->orWhereHas('rw', function ($q) use ($search) {
                      $q->where('nomor_rw', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('ketuaRt', function ($q) use ($search) {
                      $q->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan RW
     */
    public function scopeFilterByRw($query, $rwId)
    {
        if ($rwId) {
            return $query->where('rw_id', $rwId);
        }
        return $query;
    }
}
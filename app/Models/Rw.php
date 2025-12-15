<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rw';
    protected $primaryKey = 'rw_id';

    protected $fillable = [
        'nomor_rw',
        'ketua_rw_warga_id',
        'keterangan'
    ];

    /**
     * Relasi ke RT (One to Many)
     */
    public function rts()
    {
        return $this->hasMany(Rt::class, 'rw_id', 'rw_id');
    }

    /**
     * Relasi ke Warga sebagai Ketua RW (Many to One)
     */
    public function ketuaRw()
    {
        return $this->belongsTo(Warga::class, 'ketua_rw_warga_id', 'warga_id');
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nomor_rw', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%')
                  ->orWhereHas('ketuaRw', function ($q) use ($search) {
                      $q->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }
        return $query;
    }
}
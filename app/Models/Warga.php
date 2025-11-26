<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Warga extends Model
{
    use HasFactory;

    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
        'foto_profil_path',
    ];

    protected $appends = [
        'foto_profil_url',
    ];

    public function files()
    {
        return $this->hasMany(WargaFile::class, 'warga_id', 'warga_id');
    }

    public function getFotoProfilUrlAttribute(): string
    {
        if (!$this->foto_profil_path) {
            return asset('vendor/adminlte/dist/img/avatar5.png');
        }

        return Storage::disk('public')->url($this->foto_profil_path);
    }

    // warga_id TIDAK masuk fillable, jadi otomatis
}

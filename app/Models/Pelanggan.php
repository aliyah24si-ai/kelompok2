<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'email',
        'telepon',
        'kota',
        'alamat',
        'catatan',
    ];

    public function files()
    {
        return $this->hasMany(PelangganFile::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desa'; // UBAH INI - SESUAIKAN DENGAN MIGRATION
    protected $primaryKey = 'lembaga_id';
    
    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
    ];

    // TAMBAHKAN RELATIONSHIP
    public function jabatans()
    {
        return $this->hasMany(Jabatan::class, 'lembaga_id', 'lembaga_id');
    }
}
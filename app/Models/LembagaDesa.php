<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desas'; // Sesuai dengan nama tabel di database
    protected $primaryKey = 'lembaga_id';
    
    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
    ];
}
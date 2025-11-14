<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = ['lembaga_id', 'nama_jabatan', 'level'];

    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id', 'lembaga_id');
    }
}
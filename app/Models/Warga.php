<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Warga extends Model
{
    use HasFactory;

    protected $primaryKey = 'warga_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'warga_id',
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
        'foto_profil_path',
    ];

    protected $casts = [
        'warga_id' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'warga_id';
    }

    /**
     * Columns that are searchable via scopeSearch
     */
    protected $searchableColumns = ['nama', 'no_ktp', 'email', 'pekerjaan', 'telp'];

    /**
     * Get the files for the warga.
     */
    public function wargaFiles()
    {
        return $this->hasMany(WargaFile::class, 'warga_id', 'warga_id');
    }

    /**
     * Scope untuk filter berdasarkan search (searchable columns)
     * Usage: Warga::search($request)->get();
     */
    public function scopeSearch($query, $request, array $columns = [])
    {
        if ($request instanceof \Illuminate\Http\Request && $request->filled('q')) {
            $searchTerm = $request->q;
            if (empty($columns)) {
                $columns = $this->searchableColumns;
            }

            $query->where(function ($q) use ($searchTerm, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }

        return $query;
    }

    /**
     * Format jenis kelamin
     */
    public function getJenisKelaminFormattedAttribute()
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Get URL foto profil
     */
    public function getFotoProfilUrlAttribute()
    {
        if ($this->foto_profil_path && file_exists(storage_path('app/public/' . $this->foto_profil_path))) {
            return asset('storage/' . $this->foto_profil_path);
        }
        
        return null;
    }

    /**
     * Get file icon berdasarkan ekstensi file
     */
    public function getFileIcon($fileName)
    {
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $icons = [
            'pdf' => 'fas fa-file-pdf text-danger',
            'doc' => 'fas fa-file-word text-primary',
            'docx' => 'fas fa-file-word text-primary',
            'xls' => 'fas fa-file-excel text-success',
            'xlsx' => 'fas fa-file-excel text-success',
            'jpg' => 'fas fa-file-image text-warning',
            'jpeg' => 'fas fa-file-image text-warning',
            'png' => 'fas fa-file-image text-warning',
            'gif' => 'fas fa-file-image text-warning',
        ];
        
        return $icons[$extension] ?? 'fas fa-file text-secondary';
    }
}
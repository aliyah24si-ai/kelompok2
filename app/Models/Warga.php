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
        if ($this->foto_profil_path && Storage::disk('public')->exists($this->foto_profil_path)) {
            return Storage::disk('public')->url($this->foto_profil_path);
        }
        
        // Fallback ke default avatar
        return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIyNCIgY3k9IjI0IiByPSIyNCIgZmlsbD0idXJsKCNwYWludDBfbGluZWFyXzQ4XzQ4KSIvPjxwYXRoIGQ9Ik0yNCAyOEMyNy44NjYgMjggMzEgMjQuODY2IDMxIDIxQzMxIDE3LjEzNCAyNy44NjYgMTQgMjQgMTRDMjAuMTM0IDE0IDE3IDE3LjEzNCAxNyAyMUMxNyAyNC44NjYgMjAuMTM0IDI4IDI0IDI4WiIgZmlsbD0id2hpdGUiLz48cGF0aCBkPSJNMzYgMzRDNDAuNDE4MyAzNCA0NCAzMC40MTgzIDQ0IDI2QzQ0IDIxLjU4MTcgNDAuNDE4MyAxOCAzNiAxOEMzMS41ODE3IDE4IDI4IDIxLjU4MTcgMjggMjZDMjggMzAuNDE4MyAzMS41ODE3IDM0IDM2IDM0WiIgZmlsbD0id2hpdGUiLz48ZGVmcz48bGluZWFyR3JhZGllbnQgaWQ9InBhaW50MF9saW5lYXJfNDhfNDgiIHgxPSIyNCIgeTE9IjAiIHgyPSIyNCIgeTI9IjQ4IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHN0b3Agc3RvcC1jb2xvcj0iIzY2N0VFQSIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzc2NEJBMiIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjwvc3ZnPg==';
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
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WargaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'original_name',
        'file_path',
        'file_size',
        'mime_type',
    ];

    protected $appends = [
        'file_url',
        'readable_size',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function getFileUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    public function getReadableSizeAttribute(): string
    {
        if ($this->file_size <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $index = 0;

        while ($size >= 1024 && $index < count($units) - 1) {
            $size /= 1024;
            $index++;
        }

        return number_format($size, $index === 0 ? 0 : 2) . ' ' . $units[$index];
    }
}


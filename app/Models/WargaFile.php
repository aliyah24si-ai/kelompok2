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
        'file_icon',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function getFileUrlAttribute(): string
    {
        if ($this->file_path && Storage::disk('public')->exists($this->file_path)) {
            return Storage::disk('public')->url($this->file_path);
        }
        
        return '#';
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

    public function getFileIconAttribute(): string
    {
        $mime = strtolower($this->mime_type);
        $extension = strtolower(pathinfo($this->original_name, PATHINFO_EXTENSION));
        
        // Cek berdasarkan mime type
        if (str_contains($mime, 'pdf')) {
            return 'fas fa-file-pdf text-danger';
        }
        
        if (str_contains($mime, 'word') || in_array($extension, ['doc', 'docx'])) {
            return 'fas fa-file-word text-primary';
        }
        
        if (str_contains($mime, 'excel') || in_array($extension, ['xls', 'xlsx'])) {
            return 'fas fa-file-excel text-success';
        }
        
        if (str_contains($mime, 'image') || in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            return 'fas fa-file-image text-warning';
        }
        
        return 'fas fa-file text-secondary';
    }

    /**
     * Check if file is image
     */
    public function getIsImageAttribute(): bool
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $extension = strtolower(pathinfo($this->original_name, PATHINFO_EXTENSION));
        
        return in_array($extension, $imageExtensions) || 
               str_contains(strtolower($this->mime_type), 'image');
    }
}
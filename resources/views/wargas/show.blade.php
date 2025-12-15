@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('adminlte::page')

@section('title', 'Detail Warga')

@section('content_header')
    <h1>Detail Warga</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="detail-avatar mx-auto mb-3">
                        @if($warga->foto_profil_path && file_exists(storage_path('app/public/'.$warga->foto_profil_path)))
                            <img src="{{ asset('storage/'.$warga->foto_profil_path) }}" 
                                 alt="{{ $warga->nama }}" 
                                 class="img-fluid rounded-circle"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="avatar-placeholder" style="display: none;">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        @else
                            <div class="avatar-placeholder">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <h4 class="fw-bold mb-1">{{ $warga->nama }}</h4>
                    <p class="text-muted mb-0">{{ $warga->pekerjaan }}</p>
                    <p class="text-muted">{{ $warga->email ?: '-' }}</p>
                    <span class="badge bg-primary">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-light">
                    <strong>Dokumen Terunggah</strong>
                </div>
                <div class="card-body">
                    @php
                        $files = $warga->wargaFiles ?? collect();
                        $fileCount = is_object($files) ? $files->count() : (is_array($files) ? count($files) : 0);
                    @endphp
                    
                    @if($fileCount > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($files as $file)
                                @php
                                    // Gunakan accessor file_url dari model yang sudah diperbaiki
                                    $currentFileUrl = $file->file_url ?? '#';
                                    
                                    // Double check untuk memastikan URL valid
                                    if ($currentFileUrl === '#' || empty($currentFileUrl)) {
                                        $currentFileUrl = '#';
                                    }
                                @endphp
                                
                                <li class="list-group-item d-flex justify-content-between flex-wrap align-items-center document-item">
                                    <div class="flex-grow-1">
                                        <i class="fas fa-file-alt me-2 text-primary"></i>
                                        <strong>{{ $file->original_name ?? 'Dokumen' }}</strong>
                                        <small class="text-muted d-block">{{ $file->readable_size ?? '0 B' }}</small>
                                    </div>
                                    <div class="ms-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary doc-view-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#docModal{{ $file->id ?? $loop->index }}"
                                                title="Lihat Dokumen">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if($currentFileUrl && $currentFileUrl !== '#')
                                            <a href="{{ $currentFileUrl }}" class="btn btn-sm btn-outline-success ms-2" 
                                               target="_blank" title="Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </li>

                                <!-- Modal untuk Dokumen -->
                                <div class="modal fade" id="docModal{{ $file->id ?? $loop->index }}" tabindex="-1" 
                                     aria-labelledby="docModalLabel{{ $file->id ?? $loop->index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content border-0 doc-modal-content">
                                            <div class="modal-header doc-modal-header">
                                                <h5 class="modal-title" id="docModalLabel{{ $file->id ?? $loop->index }}">
                                                    <i class="fas fa-file-alt me-2"></i>{{ $file->original_name ?? 'Dokumen' }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body doc-modal-body">
                                                @php
                                                    $fileName = $file->original_name ?? '';
                                                    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                                    $imageExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                    
                                                    // Gunakan URL yang sudah digenerate di atas
                                                    $modalFileUrl = $currentFileUrl;
                                                @endphp
                                                
                                                @if($modalFileUrl && $modalFileUrl !== '#')
                                                    @if(in_array($ext, $imageExts))
                                                        <img src="{{ $modalFileUrl }}" alt="{{ $fileName }}" class="img-fluid doc-preview" 
                                                             style="max-height: 500px; width: 100%; object-fit: contain;"
                                                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <div class="text-center py-5" style="display: none;">
                                                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                                            <p class="text-muted">Gambar tidak dapat dimuat</p>
                                                        </div>
                                                    @elseif($ext === 'pdf')
                                                        <iframe src="{{ $modalFileUrl }}" style="width: 100%; height: 500px; border: none; border-radius: 10px;"
                                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"></iframe>
                                                        <div class="text-center py-5" style="display: none;">
                                                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                                            <p class="text-muted">PDF tidak dapat dimuat dalam preview</p>
                                                            <a href="{{ $modalFileUrl }}" class="btn btn-primary btn-sm" target="_blank">
                                                                <i class="fas fa-download me-2"></i>Download PDF
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="text-center py-5">
                                                            <i class="fas fa-file fa-5x text-muted mb-3"></i>
                                                            <p class="text-muted">
                                                                File tipe <strong>{{ $ext ? strtoupper($ext) : 'Unknown' }}</strong> 
                                                                tidak dapat ditampilkan dalam preview.
                                                            </p>
                                                            <a href="{{ $modalFileUrl }}" class="btn btn-primary btn-sm" target="_blank">
                                                                <i class="fas fa-download me-2"></i>Download File
                                                            </a>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="text-center py-5">
                                                        <i class="fas fa-exclamation-circle fa-5x text-danger mb-3"></i>
                                                        <p class="text-danger">
                                                            <strong>File tidak ditemukan!</strong>
                                                        </p>
                                                        <p class="text-muted">File mungkin telah dipindahkan atau dihapus.</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer doc-modal-footer">
                                                <p class="text-muted mb-0 me-auto"><small>Ukuran: {{ $file->readable_size ?? '0 B' }}</small></p>
                                                @if($modalFileUrl && $modalFileUrl !== '#')
                                                    <a href="{{ $modalFileUrl }}" class="btn btn-primary doc-download-btn" target="_blank">
                                                        <i class="fas fa-download me-2"></i>Download
                                                    </a>
                                                @endif
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada dokumen terunggah.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <strong>Informasi Warga</strong>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ID Warga</dt>
                        <dd class="col-sm-8">{{ $warga->warga_id }}</dd>

                        <dt class="col-sm-4">No KTP</dt>
                        <dd class="col-sm-8">{{ $warga->no_ktp }}</dd>

                        <dt class="col-sm-4">Agama</dt>
                        <dd class="col-sm-8">{{ $warga->agama }}</dd>

                        <dt class="col-sm-4">Nomor Telepon</dt>
                        <dd class="col-sm-8">{{ $warga->telp ?: '-' }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $warga->email ?: '-' }}</dd>

                        <dt class="col-sm-4">Dibuat</dt>
                        <dd class="col-sm-8">{{ $warga->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-4">Diupdate</dt>
                        <dd class="col-sm-8">{{ $warga->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                    <div class="mt-4">
                        <a href="{{ route('wargas.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('wargas.edit', $warga) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    /* ===== VARIABLES ===== */
    :root {
        --purple-light: #8B5CF6 !important;
        --purple: #7C3AED !important;
        --purple-dark: #6D28D9 !important;
        --shadow: 0 5px 20px rgba(139, 92, 246, 0.15) !important;
        --light-bg: #F9FAFB !important;
    }

    /* ===== OVERRIDE BOOTSTRAP/ADMINLTE ===== */
    .card.shadow-sm.border-0 {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: var(--shadow) !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1) !important;
        overflow: hidden !important;
        background: white !important;
    }

    .card.shadow-sm.border-0:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 15px 40px rgba(139, 92, 246, 0.25) !important;
    }

    /* ===== CARD HEADER ===== */
    .card-header.bg-light {
        background: linear-gradient(135deg, #F7FAFC 0%, #EDF2F7 100%) !important;
        border-bottom: 2px solid var(--purple) !important;
        color: var(--purple-dark) !important;
        font-weight: 600 !important;
        padding: 1rem 1.5rem !important;
        font-size: 1.1rem !important;
    }

    /* ===== PROFILE AVATAR ===== */
    .detail-avatar {
        width: 160px !important;
        height: 160px !important;
        border-radius: 50% !important;
        overflow: hidden !important;
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2) !important;
        border: 5px solid white !important;
        position: relative !important;
        transition: all 0.4s ease !important;
    }

    .detail-avatar:hover {
        transform: scale(1.05) !important;
        box-shadow: 0 15px 40px rgba(139, 92, 246, 0.3) !important;
    }

    .detail-avatar img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform 0.5s ease !important;
    }

    .detail-avatar:hover img {
        transform: scale(1.1) !important;
    }

    .detail-avatar .avatar-placeholder {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
        color: white !important;
        font-size: 3rem !important;
    }

    /* ===== BADGE ===== */
    .badge.bg-primary {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
        padding: 0.5rem 1.2rem !important;
        border-radius: 20px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3) !important;
    }

    /* ===== BUTTONS ===== */
    .btn.btn-secondary {
        background: linear-gradient(135deg, #718096 0%, #4A5568 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        color: white !important;
        padding: 0.75rem 1.5rem !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(113, 128, 150, 0.3) !important;
    }

    .btn.btn-secondary:hover {
        background: linear-gradient(135deg, #4A5568 0%, #2D3748 100%) !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 20px rgba(74, 85, 104, 0.4) !important;
        color: white !important;
    }

    .btn.btn-warning {
        background: linear-gradient(135deg, #ECC94B 0%, #D69E2E 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        color: white !important;
        padding: 0.75rem 1.5rem !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(236, 201, 75, 0.3) !important;
    }

    .btn.btn-warning:hover {
        background: linear-gradient(135deg, #D69E2E 0%, #B7791F 100%) !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 20px rgba(214, 158, 46, 0.4) !important;
        color: white !important;
    }

    /* ===== DOCUMENT ITEM ===== */
    .document-item {
        padding: 1rem !important;
        border-radius: 10px !important;
        transition: all 0.3s ease !important;
        background: #FAFAFA !important;
        margin-bottom: 0.5rem !important;
    }

    .document-item:hover {
        background: linear-gradient(135deg, #F3E8FF 0%, #FAF5FF 100%) !important;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15) !important;
        transform: translateX(5px) !important;
    }

    /* ===== MODAL STYLES ===== */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    .doc-modal-content {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 20px 60px rgba(139, 92, 246, 0.3) !important;
        background: white !important;
        overflow: hidden !important;
        animation: slideInUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1) !important;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .doc-modal-header {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
        border: none !important;
        color: white !important;
        padding: 1.5rem !important;
        font-weight: 600 !important;
    }

    .doc-modal-header .btn-close {
        filter: brightness(0) invert(1) !important;
        opacity: 0.8 !important;
    }

    .doc-modal-header .btn-close:hover {
        opacity: 1 !important;
    }

    .doc-modal-body {
        padding: 2rem !important;
        background: #FAFBFC !important;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 300px;
    }

    .doc-preview {
        border-radius: 12px !important;
        box-shadow: 0 8px 24px rgba(139, 92, 246, 0.2) !important;
        animation: fadeIn 0.5s ease !important;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .doc-modal-footer {
        background: white !important;
        border-top: 1px solid #E2E8F0 !important;
        padding: 1.5rem !important;
    }

    /* ===== DOCUMENT VIEW BUTTON ===== */
    .doc-view-btn {
        border: 2px solid var(--purple) !important;
        color: var(--purple) !important;
        border-radius: 8px !important;
        padding: 0.4rem 0.75rem !important;
        font-size: 0.9rem !important;
        transition: all 0.3s ease !important;
        white-space: nowrap !important;
    }

    .doc-view-btn:hover {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
        color: white !important;
        border-color: transparent !important;
        transform: scale(1.05) !important;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3) !important;
    }

    /* ===== DOWNLOAD BUTTON ===== */
    .doc-download-btn {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        color: white !important;
        padding: 0.7rem 1.2rem !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3) !important;
    }

    .doc-download-btn:hover {
        background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4) !important;
        color: white !important;
    }

    .btn-outline-success {
        border-color: #10b981 !important;
        color: #10b981 !important;
        transition: all 0.3s ease !important;
    }

    .btn-outline-success:hover {
        background-color: #10b981 !important;
        border-color: #10b981 !important;
        color: white !important;
        transform: scale(1.05) !important;
    }
</style>
@stop

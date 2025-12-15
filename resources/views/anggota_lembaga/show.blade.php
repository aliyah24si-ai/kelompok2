@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('adminlte::page')

@section('title', 'Detail Anggota Lembaga')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Detail Anggota Lembaga</h1>
        <div>
            <a href="{{ route('anggota-lembaga.edit', $item->anggota_id) }}" class="btn pd-btn">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card pd-animated">
                <div class="card-header pd-gradient">
                    <h5 style="color: white; margin: 0;">Informasi Anggota Lembaga</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="25%"><strong>Nama Warga</strong></td>
                            <td>: {{ $item->warga ? $item->warga->nama : '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. KTP</strong></td>
                            <td>: {{ $item->warga ? $item->warga->no_ktp : '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Lembaga</strong></td>
                            <td>: {{ $item->lembaga ? $item->lembaga->nama_lembaga : '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jabatan</strong></td>
                            <td>: {{ $item->jabatan ? $item->jabatan->nama_jabatan : 'Tidak ada jabatan khusus' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Mulai</strong></td>
                            <td>: {{ $item->tgl_mulai ? $item->tgl_mulai->format('d/m/Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Selesai</strong></td>
                            <td>: {{ $item->tgl_selesai ? $item->tgl_selesai->format('d/m/Y') : 'Masih aktif' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>: 
                                @if($item->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Periode</strong></td>
                            <td>: {{ $item->periode_formatted }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat</strong></td>
                            <td>: {{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Diperbarui</strong></td>
                            <td>: {{ $item->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            @if($item->warga)
            <div class="card pd-animated">
                <div class="card-header bg-info text-white">
                    <h5 style="margin: 0;">Informasi Warga</h5>
                </div>
                <div class="card-body">
                    <h6><strong>{{ $item->warga->nama }}</strong></h6>
                    <p class="text-muted mb-1"><i class="fas fa-id-card"></i> {{ $item->warga->no_ktp }}</p>
                    <p class="text-muted mb-1"><i class="fas fa-{{ $item->warga->jenis_kelamin == 'L' ? 'mars' : 'venus' }}"></i> {{ $item->warga->jenis_kelamin_formatted }}</p>
                    <p class="text-muted mb-1"><i class="fas fa-briefcase"></i> {{ $item->warga->pekerjaan }}</p>
                    @if($item->warga->telp)
                        <p class="text-muted mb-1"><i class="fas fa-phone"></i> {{ $item->warga->telp }}</p>
                    @endif
                    @if($item->warga->email)
                        <p class="text-muted"><i class="fas fa-envelope"></i> {{ $item->warga->email }}</p>
                    @endif
                </div>
            </div>
            @endif
            
            @if($item->lembaga)
            <div class="card pd-animated mt-3">
                <div class="card-header bg-success text-white">
                    <h5 style="margin: 0;">Informasi Lembaga</h5>
                </div>
                <div class="card-body">
                    <h6><strong>{{ $item->lembaga->nama_lembaga }}</strong></h6>
                    <p class="text-muted mb-2">{{ $item->lembaga->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    @if($item->lembaga->kontak)
                        <p class="mb-0"><i class="fas fa-phone"></i> {{ $item->lembaga->kontak }}</p>
                    @endif
                </div>
            </div>
            @endif
            
            @if($item->jabatan)
            <div class="card pd-animated mt-3">
                <div class="card-header bg-warning text-white">
                    <h5 style="margin: 0;">Informasi Jabatan</h5>
                </div>
                <div class="card-body">
                    <h6><strong>{{ $item->jabatan->nama_jabatan }}</strong></h6>
                    <p class="text-muted mb-0">Level: {{ $item->jabatan->level }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
@stop

@section('css')
    <style>
        /* ===== VARIABLES ===== */
        :root {
            --purple-light: #8B5CF6;
            --purple: #7C3AED;
            --purple-dark: #6D28D9;
            --shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
        }

        /* ===== CARD ===== */
        .pd-animated {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
            margin-top: 20px;
        }

        .pd-animated:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        }

        /* ===== HEADER CARD ===== */
        .pd-gradient {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%);
            border-bottom: none;
            padding: 1.25rem 1.5rem;
            color: white;
            font-size: 1.1rem;
        }

        .pd-gradient h5 {
            font-weight: 700;
            letter-spacing: 0.3px;
            margin: 0;
        }

        /* ===== CUSTOM BUTTONS ===== */
        .pd-btn {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pd-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(139, 92, 246, 0.3);
            color: white;
        }

        .btn-outline-secondary {
            border: 2px solid #A0AEC0;
            color: #4A5568;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: #4A5568;
            color: white;
            transform: translateY(-2px);
        }

        /* ===== TABLE ===== */
        .table-borderless td {
            padding: 0.75rem 0;
            border: none;
            font-size: 0.95rem;
        }

        .table-borderless td:first-child {
            color: #4A5568;
            font-weight: 600;
        }

        /* ===== BADGE ===== */
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-success {
            background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
            color: white;
        }

        .badge-danger {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
            color: white;
        }

        /* ===== CARD HEADERS ===== */
        .bg-info {
            background: linear-gradient(135deg, #4299E1 0%, #3182CE 100%) !important;
        }

        .bg-success {
            background: linear-gradient(135deg, #48BB78 0%, #38A169 100%) !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #ED8936 0%, #DD6B20 100%) !important;
        }

        /* ===== IMAGE ===== */
        .img-fluid {
            transition: all 0.3s ease;
        }

        .img-fluid:hover {
            transform: scale(1.05);
        }



        /* ===== TEXT ===== */
        .text-muted {
            color: #A0AEC0 !important;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .pd-animated {
                border-radius: 12px;
                margin-top: 15px;
            }
            
            .pd-gradient {
                padding: 1rem 1.25rem;
            }
            
            .table-borderless td {
                padding: 0.5rem 0;
                font-size: 0.9rem;
            }
            
            .pd-btn, .btn-outline-secondary {
                padding: 0.65rem 1.25rem;
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }
            
            .img-fluid {
                width: 120px !important;
                height: 120px !important;
            }
        }
    </style>
@stop


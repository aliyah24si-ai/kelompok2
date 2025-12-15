@extends('adminlte::page')

@section('title', 'Detail Lembaga')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Detail Lembaga</h1>
        <div>
            <a href="{{ route('lembaga.edit', $lembaga->lembaga_id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('lembaga.index') }}" class="btn btn-outline-secondary btn-sm ml-1">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <!-- CARD INFORMASI LEMBAGA -->
            <div class="card mb-3">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-building me-2"></i>Informasi Lembaga
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td class="border-0" width="40%"><strong>Nama Lembaga</strong></td>
                                    <td class="border-0">: <strong class="text-primary">{{ $lembaga->nama_lembaga }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Kontak</strong></td>
                                    <td class="border-0">: 
                                        @if($lembaga->kontak)
                                            <span class="badge badge-success">{{ $lembaga->kontak }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Dibuat</strong></td>
                                    <td class="border-0">: {{ $lembaga->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td class="border-0" width="40%"><strong>ID Lembaga</strong></td>
                                    <td class="border-0">: <span class="badge bg-primary">#{{ $lembaga->lembaga_id }}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Diperbarui</strong></td>
                                    <td class="border-0">: {{ $lembaga->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Jumlah Anggota</strong></td>
                                    <td class="border-0">: 
                                        <span class="badge badge-info">
                                            {{ $lembaga->anggotaLembaga ? $lembaga->anggotaLembaga->count() : 0 }} anggota
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    @if($lembaga->deskripsi)
                    <div class="mt-4">
                        <h6 class="text-muted mb-2"><i class="fas fa-sticky-note me-1"></i> Deskripsi</h6>
                        <div class="p-3 bg-light rounded">
                            {{ $lembaga->deskripsi }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- CARD DAFTAR ANGGOTA -->
            @if($lembaga->anggotaLembaga && $lembaga->anggotaLembaga->count() > 0)
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-users me-2"></i>Daftar Anggota Lembaga
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Anggota</th>
                                    <th>Jabatan</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lembaga->anggotaLembaga as $index => $anggota)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $anggota->warga ? $anggota->warga->nama : '-' }}</td>
                                    <td>{{ $anggota->jabatan ? $anggota->jabatan->nama_jabatan : '-' }}</td>
                                    <td class="text-center">
                                        @if($anggota->status == 'aktif')
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Total: {{ $lembaga->anggotaLembaga->count() }} anggota
                        </small>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>Daftar Anggota Lembaga
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <p class="mb-2">Belum ada anggota di lembaga ini</p>
                        <small>Tambahkan anggota melalui menu Anggota Lembaga</small>
                    </div>
                </div>
            </div>
            @endif
        </div>

            <!-- CARD STATISTIK -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>Statistik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="display-4 text-primary">{{ $lembaga->anggotaLembaga ? $lembaga->anggotaLembaga->count() : 0 }}</div>
                        <p class="text-muted mb-0">Total Anggota</p>
                    </div>
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> 
                        {{ $lembaga->nama_lembaga }} memiliki {{ $lembaga->anggotaLembaga ? $lembaga->anggotaLembaga->count() : 0 }} anggota
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus lembaga:</p>
                    <div class="alert alert-warning">
                        <strong>{{ $lembaga->nama_lembaga }}</strong>
                    </div>
                    <p class="text-danger"><small><i class="fas fa-exclamation-circle me-1"></i> Aksi ini tidak dapat dibatalkan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('lembaga.destroy', $lembaga->lembaga_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%) !important;
    }

    .bg-gradient-secondary {
        background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%) !important;
    }

    .card {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .card-header {
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    .table-sm td {
        padding: 0.4rem 0.3rem;
    }

    .btn-warning {
        background-color: #F59E0B;
        border-color: #F59E0B;
        color: white;
    }

    .btn-warning:hover {
        background-color: #D97706;
        border-color: #D97706;
        color: white;
    }

    .badge {
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .ml-1 {
            margin-left: 0 !important;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Auto dismiss alerts
        setTimeout(function() {
            $('.alert').fadeOut(300, function() {
                $(this).alert('close');
            });
        }, 5000);
    });
</script>
@stop
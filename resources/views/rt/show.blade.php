@extends('adminlte::page')

@section('title', 'Detail RT')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Detail RT {{ $rt->nomor_rt }} - RW {{ $rt->rw->nomor_rw }}</h1>
        <div>
            <a href="{{ route('rt.edit', $rt->rt_id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('rt.index') }}" class="btn btn-outline-secondary btn-sm ml-1">
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
            <!-- CARD INFORMASI RT -->
            <div class="card mb-3">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-info-circle me-2"></i>Informasi RT
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td class="border-0" width="40%"><strong>RW</strong></td>
                                    <td class="border-0">: <span class="badge bg-primary">RW {{ $rt->rw->nomor_rw }}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Nomor RT</strong></td>
                                    <td class="border-0">: <span class="badge bg-purple">RT {{ $rt->nomor_rt }}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Ketua RT</strong></td>
                                    <td class="border-0">: {{ $rt->ketuaRt->nama ?? '<span class="text-muted">Belum ada ketua</span>' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td class="border-0" width="40%"><strong>Dibuat</strong></td>
                                    <td class="border-0">: {{ $rt->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Diperbarui</strong></td>
                                    <td class="border-0">: {{ $rt->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Status</strong></td>
                                    <td class="border-0">: <span class="badge badge-success">Aktif</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    @if($rt->keterangan)
                    <div class="mt-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-sticky-note me-1"></i> Keterangan</h6>
                        <div class="p-3 bg-light rounded">
                            {{ $rt->keterangan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- CARD INFORMASI KETUA RT -->
            @if($rt->ketuaRt)
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-user-tie me-2"></i>Informasi Ketua RT
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            @if($rt->ketuaRt->foto_profil_path && file_exists(public_path('storage/'.$rt->ketuaRt->foto_profil_path)))
                                <img src="{{ asset('storage/'.$rt->ketuaRt->foto_profil_path) }}" 
                                     alt="Foto {{ $rt->ketuaRt->nama }}" 
                                     class="rounded-circle img-thumbnail" 
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-purple text-white" 
                                     style="width: 100px; height: 100px; margin: 0 auto;">
                                    <i class="fas fa-user" style="font-size: 40px;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <table class="table table-sm">
                                <tr>
                                    <td class="border-0" width="30%"><strong>Nama</strong></td>
                                    <td class="border-0">: {{ $rt->ketuaRt->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>No. KTP</strong></td>
                                    <td class="border-0">: {{ $rt->ketuaRt->no_ktp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Telepon</strong></td>
                                    <td class="border-0">: {{ $rt->ketuaRt->telp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-0"><strong>Alamat</strong></td>
                                    <td class="border-0">: {{ $rt->ketuaRt->alamat ?? '-' }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('wargas.show', $rt->ketuaRt->warga_id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i> Lihat Detail Warga
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-md-4">
            <!-- CARD INFORMASI RW -->
            <div class="card mb-3">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-home me-2"></i>Informasi RW
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td class="border-0" width="40%"><strong>RW</strong></td>
                            <td class="border-0">: <span class="badge bg-primary">RW {{ $rt->rw->nomor_rw }}</span></td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Ketua RW</strong></td>
                            <td class="border-0">: {{ $rt->rw->ketuaRw->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Total RT</strong></td>
                            <td class="border-0">: {{ $rt->rw->rts->count() }} RT</td>
                        </tr>
                    </table>
                    <div class="mt-2">
                        <a href="{{ route('rw.show', $rt->rw->rw_id) }}" class="btn btn-sm btn-success w-100">
                            <i class="fas fa-eye me-1"></i> Lihat Detail RW
                        </a>
                    </div>
                </div>
            </div>
            

            <!-- CARD STATUS -->
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2 text-purple"></i>Statistik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="display-4 text-purple">{{ $rt->rw->rts->count() }}</div>
                        <p class="text-muted mb-0">Total RT di RW {{ $rt->rw->nomor_rw }}</p>
                    </div>
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> 
                        RT ini bagian dari wilayah RW {{ $rt->rw->nomor_rw }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data RT berikut?</p>
                    <div class="alert alert-warning">
                        <strong>RT {{ $rt->nomor_rt }}</strong> - RW {{ $rt->rw->nomor_rw }}
                    </div>
                    <p class="text-danger"><small><i class="fas fa-exclamation-circle me-1"></i> Aksi ini tidak dapat dibatalkan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('rt.destroy', $rt->rt_id) }}" method="POST">
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
    /* WARNA UNGU */
    :root {
        --purple-light: #8B5CF6;
        --purple: #7C3AED;
        --purple-dark: #6D28D9;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple-dark) 100%) !important;
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%) !important;
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
    }

    .bg-gradient-secondary {
        background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%) !important;
    }

    .bg-purple {
        background-color: var(--purple) !important;
        color: white;
    }

    .badge.bg-purple {
        background-color: var(--purple) !important;
        color: white;
    }

    .text-purple {
        color: var(--purple) !important;
    }

    .card {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
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

    /* RESPONSIVE */
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
        
        // Delete confirmation
        $('#deleteModal').on('show.bs.modal', function (event) {
            var modal = $(this);
        });
        
        // Tooltip
        $('[title]').tooltip();
    });
</script>
@stop
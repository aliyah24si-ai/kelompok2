@extends('adminlte::page')

@section('title', 'Detail RW')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Detail RW {{ $rw->nomor_rw }}</h1>
        <div>
            <a href="{{ route('rw.edit', $rw->rw_id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('rw.index') }}" class="btn btn-outline-secondary btn-sm ml-1">
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
        <div class="col-md-6">
            <!-- CARD INFORMASI RW -->
            <div class="card mb-3">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-home me-2"></i>Informasi RW
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td class="border-0" width="40%"><strong>Nomor RW</strong></td>
                            <td class="border-0">: <span class="badge bg-primary">RW {{ $rw->nomor_rw }}</span></td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Ketua RW</strong></td>
                            <td class="border-0">: {{ $rw->ketuaRw->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Jumlah RT</strong></td>
                            <td class="border-0">: {{ $rw->rts->count() }} RT</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Dibuat</strong></td>
                            <td class="border-0">: {{ $rw->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Diperbarui</strong></td>
                            <td class="border-0">: {{ $rw->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Status</strong></td>
                            <td class="border-0">: <span class="badge badge-success">Aktif</span></td>
                        </tr>
                    </table>

                    <!-- Keterangan -->
                    @if($rw->keterangan)
                    <div class="mt-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-sticky-note me-1"></i> Keterangan</h6>
                        <div class="p-3 bg-light rounded">
                            {{ $rw->keterangan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- CARD INFORMASI KETUA RW -->
            @if($rw->ketuaRw)
            <div class="card">
                <div class="card-header bg-gradient-info">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-user-tie me-2"></i>Informasi Ketua RW
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td class="border-0" width="30%"><strong>Nama</strong></td>
                            <td class="border-0">: {{ $rw->ketuaRw->nama }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>No. KTP</strong></td>
                            <td class="border-0">: {{ $rw->ketuaRw->no_ktp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Telepon</strong></td>
                            <td class="border-0">: {{ $rw->ketuaRw->telp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="border-0"><strong>Alamat</strong></td>
                            <td class="border-0">: {{ $rw->ketuaRw->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-md-6">
            <!-- CARD DAFTAR RT -->
            <div class="card">
                <div class="card-header bg-gradient-success">
                    <h5 class="card-title mb-0 text-white">
                        <i class="fas fa-list me-2"></i>Daftar RT di RW {{ $rw->nomor_rw }}
                    </h5>
                </div>
                <div class="card-body">
                    @if($rw->rts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">RT</th>
                                        <th>Ketua RT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rw->rts as $index => $rt)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-purple">RT {{ $rt->nomor_rt }}</span>
                                        </td>
                                        <td>{{ $rt->ketuaRt->nama ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Total: {{ $rw->rts->count() }} RT
                            </small>
                        </div>
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p class="mb-2">Belum ada RT di RW ini</p>
                            <small>Tambahkan RT melalui menu Data RT</small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- CARD STATISTIK -->
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>Statistik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="display-4 text-primary">{{ $rw->rts->count() }}</div>
                            <p class="text-muted mb-0">Total RT</p>
                        </div>
                        <div class="col-6">
                            <div class="display-4 text-success">{{ $rw->nomor_rw }}</div>
                            <p class="text-muted mb-0">Nomor RW</p>
                        </div>
                    </div>
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i> 
                        RW {{ $rw->nomor_rw }} terdiri dari {{ $rw->rts->count() }} RT
                    </small>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    /* WARNA BIRU (SERAGAM DATA WARGA) */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%) !important;
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
    }

    .bg-purple {
        background-color: #8B5CF6 !important;
        color: white;
    }

    .badge.bg-purple {
        background-color: #8B5CF6 !important;
        color: white;
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
@extends('adminlte::page')

@section('title', 'Daftar Jabatan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Daftar Jabatan</h1>
        <a href="{{ route('jabatan.create') }}" class="btn pd-add-btn">
            <i class="fas fa-plus me-1"></i>Tambah
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

    <!-- FILTER CARD (DENGAN WARNA UNGU ANGGOTA LEMBAGA) -->
    <div class="card pd-animated">
        <div class="card-header pd-gradient">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <h3 class="card-title mb-2 mb-md-0" style="color: white;">Filter Jabatan</h3>
                <form method="GET" action="{{ route('jabatan.index') }}" class="w-100 w-md-auto">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-5 col-md-6 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50 d-block">Cari (Nama Jabatan / Lembaga)</label>
                            <div class="position-relative">
                                <i class="fas fa-search position-absolute text-muted" style="left: 12px; top: 50%; transform: translateY(-50%); font-size: 14px; z-index: 10;"></i>
                                <input type="text" name="q" class="form-control border-0"
                                       placeholder="Ketik kata kunci..."
                                       value="{{ request('q') }}"
                                       style="background: rgba(255,255,255,0.9); height: 38px; padding-left: 40px; border-radius: 8px;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50 d-block">Lembaga</label>
                            <select name="lembaga_id" class="form-select border-0" style="background: rgba(255,255,255,0.9); height: 38px; border-radius: 8px;">
                                <option value="">Semua Lembaga</option>
                                @foreach($lembagas as $lembaga)
                                    <option value="{{ $lembaga->lembaga_id }}" {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                        {{ $lembaga->nama_lembaga }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-2 d-flex gap-2 align-items-end">
                            <button type="submit" class="btn btn-light btn-sm flex-fill" style="height: 38px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <a href="{{ route('jabatan.index') }}" class="btn btn-outline-light btn-sm px-3" style="height: 38px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TABEL DATA DENGAN WARNA UNGU -->
    <div class="card pd-animated mt-3">
        <div class="card-header pd-gradient d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0" style="color: white;">Daftar Jabatan ({{ $jabatans->total() }} data)</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, #5c76f6ff 0%, #287bd9ff 100%);">
                        <tr>
                            <th width="8%" style="color: white; border: none;">ID</th>
                            <th width="25%" style="color: white; border: none;">Lembaga</th>
                            <th width="25%" style="color: white; border: none;">Nama Jabatan</th>
                            <th width="15%" style="color: white; border: none; text-align: center;">Level</th>
                            <th width="27%" style="color: white; border: none; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jabatans as $item)
                            <tr>
                                <td class="text-center fw-bold">{{ $item->id }}</td>
                                <td>{{ $item->lembaga->nama_lembaga ?? 'N/A' }}</td>
                                <td><strong>{{ $item->nama_jabatan }}</strong></td>
                                <td class="text-center">
                                    @if($item->level == 'Pimpinan')
                                        <span class="badge badge-pd-success">{{ $item->level }}</span>
                                    @elseif($item->level == 'Manager')
                                        <span class="badge badge-pd-primary">{{ $item->level }}</span>
                                    @elseif($item->level == 'Staff')
                                        <span class="badge badge-pd-warning">{{ $item->level }}</span>
                                    @else
                                        <span class="badge badge-pd-secondary">{{ $item->level }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('jabatan.show', $item->id) }}" 
                                           class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('jabatan.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" 
                                                title="Hapus"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->nama_jabatan }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <div class="empty-state-pd">
                                        <i class="fas fa-briefcase fa-3x mb-3"></i>
                                        <h5 class="mb-2">Tidak ada data jabatan</h5>
                                        <p class="text-muted mb-0">
                                            @if(request()->has('q') || request()->has('lembaga_id') || request()->has('level'))
                                                Tidak ada jabatan yang sesuai dengan filter pencarian
                                            @else
                                                Mulai dengan menambahkan data jabatan baru
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($jabatans->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                <div class="data-info-pd">
                    <i class="fas fa-chart-bar me-1"></i>
                    <span class="text-muted">
                        Menampilkan <strong>{{ $jabatans->firstItem() ?? 0 }}</strong> - 
                        <strong>{{ $jabatans->lastItem() ?? 0 }}</strong> dari 
                        <strong>{{ $jabatans->total() }}</strong> data
                    </span>
                </div>
                
                <div class="pagination-container">
                    {{ $jabatans->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
                       
            </div>
        </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
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
                    <p>Apakah Anda yakin ingin menghapus jabatan:</p>
                    <p class="fw-bold" id="delete-item-name"></p>
                    <p class="text-danger"><small>Aksi ini tidak dapat dibatalkan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form id="delete-form" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    /* ===== VARIABLES UNGU ===== */
    :root {
        --pd-light: #8B5CF6;
        --pd: #7C3AED;
        --pd-dark: #6D28D9;
        --pd-shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
        --pd-hover: 0 8px 30px rgba(139, 92, 246, 0.25);
    }

    /* ===== FILTER FORM SPACING ===== */
    .pd-gradient .row {
        margin: 0;
    }
    
    .pd-gradient .row > [class*="col-"] {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
    
    .pd-gradient .form-control,
    .pd-gradient .form-select {
        min-width: 0;
        width: 100%;
        height: 38px !important;
    }
    
    /* Search input with icon */
    .pd-gradient .position-relative {
        width: 100%;
    }
    
    .pd-gradient .position-relative .form-control {
        height: 38px !important;
        border: none !important;
        border-radius: 8px !important;
        padding-left: 40px !important;
    }
    
    .pd-gradient .position-relative .fa-search {
        color: #6c757d !important;
        pointer-events: none;
    }
    
    .pd-gradient .btn {
        height: 38px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    .pd-gradient label {
        display: block !important;
        margin-bottom: 4px !important;
        line-height: 1.2 !important;
    }
    
    /* Ensure proper spacing between filter elements */
    .pd-gradient .row.g-3 > * {
        margin-bottom: 0.75rem;
    }
    
    @media (min-width: 992px) {
        .pd-gradient .row.g-3 > * {
            margin-bottom: 0;
        }
    }

    /* ===== CARD SMOOTH ===== */
    .pd-animated {
        border: none;
        border-radius: 16px;
        box-shadow: var(--pd-shadow);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
    }

    .pd-animated:hover {
        transform: translateY(-3px);
        box-shadow: var(--pd-hover);
    }

    /* ===== HEADER CARD ===== */
    .pd-gradient {
        background: linear-gradient(135deg, var(--pd-light) 0%, var(--pd) 50%, var(--pd-dark) 100%);
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        transition: all 0.3s ease;
    }

    /* ===== TOMBOL TAMBAH ===== */
    .pd-add-btn {
        background: linear-gradient(135deg, var(--pd-light) 0%, var(--pd-dark) 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .pd-add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(139, 92, 246, 0.4);
        color: white;
    }

    /* ===== FORM INPUT SMOOTH ===== */
    .form-control, .form-select {
        border: 2px solid #E2E8F0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--pd-light);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        outline: none;
        transform: translateY(-1px);
    }

    /* ===== BUTTON FILTER ===== */
    .btn-light {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: var(--pd-dark);
    }

    .btn-light:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        color: var(--pd-dark);
    }

    .btn-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.7);
        color: white;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
        background: white;
        color: var(--pd-dark);
        transform: translateY(-2px);
        border-color: white;
    }

    /* ===== TABLE SMOOTH ===== */
    .table-responsive {
        border-radius: 0 0 16px 16px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th {
        border: none !important;
        padding: 1rem;
        font-size: 0.95rem;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
    }

    .table td {
        border: none;
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(139, 92, 246, 0.08);
        transition: all 0.3s ease;
    }

    .table tbody tr {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .table tbody tr:hover {
        background: rgba(139, 92, 246, 0.04);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.1);
    }

    /* ===== BADGE SMOOTH ===== */
    .badge-pd-success {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.2);
        transition: all 0.3s ease;
    }

    .badge-pd-primary {
        background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.2);
        transition: all 0.3s ease;
    }

    .badge-pd-warning {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(245, 158, 11, 0.2);
        transition: all 0.3s ease;
    }

    .badge-pd-secondary {
        background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(107, 114, 128, 0.2);
        transition: all 0.3s ease;
    }

    .badge-pd-success:hover, .badge-pd-primary:hover, .badge-pd-warning:hover, .badge-pd-secondary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* ===== ACTION BUTTONS SMOOTH ===== */
    .action-buttons {
        display: flex;
        gap: 6px;
        justify-content: center;
    }

    .btn-sm {
        border-radius: 10px;
        padding: 0.5rem;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .btn-info {
        background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
        color: white;
    }

    .btn-warning {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: white;
    }

    .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        color: white;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state-pd {
        padding: 3rem 1rem;
        text-align: center;
    }

    .empty-state-pd i {
        color: var(--pd-light);
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.6;
    }

    .empty-state-pd h5 {
        color: #4B5563;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state-pd p {
        color: #9CA3AF;
        font-size: 0.95rem;
    }

    /* ===== CARD FOOTER ===== */
    .card-footer {
        background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%);
        border-top: 1px solid rgba(139, 92, 246, 0.1);
        padding: 1.25rem 1.5rem;
        transition: all 0.3s ease;
    }

    .data-info-pd {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .data-info-pd i {
        color: var(--pd-light);
        font-size: 1rem;
    }

    .data-info-pd span {
        color: #6B7280;
        font-size: 0.9rem;
    }

    .data-info-pd strong {
        color: #374151;
        font-weight: 600;
    }

    /* ===== ALERTS ===== */
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        border: none;
        border-left: 4px solid #10B981;
        border-radius: 12px;
        color: #065F46;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
    }

    .alert-danger {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        border: none;
        border-left: 4px solid #EF4444;
        border-radius: 12px;
        color: #7F1D1D;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);
    }

    /* ===== MODAL STYLES ===== */
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .modal-header {
        border-radius: 12px 12px 0 0;
        padding: 16px 24px;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        border-top: 1px solid #e2e8f0;
        padding: 16px 24px;
    }

    /* ===== LABEL TEXT ===== */
    .text-white-50 {
        color: rgba(255, 255, 255, 0.8) !important;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* ===== TEXT ALIGNMENT ===== */
    .table td:nth-child(2),
    .table td:nth-child(3) {
        text-align: left;
    }

    .table th:first-child,
    .table td:first-child,
    .table th:nth-child(4),
    .table td:nth-child(4),
    .table th:nth-child(5),
    .table td:nth-child(5) {
        text-align: center;
    }

    /* ===== ANIMASI ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .pd-animated {
        animation: fadeInUp 0.5s ease-out;
    }

    /* ===== FILTER FORM SPACING ===== */
    .pd-gradient .row {
        margin: 0;
    }
    
    .pd-gradient .row > [class*="col-"] {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
    
    .pd-gradient .form-control,
    .pd-gradient .form-select {
        min-width: 0;
        width: 100%;
    }
    
    .pd-gradient .input-group {
        width: 100%;
    }
    
    /* Ensure proper spacing between filter elements */
    .pd-gradient .row.g-3 > * {
        margin-bottom: 0.75rem;
    }
    
    @media (min-width: 992px) {
        .pd-gradient .row.g-3 > * {
            margin-bottom: 0;
        }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .pd-gradient .row {
            gap: 8px;
        }
        
        .pd-gradient [class*="col-"] {
            margin-bottom: 12px;
        }
        
        .pd-gradient .d-flex {
            flex-direction: column;
            gap: 8px;
        }
        
        .pd-gradient .btn {
            width: 100%;
        }
        
        .table-responsive {
            border-radius: 0 0 12px 12px;
        }
        
        .table th,
        .table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }
        
        .btn-sm {
            width: 32px;
            height: 32px;
            font-size: 13px;
            padding: 0.4rem;
        }
        
        .badge-pd-success,
        .badge-pd-primary,
        .badge-pd-warning,
        .badge-pd-secondary {
            padding: 0.3rem 0.7rem;
            font-size: 0.75rem;
        }
        
        .card-footer {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        
        .data-info-pd {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }
        
        .btn-sm {
            width: 100%;
            height: 32px;
            justify-content: center;
        }
        
        .pd-add-btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        /* Stack filter elements vertically on mobile */
        .pd-gradient .row {
            flex-direction: column;
        }
        
        .pd-gradient [class*="col-"] {
            width: 100%;
            max-width: 100%;
            flex: 0 0 100%;
        }
        
        .pd-gradient .d-flex.gap-2 {
            flex-direction: row;
            gap: 8px;
        }
        
        .pd-gradient .btn {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
        }
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Auto dismiss alerts dengan animasi smooth
        setTimeout(function() {
            $('.alert').fadeOut(300, function() {
                $(this).alert('close');
            });
        }, 4000);

        // Delete confirmation modal
        $('.delete-btn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const formAction = "{{ route('jabatan.destroy', ':id') }}".replace(':id', id);
            
            $('#delete-item-name').text(name);
            $('#delete-form').attr('action', formAction);
            $('#deleteModal').modal('show');
        });

        // Hover effect pada card
        $('.pd-animated').hover(
            function() {
                $(this).css('transform', 'translateY(-3px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );

        // Smooth focus pada input search
        @if(request()->has('q'))
            setTimeout(function() {
                $('input[name="q"]').focus().select();
            }, 300);
        @endif

        // Loading state pada form filter
        $('form[method="GET"]').on('submit', function(e) {
            const $filterBtn = $(this).find('button[type="submit"]');
            const originalHtml = $filterBtn.html();
            
            $filterBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Memproses...')
                     .prop('disabled', true)
                     .css('opacity', '0.8');
        });

        // Animasi pada tombol aksi
        $('.action-buttons .btn').hover(
            function() {
                $(this).css({
                    'transform': 'translateY(-2px) scale(1.05)',
                    'transition': 'all 0.2s ease'
                });
            },
            function() {
                $(this).css({
                    'transform': 'translateY(0) scale(1)',
                    'transition': 'all 0.3s ease'
                });
            }
        );

        // Tooltip dengan delay
        $('[title]').tooltip({
            placement: 'top',
            trigger: 'hover',
            container: 'body',
            delay: { show: 300, hide: 100 }
        });

        // Animasi pada baris tabel saat hover
        $('.table tbody tr').hover(
            function() {
                $(this).css({
                    'transform': 'translateY(-1px)',
                    'box-shadow': '0 4px 12px rgba(139, 92, 246, 0.1)'
                });
            },
            function() {
                $(this).css({
                    'transform': 'translateY(0)',
                    'box-shadow': 'none'
                });
            }
        );
    });
</script>
@stop
@php
use Illuminate\Support\Facades\Storage;
@endphp

@extends('adminlte::page')

@section('title', 'Anggota Lembaga')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Anggota Lembaga</h1>
        <a href="{{ route('anggota-lembaga.create') }}" class="btn pd-add-btn">
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
                <h3 class="card-title mb-2 mb-md-0" style="color: white;">Filter Anggota Lembaga</h3>
                <form method="GET" action="{{ route('anggota-lembaga.index') }}" class="w-100 w-md-auto">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-4 col-md-6 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50 d-block">Cari (Nama / Lembaga / Jabatan)</label>
                            <div class="position-relative">
                                <i class="fas fa-search position-absolute text-muted" style="left: 12px; top: 50%; transform: translateY(-50%); font-size: 14px; z-index: 10;"></i>
                                <input type="text" name="search" class="form-control border-0"
                                       placeholder="Ketik kata kunci..."
                                       value="{{ request('search') }}"
                                       style="background: rgba(255,255,255,0.9); height: 38px; padding-left: 40px; border-radius: 8px;">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50 d-block">Lembaga</label>
                            <select name="lembaga_id" class="form-select form-select-sm border-0" style="background: rgba(255,255,255,0.9); height: 38px;">
                                <option value="">Semua Lembaga</option>
                                @foreach($lembagas as $lembaga)
                                    <option value="{{ $lembaga->lembaga_id }}" 
                                        {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                        {{ $lembaga->nama_lembaga }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50 d-block">Status</label>
                            <select name="status" class="form-select form-select-sm border-0" style="background: rgba(255,255,255,0.9); height: 38px;">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-8 d-flex gap-2 align-items-end">
                            <button type="submit" class="btn btn-light btn-sm flex-fill" style="height: 38px;">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-outline-light btn-sm px-3" style="height: 38px; display: flex; align-items: center; justify-content: center;">
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
            <h3 class="card-title m-0" style="color: white;">Daftar Anggota Lembaga ({{ $items->total() }} data)</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);">
                        <tr>
                            <th width="5%" style="color: white; border: none;">No</th>
                            <th width="8%" style="color: white; border: none;">Foto</th>
                            <th width="20%" style="color: white; border: none;">Nama Warga</th>
                            <th width="20%" style="color: white; border: none;">Lembaga</th>
                            <th width="15%" style="color: white; border: none;">Jabatan</th>
                            <th width="15%" style="color: white; border: none;">Periode</th>
                            <th width="10%" style="color: white; border: none; text-align: center;">Status</th>
                            <th width="7%" style="color: white; border: none; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $i => $item)
                            <tr>
                                <td class="text-center fw-bold">{{ $items->firstItem() + $i }}</td>
                                <td class="text-center">
                                    @if($item->warga && $item->warga->foto_profil_path && file_exists(public_path('storage/'.$item->warga->foto_profil_path)))
                                        <img src="{{ asset('storage/'.$item->warga->foto_profil_path) }}" 
                                             alt="{{ $item->warga->nama }}" 
                                             class="table-avatar-pd"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIyNCIgY3k9IjI0IiByPSIyNCIgZmlsbD0iIzhCNUNGNiIvPjxwYXRoIGQ9Ik0yNCAyOEMyNy44NjYgMjggMzEgMjQuODY2IDMxIDIxQzMxIDE3LjEzNCAyNy44NjYgMTQgMjQgMTRDMjAuMTM0IDE0IDE3IDE3LjEzNCAxNyAyMUMxNyAyNC44NjYgMjAuMTM0IDI4IDI0IDI4WiIgZmlsbD0id2hpdGUiLz48cGF0aCBkPSJNMzYgMzRDNDAuNDE4MyAzNCA0NCAzMC40MTgzIDQ0IDI2QzQ0IDIxLjU4MTcgNDAuNDE4MyAxOCAzNiAxOEMzMS41ODE3IDE4IDI4IDIxLjU4MTcgMjggMjZDMjggMzAuNDE4MyAzMS41ODE3IDM0IDM2IDM0WiIgZmlsbD0id2hpdGUiLz48L3N2Zz4=';">
                                    @else
                                        <div class="avatar-placeholder-pd">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $item->warga ? $item->warga->nama : '-' }}</strong></td>
                                <td>{{ $item->lembaga ? $item->lembaga->nama_lembaga : '-' }}</td>
                                <td>{{ $item->jabatan ? $item->jabatan->nama_jabatan : '-' }}</td>
                                <td>
                                    <small>{{ $item->periode_formatted }}</small>
                                </td>
                                <td class="text-center">
                                    @if($item->status == 'aktif')
                                        <span class="badge badge-pd-success">Aktif</span>
                                    @else
                                        <span class="badge badge-pd-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('anggota-lembaga.show', $item->anggota_id) }}" 
                                           class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('anggota-lembaga.edit', $item->anggota_id) }}" 
                                           class="btn btn-warning btn-sm" title="Ubah">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('anggota-lembaga.destroy', $item->anggota_id) }}" 
                                              method="POST" style="display:inline;" 
                                              onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <div class="empty-state-pd">
                                        <i class="fas fa-users fa-3x mb-3"></i>
                                        <h5 class="mb-2">Tidak ada data anggota lembaga</h5>
                                        <p class="text-muted mb-0">Mulai dengan menambahkan data anggota baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($items->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                <div class="data-info-pd">
                    <i class="fas fa-chart-bar me-1"></i>
                    <span class="text-muted">
                        Menampilkan <strong>{{ $items->firstItem() ?? 0 }}</strong> - 
                        <strong>{{ $items->lastItem() ?? 0 }}</strong> dari 
                        <strong>{{ $items->total() }}</strong> data
                    </span>
                </div>
                
                <div class="pagination-container">
                    <!-- PAGINATION DENGAN CSS INLINE -->
                    @if($items->hasPages())
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($items->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #a0aec0;
                                        font-weight: 600;
                                        background: white;
                                        cursor: not-allowed;
                                    ">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->previousPageUrl() }}" style="
                                        border: 2px solid #8b5cf6;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $current = $items->currentPage();
                                $last = $items->lastPage();
                                $start = max(1, $current - 2);
                                $end = min($last, $current + 2);
                                
                                if($end - $start < 4) {
                                    if($start == 1) {
                                        $end = min(5, $last);
                                    } else {
                                        $start = max(1, $last - 4);
                                    }
                                }
                            @endphp

                            @if($start > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->url(1) }}" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        1
                                    </a>
                                </li>
                                @if($start > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link" style="
                                            border: 2px solid #e2e8f0;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: #a0aec0;
                                            font-weight: 600;
                                            background: white;
                                            cursor: default;
                                        ">
                                            ...
                                        </span>
                                    </li>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $items->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link" style="
                                            border: 2px solid #8b5cf6;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: white;
                                            font-weight: 600;
                                            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
                                            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
                                            cursor: default;
                                        ">
                                            {{ $page }}
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $items->url($page) }}" style="
                                            border: 2px solid #e2e8f0;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: #8b5cf6;
                                            font-weight: 600;
                                            background: white;
                                            text-decoration: none;
                                            transition: all 0.3s ease;
                                        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endfor

                            @if($end < $last)
                                @if($end < $last - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link" style="
                                            border: 2px solid #e2e8f0;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: #a0aec0;
                                            font-weight: 600;
                                            background: white;
                                            cursor: default;
                                        ">
                                            ...
                                        </span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->url($last) }}" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        {{ $last }}
                                    </a>
                                </li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($items->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->nextPageUrl() }}" style="
                                        border: 2px solid #8b5cf6;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #a0aec0;
                                        font-weight: 600;
                                        background: white;
                                        cursor: not-allowed;
                                    ">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
@stop

@section('css')
<style>
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

    /* ===== VARIABLES UNGU ===== */
    :root {
        --pd-light: #8B5CF6;
        --pd: #7C3AED;
        --pd-dark: #6D28D9;
        --pd-shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
        --pd-hover: 0 8px 30px rgba(139, 92, 246, 0.25);
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

    /* ===== AVATAR ===== */
    .table-avatar-pd {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .table-avatar-pd:hover {
        transform: scale(1.1);
        border-color: var(--pd-light);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .table-avatar-pd img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-placeholder-pd {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--pd-light) 0%, var(--pd-dark) 100%);
        color: white;
        font-size: 20px;
        border-radius: 50%;
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

    .badge-pd-danger {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.2);
        transition: all 0.3s ease;
    }

    .badge-pd-success:hover, .badge-pd-danger:hover {
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

    /* ===== LABEL TEXT ===== */
    .text-white-50 {
        color: rgba(255, 255, 255, 0.8) !important;
        font-size: 0.85rem;
        font-weight: 500;
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
        
        .table-avatar-pd {
            width: 40px;
            height: 40px;
        }
        
        .avatar-placeholder-pd {
            font-size: 16px;
        }
        
        .badge-pd-success,
        .badge-pd-danger {
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
    }

    /* ===== TEXT ALIGNMENT ===== */
    .table td:nth-child(3),
    .table td:nth-child(4),
    .table td:nth-child(5),
    .table td:nth-child(6) {
        text-align: left;
    }

    .table th:first-child,
    .table td:first-child,
    .table th:nth-child(2),
    .table td:nth-child(2),
    .table th:nth-child(7),
    .table td:nth-child(7),
    .table th:nth-child(8),
    .table td:nth-child(8) {
        text-align: center;
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
        @if(request()->has('search'))
            setTimeout(function() {
                $('input[name="search"]').focus().select();
            }, 300);
        @endif

        // Loading state pada form filter
        $('form[method="GET"]').on('submit', function(e) {
            const $filterBtn = $(this).find('button[type="submit"]');
            const originalHtml = $filterBtn.html();
            
            $filterBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Memproses...')
                     .prop('disabled', true)
                     .css('opacity', '0.8');
            
            // Smooth scroll ke tabel setelah filter
            setTimeout(function() {
                $('html, body').animate({
                    scrollTop: $('.table-responsive').offset().top - 100
                }, 500);
            }, 100);
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

        // Confirmation sebelum hapus dengan animasi
        $('form[onsubmit]').on('submit', function(e) {
            if (!confirm('Yakin ingin menghapus data ini?')) {
                e.preventDefault();
                return false;
            }
            
            // Animasi loading pada tombol hapus
            const $submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = $submitBtn.html();
            
            $submitBtn.html('<i class="fas fa-spinner fa-spin"></i>')
                     .prop('disabled', true)
                     .css('opacity', '0.7');
            
            // Restore tombol setelah 3 detik jika gagal
            setTimeout(function() {
                $submitBtn.html(originalHtml)
                         .prop('disabled', false)
                         .css('opacity', '1');
            }, 3000);
        });

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

        // Smooth scroll untuk pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            
            $('html, body').animate({
                scrollTop: 0
            }, 300, function() {
                window.location.href = url;
            });
        });
    });
</script>
@stop
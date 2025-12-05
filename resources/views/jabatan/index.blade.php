@extends('adminlte::page')

@section('title', 'Daftar Jabatan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">Daftar Jabatan</h1>
        <a href="{{ route('jabatan.create') }}" class="btn btn-primary pd-add-btn">
            <i class="fas fa-plus me-1"></i>Tambah Jabatan
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

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Daftar Jabatan</h3>
        </div>
        
        <div class="card-body">
            <!-- Ganti bagian form filter ini -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('jabatan.index') }}" method="GET" class="form-inline pd-filter-form">
                        <!-- Search -->
                        <div class="form-group mr-3 mb-2">
                            <input type="text" 
                                   name="search" 
                                   class="form-control pd-search-input" 
                                   placeholder="Cari nama jabatan..."
                                   value="{{ request('search') }}">
                        </div>
                        
                        <!-- Filter Lembaga -->
                        <div class="form-group mr-3 mb-2">
                            <select name="lembaga_id" class="form-control pd-select-input">
                                <option value="">Semua Lembaga</option>
                                @foreach($lembagas as $lembaga)
                                    <option value="{{ $lembaga->lembaga_id }}" 
                                        {{ request('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                        {{ $lembaga->nama_lembaga }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Filter Level -->
                        <div class="form-group mr-3 mb-2">
                            <select name="level" class="form-control pd-select-input">
                                <option value="">Semua Level</option>
                                <option value="Pimpinan" {{ request('level') == 'Pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                                <option value="Manager" {{ request('level') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Staff" {{ request('level') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Operator" {{ request('level') == 'Operator' ? 'selected' : '' }}>Operator</option>
                            </select>
                        </div>
                        
                        <!-- Tombol -->
                        <div class="form-group mb-2 pd-button-group">
                            <button type="submit" class="btn btn-info mr-2 pd-btn-filter">
                                <i class="fas fa-search me-1"></i>Filter
                            </button>
                            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary pd-btn-reset">
                                <i class="fas fa-refresh me-1"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card pd-animated mt-3">
        <div class="card-header pd-gradient">
            <h5 style="color: white; margin: 0;">Daftar Jabatan </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-lightblue">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Lembaga</th>
                            <th width="25%">Nama Jabatan</th>
                            <th width="15%">Level</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jabatans as $jabatan)
                        <tr>
                            <td class="text-center fw-bold">{{ $jabatan->id }}</td>
                            <td style="max-width: 250px; word-wrap: break-word;">
                                {{ $jabatan->lembaga->nama_lembaga ?? 'N/A' }}
                            </td>
                            <td style="max-width: 250px; word-wrap: break-word;">
                                {{ $jabatan->nama_jabatan }}
                            </td>
                            <td class="text-center">
                                <span class="badge 
                                    @if($jabatan->level == 'Pimpinan') badge-success
                                    @elseif($jabatan->level == 'Manager') badge-primary
                                    @elseif($jabatan->level == 'Staff') badge-warning
                                    @else badge-secondary @endif">
                                    {{ $jabatan->level }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('jabatan.show', $jabatan->id) }}" 
                                   class="btn btn-info btn-sm" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('jabatan.edit', $jabatan->id) }}" 
                                   class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jabatan.destroy', $jabatan->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Yakin ingin menghapus jabatan ini?')"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-database fa-2x mb-2"></i><br>
                                @if(request()->has('search') || request()->has('lembaga_id') || request()->has('level'))
                                    Tidak ada data jabatan yang sesuai dengan filter
                                @else
                                    Tidak ada data jabatan
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination dengan CSS Inline -->
            @if($jabatans->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $jabatans->firstItem() ?? 0 }} - {{ $jabatans->lastItem() ?? 0 }} dari {{ $jabatans->total() }} data
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($jabatans->onFirstPage())
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
                                    <a class="page-link" href="{{ $jabatans->previousPageUrl() }}" rel="prev" style="
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
                                $current = $jabatans->currentPage();
                                $last = $jabatans->lastPage();
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
                                    <a class="page-link" href="{{ $jabatans->url(1) }}" style="
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
                                @if ($page == $jabatans->currentPage())
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
                                        <a class="page-link" href="{{ $jabatans->url($page) }}" style="
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
                                    <a class="page-link" href="{{ $jabatans->url($last) }}" style="
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
                            @if ($jabatans->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $jabatans->nextPageUrl() }}" rel="next" style="
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
            --teal-light: #99F6E4;
            --teal: #2DD4BF;
            --teal-dark: #14B8A6;
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-purple: 0 10px 15px -3px rgba(139, 92, 246, 0.1);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* ===== HEADER CARD TITLE - PERBAIKAN ===== */
        .pd-gradient h5 {
            font-weight: 600;
            letter-spacing: 0.2px;
            margin: 0;
            position: relative;
            z-index: 1;
            font-size: 1.05rem;
        }

        .pd-gradient {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%);
            border-bottom: none;
            padding: 1rem 1.5rem; /* Sedikit lebih kecil */
            color: white;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        /* ===== FORM FILTER - PERBAIKAN UTAMA ===== */
        .pd-filter-form {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            gap: 12px;
            width: 100%;
        }

        .pd-filter-form .form-group {
            margin-bottom: 0 !important;
            flex: 1;
            min-width: 180px;
        }

        .pd-search-input, .pd-select-input {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
            border: 2px solid #E2E8F0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f8fafc;
        }

        .pd-search-input:focus, .pd-select-input:focus {
            border-color: var(--purple-light);
            background: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
            outline: none;
            transform: translateY(-2px);
        }

        .pd-button-group {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
            min-width: 200px;
        }

        .pd-btn-filter, .pd-btn-reset {
            border-radius: 10px;
            padding: 0.65rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .pd-btn-filter {
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
            color: white;
        }

        .pd-btn-reset {
            background: linear-gradient(135deg, #A0AEC0 0%, #718096 100%);
            color: white;
        }

        .pd-btn-filter:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(45, 212, 191, 0.35);
        }

        .pd-btn-reset:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(113, 128, 150, 0.35);
        }

        /* ===== TOMBOL TAMBAH ===== */
        .pd-add-btn {
            border: none !important;
            border-radius: 12px !important;
            padding: 0.75rem 1.75rem !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
            color: white !important;
            box-shadow: 0 4px 14px rgba(139, 92, 246, 0.4) !important;
            position: relative;
            overflow: hidden;
        }

        .pd-add-btn:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.5) !important;
            animation: pulse 1s infinite !important;
        }

        /* ===== CARD ===== */
        .pd-animated {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            background: white;
            margin-top: 20px;
            animation: fadeIn 0.6s ease-out;
        }

        .pd-animated:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-purple);
        }

        .pd-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.2), 
                transparent);
            transition: left 0.7s ease;
        }

        .pd-gradient:hover::before {
            left: 100%;
        }

        /* ===== TABLE ===== */
        .table-responsive {
            border-radius: 14px;
            overflow: hidden;
            margin-top: 20px;
            border: 1px solid rgba(139, 92, 246, 0.1);
            box-shadow: var(--shadow-light);
        }

        /* TABLE HEADER */
        .table thead {
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
            position: relative;
        }

        .table thead th {
            color: white;
            font-weight: 700;
            border: none;
            padding: 1.1rem 1rem;
            font-size: 0.9rem;
            text-align: center;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            transition: all 0.3s ease;
        }

        .table thead th:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* TABLE BODY */
        .table tbody tr {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, 
                rgba(139, 92, 246, 0.05) 0%, 
                rgba(139, 92, 246, 0.03) 100%);
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.08);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        /* ===== BADGE ===== */
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #A0AEC0 0%, #718096 100%);
            color: white;
        }

        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* ===== TOMBOL AKSI ===== */
        .btn-sm {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            margin: 0 2px;
            min-width: 36px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .pd-filter-form {
                gap: 10px;
            }
            
            .pd-filter-form .form-group {
                min-width: 150px;
            }
            
            .pd-button-group {
                min-width: 180px;
            }
        }

        @media (max-width: 768px) {
            .pd-animated {
                border-radius: 12px;
                margin-top: 15px;
            }
            
            .pd-gradient {
                padding: 0.875rem 1.25rem;
            }
            
            .pd-filter-form {
                flex-direction: column;
                gap: 8px;
            }
            
            .pd-filter-form .form-group {
                min-width: 100% !important;
                width: 100% !important;
            }
            
            .pd-button-group {
                min-width: 100%;
                justify-content: flex-start;
            }
            
            .table-responsive {
                border-radius: 10px;
            }
            
            .table thead th, 
            .table tbody td {
                padding: 0.8rem 0.6rem;
                font-size: 0.85rem;
            }
            
            .btn-sm {
                padding: 0.35rem 0.6rem;
                font-size: 0.75rem;
                margin: 0 1px;
                min-width: 32px;
            }
        }

        @media (max-width: 576px) {
            .pd-gradient h5 {
                font-size: 0.95rem;
            }
            
            .pd-add-btn {
                padding: 0.6rem 1.25rem !important;
                font-size: 0.9rem !important;
            }
            
            .pd-button-group {
                flex-direction: column;
                width: 100%;
            }
            
            .pd-btn-filter, .pd-btn-reset {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@stop
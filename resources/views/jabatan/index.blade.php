@extends('adminlte::page')

@section('title', 'Daftar Jabatan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">Daftar Jabatan</h1>
        <a href="{{ route('jabatan.create') }}" class="btn btn-primary">
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
            <!-- Filter dan Search Form -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('jabatan.index') }}" method="GET" class="form-inline">
                        <!-- Search -->
                        <div class="form-group mr-3 mb-2">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Cari nama jabatan..."
                                   value="{{ request('search') }}"
                                   style="min-width: 250px;">
                        </div>
                        
                        <!-- Filter Lembaga -->
                        <div class="form-group mr-3 mb-2">
                            <select name="lembaga_id" class="form-control" style="min-width: 200px;">
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
                            <select name="level" class="form-control" style="min-width: 150px;">
                                <option value="">Semua Level</option>
                                <option value="Pimpinan" {{ request('level') == 'Pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                                <option value="Manager" {{ request('level') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Staff" {{ request('level') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Operator" {{ request('level') == 'Operator' ? 'selected' : '' }}>Operator</option>
                            </select>
                        </div>
                        
                        <!-- Tombol -->
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-info mr-2">
                                <i class="fas fa-search me-1"></i>Filter
                            </button>
                            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-refresh me-1"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

    <div class="card pd-animated mt-3">
        <div class="card-header pd-gradient">
            <h5 style="color: white; margin: 0;">Daftar Jabatan ({{ $jabatans->total() }} data)</h5>
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

            <!-- Pagination -->
@if($jabatans->hasPages())
<div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted">
        Menampilkan {{ $jabatans->firstItem() ?? 0 }} - {{ $jabatans->lastItem() ?? 0 }} dari {{ $jabatans->total() }} data
    </div>
    <div>
        <nav>
            <ul class="pagination" style="margin-bottom: 0 !important; justify-content: center !important;">
                {{-- Previous Page Link --}}
                @if ($jabatans->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" style="border: 1px solid #e3e6f0 !important; color: #667eea !important; font-weight: 600 !important; padding: 8px 16px !important; margin: 0 3px !important; border-radius: 6px !important; background: white !important;">«</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $jabatans->previousPageUrl() }}" rel="prev" style="border: 1px solid #e3e6f0 !important; color: #667eea !important; font-weight: 600 !important; padding: 8px 16px !important; margin: 0 3px !important; border-radius: 6px !important; background: white !important; text-decoration: none !important;">«</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($jabatans->links()->elements[0] as $page => $url)
                    @if ($page == $jabatans->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; border: 1px solid #667eea !important; color: white !important; font-weight: 600 !important; padding: 8px 16px !important; margin: 0 3px !important; border-radius: 6px !important;">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}" style="border: 1px solid #e3e6f0 !important; color: #667eea !important; font-weight: 600 !important; padding: 8px 16px !important; margin: 0 3px !important; border-radius: 6px !important; background: white !important; text-decoration: none !important;">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($jabatans->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $jabatans->nextPageUrl() }}" rel="next" style="border: 1px solid #e3e6f0 !important; color: #667eea !important; font-weight: 600 !important; padding: 8px 16px !important; margin: 0 3px !important; border-radius: 6px !important; background: white !important; text-decoration: none !important;">»</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" style="border: 1px solid #e3e6f0 !important; color: #667eea !important; font-weight: 600 !important; padding: 8px 16px !important; margin: 0 3px !important; border-radius: 6px !important; background: white !important;">»</span>
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

        /* ===== HEADER CARD ===== */
        .pd-gradient {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%);
            border-bottom: none;
            padding: 1.25rem 1.5rem;
            color: white;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
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

        .pd-gradient h5 {
            font-weight: 700;
            letter-spacing: 0.3px;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* ===== TOMBOL TAMBAH ===== */
        .btn[style*="background: linear-gradient(90deg, #6f42c1, #9b59b6)"] {
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
            color: white;
            box-shadow: 0 4px 14px rgba(139, 92, 246, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn[style*="background: linear-gradient(90deg, #6f42c1, #9b59b6)"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.5);
            animation: pulse 1s infinite;
        }

        /* ===== FORM INPUT ===== */
        .form-control {
            border: 2px solid #E2E8F0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: var(--purple-light);
            background: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
            outline: none;
            transform: translateY(-2px);
        }

        /* ===== CUSTOM BUTTONS ===== */
        .pd-btn {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.65rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);
        }

        .pd-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.35);
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
        }

        .btn-outline-secondary {
            border: 2px solid #CBD5E0;
            color: #4A5568;
            border-radius: 10px;
            padding: 0.65rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            background: white;
        }

        .btn-outline-secondary:hover {
            background: linear-gradient(135deg, #4A5568 0%, #2D3748 100%);
            color: white;
            transform: translateY(-3px);
            border-color: #4A5568;
        }

        /* ===== TABLE ===== */
        .table-responsive {
            border-radius: 14px;
            overflow: hidden;
            margin-top: 20px;
            border: 1px solid rgba(139, 92, 246, 0.1);
            box-shadow: var(--shadow-light);
        }

        /* TABLE HEADER - Gradien teal yang fresh */
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

        /* ===== FOTO ANIMASI ===== */
        .table tbody td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid rgba(139, 92, 246, 0.2);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table tbody td img:hover {
            transform: scale(3) rotate(2deg);
            z-index: 100;
            position: relative;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.2),
                0 0 0 8px rgba(139, 92, 246, 0.1);
            border: 3px solid var(--purple);
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

        .btn-outline-primary {
            background: transparent;
            border: 2px solid #4299E1;
            color: #4299E1;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #4299E1 0%, #3182ce 100%);
            color: white;
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 15px rgba(66, 153, 225, 0.3);
        }

        .pd-btn.btn-sm {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
            border: none;
        }

        .pd-btn.btn-sm:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 15px rgba(139, 92, 246, 0.3);
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
        }

        .btn-outline-danger {
            background: transparent;
            border: 2px solid #FC8181;
            color: #FC8181;
        }

        .btn-outline-danger:hover {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
            color: white;
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 15px rgba(245, 101, 101, 0.3);
        }

        /* ===== NO DATA ===== */
        .text-muted {
            color: #94A3B8;
            font-size: 1.1rem;
            text-align: center;
            padding: 3rem;
            animation: fadeIn 0.8s ease-out;
        }

        .text-muted i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
            color: var(--purple-light);
            animation: pulse 2s infinite;
        }

        /* ===== ALERT ===== */
        .alert-success {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            color: #065F46;
            border: 2px solid #34D399;
            border-radius: 12px;
            margin-bottom: 20px;
            padding: 1rem 1.5rem;
            font-weight: 600;
            animation: fadeIn 0.5s ease-out;
            box-shadow: 0 4px 12px rgba(52, 211, 153, 0.2);
        }

        .alert-success i {
            color: #10B981;
            animation: pulse 1.5s infinite;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            justify-content: center;
            margin-top: 25px;
        }

        .page-link {
            border: 1px solid #E2E8F0;
            color: var(--purple);
            border-radius: 8px;
            margin: 0 4px;
            transition: all 0.3s ease;
            padding: 0.6rem 1rem;
            font-weight: 600;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            border-color: var(--purple);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .page-link:hover {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(124, 58, 237, 0.05) 100%);
            color: var(--purple-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(139, 92, 246, 0.15);
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
            
            .table-responsive {
                border-radius: 10px;
            }
            
            .table thead th, 
            .table tbody td {
                padding: 0.8rem 0.6rem;
                font-size: 0.85rem;
            }
            
            .table tbody td img:hover {
                transform: scale(2.2) rotate(2deg);
            }
            
            .btn-sm {
                padding: 0.35rem 0.6rem;
                font-size: 0.75rem;
                margin: 0 1px;
                min-width: 32px;
            }
            
            .table tbody td img {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 576px) {
            .table tbody tr:hover {
                transform: translateX(2px);
            }
            
            .table tbody td img:hover {
                transform: scale(1.8) rotate(2deg);
            }
            
            .btn[style*="background: linear-gradient(90deg, #6f42c1, #9b59b6)"] {
                padding: 0.6rem 1.25rem;
            }
        }
    </style>
@stop
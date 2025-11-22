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

            <!-- Info Hasil Filter -->
            @if(request()->has('search') || request()->has('lembaga_id') || request()->has('level'))
                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Menampilkan hasil 
                    @if(request('search')) pencarian "{{ request('search') }}" @endif
                    @if(request('lembaga_id')) 
                        @php $lembaga = $lembagas->where('lembaga_id', request('lembaga_id'))->first(); @endphp
                        @if($lembaga) di lembaga {{ $lembaga->nama_lembaga }} @endif
                    @endif
                    @if(request('level')) dengan level {{ request('level') }} @endif
                    <a href="{{ route('jabatan.index') }}" class="float-right text-danger">
                        <i class="fas fa-times"></i> Hapus Filter
                    </a>
                </div>
            @endif

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
        /* CSS yang sama seperti sebelumnya, tetap dipertahankan */
        .bg-lightblue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white;
            font-weight: 600;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .badge {
            font-size: 0.8em;
            padding: 6px 12px;
            border-radius: 15px;
            font-weight: 600;
        }
        
        .table-responsive {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 0;
        }
        
        .table th {
            border: none;
            padding: 15px 12px;
            font-size: 14px;
            text-align: center;
            vertical-align: middle;
        }
        
        .table td {
            border: none;
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
            text-align: center;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }
        
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Badge Colors */
        .badge-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }
        
        .badge-primary {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        }
        
        .badge-warning {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        }
        
        .badge-secondary {
            background: linear-gradient(135deg, #a0aec0 0%, #718096 100%);
        }
        
        /* Button Styles */
        .btn-sm {
            border-radius: 6px;
            padding: 6px 10px;
            margin: 2px;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-info {
            background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }
        
        .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* Tambah Jabatan Button */
        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        }
        
        /* Header Card */
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white;
            border-bottom: none;
            padding: 15px 20px;
        }
        
        .card-title {
            margin: 0;
            font-weight: 600;
            color: white;
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        /* Alert Success */
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: none;
            border-left: 4px solid #28a745;
            border-radius: 8px;
            color: #155724;
        }
        
        /* Empty State */
        .text-muted {
            color: #6c757d !important;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .table td, .table th {
                padding: 8px 6px;
                font-size: 13px;
            }
            
            .btn-sm {
                padding: 4px 8px;
                margin: 1px;
            }
            
            .badge {
                font-size: 0.7em;
                padding: 4px 8px;
            }
            
            .form-inline .form-group {
                margin-bottom: 10px;
                width: 100%;
            }
            
            .form-inline .form-control {
                width: 100% !important;
            }
        }
        
        /* Text alignment for specific columns */
        .table td:first-child,
        .table th:first-child {
            text-align: center;
        }
        
        .table td:nth-child(2),
        .table td:nth-child(3) {
            text-align: left;
        }
        
        /* Content Header */
        .content-header h1 {
            font-weight: 700;
            color: #2d3748;
        }
        
        .me-1 {
            margin-right: 0.25rem !important;
        }
        
        .me-2 {
            margin-right: 0.5rem !important;
        }
        
        .fw-bold {
            font-weight: 700 !important;
        }
        
        /* Filter Form Styles */
        .form-inline .form-group {
            margin-right: 15px;
        }
        
        .alert-info {
            background: linear-gradient(135deg, #bee3f8 0%, #90cdf4 100%);
            border: none;
            border-left: 4px solid #4299e1;
            border-radius: 8px;
            color: #2c5282;
        }

           /* ===== STYLING BARU UNTUK SEARCH/FILTER ===== */
        /* GANTI .form-inline dengan .jabatan-filter */
.jabatan-filter {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e3e6f0;
    margin-bottom: 20px;
    animation: slideDown 0.5s ease-out;
}

.jabatan-filter .form-control {
    border: 2px solid #e2e6ea;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.jabatan-filter .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    transform: translateY(-1px);
}

/* Juga ganti di responsive */
@media (max-width: 768px) {
    .jabatan-filter {
        padding: 15px;
    }
    
    .jabatan-filter .form-group {
        margin-bottom: 15px;
        width: 100%;
    }
    /* ... dan seterusnya */
}
        /* Form Filter Container */
        .form-inline {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e3e6f0;
            margin-bottom: 20px;
        }
        
        
        .form-inline .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-1px);
        }
        
        /* Select Dropdown */
        .form-inline select.form-control {
            background: white url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 12px center/16px 12px;
            padding-right: 35px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        
        /* Tombol Filter */
        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
        }
        
        .btn-info:hover {
            background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.4);
        }
        
        /* Tombol Reset */
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #495057 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
        }
        
        /* Label Group (opsional) */
        .filter-group {
            margin-bottom: 15px;
        }
        
        .filter-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        /* Alert Info Filter Aktif */
        .alert-info {
            background: linear-gradient(135deg, #d6e4ff 0%, #adc8ff 100%);
            border: none;
            border-left: 4px solid #667eea;
            border-radius: 8px;
            color: #2d3748;
            font-weight: 500;
        }
        
        .alert-info .float-right {
            color: #e53e3e !important;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .alert-info .float-right:hover {
            color: #c53030 !important;
            transform: scale(1.05);
        }
        
        /* Pagination Styling */
        .pagination {
            margin-bottom: 0;
        }
        
        .page-link {
            border: 1px solid #e3e6f0;
            color: #667eea;
            font-weight: 600;
            padding: 8px 16px;
            margin: 0 3px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .page-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
            transform: translateY(-1px);
        }
        
        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
        }
        
        /* Info Pagination */
        .text-muted {
            color: #6c757d !important;
            font-weight: 500;
        }
        
        /* Responsive Design untuk Filter */
        @media (max-width: 768px) {
            .form-inline {
                padding: 15px;
            }
            
            .form-inline .form-group {
                margin-bottom: 15px;
                width: 100%;
            }
            
            .form-inline .form-control {
                width: 100% !important;
                margin-bottom: 10px;
            }
            
            .form-inline .btn {
                width: 48%;
                margin-right: 2%;
                margin-bottom: 10px;
            }
            
            .form-inline .btn:last-child {
                margin-right: 0;
            }
            
            .filter-group {
                margin-bottom: 10px;
            }
        }
        
        /* Animation untuk form */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-inline {
            animation: slideDown 0.5s ease-out;
        }
        
        /* Icon styling dalam input */
        .input-group-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        
        /* Placeholder styling */
        .form-control::placeholder {
            color: #a0aec0;
            font-style: italic;
        }
        
        /* Focus state untuk semua form elements */
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

    /* Pagination Styling */
.pagination {
    margin-bottom: 0;
    justify-content: center;
}

.page-link {
    border: 1px solid #e3e6f0;
    color: #667eea;
    font-weight: 600;
    padding: 8px 16px;
    margin: 0 3px;
    border-radius: 6px;
    transition: all 0.3s ease;
    background: white;
}

.page-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
    transform: scale(1.05);
}

.page-item.disabled .page-link {
    background: #f8f9fa;
    color: #6c757d;
    border-color: #e3e6f0;
}

/* Info Pagination */
.text-muted {
    color: #6c757d !important;
    font-weight: 500;
}

/* Untuk alignment pagination info */
.d-flex.justify-content-between.align-items-center {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #e3e6f0;
}

    </style>
 
@stop 
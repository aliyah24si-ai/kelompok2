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
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-lightblue">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Lembaga</th>
                            <th width="30%">Nama Jabatan</th>
                            <th width="15%">Level</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jabatans as $jabatan)
                        <tr>
                            <td class="text-center fw-bold">{{ $jabatan->id }}</td>
                            <td style="max-width: 300px; word-wrap: break-word;">
                                {{ $jabatan->lembaga->nama_lembaga ?? 'N/A' }}
                            </td>
                            <td style="max-width: 300px; word-wrap: break-word;">
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
                                Tidak ada data jabatan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Hapus bagian pagination jika tidak menggunakan paginate --}}
    </div>
@stop

@section('css')
    <style>
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
    </style>
@stop
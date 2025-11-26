@extends('adminlte::page')

@section('title', 'Data Warga')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">Data Warga</h1>
        <a href="{{ route('wargas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Tambah Warga
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
            <h3 class="card-title">Daftar Warga</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-lightblue">
                        <tr>
                            <th width="6%">Foto</th>
                            <th width="5%">ID</th>
                            <th width="12%">No KTP</th>
                            <th width="20%">Nama Lengkap</th>
                            <th width="10%" class="text-center">Jenis Kelamin</th>
                            <th width="10%">Agama</th>
                            <th width="15%">Pekerjaan</th>
                            <th width="15%">Email</th>
                            <th width="7%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($wargas as $item)
                        <tr>
                            <td class="text-center">
                                <div class="table-avatar">
                                    <img src="{{ asset('storage/'.$item->foto_profil_path) }}" alt="{{ $item->nama }}">
                                </div>
                            </td>
                            <td class="text-center fw-bold">{{ $item->warga_id }}</td>
                            <td style="max-width: 150px; word-wrap: break-word;">
                                {{ $item->no_ktp }}
                            </td>
                            <td style="max-width: 250px; word-wrap: break-word;">
                                {{ $item->nama }}
                            </td>
                            <td class="text-center">
                                @if($item->jenis_kelamin == 'L')
                                    <span class="badge badge-primary">Laki-laki</span>
                                @else
                                    <span class="badge badge-pink">Perempuan</span>
                                @endif
                            </td>
                            <td style="max-width: 120px; word-wrap: break-word;">
                                {{ $item->agama }}
                            </td>
                            <td style="max-width: 200px; word-wrap: break-word;">
                                {{ $item->pekerjaan }}
                            </td>
                            <td style="max-width: 220px; word-wrap: break-word;">
                                @if($item->email)
                                    <small>{{ $item->email }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('wargas.show', $item) }}" 
                                   class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('wargas.edit', $item) }}" 
                                   class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('wargas.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Yakin ingin menghapus data warga ini?')"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-users fa-2x mb-2"></i><br>
                                Tidak ada data warga
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($wargas->hasPages())
        <div class="card-footer">
            {{ $wargas->links() }}
        </div>
        @endif
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
        .badge-primary {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        }
        
        .badge-pink {
            background: linear-gradient(135deg, #ed64a6 0%, #d53f8c 100%);
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

        /* Tambah Warga Button */
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
        .table td:nth-child(3),
        .table td:nth-child(4),
        .table td:nth-child(6),
        .table td:nth-child(7),
        .table td:nth-child(8) {
            text-align: left;
        }

        .table th:first-child,
        .table td:first-child,
        .table th:nth-child(2),
        .table td:nth-child(2) {
            text-align: center;
        }

        .table-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .table-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Content Header */
        .content-header h1 {
            font-weight: 700;
            color: #2d3748;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Add smooth loading for forms
            $('form').on('submit', function() {
                $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
            });
        });
    </script>
@stop
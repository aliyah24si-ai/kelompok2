@extends('adminlte::page')

@section('title', 'Data Warga')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Warga</h1>
        <a href="{{ route('wargas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Tambah Warga
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0 text-dark">Daftar Warga</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="wargaTable" class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="80" class="text-center">ID</th>
                            <th width="150">No KTP</th>
                            <th width="200">Nama Lengkap</th> {{-- ← LEBARKAN KOLOM NAMA --}}
                            <th width="120" class="text-center">Jenis Kelamin</th>
                            <th width="120">Agama</th>
                            <th width="150">Pekerjaan</th> {{-- ← SESUAIKAN LEBAR PEKERJAAN --}}
                            <th width="180">Email</th> {{-- ← SESUAIKAN LEBAR EMAIL --}}
                            <th width="180" class="text-center">Aksi</th> {{-- ← SESUAIKAN LEBAR AKSI --}}
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($wargas as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $item->warga_id }}</td>
                            <td>{{ $item->no_ktp }}</td>
                            <td class="fw-semibold text-wrap">{{ $item->nama }}</td> {{-- ← TEXT-WRAP UNTUK NAMA PANJANG --}}
                            <td class="text-center">
                                @if($item->jenis_kelamin == 'L')
                                    <span class="badge bg-primary">Laki-laki</span>
                                @else
                                    <span class="badge bg-pink">Perempuan</span>
                                @endif
                            </td>
                            <td>{{ $item->agama }}</td>
                            <td class="text-wrap">{{ $item->pekerjaan }}</td> {{-- ← TEXT-WRAP UNTUK PEKERJAAN PANJANG --}}
                            <td class="text-wrap">
                                @if($item->email)
                                    <small>{{ $item->email }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('wargas.show', $item) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye me-1"></i>
                                    </a>
                                    <a href="{{ route('wargas.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit me-1"></i>
                                    </a>
                                    <form action="{{ route('wargas.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data warga ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash me-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    Belum ada data warga
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $wargas->firstItem() ?? 0 }} - {{ $wargas->lastItem() ?? 0 }} dari {{ $wargas->total() }} data
                </div>
                {{ $wargas->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 8px;
        }
        .table th {
            border-top: none;
            font-weight: 600;
            font-size: 0.85rem;
            background-color: #f8f9fa;
        }
        .badge.bg-pink {
            background-color: #e83e8c !important;
            color: white;
        }
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            text-decoration: none;
            border: 1px solid transparent;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        .pagination .page-link {
            border-radius: 4px;
            margin: 0 2px;
        }
        .alert {
            border-radius: 6px;
            border: none;
        }
        .text-wrap {
            word-wrap: break-word;
            max-width: 200px; /* Batas maksimal lebar untuk nama */
        }
        .d-flex.gap-1 .btn-sm {
            margin: 0 2px;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#wargaTable').DataTable({
                "paging": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": true,
                "info": false,
                "searching": true,
                "language": {
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "emptyTable": "Tidak ada data warga"
                }
            });
        });
    </script>
@stop
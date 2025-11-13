@extends('adminlte::page')

@section('title', 'Lembaga Desa')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">Lembaga Desa</h1>
        <a href="{{ route('lembaga.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Tambah Lembaga
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="lembagaTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80">ID</th>
                            <th>Nama Lembaga</th>
                            <th>Deskripsi</th>
                            <th>Kontak</th>
                            <th width="140" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($lembaga_desas as $item)
                        <tr>
                            <td class="fw-bold">{{ $item->lembaga_id }}</td>
                            <td class="fw-semibold">{{ $item->nama_lembaga }}</td>
                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                            <td>{{ $item->kontak ?: '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('lembaga.show', $item) }}" class="btn btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lembaga.edit', $item) }}" class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lembaga.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                Tidak ada data lembaga
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $lembaga_desas->links() }}
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.35rem;
        }
        .table th {
            border-top: none;
            font-weight: 600;
            font-size: 0.85rem;
            color: #6e707e;
            background-color: #f8f9fc;
        }
        .table td {
            border-top: 1px solid #e3e6f0;
            padding: 0.75rem;
            vertical-align: middle;
        }
        .btn-group .btn {
            border-radius: 0.25rem;
            margin: 0 2px;
            padding: 0.375rem 0.5rem;
        }
        .alert {
            border-radius: 0.35rem;
            border: none;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fc;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#lembagaTable').DataTable({
                "paging": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": true,
                "info": false,
                "searching": true,
                "language": {
                    "search": "Cari:",
                    "emptyTable": "Tidak ada data lembaga"
                }
            });
        });
    </script>
@stop
@extends('adminlte::page')

@section('title', 'Wargas')

@section('content_header')
    <h1>Data Warga</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('wargas.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Warga</a>
        </div>
        <div class="card-body table-responsive">
            <table id="crudTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>No KTP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Pekerjaan</th>
                        <th>Email</th> {{-- ← TAMBAH KOLOM EMAIL --}}
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($wargas as $item)
                    <tr>
                        <td>{{ $item->warga_id }}</td>
                        <td>{{ $item->no_ktp }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @if($item->jenis_kelamin == 'L')
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                        </td>
                        <td>{{ $item->agama }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                        <td>{{ $item->email ?: '-' }}</td> {{-- ← TAMBAH DATA EMAIL --}}
                        <td>
                            <a href="{{ route('wargas.show', $item) }}" class="btn btn-sm btn-info" title="Detail">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('wargas.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('wargas.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data warga ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data warga</td> {{-- ← UBAH colspan jadi 8 --}}
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $wargas->links() }}
        </div>
    </div>
@stop

@section('css')
    <style>
        .btn-sm {
            padding: 0.25rem 0.5rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            $('#crudTable').DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "ordering": true,
                "info": true,
                "searching": true,
                "pageLength": 10,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampil _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Berikutnya"
                    }
                }
            });
        });
    </script>
@stop

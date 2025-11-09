@extends('adminlte::page')

@section('title', 'Lembaga Desa')

@section('content_header')
    <h1>Lembaga Desa</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('lembaga.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
        </div>
        <div class="card-body table-responsive">
            <table id="crudTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Nama Lembaga</th>
                        <th>Deskripsi</th>
                        <th>Kontak</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($lembaga_desas as $item)
                    <tr>
                        <td>{{ $item->lembaga_id }}</td>
                        <td>{{ $item->nama_lembaga }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->kontak }}</td>
                        <td>
                            <a href="{{ route('lembaga.show', $item) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('lembaga.edit', $item) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('lembaga.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No data</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $lembaga_desas->links() }}
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('#crudTable').DataTable({
                "paging": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering":  true,
                "info": false,
                "searching": true
            });
        });
    </script>
@stop
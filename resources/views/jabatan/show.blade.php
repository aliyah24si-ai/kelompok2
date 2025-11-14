@extends('adminlte::page')

@section('title', 'Detail Jabatan')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Jabatan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Informasi Jabatan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Lembaga</th>
                                    <td>{{ $jabatan->lembaga->nama_lembaga ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Jabatan</th>
                                    <td>{{ $jabatan->nama_jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>Level</th>
                                    <td>
                                        <span class="badge 
                                            @if($jabatan->level == 'Pimpinan') badge-success
                                            @elseif($jabatan->level == 'Manager') badge-primary
                                            @elseif($jabatan->level == 'Staff') badge-warning
                                            @else badge-secondary @endif">
                                            {{ $jabatan->level }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Dibuat Pada</th>
                                    <td>{{ $jabatan->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diupdate Pada</th>
                                    <td>{{ $jabatan->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('jabatan.edit', $jabatan->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
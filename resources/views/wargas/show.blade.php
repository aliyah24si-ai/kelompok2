@extends('adminlte::page')

@section('title', 'Detail Warga')

@section('content_header')
    <h1>Detail Warga</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="detail-avatar mx-auto mb-3">
                        <img src="{{ asset('storage/'.$warga->foto_profil_path) }}" alt="{{ $warga->nama }}" class="img-fluid rounded-circle">
                    </div>
                    <h4 class="fw-bold mb-1">{{ $warga->nama }}</h4>
                    <p class="text-muted mb-0">{{ $warga->pekerjaan }}</p>
                    <p class="text-muted">{{ $warga->email ?: '-' }}</p>
                    <span class="badge bg-primary">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-light">
                    <strong>Dokumen Terunggah</strong>
                </div>
                <div class="card-body">
                    @if($warga->files->count())
                        <ul class="list-group list-group-flush">
                            @foreach($warga->files as $file)
                                <li class="list-group-item d-flex justify-content-between flex-wrap align-items-center">
                                    <div>
                                        <i class="fas fa-file-alt me-2 text-primary"></i>{{ $file->original_name }}
                                        <small class="text-muted d-block">{{ $file->readable_size }}</small>
                                    </div>
                                    <a href="{{ $file->file_url }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">Belum ada dokumen terunggah.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <strong>Informasi Warga</strong>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">ID Warga</dt>
                        <dd class="col-sm-8">{{ $warga->warga_id }}</dd>

                        <dt class="col-sm-4">No KTP</dt>
                        <dd class="col-sm-8">{{ $warga->no_ktp }}</dd>

                        <dt class="col-sm-4">Agama</dt>
                        <dd class="col-sm-8">{{ $warga->agama }}</dd>

                        <dt class="col-sm-4">Nomor Telepon</dt>
                        <dd class="col-sm-8">{{ $warga->telp ?: '-' }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $warga->email ?: '-' }}</dd>

                        <dt class="col-sm-4">Dibuat</dt>
                        <dd class="col-sm-8">{{ $warga->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-4">Diupdate</dt>
                        <dd class="col-sm-8">{{ $warga->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                    <div class="mt-4">
                        <a href="{{ route('wargas.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('wargas.edit', $warga) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .detail-avatar {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .detail-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@stop

@extends('adminlte::page')

@section('title', 'Detail Lembaga Desa')

@section('content_header')
    <h1>Detail Lembaga Desa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $lembaga->lembaga_id }}</p>
            <p><strong>Nama Lembaga:</strong> {{ $lembaga->nama_lembaga }}</p>
            <p><strong>Deskripsi:</strong> {{ $lembaga->deskripsi }}</p>
            <p><strong>Kontak:</strong> {{ $lembaga->kontak }}</p>
            
            <p><strong>Created:</strong> {{ $lembaga->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Updated:</strong> {{ $lembaga->updated_at->format('d/m/Y H:i') }}</p>
            <a href="{{ route('lembaga.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@stop
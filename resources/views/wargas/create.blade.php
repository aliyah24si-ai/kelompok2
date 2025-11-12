@extends('adminlte::page')

@section('title', 'Tambah Warga')

@section('content_header')
    <h1>Tambah Warga Baru</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Tambah Data Warga</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('wargas.store') }}" method="POST">
                @csrf
                @include('wargas.partials.form')

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('wargas.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card-body {
            padding: 2rem;
        }
    </style>
@stop

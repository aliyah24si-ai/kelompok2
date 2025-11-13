@extends('adminlte::page')

@section('title', 'Create Lembaga Desa')


@section('content_header')
    <h1>Lembaga Desa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('lembaga.store') }}" method="POST">
                @csrf
                @include('lembaga_desas.partials.form')
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('lembaga.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
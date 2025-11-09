@extends('adminlte::page')

@section('title', 'Edit Lembaga Desa')

@section('content_header')
    <h1>Edit Lembaga Desa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
               <form action="{{ route('lembaga.update', $lembaga) }}" method="POST">             
               @csrf
                @method('PUT')
                @include('lembaga_desas.partials.form')
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('lembaga.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
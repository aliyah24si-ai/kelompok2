@extends('adminlte::page')

@section('title', 'Edit Warga')

@section('content_header')
    <h1>Edit Warga</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('wargas.update', $warga) }}" method="POST">
                @csrf
                @method('PUT')
                @include('wargas.partials.form')
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('wargas.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@stop
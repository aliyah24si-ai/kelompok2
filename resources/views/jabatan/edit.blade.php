@extends('adminlte::page')

@section('title', 'Edit Jabatan')

@section('content_header')
    <h1 class="m-0 text-dark">
        <i class="fas fa-edit text-warning mr-2"></i>Edit Jabatan
    </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
                <div class="card-header" style="background: linear-gradient(135deg, #9860ffff 0%, #4555ffff 100%);">
                    <h3 class="card-title text-white">
                        <i class="fas fa-edit mr-2"></i>Form Edit Jabatan
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-light">ID: {{ $jabatan->id }}</span>
                    </div>
                </div>
                <div class="card-body" style="background: #f8f9fa;">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5 class="alert-heading">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Terjadi Kesalahan!
                            </h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">×</button>
                        </div>
                    @endif

                    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST" id="jabatanForm">
                        @csrf
                        @method('PUT')
                        @include('jabatan.partials.form')
                        
                        <div class="form-group mt-5 pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="btn btn-primary">Update</button>
                <a href="{{ route('lembaga.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                                <div class="text-muted">
                                    <small>
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Terakhir update: {{ $jabatan->updated_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <style>
        .card-warning {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }
        
        /* Same CSS as create.blade.php */
        .form-control {
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-2px);
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Pilih Lembaga",
                allowClear: true
            });
            
            // Trigger level preview on page load for edit
            $('#level').trigger('change');
            
            // Form validation enhancement
            $('#jabatanForm').on('submit', function() {
                $('.btn-warning').html('<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...').prop('disabled', true);
            });
        });
    </script>
@stop
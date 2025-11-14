@extends('adminlte::page')

@section('title', 'Tambah Jabatan')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Jabatan Baru</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle mr-2"></i>Form Tambah Jabatan
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-custom">
                            <h5 class="alert-heading">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Terjadi Kesalahan!
                            </h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('jabatan.store') }}" method="POST" id="jabatanForm">
                        @csrf
                        @include('jabatan.partials.form')
                        
                        <div class="form-group mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success btn-custom">
                                <i class="fas fa-save mr-2"></i> Simpan Jabatan
                            </button>
                            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary btn-custom">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Custom Card Styles */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        /* Form Styles */
        .form-group label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        /* Select Styles */
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 16px 12px;
            padding-right: 2.5rem;
        }

        /* Button Styles */
        .btn-custom {
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #718096 0%, #4a5568 100%);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(113, 128, 150, 0.3);
        }

        /* Alert Styles */
        .alert-custom {
            border-radius: 10px;
            border: none;
            border-left: 4px solid #e53e3e;
            background: #fed7d7;
            color: #742a2a;
        }

        .alert-custom .alert-heading {
            color: #c53030;
            font-weight: 600;
        }

        /* Invalid Feedback */
        .invalid-feedback {
            font-weight: 500;
            color: #e53e3e;
            margin-top: 5px;
        }

        .form-control.is-invalid {
            border-color: #e53e3e;
            box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
        }

        /* Card Title */
        .card-title {
            font-weight: 700;
            font-size: 1.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            
            .btn-custom {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* Hover Effects */
        .form-group {
            transition: transform 0.2s ease;
        }

        .form-group:hover {
            transform: translateX(5px);
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Add smooth loading
            $('#jabatanForm').on('submit', function() {
                $('.btn-success').html('<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...').prop('disabled', true);
            });

            // Add focus effects
            $('.form-control').on('focus', function() {
                $(this).parent().addClass('focused');
            }).on('blur', function() {
                $(this).parent().removeClass('focused');
            });

            // Level badge preview
            $('#level').change(function() {
                const level = $(this).val();
                let badgeClass = '';
                let badgeText = '';
                
                switch(level) {
                    case 'Pimpinan':
                        badgeClass = 'badge-success';
                        badgeText = '🏢 Pimpinan';
                        break;
                    case 'Manager':
                        badgeClass = 'badge-primary';
                        badgeText = '👨‍💼 Manager';
                        break;
                    case 'Staff':
                        badgeClass = 'badge-warning';
                        badgeText = '👨‍💻 Staff';
                        break;
                    case 'Operator':
                        badgeClass = 'badge-info';
                        badgeText = '🔧 Operator';
                        break;
                    default:
                        badgeClass = 'badge-secondary';
                        badgeText = 'Pilih level';
                }
                
                // Create badge preview
                if (!$('#level-badge').length) {
                    $(this).after('<div id="level-badge" class="mt-2"></div>');
                }
                $('#level-badge').html(`<span class="badge ${badgeClass} p-2">${badgeText}</span>`);
            });
        });
    </script>
@stop
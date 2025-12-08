@extends('adminlte::page')

@section('title', 'Tambah User')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah User Baru</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-plus mr-2"></i>Form Tambah User
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

                    <form action="{{ route('users.store') }}" method="POST" id="userForm">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Masukkan nama user" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="Masukkan email user" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Masukkan password (minimal 8 karakter)" required>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                                   placeholder="Konfirmasi password" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>
                                    <i class="fas fa-user-shield"></i> Admin
                                </option>
                                <option value="Pelanggan" {{ old('role') === 'Pelanggan' ? 'selected' : '' }}>
                                    <i class="fas fa-user"></i> Warga
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success btn-custom">
                                <i class="fas fa-save mr-2"></i> Simpan User
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-custom">
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
        /* Warna Gradasi Ungu */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(128, 0, 255, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(128, 0, 255, 0.25);
        }

        /* Header dengan gradasi ungu */
        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 50%, #6D28D9 100%) !important;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        /* Tombol dengan warna ungu */
        .btn-success.btn-custom {
            background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success.btn-custom:hover {
            background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.4);
        }

        /* Form focus dengan warna ungu */
        .form-control:focus, .form-select:focus {
            border-color: #8B5CF6;
            box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25);
        }

        /* Animasi pada form input */
        .form-control, .form-select {
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            transform: scale(1.01);
        }

        /* Animasi pada alert */
        .alert-custom {
            animation: fadeIn 0.5s ease;
            border-radius: 8px;
            border: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Animasi pada select option */
        .form-select option {
            padding: 10px;
            transition: background 0.3s ease;
        }

        .form-select option:hover {
            background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
            color: white;
        }

        /* Efek hover pada tombol kembali */
        .btn-secondary.btn-custom {
            background: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-secondary.btn-custom:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
    </style>
@stop

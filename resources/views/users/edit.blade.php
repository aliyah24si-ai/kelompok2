@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1 class="m-0 text-dark">Edit User</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit mr-2"></i>Form Edit User
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

                    <form action="{{ route('users.update', $user->id) }}" method="POST" id="userForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Masukkan nama user" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="Masukkan email user" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-muted">(Kosongkan jika tidak ingin mengubah)</span></label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Masukkan password baru (minimal 8 karakter)">
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                                   placeholder="Konfirmasi password baru">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>
                                    <i class="fas fa-user-shield"></i> Admin
                                </option>
                                <option value="Pelanggan" {{ old('role', $user->role) === 'Pelanggan' ? 'selected' : '' }}>
                                    <i class="fas fa-user"></i> Pelanggan
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success btn-custom">
                                <i class="fas fa-save mr-2"></i> Perbarui User
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
        /* ===== VARIABLES ===== */
        :root {
            --purple-light: #8B5CF6;
            --purple: #7C3AED;
            --purple-dark: #6D28D9;
            --shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
            --danger: #F56565;
            --success: #48BB78;
        }

        /* ===== CARD ===== */
        .card-custom {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            background: white;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.25);
        }

        /* ===== HEADER ===== */
        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%) !important;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        /* ===== ALERT ===== */
        .alert-custom {
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            color: #7F1D1D;
            animation: slideIn 0.5s ease;
            box-shadow: 0 4px 12px rgba(245, 101, 101, 0.15);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== FORM ===== */
        .form-label {
            font-weight: 600;
            color: var(--purple-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .form-label span.text-danger {
            color: var(--danger) !important;
            margin-left: 4px;
        }

        .form-label span.text-muted {
            color: #718096;
            font-size: 0.85rem;
            margin-left: 8px;
            font-weight: normal;
        }

        /* ===== INPUT & SELECT ===== */
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #E2E8F0;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #F7FAFC;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.15);
            background-color: white;
            transform: translateY(-2px);
            outline: none;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23F56565'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23F56565' stroke='none'/%3e%3c/svg%3e");
        }

        .form-control.is-invalid:focus, .form-select.is-invalid:focus {
            border-color: var(--danger);
            box-shadow: 0 0 0 0.25rem rgba(245, 101, 101, 0.15);
        }

        /* ===== SELECT OPTION ===== */
        .form-select option {
            padding: 10px;
            transition: background 0.3s ease;
        }

        .form-select option:hover {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
        }

        /* ===== BUTTONS ===== */
        .btn-custom {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-success.btn-custom {
            background: linear-gradient(135deg, var(--success) 0%, #38A169 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
        }

        .btn-success.btn-custom:hover {
            background: linear-gradient(135deg, #38A169 0%, #2F855A 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(72, 187, 120, 0.4);
        }

        .btn-secondary.btn-custom {
            background: linear-gradient(135deg, #718096 0%, #4A5568 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(113, 128, 150, 0.3);
        }

        .btn-secondary.btn-custom:hover {
            background: linear-gradient(135deg, #4A5568 0%, #2D3748 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 85, 104, 0.4);
        }

        /* ===== INVALID FEEDBACK ===== */
        .invalid-feedback {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.35rem;
            font-weight: 500;
            padding-left: 0.5rem;
        }

        /* ===== FORM GROUP ANIMATION ===== */
        .mb-3 {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mb-3:nth-child(1) { animation-delay: 0.1s; }
        .mb-3:nth-child(2) { animation-delay: 0.2s; }
        .mb-3:nth-child(3) { animation-delay: 0.3s; }
        .mb-3:nth-child(4) { animation-delay: 0.4s; }
        .mb-3:nth-child(5) { animation-delay: 0.5s; }
    </style>
@stop

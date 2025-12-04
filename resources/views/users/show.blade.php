@extends('adminlte::page')

@section('title', 'Detail User')

@section('content_header')
    <h1 class="m-0 text-dark">Detail User</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-circle mr-2"></i>Informasi User
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Nama:</label>
                        </div>
                        <div class="col-md-9">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Email:</label>
                        </div>
                        <div class="col-md-9">
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Role:</label>
                        </div>
                        <div class="col-md-9">
                            @if ($user->role === 'Admin')
                                <span class="badge bg-danger">
                                    <i class="fas fa-user-shield mr-1"></i>{{ $user->role }}
                                </span>
                            @else
                                <span class="badge bg-info">
                                    <i class="fas fa-user mr-1"></i>{{ $user->role }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Terdaftar Sejak:</label>
                        </div>
                        <div class="col-md-9">
                            <p>{{ $user->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Terakhir Diperbarui:</label>
                        </div>
                        <div class="col-md-9">
                            <p>{{ $user->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="form-group mt-4 pt-3 border-top">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-custom">
                            <i class="fas fa-edit mr-2"></i> Edit User
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-custom">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
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

        .card-header .card-title {
            margin: 0;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }

        /* ===== CONTENT STYLES ===== */
        .card-body {
            padding: 2rem;
        }

        .row.mb-3 {
            padding: 1rem 0;
            border-bottom: 1px solid #f1f1f1;
            transition: all 0.3s ease;
        }

        .row.mb-3:hover {
            background: linear-gradient(90deg, rgba(139, 92, 246, 0.05) 0%, rgba(124, 58, 237, 0.02) 100%);
            padding: 1rem 1rem;
            border-radius: 10px;
            transform: translateX(5px);
        }

        .form-label.fw-bold {
            color: var(--purple);
            font-size: 1rem;
        }

        p {
            font-size: 1.1rem;
            color: #333;
            margin: 0;
        }

        /* ===== BADGE ===== */
        .badge {
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #FF6B6B 0%, #EE5A52 100%) !important;
            color: white;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #4FD1C5 0%, #38B2AC 100%) !important;
            color: white;
        }

        /* ===== BUTTONS ===== */
        .btn-custom {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-warning.btn-custom {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .btn-warning.btn-custom:hover {
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
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

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-body > .row {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        .card-body > .row:nth-child(1) { animation-delay: 0.1s; }
        .card-body > .row:nth-child(2) { animation-delay: 0.2s; }
        .card-body > .row:nth-child(3) { animation-delay: 0.3s; }
        .card-body > .row:nth-child(4) { animation-delay: 0.4s; }
        .card-body > .row:nth-child(5) { animation-delay: 0.5s; }
    </style>
@stop
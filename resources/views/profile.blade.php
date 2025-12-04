@extends('adminlte::page')

@section('title', 'Profile User')

@section('content_header')
    <h1 class="m-0 text-dark">Profile User</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-circle mr-2"></i>Informasi Profil
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nama:</label>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">{{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Email:</label>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Role:</label>
                        </div>
                        <div class="col-md-8">
                            @if (Auth::user()->role === 'Admin')
                                <span class="badge bg-danger">
                                    <i class="fas fa-user-shield mr-1"></i>{{ Auth::user()->role }}
                                </span>
                            @else
                                <span class="badge bg-info">
                                    <i class="fas fa-user mr-1"></i>{{ Auth::user()->role }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Terdaftar Sejak:</label>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">{{ Auth::user()->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Terakhir Diperbarui:</label>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">{{ Auth::user()->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="form-group mt-4 pt-3 border-top">
                        <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-warning btn-custom">
                            <i class="fas fa-edit mr-2"></i> Edit Profil
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-custom">
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
            --light-bg: #F8FAFC;
            --card-bg: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --danger: #EF4444;
            --info: #3B82F6;
            --warning: #F59E0B;
            --border-radius: 16px;
            --shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.1);
            --shadow-hover: 0 20px 40px -10px rgba(139, 92, 246, 0.15);
        }

        /* ===== CARD STYLES ===== */
        .card-custom {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            background: var(--card-bg);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            position: relative;
            z-index: 1;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .card-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%);
            z-index: 2;
        }

        /* ===== CARD HEADER ===== */
        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%) !important;
            border-bottom: none;
            padding: 1.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header.bg-gradient-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .card-header .card-title {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
            z-index: 1;
        }

        .card-header .card-title i {
            font-size: 1.3rem;
            margin-right: 12px;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== CARD BODY ===== */
        .card-body {
            padding: 2rem;
            background: var(--light-bg);
        }

        /* ===== PROFILE INFO ROWS ===== */
        .row.mb-3 {
            background: white;
            padding: 1.25rem 1.5rem;
            margin: 0 -0.75rem 1rem -0.75rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            animation: slideIn 0.6s ease forwards;
            opacity: 0;
            transform: translateX(-10px);
        }

        .row.mb-3:hover {
            transform: translateX(5px);
            border-left-color: var(--purple);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.1);
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .row.mb-3:nth-child(1) { animation-delay: 0.1s; }
        .row.mb-3:nth-child(2) { animation-delay: 0.2s; }
        .row.mb-3:nth-child(3) { animation-delay: 0.3s; }
        .row.mb-3:nth-child(4) { animation-delay: 0.4s; }
        .row.mb-3:nth-child(5) { animation-delay: 0.5s; }

        /* ===== LABELS ===== */
        .form-label.fw-bold {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .form-label.fw-bold::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background: var(--purple);
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .row.mb-3:hover .form-label.fw-bold::before {
            background: var(--purple-dark);
            transform: scale(1.3);
        }

        /* ===== VALUE TEXT ===== */
        p.text-muted {
            color: var(--text-dark) !important;
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
            padding: 0.5rem 0;
            border-bottom: 2px dashed #E2E8F0;
        }

        .row.mb-3:hover p.text-muted {
            border-bottom-color: var(--purple-light);
            color: var(--purple-dark) !important;
        }

        /* ===== BADGE ===== */
        .badge {
            font-weight: 700;
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
            color: white;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%) !important;
            color: white;
        }

        .badge i {
            font-size: 0.9rem;
            margin-right: 6px;
        }

        /* ===== BUTTONS ===== */
        .form-group.mt-4 {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 2px solid #E2E8F0;
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .btn-custom {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.85rem 1.75rem;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-custom i {
            margin-right: 8px;
            font-size: 1rem;
        }

        .btn-warning.btn-custom {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
        }

        .btn-warning.btn-custom:hover {
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .btn-secondary.btn-custom {
            background: linear-gradient(135deg, #64748B 0%, #475569 100%);
            color: white;
        }

        .btn-secondary.btn-custom:hover {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(71, 85, 105, 0.3);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .card-header.bg-gradient-primary {
                padding: 1.25rem 1.5rem;
            }
            
            .card-header .card-title {
                font-size: 1.25rem;
            }
            
            .card-header .card-title i {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .row.mb-3 {
                padding: 1rem;
                margin: 0 0 0.75rem 0;
            }
            
            .btn-custom {
                width: 100%;
                margin-bottom: 10px;
                margin-right: 0;
            }
            
            .form-label.fw-bold {
                margin-bottom: 0.75rem;
            }
            
            .col-md-4, .col-md-8 {
                padding: 0.5rem 0;
            }
        }

        @media (max-width: 576px) {
            .card-custom {
                border-radius: 12px;
            }
            
            .badge {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
            
            .btn-custom {
                padding: 0.75rem 1.5rem;
            }
        }

        /* ===== ACCESSIBILITY ===== */
        .btn-custom:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.3);
        }

        /* ===== SMOOTH SCROLLING ===== */
        html {
            scroll-behavior: smooth;
        }

        /* ===== PRINT STYLES ===== */
        @media print {
            .card-custom {
                box-shadow: none;
                border: 1px solid #ddd;
            }
            
            .btn-custom {
                display: none;
            }
            
            .card-header.bg-gradient-primary {
                background: #f8f9fa !important;
                color: #000 !important;
            }
        }
    </style>
@stop
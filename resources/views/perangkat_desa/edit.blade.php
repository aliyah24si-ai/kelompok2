@extends('adminlte::page')

@section('title', 'Ubah Perangkat Desa')

@section('content_header')
    <h1 class="m-0">Ubah Perangkat Desa</h1>
@stop

@section('content')
    <div class="card pd-animated">
        <div class="card-header pd-gradient">
            <h5 class="m-0" style="color: #fff;">Ubah Perangkat Desa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('perangkat_desa.update', $item->perangkat_id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @include('perangkat_desa.partials.form')
                <div class="mt-3">
                    <a href="{{ route('perangkat_desa.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button class="btn pd-btn">Simpan</button>
                </div>
            </form>
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
            --gray-light: #f8f9fa;
        }

        /* ===== CARD ===== */
        .pd-animated {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            background: white;
            margin-top: 20px;
        }

        .pd-animated:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.25);
        }

        /* ===== HEADER CARD ===== */
        .pd-gradient {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%) !important;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
            color: white;
            font-size: 1.1rem;
        }

        .pd-gradient div:first-child {
            font-weight: 700;
            letter-spacing: 0.3px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* ===== TOMBOL TAMBAH ===== */
        .btn-light.btn-sm {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
            border: 2px solid var(--purple-light) !important;
            border-radius: 12px !important;
            padding: 0.5rem 1.2rem !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            color: var(--purple) !important;
            box-shadow: 0 4px 10px rgba(139, 92, 246, 0.2);
        }

        .btn-light.btn-sm:hover {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
            color: white !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
            border-color: transparent !important;
        }

        /* ===== TABEL ===== */
        .table-responsive {
            border-radius: 16px;
            overflow: hidden;
            margin-top: 10px;
        }

        .table-sm {
            border: none;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        }

        .table thead th {
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem 1rem;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(139, 92, 246, 0.08) 0%, rgba(124, 58, 237, 0.05) 100%);
            transform: scale(1.005);
        }

        .table tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
            text-align: center;
            font-size: 0.9rem;
        }

        /* ===== FOTO ===== */
        .img-thumbnail {
            border-radius: 10px;
            border: 2px solid rgba(139, 92, 246, 0.2);
            padding: 2px;
            transition: all 0.3s ease;
            max-height: 60px;
            object-fit: cover;
        }

        .img-thumbnail:hover {
            transform: scale(1.8);
            z-index: 100;
            position: relative;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        /* ===== TOMBOL AKSI ===== */
        .btn-sm {
            padding: 0.35rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            margin: 2px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #718096 0%, #4A5568 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ECC94B 0%, #D69E2E 100%);
            color: #744210;
        }

        .btn-danger {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
            color: white;
        }

        .btn-sm:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #4A5568 0%, #2D3748 100%);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #D69E2E 0%, #B7791F 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #F56565 0%, #E53E3E 100%);
        }

        /* ===== FORM DELETE INLINE ===== */
        form[onsubmit] {
            display: inline-block;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            justify-content: center;
            margin-top: 20px !important;
        }

        .page-link {
            border: none;
            color: var(--purple);
            border-radius: 8px;
            margin: 0 4px;
            transition: all 0.3s ease;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            border-color: var(--purple);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .page-link:hover {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(124, 58, 237, 0.05) 100%);
            color: var(--purple-dark);
            transform: translateY(-2px);
        }

        /* ===== ALERT SUCCESS ===== */
        .alert-success {
            background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
            color: white;
            border-radius: 12px;
            border: none;
            animation: slideIn 0.5s ease;
            margin-bottom: 20px;
            padding: 1rem 1.25rem;
            font-weight: 500;
        }

        /* ===== NO DATA STYLING ===== */
        .text-muted {
            color: #A0AEC0 !important;
            font-size: 1rem;
            text-align: center;
            padding: 2rem;
        }

        /* ===== ANIMATIONS ===== */
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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .table thead th, 
            .table tbody td {
                padding: 0.6rem 0.5rem;
                font-size: 0.75rem;
            }
            
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }
            
            .pd-gradient {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
@stop


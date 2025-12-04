@extends('adminlte::page')

@section('title', 'Data Users')

@section('content_header')
    <h1 class="m-0 text-dark">Manajemen Users</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card card-custom">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-users mr-2"></i>Daftar Users
                    </h3>
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm btn-custom">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah User
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="25%">Nama</th>
                                    <th width="30%">Email</th>
                                    <th width="15%">Role</th>
                                    <th width="25%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $user->name }}</strong>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role === 'Admin')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-user-shield mr-1"></i>{{ $user->role }}
                                                </span>
                                            @else
                                                <span class="badge bg-info">
                                                    <i class="fas fa-user mr-1"></i>{{ $user->role }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('users.show', $user->id) }}" 
                                               class="btn btn-info btn-sm btn-icon" 
                                               title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}" 
                                               class="btn btn-warning btn-sm btn-icon" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm btn-icon" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $user->id }}"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="deleteModal{{ $user->id }}" 
                                                 tabindex="-1" aria-labelledby="deleteModalLabel" 
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                                                Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" 
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus user 
                                                            <strong>{{ $user->name }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" 
                                                                    data-bs-dismiss="modal">Batal</button>
                                                            <form action="{{ route('users.destroy', $user->id) }}" 
                                                                  method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-trash mr-2"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox mr-2"></i>Tidak ada data users
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.25);
        }

        /* ===== HEADER ===== */
        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%) !important;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }

        /* ===== TOMBOL TAMBAH ===== */
        .btn-success.btn-custom {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .btn-success.btn-custom:hover {
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        }

        /* ===== TABEL ===== */
        .table {
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .table thead {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        }

        .table thead th {
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem 1.2rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(139, 92, 246, 0.08) 0%, rgba(124, 58, 237, 0.05) 100%);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1rem 1.2rem;
            vertical-align: middle;
            border-color: #f1f1f1;
        }

        /* ===== BADGE ROLE ===== */
        .badge.bg-danger {
            background: linear-gradient(135deg, #FF6B6B 0%, #EE5A52 100%) !important;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #4FD1C5 0%, #38B2AC 100%) !important;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        /* ===== TOMBOL AKSI ===== */
        .btn-icon {
            padding: 0.4rem 0.7rem;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            border: none;
            margin: 0 2px;
        }

        .btn-info.btn-icon {
            background: linear-gradient(135deg, #4299E1 0%, #3182CE 100%);
        }

        .btn-warning.btn-icon {
            background: linear-gradient(135deg, #ECC94B 0%, #D69E2E 100%);
        }

        .btn-danger.btn-icon {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
        }

        .btn-icon:hover {
            transform: translateY(-2px) scale(1.1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* ===== MODAL ===== */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .modal-header.bg-danger {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%) !important;
            border-radius: 16px 16px 0 0;
        }

        /* ===== ALERT ===== */
        .alert {
            border-radius: 12px;
            border: none;
            animation: slideIn 0.5s ease;
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

        .alert-success {
            background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
            color: white;
        }

        /* ===== NO DATA ===== */
        .text-muted {
            color: #A0AEC0 !important;
            font-size: 1.1rem;
        }
    </style>
@stop
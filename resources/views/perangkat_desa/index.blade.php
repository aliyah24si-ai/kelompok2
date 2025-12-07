
@extends('adminlte::page')

@section('title', 'Perangkat Desa')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Perangkat Desa</h1>
        <a href="{{ route('perangkat_desa.create') }}" class="btn pd-add-btn">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card pd-animated">
    <div class="card-header pd-gradient">
        <h5 style="color: white; margin: 0;">Pencarian Perangkat Desa</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('perangkat_desa.index') }}" method="GET">
            <div class="row align-items-center">
                <div class="col-md-8 mb-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama warga atau jabatan..." 
                           value="{{ request('search') }}" style="border-left: 4px solid #6f42c1;">
                </div>
                <div class="col-md-4 mb-2 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn pd-btn">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('perangkat_desa.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="card pd-animated mt-3">
        <div class="card-header pd-gradient d-flex justify-content-between align-items-center">
            <h5 style="color: white; margin: 0;">Daftar Perangkat Desa({{ $items->total() }} data)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead style="background-color: rgba(111, 66, 193, 0.08); border-bottom: 2px solid #6f42c1;">
                        <tr>
                            <th style="color: #6f42c1; font-weight: 600;">No</th>
                            <th style="color: #6f42c1; font-weight: 600;">Warga</th>
                            <th style="color: #6f42c1; font-weight: 600;">Jabatan</th>
                            <th style="color: #6f42c1; font-weight: 600;">NIP</th>
                            <th style="color: #6f42c1; font-weight: 600;">Kontak</th>
                            <th style="color: #6f42c1; font-weight: 600;">Periode</th>
                            <th style="color: #6f42c1; font-weight: 600;">Foto</th>
                            <th style="color: #6f42c1; font-weight: 600;" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $i => $it)
                            <tr>
                                <td>{{ $items->firstItem() + $i }}</td>
                                <td><strong>{{ $it->warga ? $it->warga->nama : '-' }}</strong></td>
                                <td>{{ $it->jabatan }}</td>
                                <td>{{ $it->nip ?? '-' }}</td>
                                <td>{{ $it->kontak ?? '-' }}</td>
                                <td>
                                    <small>
                                        {{ $it->periode_mulai ? $it->periode_mulai->format('d/m/Y') : '-' }}
                                        @if($it->periode_selesai)
                                            s/d {{ $it->periode_selesai->format('d/m/Y') }}
                                        @endif
                                    </small>
                                </td>
                                <td>
                                    @if($it->foto)
                                        <img src="{{ asset('storage/' . $it->foto) }}" alt="foto" style="max-width:60px; border-radius: 4px;">
                                    @else
                                        <span class="badge badge-secondary">Belum ada</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('perangkat_desa.show', $it->perangkat_id) }}" class="btn btn-sm btn-outline-primary" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('perangkat_desa.edit', $it->perangkat_id) }}" class="btn btn-sm pd-btn" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('perangkat_desa.destroy', $it->perangkat_id) }}" method="POST" style="display:inline;" 
                                          onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox"></i> Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION DENGAN CSS INLINE -->
            @if($items->hasPages())
            <div class="row mt-4">
                <div class="col-md-12 d-flex justify-content-center">
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($items->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #a0aec0;
                                        font-weight: 600;
                                        background: white;
                                        cursor: not-allowed;
                                    ">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->previousPageUrl() }}" style="
                                        border: 2px solid #8b5cf6;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $current = $items->currentPage();
                                $last = $items->lastPage();
                                $start = max(1, $current - 2);
                                $end = min($last, $current + 2);
                                
                                if($end - $start < 4) {
                                    if($start == 1) {
                                        $end = min(5, $last);
                                    } else {
                                        $start = max(1, $last - 4);
                                    }
                                }
                            @endphp

                            @if($start > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->url(1) }}" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        1
                                    </a>
                                </li>
                                @if($start > 2)
                                    <li class="page-item disabled">
                                        <span class="page-link" style="
                                            border: 2px solid #e2e8f0;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: #a0aec0;
                                            font-weight: 600;
                                            background: white;
                                            cursor: default;
                                        ">
                                            ...
                                        </span>
                                    </li>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $items->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link" style="
                                            border: 2px solid #8b5cf6;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: white;
                                            font-weight: 600;
                                            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
                                            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
                                            cursor: default;
                                        ">
                                            {{ $page }}
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $items->url($page) }}" style="
                                            border: 2px solid #e2e8f0;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: #8b5cf6;
                                            font-weight: 600;
                                            background: white;
                                            text-decoration: none;
                                            transition: all 0.3s ease;
                                        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endfor

                            @if($end < $last)
                                @if($end < $last - 1)
                                    <li class="page-item disabled">
                                        <span class="page-link" style="
                                            border: 2px solid #e2e8f0;
                                            border-radius: 10px;
                                            margin: 0 4px;
                                            padding: 8px 16px;
                                            color: #a0aec0;
                                            font-weight: 600;
                                            background: white;
                                            cursor: default;
                                        ">
                                            ...
                                        </span>
                                    </li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->url($last) }}" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        {{ $last }}
                                    </a>
                                </li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($items->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $items->nextPageUrl() }}" style="
                                        border: 2px solid #8b5cf6;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #8b5cf6;
                                        font-weight: 600;
                                        background: white;
                                        text-decoration: none;
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.2)';" 
                                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" style="
                                        border: 2px solid #e2e8f0;
                                        border-radius: 10px;
                                        margin: 0 4px;
                                        padding: 8px 16px;
                                        color: #a0aec0;
                                        font-weight: 600;
                                        background: white;
                                        cursor: not-allowed;
                                    ">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            @endif
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
        .pd-animated {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
            margin-top: 20px;
        }

        .pd-animated:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
        }

        /* ===== HEADER CARD ===== */
        .pd-gradient {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%);
            border-bottom: none;
            padding: 1.25rem 1.5rem;
            color: white;
            font-size: 1.1rem;
        }

        .pd-gradient h5 {
            font-weight: 700;
            letter-spacing: 0.3px;
            margin: 0;
        }

        /* ===== TOMBOL TAMBAH ===== */
        .btn[style*="background: linear-gradient(90deg, #6f42c1, #9b59b6)"] {
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.3);
        }

        .btn[style*="background: linear-gradient(90deg, #6f42c1, #9b59b6)"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(111, 66, 193, 0.4);
        }

        /* ===== FORM INPUT ===== */
        .form-control {
            border: 2px solid #E2E8F0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--purple-light);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
            outline: none;
        }

        /* ===== CUSTOM BUTTONS ===== */
        .pd-btn {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.25rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pd-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(139, 92, 246, 0.3);
        }

        .btn-outline-secondary {
            border: 2px solid #A0AEC0;
            color: #4A5568;
            border-radius: 10px;
            padding: 0.6rem 1.25rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: #4A5568;
            color: white;
            transform: translateY(-2px);
        }

        /* ===== TABLE ===== */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            margin-top: 20px;
            border: 1px solid rgba(139, 92, 246, 0.1);
        }

        /* TABLE HEADER */
        .table thead {
            background: linear-gradient(135deg, #8dd5e4ff 0%, #96c0bcff 100%);
        }

        .table thead th {
            color: white;
            font-weight: 700;
            border: none;
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-align: center;
        }

        /* TABLE BODY */
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(139, 92, 246, 0.05);
        }

        .table tbody tr:hover {
            background: rgba(139, 92, 246, 0.05);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            font-size: 0.95rem;
        }

        /* ===== FOTO ANIMASI ===== */
        .table tbody td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid rgba(139, 92, 246, 0.2);
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .table tbody td img:hover {
            transform: scale(2.5);
            z-index: 100;
            position: relative;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border: 2px solid var(--purple);
        }

        /* ===== BADGE ===== */
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #A0AEC0 0%, #718096 100%);
            color: white;
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
        }

        .btn-outline-primary {
            background: transparent;
            border: 2px solid #4299E1;
            color: #4299E1;
        }

        .btn-outline-primary:hover {
            background: #4299E1;
            color: white;
            transform: translateY(-2px);
        }

        .pd-btn.btn-sm {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
        }

        .pd-btn.btn-sm:hover {
            transform: translateY(-2px);
        }

        .btn-outline-danger {
            background: transparent;
            border: 2px solid #FC8181;
            color: #FC8181;
        }

        .btn-outline-danger:hover {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
            color: white;
            transform: translateY(-2px);
        }

        /* ===== NO DATA ===== */
        .text-muted {
            color: #A0AEC0;
            font-size: 1rem;
            text-align: center;
            padding: 2rem;
        }

        .text-muted i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
            color: var(--purple);
        }

        /* ===== ALERT ===== */
        .alert-success {
            background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
            color: white;
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
            padding: 1rem 1.25rem;
            font-weight: 500;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            justify-content: center;
            margin-top: 20px;
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
            color: white;
        }

        .page-link:hover {
            background: rgba(139, 92, 246, 0.1);
            color: var(--purple-dark);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .pd-animated {
                border-radius: 12px;
                margin-top: 15px;
            }
            
            .pd-gradient {
                padding: 1rem 1.25rem;
            }
            
            .table-responsive {
                border-radius: 10px;
            }
            
            .table thead th, 
            .table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.85rem;
            }
            
            .table tbody td img:hover {
                transform: scale(2);
            }
            
            .btn-sm {
                padding: 0.3rem 0.6rem;
                font-size: 0.75rem;
                margin: 1px;
            }
        }
    </style>
@stop
@extends('adminlte::page')

@section('title', 'Detail Perangkat Desa')

@section('content_header')
    <h1 class="m-0">Detail Perangkat Desa</h1>
@stop

@section('content')
    <div class="card pd-animated">
        <div class="card-header pd-gradient">
            <h5 class="m-0" style="color: #fff;">Detail Perangkat Desa</h5>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <tr>
                    <th style="background-color: rgba(111, 66, 193, 0.05); color: #6f42c1;">Warga</th>
                    <td>{{ $item->warga ? $item->warga->nama : '-' }}</td>
                </tr>
                <tr>
                    <th style="background-color: rgba(111, 66, 193, 0.05); color: #6f42c1;">Jabatan</th>
                    <td>{{ $item->jabatan }}</td>
                </tr>
                <tr>
                    <th style="background-color: rgba(111, 66, 193, 0.05); color: #6f42c1;">NIP</th>
                    <td>{{ $item->nip }}</td>
                </tr>
                <tr>
                    <th style="background-color: rgba(111, 66, 193, 0.05); color: #6f42c1;">Kontak</th>
                    <td>{{ $item->kontak }}</td>
                </tr>
                <tr>
                    <th style="background-color: rgba(111, 66, 193, 0.05); color: #6f42c1;">Periode</th>
                    <td>{{ $item->periode_mulai ? $item->periode_mulai->format('Y-m-d') : '-' }} - {{ $item->periode_selesai ? $item->periode_selesai->format('Y-m-d') : '-' }}</td>
                </tr>
                <tr>
                    <th style="background-color: rgba(111, 66, 193, 0.05); color: #6f42c1;">Foto</th>
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="foto" style="max-width:200px;" class="img-thumbnail">
                        @endif
                    </td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('perangkat_desa.index') }}" class="btn btn-outline-secondary">Kembali</a>
                <a href="{{ route('perangkat_desa.edit', $item->perangkat_id) }}" class="btn pd-btn">Ubah</a>
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

        /* ===== CARD DETAIL ===== */
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
        }

        .pd-gradient h5 {
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 0;
        }

        /* ===== TABLE DETAIL ===== */
        .table {
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid rgba(139, 92, 246, 0.1);
            margin-bottom: 0;
        }

        .table-sm {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid rgba(139, 92, 246, 0.1);
        }

        /* ===== HEADER TABLE ===== */
        .table th {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.08) 0%, rgba(124, 58, 237, 0.05) 100%);
            color: var(--purple);
            font-weight: 700;
            padding: 1rem 1.25rem;
            width: 30%;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-right: 2px solid rgba(139, 92, 246, 0.2);
        }

        /* ===== DATA TABLE ===== */
        .table td {
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            color: #4A5568;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        /* ===== ROW HOVER EFFECT ===== */
        .table tr:hover th {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.12) 0%, rgba(124, 58, 237, 0.08) 100%);
        }

        .table tr:hover td {
            background-color: #F7FAFC;
        }

        /* ===== FOTO PREVIEW ===== */
        .img-thumbnail {
            border-radius: 12px;
            border: 3px solid rgba(139, 92, 246, 0.3);
            padding: 8px;
            background: white;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.15);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
            border-color: var(--purple-light);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.25);
            cursor: pointer;
        }

        /* ===== TOMBOL AKSI ===== */
        .mt-3 {
            display: flex;
            gap: 12px;
            margin-top: 2rem !important;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(139, 92, 246, 0.1);
        }

        .btn {
            padding: 0.75rem 1.75rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* Tombol Kembali */
        .btn-outline-secondary {
            background: transparent;
            border: 2px solid #A0AEC0;
            color: #4A5568;
        }

        .btn-outline-secondary:hover {
            background: linear-gradient(135deg, #718096 0%, #4A5568 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(74, 85, 104, 0.3);
            border-color: transparent;
        }

        /* Tombol Ubah */
        .pd-btn {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .pd-btn:hover {
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        }

        /* Icon untuk tombol */
        .btn-outline-secondary::before {
            content: "←";
            font-size: 1.1rem;
        }

        .pd-btn::before {
            content: "✏️";
            font-size: 1.1rem;
        }

        /* ===== ANIMASI ===== */
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

        .table tr {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        .table tr:nth-child(1) { animation-delay: 0.1s; }
        .table tr:nth-child(2) { animation-delay: 0.2s; }
        .table tr:nth-child(3) { animation-delay: 0.3s; }
        .table tr:nth-child(4) { animation-delay: 0.4s; }
        .table tr:nth-child(5) { animation-delay: 0.5s; }
        .table tr:nth-child(6) { animation-delay: 0.6s; }

        /* ===== BADGE STATUS ===== */
        .status-active, .status-inactive {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-active {
            background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
            color: white;
        }

        .status-inactive {
            background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
            color: white;
        }

        /* ===== CARD BODY ===== */
        .card-body {
            padding: 1.5rem 2rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.25rem;
            }
            
            .mt-3 {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                text-align: center;
                padding: 0.75rem 1rem;
            }
            
            .table th,
            .table td {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .table th {
                width: 35%;
            }
            
            .img-thumbnail {
                max-width: 150px;
            }
            
            .btn-outline-secondary::before,
            .pd-btn::before {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .table th,
            .table td {
                display: block;
                width: 100%;
                border: none;
                padding: 0.75rem 0.5rem;
            }
            
            .table th {
                border-bottom: 1px solid rgba(139, 92, 246, 0.1);
                background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(124, 58, 237, 0.05) 100%);
            }
            
            .table tr {
                border-bottom: 2px solid rgba(139, 92, 246, 0.1);
                margin-bottom: 1rem;
                display: block;
            }
            
            .img-thumbnail {
                max-width: 120px;
            }
        }

        /* ===== ENHANCEMENT ===== */
        .card-body {
            background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(248, 250, 252, 1) 100%);
        }

        .table tr:last-child {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
            overflow: hidden;
        }
    </style>

    <!-- JavaScript untuk Zoom Foto -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fotoElement = document.querySelector('.img-thumbnail');
            if (fotoElement) {
                // Zoom on click
                fotoElement.addEventListener('click', function() {
                    if (!this.classList.contains('zoomed')) {
                        this.classList.add('zoomed');
                        this.style.transform = 'scale(2)';
                        this.style.zIndex = '1000';
                        this.style.position = 'relative';
                        this.style.boxShadow = '0 20px 60px rgba(0,0,0,0.3)';
                        this.style.cursor = 'zoom-out';
                    } else {
                        this.classList.remove('zoomed');
                        this.style.transform = '';
                        this.style.zIndex = '';
                        this.style.position = '';
                        this.style.boxShadow = '';
                        this.style.cursor = '';
                    }
                });

                // Close zoom when clicking outside
                document.addEventListener('click', function(e) {
                    if (!fotoElement.contains(e.target) && fotoElement.classList.contains('zoomed')) {
                        fotoElement.classList.remove('zoomed');
                        fotoElement.style.transform = '';
                        fotoElement.style.zIndex = '';
                        fotoElement.style.position = '';
                        fotoElement.style.boxShadow = '';
                        fotoElement.style.cursor = '';
                    }
                });
            }

            // Tambahkan status aktif berdasarkan periode
            const periodeSelesaiElement = document.querySelector('td:contains("-")');
            if (periodeSelesaiElement) {
                const text = periodeSelesaiElement.textContent.trim();
                const today = new Date();
                const selesaiDate = text.split(' - ')[1];
                
                if (selesaiDate !== '-') {
                    const selesai = new Date(selesaiDate);
                    const isActive = selesai >= today;
                    
                    // Tambahkan badge status
                    const statusBadge = document.createElement('span');
                    statusBadge.className = isActive ? 'status-active' : 'status-inactive';
                    statusBadge.textContent = isActive ? 'Aktif' : 'Tidak Aktif';
                    statusBadge.style.marginLeft = '10px';
                    
                    periodeSelesaiElement.appendChild(statusBadge);
                }
            }
        });
    </script>
@stop
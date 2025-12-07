@extends('adminlte::page')

@section('title', 'Data Warga')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark">Data Warga</h1>
        <a href="{{ route('wargas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Tambah Warga
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <h3 class="card-title mb-2 mb-md-0">Daftar Warga</h3>
                <form method="GET" action="{{ route('wargas.index') }}" class="w-100 w-md-auto">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50">Cari (Nama / No KTP / Email)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="q" class="form-control border-0"
                                       placeholder="Ketik kata kunci..."
                                       value="{{ request('q') }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select form-select-sm border-0">
                                <option value="">Semua</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <label class="small mb-1 text-white-50">Agama</label>
                            <select name="agama" class="form-select form-select-sm border-0">
                                <option value="">Semua</option>
                                @foreach($agamas as $agama)
                                    <option value="{{ $agama }}" {{ request('agama') == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-1">
                            <button type="submit" class="btn btn-light btn-sm w-100">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <a href="{{ route('wargas.index') }}" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="bg-lightblue">
                        <tr>
                            <th width="6%">Foto</th>
                            <th width="5%">ID</th>
                            <th width="12%">No KTP</th>
                            <th width="20%">Nama Lengkap</th>
                            <th width="10%" class="text-center">Jenis Kelamin</th>
                            <th width="10%">Agama</th>
                            <th width="15%">Pekerjaan</th>
                            <th width="15%">Email</th>
                            <th width="7%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($wargas as $item)
                        <tr>
                            <td class="text-center">
                                <div class="table-avatar">
                                    @if($item->foto_profil_path && file_exists(public_path('storage/'.$item->foto_profil_path)))
                                        <img src="{{ asset('storage/'.$item->foto_profil_path) }}" alt="{{ $item->nama }}" 
                                             onerror="this.onerror=null;this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIyNCIgY3k9IjI0IiByPSIyNCIgZmlsbD0idXJsKCNwYWludDBfbGluZWFyXzQ4XzQ4KSIvPjxwYXRoIGQ9Ik0yNCAyOEMyNy44NjYgMjggMzEgMjQuODY2IDMxIDIxQzMxIDE3LjEzNCAyNy44NjYgMTQgMjQgMTRDMjAuMTM0IDE0IDE3IDE3LjEzNCAxNyAyMUMxNyAyNC44NjYgMjAuMTM0IDI4IDI0IDI4WiIgZmlsbD0id2hpdGUiLz48cGF0aCBkPSJNMzYgMzRDNDAuNDE4MyAzNCA0NCAzMC40MTgzIDQ0IDI2QzQ0IDIxLjU4MTcgNDAuNDE4MyAxOCAzNiAxOEMzMS41ODE3IDE4IDI4IDIxLjU4MTcgMjggMjZDMjggMzAuNDE4MyAzMS41ODE3IDM0IDM2IDM0WiIgZmlsbD0id2hpdGUiLz48ZGVmcz48bGluZWFyR3JhZGllbnQgaWQ9InBhaW50MF9saW5lYXJfNDhfNDgiIHgxPSIyNCIgeTE9IjAiIHgyPSIyNCIgeTI9IjQ4IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHN0b3Agc3RvcC1jb2xvcj0iIzY2N0VFQSIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzc2NEJBMiIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjwvc3ZnPg=='">
                                    @else
                                        <div class="avatar-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center fw-bold">{{ $item->warga_id }}</td>
                            <td style="max-width: 150px; word-wrap: break-word;">
                                {{ $item->no_ktp }}
                            </td>
                            <td style="max-width: 250px; word-wrap: break-word;">
                                {{ $item->nama }}
                            </td>
                            <td class="text-center">
                                @if($item->jenis_kelamin == 'L')
                                    <span class="badge badge-male">Laki-laki</span>
                                @else
                                    <span class="badge badge-female">Perempuan</span>
                                @endif
                            </td>
                            <td style="max-width: 120px; word-wrap: break-word;">
                                {{ $item->agama }}
                            </td>
                            <td style="max-width: 200px; word-wrap: break-word;">
                                {{ $item->pekerjaan }}
                            </td>
                            <td style="max-width: 220px; word-wrap: break-word;">
                                @if($item->email)
                                    <small>{{ $item->email }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('wargas.show', $item) }}" 
                                       class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('wargas.edit', $item) }}" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" 
                                            title="Hapus"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->nama }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <div class="empty-state">
                                    <i class="fas fa-users fa-3x mb-3"></i>
                                    <h5 class="mb-2">Tidak ada data warga</h5>
                                    <p class="text-muted mb-0">Mulai dengan menambahkan data warga baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($wargas->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                <div class="data-info">
                    <i class="fas fa-chart-bar me-1 text-primary"></i>
                    <span class="text-muted">
                        Menampilkan <strong>{{ $wargas->firstItem() ?? 0 }}</strong> - 
                        <strong>{{ $wargas->lastItem() ?? 0 }}</strong> dari 
                        <strong>{{ $wargas->total() }}</strong> data
                    </span>
                </div>
                
                <div class="pagination-container">
                    {{ $wargas->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data warga:</p>
                    <p class="fw-bold" id="delete-item-name"></p>
                    <p class="text-danger"><small>Aksi ini tidak dapat dibatalkan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form id="delete-form" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    /* ==================== BASE STYLES ==================== */
    .bg-lightblue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white;
        font-weight: 600;
    }
    
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .card-header {
        border-bottom: none;
        padding: 18px 24px;
    }
    
    .card-body {
        padding: 0;
    }
    
    /* ==================== TABLE STYLES ==================== */
    .table-responsive {
        overflow-x: auto;
        border-radius: 0 0 12px 12px;
        min-height: 400px;
    }
    
    .table {
        margin-bottom: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table th {
        border: none;
        padding: 16px 12px;
        font-size: 14px;
        text-align: center;
        vertical-align: middle;
        border-bottom: 2px solid #e2e8f0;
        font-weight: 600;
        color: white;
        white-space: nowrap;
    }
    
    .table td {
        border: none;
        padding: 14px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f1;
        text-align: center;
        font-size: 14px;
    }
    
    .table tbody tr:nth-child(even) {
        background-color: #fafafa;
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
        transition: all 0.3s ease;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }
    
    /* ==================== BADGE STYLES ==================== */
    .badge {
        font-size: 0.75em;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    
    .badge-male {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        color: white;
        box-shadow: 0 2px 4px rgba(66, 153, 225, 0.3);
    }
    
    .badge-female {
        background: linear-gradient(135deg, #ed64a6 0%, #d53f8c 100%);
        color: white;
        box-shadow: 0 2px 4px rgba(237, 100, 166, 0.3);
    }
    
    /* ==================== BUTTON STYLES ==================== */
    .action-buttons {
        display: flex;
        gap: 6px;
        justify-content: center;
    }
    
    .btn-sm {
        border-radius: 8px;
        padding: 6px;
        border: none;
        transition: all 0.3s ease;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }
    
    .btn-info {
        background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
        color: white;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: white;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    
    .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        color: white;
    }
    
    /* ==================== AVATAR STYLES ==================== */
    .table-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f6f8ff 0%, #eef2ff 100%);
    }
    
    .table-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .avatar-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 20px;
    }
    
    /* ==================== EMPTY STATE ==================== */
    .empty-state {
        padding: 40px 20px;
    }
    
    .empty-state i {
        color: #cbd5e0;
    }
    
    /* ==================== ALERT STYLES ==================== */
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: none;
        border-left: 4px solid #28a745;
        border-radius: 8px;
        color: #155724;
        padding: 14px 20px;
        margin-bottom: 20px;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        border: none;
        border-left: 4px solid #dc3545;
        border-radius: 8px;
        color: #721c24;
        padding: 14px 20px;
        margin-bottom: 20px;
    }
    
    /* ==================== CARD FOOTER ==================== */
    .card-footer {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 18px 24px;
    }
    
    .data-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .data-info i {
        font-size: 16px;
    }
    
    .data-info span {
        color: #64748b;
        font-size: 14px;
    }
    
    .data-info strong {
        color: #334155;
        font-weight: 600;
    }
    
    /* ==================== PAGINATION STYLES ==================== */
    .pagination-container {
        display: flex;
        justify-content: center;
    }
    
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .custom-pagination {
        display: flex;
        gap: 6px;
        list-style: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    
    .custom-pagination li {
        margin: 0;
        padding: 0;
    }
    
    .custom-pagination li a,
    .custom-pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
        cursor: pointer;
    }
    
    /* Previous & Next buttons */
    .custom-pagination li:first-child a,
    .custom-pagination li:first-child span,
    .custom-pagination li:last-child a,
    .custom-pagination li:last-child span {
        padding: 0 16px;
        font-weight: 600;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #4a5568;
    }
    
    /* Default page link */
    .custom-pagination li a {
        color: #4a5568;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .custom-pagination li a:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }
    
    /* Active page */
    .custom-pagination li.active span {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
        border: none;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        position: relative;
        overflow: hidden;
    }
    
    .custom-pagination li.active span::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        pointer-events: none;
    }
    
    /* Disabled state */
    .custom-pagination li.disabled span {
        background: #f7fafc;
        color: #a0aec0 !important;
        border: 1px solid #e2e8f0;
        cursor: not-allowed;
        opacity: 0.7;
    }
    
    /* Dots separator */
    .custom-pagination li.disabled:not(.active) span {
        background: transparent;
        border: none;
        color: #718096 !important;
        font-weight: bold;
        min-width: 20px;
        padding: 0 5px;
    }
    
    /* ==================== MODAL STYLES ==================== */
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    
    .modal-header {
        border-radius: 12px 12px 0 0;
        padding: 16px 24px;
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .modal-footer {
        border-top: 1px solid #e2e8f0;
        padding: 16px 24px;
    }
    
    /* ==================== RESPONSIVE STYLES ==================== */
    @media (max-width: 768px) {
        .card-header .row {
            gap: 12px;
        }
        
        .card-header .col-md-4,
        .card-header .col-md-3 {
            margin-bottom: 10px;
        }
        
        .table {
            min-width: 800px;
        }
        
        .table th,
        .table td {
            padding: 12px 8px;
            font-size: 13px;
        }
        
        .btn-sm {
            padding: 5px;
            width: 28px;
            height: 28px;
            font-size: 12px;
        }
        
        .table-avatar {
            width: 40px;
            height: 40px;
        }
        
        .avatar-placeholder {
            font-size: 16px;
        }
        
        .badge {
            font-size: 0.7em;
            padding: 4px 10px;
        }
        
        /* Responsive pagination */
        .custom-pagination {
            gap: 4px;
        }
        
        .custom-pagination li a,
        .custom-pagination li span {
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            font-size: 13px;
        }
        
        .custom-pagination li:first-child a,
        .custom-pagination li:first-child span,
        .custom-pagination li:last-child a,
        .custom-pagination li:last-child span {
            padding: 0 12px;
            font-size: 12px;
        }
        
        .card-footer {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
        
        .data-info {
            justify-content: center;
        }
    }
    
    @media (max-width: 576px) {
        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }
        
        .btn-sm {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* ==================== TEXT ALIGNMENT ==================== */
    .table td:nth-child(3),
    .table td:nth-child(4),
    .table td:nth-child(6),
    .table td:nth-child(7),
    .table td:nth-child(8) {
        text-align: left;
    }
    
    .table th:first-child,
    .table td:first-child,
    .table th:nth-child(2),
    .table td:nth-child(2),
    .table th:nth-child(5),
    .table td:nth-child(5),
    .table th:nth-child(9),
    .table td:nth-child(9) {
        text-align: center;
    }
    
    /* ==================== ANIMATIONS ==================== */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .table tbody tr {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .custom-pagination li a.loading {
        animation: pulse 1s infinite;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
        
        // Delete confirmation modal
        $('.delete-btn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const formAction = "{{ route('wargas.destroy', ':id') }}".replace(':id', id);
            
            $('#delete-item-name').text(name);
            $('#delete-form').attr('action', formAction);
            $('#deleteModal').modal('show');
        });
        
        // Pagination loading animation
        $(document).on('click', '.custom-pagination a', function(e) {
            e.preventDefault();
            const $link = $(this);
            const url = $link.attr('href');
            
            // Add loading state
            $link.addClass('loading').html('<i class="fas fa-spinner fa-spin"></i>');
            
            // Get all pagination links and disable them
            $('.custom-pagination a').css('pointer-events', 'none');
            
            // Fetch the page
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    // You can implement AJAX pagination here if needed
                    window.location.href = url;
                },
                error: function() {
                    $link.removeClass('loading').html($link.data('original-text'));
                    $('.custom-pagination a').css('pointer-events', 'auto');
                    alert('Terjadi kesalahan saat memuat halaman.');
                }
            });
        });
        
        // Store original text of pagination links
        $('.custom-pagination a').each(function() {
            $(this).data('original-text', $(this).html());
        });
        
        // Form loading state
        $('form').on('submit', function() {
            const $submitBtn = $(this).find('button[type="submit"]');
            if ($submitBtn.length) {
                $submitBtn.prop('disabled', true)
                          .html('<i class="fas fa-spinner fa-spin me-1"></i>Memproses...');
            }
        });
        
        // Auto focus on search input
        @if(request()->has('q'))
            $('input[name="q"]').focus().select();
        @endif
        
        // Filter form submission loading
        $('form[method="GET"]').on('submit', function() {
            const $filterBtn = $(this).find('button[type="submit"]');
            $filterBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Mencari...')
                     .prop('disabled', true);
        });
        
        // Smooth scroll to top on pagination click
        $(document).on('click', '.custom-pagination a', function() {
            $('html, body').animate({
                scrollTop: $('.card').offset().top - 100
            }, 500);
        });
        
        // Highlight row on hover
        $('.table tbody tr').hover(
            function() {
                $(this).css('transform', 'translateY(-2px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );
        
        // Tooltip initialization
        $('[title]').tooltip({
            placement: 'top',
            trigger: 'hover',
            container: 'body'
        });
    });
</script>
@stop
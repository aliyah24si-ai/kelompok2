@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Logo Simple di Kiri -->
            @if(file_exists(public_path('images/logo-perangkat-lembaga.png')))
                <img src="{{ asset('images/logo-perangkat-lembaga.png') }}" 
                     alt="Logo Perangkat Lembaga" 
                     class="header-logo me-3"
                     onerror="this.style.display='none';">
            @endif
            <h1> </i>Dashboard</h1>
        </div>
        <div class="text-muted">
            <i class="fas fa-calendar-alt mr-1"></i> {{ date('d F Y') }}
            <span class="mx-2">|</span>
            <i class="fas fa-clock mr-1"></i> {{ date('H:i') }}
        </div>
    </div>
@stop

@section('content')
    <!-- Welcome Message -->
    <div class="dashboard-welcome mb-4">
        <div class="welcome-content">
            <div class="welcome-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="welcome-text">
                <h4>Selamat Datang, <span class="highlight">{{ Auth::user()->name ?? 'Administrator' }}</span>!</h4>
                <p class="mb-0">Anda login sebagai <strong>{{ Auth::user()->role ?? 'Admin' }}</strong> | Sistem berjalan normal</p>
            </div>
            <div class="welcome-status">
                <span class="status-badge online">
                    <i class="fas fa-circle"></i> Online
                </span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-1">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">TOTAL WARGA</h6>
                        <h3 class="stat-value">{{ $totalWarga ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-chart-line text-success"></i>
                            <span class="text-muted">Data terbaru</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('wargas.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-2">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">TOTAL USER</h6>
                        <h3 class="stat-value">{{ $totalUsers ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-user-check text-info"></i>
                            <span class="text-muted">Pengguna aktif</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('users.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-3">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">LEMBAGA DESA</h6>
                        <h3 class="stat-value">{{ $totalLembaga ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-landmark text-warning"></i>
                            <span class="text-muted">Organisasi aktif</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('lembaga.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-4">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">PERANGKAT DESA</h6>
                        <h3 class="stat-value">{{ $totalPerangkat ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-user-shield text-danger"></i>
                            <span class="text-muted">Aparatur desa</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('perangkat_desa.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-5">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">TOTAL RT</h6>
                        <h3 class="stat-value">{{ $totalRt ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <span class="text-muted">Rukun Tetangga</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('rt.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-6">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">TOTAL RW</h6>
                        <h3 class="stat-value">{{ $totalRw ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-map text-success"></i>
                            <span class="text-muted">Rukun Warga</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('rw.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-7">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">TOTAL JABATAN</h6>
                        <h3 class="stat-value">{{ $totalJabatan ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-award text-warning"></i>
                            <span class="text-muted">Posisi jabatan</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('jabatan.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card card-8">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-title">ANGGOTA LEMBAGA</h6>
                        <h3 class="stat-value">{{ $totalAnggotaLembaga ?? 0 }}</h3>
                        <div class="stat-trend">
                            <i class="fas fa-user-friends text-info"></i>
                            <span class="text-muted">Anggota aktif</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('anggota-lembaga.index') }}" class="footer-link">
                        <i class="fas fa-external-link-alt"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Recent Data & Quick Stats -->
        <div class="col-lg-8">
            <!-- Recent Warga Table -->
            <div class="card dashboard-card mb-4">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-history mr-2"></i>Data Warga Terbaru</h3>
                    <div class="card-tools">
                        <span class="badge bg-info">{{ $recentWarga->count() ?? 0 }} Data</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($recentWarga) && $recentWarga->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="50px">#</th>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Agama</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentWarga as $index => $warga)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge-number">{{ $index + 1 }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm mr-3">
                                                    @if($warga->foto_profil_path && file_exists(public_path('storage/'.$warga->foto_profil_path)))
                                                        <img src="{{ asset('storage/'.$warga->foto_profil_path) }}" 
                                                             class="avatar-img" 
                                                             alt="{{ $warga->nama }}">
                                                    @else
                                                        <div class="avatar-placeholder">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $warga->nama }}</h6>
                                                    <small class="text-muted">{{ $warga->no_ktp ?? 'Tidak ada KTP' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($warga->jenis_kelamin == 'L')
                                                <span class="badge gender-male">
                                                    <i class="fas fa-mars"></i> Laki-laki
                                                </span>
                                            @else
                                                <span class="badge gender-female">
                                                    <i class="fas fa-venus"></i> Perempuan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-light">{{ $warga->agama ?? '-' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('wargas.show', $warga->warga_id) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('wargas.edit', $warga->warga_id) }}" 
                                                   class="btn btn-sm btn-warning" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5>Belum ada data warga</h5>
                            <p class="text-muted">Mulai dengan menambahkan data warga baru</p>
                            <a href="{{ route('wargas.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i> Tambah Warga
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Stats & System Info -->
        <div class="col-lg-4">
            <!-- Quick Stats -->
            <div class="card dashboard-card mb-4">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Statistik Gender</h3>
                </div>
                <div class="card-body">
                    <div class="stats-container">
                        <div class="stat-item">
                            <div class="stat-icon-box bg-primary">
                                <i class="fas fa-mars"></i>
                            </div>
                            <div class="stat-info">
                                <h4 class="stat-number">{{ $laki_laki ?? 0 }}</h4>
                                <span class="stat-label">Laki-laki</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon-box bg-pink">
                                <i class="fas fa-venus"></i>
                            </div>
                            <div class="stat-info">
                                <h4 class="stat-number">{{ $perempuan ?? 0 }}</h4>
                                <span class="stat-label">Perempuan</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    @php
                        $totalGender = ($laki_laki ?? 0) + ($perempuan ?? 0);
                        $malePercent = $totalGender > 0 ? round(($laki_laki / $totalGender) * 100) : 0;
                        $femalePercent = $totalGender > 0 ? round(($perempuan / $totalGender) * 100) : 0;
                    @endphp
                    <div class="progress-container mt-4">
                        <div class="progress-labels d-flex justify-content-between mb-2">
                            <span class="text-primary">Laki-laki {{ $malePercent }}%</span>
                            <span class="text-pink">Perempuan {{ $femalePercent }}%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                 style="width: {{ $malePercent }}%" 
                                 aria-valuenow="{{ $malePercent }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100"></div>
                            <div class="progress-bar bg-pink" role="progressbar" 
                                 style="width: {{ $femalePercent }}%" 
                                 aria-valuenow="{{ $femalePercent }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="card dashboard-card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Informasi Sistem</h3>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Admin</div>
                                <div class="info-value">{{ Auth::user()->name }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope text-success"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-tag text-warning"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Role</div>
                                <div class="info-value">
                                    <span class="role-badge">{{ Auth::user()->role ?? 'Admin' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-sign-in-alt text-info"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Login Terakhir</div>
                                <div class="info-value">{{ Auth::user()->updated_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    /* ==================== HEADER LOGO ==================== */
    .header-logo {
        height: 40px;
        width: auto;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        background: white;
        padding: 4px;
    }
    
    .header-logo:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* Responsive header logo */
    @media (max-width: 768px) {
        .header-logo {
            height: 32px;
            padding: 3px;
        }
    }

    /* ==================== DASHBOARD WELCOME ==================== */
    .dashboard-welcome {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 25px 30px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .welcome-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .welcome-icon {
        font-size: 50px;
        margin-right: 20px;
        opacity: 0.9;
    }
    
    .welcome-text {
        flex: 1;
    }
    
    .welcome-text h4 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .welcome-text .highlight {
        color: #ffd166;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .welcome-text p {
        opacity: 0.9;
        font-size: 14px;
    }
    
    .welcome-status .status-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .status-badge.online i {
        color: #4ade80;
        margin-right: 5px;
        font-size: 10px;
    }
    
    /* ==================== STATISTICS CARDS ==================== */
    .stat-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        background: white;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .card-1 { border-top: 4px solid #667eea; }
    .card-2 { border-top: 4px solid #10b981; }
    .card-3 { border-top: 4px solid #f59e0b; }
    .card-4 { border-top: 4px solid #ef4444; }
    .card-5 { border-top: 4px solid #8b5cf6; }
    .card-6 { border-top: 4px solid #06b6d4; }
    .card-7 { border-top: 4px solid #f97316; }
    .card-8 { border-top: 4px solid #ec4899; }
    
    .stat-card .card-body {
        padding: 25px;
        position: relative;
    }
    
    .stat-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 50px;
        opacity: 0.1;
        color: #333;
    }
    
    .stat-content {
        position: relative;
        z-index: 1;
    }
    
    .stat-title {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
    }
    
    .stat-value {
        font-size: 36px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 10px;
        line-height: 1;
    }
    
    .stat-trend {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
    }
    
    .stat-card .card-footer {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 15px 25px;
    }
    
    .footer-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.3s ease;
    }
    
    .footer-link:hover {
        color: #764ba2;
    }
    
    /* ==================== DASHBOARD CARDS ==================== */
    .dashboard-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .dashboard-card .card-header {
        background: white;
        border-bottom: 1px solid #e2e8f0;
        padding: 20px 25px;
        border-radius: 15px 15px 0 0;
    }
    
    .dashboard-card .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }
    
    .dashboard-card .card-body {
        padding: 25px;
    }
    
    /* ==================== TABLE STYLES ==================== */
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        border-top: none;
        border-bottom: 2px solid #e2e8f0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        color: #4a5568;
        padding: 15px 12px;
    }
    
    .table tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        border-color: #f1f5f9;
    }
    
    .table tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .badge-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 50%;
        font-weight: 600;
        font-size: 14px;
    }
    
    /* ==================== AVATAR STYLES ==================== */
    .avatar-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .avatar-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    
    /* ==================== BADGE STYLES ==================== */
    .badge {
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 20px;
        font-size: 12px;
    }
    
    .gender-male {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }
    
    .gender-female {
        background: rgba(236, 72, 153, 0.1);
        color: #ec4899;
        border: 1px solid rgba(236, 72, 153, 0.2);
    }
    
    /* ==================== QUICK STATS ==================== */
    .stats-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }
    
    .stat-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }
    
    .bg-pink {
        background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
    }
    
    .stat-info {
        flex: 1;
    }
    
    .stat-number {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        color: #2d3748;
    }
    
    .stat-label {
        font-size: 13px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }
    
    /* ==================== PROGRESS BAR ==================== */
    .progress-container {
        margin-top: 20px;
    }
    
    .progress-labels span {
        font-size: 13px;
        font-weight: 500;
    }
    
    .progress {
        border-radius: 10px;
        background-color: #e2e8f0;
        overflow: hidden;
    }
    
    .progress-bar {
        border-radius: 10px;
    }
    
    /* ==================== SYSTEM INFO ==================== */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px;
        background: #f8fafc;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        background: #f1f5f9;
    }
    
    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        background: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    
    .info-content {
        flex: 1;
    }
    
    .info-label {
        font-size: 12px;
        text-transform: uppercase;
        color: #6c757d;
        letter-spacing: 0.5px;
        font-weight: 500;
        margin-bottom: 3px;
    }
    
    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: #2d3748;
    }
    
    .role-badge {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    /* ==================== EMPTY STATE ==================== */
    .empty-state {
        padding: 40px 20px;
    }
    
    .empty-state h5 {
        color: #4a5568;
        margin: 15px 0 10px;
    }
    
    .empty-state p {
        color: #718096;
        margin-bottom: 20px;
    }
    
    /* ==================== BUTTON STYLES ==================== */
    .btn-sm {
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-group .btn-sm {
        margin: 0 2px;
    }
    
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* ==================== ANIMATIONS ==================== */
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
    
    .stat-card, .dashboard-card {
        animation: fadeInUp 0.5s ease-out;
    }
    
    /* ==================== RESPONSIVE STYLES ==================== */
    @media (max-width: 768px) {
        .welcome-content {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
        
        .welcome-icon {
            margin-right: 0;
            font-size: 40px;
        }
        
        .welcome-text h4 {
            font-size: 20px;
        }
        
        .stat-card .card-body {
            padding: 20px;
        }
        
        .stat-value {
            font-size: 30px;
        }
        
        .dashboard-card .card-body {
            padding: 20px;
        }
        
        .info-item {
            padding: 10px;
        }
        
        .stat-item {
            padding: 12px;
        }
        
        .table-responsive {
            font-size: 14px;
        }
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        console.log('Dashboard loaded successfully!');
        
        // Animate statistics numbers
        $('.stat-value').each(function() {
            var $this = $(this);
            var countTo = parseInt($this.text().replace(/,/g, ''));
            
            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 1500,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum).toLocaleString());
                },
                complete: function() {
                    $this.text(countTo.toLocaleString());
                }
            });
        });
        
        // Add hover effects to cards
        $('.stat-card, .dashboard-card').hover(
            function() {
                $(this).css('transform', 'translateY(-5px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );
        
        // Auto refresh dashboard every 5 minutes
        setInterval(function() {
            location.reload();
        }, 300000); // 5 minutes
    });
</script>
@stop
@extends('adminlte::page')

@section('title', 'Tambah Anggota Lembaga')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Tambah Anggota Lembaga</h1>
        <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
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
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title mb-0 text-white">
                <i class="fas fa-plus me-2"></i>Form Tambah Anggota Lembaga
            </h5>
        </div>
        
        <div class="card-body">
            <form action="{{ route('anggota-lembaga.store') }}" method="POST">
                @csrf
                
               
                <div class="form-group">
                    <label for="lembaga_id" class="font-weight-bold">Lembaga <span class="text-danger">*</span></label>
                    <select class="form-control @error('lembaga_id') is-invalid @enderror" 
                            id="lembaga_id" name="lembaga_id" required>
                        <option value="">Pilih Lembaga</option>
                        @foreach($lembagas as $lembaga)
                            <option value="{{ $lembaga->lembaga_id }}" 
                                {{ old('lembaga_id') == $lembaga->lembaga_id ? 'selected' : '' }}>
                                {{ $lembaga->nama_lembaga }}
                            </option>
                        @endforeach
                    </select>
                    @error('lembaga_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="warga_id" class="font-weight-bold">Warga <span class="text-danger">*</span></label>
                    <select class="form-control @error('warga_id') is-invalid @enderror" 
                            id="warga_id" name="warga_id" required>
                        <option value="">Pilih Warga</option>
                        @foreach($wargas as $warga)
                            <option value="{{ $warga->warga_id }}" 
                                {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                {{ $warga->nama }} - {{ $warga->no_ktp }}
                            </option>
                        @endforeach
                    </select>
                    @error('warga_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jabatan_id" class="font-weight-bold">Jabatan</label>
                    <select class="form-control @error('jabatan_id') is-invalid @enderror" 
                            id="jabatan_id" name="jabatan_id">
                        <option value="">Pilih Jabatan (Opsional)</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" 
                                {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                {{ $jabatan->nama_jabatan }} - {{ $jabatan->lembaga->nama_lembaga }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_mulai" class="font-weight-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" 
                                   id="tgl_mulai" name="tgl_mulai" 
                                   value="{{ old('tgl_mulai', date('Y-m-d')) }}" required>
                            @error('tgl_mulai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tgl_selesai" class="font-weight-bold">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" 
                                   id="tgl_selesai" name="tgl_selesai" 
                                   value="{{ old('tgl_selesai') }}">
                            <small class="text-muted">Kosongkan jika masih aktif</small>
                            @error('tgl_selesai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Data
                    </button>
                    <a href="{{ route('anggota-lembaga.index') }}" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
<style>
    /* SIMPLE STYLING - TIDAK KEPOTONG */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%) !important;
    }
    
    .card {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    
    .form-control {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 0.5rem 0.75rem;
    }
    
    .form-control:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.25);
    }
    
    .btn-primary {
        background-color: #8B5CF6;
        border-color: #8B5CF6;
        border-radius: 6px;
        padding: 0.5rem 1.5rem;
    }
    
    .btn-primary:hover {
        background-color: #7C3AED;
        border-color: #7C3AED;
    }
    
    .btn-outline-secondary {
        border-radius: 6px;
        padding: 0.5rem 1.5rem;
    }
    
    .font-weight-bold {
        font-weight: 600;
    }
    
    .text-danger {
        color: #dc3545 !important;
    }
    
    .text-muted {
        font-size: 0.875rem;
    }
    
    /* RESPONSIVE */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .ml-2 {
            margin-left: 0 !important;
        }
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Auto dismiss alerts
        setTimeout(function() {
            $('.alert').fadeOut(300, function() {
                $(this).alert('close');
            });
        }, 5000);
        
        // Validasi tanggal
        $('#tgl_mulai, #tgl_selesai').on('change', function() {
            const tglMulai = $('#tgl_mulai').val();
            const tglSelesai = $('#tgl_selesai').val();
            
            if (tglSelesai && tglMulai > tglSelesai) {
                alert('Tanggal mulai tidak boleh lebih besar dari tanggal selesai!');
                $('#tgl_selesai').val('');
                return false;
            }
        });
        
        // Focus pertama
        $('#lembaga_id').focus();
    });
</script>
@stop
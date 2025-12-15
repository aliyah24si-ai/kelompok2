@extends('adminlte::page')

@section('title', 'Edit RW')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Edit RW</h1>
        <a href="{{ route('rw.index') }}" class="btn btn-outline-secondary btn-sm">
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
                <i class="fas fa-edit me-2"></i>Form Edit RW
            </h5>
        </div>
        
        <div class="card-body">
            <form action="{{ route('rw.update', $rw->rw_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- SIMPLE VERTICAL LAYOUT -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_rw" class="font-weight-bold">Nomor RW <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('nomor_rw') is-invalid @enderror" 
                                   id="nomor_rw" 
                                   name="nomor_rw" 
                                   value="{{ old('nomor_rw', $rw->nomor_rw) }}" 
                                   placeholder="Contoh: 01, 02, 03"
                                   min="1"
                                   max="99"
                                   required>
                            <small class="text-muted">Masukkan angka 1-99</small>
                            @error('nomor_rw')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_rt" class="font-weight-bold">Jumlah RT <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('jumlah_rt') is-invalid @enderror" 
                                   id="jumlah_rt" 
                                   name="jumlah_rt" 
                                   value="{{ old('jumlah_rt', $rw->jumlah_rt ?? 0) }}" 
                                   placeholder="Contoh: 5, 10, 15"
                                   min="0"
                                   max="50"
                                   required>
                            <small class="text-muted">Jumlah RT di bawah RW ini (0-50)</small>
                            @error('jumlah_rt')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ketua_rw_warga_id" class="font-weight-bold">Ketua RW</label>
                    <select class="form-control @error('ketua_rw_warga_id') is-invalid @enderror" 
                            id="ketua_rw_warga_id" 
                            name="ketua_rw_warga_id">
                        <option value="">Pilih Ketua RW (Opsional)</option>
                        @foreach($wargas as $warga)
                            <option value="{{ $warga->warga_id }}" 
                                {{ old('ketua_rw_warga_id', $rw->ketua_rw_warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                {{ $warga->nama }} - {{ $warga->no_ktp }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Kosongkan jika belum ada ketua</small>
                    @error('ketua_rw_warga_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="keterangan" 
                              name="keterangan" 
                              rows="3" 
                              placeholder="Masukkan keterangan tambahan (opsional)...">{{ old('keterangan', $rw->keterangan) }}</textarea>
                    <small class="text-muted">Maksimal 500 karakter</small>
                    @error('keterangan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('rw.index') }}" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
<style>
    /* WARNA BIRU (SERAGAM DATA WARGA) */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
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
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-primary {
        background-color: #667eea;
        border-color: #667eea;
        border-radius: 6px;
        padding: 0.5rem 1.5rem;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #5a67d8;
        border-color: #5a67d8;
        color: white;
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
        
        // Format nomor RW input
        $('#nomor_rw').on('blur', function() {
            let value = $(this).val();
            if (value && value.length === 1) {
                $(this).val('0' + value);
            }
        });
        
        // Focus pertama
        $('#nomor_rw').focus();
    });
</script>
@stop
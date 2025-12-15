@extends('adminlte::page')

@section('title', 'Tambah RT')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Tambah RT</h1>
        <a href="{{ route('rt.index') }}" class="btn btn-outline-secondary btn-sm">
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
                <i class="fas fa-plus me-2"></i>Form Tambah RT
            </h5>
        </div>
        
        <div class="card-body">
            <form action="{{ route('rt.store') }}" method="POST">
                @csrf
                
                <!-- SIMPLE VERTICAL LAYOUT -->
                <div class="form-group">
                    <label for="rw_id" class="font-weight-bold">RW <span class="text-danger">*</span></label>
                    <select class="form-control @error('rw_id') is-invalid @enderror" 
                            id="rw_id" name="rw_id" required>
                        <option value="">Pilih RW</option>
                        @foreach($rws as $rw)
                            <option value="{{ $rw->rw_id }}" 
                                {{ old('rw_id') == $rw->rw_id ? 'selected' : '' }}>
                                RW {{ $rw->nomor_rw }}
                            </option>
                        @endforeach
                    </select>
                    @error('rw_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_rt" class="font-weight-bold">Nomor RT <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('nomor_rt') is-invalid @enderror" 
                                   id="nomor_rt" 
                                   name="nomor_rt" 
                                   value="{{ old('nomor_rt') }}" 
                                   placeholder="Contoh: 01, 02, 03"
                                   min="1"
                                   max="99"
                                   required>
                            <small class="text-muted">Masukkan angka 1-99</small>
                            @error('nomor_rt')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ketua_rt_warga_id" class="font-weight-bold">Ketua RT</label>
                            <select class="form-control @error('ketua_rt_warga_id') is-invalid @enderror" 
                                    id="ketua_rt_warga_id" 
                                    name="ketua_rt_warga_id">
                                <option value="">Pilih Ketua RT (Opsional)</option>
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->warga_id }}" 
                                        {{ old('ketua_rt_warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }} - {{ $warga->no_ktp }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Kosongkan jika belum ada ketua</small>
                            @error('ketua_rt_warga_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="keterangan" 
                              name="keterangan" 
                              rows="3" 
                              placeholder="Masukkan keterangan tambahan (opsional)...">{{ old('keterangan') }}</textarea>
                    <small class="text-muted">Maksimal 500 karakter</small>
                    @error('keterangan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan RT
                    </button>
                    <a href="{{ route('rt.index') }}" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
<style>
    /* WARNA UNGU SAMA DENGAN ANGGOTA LEMBAGA */
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
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #7C3AED;
        border-color: #7C3AED;
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
        
        // Validasi nomor RT
        $('#nomor_rt').on('blur', function() {
            let value = $(this).val();
            if (value && value.length === 1) {
                $(this).val('0' + value);
            }
        });
        
        // Focus pertama
        $('#rw_id').focus();
        
        // Form submission loading
        $('form').on('submit', function() {
            const $submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = $submitBtn.html();
            
            $submitBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...')
                     .prop('disabled', true);
        });
    });
</script>
@stop
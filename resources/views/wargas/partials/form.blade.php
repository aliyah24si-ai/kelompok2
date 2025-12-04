{{-- resources/views/wargas/partials/form.blade.php --}}
<div class="card form-card">
    <div class="card-header form-card-header">
        <h5 class="card-title mb-0">
            <i class="fas fa-user-plus me-2"></i>Form Data Warga
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- No KTP --}}
            <div class="col-md-6 mb-3">
                <label for="no_ktp" class="form-label">
                    <i class="fas fa-id-card me-2"></i>No KTP <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-fingerprint"></i>
                    </span>
                    <input type="text" name="no_ktp" id="no_ktp" maxlength="16"
                           class="form-control @error('no_ktp') is-invalid @enderror"
                           value="{{ old('no_ktp', $warga->no_ktp ?? '') }}"
                           placeholder="16 digit NIK" required>
                </div>
                @error('no_ktp') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            {{-- Nama Lengkap --}}
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">
                    <i class="fas fa-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-signature"></i>
                    </span>
                    <input type="text" name="nama" id="nama" maxlength="100"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $warga->nama ?? '') }}"
                           placeholder="Nama lengkap warga" required>
                </div>
                @error('nama') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            {{-- Jenis Kelamin --}}
            <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label">
                    <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user-tag"></i>
                    </span>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                @error('jenis_kelamin') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            {{-- Agama --}}
            <div class="col-md-6 mb-3">
                <label for="agama" class="form-label">
                    <i class="fas fa-pray me-2"></i>Agama <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-hands-praying"></i>
                    </span>
                    <input type="text" name="agama" id="agama" maxlength="20"
                           class="form-control @error('agama') is-invalid @enderror"
                           value="{{ old('agama', $warga->agama ?? '') }}"
                           placeholder="Agama" required>
                </div>
                @error('agama') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            {{-- Pekerjaan --}}
            <div class="col-md-6 mb-3">
                <label for="pekerjaan" class="form-label">
                    <i class="fas fa-briefcase me-2"></i>Pekerjaan <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user-tie"></i>
                    </span>
                    <input type="text" name="pekerjaan" id="pekerjaan" maxlength="50"
                           class="form-control @error('pekerjaan') is-invalid @enderror"
                           value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}"
                           placeholder="Pekerjaan" required>
                </div>
                @error('pekerjaan') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            {{-- Nomor Telepon --}}
            <div class="col-md-6 mb-3">
                <label for="telp" class="form-label">
                    <i class="fas fa-phone me-2"></i>Nomor Telepon
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-mobile-alt"></i>
                    </span>
                    <input type="text" name="telp" id="telp" maxlength="15"
                           class="form-control @error('telp') is-invalid @enderror"
                           value="{{ old('telp', $warga->telp ?? '') }}"
                           placeholder="081234567890">
                </div>
                @error('telp') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-at"></i>
                </span>
                <input type="email" name="email" id="email" maxlength="100"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $warga->email ?? '') }}"
                       placeholder="nama@email.com">
            </div>
            @error('email') <div class="error-message">{{ $message }}</div> @enderror
            <div class="form-info">
                <i class="fas fa-info-circle me-1"></i>Email harus unik dan belum terdaftar
            </div>
        </div>

        <div class="row">
            {{-- Foto Profil --}}
            <div class="col-md-6 mb-3">
                <label for="foto_profil" class="form-label">
                    <i class="fas fa-camera me-2"></i>Foto Profil
                </label>
                <div class="photo-preview-container">
                    <img id="fotoPreview" 
                         src="{{ isset($warga) && !empty($warga->foto_profil_url) ? $warga->foto_profil_url : 'https://via.placeholder.com/200x200/8B5CF6/FFFFFF?text=Preview+Foto' }}"
                         alt="Preview Foto"
                         class="photo-preview">
                </div>
                <input type="file" name="foto_profil" id="foto_profil"
                       accept="image/*"
                       class="form-control @error('foto_profil') is-invalid @enderror">
                @error('foto_profil') <div class="error-message">{{ $message }}</div> @enderror
                <div class="form-info">
                    <i class="fas fa-info-circle me-1"></i>Format: JPG/PNG, maksimal 2 MB
                </div>
            </div>

            {{-- Dokumen Pendukung --}}
            <div class="col-md-6 mb-3">
                <label for="dokumen" class="form-label">
                    <i class="fas fa-folder-open me-2"></i>Dokumen Pendukung
                </label>
                <input type="file" name="dokumen[]" id="dokumen"
                       class="form-control @error('dokumen.*') is-invalid @enderror"
                       multiple>
                @error('dokumen.*') <div class="error-message">{{ $message }}</div> @enderror
                <div class="form-info">
                    <i class="fas fa-info-circle me-1"></i>PDF/JPG/PNG, maks 5 MB per file
                </div>

                @if(isset($warga) && $warga->files->count())
                    <div class="document-list">
                        <div class="document-title">Dokumen Tersimpan</div>
                        <ul class="document-items">
                            @foreach($warga->files as $file)
                                <li class="document-item">
                                    <div class="document-info">
                                        <i class="fas fa-paperclip me-2"></i>
                                        <div>
                                            <span class="document-name">{{ $file->original_name }}</span>
                                            <small class="document-size">({{ $file->readable_size }})</small>
                                        </div>
                                    </div>
                                    <a href="{{ $file->file_url }}" target="_blank" class="view-btn">
                                        <i class="fas fa-eye me-1"></i>Lihat
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== VARIABLES ===== */
    :root {
        --primary-color: #8B5CF6;
        --primary-dark: #7C3AED;
        --primary-light: #EDE9FE;
        --danger-color: #EF4444;
        --success-color: #10B981;
        --gray-light: #F3F4F6;
        --gray-medium: #9CA3AF;
        --gray-dark: #4B5563;
        --border-radius: 12px;
        --shadow: 0 4px 20px rgba(139, 92, 246, 0.1);
        --shadow-hover: 0 8px 30px rgba(139, 92, 246, 0.15);
    }

    /* ===== CARD ===== */
    .form-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .form-card:hover {
        box-shadow: var(--shadow-hover);
    }

    .form-card-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        color: white;
    }

    .form-card-header .card-title {
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
    }

    .form-card-header .card-title i {
        font-size: 1.1rem;
    }

    .card-body {
        padding: 2rem;
    }

    /* ===== FORM LABELS ===== */
    .form-label {
        font-weight: 600;
        color: var(--gray-dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .form-label i {
        color: var(--primary-color);
        font-size: 0.95rem;
    }

    .form-label span.text-danger {
        color: var(--danger-color);
        margin-left: 4px;
    }

    /* ===== INPUT GROUPS ===== */
    .input-group {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #E5E7EB;
        transition: all 0.3s ease;
    }

    .input-group:hover {
        border-color: var(--primary-color);
    }

    .input-group:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .input-group-text {
        background-color: var(--gray-light);
        border: none;
        color: var(--primary-color);
        padding: 0.75rem 1rem;
    }

    .form-control,
    .form-select {
        border: none;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        background: white;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        background-color: white;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        background-image: none;
    }

    /* ===== ERROR MESSAGES ===== */
    .error-message {
        color: var(--danger-color);
        font-size: 0.875rem;
        margin-top: 0.25rem;
        font-weight: 500;
        padding-left: 0.5rem;
    }

    /* ===== FORM INFO ===== */
    .form-info {
        color: var(--gray-medium);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        padding-left: 0.5rem;
    }

    .form-info i {
        color: var(--primary-color);
    }

    /* ===== PHOTO PREVIEW ===== */
    .photo-preview-container {
        width: 200px;
        height: 200px;
        margin-bottom: 1rem;
        border-radius: var(--border-radius);
        overflow: hidden;
        border: 3px solid var(--gray-light);
        background-color: var(--gray-light);
        transition: all 0.3s ease;
    }

    .photo-preview-container:hover {
        border-color: var(--primary-color);
        transform: scale(1.02);
    }

    .photo-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .photo-preview-container:hover .photo-preview {
        transform: scale(1.05);
    }

    /* ===== FILE INPUT ===== */
    .form-control[type="file"] {
        padding: 0.75rem;
        background-color: var(--gray-light);
        border: 2px dashed #D1D5DB;
        cursor: pointer;
    }

    .form-control[type="file"]:hover {
        border-color: var(--primary-color);
        background-color: var(--primary-light);
    }

    /* ===== DOCUMENT LIST ===== */
    .document-list {
        margin-top: 1.5rem;
    }

    .document-title {
        font-weight: 600;
        color: var(--gray-dark);
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .document-items {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .document-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        background-color: white;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .document-item:hover {
        border-color: var(--primary-color);
        background-color: var(--primary-light);
        transform: translateX(5px);
    }

    .document-info {
        display: flex;
        align-items: center;
    }

    .document-info i {
        color: var(--primary-color);
        font-size: 1rem;
    }

    .document-name {
        font-weight: 500;
        color: var(--gray-dark);
    }

    .document-size {
        color: var(--gray-medium);
        font-size: 0.875rem;
    }

    .view-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .view-btn:hover {
        background-color: var(--primary-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mb-3 {
        animation: fadeIn 0.5s ease forwards;
        opacity: 0;
    }

    .mb-3:nth-child(1) { animation-delay: 0.1s; }
    .mb-3:nth-child(2) { animation-delay: 0.2s; }
    .mb-3:nth-child(3) { animation-delay: 0.3s; }
    .mb-3:nth-child(4) { animation-delay: 0.4s; }
    .mb-3:nth-child(5) { animation-delay: 0.5s; }
    .mb-3:nth-child(6) { animation-delay: 0.6s; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .photo-preview-container {
            width: 150px;
            height: 150px;
        }
        
        .document-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .view-btn {
            align-self: flex-end;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('foto_profil');
    const fotoPreview = document.getElementById('fotoPreview');
    
    if (fotoInput && fotoPreview) {
        fotoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    fotoPreview.src = e.target.result;
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
</script>
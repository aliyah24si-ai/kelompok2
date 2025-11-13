<div class="card shadow-sm border-0">
    <div class="card-header bg-gradient-primary text-white py-3">
        <h5 class="card-title mb-0">
            <i class="fas fa-building me-2"></i>Form Data Lembaga Desa
        </h5>
    </div>
    <div class="card-body p-4">
        {{-- Nama Lembaga --}}
        <div class="mb-4">
            <label for="nama_lembaga" class="form-label fw-semibold text-dark">
                <i class="fas fa-university me-1 text-primary"></i>Nama Lembaga <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-signature text-muted"></i>
                </span>
                <input type="text" name="nama_lembaga" id="nama_lembaga"
                       class="form-control border-start-0 @error('nama_lembaga') is-invalid @enderror"
                       value="{{ old('nama_lembaga', $lembaga->nama_lembaga ?? '') }}"
                       placeholder="Masukkan nama lembaga desa" maxlength="100" required>
            </div>
            @error('nama_lembaga') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="deskripsi" class="form-label fw-semibold text-dark">
                <i class="fas fa-align-left me-1 text-primary"></i>Deskripsi <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 align-items-start pt-3">
                    <i class="fas fa-file-alt text-muted"></i>
                </span>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="form-control border-start-0 @error('deskripsi') is-invalid @enderror"
                          placeholder="Masukkan deskripsi lengkap tentang lembaga desa" 
                          maxlength="225" required>{{ old('deskripsi', $lembaga->deskripsi ?? '') }}</textarea>
            </div>
            @error('deskripsi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            <div class="form-text text-muted small">
                <i class="fas fa-info-circle me-1"></i>Maksimal 225 karakter
            </div>
        </div>

        {{-- Kontak --}}
        <div class="mb-3">
            <label for="kontak" class="form-label fw-semibold text-dark">
                <i class="fas fa-phone me-1 text-primary"></i>Kontak
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-address-book text-muted"></i>
                </span>
                <input type="text" name="kontak" id="kontak"
                       class="form-control border-start-0 @error('kontak') is-invalid @enderror"
                       value="{{ old('kontak', $lembaga->kontak ?? '') }}"
                       placeholder="Nomor telepon atau kontak yang dapat dihubungi">
            </div>
            @error('kontak') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            <div class="form-text text-muted small">
                <i class="fas fa-info-circle me-1"></i>Pastikan nomor dapat dihubungi
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 12px;
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-2px);
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
}
.form-control, .form-select, textarea {
    border-radius: 8px;
    transition: all 0.3s ease;
}
.form-control:focus, .form-select:focus, textarea:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}
.input-group-text {
    border-radius: 8px 0 0 8px;
    min-width: 45px;
    justify-content: center;
}
.form-label {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}
</style>
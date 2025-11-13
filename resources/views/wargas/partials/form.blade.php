{{-- resources/views/wargas/partials/form.blade.php --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="card-title mb-0">
            <i class="fas fa-user-plus me-2"></i>Form Data Warga
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row">
            {{-- No KTP --}}
            <div class="col-md-6 mb-3">
                <label for="no_ktp" class="form-label fw-semibold text-dark">
                    <i class="fas fa-id-card me-1 text-primary"></i>No KTP <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-fingerprint text-muted"></i>
                    </span>
                    <input type="text" name="no_ktp" id="no_ktp" maxlength="16"
                           class="form-control border-start-0 @error('no_ktp') is-invalid @enderror"
                           value="{{ old('no_ktp', $warga->no_ktp ?? '') }}"
                           placeholder="16 digit NIK" required>
                </div>
                @error('no_ktp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Nama Lengkap --}}
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label fw-semibold text-dark">
                    <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-signature text-muted"></i>
                    </span>
                    <input type="text" name="nama" id="nama" maxlength="100"
                           class="form-control border-start-0 @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $warga->nama ?? '') }}"
                           placeholder="Nama lengkap warga" required>
                </div>
                @error('nama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            {{-- Jenis Kelamin --}}
            <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label fw-semibold text-dark">
                    <i class="fas fa-venus-mars me-1 text-primary"></i>Jenis Kelamin <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-user-tag text-muted"></i>
                    </span>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-select border-start-0 @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                @error('jenis_kelamin') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Agama --}}
            <div class="col-md-6 mb-3">
                <label for="agama" class="form-label fw-semibold text-dark">
                    <i class="fas fa-pray me-1 text-primary"></i>Agama <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-church text-muted"></i>
                    </span>
                    <input type="text" name="agama" id="agama" maxlength="20"
                           class="form-control border-start-0 @error('agama') is-invalid @enderror"
                           value="{{ old('agama', $warga->agama ?? '') }}"
                           placeholder="Agama" required>
                </div>
                @error('agama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            {{-- Pekerjaan --}}
            <div class="col-md-6 mb-3">
                <label for="pekerjaan" class="form-label fw-semibold text-dark">
                    <i class="fas fa-briefcase me-1 text-primary"></i>Pekerjaan <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-user-tie text-muted"></i>
                    </span>
                    <input type="text" name="pekerjaan" id="pekerjaan" maxlength="50"
                           class="form-control border-start-0 @error('pekerjaan') is-invalid @enderror"
                           value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}"
                           placeholder="Pekerjaan" required>
                </div>
                @error('pekerjaan') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Nomor Telepon --}}
            <div class="col-md-6 mb-3">
                <label for="telp" class="form-label fw-semibold text-dark">
                    <i class="fas fa-phone me-1 text-primary"></i>Nomor Telepon
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-mobile-alt text-muted"></i>
                    </span>
                    <input type="text" name="telp" id="telp" maxlength="15"
                           class="form-control border-start-0 @error('telp') is-invalid @enderror"
                           value="{{ old('telp', $warga->telp ?? '') }}"
                           placeholder="081234567890">
                </div>
                @error('telp') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">
                <i class="fas fa-envelope me-1 text-primary"></i>Email
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-at text-muted"></i>
                </span>
                <input type="email" name="email" id="email" maxlength="100"
                       class="form-control border-start-0 @error('email') is-invalid @enderror"
                       value="{{ old('email', $warga->email ?? '') }}"
                       placeholder="nama@email.com">
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            <div class="form-text text-muted small">
                <i class="fas fa-info-circle me-1"></i>Email harus unik dan belum terdaftar
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
.form-control, .form-select {
    border-radius: 8px;
    transition: all 0.3s ease;
}
.form-control:focus, .form-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}
.input-group-text {
    border-radius: 8px 0 0 8px;
}
.form-label {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}
</style>
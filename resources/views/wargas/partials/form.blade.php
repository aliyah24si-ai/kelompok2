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

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="foto_profil" class="form-label fw-semibold text-dark">
                    <i class="fas fa-camera me-1 text-primary"></i>Foto Profil
                </label>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="foto-preview border rounded shadow-sm">
                        <img
                            id="fotoPreview"
                            src="{{ isset($warga) ? $warga->foto_profil_url : asset('vendor/adminlte/dist/img/avatar5.png') }}"
                            alt="Preview Foto"
                            class="img-fluid rounded"
                        >
                    </div>
                    <div class="flex-grow-1">
                        <input type="file" name="foto_profil" id="foto_profil"
                               accept="image/*"
                               class="form-control @error('foto_profil') is-invalid @enderror">
                        <small class="text-muted d-block mt-2">
                            Format gambar (JPG/PNG) dengan ukuran maksimal 2 MB.
                        </small>
                        @error('foto_profil') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="dokumen" class="form-label fw-semibold text-dark">
                    <i class="fas fa-folder-open me-1 text-primary"></i>Dokumen Pendukung
                </label>
                <input type="file" name="dokumen[]" id="dokumen"
                       class="form-control @error('dokumen.*') is-invalid @enderror"
                       multiple>
                <small class="text-muted d-block mt-2">
                    Unggah beberapa file sekaligus (PDF/JPG/PNG, maks 5 MB per file).
                </small>
                @error('dokumen.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

                @if(isset($warga) && $warga->files->count())
                    <div class="mt-3">
                        <div class="fw-semibold mb-2 text-dark">Dokumen Tersimpan</div>
                        <ul class="list-group list-group-flush rounded shadow-sm">
                            @foreach($warga->files as $file)
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <i class="fas fa-paperclip me-2 text-primary"></i>{{ $file->original_name }}
                                        <small class="text-muted ms-2">({{ $file->readable_size }})</small>
                                    </div>
                                    <a href="{{ $file->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download me-1"></i>Lihat
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
.foto-preview {
    width: 120px;
    height: 120px;
    background-color: #f9fafb;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}
.foto-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('foto_profil');
        const preview = document.getElementById('fotoPreview');

        if (input && preview) {
            input.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>
@endpush
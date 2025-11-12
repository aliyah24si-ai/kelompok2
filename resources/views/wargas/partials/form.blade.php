{{-- resources/views/wargas/partials/form.blade.php --}}

{{-- TIDAK ADA input untuk warga_id (otomatis) --}}
{{-- TIDAK ADA input untuk lembaga_id --}}

<div class="form-group mb-3">
    <label for="no_ktp">No KTP *</label>
    <input type="text" name="no_ktp" id="no_ktp" maxlength="16"
           class="form-control @error('no_ktp') is-invalid @enderror"
           value="{{ old('no_ktp', $warga->no_ktp ?? '') }}"
           placeholder="Masukkan 16 digit NIK" required>
    @error('no_ktp') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="nama">Nama Lengkap *</label>
    <input type="text" name="nama" id="nama" maxlength="100"
           class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $warga->nama ?? '') }}"
           placeholder="Masukkan nama lengkap" required>
    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="jenis_kelamin">Jenis Kelamin *</label>
    <select name="jenis_kelamin" id="jenis_kelamin"
            class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
        <option value="">Pilih Jenis Kelamin</option>
        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
    @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="agama">Agama *</label>
    <input type="text" name="agama" id="agama" maxlength="20"
           class="form-control @error('agama') is-invalid @enderror"
           value="{{ old('agama', $warga->agama ?? '') }}"
           placeholder="Masukkan agama" required>
    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="pekerjaan">Pekerjaan *</label>
    <input type="text" name="pekerjaan" id="pekerjaan" maxlength="50"
           class="form-control @error('pekerjaan') is-invalid @enderror"
           value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}"
           placeholder="Masukkan pekerjaan" required>
    @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="telp">Nomor Telepon</label>
    <input type="text" name="telp" id="telp" maxlength="15"
           class="form-control @error('telp') is-invalid @enderror"
           value="{{ old('telp', $warga->telp ?? '') }}"
           placeholder="Contoh: 081234567890">
    @error('telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" maxlength="100"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $warga->email ?? '') }}"
           placeholder="Contoh: nama@email.com (harus unik)">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

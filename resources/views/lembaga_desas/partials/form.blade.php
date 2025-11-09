<div class="form-group mb-3">
    <label for="nama_lembaga">Nama Lembaga</label>
    <input type="text" name="nama_lembaga" id="nama_lembaga"
           class="form-control @error('nama_lembaga') is-invalid @enderror"
           value="{{ old('nama_lembaga', $lembagaDesa->nama_lembaga ?? '') }}"
           maxlength="100">
    @error('nama_lembaga') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="deskripsi">Deskripsi</label>
    <input type="text" name="deskripsi" id="deskripsi"
           class="form-control @error('deskripsi') is-invalid @enderror"
           value="{{ old('deskripsi', $lembagaDesa->deskripsi ?? '') }}"
           maxlength="225">
    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="kontak">Kontak</label>
    <input type="text" name="kontak" id="kontak"
           class="form-control @error('kontak') is-invalid @enderror"
           value="{{ old('kontak', $lembagaDesa->kontak ?? '') }}"
           >
    @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>


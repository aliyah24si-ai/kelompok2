@csrf

<div class="mb-3">
    <label for="warga_id" class="form-label">Warga</label>
    <select name="warga_id" id="warga_id" class="form-select @error('warga_id') is-invalid @enderror">
        <option value="">-- Pilih Warga --</option>
        @foreach($wargas as $w)
            <option value="{{ $w->warga_id }}" {{ (old('warga_id', isset($item) ? $item->warga_id : '') == $w->warga_id) ? 'selected' : '' }}>{{ $w->nama }} ({{ $w->nik ?? '-' }})</option>
        @endforeach
    </select>
    @error('warga_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="jabatan" class="form-label">Jabatan</label>
    <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $item->jabatan ?? '') }}">
    @error('jabatan')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="nip" class="form-label">NIP</label>
    <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $item->nip ?? '') }}">
    @error('nip')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="kontak" class="form-label">Kontak</label>
    <input type="text" name="kontak" id="kontak" class="form-control @error('kontak') is-invalid @enderror" value="{{ old('kontak', $item->kontak ?? '') }}">
    @error('kontak')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="periode_mulai" class="form-label">Periode Mulai</label>
        <input type="date" name="periode_mulai" id="periode_mulai" class="form-control @error('periode_mulai') is-invalid @enderror" value="{{ old('periode_mulai', isset($item) ? $item->periode_mulai ? $item->periode_mulai->format('Y-m-d') : '' : '') }}">
        @error('periode_mulai')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="periode_selesai" class="form-label">Periode Selesai</label>
        <input type="date" name="periode_selesai" id="periode_selesai" class="form-control @error('periode_selesai') is-invalid @enderror" value="{{ old('periode_selesai', isset($item) ? $item->periode_selesai ? $item->periode_selesai->format('Y-m-d') : '' : '') }}">
        @error('periode_selesai')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<div class="mb-3">
    <label for="foto" class="form-label">Foto (opsional)</label>
    <div class="file-upload-container">
        <input type="file" name="foto" id="foto" class="hidden-file-input" accept="image/*">
        <div class="drag-drop-area default">
            <div class="upload-icon">📁</div>
            <div class="upload-text">
                <h5>Upload Foto</h5>
                <p>Drag & drop file di sini atau klik untuk memilih</p>
                <small>Format: JPG, PNG | Maks: 5MB</small>
            </div>
            <div class="upload-progress">
                <div class="progress-bar"></div>
            </div>
        </div>
        <div class="preview-container"></div>
    </div>
    @if(isset($item) && $item->foto)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $item->foto) }}" alt="foto" style="max-width:150px;" class="img-thumbnail">
        </div>
    @endif
    @error('foto')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
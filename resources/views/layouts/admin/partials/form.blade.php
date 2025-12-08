{{-- layouts/admin/partials/form.blade.php --}}
@csrf

@if(isset($method))
    @method($method)
@endif

<div class="row">
    <!-- Contoh field - sesuaikan dengan kebutuhan -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama" class="required">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama', $item->nama ?? '') }}" placeholder="Masukkan nama">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email', $item->email ?? '') }}" placeholder="example@email.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- Tambahkan field lainnya sesuai kebutuhan -->

{{-- Contoh untuk foto upload --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="foto">Foto</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="foto" name="foto" 
                       accept="image/*" onchange="previewImage(this)">
                <label class="custom-file-label" for="foto">Pilih file foto</label>
            </div>
            @error('foto')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div id="imagePreview">
            @if(isset($item) && $item->foto)
                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>
    </div>
</div>
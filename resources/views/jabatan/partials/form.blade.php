<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="lembaga_id" class="font-weight-bold">
                <i class="fas fa-building mr-2 text-primary"></i>Lembaga <span class="text-danger">*</span>
            </label>
            <select name="lembaga_id" id="lembaga_id" class="form-control @error('lembaga_id') is-invalid @enderror" required>
                <option value="">Pilih Lembaga</option>
                @foreach($lembagas as $lembaga)
                    <option value="{{ $lembaga->lembaga_id }}" 
                        {{ (old('lembaga_id', $jabatan->lembaga_id ?? '') == $lembaga->lembaga_id) ? 'selected' : '' }}>
                        🏛️ {{ $lembaga->nama_lembaga }}
                    </option>
                @endforeach
            </select>
            @error('lembaga_id')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama_jabatan" class="font-weight-bold">
                <i class="fas fa-user-tie mr-2 text-primary"></i>Nama Jabatan <span class="text-danger">*</span>
            </label>
            <input type="text" name="nama_jabatan" id="nama_jabatan" 
                   class="form-control @error('nama_jabatan') is-invalid @enderror" 
                   value="{{ old('nama_jabatan', $jabatan->nama_jabatan ?? '') }}" 
                   placeholder="Contoh: Kepala Desa, Sekretaris Desa" 
                   required>
            @error('nama_jabatan')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="level" class="font-weight-bold">
                <i class="fas fa-layer-group mr-2 text-primary"></i>Level <span class="text-danger">*</span>
            </label>
            <select name="level" id="level" class="form-control @error('level') is-invalid @enderror" required>
    <option value="" disabled {{ old('level') ? '' : 'selected' }}>-- Pilih Level Jabatan --</option>
    <option value="Pimpinan" {{ old('level') == 'Pimpinan' ? 'selected' : '' }}>Pimpinan</option>
    <option value="Manager" {{ old('level') == 'Manager' ? 'selected' : '' }}>Manager</option>
    <option value="Staff" {{ old('level') == 'Staff' ? 'selected' : '' }}>Staff</option>
    <option value="Operator" {{ old('level') == 'Operator' ? 'selected' : '' }}>Operator</option>
</select>
            @error('level')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
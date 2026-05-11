<x-app-layout>
<x-slot name="header">Tambah Obat</x-slot>

<!-- Tambah Obat -->
<div style="margin-bottom:22px;">
    <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Tambah Obat Baru</h1>
    <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Tambahkan data obat ke inventaris UKS</p>
</div>

<div class="card" style="max-width:550px; padding:28px;">
    <form action="{{ route('medicines.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="nama_obat">Nama Obat</label>
            <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ old('nama_obat') }}" placeholder="Contoh: Paracetamol" required>
            @error('nama_obat') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label class="form-label" for="satuan">Satuan</label>
                <select name="satuan" id="satuan" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Tablet" {{ old('satuan') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="Kapsul" {{ old('satuan') == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                    <option value="Botol" {{ old('satuan') == 'Botol' ? 'selected' : '' }}>Botol</option>
                    <option value="Sachet" {{ old('satuan') == 'Sachet' ? 'selected' : '' }}>Sachet</option>
                    <option value="Tube" {{ old('satuan') == 'Tube' ? 'selected' : '' }}>Tube</option>
                    <option value="Strip" {{ old('satuan') == 'Strip' ? 'selected' : '' }}>Strip</option>
                    <option value="Buah" {{ old('satuan') == 'Buah' ? 'selected' : '' }}>Buah</option>
                </select>
                @error('satuan') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="stok">Stok Awal</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', 0) }}" min="0" required>
                @error('stok') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div style="display:flex; gap:10px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Simpan Obat</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</x-app-layout>

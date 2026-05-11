<x-app-layout>
<x-slot name="header">Edit Obat</x-slot>

<!-- Edit Obat -->
<div style="margin-bottom:22px;">
    <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Edit Data Obat</h1>
    <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Perbarui informasi dan stok obat</p>
</div>

<div class="card" style="max-width:550px; padding:28px;">
    <form action="{{ route('medicines.update', $medicine) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="nama_obat">Nama Obat</label>
            <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ old('nama_obat', $medicine->nama_obat) }}" required>
            @error('nama_obat') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label class="form-label" for="satuan">Satuan</label>
                <select name="satuan" id="satuan" class="form-control" required>
                    <option value="Tablet" {{ old('satuan', $medicine->satuan) == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="Kapsul" {{ old('satuan', $medicine->satuan) == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                    <option value="Botol" {{ old('satuan', $medicine->satuan) == 'Botol' ? 'selected' : '' }}>Botol</option>
                    <option value="Sachet" {{ old('satuan', $medicine->satuan) == 'Sachet' ? 'selected' : '' }}>Sachet</option>
                    <option value="Tube" {{ old('satuan', $medicine->satuan) == 'Tube' ? 'selected' : '' }}>Tube</option>
                    <option value="Strip" {{ old('satuan', $medicine->satuan) == 'Strip' ? 'selected' : '' }}>Strip</option>
                    <option value="Buah" {{ old('satuan', $medicine->satuan) == 'Buah' ? 'selected' : '' }}>Buah</option>
                </select>
                @error('satuan') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $medicine->stok) }}" min="0" required>
                @error('stok') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Info stok saat ini -->
        <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:8px; padding:12px 16px; margin-bottom:18px;">
            <div style="font-size:0.78rem; color:#1d4ed8; font-weight:600;">ℹ️ Stok saat ini: {{ $medicine->stok }} {{ $medicine->satuan }}</div>
        </div>

        <div style="display:flex; gap:10px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</x-app-layout>

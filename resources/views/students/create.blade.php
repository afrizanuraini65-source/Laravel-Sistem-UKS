<x-app-layout>
<x-slot name="header">Tambah Siswa</x-slot>

<!-- Tambah Siswa -->
<div style="margin-bottom:22px;">
    <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Tambah Siswa Baru</h1>
    <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Isi form di bawah untuk mendaftarkan siswa baru</p>
</div>

<div class="card" style="max-width:600px; padding:28px;">
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="nis">NIS (Nomor Induk Siswa)</label>
            <input type="text" name="nis" id="nis" class="form-control @error('nis') border-red-400 @enderror" value="{{ old('nis') }}" placeholder="Contoh: 0012345678" required>
            @error('nis') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') border-red-400 @enderror" value="{{ old('nama') }}" placeholder="Nama lengkap siswa" required>
            @error('nama') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') border-red-400 @enderror" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Jenis Kelamin</label>
            <div style="display:flex; gap:16px; margin-top:6px;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="radio" name="jk" value="L" {{ old('jk') == 'L' ? 'checked' : '' }} style="accent-color:#1d4ed8; width:16px; height:16px;">
                    <span style="font-size:0.875rem; font-weight:500;">Laki-laki</span>
                </label>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="radio" name="jk" value="P" {{ old('jk') == 'P' ? 'checked' : '' }} style="accent-color:#1d4ed8; width:16px; height:16px;">
                    <span style="font-size:0.875rem; font-weight:500;">Perempuan</span>
                </label>
            </div>
            @error('jk') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:flex; gap:10px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Simpan Siswa</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</x-app-layout>

<x-app-layout>
<x-slot name="header">Edit Siswa</x-slot>

<!-- Edit Siswa -->
<div style="margin-bottom:22px;">
    <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Edit Data Siswa</h1>
    <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Perbarui informasi siswa di bawah ini</p>
</div>

<div class="card" style="max-width:600px; padding:28px;">
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="nis">NIS (Nomor Induk Siswa)</label>
            <input type="text" name="nis" id="nis" class="form-control" value="{{ old('nis', $student->nis) }}" required>
            @error('nis') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $student->nama) }}" required>
            @error('nama') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id', $student->kelas_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Jenis Kelamin</label>
            <div style="display:flex; gap:16px; margin-top:6px;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="radio" name="jk" value="L" {{ old('jk', $student->jk) == 'L' ? 'checked' : '' }} style="accent-color:#1d4ed8; width:16px; height:16px;">
                    <span style="font-size:0.875rem; font-weight:500;">Laki-laki</span>
                </label>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="radio" name="jk" value="P" {{ old('jk', $student->jk) == 'P' ? 'checked' : '' }} style="accent-color:#1d4ed8; width:16px; height:16px;">
                    <span style="font-size:0.875rem; font-weight:500;">Perempuan</span>
                </label>
            </div>
            @error('jk') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div style="display:flex; gap:10px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</x-app-layout>

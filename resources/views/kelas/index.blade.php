<x-app-layout>
<x-slot name="header">Data Kelas</x-slot>

<!-- Data Kelas -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:22px;">
    <div>
        <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Data Kelas</h1>
        <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Kelola data kelas SMKN 1 Purwokerto</p>
    </div>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div style="display:grid; grid-template-columns: 1fr 1.5fr; gap:22px;">
    <!-- Form Tambah Kelas -->
    <div class="card" style="padding:24px; align-self:start;">
        <h2 style="font-size:0.95rem; font-weight:700; color:#0f172a; margin-bottom:16px;">Tambah Kelas Baru</h2>
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nama_kelas">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" placeholder="Contoh: XII RPL 1" required>
                @error('nama_kelas') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah Kelas
            </button>
        </form>
    </div>

    <!-- Daftar Kelas -->
    <div class="card" style="padding:24px;">
        <h2 style="font-size:0.95rem; font-weight:700; color:#0f172a; margin-bottom:16px;">Daftar Kelas</h2>
        <table class="table-modern">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Jumlah Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $i => $k)
                <tr>
                    <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                    <td style="font-weight:600; color:#1e293b;">{{ $k->nama_kelas }}</td>
                    <td>
                        <span class="badge badge-blue">{{ $k->students->count() }} siswa</span>
                    </td>
                    <td>
                        <form action="{{ route('kelas.destroy', $k) }}" method="POST" onsubmit="return confirm('Yakin hapus kelas ini? Semua siswa di kelas ini juga akan terhapus.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; color:#94a3b8; padding:32px;">Belum ada data kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>

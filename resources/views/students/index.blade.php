<x-app-layout>
<x-slot name="header">Data Siswa</x-slot>

<!-- Students Index -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:22px;">
    <div>
        <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Data Siswa</h1>
        <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Daftar seluruh siswa yang terdaftar di UKS</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Siswa
    </a>
</div>

<!-- Search Bar -->
<div class="card" style="padding:15px; margin-bottom:22px;">
    <form action="{{ route('students.index') }}" method="GET" style="display:flex; gap:10px;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama atau NIS siswa..." style="max-width:300px;">
        <button type="submit" class="btn btn-secondary">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari
        </button>
        @if(request('search'))
            <a href="{{ route('students.index') }}" class="btn btn-secondary" style="background:#fee2e2; color:#dc2626;">Reset</a>
        @endif
    </form>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="card" style="padding:24px;">
    <table class="table-modern">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Riwayat Kunjungan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td style="color:#94a3b8;">{{ $students->firstItem() + $loop->index }}</td>
                <td><code style="background:#f1f5f9; padding:2px 7px; border-radius:4px; font-size:0.8rem;">{{ $student->nis }}</code></td>
                <td style="font-weight:600; color:#1e293b;">{{ $student->nama }}</td>
                <td><span class="badge badge-blue">{{ $student->kelas->nama_kelas ?? '-' }}</span></td>
                <td>
                    <span class="badge {{ $student->jk === 'L' ? 'badge-blue' : '' }}" style="{{ $student->jk === 'P' ? 'background:#fce7f3; color:#9d174d;' : '' }}">
                        {{ $student->jk === 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-green">{{ $student->treatments->count() }}x</span>
                </td>
                <td>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('students.show', $student) }}" class="btn btn-secondary btn-sm" style="background:#e0f2fe; color:#0369a1;">Riwayat</a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Yakin hapus siswa ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#94a3b8; padding:40px;">Belum ada data siswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;">{{ $students->links() }}</div>
</div>
</x-app-layout>

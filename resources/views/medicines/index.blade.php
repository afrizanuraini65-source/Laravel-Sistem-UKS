<x-app-layout>
<x-slot name="header">Data Obat</x-slot>

<!-- Data Obat -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:22px;">
    <div>
        <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Manajemen Stok Obat</h1>
        <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Kelola data dan stok obat UKS</p>
    </div>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('medicines.create') }}" class="btn btn-primary">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Obat
    </a>
    @endif
</div>

<!-- Search Bar -->
<div class="card" style="padding:15px; margin-bottom:22px;">
    <form action="{{ route('medicines.index') }}" method="GET" style="display:flex; gap:10px;">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama obat..." style="max-width:300px;">
        <button type="submit" class="btn btn-secondary">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari
        </button>
        @if(request('search'))
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary" style="background:#fee2e2; color:#dc2626;">Reset</a>
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
                <th>Nama Obat</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Status</th>
                @if(Auth::user()->role === 'admin')
                <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($medicines as $index => $medicine)
            <tr>
                <td style="color:#94a3b8;">{{ $medicines->firstItem() + $index }}</td>
                <td style="font-weight:600; color:#1e293b;">{{ $medicine->nama_obat }}</td>
                <td style="color:#64748b;">{{ $medicine->satuan }}</td>
                <td>
                    <span style="font-weight:700; font-size:1rem; color:{{ $medicine->stok > 5 ? '#16a34a' : ($medicine->stok > 0 ? '#d97706' : '#dc2626') }};">
                        {{ $medicine->stok }}
                    </span>
                </td>
                <td>
                    @if($medicine->stok > 5)
                        <span class="badge badge-green">Tersedia</span>
                    @elseif($medicine->stok > 0)
                        <span class="badge badge-orange">Menipis</span>
                    @else
                        <span class="badge badge-red">Habis</span>
                    @endif
                </td>
                @if(Auth::user()->role === 'admin')
                <td>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" onsubmit="return confirm('Yakin hapus obat ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="{{ Auth::user()->role === 'admin' ? 6 : 5 }}" style="text-align:center; color:#94a3b8; padding:40px;">Belum ada data obat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px;">{{ $medicines->links() }}</div>
</div>
</x-app-layout>

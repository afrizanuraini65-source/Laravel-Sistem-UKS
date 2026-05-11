<x-app-layout>
<x-slot name="header">Data Kunjungan UKS</x-slot>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:22px;">
    <div>
        <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Data Kunjungan UKS</h1>
        <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Daftar seluruh riwayat kunjungan siswa ke UKS</p>
    </div>
    <a href="{{ route('treatments.create') }}" class="btn btn-primary">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Kunjungan
    </a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="card" style="padding:24px;">
    <table class="table-modern">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Keluhan</th>
                <th>Obat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($treatments as $index => $treatment)
            <tr>
                <td style="color:#94a3b8;">{{ $treatments->firstItem() + $index }}</td>
                <td style="font-weight:500;">{{ \Carbon\Carbon::parse($treatment->tanggal_kunjungan)->format('d M Y') }}</td>
                <td style="font-weight:700; color:#1e293b;">{{ $treatment->student->nama }}</td>
                <td><span class="badge badge-blue">{{ $treatment->student->kelas->nama_kelas ?? '-' }}</span></td>
                <td style="color:#64748b;">{{ Str::limit($treatment->keluhan, 25) }}</td>
                <td>
                    @foreach($treatment->medicines as $medicine)
                        <span class="badge badge-green" style="margin-right:2px; display:inline-block; margin-bottom:2px;">
                            {{ $medicine->nama_obat }} ({{ $medicine->pivot->quantity }})
                        </span>
                    @endforeach
                    @if($treatment->medicines->isEmpty()) <span style="color:#94a3b8;">-</span> @endif
                </td>
                <td>
                    <a href="{{ route('treatments.show', $treatment) }}" class="btn btn-secondary btn-sm">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#94a3b8; padding:40px;">Belum ada data kunjungan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top:16px;">
        {{ $treatments->links() }}
    </div>
</div>
</x-app-layout>

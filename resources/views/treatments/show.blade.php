<x-app-layout>
<x-slot name="header">Detail Kunjungan</x-slot>

<!-- Detail Kunjungan -->
<div style="margin-bottom:22px;">
    <a href="{{ route('treatments.index') }}" style="font-size:0.8rem; color:#3b82f6; text-decoration:none; display:inline-flex; align-items:center; gap:4px; margin-bottom:8px;">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Kunjungan
    </a>
    <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Detail Kunjungan UKS</h1>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:22px;">
    <!-- Info Siswa -->
    <div class="card" style="padding:24px;">
        <h2 style="font-size:0.85rem; font-weight:700; color:#1d4ed8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:16px;">Informasi Siswa</h2>
        <div style="display:grid; gap:14px;">
            <div>
                <div style="font-size:0.72rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Nama Lengkap</div>
                <div style="font-size:0.95rem; font-weight:700; color:#0f172a; margin-top:2px;">{{ $treatment->student->nama }}</div>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                <div>
                    <div style="font-size:0.72rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">NIS</div>
                    <div style="font-size:0.875rem; color:#334155; margin-top:2px;"><code style="background:#f1f5f9; padding:2px 8px; border-radius:4px;">{{ $treatment->student->nis }}</code></div>
                </div>
                <div>
                    <div style="font-size:0.72rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Kelas</div>
                    <div style="margin-top:4px;"><span class="badge badge-blue">{{ $treatment->student->kelas->nama_kelas ?? '-' }}</span></div>
                </div>
            </div>
            <div>
                <div style="font-size:0.72rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Jenis Kelamin</div>
                <div style="margin-top:4px;">
                    <span class="badge {{ $treatment->student->jk === 'L' ? 'badge-blue' : '' }}" style="{{ $treatment->student->jk === 'P' ? 'background:#fce7f3; color:#9d174d;' : '' }}">
                        {{ $treatment->student->jk === 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Kunjungan -->
    <div class="card" style="padding:24px;">
        <h2 style="font-size:0.85rem; font-weight:700; color:#1d4ed8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:16px;">Data Kunjungan</h2>
        <div style="display:grid; gap:14px;">
            <div>
                <div style="font-size:0.72rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Tanggal Kunjungan</div>
                <div style="font-size:0.95rem; font-weight:600; color:#0f172a; margin-top:2px;">{{ \Carbon\Carbon::parse($treatment->tanggal_kunjungan)->format('l, d F Y') }}</div>
            </div>
            <div>
                <div style="font-size:0.72rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Keluhan</div>
                <div style="font-size:0.875rem; color:#334155; margin-top:4px; line-height:1.6; background:#f8fafc; padding:10px 14px; border-radius:8px; border:1px solid #e2e8f0;">{{ $treatment->keluhan }}</div>
            </div>
            <div>
                <div style="font-size:0.72rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Diagnosa</div>
                <div style="font-size:0.875rem; color:#334155; margin-top:4px; line-height:1.6; background:#f8fafc; padding:10px 14px; border-radius:8px; border:1px solid #e2e8f0;">{{ $treatment->diagnosa ?? 'Tidak ada diagnosa' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Obat yang Diberikan -->
<div class="card" style="padding:24px; margin-top:22px;">
    <h2 style="font-size:0.85rem; font-weight:700; color:#1d4ed8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:16px;">
        <span style="display:inline-flex; align-items:center; gap:6px;">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            Obat yang Diberikan
        </span>
    </h2>
    @if($treatment->medicines->count() > 0)
    <table class="table-modern">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($treatment->medicines as $i => $med)
            <tr>
                <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                <td style="font-weight:600; color:#1e293b;">{{ $med->nama_obat }}</td>
                <td><span class="badge badge-green">{{ $med->pivot->quantity }}</span></td>
                <td style="color:#64748b;">{{ $med->satuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div style="text-align:center; padding:32px; color:#94a3b8; font-style:italic;">
        Tidak ada obat yang diberikan pada kunjungan ini.
    </div>
    @endif
</div>
</x-app-layout>

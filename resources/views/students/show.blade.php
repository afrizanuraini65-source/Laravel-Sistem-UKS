<x-app-layout>
<x-slot name="header">Riwayat Kesehatan Siswa</x-slot>

<div style="margin-bottom:22px;">
    <a href="{{ route('students.index') }}" style="font-size:0.8rem; color:#3b82f6; text-decoration:none; display:inline-flex; align-items:center; gap:4px; margin-bottom:8px;">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Siswa
    </a>
    <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Profil Kesehatan Siswa</h1>
</div>

<div style="display:grid; grid-template-columns: 300px 1fr; gap:22px;">
    <!-- Sidebar Profil -->
    <div style="display:flex; flex-direction:column; gap:22px;">
        <div class="card" style="padding:24px; text-align:center;">
            <div style="width:80px; height:80px; background:linear-gradient(135deg, #1d4ed8, #60a5fa); border-radius:50%; margin:0 auto 16px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.75rem; font-weight:800;">
                {{ strtoupper(substr($student->nama, 0, 1)) }}
            </div>
            <h2 style="font-size:1.1rem; font-weight:700; color:#0f172a; margin-bottom:4px;">{{ $student->nama }}</h2>
            <p style="font-size:0.85rem; color:#64748b; font-weight:500;">{{ $student->nis }}</p>
            <div style="margin-top:16px;">
                <span class="badge badge-blue" style="font-size:0.8rem; padding:5px 15px;">{{ $student->kelas->nama_kelas ?? '-' }}</span>
            </div>
        </div>

        <div class="card" style="padding:20px;">
            <h3 style="font-size:0.75rem; font-weight:700; color:#1d4ed8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:12px;">Informasi Dasar</h3>
            <div style="display:grid; gap:12px;">
                <div>
                    <div style="font-size:0.7rem; color:#94a3b8; font-weight:600;">JENIS KELAMIN</div>
                    <div style="font-size:0.875rem; color:#334155; font-weight:500;">{{ $student->jk === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                </div>
                <div>
                    <div style="font-size:0.7rem; color:#94a3b8; font-weight:600;">TOTAL KUNJUNGAN</div>
                    <div style="font-size:0.875rem; color:#334155; font-weight:500;">{{ $student->treatments->count() }} Kali</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Kunjungan -->
    <div class="card" style="padding:24px;">
        <h3 style="font-size:0.95rem; font-weight:700; color:#0f172a; margin-bottom:20px;">Riwayat Kunjungan UKS</h3>
        
        @forelse($student->treatments as $t)
            <div style="border-left:3px solid #3b82f6; padding-left:20px; margin-bottom:30px; position:relative;">
                <div style="position:absolute; left:-7px; top:0; width:11px; height:11px; border-radius:50%; background:#3b82f6; border:2px solid #fff;"></div>
                
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:8px;">
                    <div style="font-size:0.85rem; font-weight:700; color:#1e293b;">
                        {{ \Carbon\Carbon::parse($t->tanggal_kunjungan)->format('d F Y') }}
                    </div>
                    <a href="{{ route('treatments.show', $t) }}" style="font-size:0.75rem; color:#3b82f6; text-decoration:none; font-weight:600;">Lihat Detail →</a>
                </div>

                <div style="background:#f8fafc; border-radius:10px; padding:15px; border:1px solid #e2e8f0;">
                    <div style="margin-bottom:8px;">
                        <span style="font-size:0.7rem; font-weight:700; color:#94a3b8; text-transform:uppercase;">Keluhan:</span>
                        <p style="font-size:0.875rem; color:#334155; margin-top:2px;">{{ $t->keluhan }}</p>
                    </div>
                    @if($t->diagnosa)
                    <div style="margin-bottom:8px;">
                        <span style="font-size:0.7rem; font-weight:700; color:#94a3b8; text-transform:uppercase;">Diagnosa:</span>
                        <p style="font-size:0.875rem; color:#334155; margin-top:2px;">{{ $t->diagnosa }}</p>
                    </div>
                    @endif
                    @if($t->medicines->count() > 0)
                    <div>
                        <span style="font-size:0.7rem; font-weight:700; color:#94a3b8; text-transform:uppercase;">Obat:</span>
                        <div style="display:flex; flex-wrap:wrap; gap:5px; margin-top:4px;">
                            @foreach($t->medicines as $med)
                                <span class="badge badge-green">{{ $med->nama_obat }} ({{ $med->pivot->quantity }})</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div style="text-align:center; padding:40px; color:#94a3b8;">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="48" height="48" style="margin-bottom:12px; opacity:0.3;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <p>Belum ada riwayat kunjungan untuk siswa ini.</p>
            </div>
        @endforelse
    </div>
</div>
</x-app-layout>

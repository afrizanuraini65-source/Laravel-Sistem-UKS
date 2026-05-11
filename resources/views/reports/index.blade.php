<x-app-layout>
<x-slot name="header">Laporan Bulanan</x-slot>

<!-- Laporan Kunjungan Bulanan -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:22px;">
    <div>
        <h1 style="font-size:1.25rem; font-weight:800; color:#0f172a;">Laporan Kunjungan UKS</h1>
        <p style="font-size:0.8rem; color:#64748b; margin-top:2px;">Rekapitulasi kunjungan siswa per bulan</p>
    </div>
    <button onclick="window.print()" class="btn btn-primary no-print">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
        Cetak Laporan
    </button>
</div>

<style>
    @media print {
        .no-print, .sidebar, .topbar { display: none !important; }
        .main-content { margin-left: 0 !important; }
        .page-inner { padding: 0 !important; }
        .card { box-shadow: none !important; border: 1px solid #eee !important; }
        body { background: #fff !important; }
    }
</style>

<!-- Filter -->
<div class="card" style="padding:20px; margin-bottom:22px;">
    <form method="GET" action="{{ route('reports.index') }}" style="display:flex; gap:16px; align-items:flex-end; flex-wrap:wrap;">
        <div>
            <label class="form-label">Bulan</label>
            <select name="month" class="form-control" style="width:160px;">
                @php
                    $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                @endphp
                @foreach($months as $i => $m)
                    <option value="{{ $i+1 }}" {{ $month == $i+1 ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label">Tahun</label>
            <select name="year" class="form-control" style="width:120px;">
                @for($y = date('Y'); $y >= date('Y')-3; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            Filter
        </button>
    </form>
</div>

<!-- Chart -->
<div class="card" style="padding:24px; margin-bottom:22px;">
    <h2 style="font-size:0.95rem; font-weight:700; color:#0f172a; margin-bottom:16px;">Grafik Kunjungan Tahun {{ $year }}</h2>
    <div style="height:280px; position:relative;">
        <canvas id="reportChart"></canvas>
    </div>
</div>

<!-- Rekap Table -->
<div class="card" style="padding:24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h2 style="font-size:0.95rem; font-weight:700; color:#0f172a;">
            Detail Kunjungan — {{ ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'][$month-1] }} {{ $year }}
        </h2>
        <span class="badge badge-blue" style="font-size:0.8rem; padding:5px 14px;">{{ $recapData->count() }} Kunjungan</span>
    </div>

    <table class="table-modern">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>JK</th>
                <th>Keluhan</th>
                <th>Diagnosa</th>
                <th>Obat Diberikan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recapData as $i => $t)
            <tr>
                <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($t->tanggal_kunjungan)->format('d M Y') }}</td>
                <td style="font-weight:600; color:#1e293b;">{{ $t->student->nama }}</td>
                <td><span class="badge badge-blue">{{ $t->student->kelas->nama_kelas ?? '-' }}</span></td>
                <td>
                    <span class="badge {{ $t->student->jk === 'L' ? 'badge-blue' : '' }}" style="{{ $t->student->jk === 'P' ? 'background:#fce7f3; color:#9d174d;' : '' }}">
                        {{ $t->student->jk === 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </td>
                <td style="color:#475569; max-width:200px;">{{ Str::limit($t->keluhan, 35) }}</td>
                <td style="color:#475569;">{{ Str::limit($t->diagnosa ?? '-', 35) }}</td>
                <td>
                    @foreach($t->medicines as $med)
                        <span class="badge badge-green" style="margin:1px;">{{ $med->nama_obat }} ({{ $med->pivot->quantity }})</span>
                    @endforeach
                    @if($t->medicines->isEmpty()) <span style="color:#94a3b8;">-</span> @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; color:#94a3b8; padding:40px;">Tidak ada data kunjungan untuk bulan ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('reportChart').getContext('2d');
        var chartData = @json($chartData);
        var currentMonth = {{ $month }};

        var colors = chartData.map((_, i) =>
            (i + 1) === currentMonth ? 'rgba(29, 78, 216, 0.9)' : 'rgba(147, 197, 253, 0.5)'
        );
        var borders = chartData.map((_, i) =>
            (i + 1) === currentMonth ? 'rgb(29, 78, 216)' : 'rgb(147, 197, 253)'
        );

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: chartData,
                    backgroundColor: colors,
                    borderColor: borders,
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.raw} Kunjungan`
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { stepSize: 1 } }
                }
            }
        });
    });
</script>
</x-app-layout>

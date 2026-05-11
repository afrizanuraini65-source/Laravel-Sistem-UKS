<x-app-layout>
<x-slot name="header">Dashboard</x-slot>

<!-- Dashboard -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <!-- Stat 1 -->
    <div class="card stat-card" style="border-left: 4px solid #3b82f6;">
        <div class="stat-icon" style="background: #dbeafe;">
            <svg fill="none" viewBox="0 0 24 24" stroke="#1d4ed8" width="24" height="24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <div>
            <div class="stat-value">{{ $totalStudents }}</div>
            <div class="stat-label">Total Siswa Terdaftar</div>
        </div>
    </div>

    <a href="{{ route('medicines.index', ['search' => '']) }}" class="card stat-card" style="border-left: 4px solid #f59e0b; text-decoration:none;">
        <div class="stat-icon" style="background: #fef3c7;">
            <svg fill="none" viewBox="0 0 24 24" stroke="#d97706" width="24" height="24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <div>
            <div class="stat-value" style="color: #d97706;">{{ $medicinesOutOfStock }}</div>
            <div class="stat-label">Obat Stok Menipis (&le;5)</div>
        </div>
    </a>

    <!-- Stat 3 -->
    <div class="card stat-card" style="border-left: 4px solid #22c55e;">
        <div class="stat-icon" style="background: #dcfce7;">
            <svg fill="none" viewBox="0 0 24 24" stroke="#16a34a" width="24" height="24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <div>
            <div class="stat-value" style="color: #16a34a;">{{ $visitsThisMonth }}</div>
            <div class="stat-label">Kunjungan Bulan Ini</div>
        </div>
    </div>
</div>

<!-- Chart Card -->
<div class="card" style="padding: 24px; margin-bottom: 24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <h2 style="font-size:1rem; font-weight:700; color:#0f172a;">Grafik Kunjungan Bulanan {{ date('Y') }}</h2>
            <p style="font-size:0.78rem; color:#64748b; margin-top:2px;">Rekap kunjungan UKS sepanjang tahun</p>
        </div>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">
            Lihat Laporan Lengkap →
        </a>
    </div>
    <div style="height: 300px; position:relative;">
        <canvas id="visitsChart"></canvas>
    </div>
</div>

<!-- Recent Treatments -->
<div class="card" style="padding: 24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="font-size:1rem; font-weight:700; color:#0f172a;">Kunjungan Terakhir</h2>
        <a href="{{ route('treatments.create') }}" class="btn btn-primary btn-sm">
            + Input Kunjungan
        </a>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Keluhan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($latestTreatments as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->tanggal_kunjungan)->format('d M Y') }}</td>
                <td style="font-weight:600;">{{ $t->student->nama }}</td>
                <td><span class="badge badge-blue">{{ $t->student->kelas->nama_kelas ?? '-' }}</span></td>
                <td style="color:#64748b;">{{ Str::limit($t->keluhan, 40) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#94a3b8; padding: 32px;">Belum ada data kunjungan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('visitsChart').getContext('2d');
        var chartData = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: chartData,
                    backgroundColor: 'rgba(59, 130, 246, 0.15)',
                    borderColor: 'rgb(29, 78, 216)',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                    hoverBackgroundColor: 'rgba(29, 78, 216, 0.4)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    });
</script>
</x-app-layout>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>UKS SMKN 1 Purwokerto - {{ config('app.name', 'DigmaUKS') }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { font-family: 'Inter', sans-serif; }
            body { background-color: #f0f4ff; }

            /* Sidebar */
            .sidebar {
                background: linear-gradient(160deg, #1e3a8a 0%, #1d4ed8 60%, #2563eb 100%);
                min-height: 100vh;
                position: fixed;
                top: 0; left: 0;
                width: 240px;
                z-index: 100;
                display: flex;
                flex-direction: column;
                box-shadow: 4px 0 20px rgba(29,78,216,0.25);
                transition: transform 0.3s ease;
            }
            .sidebar-logo {
                padding: 24px 20px 16px;
                border-bottom: 1px solid rgba(255,255,255,0.15);
            }
            .sidebar-logo h1 { color: #fff; font-size: 1.2rem; font-weight: 800; letter-spacing: -0.02em; }
            .sidebar-logo p { color: rgba(255,255,255,0.6); font-size: 0.7rem; font-weight: 400; margin-top: 2px; }
            .sidebar-logo .logo-icon {
                width: 40px; height: 40px;
                background: rgba(255,255,255,0.15);
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                margin-bottom: 10px;
            }
            .sidebar-nav { padding: 16px 0; flex: 1; }
            .nav-section-title {
                color: rgba(255,255,255,0.45);
                font-size: 0.65rem;
                font-weight: 700;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                padding: 8px 20px 4px;
            }
            .nav-item {
                display: flex; align-items: center; gap: 10px;
                padding: 10px 20px;
                color: rgba(255,255,255,0.75);
                font-size: 0.875rem; font-weight: 500;
                border-radius: 0;
                transition: all 0.2s ease;
                text-decoration: none;
                margin: 2px 8px;
                border-radius: 8px;
            }
            .nav-item:hover {
                background: rgba(255,255,255,0.12);
                color: #fff;
            }
            .nav-item.active {
                background: rgba(255,255,255,0.2);
                color: #fff;
                font-weight: 600;
                box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            }
            .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

            /* Main content */
            .main-content {
                margin-left: 240px;
                min-height: 100vh;
                display: flex; flex-direction: column;
            }
            /* Top bar */
            .topbar {
                background: #fff;
                height: 64px;
                display: flex; align-items: center; justify-content: space-between;
                padding: 0 28px;
                border-bottom: 1px solid #e2e8f0;
                box-shadow: 0 1px 4px rgba(0,0,0,0.05);
                position: sticky; top: 0; z-index: 50;
            }
            .topbar-title { font-size: 1rem; font-weight: 600; color: #1e293b; }
            .topbar-role {
                background: #eff6ff; color: #1d4ed8;
                padding: 4px 12px; border-radius: 99px;
                font-size: 0.72rem; font-weight: 600;
            }
            .user-avatar {
                width: 36px; height: 36px;
                background: linear-gradient(135deg, #1d4ed8, #60a5fa);
                border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                color: #fff; font-weight: 700; font-size: 0.875rem;
            }
            /* Page inner */
            .page-inner { padding: 28px; flex: 1; }

            /* Cards */
            .card {
                background: #fff;
                border-radius: 14px;
                box-shadow: 0 2px 12px rgba(29,78,216,0.07);
                border: 1px solid rgba(29,78,216,0.07);
            }
            .stat-card {
                border-radius: 14px; padding: 20px 22px;
                display: flex; align-items: center; gap: 16px;
            }
            .stat-icon {
                width: 50px; height: 50px; border-radius: 12px;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
            }
            .stat-value { font-size: 1.75rem; font-weight: 800; color: #0f172a; line-height: 1; }
            .stat-label { font-size: 0.78rem; color: #64748b; font-weight: 500; margin-top: 4px; }

            /* Alert */
            .alert-success {
                background: #f0fdf4; border-left: 4px solid #22c55e;
                color: #15803d; padding: 14px 18px; border-radius: 8px;
                margin-bottom: 20px; font-size: 0.875rem;
            }
            .alert-error {
                background: #fff1f2; border-left: 4px solid #ef4444;
                color: #b91c1c; padding: 14px 18px; border-radius: 8px;
                margin-bottom: 20px; font-size: 0.875rem;
            }

            /* Table */
            .table-modern { width: 100%; border-collapse: collapse; }
            .table-modern thead th {
                background: #eff6ff; color: #1d4ed8;
                font-size: 0.7rem; font-weight: 700;
                text-transform: uppercase; letter-spacing: 0.07em;
                padding: 12px 18px; text-align: left;
            }
            .table-modern thead th:first-child { border-radius: 8px 0 0 8px; }
            .table-modern thead th:last-child { border-radius: 0 8px 8px 0; }
            .table-modern tbody td {
                padding: 13px 18px; font-size: 0.875rem;
                border-bottom: 1px solid #f1f5f9; color: #374151;
            }
            .table-modern tbody tr:last-child td { border-bottom: none; }
            .table-modern tbody tr:hover { background: #f8faff; }

            /* Badges */
            .badge { padding: 3px 10px; border-radius: 99px; font-size: 0.7rem; font-weight: 600; }
            .badge-blue { background: #dbeafe; color: #1d4ed8; }
            .badge-green { background: #dcfce7; color: #16a34a; }
            .badge-red { background: #fee2e2; color: #dc2626; }
            .badge-orange { background: #fed7aa; color: #c2410c; }

            /* Buttons */
            .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s; border: none; text-decoration: none; }
            .btn-primary { background: #1d4ed8; color: #fff; }
            .btn-primary:hover { background: #1e40af; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(29,78,216,0.35); color: #fff; }
            .btn-secondary { background: #f1f5f9; color: #334155; }
            .btn-secondary:hover { background: #e2e8f0; color: #334155; }
            .btn-danger { background: #fee2e2; color: #dc2626; }
            .btn-danger:hover { background: #fecaca; color: #b91c1c; }
            .btn-sm { padding: 6px 12px; font-size: 0.78rem; }

            /* Form inputs */
            .form-control {
                width: 100%; padding: 10px 14px;
                border: 1.5px solid #e2e8f0; border-radius: 8px;
                font-size: 0.875rem; color: #1e293b;
                transition: border-color 0.2s, box-shadow 0.2s;
                background: #fff; outline: none;
            }
            .form-control:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
            }
            .form-label { display: block; font-size: 0.8rem; font-weight: 600; color: #374151; margin-bottom: 6px; }
            .form-error { color: #dc2626; font-size: 0.75rem; margin-top: 4px; }
            .form-group { margin-bottom: 18px; }

            /* Sidebar footer */
            .sidebar-footer {
                padding: 16px 20px;
                border-top: 1px solid rgba(255,255,255,0.12);
            }
            .logout-btn {
                display: flex; align-items: center; gap: 8px;
                width: 100%; padding: 9px 12px; border-radius: 8px;
                background: rgba(255,255,255,0.08);
                color: rgba(255,255,255,0.7); font-size: 0.8rem; font-weight: 500;
                border: none; cursor: pointer; transition: all 0.2s;
            }
            .logout-btn:hover { background: rgba(255,255,255,0.15); color: #fff; }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="white" width="22" height="22">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h1>DigmaUKS</h1>
                <p>SMKN 1 Purwokerto</p>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section-title">Menu Utama</div>

                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('treatments.index') }}" class="nav-item {{ request()->routeIs('treatments.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Kunjungan UKS
                </a>

                <a href="{{ route('medicines.index') }}" class="nav-item {{ request()->routeIs('medicines.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Data Obat
                </a>

                @if(Auth::user()->role === 'admin')
                <div class="nav-section-title" style="margin-top:10px;">Admin</div>

                <a href="{{ route('students.index') }}" class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Data Siswa
                </a>

                <a href="{{ route('kelas.index') }}" class="nav-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Data Kelas
                </a>

                <a href="{{ route('reports.index') }}" class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Laporan Bulanan
                </a>
                @endif
            </nav>

            <div class="sidebar-footer">
                <div style="font-size:0.75rem; color:rgba(255,255,255,0.5); margin-bottom:6px;">
                    Login sebagai <span style="color:#93c5fd; font-weight:600;">{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-title">
                    @isset($header){{ $header }}@endisset
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <span class="topbar-role">{{ Auth::user()->role === 'admin' ? '👑 Admin / Pembina' : '🩺 Petugas PMR' }}</span>
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="page-inner">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ $title ?? 'Dashboard' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Bootstrap JS (WAJIB untuk modal, dropdown, dll) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('styles')

    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
        }

        body {
            background-color: #f3f4f6;
            color: #111827;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #e5e7eb;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-right: 2px solid #d1d5db;
            flex-shrink: 0; /* Penting agar tidak menyusut */
        }

        .sidebar-header {
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .logo {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .menu-title {
            padding: 0 20px;
            color: #4b5563;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .menu-item {
            padding: 12px 20px;
            margin: 0 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #4b5563;
            text-decoration: none;
            font-size: 15px;
        }

        .menu-item:hover,
        .menu-item.active {
            background: #ffffff;
            color: #111827;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .logout-btn {
            margin-top: auto;
            padding: 12px 20px;
            margin: 0 10px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #dc2626;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f9fafb;
        }

        .header-bar {
            background: #1e40af;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            font-size: 22px;
            font-weight: 600;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-box {
            background: white;
            color: #1e40af;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Responsif: Sembunyikan sidebar di mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar .logo + div,
            .sidebar .menu-title,
            .sidebar .menu-item span,
            .sidebar .logout-btn span {
                display: none;
            }
            .menu-item, .logout-btn {
                justify-content: center;
                padding: 15px 0;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">F</div>
            <div>FAN SISTEM</div>
        </div>

        <div class="menu-title">MENU</div>

        <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
            </svg>
            <span>Dashboard</span>
        </a>

        @can('create arsip-surat')
        <a href="/arsip-surat" class="menu-item {{ request()->is('arsip-surat*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 6h-8l-2-2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6 10H6v-2h8v2zm0-4H6v-2h8v2z"/>
            </svg>
            <span>Arsip Surat</span>
        </a>
        @endcan

        @can('create surat-keluar')
        <a href="/surat-keluar" class="menu-item {{ request()->is('surat-keluar*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span>Surat Keluar</span>
        </a>
        @endcan

        @can('manage karyawan')
        <a href="/karyawan" class="menu-item {{ request()->is('karyawan*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
            <span>Manajemen Karyawan</span>
        </a>
        @endcan


        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="logout-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8l-1.41 1.41L13 7V13c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1h-6zM3 18h18v-2H3v2zm0-4h18v-2H3v2zm0-4h18V8H3v2z"/>
            </svg>
            <span>LOG-OUT</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="header-bar">
            <div class="header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
                {{ $title ?? 'DASHBOARD' }}
            </div>
            <div class="date-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 11h2v2H7zm14-5h-4V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2H3a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V7a2 2 0 00-2-2zM5 7h14v12H5V7z"/>
                </svg>
                {{ \Carbon\Carbon::now()->format('l, d-m-Y') }}
            </div>
        </div>

        @yield('content')
    </div>


    <!-- Stack untuk script halaman spesifik -->
    @stack('scripts')
</body>
</html>
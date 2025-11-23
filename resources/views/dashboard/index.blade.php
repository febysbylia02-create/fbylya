    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Custom css --> 
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    </head>
    <body>

        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">F</div>
                <div style="font-weight: 600;">ARSIP SISTEM</div>
            </div>

            <div class="menu-title">MENU</div>

            <a href="/dashboard" class="menu-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
                Dashboard
            </a>

             <a href="/surat-keluar" class="menu-item {{ request()->is('surat-keluar*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span>Surat Keluar</span>
        </a>

        <a href="/arsip-surat" class="menu-item {{ request()->is('arsip-surat*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 6h-8l-2-2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6 10H6v-2h8v2zm0-4H6v-2h8v2z"/>
            </svg>
            <span>Arsip Surat</span>
        </a>
            

            <a href="{{ route('logout') }}" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="logout-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8l-1.41 1.41L13 7V13c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1h-6zM3 18h18v-2H3v2zm0-4h18v-2H3v2zm0-4h18V8H3v2z"/>
                </svg>
                LOG-OUT
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
                    DASHBOARD
                </div>
                <div class="date-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 11h2v2H7zm14-5h-4V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2H3a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V7a2 2 0 00-2-2zM5 7h14v12H5V7z"/>
                    </svg>
                    Kamis-02-2025
                </div>
            </div>

            <div class="welcome-banner">
                <div class="welcome-text">
                    <div class="welcome-title">Selamat Datang {{ Auth::user()->name }}!</div>
                    <div class="welcome-subtitle">Anda Masuk Sebagai Admin</div>
                </div>
                <div class="welcome-icon">👁️</div>
            </div>
            <div class="card-grid">
                <a href="{{ route('surat-keluar.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-blue">
                        <div class="card-title">Surat Keluar</div>
                        <div class="card-value">{{ $suratKeluarCount }}</div>
                        <div class="card-icon">✉️</div>
                    </div>
                </a>
                <a href="{{ route('arsip-surat.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-yellow">
                        <div class="card-title">Arsip</div>
                        <div class="card-value">{{ $arsipSuratCount }}</div>
                        <div class="card-icon">✉️</div>
                    </div>
                </a>
            </div>

    </body>
    </html>
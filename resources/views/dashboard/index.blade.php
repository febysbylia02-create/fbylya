@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    <div class="welcome-banner">
        <div class="welcome-text">
            <div class="welcome-title">Selamat Datang {{ Auth::user()->name }}!</div>
            <div class="welcome-subtitle">Anda Masuk Sebagai {{ Auth::user()->getRoleNames()->first() }}</div>
        </div>
        <div class="welcome-icon"></div>
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
@endsection
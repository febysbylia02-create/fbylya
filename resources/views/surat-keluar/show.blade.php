@extends('layouts.admin')

@section('title', 'Detail Surat Keluar')

@push('styles')
<style>
    .detail-label {
        font-weight: 600;
        color: #4b5563;
    }
    .detail-value {
        background-color: #f9fafb;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Detail Surat Keluar</h4>
        <div>
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('surat-keluar.edit', $suratKeluar) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Nomor Urut</div>
                <div class="col-md-9 detail-value">{{ $suratKeluar->nomor_urut }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Nomor Berkas</div>
                <div class="col-md-9 detail-value">{{ $suratKeluar->nomor_berkas }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Alamat Penerima</div>
                <div class="col-md-9 detail-value" style="white-space: pre-wrap;">{{ $suratKeluar->alamat_penerima }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Tanggal Surat</div>
                <div class="col-md-9 detail-value">{{ \Carbon\Carbon::parse($suratKeluar->tanggal_surat)->format('d F Y') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Perihal</div>
                <div class="col-md-9 detail-value" style="white-space: pre-wrap;">{{ $suratKeluar->perihal }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Nomor Petunjuk</div>
                <div class="col-md-9 detail-value">{{ $suratKeluar->nomor_petunjuk ?? '—' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Nomor Paket</div>
                <div class="col-md-9 detail-value">{{ $suratKeluar->nomor_paket ?? '—' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 detail-label">Arsip Surat</div>
                <div class="col-md-9 detail-value">
                    @if($suratKeluar->arsipSurat)
                        <a href="{{ route('arsip-surat.download', $suratKeluar->arsipSurat) }}">
                            {{ $suratKeluar->arsipSurat->file_path }}
                        </a>
                    @else
                        Tidak ada arsip terkait.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
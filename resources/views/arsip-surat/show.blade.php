@extends('layouts.admin')

@section('title', 'Detail Arsip Surat')

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
            <h4 class="mb-0">Detail Arsip Surat</h4>
            <div>
                <a href="{{ route('arsip-surat.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('arsip-surat.edit', $arsipSurat) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 detail-label">Tanggal Arsip</div>
                    <div class="col-md-9 detail-value">
                        {{ \Carbon\Carbon::parse($arsipSurat->tanggal_arsip)->format('d F Y') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 detail-label">Nama File</div>
                    <div class="col-md-9 detail-value">
                        @if($arsipSurat->file_path)
                            {{ basename($arsipSurat->file_path) }}
                        @else
                            <span class="text-muted">Tidak ada file</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 detail-label">Catatan</div>
                    <div class="col-md-9 detail-value" style="white-space: pre-wrap;">{{ $arsipSurat->catatan ?? '—' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 detail-label">File Surat</div>
                    <div class="col-md-9 detail-value">
                        @if($arsipSurat->file_path)
                            <a href="{{ asset('storage/' . $arsipSurat->file_path) }}" target="_blank"
                                class="text-decoration-none">
                                <i class="fas fa-file-pdf me-1"></i> Lihat File
                            </a>
                        @else
                            <span class="text-muted">Tidak ada file lampiran.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
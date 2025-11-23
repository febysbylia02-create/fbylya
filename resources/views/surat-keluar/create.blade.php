@extends('layouts.admin')

@section('title', 'Tambah Surat Keluar')

@push('styles')
<style>
    .form-label {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 8px;
        display: block;
    }

    .form-control,
    .form-select,
    textarea.form-control {
        padding: 12px 15px;
        margin-bottom: 18px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        transition: border-color 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus,
    textarea.form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .btn {
        padding: 10px 20px;
        font-size: 15px;
        border-radius: 8px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Tambah Surat Keluar</h4>
        <div>
            <a href="{{ route('arsip-surat.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                <i class="fas fa-archive"></i> Lihat Arsip Surat
            </a>
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('surat-keluar.store') }}" method="POST">
                @csrf

                <!-- Nomor Unit & Nomor Berkas -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nomor_urut" class="form-label">Nomor Urut</label>
                        <input type="text"
                               name="nomor_urut"
                               id="nomor_urut"
                               class="form-control"
                               value="{{ old('nomor_urut', $suratKeluarCount + 1) }}"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_berkas" class="form-label">Nomor Berkas</label>
                        <input type="text"
                               name="nomor_berkas"
                               id="nomor_berkas"
                               class="form-control"
                               placeholder="Contoh: 005/678.1"
                               value="{{ old('nomor_berkas') }}"
                               required>
                    </div>
                </div>

                <!-- Alamat Penerima -->
                <div class="mb-3">
                    <label for="alamat_penerima" class="form-label">Alamat Penerima</label>
                    <textarea name="alamat_penerima"
                              id="alamat_penerima"
                              class="form-control"
                              rows="3"
                              required>{{ old('alamat_penerima') }}</textarea>
                </div>

                <!-- Tanggal Surat -->
                <div class="mb-3">
                    <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                    <input type="date"
                           name="tanggal_surat"
                           id="tanggal_surat"
                           class="form-control"
                           value="{{ old('tanggal_surat', now()->format('Y-m-d')) }}"
                           required>
                </div>

                <!-- Perihal -->
                <div class="mb-3">
                    <label for="perihal" class="form-label">Perihal</label>
                    <textarea name="perihal"
                              id="perihal"
                              class="form-control"
                              rows="3"
                              required>{{ old('perihal') }}</textarea>
                </div>

                <!-- Nomor Petunjuk & Nomor Paket -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nomor_petunjuk" class="form-label">Nomor Petunjuk (Opsional)</label>
                        <input type="text"
                               name="nomor_petunjuk"
                               id="nomor_petunjuk"
                               class="form-control"
                               placeholder=""
                               value="{{ old('nomor_petunjuk') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_paket" class="form-label">Nomor Paket (Opsional)</label>
                        <input type="text"
                               name="nomor_paket"
                               id="nomor_paket"
                               class="form-control"
                               placeholder=""
                               value="{{ old('nomor_paket') }}">
                    </div>
                </div>

                <!-- Arsip Surat Dropdown -->
                <div class="mb-3">
                    <label for="arsip_surat_id" class="form-label">Arsip Surat</label>
                    <select name="arsip_surat_id" id="arsip_surat_id" class="form-select" required>
                        <option value="">Pilih Arsip Surat</option>
                        @forelse($arsipSurats as $arsip)
                            <option value="{{ $arsip->id }}">{{ $arsip->file_path }} ({{ $arsip->tanggal_arsip }})</option>
                        @empty
                            <option value="" disabled>Tidak ada arsip surat tersedia</option>
                        @endforelse
                    </select>
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
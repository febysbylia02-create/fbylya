@extends('layouts.admin')

@section('title', 'Daftar Arsip Surat')

@push('styles')
<style>
    /* Modal preview styling */
    #previewFrame {
        border: none;
        width: 100%;
        height: 60vh;
    }

    #loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 60vh;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Arsip Surat</h4>
        <a href="{{ route('arsip-surat.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Arsipkan File
        </a>
    </div>

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('arsip-surat.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama file atau catatan..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('arsip-surat.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </div>
    </form>

    @if(session('success'))
    <div id="success-alert" class="alert alert-success d-flex align-items-center justify-content-between py-2 px-3 mb-3" style="background-color: #d4edda; border: none; border-radius: 6px; font-size: 0.9rem;">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem;"></button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.remove();
                }
            }, 3000); // 3 detik
        });
    </script>
    @endif

    @if($archives->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <p class="mb-0">Belum ada arsip surat.</p>
            </div>
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Arsip</th>
                                <th>Nama File</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($archives as $arsip)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d/m/Y') }}</td>
                                <td>
                                    @if($arsip->file_path)
                                        @php
                                            $fileName = basename($arsip->file_path);
                                            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                        @endphp

                                        @switch($fileExtension)
                                            @case('pdf')
                                                <i class="fas fa-file-pdf text-danger me-2" title="File PDF"></i>
                                                @break
                                            @case('doc')
                                            @case('docx')
                                                <i class="fas fa-file-word text-primary me-2" title="File Word"></i>
                                                @break
                                            @case('xls')
                                            @case('xlsx')
                                                <i class="fas fa-file-excel text-success me-2" title="File Excel"></i>
                                                @break
                                            @case('ppt')
                                            @case('pptx')
                                                <i class="fas fa-file-powerpoint text-warning me-2" title="File PowerPoint"></i>
                                                @break
                                            @case('txt')
                                                <i class="fas fa-file-alt text-secondary me-2" title="File Teks"></i>
                                                @break
                                            @default
                                                <i class="fas fa-file text-muted me-2" title="File Umum"></i>
                                        @endswitch

                                        {{ $fileName }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ $arsip->catatan ?? '—' }}</td>
                                <td>
                                    @if($arsip->file_path)
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Lihat"
                                                data-bs-toggle="modal"
                                                data-bs-target="#fileModal"
                                                data-file-url="{{ asset('storage/' . $arsip->file_path) }}"
                                                data-file-name="{{ basename($arsip->file_path) }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ asset('storage/' . $arsip->file_path) }}" download class="btn btn-sm btn-outline-success" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif

                                    @can('delete arsip-surat')
                                    <form action="{{ route('arsip-surat.destroy', $arsip) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus arsip ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $archives->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Modal Preview Dokumen -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">Preview Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat dokumen...</p>
                </div>

                <!-- Bungkus iframe dengan div container yang bisa digulir -->
                <div id="previewContainer" style="height: 80vh; overflow-y: auto; border: none; background: #fff;">
                    <iframe id="previewFrame" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>

                <div id="error" style="display: none;" class="text-center p-4">
                    <div class="alert alert-danger">
                        <!-- Pesan error akan diisi oleh JS -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Gunakan IIFE (Immediately Invoked Function Expression) untuk memastikan tidak ada konflik variabel global
(function() {
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('fileModal');
        if (!modal) return;

        const frame = document.getElementById('previewFrame');
        const loading = document.getElementById('loading');
        const error = document.getElementById('error');
        const errorAlert = document.querySelector('#error .alert');

        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const fileUrl = button.getAttribute('data-file-url');
            const fileName = button.getAttribute('data-file-name');
            const fileExtension = fileName.split('.').pop().toLowerCase();

            // Reset tampilan
            frame.style.display = 'none';
            loading.style.display = 'flex';
            error.style.display = 'none';
            frame.src = '';
            errorAlert.textContent = '';

            // Daftar tipe file yang bisa ditampilkan langsung di browser
            const inlineTypes = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp', 'txt'];

            const isInline = inlineTypes.includes(fileExtension);

            if (isInline) {
                frame.src = fileUrl;
                frame.onload = function () {
                    loading.style.display = 'none';
                    frame.style.display = 'block';
                };
                frame.onerror = function () {
                    loading.style.display = 'none';
                    error.style.display = 'block';
                    errorAlert.textContent = 'Gagal memuat pratinjau file ini.';
                };
            } else {
                loading.style.display = 'none';
                error.style.display = 'block';
                errorAlert.textContent = `Pratinjau tidak tersedia untuk file "${fileName}" (${fileExtension.toUpperCase()}). Silakan gunakan tombol download.`;
            }
        });

        modal.addEventListener('hidden.bs.modal', function () {
            frame.src = '';
        });
    });
})();
</script>
@endpush
@endsection
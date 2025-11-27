@extends('layouts.admin')

@section('title', 'Daftar Arsip Surat')



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
                                 <th>File</th>
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
                                        <a href="{{ asset('storage/' . $arsip->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary" title="Lihat File">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('arsip-surat.show', $arsip) }}" class="btn btn-sm btn-outline-info" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('delete arsip-surat')
                                    <form action="{{ route('arsip-surat.destroy', $arsip) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus arsip ini?')" title="Hapus">
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

@endsection
@extends('layouts.admin')

@section('title', 'Daftar Surat Keluar')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Surat Keluar</h4>
        <div>
            <a href="{{ route('arsip-surat.index') }}" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-archive"></i> Lihat Arsip Surat
            </a>
            <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Surat
            </a>
        </div>
    </div>

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('surat-keluar.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nomor berkas, alamat penerima, atau perihal..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('surat-keluar.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </div>
    </form>

    @if(session('success'))
    <div id="success-alert" class="alert alert-success d-flex align-items-center justify-content-between py-2 px-3 mb-3"
         style="background-color: #d4edda; border: none; border-radius: 6px; font-size: 0.9rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem;"></button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    if (alert && alert.parentNode) {
                        alert.remove();
                    }
                }, 3000);
            }
        });
    </script>
    @endif

    @if($letters->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <p class="mb-0">Belum ada surat keluar.</p>
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
                                <th>Nomor Berkas</th>
                                <th>Alamat Penerima</th>
                                <th>Tanggal</th>
                                <th>Perihal</th>
                                <th>Nomor Petunjuk</th>
                                <th>Nomor Paket</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($letters as $letter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $letter->nomor_berkas }}</td>
                                <td>{{ $letter->alamat_penerima }}</td>
                                <td>{{ \Carbon\Carbon::parse($letter->tanggal_surat)->format('d/m/Y') }}</td>
                                <td>{{ $letter->perihal }}</td>
                                <td>{{ $letter->nomor_petunjuk ?? '—' }}</td>
                                <td>{{ $letter->nomor_paket ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('surat-keluar.show', $letter) }}" class="btn btn-sm btn-outline-info" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('surat-keluar.edit', $letter) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('surat-keluar.destroy', $letter) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus surat ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $letters->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
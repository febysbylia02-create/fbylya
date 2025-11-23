<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\ArsipSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    /**
     * Menampilkan daftar surat keluar.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = SuratKeluar::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nomor_berkas', 'LIKE', "%{$search}%")
                  ->orWhere('alamat_penerima', 'LIKE', "%{$search}%")
                  ->orWhere('perihal', 'LIKE', "%{$search}%");
            });
        }

        $letters = $query->latest()->paginate(15);
        $letters->appends(['search' => $search]);

        $suratKeluarCount = SuratKeluar::count();
        $arsipSuratCount = ArsipSurat::count();

        return view('surat-keluar.index', compact('letters', 'suratKeluarCount', 'arsipSuratCount'));
    }

    /**
     * Menampilkan form untuk membuat surat keluar baru.
     */
    public function create()
    {
        $suratKeluarCount = SuratKeluar::count();
        $arsipSuratCount = ArsipSurat::count();
        $arsipSurats = ArsipSurat::all();

        return view('surat-keluar.create', compact('suratKeluarCount', 'arsipSuratCount', 'arsipSurats'));
    }

    /**
     * Menyimpan surat keluar baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_urut' => 'required|string|max:50',
            'nomor_berkas' => 'required|string|max:50',
            'alamat_penerima' => 'required|string',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string',
            'nomor_petunjuk' => 'nullable|string|max:50',
            'nomor_paket' => 'nullable|string|max:50',
            'arsip_surat_id' => 'required|exists:arsip_surat,id',
        ]);

        SuratKeluar::create($request->all());

        return redirect()->route('surat-keluar.index')
                         ->with('success', 'Surat keluar berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail surat keluar (read-only).
     */
    public function show(SuratKeluar $suratKeluar)
    {
        // Eager load the relationship to avoid N+1 issues
        $suratKeluar->load('arsipSurat');
        
        $suratKeluarCount = SuratKeluar::count();
        $arsipSuratCount = ArsipSurat::count();

        return view('surat-keluar.show', compact('suratKeluar', 'suratKeluarCount', 'arsipSuratCount'));
    }

    /**
     * Menampilkan form edit surat keluar.
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        $suratKeluarCount = SuratKeluar::count();
        $arsipSuratCount = ArsipSurat::count();
        $arsipSurats = ArsipSurat::all();

        return view('surat-keluar.edit', compact('suratKeluar', 'suratKeluarCount', 'arsipSuratCount', 'arsipSurats'));
    }

    /**
     * Memperbarui surat keluar.
     */
    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $validated = $request->validate([
            'nomor_urut' => 'required|string|max:50',
            'nomor_berkas' => 'required|string|max:50',
            'alamat_penerima' => 'required|string',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string',
            'nomor_petunjuk' => 'nullable|string|max:50',
            'nomor_paket' => 'nullable|string|max:50',
            'arsip_surat_id' => 'required|exists:arsip_surat,id',
        ]);

        $suratKeluar->update($validated);

        return redirect()->route('surat-keluar.index')
                         ->with('success', 'Surat keluar berhasil diperbarui!');
    }

    /**
     * Menghapus surat keluar.
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        // Hapus file jika ada
        if ($suratKeluar->file_path) {
            Storage::disk('public')->delete($suratKeluar->file_path);
        }
        
        $suratKeluar->delete();

        return redirect()->route('surat-keluar.index')
                         ->with('success', 'Surat keluar berhasil dihapus.');
    }
}
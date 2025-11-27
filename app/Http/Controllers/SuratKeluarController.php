<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
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
            $query->where(function ($q) use ($search) {
                $q->where('nomor_berkas', 'LIKE', "%{$search}%")
                    ->orWhere('alamat_penerima', 'LIKE', "%{$search}%")
                    ->orWhere('perihal', 'LIKE', "%{$search}%");
            });
        }

        $letters = $query->latest()->paginate(15);
        $letters->appends(['search' => $search]);

        $suratKeluarCount = SuratKeluar::count();

        return view('surat-keluar.index', compact('letters', 'suratKeluarCount'));
    }

    /**
     * Menampilkan form untuk membuat surat keluar baru.
     */
    public function create()
    {
        $suratKeluarCount = SuratKeluar::count();

        return view('surat-keluar.create', compact('suratKeluarCount'));
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
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // Max 10MB
        ]);

        $data = $request->all();

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat-keluar', $filename, 'public');
            $data['file_path'] = $path;
        }

        SuratKeluar::create($data);

        return redirect()->route('surat-keluar.index')
            ->with('success', 'Surat keluar berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail surat keluar (read-only).
     */
    public function show(SuratKeluar $suratKeluar)
    {
        $suratKeluarCount = SuratKeluar::count();

        return view('surat-keluar.show', compact('suratKeluar', 'suratKeluarCount'));
    }

    /**
     * Menampilkan form edit surat keluar.
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        $suratKeluarCount = SuratKeluar::count();

        return view('surat-keluar.edit', compact('suratKeluar', 'suratKeluarCount'));
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
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($suratKeluar->file_path) {
                Storage::disk('public')->delete($suratKeluar->file_path);
            }

            $file = $request->file('file_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat-keluar', $filename, 'public');
            $validated['file_path'] = $path;
        }

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
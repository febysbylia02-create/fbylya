<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = ArsipSurat::query();
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('file_path', 'LIKE', "%{$search}%")
                  ->orWhere('catatan', 'LIKE', "%{$search}%");
            });
        }
    
        $archives = $query->latest()->get();
    
        if ($request->wantsJson()) {
            return response()->json($archives);
        }
    
        $archives = $query->latest()->paginate(10); // atau sesuaikan jumlah per halaman
    
        return view('arsip-surat.index', compact('archives'));
    }

    public function create()
    {
        $suratKeluarCount = SuratKeluar::count();
        $arsipSuratCount = ArsipSurat::count(); // 🔥 Sesuai layout

        return view('arsip-surat.create', compact('suratKeluarCount', 'arsipSuratCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_arsip' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docx,txt|max:10240',
            'catatan' => 'nullable|string',
        ]);
    
        // Ambil nama file asli
        $originalName = $request->file('file')->getClientOriginalName();
    
        // Simpan file dengan nama asli
        $filePath = $request->file('file')->storeAs('arsip-surat', $originalName, 'public');
    
        ArsipSurat::create([
            'tanggal_arsip' => $request->tanggal_arsip,
            'file_path' => $filePath,
            'catatan' => $request->catatan,
        ]);
    
        return redirect()->route('arsip-surat.index')
                         ->with('success', 'File berhasil diarsipkan!');
    }

    public function show(ArsipSurat $arsipSurat)
    {
        $suratKeluarCount = SuratKeluar::count();
        $arsipSuratCount = ArsipSurat::count();
        return view('arsip-surat.show', compact('arsipSurat', 'suratKeluarCount', 'arsipSuratCount'));
    }

    public function edit(ArsipSurat $arsipSurat)
    {
        $suratKeluarCount = SuratKeluar::count();
        $arsipSuratCount = ArsipSurat::count(); // 🔥 Sesuai layout

        return view('arsip-surat.edit', compact('arsipSurat', 'suratKeluarCount', 'arsipSuratCount'));
    }

    public function update(Request $request, ArsipSurat $arsipSurat)
    {
        $request->validate([
            'tanggal_arsip' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $arsipSurat->update($request->only(['tanggal_arsip', 'catatan']));

        return redirect()->route('arsip-surat.index')
                         ->with('success', 'Arsip berhasil diperbarui!');
    }

    public function destroy(ArsipSurat $arsipSurat)
    {
        $arsipSurat->delete();

        return redirect()->route('arsip-surat.index')
                         ->with('success', 'Arsip berhasil dihapus!');
    }

    public function download(ArsipSurat $arsipSurat)
    {
        if (!$arsipSurat->file_path) {
            abort(404, 'File surat tidak ditemukan.');
        }

        $filePath = storage_path('app/public/' . $arsipSurat->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan di server.');
        }

        $fileName = basename($arsipSurat->file_path);

        return response()->download($filePath, $fileName);
    }
}
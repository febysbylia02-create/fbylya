<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\ArsipSurat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $suratKeluarCount = SuratKeluar::count();
            $arsipSuratCount = ArsipSurat::count();
        
            return view('dashboard.index', compact('suratKeluarCount', 'arsipSuratCount'))
                   ->with('title', 'Dashboard');
        } elseif ($user->hasRole('karyawan')) {
            $suratKeluarCount = SuratKeluar::count();
            $arsipSuratCount = ArsipSurat::count();
        
            return view('dashboard.index', compact('suratKeluarCount', 'arsipSuratCount'))
                   ->with('title', 'Dashboard');
        }

        return redirect()->route('login');
    }
}
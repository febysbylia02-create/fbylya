<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\KaryawanManagementController;

// Redirect root ke dashboard jika login, atau ke login jika belum
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Group route yang dilindungi autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Surat Keluar (CRUD)
    Route::resource('surat-keluar', SuratKeluarController::class)->names([
        'index' => 'surat-keluar.index',
        'create' => 'surat-keluar.create',
        'store' => 'surat-keluar.store',
        'show' => 'surat-keluar.show',
        'edit' => 'surat-keluar.edit',
        'update' => 'surat-keluar.update',
        'destroy' => 'surat-keluar.destroy',
    ])->middleware('permission:create surat-keluar');

    // Arsip Surat (CRUD + download)
    Route::resource('arsip-surat', ArsipSuratController::class)->names([
        'index' => 'arsip-surat.index',
        'create' => 'arsip-surat.create',
        'store' => 'arsip-surat.store',
        'show' => 'arsip-surat.show',
        'edit' => 'arsip-surat.edit',
        'update' => 'arsip-surat.update',
        'destroy' => 'arsip-surat.destroy',
    ])->middleware('permission:create arsip-surat');

    // Download file arsip
    Route::get('arsip-surat/{arsipSurat}/download', [ArsipSuratController::class, 'download'])
        ->name('arsip-surat.download');

    // Karyawan Management
    Route::resource('karyawan', KaryawanManagementController::class)->middleware('role:admin');
});

// Autentikasi (login, register, forgot password, dll)
require __DIR__.'/auth.php';
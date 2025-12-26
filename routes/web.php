<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruPelanggaranController;
use App\Http\Controllers\KategoriPelanggaranController;
use App\Http\Controllers\ListPelanggaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

use Illuminate\Support\Facades\Route;


// =====================
// Halaman Utama
// =====================
Route::get('/', function () {
    return view('welcome');
});


// =====================
// Dashboard Redirect Berdasarkan Role
// =====================
Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        default => abort(403, 'Unauthorized'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');


// =====================
// ADMIN ROUTES
// =====================
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('dashboard');

        // Kategori Pelanggaran
        Route::resource('kategori-pelanggaran', KategoriPelanggaranController::class)
            ->except(['show'])
            ->names('kategori');

        // List Pelanggaran
        Route::resource('pelanggaran', ListPelanggaranController::class)
            ->except(['show'])
            ->names('pelanggaran');

        // Pengguna
        Route::resource('users', UserController::class)->names('users');

        // ==========================
        // DATA SISWA (menu utama)
        // ==========================
        Route::resource('siswa', SiswaController::class)
            ->except(['show'])
            ->names('siswa');

        // ==========================
        // DATA KELAS (backend only)
        // (tidak muncul di layout)
        // ==========================
        Route::resource('kelas', KelasController::class)
            ->except(['show'])
            ->names('kelas');
    });


// =====================
// LAPORAN (ADMIN & GURU)
// =====================
Route::middleware(['auth', 'verified'])
    ->prefix('laporan')
    ->name('laporan.')
    ->group(function () {

        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::post('/filter', [LaporanController::class, 'filter'])->name('filter');
        Route::post('/pdf', [LaporanController::class, 'exportPdf'])->name('pdf');

    });


// =====================
// GURU ROUTES
// =====================
Route::middleware(['auth', 'verified'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        // Dashboard guru
        Route::get('/dashboard', [GuruController::class, 'index'])
            ->name('dashboard');

        // List pelanggaran guru
        Route::resource('pelanggaran', GuruPelanggaranController::class)
            ->except(['show'])
            ->names('pelanggaran');

        // Profile guru
        Route::get('/profile/edit', [GuruController::class, 'editProfile'])->name('profile.edit');
        Route::patch('/profile/update', [GuruController::class, 'updateProfile'])->name('profile.update');
    });


// =====================
// PROFILE (Breeze Default)
// =====================
Route::middleware(['auth', 'verified'])
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {

        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

    });

require __DIR__ . '/auth.php';

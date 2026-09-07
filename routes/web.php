<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PersetujuanController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DasborController;
use App\Http\Controllers\KoreksiPeminjamanController;
use App\Http\Controllers\KoreksiPengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\PengaturanController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dasbor');
    }

    $totalAlat = \App\Models\Alat::count();
    $alatPopuler = \App\Models\Alat::with('kategori')
        ->where('stok_tersedia', '>', 0)
        ->take(6)
        ->get();

    return view('onboarding', compact('totalAlat', 'alatPopuler'));
})->name('beranda');

Route::middleware(['auth'])->group(function () {

    // Route umum /dasbor untuk menangani pengalihan Fortify (config('fortify.home') = '/dasbor')
    Route::get('/dasbor', function () {
        $pengguna = auth()->user();

        if ($pengguna->hasRole('admin')) {
            return redirect()->route('admin.dasbor');
        }

        if ($pengguna->hasRole('petugas')) {
            return redirect()->route('petugas.dasbor');
        }

        return redirect()->route('peminjam.dasbor');
    })->name('dasbor');

    Route::get('/admin/dasbor', [DasborController::class, 'admin'])
        ->middleware('role:admin')
        ->name('admin.dasbor');

    Route::get('/petugas/dasbor', [DasborController::class, 'petugas'])
        ->middleware('role:petugas')
        ->name('petugas.dasbor');

    Route::get('/peminjam/dasbor', [DasborController::class, 'peminjam'])
        ->middleware('role:peminjam')
        ->name('peminjam.dasbor');

    // Master Data - Kategori
    Route::resource('kategori', KategoriController::class)
        ->except(['show'])
        ->middleware('permission:kategori.kelola');

    // Master Data - Alat
    Route::resource('alat', AlatController::class)
        ->except(['show'])
        ->middleware('permission:alat.kelola');

    // Master Data - Pengguna
    Route::resource('pengguna', PenggunaController::class)
        ->except(['show'])
        ->middleware('permission:user.kelola');

    // Modul Peminjaman - Katalog Alat & Keranjang
    Route::middleware('permission:alat.lihat')
        ->prefix('katalog')
        ->name('katalog.')
        ->group(function () {
            Route::get('/', [KatalogController::class, 'katalog'])->name('daftar');
            Route::get('/keranjang', [KatalogController::class, 'lihatKeranjang'])->name('keranjang');
            Route::post('/{alat}/tambah', [KatalogController::class, 'tambahKeKeranjang'])->name('tambah');
            Route::put('/{alat}/jumlah', [KatalogController::class, 'ubahJumlah'])->name('ubah-jumlah');
            Route::delete('/{alatId}/hapus', [KatalogController::class, 'hapusDariKeranjang'])->name('hapus');
            Route::delete('/kosongkan', [KatalogController::class, 'kosongkanKeranjang'])->name('kosongkan');
        });

    // Modul Peminjaman - Pengajuan Peminjaman (Siswa)
    Route::middleware('permission:peminjaman.ajukan')
        ->prefix('peminjaman')
        ->name('peminjaman.')
        ->group(function () {
            Route::get('/ajukan', [PeminjamanController::class, 'formPengajuan'])->name('ajukan');
            Route::post('/ajukan', [PeminjamanController::class, 'simpanPengajuan'])->name('simpan');
            Route::get('/saya', [PeminjamanController::class, 'daftarSaya'])->name('saya');
            Route::get('/{peminjaman}', [PeminjamanController::class, 'rincian'])->name('rincian');
        });

    // Modul Peminjaman - Persetujuan (Petugas)
    Route::middleware('permission:peminjaman.setujui')
        ->prefix('persetujuan')
        ->name('persetujuan.')
        ->group(function () {
            Route::get('/', [PersetujuanController::class, 'antrian'])->name('antrian');
            Route::get('/{peminjaman}', [PersetujuanController::class, 'rincian'])->name('rincian');
            Route::post('/{peminjaman}/setujui', [PersetujuanController::class, 'setujui'])->name('setujui');
            Route::post('/{peminjaman}/tolak', [PersetujuanController::class, 'tolak'])->name('tolak');
        });

    // Modul Pengembalian & Denda
    Route::middleware('permission:peminjaman.kembalikan')
        ->post('/peminjaman/{peminjaman}/kembalikan', [PengembalianController::class, 'ajukan'])
        ->name('pengembalian.ajukan');

    Route::middleware('permission:pengembalian.pantau')
        ->prefix('pengembalian')
        ->name('pengembalian.')
        ->group(function () {
            Route::get('/pantau', [PengembalianController::class, 'pantau'])->name('pantau');
            Route::get('/antrian', [PengembalianController::class, 'antrian'])->name('antrian');
            Route::get('/{peminjaman}/verifikasi', [PengembalianController::class, 'formVerifikasi'])->name('verifikasi');
            Route::post('/{peminjaman}/verifikasi', [PengembalianController::class, 'simpanVerifikasi'])->name('simpan');
            Route::get('/rincian/{pengembalian}', [PengembalianController::class, 'rincian'])->name('rincian');
        });

    Route::middleware('permission:log.lihat')
        ->get('/log-aktivitas', [LogAktivitasController::class, 'index'])
        ->name('log.index');

    Route::middleware('permission:laporan.cetak')
        ->prefix('laporan')
        ->name('laporan.')
        ->group(function () {
            Route::get('/', [LaporanController::class, 'form'])->name('form');
            Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])->name('peminjaman');
            Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])->name('pengembalian');
            Route::get('/stok', [LaporanController::class, 'stok'])->name('stok');
        });

    Route::middleware('permission:peminjaman.kelola')
        ->prefix('koreksi/peminjaman')
        ->name('koreksi.peminjaman.')
        ->group(function () {
            Route::get('/', [KoreksiPeminjamanController::class, 'daftar'])->name('daftar');
            Route::get('/{peminjaman}/ubah', [KoreksiPeminjamanController::class, 'formUbah'])->name('ubah');
            Route::put('/{peminjaman}', [KoreksiPeminjamanController::class, 'perbarui'])->name('perbarui');
            Route::delete('/{peminjaman}', [KoreksiPeminjamanController::class, 'hapus'])->name('hapus');
        });

    Route::middleware('permission:pengembalian.kelola')
        ->prefix('koreksi/pengembalian')
        ->name('koreksi.pengembalian.')
        ->group(function () {
            Route::get('/', [KoreksiPengembalianController::class, 'daftar'])->name('daftar');
            Route::get('/{pengembalian}/ubah', [KoreksiPengembalianController::class, 'formUbah'])->name('ubah');
            Route::put('/{pengembalian}', [KoreksiPengembalianController::class, 'perbarui'])->name('perbarui');
        });

    Route::middleware('permission:pengaturan.kelola')
        ->prefix('pengaturan')
        ->name('pengaturan.')
        ->group(function () {
            Route::get('/', [PengaturanController::class, 'form'])->name('form');
            Route::put('/', [PengaturanController::class, 'perbarui'])->name('perbarui');
        });

});

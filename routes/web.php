<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dasbor', function () {
        return view('dasbor.admin');
    })->middleware('role:admin')->name('admin.dasbor');

    Route::get('/petugas/dasbor', function () {
        return view('dasbor.petugas');
    })->middleware('role:petugas')->name('petugas.dasbor');

    Route::get('/peminjam/dasbor', function () {
        return view('dasbor.peminjam');
    })->middleware('role:peminjam')->name('peminjam.dasbor');

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

});

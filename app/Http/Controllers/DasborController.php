<?php

namespace App\Http\Controllers;

use App\Enums\StatusPeminjaman;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DasborController extends Controller
{
    public function admin()
    {
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();
        $totalPengguna = User::count();
        $peminjamanAktif = Peminjaman::whereIn('status', [
            StatusPeminjaman::Dipinjam,
            StatusPeminjaman::MenungguVerifikasi,
        ])->count();
        $antrianPersetujuan = Peminjaman::where('status', StatusPeminjaman::Diajukan)->count();
        $peminjamanTerbaru = Peminjaman::with(['peminjam'])->latest()->take(5)->get();

        return view('dasbor.admin', compact(
            'totalAlat',
            'totalKategori',
            'totalPengguna',
            'peminjamanAktif',
            'antrianPersetujuan',
            'peminjamanTerbaru'
        ));
    }

    public function petugas()
    {
        $antrianPersetujuan = Peminjaman::where('status', StatusPeminjaman::Diajukan)->count();
        $sedangDipinjam = Peminjaman::where('status', StatusPeminjaman::Dipinjam)->count();
        $antrianPengembalian = Peminjaman::where('status', StatusPeminjaman::MenungguVerifikasi)->count();
        $totalAlat = Alat::count();
        $antrianTerbaru = Peminjaman::with(['peminjam'])
            ->where('status', StatusPeminjaman::Diajukan)
            ->latest()
            ->take(5)
            ->get();

        return view('dasbor.petugas', compact(
            'antrianPersetujuan',
            'sedangDipinjam',
            'antrianPengembalian',
            'totalAlat',
            'antrianTerbaru'
        ));
    }

    public function peminjam()
    {
        $userId = auth()->id();
        $sedangDipinjam = Peminjaman::where('user_id', $userId)
            ->whereIn('status', [
                StatusPeminjaman::Dipinjam,
                StatusPeminjaman::MenungguVerifikasi,
            ])->count();

        $menungguPersetujuan = Peminjaman::where('user_id', $userId)
            ->where('status', StatusPeminjaman::Diajukan)
            ->count();

        $riwayatSelesai = Peminjaman::where('user_id', $userId)
            ->where('status', StatusPeminjaman::Selesai)
            ->count();

        $totalKeranjang = count(session('keranjang', []));

        $pinjamanTerbaru = Peminjaman::with(['detail.alat'])
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dasbor.peminjam', compact(
            'sedangDipinjam',
            'menungguPersetujuan',
            'riwayatSelesai',
            'totalKeranjang',
            'pinjamanTerbaru'
        ));
    }
}

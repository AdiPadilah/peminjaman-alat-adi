<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengaturan;
use App\Models\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function form()
    {
        $daftarKategori = Kategori::orderBy('nama')->get();

        return view('laporan.form', compact('daftarKategori'));
    }

    public function peminjaman(Request $request)
    {
        $data = $request->validate([
            'tgl_awal'  => ['required', 'date'],
            'tgl_akhir' => ['required', 'date', 'after_or_equal:tgl_awal'],
            'status'    => ['nullable', 'string'],
        ]);

        $daftarPeminjaman = Peminjaman::with(['peminjam', 'detail.alat'])
            ->whereBetween('tgl_pinjam', [$data['tgl_awal'], $data['tgl_akhir']])
            ->when($data['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('tgl_pinjam')
            ->get();

        $pdf = Pdf::loadView('laporan.peminjaman', [
            'daftarPeminjaman' => $daftarPeminjaman,
            'namaSekolah'      => $this->namaSekolah(),
            'keteranganPeriode'=> $this->keteranganPeriode($data),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-peminjaman.pdf');
    }

    public function pengembalian(Request $request)
    {
        $data = $request->validate([
            'tgl_awal'  => ['required', 'date'],
            'tgl_akhir' => ['required', 'date', 'after_or_equal:tgl_awal'],
        ]);

        $daftarPengembalian = Pengembalian::with([
            'peminjaman.peminjam',
            'peminjaman.detail.alat',
            'petugas',
        ])
            ->whereBetween('tgl_kembali', [$data['tgl_awal'], $data['tgl_akhir']])
            ->orderBy('tgl_kembali')
            ->get();

        $pdf = Pdf::loadView('laporan.pengembalian', [
            'daftarPengembalian' => $daftarPengembalian,
            'totalDenda'         => $daftarPengembalian->sum('total_denda'),
            'namaSekolah'        => $this->namaSekolah(),
            'keteranganPeriode'  => $this->keteranganPeriode($data),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-pengembalian.pdf');
    }

    public function stok(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => ['nullable', 'exists:kategori,id'],
        ]);

        $daftarAlat = Alat::with('kategori')
            ->when($data['kategori_id'] ?? null, function ($query, $kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->orderBy('kode_alat')
            ->get();

        $namaKategori = ! empty($data['kategori_id'])
            ? Kategori::find($data['kategori_id'])?->nama
            : 'Semua Kategori';

        $pdf = Pdf::loadView('laporan.stok', [
            'daftarAlat'       => $daftarAlat,
            'namaSekolah'      => $this->namaSekolah(),
            'keteranganPeriode'=> $namaKategori . ' - per ' . now()->format('d/m/Y'),
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-stok-alat.pdf');
    }

    private function namaSekolah(): string
    {
        return Pengaturan::ambil('nama_sekolah', 'Nama Sekolah');
    }

    private function keteranganPeriode(array $data): string
    {
        return date('d/m/Y', strtotime($data['tgl_awal']))
            . ' sampai '
            . date('d/m/Y', strtotime($data['tgl_akhir']));
    }
}

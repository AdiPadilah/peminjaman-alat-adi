<?php

namespace App\Http\Controllers;
use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $userId   = $request->query('user_id');
        $aksi     = $request->query('aksi');
        $tglAwal  = $request->query('tgl_awal');
        $tglAkhir = $request->query('tgl_akhir');

        $daftarLog = LogAktivitas::with('pengguna')
            ->when($userId, function ($query, $userId) {
                $query->where('user_id', $userId);
            })
            ->when($aksi, function ($query, $aksi) {
                $query->where('aksi', $aksi);
            })
            ->when($tglAwal, function ($query, $tglAwal) {
                $query->whereDate('created_at', '>=', $tglAwal);
            })
            ->when($tglAkhir, function ($query, $tglAkhir) {
                $query->whereDate('created_at', '<=', $tglAkhir);
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $daftarPengguna = User::orderBy('nama')->get();

        $daftarAksi = LogAktivitas::select('aksi')
            ->distinct()
            ->orderBy('aksi')
            ->pluck('aksi');

        return view('log.daftar', compact(
            'daftarLog', 'daftarPengguna', 'daftarAksi',
            'userId', 'aksi', 'tglAwal', 'tglAkhir'
        ));
    }
}

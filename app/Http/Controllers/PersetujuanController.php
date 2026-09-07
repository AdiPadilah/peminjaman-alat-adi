<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Services\PeminjamanService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function __construct(private PeminjamanService $layanan)
    {
    }

    public function antrian()
    {
        $daftarPengajuan = $this->layanan->antrianPengajuan();

        return view('persetujuan.antrian', compact('daftarPengajuan'));
    }

    public function rincian(Peminjaman $peminjaman)
    {
        $peminjaman->load(['peminjam', 'detail.alat']);

        return view('persetujuan.rincian', compact('peminjaman'));
    }

    public function setujui(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'tgl_harus_kembali' => [
                'required', 'date',
                'after_or_equal:' . $peminjaman->tgl_pinjam->toDateString(),
            ],
            'foto_file'       => ['nullable', 'array'],
            'foto_file.*'     => ['nullable', 'image', 'max:5120'],
            'foto_kamera'     => ['nullable', 'array'],
            'foto_kamera.*'   => ['nullable', 'string'],
        ], [
            'foto_file.*.image' => 'Berkas harus berupa gambar.',
            'foto_file.*.max'   => 'Ukuran foto maksimal 5MB.',
        ]);

        try {
            $this->layanan->setujui(
                $peminjaman,
                auth()->id(),
                $data['tgl_harus_kembali'],
                $request->file('foto_file') ?? [],
                $data['foto_kamera'] ?? []
            );
        } catch (QueryException $e) {
            return back()->with('gagal', $this->pesanRamah($e));
        }

        return redirect()
            ->route('persetujuan.antrian')
            ->with('sukses', 'Peminjaman ' . $peminjaman->kode_pinjam . ' disetujui.');
    }

    public function tolak(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'alasan_tolak' => ['required', 'string', 'min:5', 'max:500'],
        ], [
            'alasan_tolak.required' => 'Alasan penolakan wajib diisi.',
            'alasan_tolak.min'      => 'Alasan penolakan minimal 5 karakter.',
        ]);

        $this->layanan->tolak($peminjaman, auth()->id(), $data['alasan_tolak']);

        return redirect()
            ->route('persetujuan.antrian')
            ->with('sukses', 'Peminjaman ' . $peminjaman->kode_pinjam . ' ditolak.');
    }

    private function pesanRamah(QueryException $e): string
    {
        $pesanAsli = $e->errorInfo[2] ?? '';

        return $pesanAsli !== ''
            ? $pesanAsli
            : 'Persetujuan gagal diproses. Silakan coba lagi.';
    }
}

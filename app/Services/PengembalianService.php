<?php

namespace App\Services;

use App\Enums\StatusPeminjaman;
use App\Models\DetailPeminjaman;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Services\LayananFotoKondisi;
use Illuminate\Support\Facades\DB;

class PengembalianService
{
    public function __construct(private LayananFotoKondisi $layananFoto)
    {
    }

    public function antrianVerifikasi()
    {
        return Peminjaman::with(['peminjam', 'detail.alat'])
            ->where('status', StatusPeminjaman::MenungguVerifikasi->value)
            ->orderBy('tgl_diajukan_kembali')
            ->paginate(10);
    }

    public function daftarSedangDipinjam()
    {
        return Peminjaman::with(['peminjam', 'detail.alat'])
            ->whereIn('status', [
                StatusPeminjaman::Dipinjam->value,
                StatusPeminjaman::MenungguVerifikasi->value,
            ])
            ->orderBy('tgl_harus_kembali')
            ->paginate(10);
    }

    public function verifikasi(
        Peminjaman $peminjaman,
        int $petugasId,
        array $kondisiPerBaris,
        string $tglKembali,
        float $dendaKerusakan = 0,
        ?string $catatan = null,
        array $fotoFile = [],
        array $fotoKamera = []
    ): Pengembalian {
        abort_unless(
            $peminjaman->status->bolehKe(StatusPeminjaman::Selesai),
            422,
            'Peminjaman ini belum diajukan untuk dikembalikan.'
        );

        DB::beginTransaction();

        try {
            foreach ($kondisiPerBaris as $detailId => $kondisi) {
                $detail = DetailPeminjaman::where('id', $detailId)
                    ->where('peminjaman_id', $peminjaman->id)
                    ->first();

                if ($detail) {
                    $file   = $fotoFile[$detailId] ?? null;
                    $kamera = $fotoKamera[$detailId] ?? null;

                    $updateData = ['kondisi_kembali' => $kondisi];

                    $namaFoto = $this->layananFoto->simpan('sesudah', $detailId, $file, $kamera, $detail->foto_sesudah);
                    if ($namaFoto) {
                        $updateData['foto_sesudah'] = $namaFoto;
                    }

                    $detail->update($updateData);
                }
            }

            $tglDiajukan = $peminjaman->tgl_diajukan_kembali?->toDateString();

            if ($tglDiajukan && $tglDiajukan !== $tglKembali) {
                LogAktivitas::create([
                    'user_id'      => $petugasId,
                    'aksi'         => 'koreksi_tgl_kembali',
                    'tabel_tujuan' => 'pengembalian',
                    'deskripsi'    => 'Tanggal kembali ' . $peminjaman->kode_pinjam
                        . ' dikoreksi dari ' . $tglDiajukan
                        . ' menjadi ' . $tglKembali,
                    'ip_address'   => request()->ip(),
                ]);
            }

            $pengembalian = Pengembalian::create([
                'peminjaman_id'   => $peminjaman->id,
                'petugas_id'      => $petugasId,
                'tgl_kembali'     => $tglKembali,
                'denda_kerusakan' => $dendaKerusakan,
                'catatan'         => $catatan,
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return $pengembalian->fresh();
    }
}

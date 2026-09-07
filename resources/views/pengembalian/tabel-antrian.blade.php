<table class="table align-middle">
    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Peminjam</th>
            <th>Diajukan Kembali</th>
            <th>Harus Kembali</th>
            <th class="text-center">Jumlah Alat</th>
            <th class="text-end pe-3" style="width: 140px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarAntrian as $peminjaman)
            <tr class="{{ $peminjaman->lewatTenggat() ? 'bg-warning-subtle' : '' }}">
                <td class="fw-semibold">
                    <span class="badge badge-soft-secondary font-monospace">{{ $peminjaman->kode_pinjam }}</span>
                </td>
                <td>
                    <div class="fw-bold text-dark">{{ $peminjaman->peminjam->nama }}</div>
                </td>
                <td>{{ $peminjaman->tgl_diajukan_kembali?->format('d/m/Y') ?? '-' }}</td>
                <td>
                    <span class="fw-medium">{{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}</span>
                    @if ($peminjaman->lewatTenggat())
                        <span class="badge badge-soft-danger ms-1">
                            Terlambat {{ (int) $peminjaman->tgl_harus_kembali->startOfDay()->diffInDays(now()->startOfDay()) }} hari
                        </span>
                    @endif
                </td>
                <td class="text-center">
                    <span class="badge badge-soft-info">{{ $peminjaman->detail()->count() }} Item</span>
                </td>
                <td class="text-end pe-3">
                    <a href="{{ route('pengembalian.verifikasi', $peminjaman) }}"
                       class="btn btn-sm btn-success py-1 px-3">
                        <i class="bi bi-check-circle me-1"></i> Verifikasi
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                    <i class="bi bi-check2-circle fs-1 text-success d-block mb-2"></i>
                    Tidak ada pengajuan pengembalian yang menunggu verifikasi.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

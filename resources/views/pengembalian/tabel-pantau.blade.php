<table class="table align-middle">
    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Peminjam</th>
            <th>Harus Kembali</th>
            <th class="text-center">Jumlah Alat</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarPeminjaman as $peminjaman)
            <tr class="{{ $peminjaman->lewatTenggat() ? 'bg-warning-subtle' : '' }}">
                <td class="fw-semibold">
                    <span class="badge badge-soft-secondary font-monospace">{{ $peminjaman->kode_pinjam }}</span>
                </td>
                <td>
                    <div class="fw-bold text-dark">{{ $peminjaman->peminjam->nama }}</div>
                </td>
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
                <td>
                    <span class="badge bg-{{ $peminjaman->status->warna() }}">
                        {{ $peminjaman->status->label() }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                    Tidak ada peminjaman alat yang sedang berjalan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

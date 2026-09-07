<table class="table align-middle">
    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Peminjam</th>
            <th>Tanggal Pinjam</th>
            <th>Harus Kembali</th>
            <th class="text-center">Jumlah Alat</th>
            <th class="text-end pe-3" style="width: 120px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarPengajuan as $peminjaman)
            <tr>
                <td class="fw-semibold">
                    <span class="badge badge-soft-secondary font-monospace">{{ $peminjaman->kode_pinjam }}</span>
                </td>
                <td>
                    <div class="fw-bold text-dark">{{ $peminjaman->peminjam->nama }}</div>
                    <div class="small text-muted">{{ $peminjaman->peminjam->username }}</div>
                </td>
                <td>{{ $peminjaman->tgl_pinjam->format('d/m/Y') }}</td>
                <td>
                    <span class="fw-medium">{{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}</span>
                </td>
                <td class="text-center">
                    <span class="badge badge-soft-info">{{ $peminjaman->detail()->count() }} Item</span>
                </td>
                <td class="text-end pe-3">
                    <a href="{{ route('persetujuan.rincian', $peminjaman) }}"
                       class="btn btn-sm btn-primary py-1 px-3">
                        <i class="bi bi-arrow-right-short"></i> Proses
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                    <i class="bi bi-check2-circle fs-1 text-success d-block mb-2"></i>
                    Tidak ada pengajuan peminjaman yang menunggu diproses saat ini.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

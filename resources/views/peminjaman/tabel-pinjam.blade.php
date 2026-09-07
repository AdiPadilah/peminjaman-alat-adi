<table class="table align-middle">
    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Tanggal Pinjam</th>
            <th>Harus Kembali</th>
            <th class="text-center">Jumlah Alat</th>
            <th>Status</th>
            <th class="text-end pe-3" style="width: 200px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarPeminjaman as $peminjaman)
            <tr>
                <td class="fw-semibold">
                    <span class="badge badge-soft-secondary font-monospace">{{ $peminjaman->kode_pinjam }}</span>
                </td>
                <td>{{ $peminjaman->tgl_pinjam->format('d/m/Y') }}</td>
                <td>
                    <span class="fw-medium">{{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}</span>
                    @if ($peminjaman->lewatTenggat())
                        <span class="badge badge-soft-danger ms-1">Lewat tenggat</span>
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
                <td class="text-end pe-3">
                    <a href="{{ route('peminjaman.rincian', $peminjaman) }}"
                       class="btn btn-sm btn-outline-primary py-1 px-2">
                        <i class="bi bi-eye"></i> Rincian
                    </a>

                    @if ($peminjaman->status === \App\Enums\StatusPeminjaman::Dipinjam)
                        <form method="POST" action="{{ route('pengembalian.ajukan', $peminjaman) }}"
                              class="d-inline" onsubmit="return confirm('Ajukan pengembalian seluruh alat?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success py-1 px-2">
                                <i class="bi bi-box-arrow-in-down-left"></i> Kembalikan
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                    Belum ada riwayat atau pengajuan peminjaman.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

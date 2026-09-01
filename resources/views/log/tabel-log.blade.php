<table class="table table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th style="width: 160px">Waktu</th>
            <th style="width: 160px">Pengguna</th>
            <th style="width: 160px">Aksi</th>
            <th style="width: 160px">Tabel Tujuan</th>
            <th>Deskripsi</th>
            <th style="width: 130px">Alamat IP</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarLog as $log)
            <tr>
                <td class="small text-muted">
                    <i class="bi bi-clock me-1"></i>
                    {{ $log->created_at->format('d/m/Y') }}<br>
                    <span class="text-secondary">{{ $log->created_at->format('H:i:s') }}</span>
                </td>
                <td>
                    <span class="fw-semibold">{{ $log->pengguna->nama ?? 'Tidak dikenal' }}</span>
                </td>
                <td>
                    @php
                        $warnaBadge = match(true) {
                            str_contains($log->aksi, 'hapus')   => 'danger',
                            str_contains($log->aksi, 'tambah')  => 'success',
                            str_contains($log->aksi, 'ubah')    => 'warning',
                            str_contains($log->aksi, 'setujui') => 'success',
                            str_contains($log->aksi, 'tolak')   => 'danger',
                            str_contains($log->aksi, 'kembali') => 'info',
                            str_contains($log->aksi, 'verifikasi') => 'primary',
                            str_contains($log->aksi, 'beri_peran') => 'secondary',
                            default => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $warnaBadge }}">
                        {{ ucwords(str_replace('_', ' ', $log->aksi)) }}
                    </span>
                </td>
                <td class="small text-muted">
                    {{ $log->tabel_tujuan ? str_replace('_', ' ', $log->tabel_tujuan) : '-' }}
                </td>
                <td class="small">{{ $log->deskripsi ?? '-' }}</td>
                <td class="small text-muted font-monospace">{{ $log->ip_address ?: '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-5">
                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                    Tidak ada catatan aktivitas.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
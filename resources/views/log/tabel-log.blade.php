<table class="table align-middle">
    <thead>
        <tr>
            <th style="width: 160px">Waktu</th>
            <th style="width: 180px">Pengguna</th>
            <th style="width: 150px">Aksi</th>
            <th>Deskripsi</th>
            <th style="width: 130px">Alamat IP</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarLog as $log)
            <tr>
                <td class="small text-muted font-monospace">
                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                </td>
                <td>
                    <div class="fw-semibold text-dark">{{ $log->pengguna->nama ?? 'Tidak dikenal' }}</div>
                </td>
                <td>
                    <span class="badge badge-soft-primary text-uppercase">
                        {{ str_replace('_', ' ', $log->aksi) }}
                    </span>
                </td>
                <td class="small text-dark">{{ $log->deskripsi }}</td>
                <td class="small text-muted font-monospace">{{ $log->ip_address ?: '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-5 text-muted">
                    <i class="bi bi-journal-x fs-1 d-block mb-2 text-secondary"></i>
                    Tidak ada catatan aktivitas ditemukan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
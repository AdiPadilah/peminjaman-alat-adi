<table class="table table-sm table-striped align-middle">
    <thead>
        <tr>
            <th style="width: 150px">Waktu</th>
            <th style="width: 150px">Pengguna</th>
            <th style="width: 140px">Aksi</th>
            <th>Deskripsi</th>
            <th style="width: 120px">Alamat IP</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarLog as $log)
            <tr>
                <td class="small">
                    {{ $log->created_at->format('d/m/Y H:i') }}
                </td>
                <td>{{ $log->pengguna->nama ?? 'Tidak dikenal' }}</td>
                <td>
                    <span class="badge bg-secondary">
                        {{ str_replace('_', ' ', $log->aksi) }}
                    </span>
                </td>
                <td class="small">{{ $log->deskripsi }}</td>
                <td class="small text-muted">{{ $log->ip_address ?: '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Tidak ada catatan aktivitas.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
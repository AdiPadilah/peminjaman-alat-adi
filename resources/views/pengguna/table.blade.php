<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <tr>
                <th style="width: 60px">No</th>
                <th>Pengguna</th>
                <th>Nama Pengguna</th>
                <th>Peran</th>
                <th>Telepon</th>
                <th class="text-center">Status</th>
                <th class="text-end pe-3" style="width: 160px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarPengguna as $nomor => $pengguna)
                <tr>
                    <td class="text-muted">{{ $daftarPengguna->firstItem() + $nomor }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; font-size: 0.85rem;">
                                {{ strtoupper(substr($pengguna->nama, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $pengguna->nama }}</div>
                                <div class="small text-muted">{{ $pengguna->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-soft-secondary font-monospace">{{ $pengguna->username }}</span>
                    </td>
                    <td>
                        @foreach ($pengguna->roles as $peranPengguna)
                            <span class="badge badge-soft-info">
                                {{ ucfirst($peranPengguna->name) }}
                            </span>
                        @endforeach
                    </td>
                    <td>{{ $pengguna->no_telp ?: '-' }}</td>
                    <td class="text-center">
                        <span class="badge {{ $pengguna->is_aktif ? 'badge-soft-success' : 'badge-soft-danger' }}">
                            {{ $pengguna->is_aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-end pe-3">
                        @php
                            $hapus = $pengguna->id !== auth()->id() ? route('pengguna.destroy', $pengguna) : null;
                        @endphp
                        <x-tombol-aksi :ubah="route('pengguna.edit', $pengguna)" :hapus="$hapus"
                            pesanHapus="Yakin ingin menghapus pengguna {{ $pengguna->nama }}?" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-people fs-1 d-block mb-2 text-secondary"></i>
                        Data pengguna tidak ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

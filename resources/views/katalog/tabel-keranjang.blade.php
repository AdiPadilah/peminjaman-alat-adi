<table class="table align-middle">
    <thead>
        <tr>
            <th style="width: 120px;">Kode</th>
            <th>Nama Alat</th>
            <th>Kategori</th>
            <th class="text-center" style="width: 120px;">Tersedia</th>
            <th style="width: 180px;">Jumlah Pinjam</th>
            <th class="text-end pe-3" style="width: 100px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($isiKeranjang as $baris)
            <tr>
                <td class="fw-semibold">
                    <span class="badge badge-soft-secondary">{{ $baris->alat->kode_alat }}</span>
                </td>
                <td>
                    <div class="fw-bold text-dark">{{ $baris->alat->nama }}</div>
                </td>
                <td>
                    <span class="badge badge-soft-primary">{{ $baris->alat->kategori->nama }}</span>
                </td>
                <td class="text-center">
                    <span class="badge badge-soft-success">{{ $baris->alat->stok_tersedia }} unit</span>
                </td>
                <td>
                    <form method="POST" action="{{ route('katalog.ubah-jumlah', $baris->alat) }}"
                          class="d-flex gap-1 align-items-center">
                        @csrf
                        @method('PUT')
                        <input type="number" name="jumlah" class="form-control form-control-sm text-center"
                               value="{{ $baris->jumlah }}" min="1" max="{{ $baris->alat->stok_tersedia }}" style="max-width: 80px;">
                        <button type="submit" class="btn btn-sm btn-outline-primary py-1 px-2" title="Simpan Perubahan">
                            <i class="bi bi-check-lg"></i> Ubah
                        </button>
                    </form>
                </td>
                <td class="text-end pe-3">
                    <form method="POST" action="{{ route('katalog.hapus', $baris->alat->id) }}"
                          onsubmit="return confirm('Hapus alat {{ $baris->alat->nama }} dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2" title="Hapus dari keranjang">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

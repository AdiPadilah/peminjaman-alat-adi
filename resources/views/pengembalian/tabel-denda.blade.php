<div class="card">
    <div class="card-header">Rincian Denda per Alat</div>
    <div class="card-body p-0">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th class="text-center">Jumlah</th>
                    <th>Kondisi</th>
                    <th class="text-center" style="width: 90px;">Sebelum</th>
                    <th class="text-center" style="width: 90px;">Sesudah</th>
                    <th class="text-end">Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalian->peminjaman->detail as $baris)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $baris->alat->nama }}</div>
                            <small class="text-muted">{{ $baris->alat->kode_alat }}</small>
                        </td>
                        <td class="text-center">{{ $baris->jumlah }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ ucwords(str_replace('_', ' ', $baris->kondisi_kembali ?? 'baik')) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($baris->url_foto_sebelum)
                                <img src="{{ $baris->url_foto_sebelum }}" 
                                     alt="Foto Sebelum" 
                                     class="rounded border img-pratinjau shadow-sm cursor-pointer"
                                     style="width: 44px; height: 44px; object-fit: cover; cursor: pointer;"
                                     data-judul="Foto Kondisi Sebelum: {{ $baris->alat->nama }}"
                                     data-info="Kondisi awal sebelum dipinjam"
                                     title="Klik untuk memperbesar">
                            @else
                                <span class="badge bg-light text-muted border">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($baris->url_foto_sesudah)
                                <img src="{{ $baris->url_foto_sesudah }}" 
                                     alt="Foto Sesudah" 
                                     class="rounded border img-pratinjau shadow-sm cursor-pointer"
                                     style="width: 44px; height: 44px; object-fit: cover; cursor: pointer;"
                                     data-judul="Foto Kondisi Sesudah: {{ $baris->alat->nama }}"
                                     data-info="Kondisi saat dikembalikan: {{ ucwords(str_replace('_', ' ', $baris->kondisi_kembali ?? 'baik')) }}"
                                     title="Klik untuk memperbesar">
                            @else
                                <span class="badge bg-light text-muted border">-</span>
                            @endif
                        </td>
                        <td class="text-end fw-semibold">
                            Rp {{ number_format($baris->denda, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">Alat yang Diajukan</div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Kode & Nama</th>
                    <th class="text-center" style="width: 70px;">Diminta</th>
                    <th class="text-center" style="width: 70px;">Tersedia</th>
                    <th style="width: 220px;">Foto Kondisi Awal (Opsional)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman->detail as $baris)
                    <tr class="{{ $baris->alat->stok_tersedia < $baris->jumlah ? 'table-danger' : '' }}">
                        <td>
                            <div class="fw-semibold">{{ $baris->alat->nama }}</div>
                            <small class="text-muted">{{ $baris->alat->kode_alat }}</small>
                        </td>
                        <td class="text-center">{{ $baris->jumlah }}</td>
                        <td class="text-center">{{ $baris->alat->stok_tersedia }}</td>
                        <td>
                            <!-- Hidden input untuk webcam data base64 terhubung ke formSetujuiPeminjaman -->
                            <input type="hidden" name="foto_kamera[{{ $baris->id }}]" form="formSetujuiPeminjaman">
                            
                            <!-- Input file tersembunyi terhubung ke formSetujuiPeminjaman -->
                            <input type="file" 
                                   name="foto_file[{{ $baris->id }}]" 
                                   id="file_sebelum_{{ $baris->id }}" 
                                   accept="image/*" 
                                   class="d-none input-foto-file" 
                                   data-detail-id="{{ $baris->id }}"
                                   form="formSetujuiPeminjaman">

                            <div class="d-flex flex-wrap align-items-center gap-1">
                                <!-- Tombol Buka Kamera Webcam -->
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary btn-buka-kamera py-1 px-2" 
                                        data-detail-id="{{ $baris->id }}" 
                                        data-nama-alat="{{ $baris->alat->nama }}" 
                                        data-prefix="sebelum"
                                        title="Jepret foto awal via webcam laptop">
                                    <i class="bi bi-camera-fill me-1"></i>Kamera
                                </button>

                                <!-- Tombol Pilih File Biasa -->
                                <label for="file_sebelum_{{ $baris->id }}" 
                                       class="btn btn-sm btn-outline-secondary py-1 px-2 mb-0" 
                                       style="cursor: pointer;"
                                       title="Upload file foto dari laptop">
                                    <i class="bi bi-folder2-open me-1"></i>File
                                </label>
                            </div>

                            <!-- Area Pratinjau Thumbnail Foto Awal -->
                            <div id="pratinjau_foto_{{ $baris->id }}" class="mt-1"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-4">Peminjam</dt>
            <dd class="col-sm-8">{{ $peminjaman->peminjam->nama }}</dd>

            <dt class="col-sm-4">Tanggal Pinjam</dt>
            <dd class="col-sm-8">{{ $peminjaman->tgl_pinjam->format('d/m/Y') }}</dd>

            <dt class="col-sm-4">Keperluan</dt>
            <dd class="col-sm-8">{{ $peminjaman->keperluan ?: '-' }}</dd>
        </dl>
    </div>
</div>

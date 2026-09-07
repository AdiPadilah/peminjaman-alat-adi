<div class="card">
    <div class="card-header">Kondisi Alat yang Dikembalikan</div>
    <div class="card-body p-0">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Kode & Nama</th>
                    <th class="text-center" style="width: 70px;">Jumlah</th>
                    <th class="text-center" style="width: 100px;">Foto Sebelum</th>
                    <th style="width: 160px;">Kondisi Kembali</th>
                    <th style="width: 220px;">Foto Bukti Sesudah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman->detail as $baris)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $baris->alat->nama }}</div>
                            <small class="text-muted">{{ $baris->alat->kode_alat }}</small>
                        </td>
                        <td class="text-center">{{ $baris->jumlah }}</td>
                        <td class="text-center">
                            @if ($baris->url_foto_sebelum)
                                <img src="{{ $baris->url_foto_sebelum }}" 
                                     alt="Foto Sebelum" 
                                     class="rounded border img-pratinjau cursor-pointer shadow-sm"
                                     style="width: 45px; height: 45px; object-fit: cover; cursor: pointer;"
                                     data-judul="Kondisi Sebelum: {{ $baris->alat->nama }}"
                                     data-info="Foto saat serah terima/persetujuan"
                                     title="Klik untuk memperbesar">
                            @else
                                <span class="badge bg-light text-muted border">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <select name="kondisi[{{ $baris->id }}]"
                                    class="form-select form-select-sm" required>
                                <option value="baik">Baik</option>
                                <option value="rusak_ringan">Rusak Ringan</option>
                                <option value="rusak_berat">Rusak Berat</option>
                                <option value="hilang">Hilang</option>
                            </select>
                        </td>
                        <td>
                            <!-- Hidden input untuk webcam data base64 -->
                            <input type="hidden" name="foto_kamera[{{ $baris->id }}]">
                            
                            <!-- Input file tersembunyi -->
                            <input type="file" 
                                   name="foto_file[{{ $baris->id }}]" 
                                   id="file_kembali_{{ $baris->id }}" 
                                   accept="image/*" 
                                   class="d-none input-foto-file" 
                                   data-detail-id="{{ $baris->id }}">

                            <div class="d-flex flex-wrap align-items-center gap-1">
                                <!-- Tombol Buka Kamera Webcam -->
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary btn-buka-kamera py-1 px-2" 
                                        data-detail-id="{{ $baris->id }}" 
                                        data-nama-alat="{{ $baris->alat->nama }}" 
                                        data-prefix="sesudah"
                                        title="Jepret langsung via webcam laptop">
                                    <i class="bi bi-camera-fill me-1"></i>Kamera
                                </button>

                                <!-- Tombol Pilih File Biasa -->
                                <label for="file_kembali_{{ $baris->id }}" 
                                       class="btn btn-sm btn-outline-secondary py-1 px-2 mb-0" 
                                       style="cursor: pointer;"
                                       title="Upload file foto dari laptop">
                                    <i class="bi bi-folder2-open me-1"></i>File
                                </label>
                            </div>

                            <!-- Area Pratinjau Thumbnail Foto yang baru diambil/diunggah -->
                            <div id="pratinjau_foto_{{ $baris->id }}" class="mt-1"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@extends('layouts.utama')

@section('judul', 'Rincian Peminjaman')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ $peminjaman->kode_pinjam }}</h4>
        <a href="{{ route('peminjaman.saya') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-{{ $peminjaman->status->warna() }}">
                        {{ $peminjaman->status->label() }}
                    </span>
                </dd>

                <dt class="col-sm-3">Tanggal Pinjam</dt>
                <dd class="col-sm-9">{{ $peminjaman->tgl_pinjam->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Harus Kembali</dt>
                <dd class="col-sm-9">{{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}</dd>

                <dt class="col-sm-3">Keperluan</dt>
                <dd class="col-sm-9">{{ $peminjaman->keperluan ?: '-' }}</dd>

                <dt class="col-sm-3">Petugas</dt>
                <dd class="col-sm-9">{{ $peminjaman->petugas->nama ?? 'Belum diproses' }}</dd>

                @if ($peminjaman->alasan_tolak)
                    <dt class="col-sm-3">Alasan Ditolak</dt>
                    <dd class="col-sm-9 text-danger">{{ $peminjaman->alasan_tolak }}</dd>
                @endif
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Daftar Alat & Bukti Kondisi Fisik</div>
        <div class="card-body p-0">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kode & Nama Alat</th>
                        <th class="text-center" style="width: 80px;">Jumlah</th>
                        <th class="text-center" style="width: 110px;">Foto Sebelum</th>
                        @if ($peminjaman->detail->contains(fn($d) => !empty($d->kondisi_kembali)))
                            <th style="width: 130px;">Kondisi Kembali</th>
                            <th class="text-center" style="width: 110px;">Foto Sesudah</th>
                            <th class="text-end" style="width: 120px;">Denda</th>
                        @endif
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
                                         class="rounded border img-pratinjau shadow-sm cursor-pointer"
                                         style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;"
                                         data-judul="Kondisi Sebelum: {{ $baris->alat->nama }}"
                                         data-info="Foto fisik saat persetujuan/serah terima alat"
                                         title="Klik untuk memperbesar">
                                @else
                                    <span class="badge bg-light text-muted border">Tidak ada</span>
                                @endif
                            </td>
                            @if ($peminjaman->detail->contains(fn($d) => !empty($d->kondisi_kembali)))
                                <td>
                                    @if ($baris->kondisi_kembali)
                                        <span class="badge bg-{{ $baris->kondisi_kembali === 'baik' ? 'success' : 'danger' }}">
                                            {{ ucwords(str_replace('_', ' ', $baris->kondisi_kembali)) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($baris->url_foto_sesudah)
                                        <img src="{{ $baris->url_foto_sesudah }}" 
                                             alt="Foto Sesudah" 
                                             class="rounded border img-pratinjau shadow-sm cursor-pointer"
                                             style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;"
                                             data-judul="Kondisi Sesudah: {{ $baris->alat->nama }}"
                                             data-info="Foto fisik saat pengembalian ({{ ucwords(str_replace('_', ' ', $baris->kondisi_kembali)) }})"
                                             title="Klik untuk memperbesar">
                                    @else
                                        <span class="badge bg-light text-muted border">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-end fw-semibold">
                                    Rp {{ number_format($baris->denda, 0, ',', '.') }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

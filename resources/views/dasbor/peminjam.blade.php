@extends('layouts.utama')

@section('judul', 'Dasbor Peminjam')

@section('konten')
    {{-- Hero Welcome Banner --}}
    <div class="hero-banner">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <span class="badge badge-soft-info mb-2 text-white" style="background: rgba(255,255,255,0.15) !important; border-color: rgba(255,255,255,0.2);">
                    <i class="bi bi-mortarboard me-1"></i> Area Peminjam
                </span>
                <h3>Halo, {{ auth()->user()->nama }}!</h3>
                <p>Butuh alat praktikum atau perlengkapan kegiatan? Pilih alat di katalog dan ajukan pinjaman dengan mudah.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('katalog.daftar') }}" class="btn btn-light text-primary fw-bold shadow-sm">
                    <i class="bi bi-search me-1"></i> Buka Katalog
                </a>
            </div>
        </div>
    </div>

    {{-- Stat Cards Grid --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-primary">
                <div class="stat-info-text">
                    <div class="stat-label">Sedang Dipinjam</div>
                    <div class="stat-value">{{ $sedangDipinjam }}</div>
                </div>
                <div class="stat-icon icon-primary">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-warning">
                <div class="stat-info-text">
                    <div class="stat-label">Menunggu Persetujuan</div>
                    <div class="stat-value">{{ $menungguPersetujuan }}</div>
                </div>
                <div class="stat-icon icon-warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-success">
                <div class="stat-info-text">
                    <div class="stat-label">Riwayat Selesai</div>
                    <div class="stat-value">{{ $riwayatSelesai }}</div>
                </div>
                <div class="stat-icon icon-success">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-info">
                <div class="stat-info-text">
                    <div class="stat-label">Isi Keranjang</div>
                    <div class="stat-value">{{ $totalKeranjang }}</div>
                </div>
                <div class="stat-icon icon-info">
                    <i class="bi bi-cart3"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- 4 Langkah Peminjaman Guide --}}
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="bi bi-info-circle text-primary me-2"></i>Alur Peminjaman Alat Laboratorium
            </h6>
        </div>
        <div class="card-body">
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px; font-weight: 700;">1</div>
                        <div class="fw-bold small text-dark mb-1">Pilih Alat</div>
                        <div class="text-muted" style="font-size: 0.8rem;">Cari alat yang dibutuhkan dan tambahkan ke keranjang.</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px; font-weight: 700;">2</div>
                        <div class="fw-bold small text-dark mb-1">Ajukan Formulir</div>
                        <div class="text-muted" style="font-size: 0.8rem;">Isi keperluan dan tentukan durasi peminjaman.</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px; font-weight: 700;">3</div>
                        <div class="fw-bold small text-dark mb-1">Persetujuan Petugas</div>
                        <div class="text-muted" style="font-size: 0.8rem;">Tunggu konfirmasi dan persetujuan dari petugas lab.</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px; font-weight: 700;">4</div>
                        <div class="fw-bold small text-dark mb-1">Ambil & Kembalikan</div>
                        <div class="text-muted" style="font-size: 0.8rem;">Ambil alat di ruang lab dan kembalikan tepat waktu.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pinjaman Terbaru Saya Table --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="bi bi-clock-history text-primary me-2"></i>Pinjaman Terbaru Saya
            </h6>
            <a href="{{ route('peminjaman.saya') }}" class="btn btn-outline-secondary btn-sm">
                Lihat Semua
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Kode Pinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Batas Pengembalian</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pinjamanTerbaru as $pinjam)
                            <tr>
                                <td class="fw-semibold">{{ $pinjam->kode_pinjam }}</td>
                                <td>{{ $pinjam->tgl_pinjam?->format('d/m/Y') }}</td>
                                <td>
                                    {{ $pinjam->tgl_harus_kembali?->format('d/m/Y') }}
                                    @if ($pinjam->lewatTenggat())
                                        <span class="badge bg-danger ms-1">Terlambat</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $pinjam->status->warna() }}">
                                        {{ $pinjam->status->label() }}
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('peminjaman.rincian', $pinjam) }}" class="btn btn-sm btn-outline-primary py-1 px-3">
                                        <i class="bi bi-eye"></i> Rincian
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-bag-check fs-2 text-primary d-block mb-2"></i>
                                    Anda belum memiliki pengajuan peminjaman.
                                    <div class="mt-2">
                                        <a href="{{ route('katalog.daftar') }}" class="btn btn-sm btn-primary">
                                            Mulai Pinjam Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

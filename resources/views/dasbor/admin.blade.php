@extends('layouts.utama')

@section('judul', 'Dasbor Administrator')

@section('konten')
    {{-- Hero Welcome Banner --}}
    <div class="hero-banner">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <span class="badge badge-soft-info mb-2 text-white" style="background: rgba(255,255,255,0.15) !important; border-color: rgba(255,255,255,0.2);">
                    <i class="bi bi-shield-check me-1"></i> Panel Administrator
                </span>
                <h3>Selamat Datang, {{ auth()->user()->nama }}!</h3>
                <p>Pantau inventaris alat, status peminjaman, dan kelola pengguna sistem secara terpusat.</p>
            </div>
            <div class="text-md-end">
                <span class="badge bg-white text-dark py-2 px-3 shadow-sm" style="font-size: 0.85rem;">
                    <i class="bi bi-calendar3 me-1 text-primary"></i> {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- Stat Cards Grid --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl">
            <div class="stat-card stat-primary">
                <div class="stat-info-text">
                    <div class="stat-label">Total Alat</div>
                    <div class="stat-value">{{ $totalAlat }}</div>
                </div>
                <div class="stat-icon icon-primary">
                    <i class="bi bi-tools"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl">
            <div class="stat-card stat-info">
                <div class="stat-info-text">
                    <div class="stat-label">Kategori</div>
                    <div class="stat-value">{{ $totalKategori }}</div>
                </div>
                <div class="stat-icon icon-info">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl">
            <div class="stat-card stat-success">
                <div class="stat-info-text">
                    <div class="stat-label">Pengguna</div>
                    <div class="stat-value">{{ $totalPengguna }}</div>
                </div>
                <div class="stat-icon icon-success">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl">
            <div class="stat-card stat-warning">
                <div class="stat-info-text">
                    <div class="stat-label">Sedang Dipinjam</div>
                    <div class="stat-value">{{ $peminjamanAktif }}</div>
                </div>
                <div class="stat-icon icon-warning">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl">
            <div class="stat-card stat-danger">
                <div class="stat-info-text">
                    <div class="stat-label">Antrian Pengajuan</div>
                    <div class="stat-value">{{ $antrianPersetujuan }}</div>
                </div>
                <div class="stat-icon icon-danger">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Action Buttons --}}
    <div class="card mb-4">
        <div class="card-body">
            <h6 class="fw-bold text-dark mb-3">
                <i class="bi bi-lightning-charge-fill text-warning me-2"></i>Aksi Cepat
            </h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('alat.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Alat
                </a>
                <a href="{{ route('kategori.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Kategori
                </a>
                <a href="{{ route('pengguna.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-person-plus"></i> Tambah Pengguna
                </a>
                @can('persetujuan.antrian')
                    <a href="{{ route('persetujuan.antrian') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-check2-circle"></i> Cek Persetujuan
                    </a>
                @endcan
                @can('laporan.cetak')
                    <a href="{{ route('laporan.form') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </a>
                @endcan
                <a href="{{ route('pengaturan.form') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-gear"></i> Pengaturan
                </a>
            </div>
        </div>
    </div>

    {{-- Recent Transactions Table --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="bi bi-clock-history text-primary me-2"></i>Aktivitas Peminjaman Terbaru
            </h6>
            <a href="{{ route('koreksi.peminjaman.daftar') }}" class="btn btn-outline-secondary btn-sm">
                Lihat Semua
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Kode Pinjam</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamanTerbaru as $pinjam)
                            <tr>
                                <td class="fw-semibold">{{ $pinjam->kode_pinjam }}</td>
                                <td>{{ $pinjam->peminjam->nama ?? '-' }}</td>
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
                                    <a href="{{ route('koreksi.peminjaman.ubah', $pinjam) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                                        <i class="bi bi-eye"></i> Rincian
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada transaksi peminjaman terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

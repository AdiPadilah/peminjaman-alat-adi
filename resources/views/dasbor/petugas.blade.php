@extends('layouts.utama')

@section('judul', 'Dasbor Petugas')

@section('konten')
    {{-- Hero Welcome Banner --}}
    <div class="hero-banner">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <span class="badge badge-soft-warning mb-2 text-white" style="background: rgba(255,255,255,0.15) !important; border-color: rgba(255,255,255,0.2);">
                    <i class="bi bi-person-badge me-1"></i> Petugas Laboratorium
                </span>
                <h3>Selamat Datang, {{ auth()->user()->nama }}!</h3>
                <p>Verifikasi pengajuan peminjaman alat dan pantau pengembalian secara tepat waktu.</p>
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
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-danger">
                <div class="stat-info-text">
                    <div class="stat-label">Menunggu Persetujuan</div>
                    <div class="stat-value">{{ $antrianPersetujuan }}</div>
                </div>
                <div class="stat-icon icon-danger">
                    <i class="bi bi-clock-history"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-warning">
                <div class="stat-info-text">
                    <div class="stat-label">Sedang Dipinjam</div>
                    <div class="stat-value">{{ $sedangDipinjam }}</div>
                </div>
                <div class="stat-icon icon-warning">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-info">
                <div class="stat-info-text">
                    <div class="stat-label">Verifikasi Kembali</div>
                    <div class="stat-value">{{ $antrianPengembalian }}</div>
                </div>
                <div class="stat-icon icon-info">
                    <i class="bi bi-check2-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-primary">
                <div class="stat-info-text">
                    <div class="stat-label">Total Stok Alat</div>
                    <div class="stat-value">{{ $totalAlat }}</div>
                </div>
                <div class="stat-icon icon-primary">
                    <i class="bi bi-tools"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Action Buttons --}}
    <div class="card mb-4">
        <div class="card-body">
            <h6 class="fw-bold text-dark mb-3">
                <i class="bi bi-lightning-charge-fill text-warning me-2"></i>Aksi Operasional
            </h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('persetujuan.antrian') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-card-checklist"></i> Proses Persetujuan
                </a>
                <a href="{{ route('pengembalian.antrian') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-box-arrow-in-down-left"></i> Verifikasi Pengembalian
                </a>
                <a href="{{ route('pengembalian.pantau') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-eye"></i> Pantau Keterlambatan
                </a>
                <a href="{{ route('katalog.daftar') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-grid-3x3-gap"></i> Lihat Katalog
                </a>
            </div>
        </div>
    </div>

    {{-- Antrian Pengajuan Table --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="bi bi-hourglass-split text-danger me-2"></i>Pengajuan Perlu Diproses Segera
            </h6>
            <a href="{{ route('persetujuan.antrian') }}" class="btn btn-outline-secondary btn-sm">
                Buka Semua Antrian
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Kode Pinjam</th>
                            <th>Peminjam</th>
                            <th>Tanggal Diajukan</th>
                            <th>Rencana Kembali</th>
                            <th>Keperluan</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($antrianTerbaru as $pengajuan)
                            <tr>
                                <td class="fw-semibold">{{ $pengajuan->kode_pinjam }}</td>
                                <td>{{ $pengajuan->peminjam->nama ?? '-' }}</td>
                                <td>{{ $pengajuan->tgl_pinjam?->format('d/m/Y') }}</td>
                                <td>{{ $pengajuan->tgl_harus_kembali?->format('d/m/Y') }}</td>
                                <td>{{ Str::limit($pengajuan->keperluan, 40) }}</td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('persetujuan.rincian', $pengajuan) }}" class="btn btn-sm btn-primary py-1 px-3">
                                        <i class="bi bi-arrow-right-short"></i> Tinjau
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-check-circle fs-2 text-success d-block mb-2"></i>
                                    Tidak ada antrian pengajuan peminjaman saat ini. Semua telah tertangani!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.utama')

@section('judul', 'Katalog Alat')

@section('konten')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>Katalog Alat Laboratorium
            </h4>
            <p class="text-muted small mb-0">Jelajahi dan pilih alat praktikum yang tersedia untuk dipinjam.</p>
        </div>
        @can('alat.lihat')
            <a href="{{ route('katalog.keranjang') }}" class="btn btn-outline-primary shadow-sm">
                <i class="bi bi-cart3 me-1"></i> Keranjang Peminjaman
                @if (count(session('keranjang', [])) > 0)
                    <span class="badge bg-primary text-white ms-1">
                        {{ count(session('keranjang', [])) }}
                    </span>
                @endif
            </a>
        @endcan
    </div>

    @include('katalog.form-pencarian')

    <div class="row g-4">
        @forelse ($daftarAlat as $alat)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="product-card">
                    <div class="product-image-container">
                        @if ($alat->foto)
                            <img src="{{ asset('gambar/alat/' . $alat->foto) }}"
                                 alt="{{ $alat->nama }}" loading="lazy">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                <i class="bi bi-camera fs-1 mb-1 opacity-50"></i>
                                <span class="small">Tanpa Foto</span>
                            </div>
                        @endif

                        <div class="product-badge-float">
                            @if ($alat->stok_tersedia > 0)
                                <span class="badge badge-soft-success">
                                    <i class="bi bi-check-circle me-1"></i>{{ $alat->stok_tersedia }} Tersedia
                                </span>
                            @else
                                <span class="badge badge-soft-danger">
                                    <i class="bi bi-x-circle me-1"></i>Habis
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="product-body">
                        <div class="mb-2">
                            <span class="badge badge-soft-primary" style="font-size: 0.7rem;">
                                {{ $alat->kategori->nama ?? 'Umum' }}
                            </span>
                        </div>

                        <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $alat->nama }}">
                            {{ $alat->nama }}
                        </h6>

                        <div class="small text-muted mb-3 d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-upc me-1"></i>{{ $alat->kode_alat }}</span>
                            <span class="text-capitalize">{{ str_replace('_', ' ', $alat->kondisi) }}</span>
                        </div>

                        <div class="mt-auto pt-2 border-top">
                            @if ($alat->stok_tersedia > 0)
                                <form method="POST" action="{{ route('katalog.tambah', $alat) }}" class="row g-2 align-items-center">
                                    @csrf
                                    <div class="col-4">
                                        <input type="number" name="jumlah" class="form-control form-control-sm text-center"
                                               value="1" min="1" max="{{ $alat->stok_tersedia }}" required>
                                    </div>
                                    <div class="col-8">
                                        <button type="submit" class="btn btn-sm btn-primary w-100">
                                            <i class="bi bi-cart-plus me-1"></i> Pinjam
                                        </button>
                                    </div>
                                </form>
                            @else
                                <button class="btn btn-sm btn-light border text-muted w-100" disabled>
                                    <i class="bi bi-dash-circle me-1"></i> Stok Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 py-5 text-center">
                    <div class="card-body">
                        <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                        <h5 class="fw-bold text-dark">Alat Tidak Ditemukan</h5>
                        <p class="text-muted small">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                        <a href="{{ route('katalog.daftar') }}" class="btn btn-outline-primary btn-sm">
                            Reset Pencarian
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $daftarAlat->links() }}
    </div>
@endsection

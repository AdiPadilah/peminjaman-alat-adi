@extends('layouts.utama')

@section('judul', 'Keranjang Peminjaman')

@section('konten')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-cart3 text-primary me-2"></i>Keranjang Peminjaman
            </h4>
            <p class="text-muted small mb-0">Tinjau daftar alat yang akan Anda ajukan untuk peminjaman.</p>
        </div>
        <a href="{{ route('katalog.daftar') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
        </a>
    </div>

    @if ($isiKeranjang->isEmpty())
        <div class="card border-0 shadow-sm py-5">
            <div class="card-body text-center py-5">
                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-cart-x fs-1 text-muted"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Keranjang Masih Kosong</h5>
                <p class="text-muted small mb-4">Anda belum menambahkan alat apapun ke dalam keranjang.</p>
                <a href="{{ route('katalog.daftar') }}" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Jelajahi Katalog Alat
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    @include('katalog.tabel-keranjang')
                </div>
            </div>
            <div class="card-footer bg-white border-top p-3 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                <form method="POST" action="{{ route('katalog.kosongkan') }}"
                      onsubmit="return confirm('Kosongkan seluruh keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash me-1"></i> Kosongkan Keranjang
                    </button>
                </form>

                <a href="{{ route('peminjaman.ajukan') }}" class="btn btn-success px-4 shadow-sm">
                    <span>Lanjut ke Formulir Pengajuan</span>
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    @endif
@endsection

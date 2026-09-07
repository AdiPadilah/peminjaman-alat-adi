@extends('layouts.utama')

@section('judul', 'Pinjaman Saya')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-journal-bookmark text-primary me-2"></i>Pinjaman Saya
            </h4>
            <p class="text-muted small mb-0">Pantau status pengajuan, batas waktu peminjaman, dan riwayat pengembalian.</p>
        </div>
        <a href="{{ route('katalog.daftar') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Pinjam Alat Baru
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                @include('peminjaman.tabel-pinjam')
            </div>
        </div>
        @if ($daftarPeminjaman->hasPages())
            <div class="card-footer bg-white border-top p-3">
                {{ $daftarPeminjaman->links() }}
            </div>
        @endif
    </div>
@endsection

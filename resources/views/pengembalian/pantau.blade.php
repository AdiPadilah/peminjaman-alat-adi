@extends('layouts.utama')

@section('judul', 'Pemantauan Peminjaman')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-eye text-primary me-2"></i>Pemantauan Peminjaman Berjalan
            </h4>
            <p class="text-muted small mb-0">Pantau seluruh alat yang sedang dipinjam dan deteksi keterlambatan secara riil.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                @include('pengembalian.tabel-pantau')
            </div>
        </div>
        @if ($daftarPeminjaman->hasPages())
            <div class="card-footer bg-white border-top p-3">
                {{ $daftarPeminjaman->links() }}
            </div>
        @endif
    </div>
@endsection

@extends('layouts.utama')

@section('judul', 'Antrian Verifikasi Pengembalian')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-box-arrow-in-down-left text-primary me-2"></i>Antrian Verifikasi Pengembalian
            </h4>
            <p class="text-muted small mb-0">Periksa kondisi fisik alat yang dikembalikan dan konfirmasi penyelesaian pinjaman.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                @include('pengembalian.tabel-antrian')
            </div>
        </div>
        @if ($daftarAntrian->hasPages())
            <div class="card-footer bg-white border-top p-3">
                {{ $daftarAntrian->links() }}
            </div>
        @endif
    </div>
@endsection

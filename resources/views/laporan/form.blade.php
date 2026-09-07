@extends('layouts.utama')

@section('judul', 'Cetak Laporan')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-printer text-primary me-2"></i>Pusat Cetak Laporan
            </h4>
            <p class="text-muted small mb-0">Generate dan unduh laporan transaksi peminjaman, pengembalian, dan ketersediaan stok dalam format PDF.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            @include('laporan.form-rpt-01')
        </div>
        <div class="col-md-4">
            @include('laporan.form-rpt-02')
        </div>
        <div class="col-md-4">
            @include('laporan.form-rpt-03')
        </div>
    </div>
@endsection

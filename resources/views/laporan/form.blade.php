@extends('layouts.utama')
@section('judul', 'Cetak Laporan')
@section('konten')
    <h4 class="mb-3">Cetak Laporan</h4>
    <div class="row g-3">
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

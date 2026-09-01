@extends('layouts.utama')
@section('judul', 'Log Aktivitas')
@section('konten')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Log Aktivitas</h4>
        <p class="text-muted mb-0 small">Riwayat seluruh aktivitas pengguna di sistem</p>
    </div>
    <div>
        <span class="badge bg-secondary fs-6">{{ $daftarLog->total() }} catatan</span>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-funnel me-2"></i>Filter Log</h6>
    </div>
    <div class="card-body">
        @include('log.form-search')
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            @include('log.tabel-log')
        </div>

        <div class="px-3 pb-3">
            {{ $daftarLog->links() }}
        </div>
    </div>
</div>

@endsection

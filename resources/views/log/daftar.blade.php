@extends('layouts.utama')

@section('judul', 'Log Aktivitas Sistem')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-shield-check text-primary me-2"></i>Log Aktivitas Sistem
            </h4>
            <p class="text-muted small mb-0">Catatan jejak audit aktivitas seluruh pengguna dan perubahan data di dalam sistem.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @include('log.form-search')

            <div class="table-responsive">
                @include('log.tabel-log')
            </div>

            <div class="mt-4">
                {{ $daftarLog->links() }}
            </div>
        </div>
    </div>
@endsection

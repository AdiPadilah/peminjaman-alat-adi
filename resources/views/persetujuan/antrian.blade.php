@extends('layouts.utama')

@section('judul', 'Antrian Pengajuan Peminjaman')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-clock-history text-primary me-2"></i>Antrian Persetujuan Peminjaman
            </h4>
            <p class="text-muted small mb-0">Tinjau dan proses permohonan peminjaman alat yang diajukan oleh siswa.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                @include('persetujuan.tabel-antrian')
            </div>
        </div>
        @if ($daftarPengajuan->hasPages())
            <div class="card-footer bg-white border-top p-3">
                {{ $daftarPengajuan->links() }}
            </div>
        @endif
    </div>
@endsection

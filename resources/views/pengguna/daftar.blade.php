@extends('layouts.utama')

@section('judul', 'Daftar Pengguna')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-people text-primary me-2"></i>Daftar Pengguna Sistem
            </h4>
            <p class="text-muted small mb-0">Kelola akun administrator, petugas laboratorium, dan siswa peminjam.</p>
        </div>
        <x-tombol-tambah href="{{ route('pengguna.create') }}" label="Tambah Pengguna Baru" />
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @include('pengguna.form-pencarian')

            @include('pengguna.table')

            <div class="mt-4">
                {{ $daftarPengguna->links() }}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.utama')

@section('judul', 'Pengaturan Sistem')

@section('konten')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-gear-fill text-primary me-2"></i>Pengaturan Sistem
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Konfigurasi informasi institusi, durasi peminjaman, dan besaran tarif denda.</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('pengaturan.perbarui') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input name="nama_sekolah" label="Nama Sekolah / Institusi"
                                :value="$pengaturan['nama_sekolah'] ?? ''" required />
                            <div class="form-text mt-1 text-muted">
                                <i class="bi bi-info-circle me-1"></i>Nama ini akan tercetak sebagai kop surat resmi pada seluruh berkas laporan PDF.
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input name="tarif_denda_harian" label="Tarif Denda Keterlambatan Harian (Rp)" type="number"
                                :value="$pengaturan['tarif_denda_harian'] ?? 0" min="0" step="500" required />
                            <div class="form-text mt-1 text-muted">
                                <i class="bi bi-info-circle me-1"></i>Dihitung per hari keterlambatan per unit alat. Berlaku otomatis saat proses verifikasi pengembalian.
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <x-input name="default_hari_pinjam" label="Durasi Peminjaman Standar (Hari)" type="number"
                                    :value="$pengaturan['default_hari_pinjam'] ?? 7" min="1" required />
                                <div class="form-text text-muted">Bawaan saat siswa mengajukan peminjaman baru.</div>
                            </div>
                            <div class="col-md-6">
                                <x-input name="maks_hari_pinjam" label="Batas Maksimal Peminjaman (Hari)" type="number"
                                    :value="$pengaturan['maks_hari_pinjam'] ?? 30" min="1" max="365" required />
                                <div class="form-text text-muted">Durasi maksimal yang diperbolehkan sistem.</div>
                            </div>
                        </div>

                        <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3 flex-shrink-0"></i>
                            <div class="small">
                                Perubahan tarif denda hanya berlaku untuk transaksi pengembalian yang diverifikasi <strong>setelah</strong> perubahan ini disimpan. Transaksi lama tidak dihitung ulang.
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                                <i class="bi bi-floppy me-1"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

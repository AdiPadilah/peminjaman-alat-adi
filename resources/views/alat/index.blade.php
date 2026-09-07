@extends('layouts.utama')

@section('judul', 'Daftar Alat')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-tools text-primary me-2"></i>Daftar Alat
            </h4>
            <p class="text-muted small mb-0">Kelola inventaris data alat laboratorium dan ketersediaan stok.</p>
        </div>
        <x-tombol-tambah :href="route('alat.create')" label="Tambah Alat Baru" />
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @include('alat.form-pencarian')

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 70px" class="text-center">Foto</th>
                            <th>Kode</th>
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th class="text-center">Total Stok</th>
                            <th class="text-center">Tersedia</th>
                            <th>Kondisi</th>
                            <th class="text-end pe-3" style="width: 170px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarAlat as $alat)
                            <tr>
                                <td class="text-center">
                                    @if ($alat->foto)
                                        <img src="{{ asset('gambar/alat/' . $alat->foto) }}" alt="{{ $alat->nama }}"
                                            class="rounded-3 shadow-sm" width="48" height="48" style="object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-3 d-inline-flex align-items-center justify-content-center text-muted" style="width: 48px; height: 48px;">
                                            <i class="bi bi-image text-secondary"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-soft-secondary font-monospace">{{ $alat->kode_alat }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $alat->nama }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-soft-primary">{{ $alat->kategori->nama ?? '-' }}</span>
                                </td>
                                <td class="text-center fw-semibold">{{ $alat->stok }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $alat->stok_tersedia > 0 ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                        {{ $alat->stok_tersedia }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-info text-capitalize">
                                        {{ str_replace('_', ' ', $alat->kondisi) }}
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <x-tombol-aksi
                                        :ubah="route('alat.edit', $alat)"
                                        :hapus="route('alat.destroy', $alat)"
                                        pesanHapus="Hapus data alat {{ $alat->nama }}?" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    Data alat tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $daftarAlat->links() }}
            </div>
        </div>
    </div>
@endsection

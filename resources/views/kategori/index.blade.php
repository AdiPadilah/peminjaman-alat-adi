@extends('layouts.utama')

@section('judul', 'Daftar Kategori')

@section('konten')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">
                <i class="bi bi-tags text-primary me-2"></i>Daftar Kategori Alat
            </h4>
            <p class="text-muted small mb-0">Kelola kategori pengelompokan alat praktikum laboratorium.</p>
        </div>
        <x-tombol-tambah :href="route('kategori.create')" label="Tambah Kategori Baru" />
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('kategori.index') }}" class="row g-2 mb-3">
                <x-form-pencarian :action="route('kategori.index')" placeholder="Cari nama kategori..." :kataKunci="$kataKunci" />
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 70px">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 140px">Jumlah Alat</th>
                            <th class="text-end pe-3" style="width: 160px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarKategori as $nomor => $kategori)
                            <tr>
                                <td class="text-muted">{{ $daftarKategori->firstItem() + $nomor }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $kategori->nama }}</div>
                                </td>
                                <td>{{ $kategori->deskripsi ?: '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-soft-primary">
                                        {{ $kategori->daftar_alat_count }} Alat
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <x-tombol-aksi
                                        :ubah="route('kategori.edit', $kategori)"
                                        :hapus="route('kategori.destroy', $kategori)"
                                        pesanHapus="Yakin ingin menghapus kategori {{ $kategori->nama }}?" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    Belum ada data kategori ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $daftarKategori->links() }}
            </div>
        </div>
    </div>
@endsection

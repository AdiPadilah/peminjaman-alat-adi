@extends('laporan.layout')
@section('judul', 'Rekapitulasi Stok Alat')
@section('isi')
    <table>
        <thead>
            <tr>
                <th style="width: 24px">No</th>
                <th>Kode</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th class="tengah">Stok</th>
                <th class="tengah">Tersedia</th>
                <th class="tengah">Dipinjam</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarAlat as $nomor => $alat)
                <tr>
                    <td class="tengah">{{ $nomor + 1 }}</td>
                    <td>{{ $alat->kode_alat }}</td>
                    <td>{{ $alat->nama }}</td>
                    <td>{{ $alat->kategori->nama }}</td>
                    <td class="tengah">{{ $alat->stok }}</td>
                    <td class="tengah">{{ $alat->stok_tersedia }}</td>
                    <td class="tengah">{{ $alat->stok - $alat->stok_tersedia }}</td>
                    <td>{{ str_replace('_', ' ', $alat->kondisi) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="ringkasan">
        <table>
            <tr>
                <th>Jenis Alat</th>
                <td class="kanan">{{ $daftarAlat->count() }}</td>
            </tr>
            <tr>
                <th>Total Unit</th>
                <td class="kanan">{{ $daftarAlat->sum('stok') }}</td>
            </tr>
            <tr>
                <th>Sedang Dipinjam</th>
                <td class="kanan">{{ $daftarAlat->sum('stok') - $daftarAlat->sum('stok_tersedia') }}</td>
            </tr>
        </table>
    </div>
@endsection

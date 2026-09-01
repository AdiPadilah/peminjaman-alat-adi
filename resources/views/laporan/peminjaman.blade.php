@extends('laporan.layout')
@section('judul', 'Laporan Peminjaman Alat')
@section('isi')
    <table>
        <thead>
            <tr>
                <th style="width: 24px">No</th>
                <th>Kode Pinjam</th>
                <th>Peminjam</th>
                <th>Tgl Pinjam</th>
                <th>Harus Kembali</th>
                <th>Alat yang Dipinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarPeminjaman as $nomor => $peminjaman)
                <tr>
                    <td class="tengah">{{ $nomor + 1 }}</td>
                    <td>{{ $peminjaman->kode_pinjam }}</td>
                    <td>{{ $peminjaman->peminjam->nama }}</td>
                    <td>{{ $peminjaman->tgl_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}</td>
                    <td>
                        @foreach ($peminjaman->detail as $baris)
                            {{ $baris->alat->nama }} ({{ $baris->jumlah }})@if (! $loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $peminjaman->status->label() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="tengah">Tidak ada data pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="ringkasan">
        <table>
            <tr>
                <th>Jumlah Transaksi</th>
                <td class="kanan">{{ $daftarPeminjaman->count() }}</td>
            </tr>
        </table>
    </div>
@endsection

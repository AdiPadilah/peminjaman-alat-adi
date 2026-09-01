@extends('laporan.layout')
@section('judul', 'Laporan Pengembalian dan Denda')
@section('isi')
    <table>
        <thead>
            <tr>
                <th style="width: 24px">No</th>
                <th>Kode Pinjam</th>
                <th>Peminjam</th>
                <th>Tgl Kembali</th>
                <th class="tengah">Terlambat</th>
                <th class="kanan">Denda Telat</th>
                <th class="kanan">Denda Rusak</th>
                <th class="kanan">Total Denda</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarPengembalian as $nomor => $pengembalian)
                <tr>
                    <td class="tengah">{{ $nomor + 1 }}</td>
                    <td>{{ $pengembalian->peminjaman->kode_pinjam }}</td>
                    <td>{{ $pengembalian->peminjaman->peminjam->nama }}</td>
                    <td>{{ $pengembalian->tgl_kembali->format('d/m/Y') }}</td>
                    <td class="tengah">{{ $pengembalian->hari_terlambat }} hari</td>
                    <td class="kanan">{{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                    <td class="kanan">{{ number_format($pengembalian->denda_kerusakan, 0, ',', '.') }}</td>
                    <td class="kanan">{{ number_format($pengembalian->total_denda, 0, ',', '.') }}</td>
                    <td>{{ $pengembalian->petugas->nama }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="tengah">Tidak ada data pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="ringkasan">
        <table>
            <tr>
                <th>Jumlah Transaksi</th>
                <td class="kanan">{{ $daftarPengembalian->count() }}</td>
            </tr>
            <tr>
                <th>Total Denda Terkumpul</th>
                <td class="kanan">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
@endsection

@extends('layouts.utama')

@section('judul', 'Pengaturan Sistem')

@section('konten')
    <h4 class="mb-3">Pengaturan Sistem</h4>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('pengaturan.simpan') }}">
                @csrf

                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 35%">Kunci</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPengaturan as $i => $pengaturan)
                            <tr>
                                <td>
                                    <input type="hidden"
                                           name="pengaturan[{{ $i }}][kunci]"
                                           value="{{ $pengaturan->kunci }}">
                                    <code>{{ $pengaturan->kunci }}</code>
                                    @php
                                        $label = match($pengaturan->kunci) {
                                            'tarif_denda_harian' => 'Tarif denda per hari (Rp)',
                                            'default_hari_pinjam' => 'Default jumlah hari peminjaman',
                                            'maks_hari_pinjam' => 'Maksimum hari peminjaman',
                                            'nama_sekolah' => 'Nama Sekolah',
                                            default => null,
                                        };
                                    @endphp
                                    @if ($label)
                                        <div class="small text-muted">{{ $label }}</div>
                                    @endif
                                </td>
                                <td>
                                    <input type="text"
                                           name="pengaturan[{{ $i }}][nilai]"
                                           value="{{ old("pengaturan.$i.nilai", $pengaturan->nilai) }}"
                                           class="form-control @error("pengaturan.$i.nilai") is-invalid @enderror">
                                    @error("pengaturan.$i.nilai")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

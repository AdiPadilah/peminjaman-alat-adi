@extends('layouts.utama')

@section('judul', $alat->exists ? 'Ubah Alat' : 'Tambah Alat')

@section('konten')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        {{ $alat->exists ? 'Ubah Data Alat' : 'Tambah Data Alat' }}
                    </h5>

                    <form method="POST"
                        action="{{ $alat->exists ? route('alat.update', $alat) : route('alat.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($alat->exists)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <x-input name="kode_alat" label="Kode Alat" :value="$alat->kode_alat" />
                            </div>
                            <div class="col-md-8">
                                <x-input name="nama" label="Nama Alat" :value="$alat->nama" />
                            </div>
                        </div>

                        <x-select
                            name="kategori_id"
                            label="Kategori"
                            :options="$daftarKategori->pluck('nama', 'id')->toArray()"
                            :selected="$alat->kategori_id"
                            placeholder="Pilih kategori" />

                        <div class="row">
                            <div class="col-md-4">
                                <x-input name="stok" label="Stok Total" :value="$alat->stok" type="number" min="0" />
                            </div>
                            <div class="col-md-4">
                                <x-input name="stok_tersedia" label="Stok Tersedia" :value="$alat->stok_tersedia" type="number" min="0" />
                            </div>
                            <div class="col-md-4">
                                <x-select
                                    name="kondisi"
                                    label="Kondisi"
                                    :options="['baik' => 'Baik', 'rusak_ringan' => 'Rusak Ringan', 'rusak_berat' => 'Rusak Berat']"
                                    :selected="$alat->kondisi"
                                    placeholder="Pilih kondisi" />
                            </div>
                        </div>

                        <x-textarea name="deskripsi" label="Deskripsi" :value="$alat->deskripsi" rows="3" />

                        @include('alat.input-foto')

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

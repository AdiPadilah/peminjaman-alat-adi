<form method="GET" action="{{ route('log.index') }}" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="user_id" class="form-select">
            <option value="">Semua Pengguna</option>
            @foreach ($daftarPengguna as $pengguna)
                <option value="{{ $pengguna->id }}" {{ $userId == $pengguna->id ? 'selected' : '' }}>
                    {{ $pengguna->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select name="aksi" class="form-select">
            <option value="">Semua Aksi</option>
            @foreach ($daftarAksi as $pilihanAksi)
                <option value="{{ $pilihanAksi }}" {{ $aksi == $pilihanAksi ? 'selected' : '' }}>
                    {{ str_replace('_', ' ', $pilihanAksi) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <input type="date" name="tgl_awal" class="form-control" value="{{ $tglAwal }}">
    </div>

    <div class="col-md-2">
        <input type="date" name="tgl_akhir" class="form-control" value="{{ $tglAkhir }}">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-outline-secondary">Saring</button>
        <a href="{{ route('log.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

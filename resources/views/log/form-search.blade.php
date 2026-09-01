<form method="GET" action="{{ route('log.index') }}" class="row g-2">
    <div class="col-md-3">
        <label class="form-label small fw-semibold text-muted mb-1">Pengguna</label>
        <select name="user_id" class="form-select form-select-sm">
            <option value="">Semua Pengguna</option>
            @foreach ($daftarPengguna as $pengguna)
                <option value="{{ $pengguna->id }}" {{ $userId == $pengguna->id ? 'selected' : '' }}>
                    {{ $pengguna->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label small fw-semibold text-muted mb-1">Jenis Aksi</label>
        <select name="aksi" class="form-select form-select-sm">
            <option value="">Semua Aksi</option>
            @foreach ($daftarAksi as $pilihanAksi)
                <option value="{{ $pilihanAksi }}" {{ $aksi == $pilihanAksi ? 'selected' : '' }}>
                    {{ ucwords(str_replace('_', ' ', $pilihanAksi)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label small fw-semibold text-muted mb-1">Tanggal Awal</label>
        <input type="date" name="tgl_awal" class="form-control form-control-sm" value="{{ $tglAwal }}">
    </div>

    <div class="col-md-2">
        <label class="form-label small fw-semibold text-muted mb-1">Tanggal Akhir</label>
        <input type="date" name="tgl_akhir" class="form-control form-control-sm" value="{{ $tglAkhir }}">
    </div>

    <div class="col-md-auto d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary btn-sm px-3">
            <i class="bi bi-search me-1"></i>Saring
        </button>
        <a href="{{ route('log.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="bi bi-x-circle me-1"></i>Reset
        </a>
    </div>
</form>

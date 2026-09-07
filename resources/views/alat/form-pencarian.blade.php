<form method="GET" action="{{ route('alat.index') }}" class="row g-2 mb-3 align-items-center">
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-muted">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" name="cari" class="form-control border-start-0 ps-0" placeholder="Cari nama atau kode alat..." value="{{ $kataKunci }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-muted">
                <i class="bi bi-funnel"></i>
            </span>
            <select name="kategori_id" class="form-select border-start-0 ps-0">
                <option value="">Semua Kategori</option>
                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategoriId == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-auto d-flex gap-1">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-funnel me-1"></i> Saring
        </button>
        <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
        </a>
    </div>
</form>

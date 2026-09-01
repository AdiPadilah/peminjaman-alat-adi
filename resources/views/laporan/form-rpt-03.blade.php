<div class="card h-100">
    <div class="card-header">RPT-03 · Rekapitulasi Stok Alat</div>
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.stok') }}" target="_blank">
            <div class="mb-3">
                <label class="form-label small">Kategori</label>
                <select name="kategori_id" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    @foreach ($daftarKategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cetak PDF</button>
        </form>
    </div>
</div>

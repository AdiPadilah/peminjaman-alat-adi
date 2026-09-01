<div class="card h-100">
    <div class="card-header">RPT-01 · Laporan Peminjaman</div>
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.peminjaman') }}" target="_blank">
            <div class="mb-2">
                <label class="form-label small">Tanggal Awal</label>
                <input type="date" name="tgl_awal" class="form-control form-control-sm"
                    value="{{ now()->startOfMonth()->toDateString() }}" required>
            </div>
            <div class="mb-2">
                <label class="form-label small">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" class="form-control form-control-sm"
                    value="{{ now()->toDateString() }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach (\App\Enums\StatusPeminjaman::cases() as $status)
                        <option value="{{ $status->value }}">{{ $status->label() }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cetak PDF</button>
        </form>
    </div>
</div>

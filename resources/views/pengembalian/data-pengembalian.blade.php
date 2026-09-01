<div class="card">
    <div class="card-header">Data Pengembalian</div>
    <div class="card-body">
        <dl class="row small mb-3">
            <dt class="col-6">Peminjam</dt>
            <dd class="col-6">{{ $peminjaman->peminjam->nama }}</dd>

            <dt class="col-6">Harus Kembali</dt>
            <dd class="col-6">{{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}</dd>

            <dt class="col-6">Diajukan Kembali</dt>
            <dd class="col-6">{{ $peminjaman->tgl_diajukan_kembali?->format('d/m/Y') ?? '-' }}</dd>
        </dl>

        <div class="form-text mb-2">
            Perubahan tanggal akan tercatat di log aktivitas.
        </div>

        <x-input label="Tanggal Kembali" name="tgl_kembali" type="date"
                 :value="old('tgl_kembali', $peminjaman->tgl_diajukan_kembali?->toDateString() ?? now()->toDateString())" required />

        <div class="form-text mb-2">
            Denda keterlambatan dihitung sistem, tidak perlu diisi di sini.
        </div>

        <x-input label="Denda Kerusakan" name="denda_kerusakan" type="number"
                 :value="old('denda_kerusakan', 0)" min="0" step="1000" />

        <x-textarea label="Catatan" name="catatan" rows="3" :value="old('catatan')" />

        <button type="submit" class="btn btn-success w-100">
            Simpan Verifikasi
        </button>
    </div>
</div>

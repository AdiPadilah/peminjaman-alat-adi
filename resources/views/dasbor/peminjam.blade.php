@extends('layouts.utama')

@section('judul', 'Dasbor Siswa')

@section('konten')

    {{-- 1. Student Search & Greeting Hub --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0 !important;">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: #eff6ff; color: #3b82f6; font-size: 0.8rem; font-weight: 600;">
                        <i class="bi bi-mortarboard-fill"></i>
                        <span>Portal Siswa</span>
                    </div>
                    <h2 class="fw-bold text-dark mb-2" style="font-size: 1.85rem; letter-spacing: -0.5px;">
                        Halo, {{ auth()->user()->nama }}! 👋
                    </h2>
                    <p class="text-secondary mb-4" style="font-size: 0.95rem;">
                        Perlu alat untuk praktikum atau tugas lab? Cari langsung alat yang tersedia di bawah ini.
                    </p>

                    {{-- Direct Catalog Search Bar --}}
                    <form action="{{ route('katalog.daftar') }}" method="GET">
                        <div class="input-group p-1" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px;">
                            <span class="input-group-text bg-transparent border-0 ps-3 text-muted">
                                <i class="bi bi-search fs-5"></i>
                            </span>
                            <input type="text"
                                   name="cari"
                                   class="form-control bg-transparent border-0 shadow-none ps-2"
                                   placeholder="Ketik nama alat, misal: Osiloskop, Multimeter, Solder..."
                                   style="font-size: 0.95rem;">
                            <button type="submit" class="btn btn-primary px-4 fw-semibold" style="border-radius: 10px; background: #4f46e5; border: none;">
                                Cari
                            </button>
                        </div>
                    </form>

                    {{-- Category Quick Chips --}}
                    @if(isset($kategoriList) && $kategoriList->count() > 0)
                        <div class="d-flex align-items-center gap-2 mt-3 flex-wrap">
                            <span class="text-muted small fw-medium">Kategori:</span>
                            <a href="{{ route('katalog.daftar') }}" class="badge rounded-pill text-decoration-none px-3 py-2" style="background: #f1f5f9; color: #475569; font-weight: 500;">
                                Semua
                            </a>
                            @foreach($kategoriList as $kat)
                                <a href="{{ route('katalog.daftar', ['kategori_id' => $kat->id]) }}"
                                   class="badge rounded-pill text-decoration-none px-3 py-2"
                                   style="background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; font-weight: 500;">
                                    {{ $kat->nama }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Quick Nav Cards on the Right --}}
                <div class="col-lg-5">
                    <div class="p-4 rounded-4" style="background: #f8fafc; border: 1px solid #edf2f7;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold text-dark" style="font-size: 0.95rem;">Akses Cepat</span>
                            <span class="text-muted small">{{ now()->translatedFormat('l, d M Y') }}</span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('katalog.daftar') }}" class="btn btn-white text-start d-flex align-items-center justify-content-between p-3 border shadow-xs" style="background: #fff; border-radius: 12px; border-color: #e2e8f0 !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #eef2ff; color: #4f46e5;">
                                        <i class="bi bi-grid-fill"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark" style="font-size: 0.9rem;">Katalog Lengkap</div>
                                        <div class="text-muted" style="font-size: 0.78rem;">Jelajahi seluruh koleksi alat</div>
                                    </div>
                                </div>
                                <i class="bi bi-arrow-right text-muted"></i>
                            </a>

                            <a href="{{ route('katalog.keranjang') }}" class="btn btn-white text-start d-flex align-items-center justify-content-between p-3 border shadow-xs" style="background: #fff; border-radius: 12px; border-color: #e2e8f0 !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #fef3c7; color: #d97706;">
                                        <i class="bi bi-cart3"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark" style="font-size: 0.9rem;">Keranjang Pengajuan</div>
                                        <div class="text-muted" style="font-size: 0.78rem;">
                                            {{ $totalKeranjang > 0 ? $totalKeranjang . ' alat menunggu diajukan' : 'Belum ada alat di keranjang' }}
                                        </div>
                                    </div>
                                </div>
                                @if($totalKeranjang > 0)
                                    <span class="badge rounded-pill bg-warning text-dark">{{ $totalKeranjang }}</span>
                                @else
                                    <i class="bi bi-arrow-right text-muted"></i>
                                @endif
                            </a>

                            <a href="{{ route('peminjaman.saya') }}" class="btn btn-white text-start d-flex align-items-center justify-content-between p-3 border shadow-xs" style="background: #fff; border-radius: 12px; border-color: #e2e8f0 !important;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #ecfdf5; color: #059669;">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark" style="font-size: 0.9rem;">Semua Pinjaman Saya</div>
                                        <div class="text-muted" style="font-size: 0.78rem;">Riwayat & status lengkap</div>
                                    </div>
                                </div>
                                <i class="bi bi-arrow-right text-muted"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Minimalist Metric Overview --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: #ffffff; border: 1px solid #e2e8f0 !important;">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px; background: #eef2ff; color: #4f46e5; font-size: 1.4rem;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-secondary small fw-medium">Sedang Dipinjam</div>
                        <div class="d-flex align-items-baseline gap-2">
                            <span class="fw-bold text-dark fs-3">{{ $sedangDipinjam }}</span>
                            <span class="text-muted small">transaksi aktif</span>
                        </div>
                    </div>
                    @if($sedangDipinjam > 0)
                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-2 py-1" style="font-size: 0.75rem;">
                            Aktif
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: #ffffff; border: 1px solid #e2e8f0 !important;">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px; background: #fffbeb; color: #d97706; font-size: 1.4rem;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-secondary small fw-medium">Menunggu Persetujuan</div>
                        <div class="d-flex align-items-baseline gap-2">
                            <span class="fw-bold text-dark fs-3">{{ $menungguPersetujuan }}</span>
                            <span class="text-muted small">dalam antrean</span>
                        </div>
                    </div>
                    @if($menungguPersetujuan > 0)
                        <span class="badge rounded-pill bg-warning bg-opacity-15 text-warning px-2 py-1" style="font-size: 0.75rem;">
                            Diproses
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: #ffffff; border: 1px solid #e2e8f0 !important;">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px; background: #ecfdf5; color: #059669; font-size: 1.4rem;">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-secondary small fw-medium">Riwayat Selesai</div>
                        <div class="d-flex align-items-baseline gap-2">
                            <span class="fw-bold text-dark fs-3">{{ $riwayatSelesai }}</span>
                            <span class="text-muted small">berhasil dikembalikan</span>
                        </div>
                    </div>
                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-2 py-1" style="font-size: 0.75rem;">
                        Selesai
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Pinjaman Sedang Aktif (Highlight Card) --}}
    @if(isset($pinjamanAktif) && $pinjamanAktif->count() > 0)
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 18px; border: 1px solid #e2e8f0 !important;">
            <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center" style="border-radius: 18px 18px 0 0; border-bottom: 1px solid #f1f5f9 !important;">
                <div class="d-flex align-items-center gap-2">
                    <span class="p-2 rounded-3" style="background: #e0e7ff; color: #4338ca;">
                        <i class="bi bi-bell-fill"></i>
                    </span>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Pinjaman yang Sedang Berjalan</h6>
                        <span class="text-muted small">Alat yang sedang berada di tanganmu atau sedang menunggu verifikasi</span>
                    </div>
                </div>
                <a href="{{ route('peminjaman.saya') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    Kelola Semua
                </a>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    @foreach($pinjamanAktif as $item)
                        <div class="col-md-6 col-xl-4">
                            <div class="p-3 rounded-4 h-100 d-flex flex-column justify-content-between" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="fw-bold text-dark font-monospace" style="font-size: 0.88rem;">{{ $item->kode_pinjam }}</span>
                                        <span class="badge rounded-pill bg-{{ $item->status->warna() }} bg-opacity-15 text-{{ $item->status->warna() }}" style="font-size: 0.72rem; padding: 4px 8px;">
                                            {{ $item->status->label() }}
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <div class="text-muted small mb-1">Daftar Alat:</div>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($item->detail as $dt)
                                                <span class="badge text-dark bg-white border" style="font-size: 0.75rem; font-weight: 500;">
                                                    {{ $dt->alat->nama ?? 'Alat' }} ({{ $dt->jumlah }})
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                                    <div class="small">
                                        <span class="text-muted">Batas:</span>
                                        <span class="fw-semibold {{ $item->lewatTenggat() ? 'text-danger' : 'text-dark' }}">
                                            {{ $item->tgl_harus_kembali?->format('d M Y') ?? '-' }}
                                        </span>
                                        @if($item->lewatTenggat())
                                            <span class="badge bg-danger ms-1" style="font-size: 0.65rem;">Terlambat</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('peminjaman.rincian', $item) }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1" style="font-size: 0.78rem; background: #4f46e5; border: none;">
                                        Rincian
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- 4. Rekomendasi Alat Siap Pinjam (Direct Discovery) --}}
    @if(isset($alatTersedia) && $alatTersedia->count() > 0)
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-0">Alat Praktikum Siap Pinjam</h5>
                <p class="text-muted small mb-0">Alat yang stoknya tersedia di laboratorium hari ini</p>
            </div>
            <a href="{{ route('katalog.daftar') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                Lihat Semua Alat <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3 mb-4">
            @foreach($alatTersedia as $alat)
                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; border: 1px solid #e2e8f0 !important; transition: transform 0.15s ease, box-shadow 0.15s ease;">
                        <div class="position-relative" style="height: 120px; background: #f8fafc; border-radius: 16px 16px 0 0; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            @if($alat->foto)
                                <img src="{{ asset('gambar/alat/' . $alat->foto) }}" alt="{{ $alat->nama }}" style="max-width: 90%; max-height: 100px; width: auto; height: auto; object-fit: contain; display: block;">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-tools fs-2 opacity-50"></i>
                                </div>
                            @endif
                            {{-- Badges overlay --}}
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-white text-dark shadow-sm border" style="font-size: 0.7rem;">
                                    {{ $alat->kategori->nama ?? 'Umum' }}
                                </span>
                            </div>
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-success text-white" style="font-size: 0.7rem;">
                                    {{ $alat->stok_tersedia }} unit
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-3 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $alat->nama }}" style="font-size: 0.92rem;">
                                    {{ $alat->nama }}
                                </h6>
                                <p class="text-muted small mb-3 text-truncate-2" style="font-size: 0.78rem; min-height: 2.2em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $alat->deskripsi ?? 'Alat penunjang kegiatan praktikum laboratorium.' }}
                                </p>
                            </div>

                            <a href="{{ route('katalog.daftar', ['cari' => $alat->nama]) }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill fw-medium" style="font-size: 0.8rem;">
                                <i class="bi bi-cart-plus me-1"></i> Ajukan Pinjam
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- 5. Riwayat Pinjaman Terakhir Table --}}
    <div class="card border-0 shadow-sm" style="border-radius: 18px; border: 1px solid #e2e8f0 !important;">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center" style="border-radius: 18px 18px 0 0; border-bottom: 1px solid #f1f5f9 !important;">
            <div class="d-flex align-items-center gap-2">
                <span class="p-2 rounded-3" style="background: #f1f5f9; color: #475569;">
                    <i class="bi bi-journal-text"></i>
                </span>
                <div>
                    <h6 class="mb-0 fw-bold text-dark">Riwayat Pengajuan Peminjaman</h6>
                    <span class="text-muted small">5 transaksi peminjaman terakhirmu</span>
                </div>
            </div>
            <a href="{{ route('peminjaman.saya') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                Lihat Semua
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead style="background: #f8fafc;">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-semibold">KODE PINJAM</th>
                            <th class="py-3 text-secondary small fw-semibold">TGL AJUKAN</th>
                            <th class="py-3 text-secondary small fw-semibold">BATAS PENGEMBALIAN</th>
                            <th class="py-3 text-secondary small fw-semibold">STATUS</th>
                            <th class="py-3 text-secondary small fw-semibold text-end pe-4">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pinjamanTerbaru as $pinjam)
                            <tr style="border-top: 1px solid #f1f5f9;">
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace" style="font-size: 0.85rem;">
                                        {{ $pinjam->kode_pinjam }}
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    {{ $pinjam->tgl_pinjam?->format('d/m/Y') ?? '-' }}
                                </td>
                                <td class="small">
                                    <span class="fw-medium text-dark">{{ $pinjam->tgl_harus_kembali?->format('d/m/Y') ?? '-' }}</span>
                                    @if ($pinjam->lewatTenggat())
                                        <span class="badge bg-danger ms-1" style="font-size: 0.68rem;">Terlambat</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ $pinjam->status->warna() }} bg-opacity-15 text-{{ $pinjam->status->warna() }}" style="font-size: 0.75rem; padding: 5px 10px;">
                                        {{ $pinjam->status->label() }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('peminjaman.rincian', $pinjam) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                                        <i class="bi bi-eye me-1"></i> Rincian
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; background: #f1f5f9; color: #94a3b8;">
                                        <i class="bi bi-inbox fs-3"></i>
                                    </div>
                                    <div class="fw-semibold text-dark mb-1">Belum ada data peminjaman</div>
                                    <p class="text-muted small mb-3">Mulai ajukan peminjaman pertama kamu melalui katalog alat.</p>
                                    <a href="{{ route('katalog.daftar') }}" class="btn btn-sm btn-primary rounded-pill px-4" style="background: #4f46e5; border: none;">
                                        <i class="bi bi-search me-1"></i> Buka Katalog Alat
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

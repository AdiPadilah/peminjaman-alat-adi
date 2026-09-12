<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="brand-logo-animated" style="width: 34px; height: 34px; border-radius: 8px; object-fit: cover;">
            <div>
                <div>PinjamAlat</div>
            </div>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama" aria-controls="menuUtama" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- Dasbor --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('*.dasbor') || request()->routeIs('dasbor') ? 'active' : '' }}"
                           href="{{ route('dasbor') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dasbor
                        </a>
                    </li>
                @endauth

                {{-- Master Data (Dropdown for Admin) --}}
                @if (auth()->check() && (auth()->user()->can('kategori.kelola') || auth()->user()->can('alat.kelola') || auth()->user()->can('user.kelola')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('kategori.*') || request()->routeIs('alat.*') || request()->routeIs('pengguna.*') ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-database me-1"></i> Master Data
                        </a>
                        <ul class="dropdown-menu">
                            @can('kategori.kelola')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                                       href="{{ route('kategori.index') }}">
                                        <i class="bi bi-tags"></i> Kategori Alat
                                    </a>
                                </li>
                            @endcan
                            @can('alat.kelola')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('alat.*') ? 'active' : '' }}"
                                       href="{{ route('alat.index') }}">
                                        <i class="bi bi-tools"></i> Data Alat
                                    </a>
                                </li>
                            @endcan
                            @can('user.kelola')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('pengguna.*') ? 'active' : '' }}"
                                       href="{{ route('pengguna.index') }}">
                                        <i class="bi bi-people"></i> Data Pengguna
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                {{-- Transaksi Peminjaman & Verifikasi (Petugas) --}}
                @if (auth()->check() && (auth()->user()->can('peminjaman.setujui') || auth()->user()->can('pengembalian.pantau')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('persetujuan.*') || request()->routeIs('pengembalian.*') ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-arrow-left-right me-1"></i> Sirkulasi
                        </a>
                        <ul class="dropdown-menu">
                            @can('peminjaman.setujui')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('persetujuan.*') ? 'active' : '' }}"
                                       href="{{ route('persetujuan.antrian') }}">
                                        <i class="bi bi-clock-history"></i> Antrian Persetujuan
                                    </a>
                                </li>
                            @endcan
                            @can('pengembalian.pantau')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('pengembalian.pantau') ? 'active' : '' }}"
                                       href="{{ route('pengembalian.pantau') }}">
                                        <i class="bi bi-eye"></i> Pemantauan Pinjaman
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('pengembalian.antrian') || request()->routeIs('pengembalian.verifikasi') ? 'active' : '' }}"
                                       href="{{ route('pengembalian.antrian') }}">
                                        <i class="bi bi-check2-circle"></i> Verifikasi Pengembalian
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                {{-- Menu Peminjam / Siswa --}}
                @can('alat.lihat')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('katalog.daftar') ? 'active' : '' }}"
                           href="{{ route('katalog.daftar') }}">
                            <i class="bi bi-grid-3x3-gap me-1"></i> Katalog Alat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('katalog.keranjang') ? 'active' : '' }}"
                           href="{{ route('katalog.keranjang') }}">
                            <i class="bi bi-cart3 me-1"></i> Keranjang
                            @if (count(session('keranjang', [])) > 0)
                                <span class="badge bg-warning text-dark ms-1">
                                    {{ count(session('keranjang', [])) }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}"
                           href="{{ route('peminjaman.saya') }}">
                            <i class="bi bi-journal-bookmark me-1"></i> Pinjaman Saya
                        </a>
                    </li>
                @endcan

                {{-- Koreksi Data --}}
                @if (auth()->check() && (auth()->user()->can('peminjaman.kelola') || auth()->user()->can('pengembalian.kelola')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('koreksi.*') ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-pencil-square me-1"></i> Koreksi
                        </a>
                        <ul class="dropdown-menu">
                            @can('peminjaman.kelola')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('koreksi.peminjaman.*') ? 'active' : '' }}"
                                       href="{{ route('koreksi.peminjaman.daftar') }}">
                                        <i class="bi bi-journal-text"></i> Data Peminjaman
                                    </a>
                                </li>
                            @endcan
                            @can('pengembalian.kelola')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('koreksi.pengembalian.*') ? 'active' : '' }}"
                                       href="{{ route('koreksi.pengembalian.daftar') }}">
                                        <i class="bi bi-journal-check"></i> Data Pengembalian
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                {{-- Laporan & Log --}}
                @if (auth()->check() && (auth()->user()->can('laporan.cetak') || auth()->user()->can('log.lihat')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('laporan.*') || request()->routeIs('log.*') ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark-bar-graph me-1"></i> Laporan & Log
                        </a>
                        <ul class="dropdown-menu">
                            @can('laporan.cetak')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}"
                                       href="{{ route('laporan.form') }}">
                                        <i class="bi bi-printer"></i> Cetak Laporan
                                    </a>
                                </li>
                            @endcan
                            @can('log.lihat')
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('log.*') ? 'active' : '' }}"
                                       href="{{ route('log.index') }}">
                                        <i class="bi bi-shield-check"></i> Log Aktivitas
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                {{-- Pengaturan Sistem --}}
                @can('pengaturan.kelola')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}"
                           href="{{ route('pengaturan.form') }}">
                            <i class="bi bi-gear me-1"></i> Pengaturan
                        </a>
                    </li>
                @endcan
            </ul>

            {{-- Profil & Logout --}}
            @auth
                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <a class="text-decoration-none d-flex align-items-center gap-2 text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">
                                {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                            </div>
                            <div class="d-none d-sm-block text-start">
                                <div class="fw-semibold text-white small lh-1">{{ auth()->user()->nama }}</div>
                                <span class="badge badge-soft-info" style="font-size: 0.65rem; padding: 0.15rem 0.45rem;">
                                    {{ ucfirst(auth()->user()->roles->first()?->name ?? 'User') }}
                                </span>
                            </div>
                            <i class="bi bi-chevron-down text-secondary small ms-1"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li class="px-3 py-2 border-bottom border-secondary-subtle mb-1">
                                <div class="small fw-semibold text-white">{{ auth()->user()->nama }}</div>
                                <div class="small text-secondary">{{ auth()->user()->email }}</div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right text-danger"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PinjamAlat - Sistem Peminjaman Alat Laboratorium Terpadu</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Modern Styling -->
    <link href="{{ asset('css/app-custom.css') }}" rel="stylesheet">
</head>

<body style="background-color: #f8fafc; color: #1e293b; overflow-x: hidden;">

    {{-- Floating Glass Navbar --}}
    <nav class="landing-navbar-floating">
        <div class="landing-nav-inner">
            <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center gap-2 text-white">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="width: 34px; height: 34px; border-radius: 8px; object-fit: cover;">
                <span class="fw-bold fs-6">PinjamAlat</span>
            </a>

            <div class="d-none d-md-flex align-items-center gap-3 ms-auto">
                <a href="#alur" class="nav-link text-white-50 px-2 py-1 small fw-medium text-hover-white">Alur Peminjaman</a>
                <a href="#fitur" class="nav-link text-white-50 px-2 py-1 small fw-medium text-hover-white">Fitur Unggulan</a>
                <a href="#katalog" class="nav-link text-white-50 px-2 py-1 small fw-medium text-hover-white">Katalog Alat</a>
                <a href="#faq" class="nav-link text-white-50 px-2 py-1 small fw-medium text-hover-white">FAQ</a>
            </div>

            <div class="ms-auto ms-md-0">
                @auth
                    <a href="{{ route('dasbor') }}" class="btn btn-sm btn-primary px-3 shadow-sm" style="border-radius: 9999px;">
                        <i class="bi bi-speedometer2 me-1"></i> Buka Dasbor
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary px-3 shadow-sm" style="border-radius: 9999px;">
                        <span>Masuk ke Portal</span>
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="landing-hero text-center">
        <div class="container position-relative" style="z-index: 2;">
            <div class="hero-pill-tag">
                <i class="bi bi-stars text-warning"></i>
                <span>Sistem Peminjaman Alat Laboratorium Digital</span>
            </div>

            <h1 class="hero-title-main">
                Pinjam Perlengkapan Praktikum <br>
                <span class="gradient-text">Cepat, Akurat & Tanpa Antri</span>
            </h1>

            <p class="hero-subtitle-main">
                Platform digital mandiri untuk mempermudah siswa mengecek ketersediaan alat praktikum secara real-time, mengajukan peminjaman online, dan membantu petugas mengelola sirkulasi tanpa kertas.
            </p>

            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-5">
                <a href="{{ route('login') }}" class="btn btn-primary px-4 py-3 fw-bold shadow-lg" style="border-radius: 12px; font-size: 1rem;">
                    <span>Mulai Peminjaman Sekarang</span>
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>
                <a href="#alur" class="btn btn-outline-light px-4 py-3 fw-semibold" style="border-radius: 12px; font-size: 1rem;">
                    <i class="bi bi-play-circle me-1"></i> Pelajari Cara Kerja
                </a>
            </div>

            {{-- Stat Counters --}}
            <div class="row g-3 justify-content-center max-w-4xl mx-auto pt-3 border-top border-white border-opacity-10">
                <div class="col-4 col-md-3">
                    <div class="text-white fw-bold fs-3 mb-0">{{ $totalAlat ?? '50+' }}</div>
                    <div class="text-white-50 small">Alat Praktikum Terdaftar</div>
                </div>
                <div class="col-4 col-md-3">
                    <div class="text-white fw-bold fs-3 mb-0">100%</div>
                    <div class="text-white-50 small">Paperless & Digital</div>
                </div>
                <div class="col-4 col-md-3">
                    <div class="text-white fw-bold fs-3 mb-0">&lt; 2 Mnt</div>
                    <div class="text-white-50 small">Waktu Pengajuan</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Interactive 4-Step Borrowing Flow --}}
    <section id="alur" class="py-5 bg-white border-bottom">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge badge-soft-primary px-3 py-2 mb-2">Langkah Mudah</span>
                <h2 class="fw-bold text-dark">Alur Peminjaman Alat Laboratorium</h2>
                <p class="text-muted">Empat tahapan praktis mulai dari pemilihan alat hingga pengembalian tepat waktu.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 16px; background: #f8fafc;">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem; font-weight: 700;">
                            1
                        </div>
                        <h5 class="fw-bold text-dark mb-2">1. Pilih Alat</h5>
                        <p class="text-muted small mb-0">Jelajahi katalog laboratorium, cek jumlah unit yang tersedia, dan tambahkan alat ke keranjang Anda.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 16px; background: #f8fafc;">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem; font-weight: 700;">
                            2
                        </div>
                        <h5 class="fw-bold text-dark mb-2">2. Isi Formulir</h5>
                        <p class="text-muted small mb-0">Masukkan tujuan praktikum, durasi hari peminjaman, lalu kirimkan pengajuan secara langsung.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 16px; background: #f8fafc;">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem; font-weight: 700;">
                            3
                        </div>
                        <h5 class="fw-bold text-dark mb-2">3. Persetujuan Petugas</h5>
                        <p class="text-muted small mb-0">Petugas laboratorium meninjau pengajuan dan memberikan persetujuan digital via sistem.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 16px; background: #f8fafc;">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 50px; height: 50px; font-size: 1.25rem; font-weight: 700;">
                            4
                        </div>
                        <h5 class="fw-bold text-dark mb-2">4. Ambil & Kembalikan</h5>
                        <p class="text-muted small mb-0">Ambil peralatan di lab praktikum, gunakan dengan bijak, dan kembalikan tepat waktu tanpa denda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bento Grid Fitur Unggulan --}}
    <section id="fitur" class="py-5" style="background-color: #f8fafc;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge badge-soft-info px-3 py-2 mb-2">Keunggulan Sistem</span>
                <h2 class="fw-bold text-dark">Teknologi Pengelolaan Cerdas</h2>
                <p class="text-muted">Dirancang khusus untuk kebutuhan laboratorium sekolah modern.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="bento-card">
                        <div class="bento-icon-wrapper bg-primary-subtle text-primary">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Sinkronisasi Stok Otomatis</h4>
                        <p class="text-muted">
                            Ketersediaan alat terpotong otomatis saat disetujui petugas dan bertambah kembali setelah diverifikasi. Menghilangkan risiko dobel peminjaman alat yang sama.
                        </p>
                        <div class="mt-auto pt-3">
                            <span class="badge badge-soft-success">Akurat & Terjadwal</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="bento-card">
                        <div class="bento-icon-wrapper bg-warning-subtle text-warning">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Transparansi Denda Keterlambatan</h4>
                        <p class="text-muted">
                            Sistem menghitung otomatis denda per hari keterlambatan sesuai regulasi sekolah, dengan pelacakan waktu yang transparan bagi peminjam dan petugas.
                        </p>
                        <div class="mt-auto pt-3">
                            <span class="badge badge-soft-warning">Kalkulasi Otomatis</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div class="bento-icon-wrapper bg-info-subtle text-info">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Laporan Resmi PDF</h5>
                        <p class="text-muted small">
                            Cetak rekapitulasi data peminjaman, pengembalian, dan ketersediaan stok lengkap dengan kop surat sekolah.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div class="bento-icon-wrapper bg-success-subtle text-success">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Jejak Audit Aktivitas</h5>
                        <p class="text-muted small">
                            Seluruh riwayat persetujuan, penolakan, dan koreksi data tercatat secara akurat di log aktivitas sistem.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div class="bento-icon-wrapper bg-danger-subtle text-danger">
                            <i class="bi bi-camera"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Dokumentasi Foto Fisik</h5>
                        <p class="text-muted small">
                            Mendukung unggah foto alat dan foto kondisi saat pengembalian untuk memastikan alat tetap dalam kondisi prima.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pratinjau Alat Terpopuler --}}
    @if (isset($alatPopuler) && $alatPopuler->isNotEmpty())
        <section id="katalog" class="py-5 bg-white border-top border-bottom">
            <div class="container py-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-4">
                    <div>
                        <span class="badge badge-soft-primary px-3 py-2 mb-2">Koleksi Terpopuler</span>
                        <h2 class="fw-bold text-dark mb-0">Alat Laboratorium Siap Pakai</h2>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                        <span>Lihat Seluruh Katalog</span>
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach ($alatPopuler as $alat)
                        <div class="col-sm-6 col-lg-4">
                            <div class="product-card">
                                <div class="product-image-container">
                                    @if ($alat->foto)
                                        <img src="{{ asset('gambar/alat/' . $alat->foto) }}" alt="{{ $alat->nama }}" loading="lazy">
                                    @else
                                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                            <i class="bi bi-tools fs-1 mb-1 opacity-50"></i>
                                            <span class="small">Tanpa Foto</span>
                                        </div>
                                    @endif

                                    <div class="product-badge-float">
                                        <span class="badge badge-soft-success">
                                            <i class="bi bi-check-circle me-1"></i>{{ $alat->stok_tersedia }} Tersedia
                                        </span>
                                    </div>
                                </div>

                                <div class="product-body">
                                    <span class="badge badge-soft-primary small mb-2 align-self-start">
                                        {{ $alat->kategori->nama ?? 'Umum' }}
                                    </span>
                                    <h6 class="fw-bold text-dark mb-1">{{ $alat->nama }}</h6>
                                    <div class="small text-muted mb-3">
                                        <i class="bi bi-upc me-1"></i>{{ $alat->kode_alat }} &middot; Kondisi: {{ ucfirst(str_replace('_', ' ', $alat->kondisi)) }}
                                    </div>

                                    <div class="mt-auto pt-2 border-top">
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary w-100">
                                            <i class="bi bi-cart-plus me-1"></i> Pinjam Alat Ini
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- FAQ Section --}}
    <section id="faq" class="py-5" style="background-color: #f8fafc;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge badge-soft-secondary px-3 py-2 mb-2">Tanya Jawab</span>
                <h2 class="fw-bold text-dark">Pertanyaan yang Sering Diajukan</h2>
                <p class="text-muted">Informasi seputar penggunaan sistem dan aturan peminjaman.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion border-0 shadow-sm rounded-4 overflow-hidden" id="faqAccordion">
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Siapa saja yang dapat meminjam alat praktikum?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Seluruh siswa dan guru yang telah memiliki akun terdaftar di sistem dapat memilih alat di katalog dan mengajukan permohonan pinjam secara mandiri.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Berapa lama batas maksimal waktu peminjaman?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Durasi standar adalah 7 hari kalender dan maksimal 30 hari tergantung ketentuan pihak laboratorium sekolah.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Bagaimana jika alat dikembalikan terlambat?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Keterlambatan akan dikenakan denda harian per unit alat sesuai aturan yang dikonfigurasi pada pengaturan sistem sekolah.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Final Banner --}}
    <section class="py-5" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white;">
        <div class="container text-center py-4">
            <h2 class="fw-bold mb-3">Siap Memulai Praktikum Hari Ini?</h2>
            <p class="text-white-50 max-w-2xl mx-auto mb-4" style="font-size: 1.05rem;">
                Masuk ke portal dengan akun Anda, jelajahi katalog lengkap, dan ajukan peminjaman dalam hitungan detik.
            </p>
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-3 fw-bold shadow-lg" style="border-radius: 12px; font-size: 1rem;">
                <span>Masuk ke Portal Peminjaman</span>
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-4 bg-white border-top">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 text-muted small">
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-semibold text-dark">PinjamAlat</span>
                    <span>&copy; {{ date('Y') }} &middot; Sistem Manajemen Inventaris Laboratorium</span>
                </div>
                <div>
                    <span>Dibuat untuk praktikum yang tertib & terorganisir</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

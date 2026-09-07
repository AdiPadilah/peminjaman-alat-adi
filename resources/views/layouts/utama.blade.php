<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Peminjaman Alat') - Sistem Peminjaman Alat</title>
    
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

<body>

    @include('layouts.navbar')

    <main class="main-content py-4">
        <div class="container">
            @if (session('sukses'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5 flex-shrink-0"></i>
                    <div class="flex-grow-1">{{ session('sukses') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('gagal'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5 flex-shrink-0"></i>
                    <div class="flex-grow-1">{{ session('gagal') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-info-circle-fill me-2 fs-5 flex-shrink-0"></i>
                    <div class="flex-grow-1">{{ session('info') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('konten')
        </div>
    </main>

    <footer class="footer-custom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-semibold text-dark">Sistem Peminjaman Alat</span>
                    <span>&copy; {{ date('Y') }} &middot; Kelola inventaris & peminjaman lebih cepat & transparan</span>
                </div>
                <div>
                    <span class="badge badge-soft-success">
                        <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Sistem Aktif
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('komponen.modal-kamera')
    @include('komponen.modal-pratinjau-gambar')
</body>

</html>

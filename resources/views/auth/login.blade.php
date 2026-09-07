@extends('layouts.auth')

@section('judul', 'Masuk ke Sistem - Portal Peminjaman Alat')

@section('konten')
    <div class="auth-single-canvas">
        {{-- Ambient Glowing Halo behind Card --}}
        <div class="auth-ambient-glow"></div>

        {{-- 1 Single Focused Card --}}
        <div class="auth-single-card">
            {{-- Brand & Header --}}
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Portal" class="mx-auto mb-3 d-block" style="width: 72px; height: 72px; border-radius: 18px; box-shadow: 0 0 30px rgba(99, 102, 241, 0.5), 0 8px 24px rgba(0,0,0,0.4);">

                <h4 class="fw-bold text-white mb-1">Masuk ke Sistem</h4>
                <p class="text-secondary small mb-0">Portal Peminjaman Alat Laboratorium</p>
            </div>


            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Nama Pengguna --}}
                <div class="mb-3">
                    <label for="username" class="form-label text-white-50 small fw-semibold">Nama Pengguna (Username)</label>
                    <div class="input-group">
                        <span class="input-group-text input-addon-dark border-end-0">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text"
                               id="username"
                               name="username"
                               value="{{ old('username') }}"
                               class="form-control auth-dark-input border-start-0 ps-0 @error('username') is-invalid @enderror"
                               placeholder="Masukkan username"
                               required
                               autofocus
                               autocomplete="username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kata Sandi --}}
                <div class="mb-4">
                    <label for="password" class="form-label text-white-50 small fw-semibold">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text input-addon-dark border-end-0">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control auth-dark-input border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror"
                               placeholder="Masukkan kata sandi"
                               required
                               autocomplete="current-password">
                        <button class="btn input-addon-dark border-start-0" type="button" id="togglePassword" aria-label="Tampilkan atau sembunyikan kata sandi">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-lg" style="border-radius: 12px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none; font-size: 0.95rem;">
                    <span>Masuk ke Sistem</span>
                    <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>

            {{-- Back to Home Link & Security Footer --}}
            <div class="text-center mt-4 pt-2 border-top border-secondary border-opacity-25">
                <a href="{{ url('/') }}" class="text-secondary text-decoration-none small d-inline-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali ke Halaman Utama</span>
                </a>
            </div>

            <div class="text-center mt-3 text-secondary" style="font-size: 0.75rem;">
                <i class="bi bi-shield-check text-success me-1"></i> Sesi terenkripsi aman &bull; Inventaris Resmi
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePassword && passwordInput && toggleIcon) {
                togglePassword.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleIcon.classList.toggle('bi-eye', !isPassword);
                    toggleIcon.classList.toggle('bi-eye-slash', isPassword);
                });
            }
        });
    </script>
@endsection

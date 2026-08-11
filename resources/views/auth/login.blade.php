@extends('layouts.utama')

@section('judul', 'Masuk')

@section('konten')
    <div class="row justify-content-center mt-5">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 text-center">Masuk ke Sistem</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Nama Pengguna --}}
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Pengguna</label>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   value="{{ old('username') }}"
                                   class="form-control @error('username') is-invalid @enderror"
                                   required
                                   autofocus
                                   autocomplete="username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kata Sandi --}}
                        <div class="mb-4">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required
                                   autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

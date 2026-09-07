@extends('layouts.utama')
@section('judul', 'Log Aktivitas')
@section('konten')
    <h4 class="mb-3">Log Aktivitas</h4>

    <div class="card">
        <div class="card-body">
            @include('log.form-search')

            <div class="table-responsive">
                @include('log.tabel-log')
            </div>

            {{ $daftarLog->links() }}
        </div>
    </div>
@endsection

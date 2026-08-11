@props([
    'lihat' => null,
    'ubah' => null,
    'hapus' => null,
    'pesanHapus' => 'Yakin ingin menghapus data ini?',
    'editRoute' => null,
    'deleteRoute' => null,
])

@php
    $routeUbah = $ubah ?? $editRoute;
    $routeHapus = $hapus ?? $deleteRoute;
@endphp

<div class="d-flex gap-1">
    @if ($lihat)
        <a href="{{ $lihat }}" class="btn btn-sm btn-info">Lihat</a>
    @endif

    @if ($routeUbah)
        <a href="{{ $routeUbah }}" class="btn btn-sm btn-warning">Ubah</a>
    @endif

    @if ($routeHapus)
        <form action="{{ $routeHapus }}" method="POST" class="d-inline" onsubmit="return confirm('{{ $pesanHapus }}')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
    @endif
</div>

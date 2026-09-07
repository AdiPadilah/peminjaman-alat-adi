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

<div class="d-flex align-items-center gap-1">
    @if ($lihat)
        <a href="{{ $lihat }}" class="btn btn-sm btn-outline-info py-1 px-2" title="Lihat Rincian">
            <i class="bi bi-eye"></i>
            <span class="d-none d-md-inline ms-1">Lihat</span>
        </a>
    @endif

    @if ($routeUbah)
        <a href="{{ $routeUbah }}" class="btn btn-sm btn-outline-warning py-1 px-2 text-dark" title="Ubah Data">
            <i class="bi bi-pencil"></i>
            <span class="d-none d-md-inline ms-1">Ubah</span>
        </a>
    @endif

    @if ($routeHapus)
        <form action="{{ $routeHapus }}" method="POST" class="d-inline" onsubmit="return confirm('{{ $pesanHapus }}')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2" title="Hapus Data">
                <i class="bi bi-trash"></i>
                <span class="d-none d-md-inline ms-1">Hapus</span>
            </button>
        </form>
    @endif
</div>

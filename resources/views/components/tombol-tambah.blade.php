@props(['href', 'label' => 'Tambah Data'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'btn btn-primary shadow-sm']) }}>
    <i class="bi bi-plus-lg me-1"></i>
    <span>{{ $label }}</span>
</a>

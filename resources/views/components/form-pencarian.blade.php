@props([
    'action' => '',
    'kataKunci' => '',
    'nama' => 'cari',
    'placeholder' => 'Cari data...',
])

<div class="col-md-5 col-lg-4">
    <div class="input-group">
        <span class="input-group-text bg-white border-end-0 text-muted">
            <i class="bi bi-search"></i>
        </span>
        <input type="text" name="{{ $nama }}" class="form-control border-start-0 ps-0" placeholder="{{ $placeholder }}" value="{{ $kataKunci }}">
    </div>
</div>
<div class="col-auto d-flex gap-1">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-search me-1"></i> Cari
    </button>
    <a href="{{ $action }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
    </a>
</div>

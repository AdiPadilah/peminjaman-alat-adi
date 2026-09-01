<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('judul')</title>
    <style>
        body { font-family: 'dejavu sans', sans-serif; font-size: 11px; margin: 0; }
        .kop { text-align: center; border-bottom: 2px solid #000; padding-bottom: 8px; margin-bottom: 14px; }
        .kop h2 { margin: 0; font-size: 15px; }
        .kop h3 { margin: 4px 0 0; font-size: 13px; font-weight: normal; }
        .kop p { margin: 3px 0 0; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #666; padding: 5px 6px; }
        th { background: #e9e9e9; text-align: left; }
        .kanan { text-align: right; }
        .tengah { text-align: center; }
        .ringkasan { margin-top: 12px; width: 45%; float: right; }
        .ttd { margin-top: 60px; float: right; text-align: center; width: 200px; }
        .catatan-kaki { position: fixed; bottom: 0; width: 100%; font-size: 9px; color: #666; border-top: 1px solid #ccc; padding-top: 4px; }
    </style>
</head>
<body>
    <div class="kop">
        <h2>{{ $namaSekolah }}</h2>
        <h3>@yield('judul')</h3>
        <p>Periode: {{ $keteranganPeriode }}</p>
    </div>

    @yield('isi')

    <div class="catatan-kaki">
        Dicetak pada {{ now()->format('d/m/Y H:i') }} oleh {{ auth()->user()->nama }}
    </div>
</body>
</html>

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_pinjam',
        'user_id',
        'petugas_id',
        'tgl_pinjam',
        'tgl_harus_kembali',
        'tgl_diajukan_kembali',
        'status',
        'keperluan',
        'alasan_tolak',
    ];

    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_harus_kembali' => 'date',
        'tgl_diajukan_kembali' => 'date',
    ];
}

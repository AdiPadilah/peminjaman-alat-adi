<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'petugas_id',
        'tgl_kembali',
        'hari_terlambat',
        'denda',
        'denda_kerusakan',
        'total_denda',
        'catatan',
    ];

    protected $casts = [
        'tgl_kembali' => 'date',
    ];
}

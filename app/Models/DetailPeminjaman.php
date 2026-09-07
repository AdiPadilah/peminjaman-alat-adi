<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'peminjaman_id',
        'alat_id',
        'jumlah',
        'foto_sebelum',
        'kondisi_kembali',
        'foto_sesudah',
        'denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function getUrlFotoSebelumAttribute(): ?string
    {
        return $this->foto_sebelum ? asset('gambar/kondisi/' . $this->foto_sebelum) : null;
    }

    public function getUrlFotoSesudahAttribute(): ?string
    {
        return $this->foto_sesudah ? asset('gambar/kondisi/' . $this->foto_sesudah) : null;
    }
}

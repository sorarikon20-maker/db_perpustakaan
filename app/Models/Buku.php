<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['judul', 'penulis', 'penerbit', 'tahun_terbit', 'kategori_id', 'stok', 'cover_image', 'rak_nomor', 'deskripsi'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}

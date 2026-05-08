<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Setting;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = ['siswa_id', 'buku_id', 'user_id', 'tanggal_pinjam', 'batas_kembali', 'tanggal_kembali', 'status', 'denda'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hitung denda keterlambatan pengembalian buku.
     * Denda: Rp 5.000 per hari per buku.
     */
    public function hitungDenda(): int
    {
        if ($this->status === 'dikembalikan' || !$this->batas_kembali) {
            return 0;
        }

        $batas = Carbon::parse($this->batas_kembali);
        $sekarang = Carbon::today();

        if ($sekarang->greaterThan($batas)) {
            $hariTerlambat = $batas->diffInDays($sekarang);
            $dendaPerHari = (int) Setting::get('denda_per_hari', 5000);
            return $hariTerlambat * $dendaPerHari;
        }

        return 0;
    }

    /**
     * Cek apakah buku sedang terlambat dikembalikan.
     */
    public function isTerlambat(): bool
    {
        if ($this->status === 'dikembalikan' || !$this->batas_kembali) {
            return false;
        }
        return Carbon::today()->greaterThan(Carbon::parse($this->batas_kembali));
    }
}

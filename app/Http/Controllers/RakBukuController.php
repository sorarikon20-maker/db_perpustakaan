<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class RakBukuController extends Controller
{
    /**
     * Menampilkan daftar buku dikelompokkan berdasarkan rak.
     */
    public function index()
    {
        // Buku yang sudah ditempatkan di rak
        $bukuByRak = Buku::with('kategori')
            ->whereNotNull('rak_nomor')
            ->where('rak_nomor', '!=', '')
            ->orderBy('rak_nomor')
            ->orderBy('judul')
            ->get()
            ->groupBy('rak_nomor');

        // Buku yang belum ditempatkan di rak
        $bukuTanpaRak = Buku::with('kategori')
            ->where(function ($query) {
                $query->whereNull('rak_nomor')
                      ->orWhere('rak_nomor', '');
            })
            ->orderBy('judul')
            ->get();

        $totalBuku = Buku::count();
        $totalRak = $bukuByRak->count();
        $totalBelumDitempatkan = $bukuTanpaRak->count();

        return view('rak-buku.index', compact(
            'bukuByRak',
            'bukuTanpaRak',
            'totalBuku',
            'totalRak',
            'totalBelumDitempatkan'
        ));
    }
}

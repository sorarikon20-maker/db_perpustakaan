<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RakBukuController;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }

    $favoriteBooks = Buku::withCount('peminjamans')
        ->orderByDesc('peminjamans_count')
        ->take(4)
        ->get();

    return view('welcome', compact('favoriteBooks'));
});

Route::get('/dashboard', function () {
    $year = Carbon::now()->year;
    $today = Carbon::today();

    $monthlyTotalsRaw = Peminjaman::where('status', 'dikembalikan')
        ->whereYear('tanggal_kembali', $year)
        ->where('denda', '>', 0)
        ->selectRaw('MONTH(tanggal_kembali) as month, SUM(denda) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month');

    $monthlyTotals = array_fill(1, 12, 0);
    foreach ($monthlyTotalsRaw as $month => $total) {
        $monthlyTotals[$month] = (int) $total;
    }

    $activeLatePeminjamans = Peminjaman::where('status', 'dipinjam')
        ->whereDate('batas_kembali', '<', $today)
        ->get();

    $activeLateCount = $activeLatePeminjamans->count();
    $activeLateTotal = $activeLatePeminjamans->sum(function ($p) use ($today) {
        return $p->hitungDenda();
    });

    $recentFineHistory = Peminjaman::with('siswa', 'buku', 'user')
        ->where(function ($query) use ($today) {
            $query->where('denda', '>', 0)
                ->orWhere(function ($subQuery) use ($today) {
                    $subQuery->where('status', 'dipinjam')
                        ->whereDate('batas_kembali', '<', $today);
                });
        })
        ->latest('updated_at')
        ->limit(6)
        ->get();

    return view('dashboard', compact('monthlyTotals', 'activeLateCount', 'activeLateTotal', 'recentFineHistory'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'removePhoto'])->name('profile.photo.remove');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('siswas', SiswaController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('bukus', BukuController::class);

    Route::get('peminjamans/laporan', [PeminjamanController::class, 'laporan'])
        ->name('peminjamans.laporan');
    Route::get('peminjamans/histori', [PeminjamanController::class, 'histori'])
        ->name('peminjamans.histori');
    Route::resource('peminjamans', PeminjamanController::class);

    Route::get('rak-buku', [RakBukuController::class, 'index'])
        ->name('rak-buku.index');

    Route::resource('users', UserController::class)->except(['show']);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Siswa;
use App\Models\Buku;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::with('siswa', 'buku', 'user');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            })->orWhereHas('buku', function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%');
            })->orWhere('status', 'like', '%' . $search . '%');
        }

        $today = Carbon::today();
        $activeLatePeminjamans = Peminjaman::where('status', 'dipinjam')
            ->whereDate('batas_kembali', '<', $today)
            ->get();

        $activeLateCount = $activeLatePeminjamans->count();
        $activeLateTotal = $activeLatePeminjamans->sum(function ($p) {
            return $p->hitungDenda();
        });

        $fineHistory = Peminjaman::with('siswa', 'buku', 'user')
            ->where(function ($query) use ($today) {
                $query->where('denda', '>', 0)
                    ->orWhere(function ($subQuery) use ($today) {
                        $subQuery->where('status', 'dipinjam')
                            ->whereDate('batas_kembali', '<', $today);
                    });
            })
            ->latest('updated_at')
            ->limit(8)
            ->get();

        $peminjamans = $query->latest()->paginate(10);
        return view('peminjamans.index', compact(
            'peminjamans',
            'fineHistory',
            'activeLateCount',
            'activeLateTotal'
        ));
    }

    public function laporan(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        $month = $request->get('month', Carbon::now()->month);

        $monthlyTotalsRaw = Peminjaman::where('status', 'dikembalikan')
            ->whereYear('tanggal_kembali', $year)
            ->where('denda', '>', 0)
            ->selectRaw('MONTH(tanggal_kembali) as month, SUM(denda) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        $monthlyTotals = array_fill(1, 12, 0);
        foreach ($monthlyTotalsRaw as $m => $total) {
            $monthlyTotals[$m] = (int) $total;
        }

        $yearTotal = Peminjaman::where('status', 'dikembalikan')
            ->whereYear('tanggal_kembali', $year)
            ->where('denda', '>', 0)
            ->sum('denda');

        $monthTotal = $monthlyTotals[$month] ?? 0;

        $years = collect(range(Carbon::now()->year - 2, Carbon::now()->year))->reverse();

        $today = Carbon::today();
        $activeLatePeminjamans = Peminjaman::where('status', 'dipinjam')
            ->whereDate('batas_kembali', '<', $today)
            ->get();

        $activeLateCount = $activeLatePeminjamans->count();
        $activeLateTotal = $activeLatePeminjamans->sum(function ($p) {
            return $p->hitungDenda();
        });

        // Histori denda untuk bulan & tahun yang dipilih
        $fineHistory = Peminjaman::with('siswa', 'buku', 'user')
            ->where(function ($query) use ($year, $month, $today) {
                $query->where(function ($subQuery) use ($year, $month) {
                    $subQuery->where('status', 'dikembalikan')
                        ->where('denda', '>', 0)
                        ->whereYear('tanggal_kembali', $year)
                        ->whereMonth('tanggal_kembali', $month);
                })
                ->orWhere(function ($subQuery) use ($year, $month, $today) {
                    $subQuery->where('status', 'dipinjam')
                        ->whereDate('batas_kembali', '<', $today)
                        ->whereYear('batas_kembali', $year)
                        ->whereMonth('batas_kembali', $month);
                });
            })
            ->latest('updated_at')
            ->get();

        $dendaPerHari = Setting::get('denda_per_hari', 5000);

        return view('peminjamans.laporan-denda', compact(
            'monthlyTotals',
            'years',
            'year',
            'month',
            'monthTotal',
            'yearTotal',
            'activeLateCount',
            'activeLateTotal',
            'fineHistory',
            'dendaPerHari'
        ));
    }

    public function histori(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        $today = Carbon::today();
        $fineHistory = Peminjaman::with('siswa', 'buku', 'user')
            ->where(function ($query) use ($year, $today) {
                $query->where(function ($subQuery) use ($year) {
                    $subQuery->where('status', 'dikembalikan')
                        ->where('denda', '>', 0)
                        ->whereYear('tanggal_kembali', $year);
                })
                ->orWhere(function ($subQuery) use ($year, $today) {
                    $subQuery->where('status', 'dipinjam')
                        ->whereDate('batas_kembali', '<', $today)
                        ->whereYear('batas_kembali', $year);
                });
            })
            ->latest('updated_at')
            ->get();

        $years = collect(range(Carbon::now()->year - 2, Carbon::now()->year))->reverse();

        $yearTotal = Peminjaman::where('status', 'dikembalikan')
            ->whereYear('tanggal_kembali', $year)
            ->where('denda', '>', 0)
            ->sum('denda');

        return view('peminjamans.histori-denda', compact('fineHistory', 'years', 'year', 'yearTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::orderBy('nama')->get();
        $bukus = Buku::orderBy('judul')->get();
        return view('peminjamans.create', compact('siswas', 'bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'       => 'required|exists:siswas,id',
            'buku_ids'       => 'required|array|min:1',
            'buku_ids.*'     => 'exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'batas_kembali'  => 'required|date|after_or_equal:tanggal_pinjam',
            'tanggal_kembali'=> 'nullable|date',
            'status'         => 'required|in:dipinjam,dikembalikan',
        ]);

        $bukuIds = $request->buku_ids;
        $status = $request->status;
        $tanggalKembali = $request->tanggal_kembali ?: Carbon::today()->toDateString();

        // Cek stok untuk semua buku jika status dipinjam
        if ($status === 'dipinjam') {
            $bukusWithInsuficientStock = [];
            foreach ($bukuIds as $bukuId) {
                $buku = Buku::findOrFail($bukuId);
                if ($buku->stok <= 0) {
                    $bukusWithInsuficientStock[] = $buku->judul;
                }
            }
            if (!empty($bukusWithInsuficientStock)) {
                return redirect()->back()->withInput()->withErrors([
                    'buku_ids' => 'Stok habis untuk buku: ' . implode(', ', $bukusWithInsuficientStock)
                ]);
            }
        }

        DB::transaction(function () use ($request, $bukuIds, $status, $tanggalKembali) {
            foreach ($bukuIds as $bukuId) {
                $denda = 0;
                if ($status === 'dikembalikan') {
                    $denda = $this->calculateDenda($request->batas_kembali, $tanggalKembali);
                } elseif ($status === 'dipinjam' && $request->batas_kembali) {
                    $denda = $this->calculateDenda($request->batas_kembali, Carbon::today()->toDateString());
                }

                Peminjaman::create([
                    'siswa_id'        => $request->siswa_id,
                    'buku_id'         => $bukuId,
                    'user_id'         => Auth::id(),
                    'tanggal_pinjam'  => $request->tanggal_pinjam,
                    'batas_kembali'   => $request->batas_kembali,
                    'tanggal_kembali' => $request->tanggal_kembali,
                    'status'          => $status,
                    'denda'           => $denda,
                ]);

                // Kurangi stok jika status dipinjam
                if ($status === 'dipinjam') {
                    Buku::where('id', $bukuId)->decrement('stok');
                }
            }
        });

        $count = count($bukuIds);
        $message = $count === 1 
            ? 'Peminjaman berhasil ditambahkan. Stok buku telah diperbarui.'
            : "Peminjaman berhasil ditambahkan. {$count} buku telah dicatat dan stok telah diperbarui.";

        return redirect()->route('peminjamans.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::with('siswa', 'buku', 'user')->findOrFail($id);
        return view('peminjamans.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $siswas = Siswa::orderBy('nama')->get();
        $bukus = Buku::orderBy('judul')->get();
        return view('peminjamans.edit', compact('peminjaman', 'siswas', 'bukus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'siswa_id'       => 'required|exists:siswas,id',
            'buku_id'        => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'batas_kembali'  => 'required|date|after_or_equal:tanggal_pinjam',
            'tanggal_kembali'=> 'nullable|date',
            'status'         => 'required|in:dipinjam,dikembalikan',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $oldBukuId = $peminjaman->buku_id;
        $oldStatus = $peminjaman->status;
        $newBukuId = $request->buku_id;
        $newStatus = $request->status;

        // Cek stok buku baru jika buku diganti dan status dipinjam
        if ($newStatus === 'dipinjam' && $newBukuId != $oldBukuId) {
            $bukuBaru = Buku::findOrFail($newBukuId);
            if ($bukuBaru->stok <= 0) {
                return redirect()->back()->withInput()->withErrors([
                    'buku_id' => 'Stok buku "' . $bukuBaru->judul . '" sudah habis (stok: 0). Tidak bisa meminjam buku ini.'
                ]);
            }
        }

        // Cek jika status berubah dari dikembalikan ke dipinjam (dipinjam lagi)
        if ($oldStatus === 'dikembalikan' && $newStatus === 'dipinjam' && $newBukuId == $oldBukuId) {
            $buku = Buku::findOrFail($newBukuId);
            if ($buku->stok <= 0) {
                return redirect()->back()->withInput()->withErrors([
                    'buku_id' => 'Stok buku "' . $buku->judul . '" sudah habis (stok: 0). Tidak bisa meminjam buku ini.'
                ]);
            }
        }

        // Hitung denda berdasarkan status
        $denda = 0;
        if ($newStatus === 'dikembalikan') {
            $tanggalKembali = $request->tanggal_kembali ?: Carbon::today()->toDateString();
            $denda = $this->calculateDenda($request->batas_kembali, $tanggalKembali);
        } elseif ($newStatus === 'dipinjam') {
            $denda = $this->calculateDenda($request->batas_kembali, Carbon::today()->toDateString());
        }

        DB::transaction(function () use ($request, $peminjaman, $oldBukuId, $oldStatus, $newBukuId, $newStatus, $denda) {
            // ===== ATUR STOK BUKU =====

            // Kasus 1: Buku sama, status berubah dari dipinjam -> dikembalikan  ==> tambah stok
            if ($oldBukuId == $newBukuId && $oldStatus === 'dipinjam' && $newStatus === 'dikembalikan') {
                Buku::where('id', $oldBukuId)->increment('stok');
            }

            // Kasus 2: Buku sama, status berubah dari dikembalikan -> dipinjam ==> kurangi stok
            if ($oldBukuId == $newBukuId && $oldStatus === 'dikembalikan' && $newStatus === 'dipinjam') {
                Buku::where('id', $newBukuId)->decrement('stok');
            }

            // Kasus 3: Buku berubah dan status lama dipinjam
            if ($oldBukuId != $newBukuId && $oldStatus === 'dipinjam') {
                // Kembalikan stok buku lama
                Buku::where('id', $oldBukuId)->increment('stok');

                // Kurangi stok buku baru jika status baru juga dipinjam
                if ($newStatus === 'dipinjam') {
                    Buku::where('id', $newBukuId)->decrement('stok');
                }
            }

            // Kasus 4: Buku berubah dan status lama dikembalikan, status baru dipinjam
            if ($oldBukuId != $newBukuId && $oldStatus === 'dikembalikan' && $newStatus === 'dipinjam') {
                Buku::where('id', $newBukuId)->decrement('stok');
            }

            $peminjaman->update([
                'siswa_id'        => $request->siswa_id,
                'buku_id'         => $newBukuId,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'batas_kembali'   => $request->batas_kembali,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => $newStatus,
                'denda'           => $denda,
            ]);
        });

        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil diupdate. Stok buku telah diperbarui.');
    }

    private function calculateDenda(?string $batasKembali, ?string $tanggalKembali): int
    {
        if (!$batasKembali) {
            return 0;
        }

        $batas = Carbon::parse($batasKembali);
        $tanggal = $tanggalKembali ? Carbon::parse($tanggalKembali) : Carbon::today();

        if ($tanggal->greaterThan($batas)) {
            $dendaPerHari = (int) Setting::get('denda_per_hari', 5000);
            return $batas->diffInDays($tanggal) * $dendaPerHari;
        }

        return 0;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        DB::transaction(function () use ($peminjaman) {
            // Jika peminjaman masih aktif (dipinjam), kembalikan stoknya
            if ($peminjaman->status === 'dipinjam') {
                Buku::where('id', $peminjaman->buku_id)->increment('stok');
            }

            $peminjaman->delete();
        });

        return redirect()->route('peminjamans.index')->with('success', 'Peminjaman berhasil dihapus. Stok buku telah dikembalikan.');
    }
}

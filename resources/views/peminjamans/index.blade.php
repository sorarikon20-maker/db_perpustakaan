<x-app-layout>
    @php $header = 'Peminjaman Buku'; @endphp

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Daftar Peminjaman</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Kelola semua transaksi peminjaman buku perpustakaan</p>
        </div>
        
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom:24px;">
        <div class="card" style="padding:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:16px;flex-wrap:wrap;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;margin:0;">Total Denda Saat Ini</h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Estimasi denda untuk peminjaman yang terlambat.</p>
                </div>
                <div style="text-align:right;min-width:160px;">
                    <div style="font-size:24px;font-weight:700;color:#dc2626;">Rp {{ number_format($activeLateTotal, 0, ',', '.') }}</div>
                    <div style="font-size:13px;color:#64748b;">{{ $activeLateCount }} peminjaman terlambat</div>
                </div>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('peminjamans.laporan') }}" class="btn btn-primary btn-sm">Lihat Laporan Denda</a>
                <button type="button" class="btn btn-secondary btn-sm" onclick="openFineHistoryPopup()">Lihat Histori Denda</button>
            </div>
        </div>
    </div>

    <div id="fineHistoryModal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.65);backdrop-filter:blur(4px);z-index:9999;justify-content:center;align-items:center;padding:24px;">
        <div style="width:min(760px,100%);background:white;border-radius:18px;overflow:hidden;box-shadow:0 20px 60px rgba(15,23,42,0.2);">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid #e2e8f0;">
                <div>
                    <div style="font-size:18px;font-weight:700;color:#0f172a;">Histori Denda</div>
                    <div style="font-size:13px;color:#64748b;">Riwayat denda dari peminjaman terkini.</div>
                </div>
                <button type="button" onclick="closeFineHistoryPopup()" style="width:36px;height:36px;border:none;background:#f8fafc;border-radius:999px;cursor:pointer;font-size:18px;">×</button>
            </div>
            <div style="max-height:calc(100vh - 180px);overflow:auto;padding:16px 20px;">
                @if($fineHistory->isEmpty())
                    <div style="color:#64748b;font-size:13px;">Belum ada histori denda.</div>
                @else
                    <div style="display:grid;gap:12px;">
                        @foreach($fineHistory as $item)
                            @php
                                $historyDenda = $item->status === 'dipinjam' ? $item->hitungDenda() : $item->denda;
                            @endphp
                            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:14px;">
                                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;">
                                    <div>
                                        <div style="font-size:14px;font-weight:700;color:#0f172a;">{{ $item->siswa->nama ?? 'N/A' }} • {{ $item->buku->judul ?? 'Buku tidak tersedia' }}</div>
                                        <div style="font-size:12px;color:#64748b;margin-top:6px;">Status: {{ $item->status === 'dipinjam' ? 'Dipinjam' : 'Dikembalikan' }}</div>
                                        <div style="font-size:12px;color:#475569;margin-top:4px;">{{ $item->status === 'dipinjam' ? 'Batas: '.$item->batas_kembali : 'Kembali: '.$item->tanggal_kembali }}</div>
                                    </div>
                                    <div style="text-align:right; min-width:120px;">
                                        <div style="font-size:14px;font-weight:700;color:#dc2626;">Rp {{ number_format($historyDenda, 0, ',', '.') }}</div>
                                        <div style="font-size:11px;color:#94a3b8;margin-top:6px;">{{ $item->updated_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function openFineHistoryPopup() {
            document.getElementById('fineHistoryModal').style.display = 'flex';
        }
        function closeFineHistoryPopup() {
            document.getElementById('fineHistoryModal').style.display = 'none';
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFineHistoryPopup();
            }
        });
    </script>

    
    

    <div class="card">
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:18px;height:18px;display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                Rekap Peminjaman
            </h3>
            <form method="GET" action="{{ route('peminjamans.index') }}" style="display:flex;gap:8px">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peminjaman..." class="search-input">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
            <a href="{{ route('peminjamans.create') }}" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Catat Peminjaman
        </a>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Stok</th>
                        <th>Petugas</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $peminjaman)
                        @php
                            $terlambat = $peminjaman->isTerlambat();
                            $denda = $peminjaman->status === 'dipinjam' ? $peminjaman->hitungDenda() : $peminjaman->denda;
                        @endphp
                        <tr style="{{ $terlambat ? 'background:#fff7ed;' : '' }}">
                            <td data-label="No" style="color:#94a3b8;font-size:13px">{{ $loop->iteration }}</td>
                            <td data-label="Siswa">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:12px;flex-shrink:0">
                                        {{ strtoupper(substr($peminjaman->siswa->nama ?? 'N', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:500;font-size:14px">{{ $peminjaman->siswa ? $peminjaman->siswa->nama : 'N/A' }}</div>
                                        <div style="font-size:12px;color:#94a3b8">{{ $peminjaman->siswa ? $peminjaman->siswa->nis : '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Buku">
                                <div style="font-weight:500;font-size:14px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="{{ $peminjaman->buku ? $peminjaman->buku->judul : 'N/A' }}">
                                    {{ $peminjaman->buku ? $peminjaman->buku->judul : 'N/A' }}
                                </div>
                            </td>
                            <td data-label="Stok">
                                @if($peminjaman->buku)
                                    @if($peminjaman->buku->stok <= 0)
                                        <span class="badge badge-danger" style="font-size:12px">Habis</span>
                                    @elseif($peminjaman->buku->stok <= 3)
                                        <span class="badge badge-warning" style="font-size:12px">{{ $peminjaman->buku->stok }}</span>
                                    @else
                                        <span class="badge badge-success" style="font-size:12px">{{ $peminjaman->buku->stok }}</span>
                                    @endif
                                @else
                                    <span style="color:#94a3b8;font-size:13px">-</span>
                                @endif
                            </td>
                            <td data-label="Petugas" style="font-size:13px;color:#64748b">
                                <div style="display:flex;align-items:center;gap:6px">
                                    <div style="width:24px;height:24px;border-radius:6px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:10px;flex-shrink:0">
                                        {{ strtoupper(substr($peminjaman->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    {{ $peminjaman->user ? $peminjaman->user->name : 'N/A' }}
                                </div>
                            </td>
                            <td data-label="Tgl Pinjam" style="font-size:13px">{{ $peminjaman->tanggal_pinjam }}</td>
                            <td data-label="Batas Kembali" style="font-size:13px">
                                @if($peminjaman->batas_kembali)
                                    @if($terlambat)
                                        <span style="color:#dc2626;font-weight:600">{{ $peminjaman->batas_kembali }}</span>
                                        @php
                                            $hLambat = \Carbon\Carbon::parse($peminjaman->batas_kembali)->diffInDays(\Carbon\Carbon::today());
                                        @endphp
                                        <div style="font-size:11px;color:#ef4444">🔴 Telat {{ $hLambat }} hari</div>
                                    @else
                                        {{ $peminjaman->batas_kembali }}
                                    @endif
                                @else
                                    <span style="color:#94a3b8">-</span>
                                @endif
                            </td>
                            <td data-label="Tgl Kembali" style="font-size:13px">{{ $peminjaman->tanggal_kembali ?? '-' }}</td>
                            <td data-label="Status">
                                @if($peminjaman->status == 'dipinjam')
                                    @if($terlambat)
                                        <span class="badge badge-danger">🚨 Terlambat</span>
                                    @else
                                        <span class="badge badge-warning">📤 Dipinjam</span>
                                    @endif
                                @else
                                    <span class="badge badge-success">✅ Dikembalikan</span>
                                @endif
                            </td>
                            <td data-label="Denda">
                                @if($denda > 0)
                                    <span class="badge badge-danger" style="font-size:12px;font-weight:600">
                                        Rp {{ number_format($denda, 0, ',', '.') }}
                                    </span>
                                @elseif($peminjaman->status === 'dikembalikan')
                                    <span class="badge badge-success" style="font-size:12px">Lunas</span>
                                @else
                                    <span style="color:#94a3b8;font-size:13px">-</span>
                                @endif
                            </td>
                            <td data-label="Aksi">
                                <div style="display:flex;gap:6px">
                                    <a href="{{ route('peminjamans.edit', $peminjaman) }}" class="action-btn action-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('peminjamans.destroy', $peminjaman) }}" style="margin:0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="action-btn action-delete" title="Hapus" onclick="event.preventDefault(); showDeleteModal(this.form, '{{ $peminjaman->siswa->nama ?? 'Peminjaman' }}')">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">📋</div>
                                <div style="font-weight:500">Belum ada data peminjaman</div>
                                <div style="font-size:13px;margin-top:4px">Klik "Catat Peminjaman" untuk mencatat peminjaman baru</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($peminjamans->hasPages())
            <div style="padding:16px 24px;border-top:1px solid #f1f5f9">
                {{ $peminjamans->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
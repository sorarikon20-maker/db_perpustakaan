<x-app-layout>
    @php $header = 'Laporan Denda'; @endphp

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Laporan Denda</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Lihat ringkasan denda per bulan dan histori denda peminjaman buku.</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary btn-sm">Kembali ke Peminjaman</a>
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

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <div class="card" style="padding:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;margin:0;">Denda Aktif Saat Ini</h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Estimasi denda untuk peminjaman yang terlambat.</p>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:18px;font-weight:700;color:#dc2626;">Rp {{ number_format($activeLateTotal, 0, ',', '.') }}</div>
                    <div style="font-size:13px;color:#64748b;">{{ $activeLateCount }} peminjaman terlambat</div>
                </div>
            </div>
        </div>
        <div class="card" style="padding:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;margin:0;">Denda Terkumpul Tahun {{ $year }}</h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Total denda dari pengembalian buku di tahun ini.</p>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:20px;font-weight:700;color:#0f172a;">Rp {{ number_format($yearTotal, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card" style="padding:20px;margin-bottom:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:16px;">
            <div>
                <h3 style="font-size:16px;font-weight:700;margin:0;">Laporan Denda Bulanan</h3>
                <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Jumlah denda per bulan berdasarkan tanggal pengembalian.</p>
            </div>
            <form method="GET" action="{{ route('peminjamans.laporan') }}" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                <label style="font-size:13px;color:#475569;">Bulan</label>
                <select name="month" style="padding:8px 10px;border:1px solid #d1d5db;border-radius:10px;min-width:120px;">
                    @php $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']; @endphp
                    @foreach($months as $index => $monthName)
                        <option value="{{ $index + 1 }}" {{ ($index + 1) == $month ? 'selected' : '' }}>{{ $monthName }}</option>
                    @endforeach
                </select>
                <label style="font-size:13px;color:#475569;">Tahun</label>
                <select name="year" style="padding:8px 10px;border:1px solid #d1d5db;border-radius:10px;min-width:120px;">
                    @foreach($years as $optionYear)
                        <option value="{{ $optionYear }}" {{ $optionYear == $year ? 'selected' : '' }}>{{ $optionYear }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            </form>
        </div>

        <div style="padding:14px 16px;border:1px solid #e2e8f0;border-radius:14px;background:#fff;text-align:center;">
            <div style="font-size:14px;color:#64748b;margin-bottom:6px;">Total Denda di Bulan {{ $months[$month - 1] }} {{ $year }}</div>
            <div style="font-size:28px;font-weight:800;color:#0f172a;">
                Rp {{ number_format($monthTotal, 0, ',', '.') }}
            </div>
        </div>
    </div>
    
    {{-- Histori Denda Section --}}
    <div class="card">
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:18px;height:18px;display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Histori Denda Tahun {{ $year }}
            </h3>
            <span class="badge badge-secondary">{{ $fineHistory->count() }} data</span>
        </div>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Buku</th>
                        <th>Status</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Kembali</th>
                        <th>Denda</th>
                        <th>Diupdate</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fineHistory as $item)
                        @php
                            $historyDenda = $item->status === 'dipinjam' ? $item->hitungDenda() : $item->denda;
                        @endphp
                        <tr>
                            <td style="color:#94a3b8;font-size:13px">{{ $loop->iteration }}</td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:11px;flex-shrink:0">
                                        {{ strtoupper(substr($item->siswa->nama ?? 'N', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:500;font-size:14px">{{ $item->siswa->nama ?? 'N/A' }}</div>
                                        <div style="font-size:12px;color:#94a3b8">{{ $item->siswa->nis ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500;font-size:14px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="{{ $item->buku->judul ?? 'N/A' }}">
                                    {{ $item->buku->judul ?? 'Buku tidak tersedia' }}
                                </div>
                            </td>
                            <td>
                                @if($item->status === 'dipinjam')
                                    <span class="badge badge-danger">🚨 Terlambat</span>
                                @else
                                    <span class="badge badge-success">✅ Dikembalikan</span>
                                @endif
                            </td>
                            <td style="font-size:13px">{{ $item->batas_kembali }}</td>
                            <td style="font-size:13px">{{ $item->tanggal_kembali ?? '-' }}</td>
                            <td>
                                <span class="badge badge-danger" style="font-size:12px;font-weight:600">
                                    Rp {{ number_format($historyDenda, 0, ',', '.') }}
                                </span>
                            </td>
                            <td style="font-size:12px;color:#94a3b8">{{ $item->updated_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">💰</div>
                                <div style="font-weight:500">Belum ada histori denda untuk tahun {{ $year }}</div>
                                <div style="font-size:13px;margin-top:4px">Tidak ada peminjaman yang terkena denda di tahun ini</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
</x-app-layout>

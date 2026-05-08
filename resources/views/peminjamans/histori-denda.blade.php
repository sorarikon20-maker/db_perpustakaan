<x-app-layout>
    @php $header = 'Histori Denda'; @endphp

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Histori Denda</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Semua riwayat denda peminjaman buku.</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <form method="GET" action="{{ route('peminjamans.histori') }}" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                <label style="font-size:13px;color:#475569;">Tahun</label>
                <select name="year" style="padding:8px 10px;border:1px solid #d1d5db;border-radius:10px;min-width:120px;">
                    @foreach($years as $optionYear)
                        <option value="{{ $optionYear }}" {{ $optionYear == $year ? 'selected' : '' }}>{{ $optionYear }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            </form>
            <a href="{{ route('peminjamans.laporan') }}" class="btn btn-secondary btn-sm">Laporan Denda</a>
            <a href="{{ route('peminjamans.index') }}" class="btn btn-primary btn-sm">Kembali ke Peminjaman</a>
        </div>
    </div>

    <div class="card" style="padding:20px; margin-bottom:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;">
            <div>
                <h3 style="font-size:16px;font-weight:700;margin:0;">Total Denda Terkumpul Tahun {{ $year }}</h3>
                <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Total denda yang tercatat untuk tahun ini.</p>
            </div>
            <div style="text-align:right;">
                <div style="font-size:20px;font-weight:700;color:#0f172a;">Rp {{ number_format($yearTotal, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="card" style="padding:20px;">
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
                                <div style="font-size:15px;font-weight:700;color:#0f172a;">{{ $item->siswa->nama ?? 'N/A' }} • {{ $item->buku->judul ?? 'Buku tidak tersedia' }}</div>
                                <div style="font-size:13px;color:#64748b;margin-top:6px;">Status: {{ $item->status === 'dipinjam' ? 'Dipinjam' : 'Dikembalikan' }}</div>
                                <div style="font-size:13px;color:#475569;margin-top:4px;">{{ $item->status === 'dipinjam' ? 'Batas: '.$item->batas_kembali : 'Kembali: '.$item->tanggal_kembali }}</div>
                            </div>
                            <div style="text-align:right; min-width:140px;">
                                <div style="font-size:16px;font-weight:700;color:#dc2626;">Rp {{ number_format($historyDenda, 0, ',', '.') }}</div>
                                <div style="font-size:12px;color:#94a3b8;margin-top:6px;">Diupdate: {{ $item->updated_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>

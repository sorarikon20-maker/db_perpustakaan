<x-app-layout>
    @php $header = 'Dashboard'; @endphp

    <style>
        /* ===== DASHBOARD STYLES ===== */
        .welcome-banner {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            border-radius: 20px;
            padding: 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(99,102,241,0.35);
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            top: -100px; right: -80px;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            bottom: -80px; right: 100px;
        }

        .welcome-text { position: relative; z-index: 1; }

        .welcome-text h2 {
            font-size: 24px; font-weight: 800; color: white; margin: 0 0 6px;
        }

        .welcome-text p {
            font-size: 14px; color: rgba(255,255,255,0.75); margin: 0 0 20px;
        }

        .welcome-actions { display: flex; gap: 10px; flex-wrap: wrap; }

        .welcome-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13px; font-weight: 600;
            text-decoration: none; cursor: pointer; border: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }

        .welcome-btn-primary {
            background: white; color: #6366f1;
        }

        .welcome-btn-primary:hover { background: #f0f0ff; color: #4f46e5; }

        .welcome-btn-outline {
            background: rgba(255,255,255,0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .welcome-btn-outline:hover { background: rgba(255,255,255,0.25); color: white; }

        .welcome-illustration {
            position: relative; z-index: 1;
            font-size: 80px; line-height: 1;
            margin-left: 20px;
            flex-shrink: 0;
        }

        /* Stat Cards Grid */
        .stat-cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        @media (max-width: 1200px) { .stat-cards-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 580px) { .stat-cards-grid { grid-template-columns: 1fr; } }

        .stat-card-new {
            background: white;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            display: flex; align-items: center; gap: 16px;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
        }

        .stat-card-new::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }

        .stat-card-new.blue::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .stat-card-new.green::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card-new.purple::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .stat-card-new.orange::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

        .stat-card-new:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stat-icon-new {
            width: 54px; height: 54px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon-new svg { width: 24px; height: 24px; }

        .stat-icon-new.blue { background: #eff6ff; color: #3b82f6; }
        .stat-icon-new.green { background: #f0fdf4; color: #10b981; }
        .stat-icon-new.purple { background: #faf5ff; color: #8b5cf6; }
        .stat-icon-new.orange { background: #fffbeb; color: #f59e0b; }

        .stat-info { flex: 1; }
        .stat-info-label { font-size: 13px; color: #64748b; margin-bottom: 4px; }
        .stat-info-value { font-size: 28px; font-weight: 700; color: #0f172a; line-height: 1; }
        .stat-info-trend { font-size: 12px; color: #10b981; margin-top: 4px; }

        .stat-arrow {
            width: 32px; height: 32px;
            background: #f8fafc; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #94a3b8;
            transition: all 0.2s;
        }

        .stat-card-new:hover .stat-arrow {
            background: #e0e7ff; color: #6366f1;
        }

        .stat-arrow svg { width: 16px; height: 16px; }

        /* Quick Actions */
        .section-title {
            font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 16px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }

        @media (max-width: 1000px) { .quick-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 500px) { .quick-grid { grid-template-columns: 1fr 1fr; } }

        .quick-card {
            background: white;
            border-radius: 14px;
            padding: 20px 16px;
            text-align: center;
            text-decoration: none;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .quick-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .quick-card-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px;
        }

        .quick-card-icon svg { width: 22px; height: 22px; }

        .quick-card-label { font-size: 13px; font-weight: 600; color: #0f172a; }
        .quick-card-sub { font-size: 11px; color: #94a3b8; margin-top: 3px; }

        /* Info Row */
        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 700px) { .info-row { grid-template-columns: 1fr; } }

        /* Activity Item */
        .activity-item {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item:last-child { border-bottom: none; }

        .activity-dot {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .activity-dot svg { width: 18px; height: 18px; }

        .activity-info { flex: 1; }
        .activity-info-title { font-size: 14px; font-weight: 500; color: #0f172a; }
        .activity-info-time { font-size: 12px; color: #94a3b8; margin-top: 2px; }

        /* Tips Card */
        .tip-item {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .tip-item:last-child { border-bottom: none; }

        .tip-emoji { font-size: 20px; flex-shrink: 0; margin-top: 2px; }

        .tip-text { font-size: 13px; color: #475569; line-height: 1.5; }
        .tip-title { font-weight: 600; color: #0f172a; font-size: 13px; margin-bottom: 2px; }

        /* ===== DASHBOARD MOBILE RESPONSIVE ===== */
        @media (max-width: 768px) {
            .welcome-banner {
                padding: 24px 20px;
                border-radius: 16px;
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }

            .welcome-text h2 { font-size: 20px; }
            .welcome-text p { font-size: 13px; margin-bottom: 14px; }

            .welcome-actions { justify-content: center; }
            .welcome-btn { font-size: 12px; padding: 8px 14px; }

            .welcome-illustration {
                font-size: 50px;
                margin-left: 0;
            }

            .stat-cards-grid { gap: 10px; margin-bottom: 20px; }
            .stat-card-new {
                padding: 14px;
                border-radius: 12px;
                gap: 12px;
            }
            .stat-icon-new { width: 44px; height: 44px; border-radius: 10px; }
            .stat-icon-new svg { width: 20px; height: 20px; }
            .stat-info-value { font-size: 22px; }
            .stat-info-label { font-size: 12px; }
            .stat-info-trend { font-size: 11px; }

            .info-row { gap: 14px; margin-bottom: 20px !important; }

            .section-title { font-size: 15px; margin-bottom: 12px; }

            .quick-grid { gap: 10px; margin-bottom: 20px; }
            .quick-card {
                padding: 14px 10px;
                border-radius: 12px;
            }
            .quick-card-icon {
                width: 42px; height: 42px;
                border-radius: 10px;
                margin-bottom: 8px;
            }
            .quick-card-icon svg { width: 18px; height: 18px; }
            .quick-card-label { font-size: 12px; }
            .quick-card-sub { font-size: 10px; }
        }

        @media (max-width: 480px) {
            .welcome-banner { padding: 20px 16px; }
            .welcome-text h2 { font-size: 18px; }

            .stat-cards-grid { grid-template-columns: 1fr !important; gap: 8px; }

            .quick-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 8px; }
        }

        @media (max-width: 768px) {
            .dashboard-panel {
                padding: 16px !important;
                border-radius: 14px !important;
            }
            .dashboard-panel h3 {
                font-size: 15px !important;
            }
            .dashboard-panel p {
                font-size: 12px !important;
            }

            .denda-item {
                padding: 10px !important;
                border-radius: 10px !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 8px !important;
            }
            .denda-item > div:last-child {
                text-align: left !important;
            }
        }
    </style>

    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-text">
            <h2>Halo, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
            <p>Selamat datang di Knowledge Tree. Kelola semua data dengan mudah.</p>
            <div class="welcome-actions">
                <a href="{{ route('bukus.create') }}" class="welcome-btn welcome-btn-primary">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Buku
                </a>
                <a href="{{ route('peminjamans.create') }}" class="welcome-btn welcome-btn-outline">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Catat Peminjaman
                </a>
            </div>
        </div>
        <div class="welcome-illustration">📚</div>
    </div>

    <!-- Stat Cards -->
    <div class="stat-cards-grid">
        <a href="{{ route('siswas.index') }}" class="stat-card-new blue">
            <div class="stat-icon-new blue">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-info-label">Total Siswa</div>
                <div class="stat-info-value">{{ \App\Models\Siswa::count() }}</div>
                <div class="stat-info-trend">▲ Aktif terdaftar</div>
            </div>
            <div class="stat-arrow">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <a href="{{ route('kategoris.index') }}" class="stat-card-new green">
            <div class="stat-icon-new green">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-info-label">Kategori Buku</div>
                <div class="stat-info-value">{{ \App\Models\Kategori::count() }}</div>
                <div class="stat-info-trend">▲ Kategori tersedia</div>
            </div>
            <div class="stat-arrow">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <a href="{{ route('bukus.index') }}" class="stat-card-new purple">
            <div class="stat-icon-new purple">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-info-label">Total Buku</div>
                <div class="stat-info-value">{{ \App\Models\Buku::count() }}</div>
                <div class="stat-info-trend">▲ Koleksi tersedia</div>
            </div>
            <div class="stat-arrow">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <a href="{{ route('peminjamans.index') }}" class="stat-card-new orange">
            <div class="stat-icon-new orange">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-info-label">Peminjaman</div>
                <div class="stat-info-value">{{ \App\Models\Peminjaman::count() }}</div>
                <div class="stat-info-trend">▲ Total catatan</div>
            </div>
            <div class="stat-arrow">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>
    </div>

    <div class="info-row" style="margin-bottom:28px;">
        <div class="dashboard-panel" style="background:white;border:1px solid #e2e8f0;border-radius:18px;padding:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px;flex-wrap:wrap;">
                <div>
                    <h3 style="font-size:17px;font-weight:700;color:#0f172a;margin:0;">Laporan Denda Bulanan</h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Ringkasan denda dari peminjaman yang sudah dikembalikan.</p>
                </div>
                <div style="font-size:13px;color:#475569;">Bulan ini: Rp {{ number_format($monthlyTotals[now()->month] ?? 0, 0, ',', '.') }}</div>
            </div>
            <div style="background:#f8fafc;border-radius:14px;padding:24px;text-align:center;max-width:300px;margin:auto;">
                <div style="font-size:14px;color:#64748b;margin-bottom:8px;">Total Denda di Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
                <div style="font-size:32px;font-weight:800;color:#0f172a;">
                    Rp {{ number_format($monthlyTotals[now()->month] ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="dashboard-panel" style="background:white;border:1px solid #e2e8f0;border-radius:18px;padding:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:18px;">
                <div>
                    <h3 style="font-size:17px;font-weight:700;color:#0f172a;margin:0;">Histori Denda</h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Transaksi terakhir yang memiliki denda atau peminjaman terlambat.</p>
                </div>
                <div style="font-size:13px;color:#475569;">Terlambat saat ini: {{ $activeLateCount }} transaksi</div>
            </div>
            @if($recentFineHistory->isEmpty())
                <div style="color:#64748b;font-size:13px;">Tidak ada histori denda terbaru.</div>
            @else
                <div style="display:grid;gap:12px;">
                    @foreach($recentFineHistory as $item)
                        @php
                            $eventFine = $item->status === 'dipinjam' ? $item->hitungDenda() : $item->denda;
                        @endphp
                        <div class="denda-item" style="display:flex;align-items:center;justify-content:space-between;gap:12px;border:1px solid #e2e8f0;border-radius:14px;padding:14px;">
                            <div>
                                <div style="font-size:14px;font-weight:600;color:#0f172a;">{{ $item->siswa->nama ?? 'N/A' }}</div>
                                <div style="font-size:12px;color:#64748b;">{{ $item->buku->judul ?? 'Buku tidak tersedia' }}</div>
                                <div style="font-size:11px;color:#94a3b8;margin-top:6px;">{{ $item->status === 'dipinjam' ? 'Batas kembali: '.$item->batas_kembali : 'Tanggal kembali: '.$item->tanggal_kembali }}</div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-size:14px;font-weight:700;color:#dc2626;">Rp {{ number_format($eventFine, 0, ',', '.') }}</div>
                                <div style="font-size:11px;color:#64748b;margin-top:4px;">{{ ucfirst($item->status) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="section-title">Akses Cepat</div>
    <div class="quick-grid">
        <a href="{{ route('siswas.create') }}" class="quick-card">
            <div class="quick-card-icon" style="background:#eff6ff; color:#3b82f6">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <div class="quick-card-label">Tambah Siswa</div>
            <div class="quick-card-sub">Daftarkan siswa baru</div>
        </a>

        <a href="{{ route('kategoris.create') }}" class="quick-card">
            <div class="quick-card-icon" style="background:#f0fdf4; color:#10b981">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div class="quick-card-label">Tambah Kategori</div>
            <div class="quick-card-sub">Buat kategori buku</div>
        </a>

        <a href="{{ route('bukus.create') }}" class="quick-card">
            <div class="quick-card-icon" style="background:#faf5ff; color:#8b5cf6">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="quick-card-label">Tambah Buku</div>
            <div class="quick-card-sub">Input koleksi baru</div>
        </a>

        <a href="{{ route('peminjamans.create') }}" class="quick-card">
            <div class="quick-card-icon" style="background:#fffbeb; color:#f59e0b">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="quick-card-label">Catat Peminjaman</div>
            <div class="quick-card-sub">Proses peminjaman baru</div>
        </a>
    </div>

   

        
                
            </div>
        </div>
    </div>
</x-app-layout>

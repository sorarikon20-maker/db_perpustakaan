<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital — Sistem Manajemen Perpustakaan</title>
    <meta name="description" content="Sistem manajemen perpustakaan modern untuk mengelola buku, siswa, dan peminjaman dengan mudah.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #a855f7;
            --dark: #0f172a;
            --dark-2: #1e293b;
            --dark-3: #334155;
            --text-muted: rgba(255,255,255,0.55);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== ANIMATED BACKGROUND ===== */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: radial-gradient(ellipse 80% 60% at 50% -10%, rgba(99,102,241,0.25) 0%, transparent 60%),
                        radial-gradient(ellipse 60% 50% at 80% 80%, rgba(139,92,246,0.15) 0%, transparent 60%),
                        radial-gradient(ellipse 50% 40% at 10% 90%, rgba(168,85,247,0.1) 0%, transparent 60%),
                        #0f172a;
        }

        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Floating orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            animation: float 8s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }

        .orb-1 {
            width: 500px; height: 500px;
            background: rgba(99,102,241,0.12);
            top: -150px; left: -150px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 400px; height: 400px;
            background: rgba(139,92,246,0.1);
            bottom: -100px; right: -100px;
            animation-delay: 3s;
        }

        .orb-3 {
            width: 300px; height: 300px;
            background: rgba(168,85,247,0.08);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            33% { transform: translateY(-20px) scale(1.04); }
            66% { transform: translateY(10px) scale(0.98); }
        }

        /* ===== LAYOUT ===== */
        .wrapper { position: relative; z-index: 1; }

        /* ===== NAVBAR ===== */
        nav.topnav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 48px;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            background: rgba(15,23,42,0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            transition: all 0.3s;
        }

        .nav-logo {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 15px rgba(99,102,241,0.4);
        }

        .nav-logo-icon svg { width: 18px; height: 18px; fill: white; }

        .nav-logo-text {
            font-size: 16px; font-weight: 700; color: white;
        }

        .nav-logo-text span {
            color: #a5b4fc;
        }

        .nav-actions { display: flex; align-items: center; gap: 10px; }

        .nav-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 14px; font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .nav-btn-outline {
            color: rgba(255,255,255,0.75);
            border: 1px solid rgba(255,255,255,0.12);
        }

        .nav-btn-outline:hover {
            background: rgba(255,255,255,0.06);
            color: white;
            border-color: rgba(255,255,255,0.2);
        }

        .nav-btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px rgba(99,102,241,0.35);
        }

        .nav-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99,102,241,0.5);
            color: white;
        }

        /* ===== HERO ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 100px;
            font-size: 13px;
            color: #a5b4fc;
            font-weight: 500;
            margin-bottom: 28px;
            animation: fadeInDown 0.6s ease;
        }

        .hero-badge-dot {
            width: 6px; height: 6px;
            background: #6366f1;
            border-radius: 50%;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-size: clamp(40px, 7vw, 76px);
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: -0.03em;
            margin-bottom: 24px;
            animation: fadeInUp 0.7s ease 0.1s both;
        }

        .hero-title-gradient {
            background: linear-gradient(135deg, #a5b4fc 0%, #c4b5fd 40%, #e879f9 80%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 18px;
            color: rgba(255,255,255,0.55);
            max-width: 560px;
            line-height: 1.7;
            margin-bottom: 40px;
            animation: fadeInUp 0.7s ease 0.2s both;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeInUp 0.7s ease 0.3s both;
            margin-bottom: 80px;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s;
            font-family: 'Inter', sans-serif;
        }

        .hero-btn-cta {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 8px 30px rgba(99,102,241,0.4);
        }

        .hero-btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(99,102,241,0.55);
            color: white;
        }

        .hero-btn-ghost {
            color: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.04);
        }

        .hero-btn-ghost:hover {
            background: rgba(255,255,255,0.08);
            color: white;
            border-color: rgba(255,255,255,0.2);
        }

        .hero-btn svg { width: 18px; height: 18px; }

        /* ===== STATS BAR ===== */
        .stats-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            animation: fadeInUp 0.7s ease 0.4s both;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item-value {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #a5b4fc, #c4b5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
        }

        .stat-item-label {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            margin-top: 4px;
        }

        .stat-divider {
            width: 1px;
            height: 40px;
            background: rgba(255,255,255,0.1);
        }

        /* ===== FEATURES SECTION ===== */
        .section {
            padding: 100px 48px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #a5b4fc;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 16px;
        }

        .section-desc {
            color: rgba(255,255,255,0.5);
            font-size: 16px;
            line-height: 1.7;
            max-width: 560px;
            margin-bottom: 56px;
        }

        /* Feature Cards */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .feature-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            padding: 28px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .favorite-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .favorite-card {
            display: flex;
            gap: 18px;
            padding: 20px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            align-items: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .favorite-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .favorite-cover {
            width: 110px;
            min-width: 110px;
            height: 150px;
            border-radius: 18px;
            overflow: hidden;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .favorite-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .favorite-meta {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .favorite-meta h3 {
            margin: 0;
            font-size: 18px;
            line-height: 1.3;
        }

        .favorite-meta p {
            margin: 0;
            color: rgba(255,255,255,0.65);
            font-size: 14px;
        }

        .favorite-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(99,102,241,0.14);
            color: #e0e7ff;
            font-size: 13px;
            font-weight: 600;
            width: fit-content;
        }
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--card-color, #6366f1), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feature-card:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.12);
            transform: translateY(-4px);
        }

        .feature-card:hover::before { opacity: 1; }

        .feature-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
        }

        .feature-icon svg { width: 24px; height: 24px; }

        .feature-title {
            font-size: 16px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
        }

        .feature-desc {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
            line-height: 1.65;
        }

        /* ===== CTA SECTION ===== */
        .cta-section {
            padding: 60px 24px 120px;
        }

        .cta-card {
            max-width: 800px;
            margin: 0 auto;
            background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(139,92,246,0.1));
            border: 1px solid rgba(99,102,241,0.25);
            border-radius: 28px;
            padding: 56px 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 0%, rgba(99,102,241,0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-emoji { font-size: 48px; margin-bottom: 20px; display: block; }

        .cta-title {
            font-size: clamp(24px, 4vw, 36px);
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 14px;
        }

        .cta-desc {
            color: rgba(255,255,255,0.55);
            font-size: 15px;
            line-height: 1.7;
            max-width: 480px;
            margin: 0 auto 32px;
        }

        .cta-btns {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* ===== FOOTER ===== */
        footer {
            padding: 32px 48px;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-logo {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }

        .footer-logo-icon {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .footer-logo-icon svg { width: 14px; height: 14px; fill: white; }

        .footer-logo-text { font-size: 14px; font-weight: 600; color: rgba(255,255,255,0.7); }

        .footer-copy { font-size: 13px; color: rgba(255,255,255,0.3); }

        .footer-links { display: flex; gap: 20px; }

        .footer-link {
            font-size: 13px;
            color: rgba(255,255,255,0.35);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-link:hover { color: rgba(255,255,255,0.7); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            nav.topnav { padding: 14px 20px; }
            .section { padding: 60px 20px; }
            .cta-card { padding: 40px 24px; }
            footer { padding: 24px 20px; flex-direction: column; text-align: center; }
            .stats-bar { gap: 24px; }
            .stat-divider { display: none; }
        }

        /* ===== SCROLL ANIMATION ===== */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-canvas"></div>
    <div class="bg-grid"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="wrapper">
        <!-- NAVBAR -->
        <nav class="topnav">
            <a href="{{ url('/') }}" class="nav-logo">
                <div>
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="nav-logo-icon">
                </div>
                <span class="nav-logo-text">Knowledge<span>Tree</span></span>
            </a>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-btn nav-btn-primary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="nav-btn nav-btn-outline">Masuk</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Daftar Gratis</a>
                    @endif
                @endauth
            </div>
        </nav>

        <!-- HERO SECTION -->
        <section class="hero">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Sistem Manajemen Perpustakaan Modern
            </div>

            <h1 class="hero-title">
                Kelola Perpustakaan<br>
                <span class="hero-title-gradient">Lebih Cerdas & Efisien</span>
            </h1>

            <p class="hero-desc">
                Platform digital terpadu untuk mengelola data siswa, koleksi buku, kategori, dan transaksi peminjaman dalam satu panel admin yang intuitif.
            </p>

            <div class="hero-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="hero-btn hero-btn-cta">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hero-btn hero-btn-cta">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Mulai Sekarang
                    </a>
                    <a href="#favorite" class="hero-btn hero-btn-ghost">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        koleksi Favorit
                    </a>
                    <a href="#fitur" class="hero-btn hero-btn-ghost">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        Lihat Fitur
                    </a>
                    
                @endauth
            </div>

            <!-- Stats -->
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-item-value">{{ \App\Models\Siswa::count() }}+</div>
                    <div class="stat-item-label">Siswa Terdaftar</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-item-value">{{ \App\Models\Buku::count() }}+</div>
                    <div class="stat-item-label">Koleksi Buku</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-item-value">{{ \App\Models\Peminjaman::count() }}+</div>
                    <div class="stat-item-label">Transaksi Peminjaman</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-item-value">{{ \App\Models\Kategori::count() }}+</div>
                    <div class="stat-item-label">Kategori Buku</div>
                </div>
            </div>
        </section>

        <section class="section" id="favorite">
            <div class="reveal">
                <div class="section-tag">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    Koleksi Favorit
                </div>
                <h2 class="section-title">Buku paling sering dipinjam</h2>
                <p class="section-desc">Temukan rekomendasi buku favorit berdasarkan frekuensi peminjaman siswa perpustakaan.</p>
            </div>

            <div class="favorite-grid">
                @forelse($favoriteBooks as $buku)
                    <article class="favorite-card reveal">
                        <div class="favorite-cover">
                            <img src="{{ $buku->cover_image ? asset('storage/'.$buku->cover_image) : 'https://via.placeholder.com/110x150?text=Cover' }}" alt="Cover {{ $buku->judul }}">
                        </div>
                        <div class="favorite-meta">
                            <h3>{{ $buku->judul }}</h3>
                            <p>{{ $buku->penulis }} · {{ $buku->tahun_terbit }}</p>
                            <span class="favorite-badge">Dipinjam {{ $buku->peminjamans_count }}x</span>
                        </div>
                    </article>
                @empty
                    <div class="favorite-card reveal" style="grid-column:1/-1;justify-content:center;text-align:center;">
                        <div>
                            <p style="margin:0 0 8px;color:rgba(255,255,255,0.75);">Belum ada buku favorit untuk ditampilkan.</p>
                            <p style="margin:0;color:rgba(255,255,255,0.45);font-size:14px;">Tambahkan koleksi buku dan lakukan peminjaman agar rekomendasi muncul.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- FEATURES SECTION -->
        <section class="section" id="fitur">
            <div class="reveal">
                <div class="section-tag">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    Fitur Unggulan
                </div>
                <h2 class="section-title">Semua yang kamu butuhkan<br>dalam satu platform</h2>
                <p class="section-desc">Dirancang khusus untuk pengelolaan perpustakaan sekolah yang efisien, cepat, dan mudah digunakan.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card reveal" style="--card-color: #6366f1">
                    <div class="feature-icon" style="background: rgba(99,102,241,0.15)">
                        <svg fill="none" stroke="#a5b4fc" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="feature-title">Manajemen Siswa</div>
                    <div class="feature-desc">Daftarkan dan kelola data siswa dengan lengkap termasuk NIS, kelas, dan jurusan. Pencarian cepat dan mudah.</div>
                </div>

                <div class="feature-card reveal" style="--card-color: #10b981">
                    <div class="feature-icon" style="background: rgba(16,185,129,0.15)">
                        <svg fill="none" stroke="#6ee7b7" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="feature-title">Katalog Buku</div>
                    <div class="feature-desc">Kelola koleksi buku secara lengkap dengan informasi judul, penulis, tahun terbit, kategori, dan stok tersedia.</div>
                </div>

                <div class="feature-card reveal" style="--card-color: #f59e0b">
                    <div class="feature-icon" style="background: rgba(245,158,11,0.15)">
                        <svg fill="none" stroke="#fcd34d" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <div class="feature-title">Rekap Peminjaman</div>
                    <div class="feature-desc">Catat dan pantau transaksi peminjaman buku secara real-time dengan status dipinjam atau dikembalikan.</div>
                </div>

                <div class="feature-card reveal" style="--card-color: #8b5cf6">
                    <div class="feature-icon" style="background: rgba(139,92,246,0.15)">
                        <svg fill="none" stroke="#c4b5fd" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="feature-title">Kategori Buku</div>
                    <div class="feature-desc">Buat dan atur kategori buku untuk memudahkan pengelompokan koleksi perpustakaan secara terstruktur.</div>
                </div>

                <div class="feature-card reveal" style="--card-color: #ef4444">
                    <div class="feature-icon" style="background: rgba(239,68,68,0.15)">
                        <svg fill="none" stroke="#fca5a5" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="feature-title">Dashboard Statistik</div>
                    <div class="feature-desc">Pantau semua data dalam satu dashboard dengan statistik ringkas untuk pengambilan keputusan yang lebih baik.</div>
                </div>

                <div class="feature-card reveal" style="--card-color: #06b6d4">
                    <div class="feature-icon" style="background: rgba(6,182,212,0.15)">
                        <svg fill="none" stroke="#67e8f9" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div class="feature-title">Pencarian Cepat</div>
                    <div class="feature-desc">Temukan data buku, siswa, atau peminjaman dengan fitur pencarian yang cepat dan akurat di setiap halaman.</div>
                </div>
            </div>
        </section>

        

        <!-- FOOTER -->
        <footer>
            <a href="{{ url('/') }}" class="footer-logo">
                <div class="footer-logo-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <span class="footer-logo-text">Perpustakaan Digital</span>
            </a>

            <p class="footer-copy">© {{ date('Y') }} Sistem Manajemen Perpustakaan. All rights reserved.</p>

            <div class="footer-links">
                <a href="{{ route('login') }}" class="footer-link">Masuk</a>
                <a href="{{ route('register') }}" class="footer-link">Daftar</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a>
                @endauth
            </div>
        </footer>
    </div>

    <script>
        // Scroll reveal animation
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        reveals.forEach(el => observer.observe(el));

        // Navbar scroll effect
        const nav = document.querySelector('nav.topnav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.style.background = 'rgba(15,23,42,0.95)';
            } else {
                nav.style.background = 'rgba(15,23,42,0.8)';
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(a.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    </script>
</body>
</html>

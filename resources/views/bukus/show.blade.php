<x-app-layout>
    @php $header = 'Detail Buku'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('bukus.index') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Detail Buku</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Informasi lengkap tentang buku ini</p>
            </div>
            <div style="display:flex;gap:10px">
                <a href="{{ route('bukus.edit', $buku) }}" class="btn btn-warning btn-sm">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <a href="{{ route('bukus.index') }}" class="btn btn-secondary btn-sm">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Book Detail Card --}}
        <div class="card" style="overflow:hidden">
            <div style="display:flex;gap:0;flex-wrap:wrap">
                {{-- Cover Image Section --}}
                <div style="width:320px;min-height:400px;background:linear-gradient(135deg,#1e1b4b,#312e81);display:flex;align-items:center;justify-content:center;position:relative;flex-shrink:0">
                    @if($buku->cover_image)
                        <img src="{{ asset('storage/'.$buku->cover_image) }}" alt="Cover {{ $buku->judul }}" style="width:100%;height:100%;object-fit:cover">
                    @else
                        <div style="text-align:center;padding:40px">
                            <div style="width:120px;height:160px;border:3px dashed rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
                                <svg fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" viewBox="0 0 24 24" style="width:48px;height:48px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <p style="color:rgba(255,255,255,0.5);font-size:13px;margin:0">Tidak ada sampul</p>
                        </div>
                    @endif

                    {{-- Overlay gradient --}}
                    <div style="position:absolute;bottom:0;left:0;right:0;height:80px;background:linear-gradient(to top,rgba(30,27,75,0.8),transparent)"></div>
                </div>

                {{-- Book Info Section --}}
                <div style="flex:1;min-width:300px">
                    <div style="padding:32px">
                        {{-- Title --}}
                        <h2 style="font-size:26px;font-weight:800;color:#0f172a;margin:0 0 8px;line-height:1.3">{{ $buku->judul }}</h2>
                        <p style="font-size:16px;color:#6366f1;font-weight:500;margin:0 0 24px">{{ $buku->penulis }}</p>

                        {{-- Badges --}}
                        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px">
                            @if($buku->kategori)
                                <span class="badge badge-primary" style="font-size:12px;padding:5px 14px">{{ $buku->kategori->nama_kategori }}</span>
                            @endif
                            <span class="badge badge-secondary" style="font-size:12px;padding:5px 14px">📅 {{ $buku->tahun_terbit }}</span>
                            @if($buku->rak_nomor)
                                <span class="badge badge-info" style="font-size:12px;padding:5px 14px">📍 Rak {{ $buku->rak_nomor }}</span>
                            @endif
                            @php $stok = $buku->stok ?? 0; @endphp
                            <span class="badge {{ $stok > 5 ? 'badge-success' : ($stok > 0 ? 'badge-warning' : 'badge-danger') }}" style="font-size:12px;padding:5px 14px">
                                {{ $stok > 0 ? "✓ Stok: $stok unit" : "✗ Stok Habis" }}
                            </span>
                        </div>

                        {{-- Detail Grid --}}
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
                            <div style="padding:16px;background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0">
                                <div style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px">Penerbit</div>
                                <div style="font-size:14px;font-weight:600;color:#0f172a">{{ $buku->penerbit ?: 'Tidak tersedia' }}</div>
                            </div>
                            <div style="padding:16px;background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0">
                                <div style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px">Tahun Terbit</div>
                                <div style="font-size:14px;font-weight:600;color:#0f172a">{{ $buku->tahun_terbit }}</div>
                            </div>
                            <div style="padding:16px;background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0">
                                <div style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px">Nomor Rak</div>
                                <div style="font-size:14px;font-weight:600;color:#0f172a">{{ $buku->rak_nomor ?: 'Belum diatur' }}</div>
                            </div>
                            <div style="padding:16px;background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0">
                                <div style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px">Jumlah Stok</div>
                                <div style="font-size:14px;font-weight:600;color:#0f172a">{{ $stok }} unit</div>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        @if($buku->deskripsi)
                            <div style="border-top:1px solid #e2e8f0;padding-top:20px">
                                <h3 style="font-size:15px;font-weight:700;color:#0f172a;margin:0 0 10px;display:flex;align-items:center;gap:8px">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                                    Deskripsi
                                </h3>
                                <p style="font-size:14px;color:#475569;line-height:1.7;margin:0;white-space:pre-line">{{ $buku->deskripsi }}</p>
                            </div>
                        @else
                            <div style="border-top:1px solid #e2e8f0;padding-top:20px">
                                <div style="text-align:center;padding:20px;color:#94a3b8">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="width:32px;height:32px;margin:0 auto 8px;display:block"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                                    <p style="font-size:13px;margin:0">Belum ada deskripsi untuk buku ini</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            [style*="width:320px"] {
                width: 100% !important;
                min-height: 250px !important;
            }
            [style*="min-width:300px"] {
                min-width: 0 !important;
            }
        }
    </style>
</x-app-layout>

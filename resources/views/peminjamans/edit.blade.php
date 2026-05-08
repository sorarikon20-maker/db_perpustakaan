<x-app-layout>
    @php $header = 'Edit Peminjaman'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('peminjamans.index') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Edit Peminjaman</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Perbarui data peminjaman <strong style="color:#6366f1">#{{ $peminjaman->id }}</strong></p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(245,158,11,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
        </div>

        {{-- Info Banners --}}
        @php
            $terlambat = $peminjaman->isTerlambat();
            $dendaSekarang = $terlambat ? $peminjaman->hitungDenda() : 0;
        @endphp

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px">
            {{-- Petugas Info --}}
            <div style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1px solid #c7d2fe;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:12px">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <p style="font-size:12px;color:#4338ca;margin:0;font-weight:600">Dicatat oleh</p>
                    <p style="font-size:13px;color:#6366f1;margin:2px 0 0">{{ $peminjaman->user ? $peminjaman->user->name : Auth::user()->name }}</p>
                </div>
            </div>

            {{-- Status / Denda --}}
            @if($terlambat)
                <div style="background:linear-gradient(135deg,#fef2f2,#fee2e2);border:1px solid #fecaca;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:12px">
                    <div style="width:36px;height:36px;border-radius:10px;background:rgba(239,68,68,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <svg fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <p style="font-size:12px;color:#991b1b;margin:0;font-weight:600">🚨 TERLAMBAT</p>
                        <p style="font-size:13px;color:#dc2626;margin:2px 0 0;font-weight:600">Denda: Rp {{ number_format($dendaSekarang, 0, ',', '.') }}</p>
                    </div>
                </div>
            @else
                <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:12px">
                    <div style="width:36px;height:36px;border-radius:10px;background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <svg fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p style="font-size:12px;color:#92400e;margin:0;font-weight:600">Info Denda</p>
                        <p style="font-size:13px;color:#a16207;margin:2px 0 0">Rp 5.000/hari/buku jika terlambat</p>
                    </div>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('peminjamans.update', $peminjaman) }}" id="formPeminjaman">
            @csrf
            @method('PUT')

            {{-- Section 1: Data Peminjam & Buku --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        Data Peminjam & Buku
                    </h3>
                    <span class="badge badge-warning" style="font-size:12px;padding:5px 14px">Editing</span>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="siswa_id" class="form-label">Siswa <span style="color:#ef4444">*</span></label>
                            <select name="siswa_id" id="siswa_id" class="form-control" required>
                                <option value="">— Pilih Siswa —</option>
                                @foreach($siswas as $siswa)
                                    <option value="{{ $siswa->id }}" {{ old('siswa_id', $peminjaman->siswa_id) == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->nama }} ({{ $siswa->nis }})
                                    </option>
                                @endforeach
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Siswa yang meminjam buku</p>
                            @error('siswa_id')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="buku_id" class="form-label">Buku <span style="color:#ef4444">*</span></label>
                            <select name="buku_id" id="buku_id" class="form-control" required>
                                <option value="">— Pilih Buku —</option>
                                @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" 
                                            data-stok="{{ $buku->stok }}"
                                            {{ old('buku_id', $peminjaman->buku_id) == $buku->id ? 'selected' : '' }}
                                            {{ $buku->stok <= 0 && $buku->id != $peminjaman->buku_id ? 'style=color:#ef4444' : '' }}>
                                        {{ $buku->judul }} — {{ $buku->penulis }} [Stok: {{ $buku->stok }}]
                                    </option>
                                @endforeach
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Buku yang dipinjam</p>
                            @error('buku_id')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                            <div id="stokInfo" style="margin-top:8px;display:none"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Jadwal --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        Jadwal Peminjaman
                    </h3>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span style="color:#ef4444">*</span></label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}" class="form-control" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Tanggal dimulainya peminjaman</p>
                            @error('tanggal_pinjam')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="batas_kembali" class="form-label">Batas Kembali <span style="color:#ef4444">*</span></label>
                            <input type="date" name="batas_kembali" id="batas_kembali" value="{{ old('batas_kembali', $peminjaman->batas_kembali) }}" class="form-control" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Denda Rp 5.000/hari jika melewati batas</p>
                            @error('batas_kembali')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="tanggal_kembali" class="form-label">Tanggal Dikembalikan <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}" class="form-control">
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Isi saat buku telah dikembalikan</p>
                            @error('tanggal_kembali')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Status <span style="color:#ef4444">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="dipinjam" {{ old('status', $peminjaman->status) == 'dipinjam' ? 'selected' : '' }}>📤 Dipinjam</option>
                                <option value="dikembalikan" {{ old('status', $peminjaman->status) == 'dikembalikan' ? 'selected' : '' }}>✅ Dikembalikan</option>
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Status peminjaman saat ini</p>
                            @error('status')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:12px;justify-content:space-between;align-items:center">
                <p style="font-size:13px;color:#94a3b8;margin:0">
                    <span style="color:#ef4444">*</span> Menandakan kolom wajib diisi
                </p>
                <div style="display:flex;gap:10px">
                    <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning" id="btnSubmit">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Update Peminjaman
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bukuSelect = document.getElementById('buku_id');
            const statusSelect = document.getElementById('status');
            const stokInfo = document.getElementById('stokInfo');
            const btnSubmit = document.getElementById('btnSubmit');
            const currentBukuId = '{{ $peminjaman->buku_id }}';
            const currentStatus = '{{ $peminjaman->status }}';

            function updateStokInfo() {
                const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
                const newStatus = statusSelect.value;

                if (!selectedOption || !selectedOption.value) {
                    stokInfo.style.display = 'none';
                    btnSubmit.disabled = false;
                    btnSubmit.style.opacity = '1';
                    return;
                }

                const stok = parseInt(selectedOption.getAttribute('data-stok'));
                const newBukuId = selectedOption.value;

                let effectiveStok = stok;
                if (newBukuId === currentBukuId && currentStatus === 'dipinjam') {
                    effectiveStok = stok + 1;
                }

                stokInfo.style.display = 'block';

                if (newStatus === 'dipinjam') {
                    let stokUntukCek = stok;
                    if (newBukuId === currentBukuId && currentStatus === 'dipinjam') {
                        stokUntukCek = effectiveStok;
                    }

                    if (stokUntukCek <= 0) {
                        stokInfo.innerHTML = `
                            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:8px">
                                <span style="font-size:13px;color:#991b1b;font-weight:600">❌ Stok habis! Buku ini tidak bisa dipinjam saat ini.</span>
                            </div>
                        `;
                        btnSubmit.disabled = true;
                        btnSubmit.style.opacity = '0.5';
                        btnSubmit.style.cursor = 'not-allowed';
                        return;
                    } else if (stokUntukCek <= 3) {
                        stokInfo.innerHTML = `
                            <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:8px">
                                <span style="font-size:13px;color:#92400e">⚠️ Stok tersisa: <strong>${stok} buku</strong> — Stok hampir habis!</span>
                            </div>
                        `;
                    } else {
                        stokInfo.innerHTML = `
                            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:8px">
                                <span style="font-size:13px;color:#166534">✅ Stok tersedia: <strong>${stok} buku</strong></span>
                            </div>
                        `;
                    }
                } else {
                    stokInfo.innerHTML = `
                        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:8px">
                            <span style="font-size:13px;color:#166534">📦 Stok saat ini: <strong>${stok} buku</strong> (akan bertambah setelah dikembalikan)</span>
                        </div>
                    `;
                }

                btnSubmit.disabled = false;
                btnSubmit.style.opacity = '1';
                btnSubmit.style.cursor = 'pointer';
            }

            bukuSelect.addEventListener('change', updateStokInfo);
            statusSelect.addEventListener('change', updateStokInfo);

            updateStokInfo();
        });
    </script>
</x-app-layout>
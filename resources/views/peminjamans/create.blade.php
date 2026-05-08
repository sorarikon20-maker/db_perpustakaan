<x-app-layout>
    @php $header = 'Catat Peminjaman'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('peminjamans.index') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Catat Peminjaman Baru</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Isi formulir di bawah untuk mencatat transaksi peminjaman buku</p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(99,102,241,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>

        {{-- Info Banners --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px">
            {{-- Petugas Info --}}
            <div style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1px solid #c7d2fe;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:12px">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <p style="font-size:12px;color:#4338ca;margin:0;font-weight:600">Petugas</p>
                    <p style="font-size:13px;color:#6366f1;margin:2px 0 0">{{ Auth::user()->name }}</p>
                </div>
            </div>

            {{-- Denda Info --}}
            @php $dendaPerHari = \App\Models\Setting::get('denda_per_hari', 5000); @endphp
            <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:14px;padding:16px 20px;display:flex;align-items:center;gap:12px">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p style="font-size:12px;color:#92400e;margin:0;font-weight:600">Info Denda</p>
                    <p style="font-size:13px;color:#a16207;margin:2px 0 0">Rp {{ number_format($dendaPerHari, 0, ',', '.') }}/hari/buku jika terlambat</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('peminjamans.store') }}" id="formPeminjaman">
            @csrf

            {{-- Section 1: Peminjam --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        Data Peminjam
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:0">
                        <label for="siswa_id" class="form-label">Siswa <span style="color:#ef4444">*</span></label>
                        <select name="siswa_id" id="siswa_id" class="form-control" required>
                            <option value="">— Pilih Siswa —</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama }} ({{ $siswa->nis }}) — {{ $siswa->kelas }} {{ $siswa->jurusan }}
                                </option>
                            @endforeach
                        </select>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Pilih siswa yang akan melakukan peminjaman</p>
                        @error('siswa_id')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Pilih Buku --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header" style="flex-wrap:wrap;gap:12px">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </span>
                        Pilih Buku
                    </h3>
                    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
                        <div id="bookSelectionInfo" style="display:none">
                            <span class="badge badge-success" style="font-size:12px;padding:5px 14px">
                                📚 <strong id="bookCount">0</strong> buku dipilih
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @error('buku_ids')
                        <p style="color:#ef4444;font-size:13px;margin-bottom:12px">{{ $message }}</p>
                    @enderror

                    {{-- Search Input --}}
                    <div style="margin-bottom:16px">
                        <div style="position:relative">
                            <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;pointer-events:none">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" id="bookSearchInput" placeholder="Cari judul buku atau penulis..." style="width:100%;padding:11px 14px 11px 44px;border:1px solid #e2e8f0;border-radius:12px;font-size:14px;font-family:'Inter',sans-serif;color:#0f172a;background:white;outline:none;transition:all 0.2s" onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)'" onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                        </div>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0" id="bookSearchHint">Menampilkan 5 buku pertama. Ketik untuk mencari buku lainnya.</p>
                    </div>

                    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(220px, 1fr));gap:12px" id="bookGrid">
                        @forelse($bukus as $buku)
                            <label class="book-card" data-judul="{{ strtolower($buku->judul) }}" data-penulis="{{ strtolower($buku->penulis) }}" style="display:flex;align-items:flex-start;padding:14px;border:2px solid #e2e8f0;border-radius:14px;cursor:{{ $buku->stok <= 0 ? 'not-allowed' : 'pointer' }};transition:all 0.2s;background:{{ $buku->stok <= 0 ? '#f8fafc' : 'white' }};opacity:{{ $buku->stok <= 0 ? '0.6' : '1' }}" onmouseover="if({{ $buku->stok }}>0){this.style.borderColor='#a5b4fc';this.style.background='#eef2ff';this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(99,102,241,0.1)'}" onmouseout="if({{ $buku->stok }}>0){this.style.borderColor=this.querySelector('input').checked?'#6366f1':'#e2e8f0';this.style.background=this.querySelector('input').checked?'#eef2ff':'white';this.style.transform='none';this.style.boxShadow='none'}">
                                <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}" 
                                       style="margin-right:12px;margin-top:2px;cursor:pointer;width:18px;height:18px;accent-color:#6366f1"
                                       {{ collect(old('buku_ids', []))->contains($buku->id) ? 'checked' : '' }}
                                       {{ $buku->stok <= 0 ? 'disabled' : '' }}
                                       onchange="updateBookSelection()">
                                <div style="flex:1">
                                    <div style="font-weight:600;color:#0f172a;font-size:14px;margin-bottom:6px;line-height:1.3">{{ $buku->judul }}</div>
                                    <div style="font-size:12px;color:#64748b;margin-bottom:6px">{{ $buku->penulis }}</div>
                                    <div>
                                        @if($buku->stok > 0)
                                            <span style="background:#dcfce7;color:#166534;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:600">✓ Stok: {{ $buku->stok }}</span>
                                        @else
                                            <span style="background:#fee2e2;color:#991b1b;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:600">✗ Stok Habis</span>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div style="grid-column:1/-1;text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:8px">📚</div>
                                <div style="font-weight:500">Belum ada buku tersedia</div>
                            </div>
                        @endforelse
                    </div>

                    {{-- No results message --}}
                    <div id="noBookResults" style="display:none;text-align:center;padding:30px;color:#94a3b8">
                        <div style="font-size:32px;margin-bottom:8px">🔍</div>
                        <div style="font-weight:500;font-size:14px">Buku tidak ditemukan</div>
                        <div style="font-size:13px;margin-top:4px">Coba kata kunci lain</div>
                    </div>
                </div>
            </div>

            {{-- Section 3: Tanggal & Status --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#f59e0b,#d97706);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        Jadwal & Status
                    </h3>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span style="color:#ef4444">*</span></label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" class="form-control" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Tanggal dimulainya peminjaman</p>
                            @error('tanggal_pinjam')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="batas_kembali" class="form-label">Batas Kembali <span style="color:#ef4444">*</span></label>
                            <input type="date" name="batas_kembali" id="batas_kembali" value="{{ old('batas_kembali') }}" class="form-control" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Denda Rp {{ number_format($dendaPerHari, 0, ',', '.') }}/hari jika melewati batas</p>
                            @error('batas_kembali')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0">
                        <label for="status" class="form-label">Status Peminjaman <span style="color:#ef4444">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="dipinjam" {{ old('status', 'dipinjam') == 'dipinjam' ? 'selected' : '' }}>📤 Dipinjam</option>
                            <option value="dikembalikan" {{ old('status') == 'dikembalikan' ? 'selected' : '' }}>✅ Dikembalikan</option>
                        </select>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Status awal peminjaman buku</p>
                        @error('status')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
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
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan Peminjaman
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookSelectionInfo = document.getElementById('bookSelectionInfo');
            const bookCount = document.getElementById('bookCount');
            const btnSubmit = document.getElementById('btnSubmit');
            const searchInput = document.getElementById('bookSearchInput');
            const bookGrid = document.getElementById('bookGrid');
            const noResults = document.getElementById('noBookResults');
            const searchHint = document.getElementById('bookSearchHint');
            const allCards = document.querySelectorAll('.book-card');
            const MAX_VISIBLE = 5;

            function updateBookSelection() {
                const checkedBoxes = document.querySelectorAll('input[name="buku_ids[]"]:checked');
                const count = checkedBoxes.length;

                bookCount.textContent = count;

                if (count > 0) {
                    bookSelectionInfo.style.display = 'inline-flex';
                    btnSubmit.disabled = false;
                    btnSubmit.style.opacity = '1';
                    btnSubmit.style.cursor = 'pointer';
                } else {
                    bookSelectionInfo.style.display = 'none';
                    btnSubmit.disabled = true;
                    btnSubmit.style.opacity = '0.5';
                    btnSubmit.style.cursor = 'not-allowed';
                }

                // Update visual state of checked cards
                allCards.forEach(card => {
                    const cb = card.querySelector('input[type="checkbox"]');
                    if (cb.checked) {
                        card.style.borderColor = '#6366f1';
                        card.style.background = '#eef2ff';
                    } else if (!cb.disabled) {
                        card.style.borderColor = '#e2e8f0';
                        card.style.background = 'white';
                    }
                });

                filterBooks();
            }

            function filterBooks() {
                const query = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;
                let matchCount = 0;

                allCards.forEach(card => {
                    const judul = card.getAttribute('data-judul');
                    const penulis = card.getAttribute('data-penulis');
                    const cb = card.querySelector('input[type="checkbox"]');
                    const isChecked = cb.checked;

                    // If search is empty, show only first MAX_VISIBLE + checked ones
                    if (query === '') {
                        if (isChecked) {
                            card.style.display = 'flex';
                            visibleCount++;
                        } else if (visibleCount < MAX_VISIBLE) {
                            card.style.display = 'flex';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                        matchCount++;
                    } else {
                        // With search query: show matching + checked
                        const matches = judul.includes(query) || penulis.includes(query);
                        if (isChecked || matches) {
                            card.style.display = 'flex';
                            if (matches) matchCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });

                // Show no results message
                if (query !== '' && matchCount === 0) {
                    noResults.style.display = 'block';
                } else {
                    noResults.style.display = 'none';
                }

                // Update hint text
                if (query === '') {
                    const totalAvailable = allCards.length;
                    if (totalAvailable > MAX_VISIBLE) {
                        searchHint.textContent = `Menampilkan ${Math.min(MAX_VISIBLE, totalAvailable)} dari ${totalAvailable} buku. Ketik untuk mencari buku lainnya.`;
                    } else {
                        searchHint.textContent = `Menampilkan semua ${totalAvailable} buku.`;
                    }
                } else {
                    searchHint.textContent = `Ditemukan ${matchCount} buku yang cocok.`;
                }
            }

            // Make updateBookSelection globally accessible
            window.updateBookSelection = updateBookSelection;

            // Search input event
            searchInput.addEventListener('input', filterBooks);

            // Run on page load
            updateBookSelection();

            // Update on checkbox changes
            allCards.forEach(card => {
                const cb = card.querySelector('input[type="checkbox"]');
                if (cb) {
                    cb.addEventListener('change', updateBookSelection);
                }
            });
        });
    </script>
</x-app-layout>
<x-app-layout>
    @php $header = 'Tambah Buku'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('bukus.index') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Tambah Buku Baru</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Tambahkan koleksi buku baru ke perpustakaan</p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(99,102,241,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>

        {{-- Info Banner --}}
        <div style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1px solid #c7d2fe;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p style="font-size:13px;color:#4338ca;margin:0;font-weight:600">Informasi</p>
                <p style="font-size:13px;color:#6366f1;margin:2px 0 0">Kolom bertanda <span style="color:#ef4444;font-weight:600">*</span> wajib diisi. Upload foto sampul untuk tampilan yang lebih menarik.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('bukus.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Section 1: Informasi Buku --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </span>
                        Informasi Buku
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="judul" class="form-label">Judul Buku <span style="color:#ef4444">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="form-control" placeholder="Masukkan judul lengkap buku" required>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Gunakan judul resmi yang tertera pada sampul buku</p>
                        @error('judul')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="penulis" class="form-label">Penulis <span style="color:#ef4444">*</span></label>
                            <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}" class="form-control" placeholder="Nama penulis buku" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Pengarang atau penyusun buku</p>
                            @error('penulis')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="penerbit" class="form-label">Penerbit <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}" class="form-control" placeholder="Nama penerbit">
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Perusahaan yang menerbitkan buku</p>
                            @error('penerbit')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Cover Image Upload --}}
                    <div class="form-group" style="margin-bottom:0">
                        <label for="cover_image" class="form-label">Foto Sampul Buku <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                        <div style="position:relative;border:2px dashed #e2e8f0;border-radius:12px;padding:24px;text-align:center;background:#f8fafc;transition:all 0.2s;overflow:hidden" onmouseover="this.style.borderColor='#a5b4fc';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
                            <div id="coverPlaceholder">
                                <svg fill="none" stroke="#94a3b8" stroke-width="1.5" viewBox="0 0 24 24" style="width:36px;height:36px;margin:0 auto 8px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p style="font-size:14px;color:#64748b;margin:0 0 4px;font-weight:500">Klik untuk upload foto sampul</p>
                                <p style="font-size:12px;color:#94a3b8;margin:0">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                            </div>
                            <div id="coverPreviewContainer" style="display:none;position:absolute;inset:0;background:#f8fafc;align-items:center;justify-content:center;padding:10px;">
                                <img id="coverPreview" src="" style="max-height:100%;max-width:100%;object-fit:contain;border-radius:6px;box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                                <div style="position:absolute;bottom:10px;right:10px;background:rgba(0,0,0,0.6);color:white;padding:4px 10px;border-radius:8px;font-size:11px;pointer-events:none;">Klik untuk mengubah gambar</div>
                            </div>
                            <input type="file" name="cover_image" id="cover_image" accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%" onchange="previewImage(this)">
                        </div>
                        @error('cover_image')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <script>
                        function previewImage(input) {
                            const previewContainer = document.getElementById('coverPreviewContainer');
                            const preview = document.getElementById('coverPreview');
                            const placeholder = document.getElementById('coverPlaceholder');
                            
                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    previewContainer.style.display = 'flex';
                                    placeholder.style.opacity = '0';
                                }
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                preview.src = '';
                                previewContainer.style.display = 'none';
                                placeholder.style.opacity = '1';
                            }
                        }
                    </script>
                </div>
            </div>

            {{-- Section 2: Kategori & Detail --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        Kategori & Detail
                    </h3>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="kategori_id" class="form-label">Kategori <span style="color:#ef4444">*</span></label>
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                <option value="">— Pilih Kategori —</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Kelompok genre buku</p>
                            @error('kategori_id')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit <span style="color:#ef4444">*</span></label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', date('Y')) }}" class="form-control" placeholder="2024" min="1900" max="2099" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Tahun pertama kali diterbitkan</p>
                            @error('tahun_terbit')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="stok" class="form-label">Jumlah Stok <span style="color:#ef4444">*</span></label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok', 1) }}" class="form-control" placeholder="0" min="0" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Jumlah eksemplar yang tersedia</p>
                            @error('stok')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rak_nomor" class="form-label">Nomor Rak <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                            <input type="text" name="rak_nomor" id="rak_nomor" value="{{ old('rak_nomor') }}" class="form-control" placeholder="Contoh: A1, B3, C2">
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Lokasi penyimpanan buku di rak</p>
                            @error('rak_nomor')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0">
                        <label for="deskripsi" class="form-label">Deskripsi Buku <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Jelaskan isi buku, tema, atau informasi tambahan lainnya...">{{ old('deskripsi') }}</textarea>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Deskripsi singkat tentang isi dan tema buku</p>
                        @error('deskripsi')
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
                    <a href="{{ route('bukus.index') }}" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan Buku
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
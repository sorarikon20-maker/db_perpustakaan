<x-app-layout>
    @php $header = 'Edit Kategori'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('kategoris.index') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Edit Kategori</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Perbarui kategori: <strong style="color:#6366f1">{{ $kategori->nama_kategori }}</strong></p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(245,158,11,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
        </div>

        {{-- Edit Mode Banner --}}
        <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div style="flex:1">
                <p style="font-size:13px;color:#92400e;margin:0;font-weight:600">Mode Edit</p>
                <p style="font-size:13px;color:#a16207;margin:2px 0 0">Anda sedang mengedit kategori <strong>{{ $kategori->nama_kategori }}</strong></p>
            </div>
            <span class="badge badge-warning" style="font-size:12px;padding:5px 14px">Editing</span>
        </div>

        <form method="POST" action="{{ route('kategoris.update', $kategori) }}">
            @csrf
            @method('PUT')

            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        Detail Kategori
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kategori" class="form-label">Nama Kategori <span style="color:#ef4444">*</span></label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="form-control" placeholder="Contoh: Fiksi, Non-Fiksi, Sains..." required>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Nama yang singkat dan mudah dipahami untuk mengelompokkan buku</p>
                        @error('nama_kategori')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0">
                        <label for="keterangan" class="form-label">Keterangan <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control" placeholder="Deskripsi singkat tentang kategori ini, misalnya jenis buku apa saja yang termasuk dalam kategori ini...">{{ old('keterangan', $kategori->keterangan) }}</textarea>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Penjelasan tambahan mengenai kategori untuk memudahkan klasifikasi</p>
                        @error('keterangan')
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
                    <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Update Kategori
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
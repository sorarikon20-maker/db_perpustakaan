<x-app-layout>
    @php $header = 'Edit Siswa'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('siswas.index') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Edit Data Siswa</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Perbarui informasi siswa: <strong style="color:#6366f1">{{ $siswa->nama }}</strong></p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(245,158,11,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
        </div>

        {{-- Current Data Summary --}}
        <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div style="flex:1">
                <p style="font-size:13px;color:#92400e;margin:0;font-weight:600">Mode Edit</p>
                <p style="font-size:13px;color:#a16207;margin:2px 0 0">Anda sedang mengedit data siswa <strong>{{ $siswa->nama }}</strong> — NIS: <strong>{{ $siswa->nis }}</strong></p>
            </div>
            <span class="badge badge-warning" style="font-size:12px;padding:5px 14px">Editing</span>
        </div>

        <form method="POST" action="{{ route('siswas.update', $siswa) }}">
            @csrf
            @method('PUT')

            {{-- Section 1: Identitas Siswa --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        Identitas Siswa
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap <span style="color:#ef4444">*</span></label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $siswa->nama) }}" class="form-control" placeholder="Masukkan nama lengkap siswa" required>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Masukkan nama sesuai dengan dokumen resmi siswa</p>
                        @error('nama')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="nis" class="form-label">NIS (Nomor Induk Siswa) <span style="color:#ef4444">*</span></label>
                            <input type="text" name="nis" id="nis" value="{{ old('nis', $siswa->nis) }}" class="form-control" placeholder="Contoh: 12345" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Nomor identitas unik untuk setiap siswa</p>
                            @error('nis')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kelas" class="form-label">Kelas <span style="color:#ef4444">*</span></label>
                            <select name="kelas" id="kelas" class="form-control" required>
                                <option value="">— Pilih Kelas —</option>
                                <option value="X" {{ old('kelas', $siswa->kelas) == 'X' ? 'selected' : '' }}>Kelas X</option>
                                <option value="XI" {{ old('kelas', $siswa->kelas) == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                <option value="XII" {{ old('kelas', $siswa->kelas) == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Pilih tingkat kelas siswa saat ini</p>
                            @error('kelas')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Jurusan --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </span>
                        Program Keahlian
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:0">
                        <label for="jurusan" class="form-label">Jurusan <span style="color:#ef4444">*</span></label>
                        <select name="jurusan" id="jurusan" class="form-control" required>
                            <option value="">— Pilih Jurusan —</option>
                            <option value="PPLG 1" {{ old('jurusan', $siswa->jurusan) == 'PPLG 1' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim (PPLG 1)</option>
                            <option value="PPLG 2" {{ old('jurusan', $siswa->jurusan) == 'PPLG 2' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim (PPLG 2)</option>
                            <option value="DKV 1" {{ old('jurusan', $siswa->jurusan) == 'DKV 1' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV 1)</option>
                            <option value="DKV 2" {{ old('jurusan', $siswa->jurusan) == 'DKV 2' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV 2)</option>
                            <option value="BD 1" {{ old('jurusan', $siswa->jurusan) == 'BD 1' ? 'selected' : '' }}>Bisnis Digital (BD 1)</option>
                            <option value="BD 2" {{ old('jurusan', $siswa->jurusan) == 'BD 2' ? 'selected' : '' }}>Bisnis Digital (BD 2)</option>
                            <option value="TJKT 1" {{ old('jurusan', $siswa->jurusan) == 'TJKT 1' ? 'selected' : '' }}>Teknik Jaringan Komputer dan Telekomunikasi (TJKT 1)</option>
                            <option value="TJKT 2" {{ old('jurusan', $siswa->jurusan) == 'TJKT 2' ? 'selected' : '' }}>Teknik Jaringan Komputer dan Telekomunikasi (TJKT 2)</option>
                        </select>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Pilih program keahlian yang diikuti oleh siswa</p>
                        @error('jurusan')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Quick Info Jurusan --}}
                    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:16px">
                        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:10px 12px;text-align:center">
                            <div style="font-size:18px;margin-bottom:4px">💻</div>
                            <div style="font-size:11px;color:#166534;font-weight:600">PPLG</div>
                        </div>
                        <div style="background:#fdf4ff;border:1px solid #f0abfc;border-radius:10px;padding:10px 12px;text-align:center">
                            <div style="font-size:18px;margin-bottom:4px">🎨</div>
                            <div style="font-size:11px;color:#86198f;font-weight:600">DKV</div>
                        </div>
                        <div style="background:#eff6ff;border:1px solid #93c5fd;border-radius:10px;padding:10px 12px;text-align:center">
                            <div style="font-size:18px;margin-bottom:4px">📊</div>
                            <div style="font-size:11px;color:#1e40af;font-weight:600">BD</div>
                        </div>
                        <div style="background:#fefce8;border:1px solid #fde047;border-radius:10px;padding:10px 12px;text-align:center">
                            <div style="font-size:18px;margin-bottom:4px">🌐</div>
                            <div style="font-size:11px;color:#854d0e;font-weight:600">TJKT</div>
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
                    <a href="{{ route('siswas.index') }}" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Update Data Siswa
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
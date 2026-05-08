<x-app-layout>
    @php $header = 'Edit User'; @endphp

    <div>
        {{-- Page Header --}}
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="{{ route('users.index') }}" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Edit User</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Perbarui data akun: <strong style="color:#6366f1">{{ $user->name }}</strong></p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(245,158,11,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
        </div>

        {{-- Banners --}}
        @if($user->id === Auth::id())
            <div style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1px solid #c7d2fe;border-radius:14px;padding:16px 20px;margin-bottom:12px;display:flex;align-items:center;gap:12px">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p style="font-size:13px;color:#4338ca;margin:0;font-weight:600">Perhatian</p>
                    <p style="font-size:13px;color:#6366f1;margin:2px 0 0">Anda sedang mengedit akun Anda sendiri. Perubahan role dapat mempengaruhi akses Anda.</p>
                </div>
            </div>
        @endif

        {{-- Edit Mode Banner --}}
        <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div style="flex:1">
                <p style="font-size:13px;color:#92400e;margin:0;font-weight:600">Mode Edit</p>
                <p style="font-size:13px;color:#a16207;margin:2px 0 0">Mengedit user <strong>{{ $user->name }}</strong> ({{ $user->email }})</p>
            </div>
            <span class="badge badge-warning" style="font-size:12px;padding:5px 14px">Editing</span>
        </div>

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')

            {{-- Section 1: Informasi Akun --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        Informasi Akun
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap <span style="color:#ef4444">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="Masukkan nama lengkap" required>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Nama yang akan ditampilkan di sistem</p>
                        @error('name')
                            <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="email" class="form-label">Alamat Email <span style="color:#ef4444">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="contoh@email.com" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Digunakan untuk login ke sistem</p>
                            @error('email')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role" class="form-label">Role / Jabatan <span style="color:#ef4444">*</span></label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>📋 Petugas</option>
                                <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>🎓 Siswa</option>
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Menentukan level akses di sistem</p>
                            @error('role')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Keamanan --}}
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        Ubah Password
                    </h3>
                    <span class="badge badge-secondary" style="font-size:12px;padding:5px 14px">Opsional</span>
                </div>
                <div class="card-body">
                    <div style="background:#f8fafc;border:1px dashed #e2e8f0;border-radius:12px;padding:16px;margin-bottom:16px">
                        <p style="font-size:13px;color:#64748b;margin:0;display:flex;align-items:center;gap:8px">
                            <svg fill="none" stroke="#94a3b8" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px;flex-shrink:0"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Kosongkan kedua kolom ini jika tidak ingin mengubah password
                        </p>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group" style="margin-bottom:0">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 8 karakter">
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Gunakan kombinasi huruf, angka, dan simbol</p>
                            @error('password')
                                <p style="color:#ef4444;font-size:13px;margin-top:5px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-bottom:0">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Pastikan sama dengan password di atas</p>
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
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Update User
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    @php $header = 'Manajemen User'; @endphp

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Manajemen User</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Kelola semua akun pengguna yang dapat mengakses sistem</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Info user yang sedang login --}}
    <div style="background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;padding:16px 20px;margin-bottom:20px;color:white;display:flex;align-items:center;gap:14px">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;flex-shrink:0">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div>
            <div style="font-size:14px;font-weight:600">Saat ini login sebagai: <strong>{{ Auth::user()->name }}</strong></div>
            <div style="font-size:13px;opacity:0.85">{{ Auth::user()->email }} &nbsp;·&nbsp; Role: <span style="background:rgba(255,255,255,0.2);padding:2px 8px;border-radius:20px;font-size:12px">{{ ucfirst(Auth::user()->role ?? 'admin') }}</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:18px;height:18px;display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Daftar User
            </h3>
            <form method="GET" action="{{ route('users.index') }}" style="display:flex;gap:8px">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, role..." class="search-input">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="{{ $user->id === Auth::id() ? 'background:#f0f9ff;' : '' }}">
                            <td data-label="No" style="color:#94a3b8;font-size:13px">{{ $loop->iteration }}</td>
                            <td data-label="Pengguna">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,
                                        {{ ($user->role ?? 'petugas') === 'admin' ? '#6366f1,#4f46e5' : (($user->role ?? '') === 'petugas' ? '#10b981,#059669' : '#f59e0b,#d97706') }});
                                        display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;flex-shrink:0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:500;font-size:14px">
                                            {{ $user->name }}
                                            @if($user->id === Auth::id())
                                                <span style="font-size:11px;background:#dbeafe;color:#1d4ed8;padding:1px 7px;border-radius:20px;margin-left:4px">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Email" style="color:#64748b;font-size:13px">{{ $user->email }}</td>
                            <td data-label="Role">
                                @php $role = $user->role ?? 'petugas'; @endphp
                                @if($role === 'admin')
                                    <span class="badge badge-primary">👑 Admin</span>
                                @elseif($role === 'petugas')
                                    <span class="badge badge-success">📋 Petugas</span>
                                @else
                                    <span class="badge badge-warning">🎓 Siswa</span>
                                @endif
                            </td>
                            <td data-label="Status">
                                @if($user->email_verified_at)
                                    <span class="badge badge-success" style="font-size:11px">✅ Terverifikasi</span>
                                @else
                                    <span class="badge badge-warning" style="font-size:11px">⏳ Belum verif</span>
                                @endif
                            </td>
                            <td data-label="Terdaftar" style="font-size:13px;color:#64748b">
                                {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                            </td>
                            <td data-label="Aksi">
                                <div style="display:flex;gap:6px">
                                    <a href="{{ route('users.edit', $user) }}" class="action-btn action-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    @if($user->id !== Auth::id())
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" style="margin:0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-btn action-delete" title="Hapus" onclick="event.preventDefault(); showDeleteModal(this.form, '{{ $user->name }}')">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span style="width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;color:#cbd5e1" title="Tidak bisa hapus akun sendiri">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">👥</div>
                                <div style="font-weight:500">Belum ada data user</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div style="padding:16px 24px;border-top:1px solid #f1f5f9">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>

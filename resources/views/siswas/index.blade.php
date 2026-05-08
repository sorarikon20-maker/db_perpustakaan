<x-app-layout>
    @php $header = 'Data Siswa'; @endphp

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Daftar Siswa</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Kelola data siswa yang terdaftar di perpustakaan</p>
        </div>
        <a href="{{ route('siswas.create') }}" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Siswa
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

    <div class="card">
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:18px;height:18px;display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Data Siswa
            </h3>
            <form method="GET" action="{{ route('siswas.index') }}" style="display:flex;gap:8px">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari siswa..." class="search-input">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $siswa)
                        <tr>
                            <td data-label="No" style="color:#94a3b8;font-size:13px">{{ $loop->iteration }}</td>
                            <td data-label="Nama Siswa">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;flex-shrink:0">
                                        {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                    </div>
                                    <span style="font-weight:500">{{ $siswa->nama }}</span>
                                </div>
                            </td>
                            <td data-label="NIS"><span class="badge badge-info">{{ $siswa->nis }}</span></td>
                            <td data-label="Kelas">{{ $siswa->kelas }}</td>
                            <td data-label="Jurusan"><span class="badge badge-secondary">{{ $siswa->jurusan }}</span></td>
                            <td data-label="Aksi">
                                <div style="display:flex;gap:6px">
                                    <a href="{{ route('siswas.edit', $siswa) }}" class="action-btn action-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('siswas.destroy', $siswa) }}" style="margin:0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="action-btn action-delete" title="Hapus" onclick="event.preventDefault(); showDeleteModal(this.form, '{{ $siswa->nama }}')">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">📭</div>
                                <div style="font-weight:500">Belum ada data siswa</div>
                                <div style="font-size:13px;margin-top:4px">Klik "Tambah Siswa" untuk mulai menambahkan data</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($siswas->hasPages())
            <div style="padding:16px 24px;border-top:1px solid #f1f5f9">
                {{ $siswas->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
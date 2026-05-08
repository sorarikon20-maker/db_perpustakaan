<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $header = 'Peminjaman Buku'; ?>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Daftar Peminjaman</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Kelola semua transaksi peminjaman buku perpustakaan</p>
        </div>
        
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div style="margin-bottom:24px;">
        <div class="card" style="padding:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:16px;flex-wrap:wrap;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;margin:0;">Total Denda Saat Ini</h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Estimasi denda untuk peminjaman yang terlambat.</p>
                </div>
                <div style="text-align:right;min-width:160px;">
                    <div style="font-size:24px;font-weight:700;color:#dc2626;">Rp <?php echo e(number_format($activeLateTotal, 0, ',', '.')); ?></div>
                    <div style="font-size:13px;color:#64748b;"><?php echo e($activeLateCount); ?> peminjaman terlambat</div>
                </div>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="<?php echo e(route('peminjamans.laporan')); ?>" class="btn btn-primary btn-sm">Lihat Laporan Denda</a>
                <button type="button" class="btn btn-secondary btn-sm" onclick="openFineHistoryPopup()">Lihat Histori Denda</button>
            </div>
        </div>
    </div>

    <div id="fineHistoryModal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.65);backdrop-filter:blur(4px);z-index:9999;justify-content:center;align-items:center;padding:24px;">
        <div style="width:min(760px,100%);background:white;border-radius:18px;overflow:hidden;box-shadow:0 20px 60px rgba(15,23,42,0.2);">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid #e2e8f0;">
                <div>
                    <div style="font-size:18px;font-weight:700;color:#0f172a;">Histori Denda</div>
                    <div style="font-size:13px;color:#64748b;">Riwayat denda dari peminjaman terkini.</div>
                </div>
                <button type="button" onclick="closeFineHistoryPopup()" style="width:36px;height:36px;border:none;background:#f8fafc;border-radius:999px;cursor:pointer;font-size:18px;">×</button>
            </div>
            <div style="max-height:calc(100vh - 180px);overflow:auto;padding:16px 20px;">
                <?php if($fineHistory->isEmpty()): ?>
                    <div style="color:#64748b;font-size:13px;">Belum ada histori denda.</div>
                <?php else: ?>
                    <div style="display:grid;gap:12px;">
                        <?php $__currentLoopData = $fineHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $historyDenda = $item->status === 'dipinjam' ? $item->hitungDenda() : $item->denda;
                            ?>
                            <div style="border:1px solid #e2e8f0;border-radius:14px;padding:14px;">
                                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;">
                                    <div>
                                        <div style="font-size:14px;font-weight:700;color:#0f172a;"><?php echo e($item->siswa->nama ?? 'N/A'); ?> • <?php echo e($item->buku->judul ?? 'Buku tidak tersedia'); ?></div>
                                        <div style="font-size:12px;color:#64748b;margin-top:6px;">Status: <?php echo e($item->status === 'dipinjam' ? 'Dipinjam' : 'Dikembalikan'); ?></div>
                                        <div style="font-size:12px;color:#475569;margin-top:4px;"><?php echo e($item->status === 'dipinjam' ? 'Batas: '.$item->batas_kembali : 'Kembali: '.$item->tanggal_kembali); ?></div>
                                    </div>
                                    <div style="text-align:right; min-width:120px;">
                                        <div style="font-size:14px;font-weight:700;color:#dc2626;">Rp <?php echo e(number_format($historyDenda, 0, ',', '.')); ?></div>
                                        <div style="font-size:11px;color:#94a3b8;margin-top:6px;"><?php echo e($item->updated_at->format('d M Y')); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function openFineHistoryPopup() {
            document.getElementById('fineHistoryModal').style.display = 'flex';
        }
        function closeFineHistoryPopup() {
            document.getElementById('fineHistoryModal').style.display = 'none';
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFineHistoryPopup();
            }
        });
    </script>

    
    

    <div class="card">
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:18px;height:18px;display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                Rekap Peminjaman
            </h3>
            <form method="GET" action="<?php echo e(route('peminjamans.index')); ?>" style="display:flex;gap:8px">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari peminjaman..." class="search-input">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
            <a href="<?php echo e(route('peminjamans.create')); ?>" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Catat Peminjaman
        </a>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Stok</th>
                        <th>Petugas</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $peminjamans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjaman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $terlambat = $peminjaman->isTerlambat();
                            $denda = $peminjaman->status === 'dipinjam' ? $peminjaman->hitungDenda() : $peminjaman->denda;
                        ?>
                        <tr style="<?php echo e($terlambat ? 'background:#fff7ed;' : ''); ?>">
                            <td data-label="No" style="color:#94a3b8;font-size:13px"><?php echo e($loop->iteration); ?></td>
                            <td data-label="Siswa">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:12px;flex-shrink:0">
                                        <?php echo e(strtoupper(substr($peminjaman->siswa->nama ?? 'N', 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div style="font-weight:500;font-size:14px"><?php echo e($peminjaman->siswa ? $peminjaman->siswa->nama : 'N/A'); ?></div>
                                        <div style="font-size:12px;color:#94a3b8"><?php echo e($peminjaman->siswa ? $peminjaman->siswa->nis : ''); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Buku">
                                <div style="font-weight:500;font-size:14px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?php echo e($peminjaman->buku ? $peminjaman->buku->judul : 'N/A'); ?>">
                                    <?php echo e($peminjaman->buku ? $peminjaman->buku->judul : 'N/A'); ?>

                                </div>
                            </td>
                            <td data-label="Stok">
                                <?php if($peminjaman->buku): ?>
                                    <?php if($peminjaman->buku->stok <= 0): ?>
                                        <span class="badge badge-danger" style="font-size:12px">Habis</span>
                                    <?php elseif($peminjaman->buku->stok <= 3): ?>
                                        <span class="badge badge-warning" style="font-size:12px"><?php echo e($peminjaman->buku->stok); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-success" style="font-size:12px"><?php echo e($peminjaman->buku->stok); ?></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span style="color:#94a3b8;font-size:13px">-</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Petugas" style="font-size:13px;color:#64748b">
                                <div style="display:flex;align-items:center;gap:6px">
                                    <div style="width:24px;height:24px;border-radius:6px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:10px;flex-shrink:0">
                                        <?php echo e(strtoupper(substr($peminjaman->user->name ?? 'U', 0, 1))); ?>

                                    </div>
                                    <?php echo e($peminjaman->user ? $peminjaman->user->name : 'N/A'); ?>

                                </div>
                            </td>
                            <td data-label="Tgl Pinjam" style="font-size:13px"><?php echo e($peminjaman->tanggal_pinjam); ?></td>
                            <td data-label="Batas Kembali" style="font-size:13px">
                                <?php if($peminjaman->batas_kembali): ?>
                                    <?php if($terlambat): ?>
                                        <span style="color:#dc2626;font-weight:600"><?php echo e($peminjaman->batas_kembali); ?></span>
                                        <?php
                                            $hLambat = \Carbon\Carbon::parse($peminjaman->batas_kembali)->diffInDays(\Carbon\Carbon::today());
                                        ?>
                                        <div style="font-size:11px;color:#ef4444">🔴 Telat <?php echo e($hLambat); ?> hari</div>
                                    <?php else: ?>
                                        <?php echo e($peminjaman->batas_kembali); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <span style="color:#94a3b8">-</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Tgl Kembali" style="font-size:13px"><?php echo e($peminjaman->tanggal_kembali ?? '-'); ?></td>
                            <td data-label="Status">
                                <?php if($peminjaman->status == 'dipinjam'): ?>
                                    <?php if($terlambat): ?>
                                        <span class="badge badge-danger">🚨 Terlambat</span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">📤 Dipinjam</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge badge-success">✅ Dikembalikan</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Denda">
                                <?php if($denda > 0): ?>
                                    <span class="badge badge-danger" style="font-size:12px;font-weight:600">
                                        Rp <?php echo e(number_format($denda, 0, ',', '.')); ?>

                                    </span>
                                <?php elseif($peminjaman->status === 'dikembalikan'): ?>
                                    <span class="badge badge-success" style="font-size:12px">Lunas</span>
                                <?php else: ?>
                                    <span style="color:#94a3b8;font-size:13px">-</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Aksi">
                                <div style="display:flex;gap:6px">
                                    <a href="<?php echo e(route('peminjamans.edit', $peminjaman)); ?>" class="action-btn action-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('peminjamans.destroy', $peminjaman)); ?>" style="margin:0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="action-btn action-delete" title="Hapus" onclick="event.preventDefault(); showDeleteModal(this.form, '<?php echo e($peminjaman->siswa->nama ?? 'Peminjaman'); ?>')">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="11" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">📋</div>
                                <div style="font-weight:500">Belum ada data peminjaman</div>
                                <div style="font-size:13px;margin-top:4px">Klik "Catat Peminjaman" untuk mencatat peminjaman baru</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($peminjamans->hasPages()): ?>
            <div style="padding:16px 24px;border-top:1px solid #f1f5f9">
                <?php echo e($peminjamans->appends(request()->query())->links()); ?>

            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/peminjamans/index.blade.php ENDPATH**/ ?>
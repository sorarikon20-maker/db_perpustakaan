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
    <?php $header = 'Rak Buku'; ?>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Rak Buku Perpustakaan</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Lihat lokasi dan penempatan buku di rak perpustakaan</p>
        </div>
        <a href="<?php echo e(route('bukus.index')); ?>" class="btn btn-secondary">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Ke Data Buku
        </a>
    </div>

    
    <div class="peminjaman-summary-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-value"><?php echo e($totalBuku); ?></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#10b981,#059669);">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div>
                <div class="stat-label">Jumlah Rak</div>
                <div class="stat-value"><?php echo e($totalRak); ?></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <div class="stat-label">Belum Ditempatkan</div>
                <div class="stat-value"><?php echo e($totalBelumDitempatkan); ?></div>
            </div>
        </div>
    </div>

    
    <?php $__empty_1 = true; $__currentLoopData = $bukuByRak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rakNomor => $bukus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header" style="background:linear-gradient(135deg,rgba(99,102,241,0.06),rgba(139,92,246,0.04));">
                <h3 style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:14px;flex-shrink:0;">
                        <?php echo e($rakNomor); ?>

                    </div>
                    <div>
                        <div style="font-size:16px;font-weight:700;">Rak <?php echo e($rakNomor); ?></div>
                        <div style="font-size:12px;color:#64748b;font-weight:400;"><?php echo e($bukus->count()); ?> buku</div>
                    </div>
                </h3>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:40px">No</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bukus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-label="No" style="color:#94a3b8;font-size:13px"><?php echo e($loop->iteration); ?></td>
                                <td data-label="Judul">
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <div style="width:38px;height:52px;border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;background:#f8fafc;flex-shrink:0;">
                                            <img src="<?php echo e($buku->cover_image ? asset('storage/'.$buku->cover_image) : 'https://via.placeholder.com/38x52?text=📖'); ?>" alt="" style="width:100%;height:100%;object-fit:cover;">
                                        </div>
                                        <span style="font-weight:500"><?php echo e($buku->judul); ?></span>
                                    </div>
                                </td>
                                <td data-label="Penulis" style="color:#64748b;font-size:14px;"><?php echo e($buku->penulis); ?></td>
                                <td data-label="Kategori">
                                    <?php if($buku->kategori): ?>
                                        <span class="badge badge-primary"><?php echo e($buku->kategori->nama_kategori); ?></span>
                                    <?php else: ?>
                                        <span style="color:#94a3b8;font-size:13px">-</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Tahun"><span class="badge badge-secondary"><?php echo e($buku->tahun_terbit); ?></span></td>
                                <td data-label="Stok">
                                    <?php $stok = $buku->stok ?? 0; ?>
                                    <span class="badge <?php echo e($stok > 5 ? 'badge-success' : ($stok > 0 ? 'badge-warning' : 'badge-danger')); ?>">
                                        <?php echo e($stok); ?> unit
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        
    <?php endif; ?>

    
    <?php if($bukuTanpaRak->count() > 0): ?>
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header" style="background:linear-gradient(135deg,rgba(245,158,11,0.08),rgba(217,119,6,0.04));">
                <h3 style="display:flex;align-items:center;gap:10px;">
                    <div style="width:40px;height:40px;background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;display:flex;align-items:center;justify-content:center;color:white;font-size:18px;flex-shrink:0;">
                        ⚠️
                    </div>
                    <div>
                        <div style="font-size:16px;font-weight:700;">Belum Ditempatkan di Rak</div>
                        <div style="font-size:12px;color:#64748b;font-weight:400;"><?php echo e($bukuTanpaRak->count()); ?> buku belum memiliki nomor rak</div>
                    </div>
                </h3>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:40px">No</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bukuTanpaRak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td data-label="No" style="color:#94a3b8;font-size:13px"><?php echo e($loop->iteration); ?></td>
                                <td data-label="Judul">
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <div style="width:38px;height:52px;border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;background:#f8fafc;flex-shrink:0;">
                                            <img src="<?php echo e($buku->cover_image ? asset('storage/'.$buku->cover_image) : 'https://via.placeholder.com/38x52?text=📖'); ?>" alt="" style="width:100%;height:100%;object-fit:cover;">
                                        </div>
                                        <span style="font-weight:500"><?php echo e($buku->judul); ?></span>
                                    </div>
                                </td>
                                <td data-label="Penulis" style="color:#64748b;font-size:14px;"><?php echo e($buku->penulis); ?></td>
                                <td data-label="Kategori">
                                    <?php if($buku->kategori): ?>
                                        <span class="badge badge-primary"><?php echo e($buku->kategori->nama_kategori); ?></span>
                                    <?php else: ?>
                                        <span style="color:#94a3b8;font-size:13px">-</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Tahun"><span class="badge badge-secondary"><?php echo e($buku->tahun_terbit); ?></span></td>
                                <td data-label="Stok">
                                    <?php $stok = $buku->stok ?? 0; ?>
                                    <span class="badge <?php echo e($stok > 5 ? 'badge-success' : ($stok > 0 ? 'badge-warning' : 'badge-danger')); ?>">
                                        <?php echo e($stok); ?> unit
                                    </span>
                                </td>
                                <td data-label="Aksi">
                                    <a href="<?php echo e(route('bukus.edit', $buku)); ?>" class="btn btn-warning btn-sm" style="font-size:12px;">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Atur Rak
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <?php if($bukuByRak->isEmpty() && $bukuTanpaRak->isEmpty()): ?>
        <div class="card" style="padding:60px 40px;text-align:center;">
            <div style="font-size:56px;margin-bottom:16px;">📚</div>
            <div style="font-size:18px;font-weight:600;color:#0f172a;margin-bottom:6px;">Belum Ada Buku</div>
            <div style="font-size:14px;color:#64748b;margin-bottom:20px;">Tambahkan buku terlebih dahulu lalu atur nomor rak untuk setiap buku.</div>
            <a href="<?php echo e(route('bukus.create')); ?>" class="btn btn-primary">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Buku
            </a>
        </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/rak-buku/index.blade.php ENDPATH**/ ?>
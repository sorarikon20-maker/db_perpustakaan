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
    <?php $header = 'Laporan Denda'; ?>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Laporan Denda</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Lihat ringkasan denda per bulan dan histori denda peminjaman buku.</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="<?php echo e(route('peminjamans.index')); ?>" class="btn btn-secondary btn-sm">Kembali ke Peminjaman</a>
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

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <div class="card" style="padding:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;margin:0;">Denda Aktif Saat Ini</h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Estimasi denda untuk peminjaman yang terlambat.</p>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:18px;font-weight:700;color:#dc2626;">Rp <?php echo e(number_format($activeLateTotal, 0, ',', '.')); ?></div>
                    <div style="font-size:13px;color:#64748b;"><?php echo e($activeLateCount); ?> peminjaman terlambat</div>
                </div>
            </div>
        </div>
        <div class="card" style="padding:20px;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;margin:0;">Denda Terkumpul Tahun <?php echo e($year); ?></h3>
                    <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Total denda dari pengembalian buku di tahun ini.</p>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:20px;font-weight:700;color:#0f172a;">Rp <?php echo e(number_format($yearTotal, 0, ',', '.')); ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card" style="padding:20px;margin-bottom:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:16px;">
            <div>
                <h3 style="font-size:16px;font-weight:700;margin:0;">Laporan Denda Bulanan</h3>
                <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Jumlah denda per bulan berdasarkan tanggal pengembalian.</p>
            </div>
            <form method="GET" action="<?php echo e(route('peminjamans.laporan')); ?>" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                <label style="font-size:13px;color:#475569;">Bulan</label>
                <select name="month" style="padding:8px 10px;border:1px solid #d1d5db;border-radius:10px;min-width:120px;">
                    <?php $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']; ?>
                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $monthName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($index + 1); ?>" <?php echo e(($index + 1) == $month ? 'selected' : ''); ?>><?php echo e($monthName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <label style="font-size:13px;color:#475569;">Tahun</label>
                <select name="year" style="padding:8px 10px;border:1px solid #d1d5db;border-radius:10px;min-width:120px;">
                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionYear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($optionYear); ?>" <?php echo e($optionYear == $year ? 'selected' : ''); ?>><?php echo e($optionYear); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            </form>
        </div>

        <div style="padding:14px 16px;border:1px solid #e2e8f0;border-radius:14px;background:#fff;text-align:center;">
            <div style="font-size:14px;color:#64748b;margin-bottom:6px;">Total Denda di Bulan <?php echo e($months[$month - 1]); ?> <?php echo e($year); ?></div>
            <div style="font-size:28px;font-weight:800;color:#0f172a;">
                Rp <?php echo e(number_format($monthTotal, 0, ',', '.')); ?>

            </div>
        </div>
    </div>
    
    
    <div class="card">
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:18px;height:18px;display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Histori Denda Tahun <?php echo e($year); ?>

            </h3>
            <span class="badge badge-secondary"><?php echo e($fineHistory->count()); ?> data</span>
        </div>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Buku</th>
                        <th>Status</th>
                        <th>Batas Kembali</th>
                        <th>Tgl Kembali</th>
                        <th>Denda</th>
                        <th>Diupdate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $fineHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $historyDenda = $item->status === 'dipinjam' ? $item->hitungDenda() : $item->denda;
                        ?>
                        <tr>
                            <td style="color:#94a3b8;font-size:13px"><?php echo e($loop->iteration); ?></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:11px;flex-shrink:0">
                                        <?php echo e(strtoupper(substr($item->siswa->nama ?? 'N', 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div style="font-weight:500;font-size:14px"><?php echo e($item->siswa->nama ?? 'N/A'); ?></div>
                                        <div style="font-size:12px;color:#94a3b8"><?php echo e($item->siswa->nis ?? ''); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500;font-size:14px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?php echo e($item->buku->judul ?? 'N/A'); ?>">
                                    <?php echo e($item->buku->judul ?? 'Buku tidak tersedia'); ?>

                                </div>
                            </td>
                            <td>
                                <?php if($item->status === 'dipinjam'): ?>
                                    <span class="badge badge-danger">🚨 Terlambat</span>
                                <?php else: ?>
                                    <span class="badge badge-success">✅ Dikembalikan</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:13px"><?php echo e($item->batas_kembali); ?></td>
                            <td style="font-size:13px"><?php echo e($item->tanggal_kembali ?? '-'); ?></td>
                            <td>
                                <span class="badge badge-danger" style="font-size:12px;font-weight:600">
                                    Rp <?php echo e(number_format($historyDenda, 0, ',', '.')); ?>

                                </span>
                            </td>
                            <td style="font-size:12px;color:#94a3b8"><?php echo e($item->updated_at->format('d M Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">💰</div>
                                <div style="font-weight:500">Belum ada histori denda untuk tahun <?php echo e($year); ?></div>
                                <div style="font-size:13px;margin-top:4px">Tidak ada peminjaman yang terkena denda di tahun ini</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/peminjamans/laporan-denda.blade.php ENDPATH**/ ?>
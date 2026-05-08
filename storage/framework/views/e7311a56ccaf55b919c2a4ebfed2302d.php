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
    <?php $header = 'Histori Denda'; ?>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Histori Denda</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Semua riwayat denda peminjaman buku.</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <form method="GET" action="<?php echo e(route('peminjamans.histori')); ?>" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                <label style="font-size:13px;color:#475569;">Tahun</label>
                <select name="year" style="padding:8px 10px;border:1px solid #d1d5db;border-radius:10px;min-width:120px;">
                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionYear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($optionYear); ?>" <?php echo e($optionYear == $year ? 'selected' : ''); ?>><?php echo e($optionYear); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            </form>
            <a href="<?php echo e(route('peminjamans.laporan')); ?>" class="btn btn-secondary btn-sm">Laporan Denda</a>
            <a href="<?php echo e(route('peminjamans.index')); ?>" class="btn btn-primary btn-sm">Kembali ke Peminjaman</a>
        </div>
    </div>

    <div class="card" style="padding:20px; margin-bottom:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;">
            <div>
                <h3 style="font-size:16px;font-weight:700;margin:0;">Total Denda Terkumpul Tahun <?php echo e($year); ?></h3>
                <p style="font-size:13px;color:#64748b;margin:4px 0 0;">Total denda yang tercatat untuk tahun ini.</p>
            </div>
            <div style="text-align:right;">
                <div style="font-size:20px;font-weight:700;color:#0f172a;">Rp <?php echo e(number_format($yearTotal, 0, ',', '.')); ?></div>
            </div>
        </div>
    </div>

    <div class="card" style="padding:20px;">
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
                                <div style="font-size:15px;font-weight:700;color:#0f172a;"><?php echo e($item->siswa->nama ?? 'N/A'); ?> • <?php echo e($item->buku->judul ?? 'Buku tidak tersedia'); ?></div>
                                <div style="font-size:13px;color:#64748b;margin-top:6px;">Status: <?php echo e($item->status === 'dipinjam' ? 'Dipinjam' : 'Dikembalikan'); ?></div>
                                <div style="font-size:13px;color:#475569;margin-top:4px;"><?php echo e($item->status === 'dipinjam' ? 'Batas: '.$item->batas_kembali : 'Kembali: '.$item->tanggal_kembali); ?></div>
                            </div>
                            <div style="text-align:right; min-width:140px;">
                                <div style="font-size:16px;font-weight:700;color:#dc2626;">Rp <?php echo e(number_format($historyDenda, 0, ',', '.')); ?></div>
                                <div style="font-size:12px;color:#94a3b8;margin-top:6px;">Diupdate: <?php echo e($item->updated_at->format('d M Y')); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/peminjamans/histori-denda.blade.php ENDPATH**/ ?>
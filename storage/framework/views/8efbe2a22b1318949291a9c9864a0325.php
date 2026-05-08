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
    <?php $header = 'Data Siswa'; ?>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Daftar Siswa</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Kelola data siswa yang terdaftar di perpustakaan</p>
        </div>
        <a href="<?php echo e(route('siswas.create')); ?>" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Siswa
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:18px;height:18px;display:inline;margin-right:6px;vertical-align:middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Data Siswa
            </h3>
            <form method="GET" action="<?php echo e(route('siswas.index')); ?>" style="display:flex;gap:8px">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari siswa..." class="search-input">
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
                    <?php $__empty_1 = true; $__currentLoopData = $siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="No" style="color:#94a3b8;font-size:13px"><?php echo e($loop->iteration); ?></td>
                            <td data-label="Nama Siswa">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;flex-shrink:0">
                                        <?php echo e(strtoupper(substr($siswa->nama, 0, 1))); ?>

                                    </div>
                                    <span style="font-weight:500"><?php echo e($siswa->nama); ?></span>
                                </div>
                            </td>
                            <td data-label="NIS"><span class="badge badge-info"><?php echo e($siswa->nis); ?></span></td>
                            <td data-label="Kelas"><?php echo e($siswa->kelas); ?></td>
                            <td data-label="Jurusan"><span class="badge badge-secondary"><?php echo e($siswa->jurusan); ?></span></td>
                            <td data-label="Aksi">
                                <div style="display:flex;gap:6px">
                                    <a href="<?php echo e(route('siswas.edit', $siswa)); ?>" class="action-btn action-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('siswas.destroy', $siswa)); ?>" style="margin:0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="action-btn action-delete" title="Hapus" onclick="event.preventDefault(); showDeleteModal(this.form, '<?php echo e($siswa->nama); ?>')">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">📭</div>
                                <div style="font-weight:500">Belum ada data siswa</div>
                                <div style="font-size:13px;margin-top:4px">Klik "Tambah Siswa" untuk mulai menambahkan data</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($siswas->hasPages()): ?>
            <div style="padding:16px 24px;border-top:1px solid #f1f5f9">
                <?php echo e($siswas->appends(request()->query())->links()); ?>

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
<?php endif; ?><?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/siswas/index.blade.php ENDPATH**/ ?>
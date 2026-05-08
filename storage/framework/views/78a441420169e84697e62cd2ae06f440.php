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
    <?php $header = 'Edit Kategori'; ?>

    <div style="max-width:580px">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
            <a href="<?php echo e(route('kategoris.index')); ?>" style="width:36px;height:36px;border:1px solid #e2e8f0;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 style="font-size:22px;font-weight:700;color:#0f172a;margin:0 0 2px">Edit Kategori</h1>
                <p style="font-size:13px;color:#64748b;margin:0">Perbarui: <strong><?php echo e($kategori->nama_kategori); ?></strong></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Formulir Edit Kategori</h3>
                <span class="badge badge-warning">Mode Edit</span>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('kategoris.update', $kategori)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group">
                        <label for="nama_kategori" class="form-label">Nama Kategori <span style="color:#ef4444">*</span></label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="<?php echo e(old('nama_kategori', $kategori->nama_kategori)); ?>" class="form-control" placeholder="Contoh: Fiksi, Non-Fiksi, Sains..." required>
                        <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p style="color:#ef4444;font-size:13px;margin-top:5px"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Deskripsi singkat tentang kategori ini..."><?php echo e(old('keterangan', $kategori->keterangan)); ?></textarea>
                        <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p style="color:#ef4444;font-size:13px;margin-top:5px"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:8px">
                        <a href="<?php echo e(route('kategoris.index')); ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Update Kategori
                        </button>
                    </div>
                </form>
            </div>
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
<?php endif; ?><?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/kategoris/edit.blade.php ENDPATH**/ ?>
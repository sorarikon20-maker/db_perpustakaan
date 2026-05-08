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
    <?php $header = 'Edit Siswa'; ?>

    <div style="max-width:680px">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
            <a href="<?php echo e(route('siswas.index')); ?>" style="width:36px;height:36px;border:1px solid #e2e8f0;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 style="font-size:22px;font-weight:700;color:#0f172a;margin:0 0 2px">Edit Data Siswa</h1>
                <p style="font-size:13px;color:#64748b;margin:0">Perbarui informasi siswa: <strong><?php echo e($siswa->nama); ?></strong></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Formulir Edit Siswa</h3>
                <span class="badge badge-warning">Mode Edit</span>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('siswas.update', $siswa)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Lengkap <span style="color:#ef4444">*</span></label>
                        <input type="text" name="nama" id="nama" value="<?php echo e(old('nama', $siswa->nama)); ?>" class="form-control" placeholder="Masukkan nama lengkap siswa" required>
                        <?php $__errorArgs = ['nama'];
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

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                        <div class="form-group">
                            <label for="nis" class="form-label">NIS <span style="color:#ef4444">*</span></label>
                            <input type="text" name="nis" id="nis" value="<?php echo e(old('nis', $siswa->nis)); ?>" class="form-control" placeholder="Nomor Induk Siswa" required>
                            <?php $__errorArgs = ['nis'];
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
                            <label for="kelas" class="form-label">Kelas <span style="color:#ef4444">*</span></label>
                            <select name="kelas" id="kelas" class="form-control" required>
                                <option value="">— Pilih Kelas —</option>
                                <option value="X" <?php echo e(old('kelas', $siswa->kelas) == 'X' ? 'selected' : ''); ?>>X</option>
                                <option value="XI" <?php echo e(old('kelas', $siswa->kelas) == 'XI' ? 'selected' : ''); ?>>XI</option>
                                <option value="XII" <?php echo e(old('kelas', $siswa->kelas) == 'XII' ? 'selected' : ''); ?>>XII</option>
                            </select>
                            <?php $__errorArgs = ['kelas'];
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
                    </div>

                    <div class="form-group">
                        <label for="jurusan" class="form-label">Jurusan <span style="color:#ef4444">*</span></label>
                        <select name="jurusan" id="jurusan" class="form-control" required>
                            <option value="">— Pilih Jurusan —</option>
                            <option value="PPLG 1" <?php echo e(old('jurusan') == 'PPLG 1' ? 'selected' : ''); ?>>Pengembangan Perangkat Lunak dan Gim (1)</option>
                            <option value="PPLG 2" <?php echo e(old('jurusan') == 'PPLG 2' ? 'selected' : ''); ?>>Pengembangan Perangkat Lunak dan Gim (2)</option>
                            <option value="DKV 1" <?php echo e(old('jurusan') == 'DKV 1' ? 'selected' : ''); ?>>Desain Komunikasi Visual (1)</option>
                            <option value="DKV 2" <?php echo e(old('jurusan') == 'DKV 2' ? 'selected' : ''); ?>>Desain Komunikasi Visual (2)</option>
                            <option value="BD 1" <?php echo e(old('jurusan') == 'BD 1' ? 'selected' : ''); ?>>Bisnis Digital (1)</option>
                            <option value="BD 2" <?php echo e(old('jurusan') == 'BD 2' ? 'selected' : ''); ?>>Bisnis Digital (2)</option>
                            <option value="TJKT 1" <?php echo e(old('jurusan') == 'TJKT 1' ? 'selected' : ''); ?>>Teknik Jaringan Komputer dan Telekomunikasi (1)</option>
                            <option value="TJKT 2" <?php echo e(old('jurusan') == 'TJKT 2' ? 'selected' : ''); ?>>Teknik Jaringan Komputer dan Telekomunikasi (2)</option>
                        </select>
                        <?php $__errorArgs = ['jurusan'];
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
                        <a href="<?php echo e(route('siswas.index')); ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Update Data
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
<?php endif; ?><?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/siswas/edit.blade.php ENDPATH**/ ?>
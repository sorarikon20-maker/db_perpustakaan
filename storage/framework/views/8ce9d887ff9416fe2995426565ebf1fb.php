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
    <?php $header = 'Tambah User'; ?>

    <div style="max-width:900px">
        
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="<?php echo e(route('users.index')); ?>" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Tambah User Baru</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Buat akun baru untuk pengguna sistem perpustakaan</p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(99,102,241,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
        </div>

        
        <div style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1px solid #c7d2fe;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p style="font-size:13px;color:#4338ca;margin:0;font-weight:600">Informasi</p>
                <p style="font-size:13px;color:#6366f1;margin:2px 0 0">Setiap user akan mendapatkan akses sesuai role yang diberikan. Password minimal 8 karakter.</p>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('users.store')); ?>">
            <?php echo csrf_field(); ?>

            
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
                        <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Nama yang akan ditampilkan di sistem</p>
                        <?php $__errorArgs = ['name'];
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

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="email" class="form-label">Alamat Email <span style="color:#ef4444">*</span></label>
                            <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" class="form-control" placeholder="contoh@email.com" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Digunakan untuk login ke sistem</p>
                            <?php $__errorArgs = ['email'];
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
                            <label for="role" class="form-label">Role / Jabatan <span style="color:#ef4444">*</span></label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="">— Pilih Role —</option>
                                <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>👑 Admin</option>
                                <option value="petugas" <?php echo e(old('role') == 'petugas' ? 'selected' : ''); ?>>📋 Petugas</option>
                                <option value="siswa" <?php echo e(old('role') == 'siswa' ? 'selected' : ''); ?>>🎓 Siswa</option>
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Menentukan level akses di sistem</p>
                            <?php $__errorArgs = ['role'];
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

                    
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:4px">
                        <div style="background:#fef3c7;border:1px solid #fde68a;border-radius:10px;padding:12px;text-align:center">
                            <div style="font-size:22px;margin-bottom:4px">👑</div>
                            <div style="font-size:12px;color:#92400e;font-weight:600">Admin</div>
                            <div style="font-size:11px;color:#a16207;margin-top:2px">Akses penuh</div>
                        </div>
                        <div style="background:#dbeafe;border:1px solid #93c5fd;border-radius:10px;padding:12px;text-align:center">
                            <div style="font-size:22px;margin-bottom:4px">📋</div>
                            <div style="font-size:12px;color:#1e40af;font-weight:600">Petugas</div>
                            <div style="font-size:11px;color:#3b82f6;margin-top:2px">Kelola data</div>
                        </div>
                        <div style="background:#dcfce7;border:1px solid #bbf7d0;border-radius:10px;padding:12px;text-align:center">
                            <div style="font-size:22px;margin-bottom:4px">🎓</div>
                            <div style="font-size:12px;color:#166534;font-weight:600">Siswa</div>
                            <div style="font-size:11px;color:#16a34a;margin-top:2px">Lihat data</div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        Keamanan Akun
                    </h3>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="password" class="form-label">Password <span style="color:#ef4444">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 8 karakter" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Gunakan kombinasi huruf, angka, dan simbol</p>
                            <?php $__errorArgs = ['password'];
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
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span style="color:#ef4444">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Pastikan sama dengan password di atas</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div style="display:flex;gap:12px;justify-content:space-between;align-items:center">
                <p style="font-size:13px;color:#94a3b8;margin:0">
                    <span style="color:#ef4444">*</span> Menandakan kolom wajib diisi
                </p>
                <div style="display:flex;gap:10px">
                    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan User
                    </button>
                </div>
            </div>
        </form>
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
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/users/create.blade.php ENDPATH**/ ?>
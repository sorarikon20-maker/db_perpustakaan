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
    <?php $header = 'Manajemen User'; ?>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Manajemen User</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Kelola semua akun pengguna yang dapat mengakses sistem</p>
        </div>
        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah User
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

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div style="background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;padding:16px 20px;margin-bottom:20px;color:white;display:flex;align-items:center;gap:14px">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;flex-shrink:0">
            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

        </div>
        <div>
            <div style="font-size:14px;font-weight:600">Saat ini login sebagai: <strong><?php echo e(Auth::user()->name); ?></strong></div>
            <div style="font-size:13px;opacity:0.85"><?php echo e(Auth::user()->email); ?> &nbsp;·&nbsp; Role: <span style="background:rgba(255,255,255,0.2);padding:2px 8px;border-radius:20px;font-size:12px"><?php echo e(ucfirst(Auth::user()->role ?? 'admin')); ?></span></div>
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
            <form method="GET" action="<?php echo e(route('users.index')); ?>" style="display:flex;gap:8px">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama, email, role..." class="search-input">
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
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr style="<?php echo e($user->id === Auth::id() ? 'background:#f0f9ff;' : ''); ?>">
                            <td data-label="No" style="color:#94a3b8;font-size:13px"><?php echo e($loop->iteration); ?></td>
                            <td data-label="Pengguna">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,
                                        <?php echo e(($user->role ?? 'petugas') === 'admin' ? '#6366f1,#4f46e5' : (($user->role ?? '') === 'petugas' ? '#10b981,#059669' : '#f59e0b,#d97706')); ?>);
                                        display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;flex-shrink:0">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div style="font-weight:500;font-size:14px">
                                            <?php echo e($user->name); ?>

                                            <?php if($user->id === Auth::id()): ?>
                                                <span style="font-size:11px;background:#dbeafe;color:#1d4ed8;padding:1px 7px;border-radius:20px;margin-left:4px">Anda</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Email" style="color:#64748b;font-size:13px"><?php echo e($user->email); ?></td>
                            <td data-label="Role">
                                <?php $role = $user->role ?? 'petugas'; ?>
                                <?php if($role === 'admin'): ?>
                                    <span class="badge badge-primary">👑 Admin</span>
                                <?php elseif($role === 'petugas'): ?>
                                    <span class="badge badge-success">📋 Petugas</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">🎓 Siswa</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Status">
                                <?php if($user->email_verified_at): ?>
                                    <span class="badge badge-success" style="font-size:11px">✅ Terverifikasi</span>
                                <?php else: ?>
                                    <span class="badge badge-warning" style="font-size:11px">⏳ Belum verif</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Terdaftar" style="font-size:13px;color:#64748b">
                                <?php echo e($user->created_at ? $user->created_at->format('d M Y') : '-'); ?>

                            </td>
                            <td data-label="Aksi">
                                <div style="display:flex;gap:6px">
                                    <a href="<?php echo e(route('users.edit', $user)); ?>" class="action-btn action-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <?php if($user->id !== Auth::id()): ?>
                                        <form method="POST" action="<?php echo e(route('users.destroy', $user)); ?>" style="margin:0">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="action-btn action-delete" title="Hapus" onclick="event.preventDefault(); showDeleteModal(this.form, '<?php echo e($user->name); ?>')">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span style="width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;color:#cbd5e1" title="Tidak bisa hapus akun sendiri">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">👥</div>
                                <div style="font-weight:500">Belum ada data user</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($users->hasPages()): ?>
            <div style="padding:16px 24px;border-top:1px solid #f1f5f9">
                <?php echo e($users->appends(request()->query())->links()); ?>

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
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/users/index.blade.php ENDPATH**/ ?>
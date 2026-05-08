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
    <?php $header = 'Data Buku'; ?>

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#0f172a; margin:0 0 4px;">Koleksi Buku</h1>
            <p style="font-size:14px; color:#64748b; margin:0;">Kelola semua koleksi buku yang ada di perpustakaan</p>
        </div>
        <a href="<?php echo e(route('bukus.create')); ?>" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Buku
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Daftar Buku
            </h3>
            <form method="GET" action="<?php echo e(route('bukus.index')); ?>" style="display:flex;gap:8px">
                <div class="search-wrapper">
                    <span class="search-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari judul, penulis..." class="search-input">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th>Rak</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $bukus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="No" style="color:#94a3b8;font-size:13px"><?php echo e($loop->iteration); ?></td>
                            <td data-label="Judul Buku">
                                <div style="display:flex;align-items:center;gap:10px">
                                    <button type="button"
                                        class="cover-popout-btn"
                                        data-fullsrc="<?php echo e($buku->cover_image ? asset('storage/'.$buku->cover_image) : 'https://via.placeholder.com/300x420?text=Cover'); ?>"
                                        title="Klik untuk memperbesar"
                                        style="padding:0;border:none;background:transparent;cursor:pointer;display:block;width:42px;height:60px;border-radius:10px;overflow:hidden;flex-shrink:0;border:1px solid #e2e8f0;background:#f8fafc;display:flex;align-items:center;justify-content:center;">
                                        <img src="<?php echo e($buku->cover_image ? asset('storage/'.$buku->cover_image) : 'https://via.placeholder.com/42x60?text=Cover'); ?>" alt="Cover <?php echo e($buku->judul); ?>" style="width:100%;height:100%;object-fit:cover;">
                                    </button>
                                    <span style="font-weight:500"><?php echo e($buku->judul); ?></span>
                                </div>
                            </td>
                            <td data-label="Penulis" style="color:#64748b"><?php echo e($buku->penulis); ?></td>
                            <td data-label="Tahun"><span class="badge badge-secondary"><?php echo e($buku->tahun_terbit); ?></span></td>
                            <td data-label="Kategori">
                                <?php if($buku->kategori): ?>
                                    <span class="badge badge-primary"><?php echo e($buku->kategori->nama_kategori); ?></span>
                                <?php else: ?>
                                    <span style="color:#94a3b8;font-size:13px">-</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Rak">
                                <?php if($buku->rak_nomor): ?>
                                    <span class="badge badge-info" style="font-size:12px;font-weight:600">
                                        📍 <?php echo e($buku->rak_nomor); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="color:#94a3b8;font-size:12px;font-style:italic">Belum diatur</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Stok">
                                <?php $stok = $buku->stok ?? 0; ?>
                                <span class="badge <?php echo e($stok > 5 ? 'badge-success' : ($stok > 0 ? 'badge-warning' : 'badge-danger')); ?>">
                                    <?php echo e($stok); ?> unit
                                </span>
                            </td>
                            <td data-label="Aksi">
                                <div style="display:flex;gap:6px">
                                    <a href="<?php echo e(route('bukus.show', $buku)); ?>" class="action-btn action-view" title="Lihat Detail">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="<?php echo e(route('bukus.edit', $buku)); ?>" class="action-btn action-edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('bukus.destroy', $buku)); ?>" style="margin:0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="action-btn action-delete" title="Hapus" onclick="event.preventDefault(); showDeleteModal(this.form, '<?php echo e($buku->judul); ?>')">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" style="text-align:center;padding:40px;color:#94a3b8">
                                <div style="font-size:40px;margin-bottom:10px">📚</div>
                                <div style="font-weight:500">Belum ada buku dalam koleksi</div>
                                <div style="font-size:13px;margin-top:4px">Klik "Tambah Buku" untuk menambahkan koleksi pertama</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($bukus->hasPages()): ?>
            <div style="padding:16px 24px;border-top:1px solid #f1f5f9">
                <?php echo e($bukus->appends(request()->query())->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    <div id="coverImageModal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.85);backdrop-filter:blur(6px);z-index:9999;justify-content:center;align-items:center;padding:24px;">
        <div style="position:relative;max-width:90vw;max-height:90vh;display:flex;justify-content:center;align-items:center;">
            <button type="button" onclick="closeCoverModal()" style="position:absolute;top:-16px;right:-16px;width:40px;height:40px;border-radius:999px;border:none;background:#ffffff;box-shadow:0 10px 25px rgba(0,0,0,0.3);cursor:pointer;font-size:22px;font-weight:700;line-height:1;color:#0f172a;z-index:10000;display:flex;align-items:center;justify-content:center;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">×</button>
            <img id="coverModalImage" src="" alt="Cover buku diperbesar" style="max-width:100%;max-height:85vh;object-fit:contain;border-radius:12px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);">
        </div>
    </div>

    <script>
        function openCoverModal(src) {
            const modal = document.getElementById('coverImageModal');
            const image = document.getElementById('coverModalImage');
            if (!modal || !image) return;
            image.src = src;
            modal.style.display = 'flex';
        }

        function closeCoverModal() {
            const modal = document.getElementById('coverImageModal');
            const image = document.getElementById('coverModalImage');
            if (!modal || !image) return;
            modal.style.display = 'none';
            image.src = '';
        }

        document.addEventListener('click', function(event) {
            const target = event.target.closest('.cover-popout-btn');
            if (target) {
                const src = target.getAttribute('data-fullsrc');
                if (src) {
                    openCoverModal(src);
                }
            }
        });

        document.getElementById('coverImageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeCoverModal();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeCoverModal();
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/bukus/index.blade.php ENDPATH**/ ?>
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
    <?php $header = 'Edit Buku'; ?>

    <div>
        
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="<?php echo e(route('bukus.index')); ?>" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Edit Data Buku</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Perbarui informasi buku: <strong style="color:#6366f1"><?php echo e($buku->judul); ?></strong></p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(245,158,11,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
        </div>

        
        <div style="background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fde68a;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div style="flex:1">
                <p style="font-size:13px;color:#92400e;margin:0;font-weight:600">Mode Edit</p>
                <p style="font-size:13px;color:#a16207;margin:2px 0 0">Anda sedang mengedit buku <strong><?php echo e($buku->judul); ?></strong> karya <strong><?php echo e($buku->penulis); ?></strong></p>
            </div>
            <span class="badge badge-warning" style="font-size:12px;padding:5px 14px">Editing</span>
        </div>

        <form method="POST" action="<?php echo e(route('bukus.update', $buku)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </span>
                        Informasi Buku
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="judul" class="form-label">Judul Buku <span style="color:#ef4444">*</span></label>
                        <input type="text" name="judul" id="judul" value="<?php echo e(old('judul', $buku->judul)); ?>" class="form-control" placeholder="Masukkan judul lengkap buku" required>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Gunakan judul resmi yang tertera pada sampul buku</p>
                        <?php $__errorArgs = ['judul'];
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
                            <label for="penulis" class="form-label">Penulis <span style="color:#ef4444">*</span></label>
                            <input type="text" name="penulis" id="penulis" value="<?php echo e(old('penulis', $buku->penulis)); ?>" class="form-control" placeholder="Nama penulis buku" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Pengarang atau penyusun buku</p>
                            <?php $__errorArgs = ['penulis'];
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
                            <label for="penerbit" class="form-label">Penerbit <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                            <input type="text" name="penerbit" id="penerbit" value="<?php echo e(old('penerbit', $buku->penerbit)); ?>" class="form-control" placeholder="Nama penerbit">
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Perusahaan yang menerbitkan buku</p>
                            <?php $__errorArgs = ['penerbit'];
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

                    
                    <div class="form-group" style="margin-bottom:0">
                        <label for="cover_image" class="form-label">Foto Sampul Buku <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                        <?php if($buku->cover_image): ?>
                            <div style="display:flex;gap:16px;align-items:flex-start;margin-bottom:12px" id="currentCoverInfo">
                                <div style="flex-shrink:0">
                                    <img src="<?php echo e(asset('storage/'.$buku->cover_image)); ?>" alt="Sampul <?php echo e($buku->judul); ?>" style="width:80px;height:110px;object-fit:cover;border-radius:12px;border:2px solid #e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,0.08)">
                                </div>
                                <div style="padding-top:8px">
                                    <p style="font-size:14px;color:#0f172a;font-weight:600;margin:0 0 4px">Sampul Saat Ini</p>
                                    <p style="font-size:12px;color:#94a3b8;margin:0">Upload gambar baru untuk mengganti sampul ini</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div style="border:2px dashed #e2e8f0;border-radius:12px;padding:24px;text-align:center;background:#f8fafc;transition:all 0.2s;position:relative;overflow:hidden" onmouseover="this.style.borderColor='#a5b4fc';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
                            <div id="coverPlaceholder">
                                <svg fill="none" stroke="#94a3b8" stroke-width="1.5" viewBox="0 0 24 24" style="width:36px;height:36px;margin:0 auto 8px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p style="font-size:14px;color:#64748b;margin:0 0 4px;font-weight:500"><?php echo e($buku->cover_image ? 'Klik untuk ganti foto sampul' : 'Klik untuk upload foto sampul'); ?></p>
                                <p style="font-size:12px;color:#94a3b8;margin:0">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                            </div>
                            <div id="coverPreviewContainer" style="display:none;position:absolute;inset:0;background:#f8fafc;align-items:center;justify-content:center;padding:10px;">
                                <img id="coverPreview" src="" style="max-height:100%;max-width:100%;object-fit:contain;border-radius:6px;box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                                <div style="position:absolute;bottom:10px;right:10px;background:rgba(0,0,0,0.6);color:white;padding:4px 10px;border-radius:8px;font-size:11px;pointer-events:none;">Klik untuk mengubah gambar</div>
                            </div>
                            <input type="file" name="cover_image" id="cover_image" accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%" onchange="previewImage(this)">
                        </div>
                        <?php $__errorArgs = ['cover_image'];
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

                    <script>
                        function previewImage(input) {
                            const previewContainer = document.getElementById('coverPreviewContainer');
                            const preview = document.getElementById('coverPreview');
                            const placeholder = document.getElementById('coverPlaceholder');
                            const currentCoverInfo = document.getElementById('currentCoverInfo');
                            
                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    previewContainer.style.display = 'flex';
                                    placeholder.style.opacity = '0';
                                    if(currentCoverInfo) currentCoverInfo.style.opacity = '0.5';
                                }
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                preview.src = '';
                                previewContainer.style.display = 'none';
                                placeholder.style.opacity = '1';
                                if(currentCoverInfo) currentCoverInfo.style.opacity = '1';
                            }
                        }
                    </script>
                </div>
            </div>

            
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        Kategori & Detail
                    </h3>
                </div>
                <div class="card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="kategori_id" class="form-label">Kategori <span style="color:#ef4444">*</span></label>
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                <option value="">— Pilih Kategori —</option>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->id); ?>" <?php echo e(old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : ''); ?>>
                                        <?php echo e($kategori->nama_kategori); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Kelompok genre buku</p>
                            <?php $__errorArgs = ['kategori_id'];
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
                            <label for="tahun_terbit" class="form-label">Tahun Terbit <span style="color:#ef4444">*</span></label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="<?php echo e(old('tahun_terbit', $buku->tahun_terbit)); ?>" class="form-control" min="1900" max="2099" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Tahun pertama kali diterbitkan</p>
                            <?php $__errorArgs = ['tahun_terbit'];
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

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
                        <div class="form-group">
                            <label for="stok" class="form-label">Jumlah Stok <span style="color:#ef4444">*</span></label>
                            <input type="number" name="stok" id="stok" value="<?php echo e(old('stok', $buku->stok)); ?>" class="form-control" placeholder="0" min="0" required>
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Jumlah eksemplar yang tersedia</p>
                            <?php $__errorArgs = ['stok'];
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
                            <label for="rak_nomor" class="form-label">Nomor Rak <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                            <input type="text" name="rak_nomor" id="rak_nomor" value="<?php echo e(old('rak_nomor', $buku->rak_nomor)); ?>" class="form-control" placeholder="Contoh: A1, B3, C2">
                            <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Lokasi penyimpanan buku di rak</p>
                            <?php $__errorArgs = ['rak_nomor'];
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

                    <div class="form-group" style="margin-bottom:0">
                        <label for="deskripsi" class="form-label">Deskripsi Buku <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Jelaskan isi buku, tema, atau informasi tambahan lainnya..."><?php echo e(old('deskripsi', $buku->deskripsi)); ?></textarea>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Deskripsi singkat tentang isi dan tema buku</p>
                        <?php $__errorArgs = ['deskripsi'];
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
            </div>

            
            <div style="display:flex;gap:12px;justify-content:space-between;align-items:center">
                <p style="font-size:13px;color:#94a3b8;margin:0">
                    <span style="color:#ef4444">*</span> Menandakan kolom wajib diisi
                </p>
                <div style="display:flex;gap:10px">
                    <a href="<?php echo e(route('bukus.index')); ?>" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Update Buku
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
<?php endif; ?><?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/bukus/edit.blade.php ENDPATH**/ ?>
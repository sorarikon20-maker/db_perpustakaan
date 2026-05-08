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
    <?php $header = 'Tambah Kategori'; ?>

    <div>
        
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px">
            <a href="<?php echo e(route('kategoris.index')); ?>" style="width:40px;height:40px;border:1px solid #e2e8f0;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#64748b;text-decoration:none;transition:all 0.2s;background:white" onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='#eef2ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#64748b';this.style.background='white'">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div style="flex:1">
                <h1 style="font-size:24px;font-weight:700;color:#0f172a;margin:0 0 4px">Tambah Kategori Baru</h1>
                <p style="font-size:14px;color:#64748b;margin:0">Buat kategori baru untuk mengelompokkan koleksi buku</p>
            </div>
            <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(99,102,241,0.3)">
                <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:24px;height:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>

        
        <div style="background:linear-gradient(135deg,#eef2ff,#e0e7ff);border:1px solid #c7d2fe;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p style="font-size:13px;color:#4338ca;margin:0;font-weight:600">Informasi</p>
                <p style="font-size:13px;color:#6366f1;margin:2px 0 0">Kategori membantu mengorganisir koleksi buku. Contoh: Fiksi, Non-Fiksi, Sains, Teknologi, dll.</p>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('kategoris.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        Detail Kategori
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kategori" class="form-label">Nama Kategori <span style="color:#ef4444">*</span></label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="<?php echo e(old('nama_kategori')); ?>" class="form-control" placeholder="Contoh: Fiksi, Non-Fiksi, Sains..." required>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Nama yang singkat dan mudah dipahami untuk mengelompokkan buku</p>
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

                    <div class="form-group" style="margin-bottom:0">
                        <label for="keterangan" class="form-label">Keterangan <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control" placeholder="Deskripsi singkat tentang kategori ini, misalnya jenis buku apa saja yang termasuk dalam kategori ini..."><?php echo e(old('keterangan')); ?></textarea>
                        <p style="font-size:12px;color:#94a3b8;margin:6px 0 0">Penjelasan tambahan mengenai kategori untuk memudahkan klasifikasi</p>
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
                </div>
            </div>

            
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">
                    <h3 style="display:flex;align-items:center;gap:8px">
                        <span style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#10b981,#059669);display:inline-flex;align-items:center;justify-content:center">
                            <svg fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </span>
                        Inspirasi Kategori
                    </h3>
                </div>
                <div class="card-body" style="padding:16px 24px">
                    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px">
                        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Fiksi'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(16,185,129,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">📖</div>
                            <div style="font-size:12px;color:#166534;font-weight:600">Fiksi</div>
                        </div>
                        <div style="background:#eff6ff;border:1px solid #93c5fd;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Sains'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(59,130,246,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">🔬</div>
                            <div style="font-size:12px;color:#1e40af;font-weight:600">Sains</div>
                        </div>
                        <div style="background:#fdf4ff;border:1px solid #f0abfc;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Sejarah'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(168,85,247,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">🏛️</div>
                            <div style="font-size:12px;color:#86198f;font-weight:600">Sejarah</div>
                        </div>
                        <div style="background:#fefce8;border:1px solid #fde047;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Teknologi'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(234,179,8,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">💻</div>
                            <div style="font-size:12px;color:#854d0e;font-weight:600">Teknologi</div>
                        </div>
                        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Agama'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(239,68,68,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">🕌</div>
                            <div style="font-size:12px;color:#991b1b;font-weight:600">Agama</div>
                        </div>
                        <div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Ensiklopedia'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(14,165,233,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">📚</div>
                            <div style="font-size:12px;color:#0369a1;font-weight:600">Ensiklopedia</div>
                        </div>
                        <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Biografi'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(16,185,129,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">👤</div>
                            <div style="font-size:12px;color:#065f46;font-weight:600">Biografi</div>
                        </div>
                        <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:10px;padding:12px;text-align:center;cursor:pointer;transition:all 0.2s" onclick="document.getElementById('nama_kategori').value='Komik'" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(249,115,22,0.15)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <div style="font-size:24px;margin-bottom:6px">💬</div>
                            <div style="font-size:12px;color:#9a3412;font-weight:600">Komik</div>
                        </div>
                    </div>
                    <p style="font-size:12px;color:#94a3b8;margin:12px 0 0;text-align:center">Klik salah satu untuk mengisi nama kategori secara otomatis</p>
                </div>
            </div>

            
            <div style="display:flex;gap:12px;justify-content:space-between;align-items:center">
                <p style="font-size:13px;color:#94a3b8;margin:0">
                    <span style="color:#ef4444">*</span> Menandakan kolom wajib diisi
                </p>
                <div style="display:flex;gap:10px">
                    <a href="<?php echo e(route('kategoris.index')); ?>" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Simpan Kategori
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
<?php endif; ?><?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/kategoris/create.blade.php ENDPATH**/ ?>
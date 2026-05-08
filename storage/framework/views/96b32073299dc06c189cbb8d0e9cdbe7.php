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
    <?php $header = 'Profil Saya'; ?>

    <style>
        /* ===== PROFILE PAGE STYLES ===== */
        .profile-hero {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            border-radius: 20px;
            padding: 40px 36px;
            display: flex;
            align-items: center;
            gap: 28px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(99,102,241,0.35);
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            top: -140px; right: -80px;
        }

        .profile-hero::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            bottom: -100px; left: 60px;
        }

        .profile-avatar-wrapper {
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }

        .profile-avatar-large {
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255,255,255,0.4);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: 800;
            color: white;
            text-transform: uppercase;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .profile-avatar-large img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .profile-avatar-large:hover {
            transform: scale(1.05) rotate(2deg);
        }

        .profile-avatar-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 21px;
        }

        .profile-avatar-large:hover .profile-avatar-overlay {
            opacity: 1;
        }

        .profile-avatar-overlay svg {
            width: 28px; height: 28px; color: white;
        }

        .profile-avatar-status {
            position: absolute;
            bottom: 4px; right: 4px;
            width: 20px; height: 20px;
            background: #22c55e;
            border: 3px solid rgba(99,102,241,0.8);
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(34,197,94,0.4);
            z-index: 2;
        }

        .profile-hero-info {
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .profile-hero-name {
            font-size: 26px;
            font-weight: 800;
            color: white;
            margin: 0 0 4px;
            line-height: 1.2;
        }

        .profile-hero-email {
            font-size: 14px;
            color: rgba(255,255,255,0.7);
            margin: 0 0 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .profile-hero-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .profile-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(255,255,255,0.15);
            color: white;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .profile-badge svg { width: 13px; height: 13px; }

        .profile-hero-meta {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-shrink: 0;
        }

        .profile-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: rgba(255,255,255,0.6);
            background: rgba(255,255,255,0.08);
            padding: 8px 14px;
            border-radius: 10px;
        }

        .profile-meta-item svg { width: 14px; height: 14px; }

        /* Photo Upload Section */
        .photo-upload-section {
            background: white;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 24px;
        }

        .photo-upload-section:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .photo-upload-body {
            padding: 28px;
            display: flex;
            align-items: center;
            gap: 28px;
        }

        @media (max-width: 600px) {
            .photo-upload-body { flex-direction: column; text-align: center; }
        }

        .photo-upload-preview {
            width: 90px; height: 90px;
            border-radius: 20px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: 800;
            flex-shrink: 0;
            overflow: hidden;
            border: 3px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .photo-upload-preview img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .photo-upload-info { flex: 1; }

        .photo-upload-info h4 {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 4px;
        }

        .photo-upload-info p {
            font-size: 13px;
            color: #94a3b8;
            margin: 0 0 14px;
        }

        .photo-upload-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .photo-upload-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .photo-upload-btn svg { width: 15px; height: 15px; }

        .photo-upload-btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 2px 10px rgba(99,102,241,0.35);
        }

        .photo-upload-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(99,102,241,0.5);
        }

        .photo-upload-btn-outline {
            background: white;
            color: #ef4444;
            border: 1px solid #fecaca;
        }

        .photo-upload-btn-outline:hover {
            background: #fef2f2;
            border-color: #ef4444;
        }

        /* Grid Layout */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 900px) {
            .profile-grid { grid-template-columns: 1fr; }
            .profile-hero { flex-direction: column; text-align: center; padding: 32px 24px; }
            .profile-hero-badges { justify-content: center; }
            .profile-hero-meta { flex-direction: row; flex-wrap: wrap; justify-content: center; }
        }

        .profile-section {
            background: white;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .profile-section:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .profile-section-full {
            grid-column: 1 / -1;
        }

        .profile-section-header {
            padding: 22px 28px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .profile-section-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-section-icon svg { width: 20px; height: 20px; }
        .profile-section-icon.indigo { background: #eef2ff; color: #6366f1; }
        .profile-section-icon.amber { background: #fffbeb; color: #f59e0b; }
        .profile-section-icon.red { background: #fef2f2; color: #ef4444; }
        .profile-section-icon.emerald { background: #f0fdf4; color: #10b981; }

        .profile-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .profile-section-desc {
            font-size: 13px;
            color: #94a3b8;
            margin: 2px 0 0;
        }

        .profile-section-body {
            padding: 28px;
        }

        /* Form Styles */
        .profile-form-group {
            margin-bottom: 22px;
        }

        .profile-form-group:last-child { margin-bottom: 0; }

        .profile-form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            letter-spacing: 0.01em;
        }

        .profile-form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.25s ease;
            outline: none;
        }

        .profile-form-input:focus {
            border-color: #6366f1;
            background: white;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
        }

        .profile-form-input::placeholder { color: #94a3b8; }

        .profile-form-hint {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .profile-form-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .profile-form-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }

        .profile-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.25s ease;
        }

        .profile-btn svg { width: 16px; height: 16px; }

        .profile-btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 4px 14px rgba(99,102,241,0.4);
        }

        .profile-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99,102,241,0.5);
        }

        .profile-btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 14px rgba(239,68,68,0.35);
        }

        .profile-btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239,68,68,0.45);
        }

        .profile-btn-ghost {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .profile-btn-ghost:hover {
            background: #e2e8f0;
            color: #475569;
        }

        /* Success Message */
        .profile-success-msg {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: #f0fdf4;
            color: #16a34a;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid #bbf7d0;
            animation: fadeSlideIn 0.3s ease;
        }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Danger Zone */
        .danger-zone {
            border-color: #fecaca;
            background: #fffbfb;
        }

        .danger-zone .profile-section-header {
            border-bottom-color: #fee2e2;
        }

        .danger-zone-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .danger-zone-text h4 {
            font-size: 14px;
            font-weight: 600;
            color: #991b1b;
            margin: 0 0 4px;
        }

        .danger-zone-text p {
            font-size: 13px;
            color: #a1a1aa;
            margin: 0;
            max-width: 450px;
        }

        @media (max-width: 600px) {
            .danger-zone-content { flex-direction: column; align-items: flex-start; }
        }

        /* Delete Modal */
        .profile-modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .profile-modal-overlay.show { display: flex; }

        .profile-modal {
            background: white;
            border-radius: 20px;
            padding: 36px;
            max-width: 440px;
            width: 92%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            animation: modalPop 0.3s ease;
        }

        @keyframes modalPop {
            from { opacity: 0; transform: scale(0.92) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .profile-modal-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .profile-modal-icon svg { width: 28px; height: 28px; color: #dc2626; }

        .profile-modal h3 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            text-align: center;
            margin: 0 0 8px;
        }

        .profile-modal p {
            font-size: 14px;
            color: #64748b;
            text-align: center;
            margin: 0 0 24px;
            line-height: 1.5;
        }

        .profile-modal-actions {
            display: flex;
            gap: 12px;
        }

        .profile-modal-actions button,
        .profile-modal-actions .profile-btn {
            flex: 1;
        }

        /* Password toggle */
        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-eye {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            padding: 4px;
            transition: color 0.2s;
        }

        .password-toggle .toggle-eye:hover { color: #6366f1; }
        .password-toggle .toggle-eye svg { width: 18px; height: 18px; }
    </style>

    <!-- Profile Hero -->
    <div class="profile-hero">
        <div class="profile-avatar-wrapper">
            <div class="profile-avatar-large" onclick="document.getElementById('hero-photo-input').click()">
                <?php if(Auth::user()->profile_photo): ?>
                    <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Foto Profil">
                <?php else: ?>
                    <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 2))); ?>

                <?php endif; ?>
                <div class="profile-avatar-overlay">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <div class="profile-avatar-status"></div>
            <form method="POST" action="<?php echo e(route('profile.photo.update')); ?>" enctype="multipart/form-data" id="hero-photo-form">
                <?php echo csrf_field(); ?>
                <input type="file" name="profile_photo" id="hero-photo-input" accept="image/jpeg,image/png,image/webp" style="display:none" onchange="document.getElementById('hero-photo-form').submit()">
            </form>
        </div>
        <div class="profile-hero-info">
            <h1 class="profile-hero-name"><?php echo e(Auth::user()->name ?? 'User'); ?></h1>
            <p class="profile-hero-email">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <?php echo e(Auth::user()->email ?? '-'); ?>

            </p>
            <div class="profile-hero-badges">
                <span class="profile-badge">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Administrator
                </span>
                <span class="profile-badge">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Akun Aktif
                </span>
            </div>
        </div>
        <div class="profile-hero-meta">
            <div class="profile-meta-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Bergabung: <?php echo e(Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-'); ?>

            </div>
            <div class="profile-meta-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Terakhir diubah: <?php echo e(Auth::user()->updated_at ? Auth::user()->updated_at->diffForHumans() : '-'); ?>

            </div>
        </div>
    </div>

    <!-- Photo Upload Section -->
    <div class="photo-upload-section">
        <div class="profile-section-header">
            <div class="profile-section-icon emerald">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="profile-section-title">Foto Profil</h3>
                <p class="profile-section-desc">Upload foto untuk ditampilkan di profil Anda</p>
            </div>
        </div>
        <div class="photo-upload-body">
            <div class="photo-upload-preview">
                <?php if(Auth::user()->profile_photo): ?>
                    <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Foto Profil" id="photo-preview-img">
                <?php else: ?>
                    <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 2))); ?>

                <?php endif; ?>
            </div>
            <div class="photo-upload-info">
                <h4>Ganti Foto Profil</h4>
                <p>Format yang didukung: JPG, PNG, WEBP. Maksimal 2MB.</p>
                <div class="photo-upload-actions">
                    <form method="POST" action="<?php echo e(route('profile.photo.update')); ?>" enctype="multipart/form-data" id="photo-upload-form">
                        <?php echo csrf_field(); ?>
                        <input type="file" name="profile_photo" id="photo-file-input" accept="image/jpeg,image/png,image/webp" style="display:none" onchange="handlePhotoSelected(this)">
                        <button type="button" class="photo-upload-btn photo-upload-btn-primary" onclick="document.getElementById('photo-file-input').click()">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Upload Foto
                        </button>
                    </form>
                    <?php if(Auth::user()->profile_photo): ?>
                        <form method="POST" action="<?php echo e(route('profile.photo.remove')); ?>" id="photo-remove-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <button type="submit" class="photo-upload-btn photo-upload-btn-outline">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus Foto
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <?php if($errors->get('profile_photo')): ?>
                    <?php $__currentLoopData = $errors->get('profile_photo'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="profile-form-error" style="margin-top:10px;">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <?php echo e($message); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <?php if(session('status') === 'photo-updated'): ?>
                    <span class="profile-success-msg" style="margin-top:10px;">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Foto profil berhasil diperbarui!
                    </span>
                <?php endif; ?>

                <?php if(session('status') === 'photo-removed'): ?>
                    <span class="profile-success-msg" style="margin-top:10px;">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Foto profil berhasil dihapus!
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Profile Grid -->
    <div class="profile-grid">
        <!-- Profile Information -->
        <div class="profile-section">
            <div class="profile-section-header">
                <div class="profile-section-icon indigo">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="profile-section-title">Informasi Profil</h3>
                    <p class="profile-section-desc">Perbarui nama dan alamat email Anda</p>
                </div>
            </div>
            <div class="profile-section-body">
                <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
                    <?php echo csrf_field(); ?>
                </form>

                <form method="post" action="<?php echo e(route('profile.update')); ?>" id="profile-update-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('patch'); ?>

                    <div class="profile-form-group">
                        <label for="name" class="profile-form-label">Nama Lengkap</label>
                        <input id="name" name="name" type="text" class="profile-form-input" value="<?php echo e(old('name', $user->name)); ?>" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap...">
                        <?php if($errors->get('name')): ?>
                            <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="profile-form-error">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?php echo e($message); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="profile-form-group">
                        <label for="email" class="profile-form-label">Alamat Email</label>
                        <input id="email" name="email" type="email" class="profile-form-input" value="<?php echo e(old('email', $user->email)); ?>" required autocomplete="username" placeholder="contoh@email.com">
                        <?php if($errors->get('email')): ?>
                            <?php $__currentLoopData = $errors->get('email'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="profile-form-error">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?php echo e($message); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                            <div style="margin-top:10px;">
                                <p style="font-size:13px;color:#92400e;background:#fffbeb;padding:10px 14px;border-radius:10px;border:1px solid #fde68a;display:flex;align-items:center;gap:8px;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:16px;height:16px;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Email Anda belum terverifikasi.
                                        <button form="send-verification" style="background:none;border:none;color:#6366f1;font-weight:600;cursor:pointer;text-decoration:underline;font-size:13px;">Kirim ulang email verifikasi</button>
                                    </span>
                                </p>

                                <?php if(session('status') === 'verification-link-sent'): ?>
                                    <p style="margin-top:8px;font-size:13px;color:#16a34a;font-weight:500;">
                                        ✓ Link verifikasi baru telah dikirim ke email Anda.
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="profile-form-actions">
                        <button type="submit" class="profile-btn profile-btn-primary">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>

                        <?php if(session('status') === 'profile-updated'): ?>
                            <span class="profile-success-msg">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Profil berhasil diperbarui!
                            </span>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Password -->
        <div class="profile-section">
            <div class="profile-section-header">
                <div class="profile-section-icon amber">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="profile-section-title">Ubah Password</h3>
                    <p class="profile-section-desc">Pastikan akun Anda menggunakan password yang kuat</p>
                </div>
            </div>
            <div class="profile-section-body">
                <form method="post" action="<?php echo e(route('password.update')); ?>" id="password-update-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>

                    <div class="profile-form-group">
                        <label for="update_password_current_password" class="profile-form-label">Password Saat Ini</label>
                        <div class="password-toggle">
                            <input id="update_password_current_password" name="current_password" type="password" class="profile-form-input" autocomplete="current-password" placeholder="Masukkan password saat ini...">
                            <button type="button" class="toggle-eye" onclick="togglePassword('update_password_current_password', this)">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                        <?php if($errors->updatePassword->get('current_password')): ?>
                            <?php $__currentLoopData = $errors->updatePassword->get('current_password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="profile-form-error">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?php echo e($message); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="profile-form-group">
                        <label for="update_password_password" class="profile-form-label">Password Baru</label>
                        <div class="password-toggle">
                            <input id="update_password_password" name="password" type="password" class="profile-form-input" autocomplete="new-password" placeholder="Minimal 8 karakter...">
                            <button type="button" class="toggle-eye" onclick="togglePassword('update_password_password', this)">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                        <?php if($errors->updatePassword->get('password')): ?>
                            <?php $__currentLoopData = $errors->updatePassword->get('password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="profile-form-error">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?php echo e($message); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <div class="profile-form-hint">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:12px;height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Gunakan kombinasi huruf besar, kecil, angka dan simbol
                        </div>
                    </div>

                    <div class="profile-form-group">
                        <label for="update_password_password_confirmation" class="profile-form-label">Konfirmasi Password Baru</label>
                        <div class="password-toggle">
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="profile-form-input" autocomplete="new-password" placeholder="Ulangi password baru...">
                            <button type="button" class="toggle-eye" onclick="togglePassword('update_password_password_confirmation', this)">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                        <?php if($errors->updatePassword->get('password_confirmation')): ?>
                            <?php $__currentLoopData = $errors->updatePassword->get('password_confirmation'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="profile-form-error">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <?php echo e($message); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="profile-form-actions">
                        <button type="submit" class="profile-btn profile-btn-primary">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Perbarui Password
                        </button>

                        <?php if(session('status') === 'password-updated'): ?>
                            <span class="profile-success-msg">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Password berhasil diperbarui!
                            </span>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danger Zone - Delete Account -->
        <div class="profile-section profile-section-full danger-zone">
            <div class="profile-section-header">
                <div class="profile-section-icon red">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="profile-section-title" style="color:#991b1b;">Zona Berbahaya</h3>
                    <p class="profile-section-desc">Tindakan ini bersifat permanen dan tidak dapat dibatalkan</p>
                </div>
            </div>
            <div class="profile-section-body">
                <div class="danger-zone-content">
                    <div class="danger-zone-text">
                        <h4>Hapus Akun Saya</h4>
                        <p>Setelah akun Anda dihapus, semua data dan informasi di dalamnya akan dihapus secara permanen. Pastikan Anda sudah menyimpan data penting sebelum melanjutkan.</p>
                    </div>
                    <button type="button" class="profile-btn profile-btn-danger" onclick="showProfileDeleteModal()" id="btn-delete-account">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="profile-modal-overlay" id="deleteAccountModal">
        <div class="profile-modal">
            <div class="profile-modal-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3>Hapus Akun Anda?</h3>
            <p>Tindakan ini tidak bisa dibatalkan. Semua data Anda akan dihapus secara permanen. Masukkan password untuk melanjutkan.</p>

            <form method="post" action="<?php echo e(route('profile.destroy')); ?>" id="delete-account-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>

                <div class="profile-form-group" style="margin-bottom:20px;">
                    <label for="delete_password" class="profile-form-label">Password</label>
                    <input id="delete_password" name="password" type="password" class="profile-form-input" placeholder="Masukkan password Anda..." required>
                    <?php if($errors->userDeletion->get('password')): ?>
                        <?php $__currentLoopData = $errors->userDeletion->get('password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="profile-form-error">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <?php echo e($message); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div class="profile-modal-actions">
                    <button type="button" class="profile-btn profile-btn-ghost" onclick="hideProfileDeleteModal()">
                        Batal
                    </button>
                    <button type="submit" class="profile-btn profile-btn-danger">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Ya, Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>';
            } else {
                input.type = 'password';
                btn.innerHTML = '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
            }
        }

        // Photo upload handler
        function handlePhotoSelected(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB!');
                    input.value = '';
                    return;
                }

                // Submit form
                document.getElementById('photo-upload-form').submit();
            }
        }

        // Delete account modal
        function showProfileDeleteModal() {
            document.getElementById('deleteAccountModal').classList.add('show');
            document.getElementById('delete_password').focus();
        }

        function hideProfileDeleteModal() {
            document.getElementById('deleteAccountModal').classList.remove('show');
            document.getElementById('delete_password').value = '';
        }

        // Close modal on outside click
        document.getElementById('deleteAccountModal').addEventListener('click', function(e) {
            if (e.target === this) hideProfileDeleteModal();
        });

        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') hideProfileDeleteModal();
        });

        // Show modal if there are validation errors for deletion
        <?php if($errors->userDeletion->isNotEmpty()): ?>
            showProfileDeleteModal();
        <?php endif; ?>
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
<?php endif; ?>
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/profile/edit.blade.php ENDPATH**/ ?>
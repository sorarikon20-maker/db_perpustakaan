<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        .auth-heading { text-align: center; margin-bottom: 28px; }
        .auth-heading h2 { font-size: 20px; font-weight: 700; color: white; }
        .auth-heading p { font-size: 13px; color: rgba(255,255,255,0.5); margin-top: 4px; }

        .auth-form-group { margin-bottom: 18px; }

        .auth-label {
            display: block;
            font-size: 13px; font-weight: 500;
            color: rgba(255,255,255,0.75);
            margin-bottom: 8px;
        }

        .auth-input {
            width: 100%;
            padding: 11px 14px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: white;
            outline: none;
            transition: all 0.2s;
        }

        .auth-input::placeholder { color: rgba(255,255,255,0.3); }

        .auth-input:focus {
            border-color: rgba(99,102,241,0.7);
            background: rgba(99,102,241,0.08);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
        }

        .auth-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 6px;
            box-shadow: 0 4px 20px rgba(99,102,241,0.4);
        }

        .auth-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 25px rgba(99,102,241,0.55);
        }

        .auth-divider { height: 1px; background: rgba(255,255,255,0.1); margin: 20px 0; }

        .auth-alt-text {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.5);
        }

        .auth-alt-text a {
            color: #a5b4fc;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-alt-text a:hover { color: white; }

        .auth-error {
            color: #fca5a5;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        @media (max-width: 420px) {
            .form-row { grid-template-columns: 1fr; }
        }

        .password-hint {
            font-size: 11px;
            color: rgba(255,255,255,0.35);
            margin-top: 5px;
        }
    </style>

    <div class="auth-heading">
        <h2>Buat Akun Baru ✨</h2>
        <p>Daftar untuk mengakses sistem perpustakaan</p>
    </div>

    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Name -->
        <div class="auth-form-group">
            <label for="name" class="auth-label">Nama Lengkap</label>
            <input
                id="name"
                type="text"
                name="name"
                value="<?php echo e(old('name')); ?>"
                class="auth-input"
                placeholder="Masukkan nama lengkap"
                required
                autofocus
                autocomplete="name"
            >
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="auth-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Email -->
        <div class="auth-form-group">
            <label for="email" class="auth-label">Alamat Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="<?php echo e(old('email')); ?>"
                class="auth-input"
                placeholder="nama@email.com"
                required
                autocomplete="username"
            >
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="auth-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Password Row -->
        <div class="form-row">
            <div class="auth-form-group" style="margin-bottom:0">
                <label for="password" class="auth-label">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="auth-input"
                    placeholder="Min. 8 karakter"
                    required
                    autocomplete="new-password"
                >
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="auth-error"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="auth-form-group" style="margin-bottom:0">
                <label for="password_confirmation" class="auth-label">Konfirmasi</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="auth-input"
                    placeholder="Ulangi password"
                    required
                    autocomplete="new-password"
                >
                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="auth-error"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <p class="password-hint" style="margin-top: 8px; margin-bottom: 4px;">
            🔒 Password minimal 8 karakter dengan kombinasi huruf dan angka
        </p>

        <!-- Submit -->
        <button type="submit" class="auth-btn" style="margin-top: 22px;">
            Daftar Sekarang
        </button>
    </form>

    <div class="auth-divider"></div>
    <p class="auth-alt-text">
        Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Masuk di sini</a>
    </p>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/auth/register.blade.php ENDPATH**/ ?>
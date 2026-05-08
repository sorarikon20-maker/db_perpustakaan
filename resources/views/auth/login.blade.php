<x-guest-layout>
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

        .auth-btn:active { transform: translateY(0); }

        .auth-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 8px;
        }

        .auth-check-group {
            display: flex; align-items: center; gap: 8px;
        }

        .auth-checkbox {
            width: 16px; height: 16px;
            accent-color: #6366f1;
            cursor: pointer;
        }

        .auth-check-label {
            font-size: 13px;
            color: rgba(255,255,255,0.6);
            cursor: pointer;
        }

        .auth-link {
            font-size: 13px;
            color: #a5b4fc;
            text-decoration: none;
        }

        .auth-link:hover { color: white; text-decoration: underline; }

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

        /* Error messages */
        .auth-error {
            color: #fca5a5;
            font-size: 12px;
            margin-top: 5px;
        }

        .auth-alert {
            padding: 10px 14px;
            background: rgba(167,243,208,0.1);
            border: 1px solid rgba(167,243,208,0.2);
            border-radius: 10px;
            color: #6ee7b7;
            font-size: 13px;
            margin-bottom: 18px;
        }
    </style>

    <div class="auth-heading">
        <h2>Selamat Datang! 👋</h2>
        <p>Masuk untuk mengakses panel admin</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="auth-alert">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="auth-form-group">
            <label for="email" class="auth-label">Alamat Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="auth-input"
                placeholder="nama@email.com"
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="auth-form-group">
            <label for="password" class="auth-label">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="auth-input"
                placeholder="Masukkan password"
                required
                autocomplete="current-password"
            >
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember & Forgot -->
        <div class="auth-row">
            <div class="auth-check-group">
                <input type="checkbox" id="remember_me" name="remember" class="auth-checkbox">
                <label for="remember_me" class="auth-check-label">Ingat saya</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">Lupa password?</a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn" style="margin-top: 22px;">
            Masuk ke Dashboard
        </button>
    </form>

    @if (Route::has('register'))
        <div class="auth-divider"></div>
        <p class="auth-alt-text">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    @endif
</x-guest-layout>

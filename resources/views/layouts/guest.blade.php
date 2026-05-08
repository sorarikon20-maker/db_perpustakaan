<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }

            body {
                font-family: 'Inter', sans-serif;
                min-height: 100vh;
                background: #0f172a;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
            }

            /* Background decorative elements */
            body::before {
                content: '';
                position: absolute;
                width: 600px; height: 600px;
                background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
                top: -100px; left: -100px;
                pointer-events: none;
            }

            body::after {
                content: '';
                position: absolute;
                width: 500px; height: 500px;
                background: radial-gradient(circle, rgba(139,92,246,0.12) 0%, transparent 70%);
                bottom: -100px; right: -100px;
                pointer-events: none;
            }

            .auth-container {
                width: 100%;
                max-width: 460px;
                padding: 24px 16px;
                position: relative;
                z-index: 1;
            }

            .auth-logo {
                text-align: center;
                margin-bottom: 32px;
            }

            .auth-logo-icon {
                width: 64px; height: 64px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                border-radius: 20px;
                display: flex; align-items: center; justify-content: center;
                margin: 0 auto 16px;
                box-shadow: 0 8px 32px rgba(99,102,241,0.4);
            }

            .auth-logo-icon svg { width: 30px; height: 30px; fill: white; }

            .auth-logo h1 {
                font-size: 22px; font-weight: 700; color: white;
            }

            .auth-logo p {
                font-size: 14px; color: rgba(255,255,255,0.5); margin-top: 4px;
            }

            .auth-card {
                background: rgba(255,255,255,0.05);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 24px;
                padding: 36px 32px;
                box-shadow: 0 25px 50px rgba(0,0,0,0.4);
            }

            .slot-content {
                /* inner content from slot */
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-logo">
                <div class="auth-logo-icon">
                    <img src="{{ asset('/images/logo.jpeg') }}" alt="Logo" style="width: 45px; height: 45px; border-radius: 5px;">
                </div>
                <h1>Knowledge tree</h1>
                <p>Sistem Manajemen Knowledge tree</p>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

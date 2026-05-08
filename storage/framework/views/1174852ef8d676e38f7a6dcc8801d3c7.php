<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Perpustakaan')); ?> - Admin Panel</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <style>
            /* ===== CUSTOM ADMIN THEME ===== */
            :root {
                --sidebar-width: 260px;
                --sidebar-collapsed: 72px;
                --primary: #6366f1;
                --primary-dark: #4f46e5;
                --primary-light: #a5b4fc;
                --sidebar-bg: #0f172a;
                --sidebar-hover: #1e293b;
                --sidebar-active: #312e81;
                --topbar-bg: #ffffff;
                --body-bg: #f1f5f9;
                --card-bg: #ffffff;
                --text-primary: #0f172a;
                --text-secondary: #64748b;
                --border-color: #e2e8f0;
                --success: #10b981;
                --warning: #f59e0b;
                --danger: #ef4444;
                --info: #3b82f6;
            }

            * { box-sizing: border-box; }

            body {
                font-family: 'Inter', sans-serif;
                background: var(--body-bg);
                color: var(--text-primary);
                margin: 0;
                padding: 0;
                min-height: 100vh;
            }

            /* ===== SIDEBAR ===== */
            #sidebar {
                position: fixed;
                left: 0; top: 0; bottom: 0;
                width: var(--sidebar-width);
                background: var(--sidebar-bg);
                z-index: 100;
                display: flex;
                flex-direction: column;
                transition: width 0.3s ease;
                overflow: hidden;
            }

            #sidebar.collapsed {
                width: var(--sidebar-collapsed);
            }

            .sidebar-logo {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 24px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                text-decoration: none;
                flex-shrink: 0;
            }

            .sidebar-logo-icon {
                width: 40px; height: 40px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                border-radius: 12px;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
                box-shadow: 0 4px 15px rgba(99,102,241,0.4);
            }

            .sidebar-logo-icon svg { width: 20px; height: 20px; fill: white; }

            .sidebar-logo-text {
                display: flex; flex-direction: column;
                white-space: nowrap;
                overflow: hidden;
                transition: opacity 0.3s, width 0.3s;
            }

            .sidebar-logo-text span:first-child {
                font-size: 15px; font-weight: 700; color: white; line-height: 1.2;
            }

            .sidebar-logo-text span:last-child {
                font-size: 11px; color: rgba(255,255,255,0.45); font-weight: 400;
            }

            #sidebar.collapsed .sidebar-logo-text { opacity: 0; width: 0; }

            .sidebar-nav {
                flex: 1;
                padding: 12px 10px;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .sidebar-nav::-webkit-scrollbar { width: 4px; }
            .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
            .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

            .nav-label {
                font-size: 10px;
                font-weight: 600;
                letter-spacing: 0.1em;
                color: rgba(255,255,255,0.3);
                text-transform: uppercase;
                padding: 12px 10px 6px;
                white-space: nowrap;
                transition: opacity 0.3s;
            }

            #sidebar.collapsed .nav-label { opacity: 0; }

            .nav-item {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 10px 10px;
                border-radius: 10px;
                color: rgba(255,255,255,0.6);
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
                margin-bottom: 2px;
                white-space: nowrap;
                position: relative;
                overflow: hidden;
            }

            .nav-item:hover {
                background: var(--sidebar-hover);
                color: rgba(255,255,255,0.9);
            }

            .nav-item.active {
                background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(139,92,246,0.2));
                color: white;
                border: 1px solid rgba(99,102,241,0.3);
            }

            .nav-item.active .nav-icon { color: #a5b4fc; }

            .nav-icon {
                width: 20px; height: 20px;
                flex-shrink: 0;
                display: flex; align-items: center; justify-content: center;
            }

            .nav-icon svg { width: 18px; height: 18px; }

            .nav-text {
                flex: 1;
                transition: opacity 0.3s;
                overflow: hidden;
            }

            #sidebar.collapsed .nav-text { opacity: 0; width: 0; }

            .nav-badge {
                background: var(--primary);
                color: white;
                font-size: 10px;
                font-weight: 600;
                padding: 2px 7px;
                border-radius: 20px;
                transition: opacity 0.3s;
            }

            #sidebar.collapsed .nav-badge { opacity: 0; }

            /* Tooltip on collapsed */
            #sidebar.collapsed .nav-item:hover::after {
                content: attr(data-tooltip);
                position: absolute;
                left: calc(var(--sidebar-collapsed) + 8px);
                top: 50%; transform: translateY(-50%);
                background: #1e293b;
                color: white;
                padding: 6px 12px;
                border-radius: 8px;
                font-size: 13px;
                white-space: nowrap;
                z-index: 200;
                box-shadow: 0 4px 15px rgba(0,0,0,0.3);
                pointer-events: none;
            }

            .sidebar-footer {
                padding: 16px 10px;
                border-top: 1px solid rgba(255,255,255,0.06);
                flex-shrink: 0;
            }

            .user-card {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px;
                border-radius: 10px;
                background: rgba(255,255,255,0.05);
                overflow: hidden;
            }

            .user-avatar {
                width: 36px; height: 36px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                color: white; font-weight: 700; font-size: 13px;
                flex-shrink: 0;
                overflow: hidden;
            }

            .user-avatar img {
                width: 100%; height: 100%;
                object-fit: cover;
            }

            .user-info { overflow: hidden; transition: opacity 0.3s, width 0.3s; }
            #sidebar.collapsed .user-info { opacity: 0; width: 0; }

            .user-info-name {
                font-size: 13px; font-weight: 600; color: white;
                white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            }

            .user-info-role {
                font-size: 11px; color: rgba(255,255,255,0.4);
                white-space: nowrap;
            }

            /* ===== MAIN LAYOUT ===== */
            #main-wrapper {
                margin-left: var(--sidebar-width);
                min-height: 100vh;
                transition: margin-left 0.3s ease;
                display: flex;
                flex-direction: column;
            }

            #main-wrapper.collapsed {
                margin-left: var(--sidebar-collapsed);
            }

            /* ===== TOPBAR ===== */
            #topbar {
                background: var(--topbar-bg);
                border-bottom: 1px solid var(--border-color);
                height: 64px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 24px;
                position: sticky;
                top: 0;
                z-index: 50;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }

            .topbar-left { display: flex; align-items: center; gap: 16px; }

            #toggle-sidebar-btn {
                width: 36px; height: 36px;
                border: 1px solid var(--border-color);
                background: white;
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                cursor: pointer;
                color: var(--text-secondary);
                transition: all 0.2s;
            }

            #toggle-sidebar-btn:hover {
                background: var(--body-bg);
                color: var(--primary);
                border-color: var(--primary);
            }

            #toggle-sidebar-btn svg { width: 18px; height: 18px; }

            .breadcrumb {
                display: flex; align-items: center; gap: 8px;
                font-size: 13px; color: var(--text-secondary);
            }

            .breadcrumb-active { color: var(--text-primary); font-weight: 600; }

            /* Topbar User Dropdown */
            .topbar-right {
                display: flex; align-items: center; gap: 12px;
            }

            .topbar-user-btn {
                display: flex; align-items: center; gap: 10px;
                padding: 6px 12px;
                border: 1px solid var(--border-color);
                border-radius: 10px;
                background: white;
                cursor: pointer;
                transition: all 0.2s;
                font-size: 14px;
                color: var(--text-primary);
                font-family: 'Inter', sans-serif;
            }

            .topbar-user-btn:hover { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(99,102,241,0.1); }

            .topbar-user-avatar {
                width: 30px; height: 30px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
                color: white; font-weight: 700; font-size: 12px;
                overflow: hidden;
            }

            .topbar-user-avatar img {
                width: 100%; height: 100%;
                object-fit: cover;
            }

            /* Dropdown */
            .dropdown-wrapper { position: relative; }

            .dropdown-menu {
                position: absolute; right: 0; top: calc(100% + 8px);
                background: white;
                border: 1px solid var(--border-color);
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.12);
                min-width: 200px;
                z-index: 200;
                overflow: hidden;
                display: none;
                animation: dropIn 0.15s ease;
            }

            .dropdown-menu.show { display: block; }

            @keyframes dropIn {
                from { opacity: 0; transform: translateY(-8px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .dropdown-header {
                padding: 14px 16px;
                border-bottom: 1px solid var(--border-color);
            }

            .dropdown-header-name { font-size: 14px; font-weight: 600; color: var(--text-primary); }
            .dropdown-header-email { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }

            .dropdown-item {
                display: flex; align-items: center; gap: 10px;
                padding: 10px 16px;
                color: var(--text-secondary);
                text-decoration: none;
                font-size: 14px;
                transition: all 0.15s;
                cursor: pointer;
            }

            .dropdown-item:hover { background: var(--body-bg); color: var(--primary); }
            .dropdown-item svg { width: 16px; height: 16px; }

            .dropdown-divider { height: 1px; background: var(--border-color); }

            .dropdown-item.danger:hover { color: var(--danger); background: #fef2f2; }

            /* ===== PAGE CONTENT ===== */
            #page-content {
                flex: 1;
                padding: 28px 28px;
            }

            /* ===== PAGE HEADER ===== */
            .page-header {
                margin-bottom: 24px;
            }

            .page-header h1 {
                font-size: 22px;
                font-weight: 700;
                color: var(--text-primary);
                margin: 0 0 4px;
            }

            .page-header p {
                font-size: 14px;
                color: var(--text-secondary);
                margin: 0;
            }

            /* ===== CARDS ===== */
            .card {
                background: var(--card-bg);
                border-radius: 16px;
                border: 1px solid var(--border-color);
                box-shadow: 0 1px 3px rgba(0,0,0,0.04);
                overflow: hidden;
            }

            .card-header {
                padding: 20px 24px;
                border-bottom: 1px solid var(--border-color);
                display: flex; align-items: center; justify-content: space-between;
            }

            .card-header h3 {
                font-size: 15px; font-weight: 600; color: var(--text-primary); margin: 0;
            }

            .card-body { padding: 24px; }

            /* ===== STAT CARDS ===== */
            .stat-card {
                background: var(--card-bg);
                border-radius: 16px;
                padding: 20px;
                border: 1px solid var(--border-color);
                display: flex; align-items: center; gap: 16px;
                text-decoration: none;
                transition: all 0.2s;
                box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            }

            .stat-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.1);
                border-color: var(--primary-light);
            }

            .stat-icon {
                width: 52px; height: 52px;
                border-radius: 14px;
                display: flex; align-items: center; justify-content: center;
                flex-shrink: 0;
            }

            .stat-icon svg { width: 24px; height: 24px; }

            .stat-label { font-size: 13px; color: var(--text-secondary); margin-bottom: 4px; }
            .stat-value { font-size: 28px; font-weight: 700; color: var(--text-primary); line-height: 1; }

            /* ===== BUTTONS ===== */
            .btn {
                display: inline-flex; align-items: center; gap: 8px;
                padding: 9px 18px;
                border-radius: 10px;
                font-size: 14px; font-weight: 500;
                cursor: pointer; border: none;
                text-decoration: none;
                transition: all 0.2s;
                font-family: 'Inter', sans-serif;
            }

            .btn-primary {
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                color: white;
                box-shadow: 0 2px 10px rgba(99,102,241,0.4);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 15px rgba(99,102,241,0.5);
                color: white;
            }

            .btn-secondary {
                background: white; color: var(--text-secondary);
                border: 1px solid var(--border-color);
            }

            .btn-secondary:hover { background: var(--body-bg); color: var(--text-primary); }

            .btn-success {
                background: linear-gradient(135deg, #10b981, #059669);
                color: white;
                box-shadow: 0 2px 10px rgba(16,185,129,0.35);
            }

            .btn-success:hover { transform: translateY(-1px); box-shadow: 0 4px 15px rgba(16,185,129,0.45); color: white; }

            .btn-danger {
                background: linear-gradient(135deg, #ef4444, #dc2626);
                color: white;
                box-shadow: 0 2px 10px rgba(239,68,68,0.35);
            }

            .btn-danger:hover { transform: translateY(-1px); color: white; }

            .btn-warning {
                background: linear-gradient(135deg, #f59e0b, #d97706);
                color: white;
                box-shadow: 0 2px 10px rgba(245,158,11,0.35);
            }

            .btn-warning:hover { transform: translateY(-1px); color: white; }

            .btn-sm { padding: 6px 14px; font-size: 13px; }
            .btn svg { width: 16px; height: 16px; }

            /* ===== TABLES ===== */
            .table-wrapper { overflow-x: auto; }

            .data-table { width: 100%; border-collapse: collapse; }

            .data-table th {
                padding: 12px 16px;
                text-align: left;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                color: var(--text-secondary);
                background: #f8fafc;
                border-bottom: 1px solid var(--border-color);
            }

            .data-table td {
                padding: 14px 16px;
                font-size: 14px;
                color: var(--text-primary);
                border-bottom: 1px solid #f1f5f9;
            }

            .data-table tbody tr:hover { background: #f8fafc; }
            .data-table tbody tr:last-child td { border-bottom: none; }

            /* Table Action buttons */
            .action-btn {
                width: 32px; height: 32px;
                border-radius: 8px;
                display: inline-flex; align-items: center; justify-content: center;
                border: none; cursor: pointer;
                transition: all 0.2s;
                text-decoration: none;
            }

            .action-btn svg { width: 15px; height: 15px; }

            .action-edit { background: #fef3c7; color: #d97706; }
            .action-edit:hover { background: #fde68a; }

            .action-delete { background: #fee2e2; color: #ef4444; }
            .action-delete:hover { background: #fecaca; }

            .action-view { background: #e0e7ff; color: #4f46e5; }
            .action-view:hover { background: #c7d2fe; }

            /* ===== FORMS ===== */
            .form-group { margin-bottom: 20px; }

            .form-label {
                display: block;
                font-size: 14px; font-weight: 500;
                color: var(--text-primary);
                margin-bottom: 6px;
            }

            .form-control {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid var(--border-color);
                border-radius: 10px;
                font-size: 14px;
                font-family: 'Inter', sans-serif;
                color: var(--text-primary);
                background: white;
                transition: all 0.2s;
                outline: none;
            }

            .form-control:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
            }

            .form-control::placeholder { color: #94a3b8; }

            /* ===== ALERTS / FLASH ===== */
            .alert {
                padding: 12px 16px;
                border-radius: 10px;
                font-size: 14px;
                margin-bottom: 20px;
                display: flex; align-items: center; gap: 10px;
                border: 1px solid;
            }

            .alert-success { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }
            .alert-danger { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
            .alert-warning { background: #fffbeb; color: #92400e; border-color: #fde68a; }
            .alert-info { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }

            /* ===== BADGES ===== */
            .badge {
                display: inline-flex; align-items: center;
                padding: 3px 10px;
                border-radius: 20px;
                font-size: 12px; font-weight: 500;
            }

            .badge-success { background: #dcfce7; color: #166534; }
            .badge-danger { background: #fee2e2; color: #991b1b; }
            .badge-warning { background: #fef3c7; color: #92400e; }
            .badge-info { background: #dbeafe; color: #1e40af; }
            .badge-secondary { background: #f1f5f9; color: #64748b; }
            .badge-primary { background: #e0e7ff; color: #4338ca; }

            /* ===== SEARCH ===== */
            .search-wrapper {
                position: relative;
                display: flex; align-items: center;
            }

            .search-icon {
                position: absolute; left: 12px;
                color: var(--text-secondary);
                pointer-events: none;
            }

            .search-icon svg { width: 16px; height: 16px; }

            .search-input {
                padding: 9px 14px 9px 38px;
                border: 1px solid var(--border-color);
                border-radius: 10px;
                font-size: 14px;
                font-family: 'Inter', sans-serif;
                color: var(--text-primary);
                background: white;
                transition: all 0.2s;
                outline: none;
                min-width: 280px;
            }

            .search-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
            }

            /* ===== PAGINATION ===== */
            .pagination-wrapper { display: flex; justify-content: flex-end; margin-top: 20px; }

            /* ===== OVERLAY (mobile) ===== */
            #sidebar-overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 90;
            }

            /* ===== RESPONSIVE ===== */

            /* Prevent horizontal scroll globally on mobile */
            @media (max-width: 768px) {
                html, body {
                    overflow-x: hidden;
                    max-width: 100vw;
                }

                #sidebar {
                    width: var(--sidebar-width) !important;
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                }

                #sidebar.mobile-open {
                    transform: translateX(0);
                }

                #sidebar-overlay { display: none; }
                #sidebar.mobile-open ~ #sidebar-overlay { display: block; }

                #main-wrapper {
                    margin-left: 0 !important;
                    overflow-x: hidden;
                }

                #page-content {
                    padding: 16px 12px;
                    overflow-x: hidden;
                    max-width: 100vw;
                    box-sizing: border-box;
                }

                /* Topbar mobile */
                #topbar { padding: 0 12px; height: 56px; }
                .topbar-user-btn span { display: none; }
                .topbar-user-btn svg:last-child { display: none; }
                .topbar-user-btn { padding: 6px; border: none; }
                .breadcrumb { font-size: 12px; }

                /* Page headers */
                #page-content > div > h1,
                #page-content h1 {
                    font-size: 18px !important;
                }
                #page-content > div > p {
                    font-size: 12px !important;
                }

                /* Cards */
                .card { border-radius: 14px; overflow: hidden; }
                .card-header {
                    padding: 14px 16px;
                    flex-wrap: wrap;
                    gap: 12px;
                }
                .card-header h3 { font-size: 14px; }
                .card-body { padding: 16px; }

                /* Search wrapping */
                .card-header form {
                    width: 100%;
                    display: flex;
                    gap: 8px;
                }
                .card-header form .search-wrapper { flex: 1; }
                .search-input {
                    min-width: 0 !important;
                    width: 100%;
                    font-size: 13px;
                    padding: 8px 12px 8px 34px;
                }

                /* ========== MOBILE TABLE → CARD LAYOUT ========== */
                .table-wrapper {
                    overflow-x: visible;
                    margin: 0;
                    padding: 0;
                }

                .data-table,
                .data-table thead,
                .data-table tbody,
                .data-table th,
                .data-table td,
                .data-table tr {
                    display: block;
                }

                /* Hide table header on mobile */
                .data-table thead {
                    display: none;
                }

                /* Each row becomes a card */
                .data-table tbody tr {
                    background: white;
                    border: 1px solid #e8ecf1;
                    border-radius: 12px;
                    margin-bottom: 10px;
                    padding: 14px;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 6px 12px;
                    align-items: center;
                    position: relative;
                }

                .data-table tbody tr:hover {
                    background: #f8fafc;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                }

                .data-table td {
                    padding: 2px 0;
                    border-bottom: none;
                    font-size: 13px;
                    white-space: normal;
                    word-break: break-word;
                }

                /* Label each cell with its header text via data-label */
                .data-table td[data-label]::before {
                    content: attr(data-label);
                    display: block;
                    font-size: 10px;
                    font-weight: 600;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    margin-bottom: 2px;
                }

                /* First cell (No.) - small badge */
                .data-table td:first-child {
                    position: absolute;
                    top: 14px;
                    right: 14px;
                    font-size: 11px;
                    color: #94a3b8;
                    background: #f1f5f9;
                    padding: 2px 8px;
                    border-radius: 6px;
                    width: auto;
                }

                /* Name/title cell - full width, prominent */
                .data-table td:nth-child(2) {
                    width: 100%;
                    font-size: 14px;
                    font-weight: 600;
                    padding-right: 50px;
                    padding-bottom: 4px;
                    margin-bottom: 2px;
                    border-bottom: 1px solid #f1f5f9;
                }

                /* Action cell (last cell) */
                .data-table td:last-child {
                    width: 100%;
                    padding-top: 8px;
                    margin-top: 4px;
                    border-top: 1px solid #f1f5f9;
                    display: flex;
                    justify-content: flex-end;
                }

                .data-table td:last-child > div {
                    gap: 6px !important;
                }

                /* Action buttons */
                .action-btn { width: 32px; height: 32px; border-radius: 8px; }
                .action-btn svg { width: 14px; height: 14px; }

                /* Empty state row */
                .data-table tbody tr:only-child {
                    justify-content: center;
                    text-align: center;
                }

                .data-table tbody tr:only-child td:first-child {
                    position: static;
                    background: none;
                    width: 100%;
                }

                /* Buttons */
                .btn { padding: 8px 14px; font-size: 13px; border-radius: 8px; }
                .btn-sm { padding: 5px 10px; font-size: 12px; }

                /* Forms */
                .form-group { margin-bottom: 16px; }
                .form-label { font-size: 13px; }
                .form-control { padding: 9px 12px; font-size: 13px; border-radius: 8px; }

                /* Stat cards */
                .stat-card { padding: 14px; border-radius: 12px; }
                .stat-icon { width: 42px; height: 42px; border-radius: 10px; }
                .stat-value { font-size: 22px; }
                .stat-label { font-size: 12px; }

                /* Badges */
                .badge { font-size: 11px; padding: 2px 8px; }

                /* Alerts */
                .alert { padding: 10px 12px; font-size: 13px; border-radius: 8px; }

                /* Dropdown */
                .dropdown-menu { min-width: 180px; right: -8px; }

                /* Fix inline display:flex gap on actions */
                #page-content td > div[style*="display:flex"] {
                    gap: 4px !important;
                }

                /* Peminjaman summary grid stacking */
                .peminjaman-summary-grid {
                    grid-template-columns: 1fr !important;
                    gap: 12px !important;
                }

                /* Fix inline styled min-width elements */
                [style*="min-width"] {
                    min-width: 0 !important;
                }

                /* Inline styled text truncation fix */
                [style*="max-width:180px"] {
                    max-width: 100% !important;
                    white-space: normal !important;
                }
            }

            /* Extra small screens */
            @media (max-width: 480px) {
                #page-content { padding: 12px 10px; }

                #page-content > div > h1,
                #page-content h1 {
                    font-size: 16px !important;
                }

                .card-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 10px;
                }

                /* Full-width buttons on very small screens */
                #page-content > div:first-child {
                    flex-direction: column !important;
                    align-items: stretch !important;
                }

                #page-content > div:first-child > .btn {
                    text-align: center;
                    justify-content: center;
                }
            }

            /* Forms responsive grids */
            @media (max-width: 600px) {
                [style*="grid-template-columns: 1fr 1fr"],
                [style*="grid-template-columns:1fr 1fr"] {
                    grid-template-columns: 1fr !important;
                }
                [style*="grid-template-columns: 2fr 1fr 1fr 1fr"],
                [style*="grid-template-columns:2fr 1fr 1fr 1fr"] {
                    grid-template-columns: 1fr 1fr !important;
                }
            }
        </style>
    </head>
    <body>
        <!-- Sidebar Overlay (mobile) -->
        <div id="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- SIDEBAR -->
        <aside id="sidebar">
            <!-- Logo -->
            <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <img src="<?php echo e(asset('/images/logo.jpeg')); ?>" alt="Logo" style="width: 40px; height: 40px; border-radius: 10px;">
                </div>
                <div class="sidebar-logo-text">
                    <span>Knowledge Tree</span>
                    <span>Admin Panel</span>
                </div>
            </a>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <div class="nav-label">Menu Utama</div>

                <a href="<?php echo e(route('dashboard')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                   data-tooltip="Dashboard">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </span>
                    <span class="nav-text">Dashboard</span>
                </a>

                <div class="nav-label">Manajemen Data</div>

                <a href="<?php echo e(route('siswas.index')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('siswas.*') ? 'active' : ''); ?>"
                   data-tooltip="Siswa">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <span class="nav-text">Data Siswa</span>
                </a>

                <a href="<?php echo e(route('kategoris.index')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('kategoris.*') ? 'active' : ''); ?>"
                   data-tooltip="Kategori">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </span>
                    <span class="nav-text">Kategori Buku</span>
                </a>

                <a href="<?php echo e(route('bukus.index')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('bukus.*') ? 'active' : ''); ?>"
                   data-tooltip="Buku">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    <span class="nav-text">Data Buku</span>
                </a>

                <a href="<?php echo e(route('rak-buku.index')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('rak-buku.*') ? 'active' : ''); ?>"
                   data-tooltip="Rak Buku">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </span>
                    <span class="nav-text">Rak Buku</span>
                </a>

                <a href="<?php echo e(route('peminjamans.index')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('peminjamans.index') ? 'active' : ''); ?>"
                   data-tooltip="Peminjaman">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </span>
                    <span class="nav-text">Peminjaman</span>
                </a>

                <div class="nav-label">Denda</div>

                <a href="<?php echo e(route('peminjamans.laporan')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('peminjamans.laporan') ? 'active' : ''); ?>"
                   data-tooltip="Laporan Denda">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-3.333 0-6 2.667-6 6s2.667 6 6 6 6-2.667 6-6-2.667-6-6-6zm0 0V4m0 4l2 2m-2-2l-2 2"/>
                        </svg>
                    </span>
                    <span class="nav-text">Laporan Denda</span>
                </a>


                <div class="nav-label">Sistem</div>

                <a href="<?php echo e(route('settings.index')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('settings.*') ? 'active' : ''); ?>"
                   data-tooltip="Pengaturan">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <span class="nav-text">Pengaturan</span>
                </a>

                <div class="nav-label">Akun</div>

                <a href="<?php echo e(route('profile.edit')); ?>"
                   class="nav-item <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?>"
                   data-tooltip="Profil">
                    <span class="nav-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <span class="nav-text">Profil Saya</span>
                </a>

                <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin:0">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-item" style="width:100%; background:none; border:none; text-align:left;" data-tooltip="Logout">
                        <span class="nav-icon" style="color:rgba(255,255,255,0.6)">
                            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </span>
                        <span class="nav-text">Keluar</span>
                    </button>
                </form>
            </nav>

            <!-- User Info Footer -->
            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="user-avatar">
                        <?php if(Auth::user()->profile_photo): ?>
                            <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Avatar">
                        <?php else: ?>
                            <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?>

                        <?php endif; ?>
                    </div>
                    <div class="user-info">
                        <div class="user-info-name"><?php echo e(Auth::user()->name ?? 'User'); ?></div>
                        <div class="user-info-role">Administrator</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN WRAPPER -->
        <div id="main-wrapper">
            <!-- TOPBAR -->
            <header id="topbar">
                <div class="topbar-left">
                    <button id="toggle-sidebar-btn" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <?php if(isset($header)): ?>
                        <div class="breadcrumb">
                            <a href="<?php echo e(route('dashboard')); ?>" style="color:var(--text-secondary); text-decoration:none;">Home</a>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            <span class="breadcrumb-active"><?php echo e($header); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="topbar-right">
                    <div class="dropdown-wrapper">
                        <button class="topbar-user-btn" onclick="toggleDropdown()" id="user-dropdown-btn">
                            <div class="topbar-user-avatar">
                                <?php if(Auth::user()->profile_photo): ?>
                                    <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Avatar">
                                <?php else: ?>
                                    <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?>

                                <?php endif; ?>
                            </div>
                            <span style="font-weight:500"><?php echo e(Auth::user()->name ?? 'User'); ?></span>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:var(--text-secondary)">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div class="dropdown-menu" id="user-dropdown-menu">
                            <div class="dropdown-header">
                                <div class="dropdown-header-name"><?php echo e(Auth::user()->name ?? 'User'); ?></div>
                                <div class="dropdown-header-email"><?php echo e(Auth::user()->email ?? ''); ?></div>
                            </div>
                            <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profil Saya
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin:0">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item danger" style="width:100%; background:none; border:none; font-family:inherit; text-align:left; cursor:pointer;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main id="page-content">
                <?php echo e($slot); ?>

            </main>
        </div>

        <script>
            // Sidebar State
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('main-wrapper');
            const isMobile = () => window.innerWidth <= 768;

            // Restore collapsed state
            if (!isMobile() && localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                mainWrapper.classList.add('collapsed');
            }

            function toggleSidebar() {
                if (isMobile()) {
                    sidebar.classList.toggle('mobile-open');
                    document.getElementById('sidebar-overlay').style.display =
                        sidebar.classList.contains('mobile-open') ? 'block' : 'none';
                } else {
                    sidebar.classList.toggle('collapsed');
                    mainWrapper.classList.toggle('collapsed');
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                }
            }

            // Dropdown
            function toggleDropdown() {
                const menu = document.getElementById('user-dropdown-menu');
                menu.classList.toggle('show');
            }

            // Close dropdown on outside click
            document.addEventListener('click', function(e) {
                const btn = document.getElementById('user-dropdown-btn');
                const menu = document.getElementById('user-dropdown-menu');
                if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('show');
                }
            });

            // Responsive
            window.addEventListener('resize', () => {
                if (!isMobile()) {
                    sidebar.classList.remove('mobile-open');
                    document.getElementById('sidebar-overlay').style.display = 'none';
                }
            });

            // Delete Confirmation Modal
            let deleteForm = null;
            let deleteItem = null;

            function showDeleteModal(form, itemName) {
                deleteForm = form;
                deleteItem = itemName;
                document.getElementById('deleteConfirmModal').style.display = 'flex';
                document.getElementById('deleteItemName').textContent = itemName;
            }

            function hideDeleteModal() {
                document.getElementById('deleteConfirmModal').style.display = 'none';
                deleteForm = null;
                deleteItem = null;
            }

            function confirmDelete() {
                if (deleteForm) {
                    deleteForm.submit();
                }
                hideDeleteModal();
            }

            // Close modal on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && document.getElementById('deleteConfirmModal').style.display === 'flex') {
                    hideDeleteModal();
                }
            });

            // Close modal on outside click
            document.getElementById('deleteConfirmModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideDeleteModal();
                }
            });
        </script>

        <!-- Delete Confirmation Modal -->
        <div id="deleteConfirmModal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:9999;justify-content:center;align-items:center;backdrop-filter:blur(4px)">
            <div style="background:white;border-radius:20px;padding:40px;max-width:420px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.15);animation:slideUp 0.3s ease">
                <div style="margin-bottom:32px;text-align:center">
                    <div style="width:60px;height:60px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px">
                        <svg fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24" style="width:28px;height:28px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 style="margin:0 0 8px;font-size:20px;font-weight:700;color:#0f172a">Hapus Data?</h3>
                    <p style="margin:0;color:#64748b;font-size:14px">Anda yakin ingin menghapus <strong id="deleteItemName" style="color:#ef4444">item ini</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                </div>

                <div style="display:flex;gap:12px;justify-content:flex-end">
                    <button type="button" onclick="hideDeleteModal()" style="flex:1;padding:12px 20px;border:1px solid #e2e8f0;background:white;color:#64748b;border-radius:10px;font-weight:600;cursor:pointer;transition:all 0.2s;font-size:14px" onmouseover="this.style.background='#f8fafc';this.style.borderColor='#cbd5e1'" onmouseout="this.style.background='white';this.style.borderColor='#e2e8f0'">
                        Batal
                    </button>
                    <button type="button" onclick="confirmDelete()" style="flex:1;padding:12px 20px;background:#ef4444;color:white;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:all 0.2s;font-size:14px" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                        Hapus
                    </button>
                </div>
            </div>
            <style>
                @keyframes slideUp {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            </style>
        </div>
    </body>
</html>
<?php /**PATH C:\laragon\www\Azzam-sp-XI-PPLG-1-TUGAS-MIGRATION\resources\views/layouts/app.blade.php ENDPATH**/ ?>
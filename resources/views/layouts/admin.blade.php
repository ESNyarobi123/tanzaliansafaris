<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2B5238">
    <title>@yield('title', 'Admin Dashboard') - Tanzalian Safari's</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        /* ============================================
           MODERN ADMIN DESIGN SYSTEM
        ============================================ */
        :root {
            /* ============================================
               TANZALIAN SAFARIS - BRAND COLOR SYSTEM
               Primary: Deep Forest Green (#2B5238)
               Accent: Golden Harvest (#F1B434)
               Usage: 60% White | 30% Green | 10% Gold
            ============================================ */
            
            /* Primary Colors - Deep Forest Green */
            --primary-50: #f4f7f5;
            --primary-100: #e3ebe6;
            --primary-500: #4d775a;
            --primary-600: #2B5238;
            --primary-700: #23452f;
            
            /* Secondary - Forest Green */
            --secondary-600: #4d775a;
            --secondary-800: #2B5238;
            --secondary-900: #1c3726;

            /* Accent - Golden Harvest */
            --accent-400: #f6db97;
            --accent-500: #F1B434;

            /* Neutrals */
            --gray-50: #F7F7F7;
            --gray-100: #eeeeee;
            --gray-200: #e0e0e0;
            --gray-300: #cccccc;
            --gray-400: #888888;
            --gray-500: #555555;
            --gray-600: #444444;
            --gray-700: #333333;
            --gray-800: #222222;
            --gray-900: #1a1a1a;

            /* Semantic */
            --primary: #2B5238;
            --primary-light: #4d775a;
            --accent: #F1B434;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #F1B434;
            
            /* UI */
            --sidebar-bg: var(--gray-900);
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 80px;
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 250ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Fonts */
            --font-sans: 'Montserrat', sans-serif;
            --font-display: 'Montserrat', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', system-ui, sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-800);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.6;
        }

        /* ============================================
           SIDEBAR - Modern Glass Effect
        ============================================ */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--gray-900) 0%, #0a0f1c 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all var(--transition-base);
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all var(--transition-fast);
        }

        .sidebar-logo:hover {
            opacity: 0.9;
        }

        .sidebar-logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
        }

        .sidebar-menu {
            padding: 16px 12px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-section {
            margin-bottom: 24px;
        }

        .menu-section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gray-500);
            padding: 0 16px;
            margin-bottom: 8px;
        }

        .menu-item {
            padding: 12px 16px;
            margin: 4px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--gray-400);
            text-decoration: none;
            transition: all var(--transition-fast);
            font-weight: 500;
            font-size: 14px;
            border-radius: var(--radius-lg);
            position: relative;
        }

        .menu-item:hover {
            color: white;
            background: rgba(255,255,255,0.05);
        }

        .menu-item.active {
            color: white;
            background: linear-gradient(135deg, rgba(43, 82, 56, 0.2), rgba(35, 69, 47, 0.3));
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: var(--accent-400);
            border-radius: 0 4px 4px 0;
        }

        .menu-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            transition: all var(--transition-fast);
        }

        .menu-item:hover i {
            transform: translateX(2px);
        }

        .menu-badge {
            margin-left: auto;
            background: var(--primary-600);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: var(--radius-full);
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .logout-btn {
            width: 100%;
            padding: 12px 16px;
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: none;
            border-radius: var(--radius-lg);
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all var(--transition-fast);
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* ============================================
           MAIN CONTENT
        ============================================ */
        .main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Header */
        .header {
            height: var(--header-height);
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .page-title h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.75rem;
            color: var(--gray-900);
            font-weight: 400;
        }

        .page-title p {
            font-size: 13px;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-btn {
            width: 40px;
            height: 40px;
            background: var(--gray-100);
            border: none;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            cursor: pointer;
            transition: all var(--transition-fast);
            position: relative;
        }

        .notification-btn:hover {
            background: var(--gray-200);
            color: var(--gray-800);
        }

        .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid var(--gray-100);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px 8px 8px;
            background: var(--gray-100);
            border-radius: var(--radius-full);
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .user-profile:hover {
            background: var(--gray-200);
        }

        .avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--secondary-800), var(--secondary-600));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 13px;
            color: var(--gray-800);
        }

        .user-role {
            font-size: 11px;
            color: var(--gray-500);
            text-transform: capitalize;
        }

        /* Content Area */
        .content {
            padding: 32px;
        }

        /* ============================================
           CARDS
        ============================================ */
        .card {
            background: white;
            border-radius: var(--radius-2xl);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            margin-bottom: 24px;
            transition: all var(--transition-base);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--gray-800);
        }

        .card-action {
            font-size: 13px;
            color: var(--primary-600);
            text-decoration: none;
            font-weight: 500;
        }

        .card-action:hover {
            text-decoration: underline;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-2xl);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary-800), var(--accent-500));
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-50), var(--primary-100));
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--primary-600);
            margin-bottom: 16px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--gray-500);
        }

        .stat-change {
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* ============================================
           ALERTS
        ============================================ */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-xl);
            margin-bottom: 24px;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success { 
            background: #ecfdf5; 
            color: #065f46; 
            border: 1px solid #a7f3d0; 
        }
        .alert-error { 
            background: #fef2f2; 
            color: #991b1b; 
            border: 1px solid #fecaca; 
        }
        .alert-warning { 
            background: #fffbeb; 
            color: #92400e; 
            border: 1px solid #fcd34d; 
        }

        /* ============================================
           TABLES - Modern Style
        ============================================ */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-xl);
            border: 1px solid var(--gray-200);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }

        th {
            text-align: left;
            padding: 16px 20px;
            color: var(--gray-600);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
        }

        th:first-child {
            border-radius: var(--radius-xl) 0 0 0;
        }

        th:last-child {
            border-radius: 0 var(--radius-xl) 0 0;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gray-100);
            color: var(--gray-700);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:last-child td:first-child {
            border-radius: 0 0 0 var(--radius-xl);
        }

        tr:last-child td:last-child {
            border-radius: 0 0 var(--radius-xl) 0;
        }

        tr:hover td {
            background: var(--gray-50);
        }

        /* Table Actions */
        .table-actions {
            display: flex;
            gap: 8px;
        }

        /* ============================================
           BUTTONS
        ============================================ */
        .btn {
            padding: 10px 20px;
            border-radius: var(--radius-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-fast);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
            font-family: inherit;
        }

        .btn-primary { 
            background: linear-gradient(135deg, var(--secondary-800), var(--secondary-700));
            color: white;
            box-shadow: 0 4px 12px rgba(22, 101, 52, 0.25);
        }
        .btn-primary:hover { 
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(22, 101, 52, 0.35);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-700);
        }
        .btn-secondary:hover {
            background: var(--gray-200);
        }

        .btn-danger { 
            background: #fef2f2;
            color: #dc2626;
        }
        .btn-danger:hover { 
            background: #fee2e2;
        }

        .btn-success {
            background: #ecfdf5;
            color: #059669;
        }
        .btn-success:hover {
            background: #d1fae5;
        }

        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .btn-lg { padding: 14px 28px; font-size: 15px; }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            justify-content: center;
            border-radius: var(--radius-md);
        }

        /* ============================================
           FORMS
        ============================================ */
        .form-group { 
            margin-bottom: 20px; 
        }

        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            font-size: 13px; 
            color: var(--gray-700); 
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            font-family: inherit;
            font-size: 14px;
            transition: all var(--transition-fast);
            background: white;
            color: var(--gray-800);
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--secondary-600);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

        input::placeholder, textarea::placeholder {
            color: var(--gray-400);
        }

        /* Status Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .badge-warning {
            background: #fffbeb;
            color: #92400e;
        }

        .badge-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        .badge-info {
            background: #eff6ff;
            color: #1e40af;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .badge-success .badge-dot { background: #10b981; }
        .badge-warning .badge-dot { background: #F1B434; }
        .badge-danger .badge-dot { background: #ef4444; }
        .badge-info .badge-dot { background: #3b82f6; }

        /* ============================================
           EMPTY STATE
        ============================================ */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: var(--gray-100);
            border-radius: var(--radius-2xl);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: var(--gray-400);
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--gray-500);
            font-size: 14px;
        }

        /* ============================================
           RESPONSIVE
        ============================================ */
        @media (max-width: 1024px) {
            .sidebar { 
                width: var(--sidebar-collapsed); 
            }
            .sidebar-logo span, 
            .menu-item span,
            .menu-section-title,
            .user-info,
            .logout-btn span { 
                display: none; 
            }
            .main-content { 
                margin-left: var(--sidebar-collapsed); 
            }
            .menu-item {
                justify-content: center;
                padding: 16px;
            }
            .menu-item.active::before {
                display: none;
            }
            .sidebar-logo {
                justify-content: center;
            }
            .logout-btn {
                justify-content: center;
                padding: 16px;
            }
            .header {
                padding: 0 20px;
            }
            .content {
                padding: 20px;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .page-title h1 {
                font-size: 1.25rem;
            }
            .header-actions {
                gap: 8px;
            }
            .user-profile {
                padding: 6px;
            }
            .user-info {
                display: none;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <img src="{{ asset('assets/img/tanzalogo.jpg') }}" alt="Tanzalian" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <span>Tanzalian Admin</span>
            </a>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-section-title">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.bookings') }}" class="menu-item {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Bookings</span>
                    <span class="menu-badge">3</span>
                </a>
                <a href="{{ route('admin.packages') }}" class="menu-item {{ request()->routeIs('admin.packages') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Packages</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Content</div>
                <a href="{{ route('admin.gallery') }}" class="menu-item {{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
                <a href="{{ route('admin.team-members') }}" class="menu-item {{ request()->routeIs('admin.team-members*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i>
                    <span>Team Members</span>
                </a>
                <a href="{{ route('admin.pages') }}" class="menu-item {{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Pages</span>
                </a>
                <a href="{{ route('admin.newsletter') }}" class="menu-item {{ request()->routeIs('admin.newsletter') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>Newsletter</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Settings</div>
                <a href="{{ route('admin.users') }}" class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.payment-settings') }}" class="menu-item {{ request()->routeIs('admin.payment-settings') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i>
                    <span>Payments</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="menu-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">External</div>
                <a href="{{ route('home') }}" class="menu-item" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Website</span>
                </a>
            </div>
        </div>
        
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="page-title">
                <h1>@yield('title')</h1>
                <p>{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div class="header-actions">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>
                <div class="user-profile">
                    <div class="avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="user-role">{{ auth()->user()->role ?? 'admin' }}</div>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 10px; color: var(--gray-400);"></i>
                </div>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 4px;">
                        @foreach($errors->all() as $error)
                            <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>

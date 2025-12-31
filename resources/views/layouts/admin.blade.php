<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Tanzalian Safari's</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #2c5530;
            --primary-light: #3d7542;
            --secondary: #d4a373;
            --accent: #ff6b35;
            --dark: #0f172a;
            --sidebar: #1e293b;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #334155;
            --text-light: #64748b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-logo {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 900;
            color: var(--secondary);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-menu {
            padding: 20px 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-item {
            padding: 12px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            font-size: 15px;
        }

        .menu-item:hover, .menu-item.active {
            color: white;
            background-color: rgba(255,255,255,0.05);
            border-left: 4px solid var(--secondary);
        }

        .menu-item i {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            margin-left: 280px;
            padding: 40px;
            width: calc(100% - 280px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .page-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: var(--dark);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 8px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            border: 1px solid var(--border);
        }

        .avatar {
            width: 35px;
            height: 35px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Cards */
        .card {
            background: var(--card);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.02);
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        /* Alerts */
        .alert {
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Tables */
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            padding: 15px;
            color: var(--text-light);
            font-weight: 600;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
        }
        td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            font-size: 15px;
        }
        tr:hover { background: #f8fafc; }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-light); }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }

        /* Forms */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px; color: var(--dark); }
        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 15px;
            transition: all 0.3s;
        }
        input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(44,85,48,0.1); }

        @media (max-width: 1024px) {
            .sidebar { width: 80px; }
            .sidebar-logo span, .menu-item span { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <i class="fas fa-mountain-sun"></i>
                <span>Tanzalian Admin</span>
            </a>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.gallery') }}" class="menu-item {{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span>Gallery</span>
            </a>
            <a href="{{ route('admin.pages') }}" class="menu-item {{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Pages</span>
            </a>
            <a href="{{ route('admin.packages') }}" class="menu-item {{ request()->routeIs('admin.packages') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span>Packages</span>
            </a>
            <a href="{{ route('admin.bookings') }}" class="menu-item {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Bookings</span>
            </a>
            <a href="{{ route('admin.payment-settings') }}" class="menu-item {{ request()->routeIs('admin.payment-settings') ? 'active' : '' }}">
                <i class="fas fa-credit-card"></i>
                <span>Payment Settings</span>
            </a>
            <a href="{{ route('home') }}" class="menu-item" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>View Website</span>
            </a>
        </div>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="menu-item" style="background:none; border:none; width:100%; cursor:pointer;">
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
            </div>
            <div class="user-profile">
                <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="user-info">
                    <div style="font-weight: 700; font-size: 14px;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 12px; color: var(--text-light);">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
            </div>
        </div>

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
                <ul style="list-style: none;">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>

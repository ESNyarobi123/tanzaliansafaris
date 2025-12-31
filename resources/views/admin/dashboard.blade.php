@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }
    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.02);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .stat-info h3 {
        font-size: 28px;
        color: var(--dark);
        margin-bottom: 5px;
    }
    .stat-info p {
        color: var(--text-light);
        font-size: 14px;
        font-weight: 500;
    }
    .bg-blue { background: #eff6ff; color: #3b82f6; }
    .bg-green { background: #f0fdf4; color: #22c55e; }
    .bg-purple { background: #faf5ff; color: #a855f7; }
    .bg-orange { background: #fff7ed; color: #f97316; }

    .recent-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }
</style>
@endsection

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-blue">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_users'] }}</h3>
            <p>Total Users</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-green">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_bookings'] }}</h3>
            <p>Total Bookings</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-purple">
            <i class="fas fa-images"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['active_gallery'] }}</h3>
            <p>Active Gallery</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-orange">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['pending_bookings'] }}</h3>
            <p>Pending Bookings</p>
        </div>
    </div>
</div>

<div class="recent-grid">
    <div class="card">
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">Quick Actions</h2>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
            <a href="{{ route('admin.gallery') }}" class="btn btn-primary" style="justify-content: center; padding: 20px;">
                <i class="fas fa-plus-circle"></i> Add Gallery Image
            </a>
            <a href="{{ route('admin.packages') }}" class="btn btn-primary" style="justify-content: center; padding: 20px; background: var(--secondary);">
                <i class="fas fa-plus-circle"></i> Create New Package
            </a>
            <a href="{{ route('admin.pages.edit', 'home') }}" class="btn btn-primary" style="justify-content: center; padding: 20px; background: var(--dark);">
                <i class="fas fa-edit"></i> Edit Home Content
            </a>
            <a href="{{ route('admin.bookings') }}" class="btn btn-primary" style="justify-content: center; padding: 20px; background: var(--accent);">
                <i class="fas fa-list"></i> Manage Bookings
            </a>
        </div>
    </div>
    
    <div class="card">
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">System Info</h2>
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid var(--border);">
                <span style="color: var(--text-light);">Laravel Version</span>
                <span style="font-weight: 600;">{{ app()->version() }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid var(--border);">
                <span style="color: var(--text-light);">PHP Version</span>
                <span style="font-weight: 600;">{{ PHP_VERSION }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid var(--border);">
                <span style="color: var(--text-light);">Admins</span>
                <span style="font-weight: 600;">{{ $stats['total_admins'] }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: var(--text-light);">Super Admins</span>
                <span style="font-weight: 600;">{{ $stats['total_supers'] }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

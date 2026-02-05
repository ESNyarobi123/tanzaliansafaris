@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<style>
    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 50%, #1a3a25 100%);
        border-radius: var(--radius-2xl);
        padding: 32px 40px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 32px;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(241, 180, 52, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .welcome-text h2 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .welcome-text p {
        font-size: 15px;
        opacity: 0.9;
        max-width: 500px;
    }

    .welcome-actions {
        display: flex;
        gap: 12px;
    }

    .welcome-btn {
        padding: 12px 24px;
        border-radius: var(--radius-lg);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .welcome-btn-primary {
        background: var(--accent-500);
        color: var(--gray-900);
    }

    .welcome-btn-primary:hover {
        background: var(--accent-400);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(241, 180, 52, 0.3);
    }

    .welcome-btn-secondary {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .welcome-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    /* Stats Grid - Enhanced */
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
        position: relative;
        overflow: hidden;
        border: 1px solid var(--gray-100);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--stat-gradient);
    }

    .stat-card.blue { --stat-gradient: linear-gradient(90deg, #3b82f6, #60a5fa); }
    .stat-card.green { --stat-gradient: linear-gradient(90deg, #10b981, #34d399); }
    .stat-card.purple { --stat-gradient: linear-gradient(90deg, #8b5cf6, #a78bfa); }
    .stat-card.orange { --stat-gradient: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .stat-card.rose { --stat-gradient: linear-gradient(90deg, #f43f5e, #fb7185); }
    .stat-card.teal { --stat-gradient: linear-gradient(90deg, #14b8a6, #2dd4bf); }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stat-card.blue .stat-icon { background: #eff6ff; color: #3b82f6; }
    .stat-card.green .stat-icon { background: #ecfdf5; color: #10b981; }
    .stat-card.purple .stat-icon { background: #f5f3ff; color: #8b5cf6; }
    .stat-card.orange .stat-icon { background: #fffbeb; color: #f59e0b; }
    .stat-card.rose .stat-icon { background: #fff1f2; color: #f43f5e; }
    .stat-card.teal .stat-icon { background: #f0fdfa; color: #14b8a6; }

    .stat-trend {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: var(--radius-full);
    }

    .stat-trend.up {
        background: #ecfdf5;
        color: #059669;
    }

    .stat-trend.down {
        background: #fef2f2;
        color: #dc2626;
    }

    .stat-value {
        font-size: 36px;
        font-weight: 800;
        color: var(--gray-900);
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 14px;
        color: var(--gray-500);
        font-weight: 500;
    }

    .stat-footer {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--gray-100);
        font-size: 13px;
        color: var(--gray-500);
    }

    .stat-footer a {
        color: var(--primary-600);
        text-decoration: none;
        font-weight: 600;
    }

    .stat-footer a:hover {
        text-decoration: underline;
    }

    /* Main Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    /* Quick Actions Card */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .quick-action-card {
        background: var(--gray-50);
        border-radius: var(--radius-xl);
        padding: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1px solid transparent;
    }

    .quick-action-card:hover {
        background: white;
        border-color: var(--gray-200);
        transform: translateX(4px);
        box-shadow: var(--shadow-md);
    }

    .quick-action-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .quick-action-card:nth-child(1) .quick-action-icon { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .quick-action-card:nth-child(2) .quick-action-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }
    .quick-action-card:nth-child(3) .quick-action-icon { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .quick-action-card:nth-child(4) .quick-action-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
    .quick-action-card:nth-child(5) .quick-action-icon { background: linear-gradient(135deg, #ec4899, #db2777); color: white; }
    .quick-action-card:nth-child(6) .quick-action-icon { background: linear-gradient(135deg, #14b8a6, #0d9488); color: white; }

    .quick-action-content h4 {
        font-size: 15px;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 2px;
    }

    .quick-action-content p {
        font-size: 13px;
        color: var(--gray-500);
    }

    /* Activity Card */
    .activity-list {
        display: flex;
        flex-direction: column;
    }

    .activity-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .activity-icon.booking { background: #ecfdf5; color: #10b981; }
    .activity-icon.user { background: #eff6ff; color: #3b82f6; }
    .activity-icon.gallery { background: #f5f3ff; color: #8b5cf6; }

    .activity-content {
        flex: 1;
    }

    .activity-content p {
        font-size: 14px;
        color: var(--gray-700);
        margin-bottom: 4px;
    }

    .activity-content p strong {
        color: var(--gray-900);
    }

    .activity-time {
        font-size: 12px;
        color: var(--gray-400);
    }

    /* System Info */
    .system-info-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .system-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
    }

    .system-info-item span:first-child {
        font-size: 14px;
        color: var(--gray-600);
    }

    .system-info-item span:last-child {
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-800);
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .welcome-content {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
        .quick-actions-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="welcome-content">
        <div class="welcome-text">
            <h2>Welcome back, {{ auth()->user()->name ?? 'Admin' }}! 👋</h2>
            <p>Here's what's happening with your safari business today. Manage bookings, update content, and grow your business.</p>
        </div>
        <div class="welcome-actions">
            <a href="{{ route('admin.hero-images') }}" class="welcome-btn welcome-btn-primary">
                <i class="fas fa-panorama"></i> Manage Hero Slider
            </a>
            <a href="{{ route('home') }}" target="_blank" class="welcome-btn welcome-btn-secondary">
                <i class="fas fa-external-link-alt"></i> View Website
            </a>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 12%</span>
        </div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-label">Total Users</div>
        <div class="stat-footer">
            <a href="{{ route('admin.users') }}">View all users →</a>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 8%</span>
        </div>
        <div class="stat-value">{{ $stats['total_bookings'] }}</div>
        <div class="stat-label">Total Bookings</div>
        <div class="stat-footer">
            <a href="{{ route('admin.bookings') }}">Manage bookings →</a>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-images"></i>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_gallery'] }}</div>
        <div class="stat-label">Gallery Images</div>
        <div class="stat-footer">
            <a href="{{ route('admin.gallery') }}">Manage gallery →</a>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-header">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            @if($stats['pending_bookings'] > 0)
                <span class="stat-trend down"><i class="fas fa-exclamation"></i> Action needed</span>
            @endif
        </div>
        <div class="stat-value">{{ $stats['pending_bookings'] }}</div>
        <div class="stat-label">Pending Bookings</div>
        <div class="stat-footer">
            <a href="{{ route('admin.bookings') }}">Review pending →</a>
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="dashboard-grid">
    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Quick Actions</h2>
            <span style="font-size: 13px; color: var(--gray-500);">Manage your content</span>
        </div>
        <div class="quick-actions-grid">
            <a href="{{ route('admin.hero-images') }}" class="quick-action-card">
                <div class="quick-action-icon">
                    <i class="fas fa-panorama"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Hero Slider</h4>
                    <p>Manage homepage images</p>
                </div>
            </a>
            <a href="{{ route('admin.packages') }}" class="quick-action-card">
                <div class="quick-action-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Safari Packages</h4>
                    <p>Add or edit packages</p>
                </div>
            </a>
            <a href="{{ route('admin.gallery') }}" class="quick-action-card">
                <div class="quick-action-icon">
                    <i class="fas fa-images"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Photo Gallery</h4>
                    <p>Upload new photos</p>
                </div>
            </a>
            <a href="{{ route('admin.team-members') }}" class="quick-action-card">
                <div class="quick-action-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Team Members</h4>
                    <p>Manage your guides</p>
                </div>
            </a>
            <a href="{{ route('admin.pages.edit', 'home') }}" class="quick-action-card">
                <div class="quick-action-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Page Content</h4>
                    <p>Edit website text</p>
                </div>
            </a>
            <a href="{{ route('admin.newsletter') }}" class="quick-action-card">
                <div class="quick-action-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="quick-action-content">
                    <h4>Newsletter</h4>
                    <p>Send announcements</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Right Column -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <!-- System Info -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">System Info</h2>
            </div>
            <div class="system-info-list">
                <div class="system-info-item">
                    <span><i class="fab fa-laravel" style="color: #ff2d20; margin-right: 8px;"></i> Laravel</span>
                    <span>{{ app()->version() }}</span>
                </div>
                <div class="system-info-item">
                    <span><i class="fab fa-php" style="color: #777bb4; margin-right: 8px;"></i> PHP</span>
                    <span>{{ PHP_VERSION }}</span>
                </div>
                <div class="system-info-item">
                    <span><i class="fas fa-user-shield" style="color: var(--primary-600); margin-right: 8px;"></i> Admins</span>
                    <span>{{ $stats['total_admins'] }}</span>
                </div>
                <div class="system-info-item">
                    <span><i class="fas fa-crown" style="color: var(--accent-500); margin-right: 8px;"></i> Super Admins</span>
                    <span>{{ $stats['total_supers'] }}</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Recent Activity</h2>
            </div>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon booking">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="activity-content">
                        <p>New booking received</p>
                        <span class="activity-time">Just now</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon user">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <p>New user registered</p>
                        <span class="activity-time">2 hours ago</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon gallery">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="activity-content">
                        <p>Gallery updated</p>
                        <span class="activity-time">Yesterday</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

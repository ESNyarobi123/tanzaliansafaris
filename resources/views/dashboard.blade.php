@extends('layouts.app')

@section('title', 'User Dashboard - Tanzalian Safari\'s')

@section('styles')
<style>
    :root {
        --dashboard-bg: #f0f2f5;
        --card-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.3);
        --primary-gradient: linear-gradient(135deg, #d4a373 0%, #a67c52 100%);
        --secondary-gradient: linear-gradient(135deg, #2c5530 0%, #1a331d 100%);
    }

    body {
        background-color: var(--dashboard-bg);
    }

    .dashboard-wrapper {
        padding: 50px 0;
        min-height: 80vh;
        background: linear-gradient(180deg, #f0f2f5 0%, #ffffff 100%);
    }

    .dashboard-wrapper .container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }

    .welcome-banner {
        background: var(--secondary-gradient);
        border-radius: 28px;
        padding: 50px 45px;
        color: white;
        margin-bottom: 45px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(44, 85, 48, 0.25);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -5%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(212,163,115,0.15), transparent 70%);
        border-radius: 50%;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .welcome-banner h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
        font-weight: 900;
    }
    
    .welcome-banner p {
        font-size: clamp(15px, 1.8vw, 18px);
        opacity: 0.95;
        line-height: 1.7;
        position: relative;
        z-index: 1;
        max-width: 700px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 50px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 22px;
        padding: 28px;
        display: flex;
        align-items: center;
        gap: 22px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        transform: scaleX(0);
        transition: transform 0.4s;
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        border-color: var(--primary-color);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        transition: all 0.3s;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 30px rgba(0,0,0,0.2);
    }

    .icon-bookings { background: var(--primary-gradient); }
    .icon-pending { background: linear-gradient(135deg, #F1B434, #d99a1e); }
    .icon-confirmed { background: linear-gradient(135deg, #10b981, #059669); }
    .icon-spent { background: linear-gradient(135deg, #3b82f6, #2563eb); }

    .stat-info {
        flex: 1;
        min-width: 0;
    }
    
    .stat-info h3 {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        font-weight: 600;
    }

    .stat-info .value {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
        font-family: 'Playfair Display', serif;
        line-height: 1.2;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .content-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 26px;
        padding: 35px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .content-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .content-card:hover::before {
        opacity: 1;
    }
    
    .content-card:hover {
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        transform: translateY(-3px);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f1f5f9;
    }

    .card-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(20px, 2.5vw, 26px);
        color: #1e293b;
        font-weight: 900;
        margin: 0;
    }

    .booking-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .booking-table thead {
        background: #f8fafc;
        border-radius: 12px;
    }

    .booking-table th {
        text-align: left;
        padding: 18px 16px;
        color: #475569;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .booking-table th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
        padding-left: 20px;
    }
    
    .booking-table th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
        padding-right: 20px;
    }

    .booking-table tbody tr {
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .booking-table tbody tr:hover {
        transform: translateX(5px);
    }

    .booking-table td {
        padding: 22px 16px;
        background: #fff;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    
    .booking-table td:first-child {
        border-left: 1px solid #f1f5f9;
        border-top-left-radius: 14px;
        border-bottom-left-radius: 14px;
        padding-left: 20px;
        font-weight: 600;
        color: var(--secondary-color);
        font-family: 'Playfair Display', serif;
    }

    .booking-table td:last-child {
        border-right: 1px solid #f1f5f9;
        border-top-right-radius: 14px;
        border-bottom-right-radius: 14px;
        padding-right: 20px;
    }
    
    .booking-table tbody tr:hover td {
        background: #f8fafc;
        border-color: var(--primary-color);
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }
    
    .status-badge:hover {
        transform: scale(1.05);
    }

    .status-pending { 
        background: linear-gradient(135deg, #fef3c7, #fde68a); 
        color: #d97706;
        border: 1px solid #F1B434;
    }
    .status-confirmed { 
        background: linear-gradient(135deg, #d1fae5, #a7f3d0); 
        color: #059669;
        border: 1px solid #10b981;
    }
    .status-cancelled { 
        background: linear-gradient(135deg, #fee2e2, #fecaca); 
        color: #dc2626;
        border: 1px solid #ef4444;
    }

    .chart-container {
        height: 320px;
        position: relative;
        background: #f8fafc;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
    }
    
    .quick-actions-section {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 2px solid #f1f5f9;
    }
    
    .quick-actions-title {
        font-size: 17px;
        margin-bottom: 18px;
        color: #1e293b;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .quick-actions-title i {
        color: var(--primary-color);
        font-size: 20px;
    }
    
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .quick-action-btn {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 15px;
        padding: 14px 18px;
        text-decoration: none;
        color: #475569;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s;
        text-align: center;
    }
    
    .quick-action-btn:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(212, 163, 115, 0.3);
    }
    
    .quick-action-btn i {
        font-size: 18px;
    }

    .empty-bookings {
        text-align: center;
        padding: 60px 30px;
        color: #64748b;
    }
    
    .empty-bookings i {
        font-size: 64px;
        margin-bottom: 20px;
        display: block;
        color: #cbd5e1;
    }
    
    .empty-bookings p {
        font-size: 16px;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    .empty-bookings .cta-button {
        display: inline-block;
        margin-top: 10px;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }
        
        .content-card {
            padding: 28px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-wrapper {
            padding: 30px 0;
        }
        
        .welcome-banner {
            padding: 35px 25px;
        }
        .welcome-banner h1 {
            font-size: clamp(24px, 5vw, 32px);
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .stat-card {
            padding: 20px;
            gap: 15px;
        }
        
        .stat-icon {
            width: 55px;
            height: 55px;
            font-size: 22px;
        }
        
        .stat-info .value {
            font-size: 22px;
        }
        
        .booking-table {
            font-size: 13px;
        }
        
        .booking-table th,
        .booking-table td {
            padding: 12px 10px;
        }
        
        .chart-container {
            height: 250px;
            padding: 15px;
        }
        
        .quick-actions-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .booking-table {
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    <div class="container">
        <!-- Welcome Banner -->
        <div class="welcome-banner" data-aos="fade-up">
            <h1>Karibu Tena, {{ $user->name }}!</h1>
            <p>Welcome back to your adventure hub. Here's what's happening with your safari plans.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon icon-bookings">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Bookings</h3>
                    <div class="value">{{ $stats['total_bookings'] }}</div>
                </div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon icon-pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3>Pending</h3>
                    <div class="value">{{ $stats['pending_bookings'] }}</div>
                </div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon icon-confirmed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>Confirmed</h3>
                    <div class="value">{{ $stats['confirmed_bookings'] }}</div>
                </div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-icon icon-spent">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Spent</h3>
                    <div class="value">${{ number_format($stats['total_spent'], 2) }}</div>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <!-- Recent Bookings -->
            <div class="content-card" data-aos="fade-right">
                <div class="card-header">
                    <h2><i class="fas fa-calendar-alt" style="color: var(--primary-color); margin-right: 10px; font-size: 24px;"></i>Recent Bookings</h2>
                    <a href="{{ route('booking') }}" class="cta-button" style="padding: 10px 24px; font-size: 13px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-plus"></i> New Booking
                    </a>
                </div>
                <div style="overflow-x: auto;">
                    <table class="booking-table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Package</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr>
                                <td><strong>#{{ $booking->reference }}</strong></td>
                                <td>{{ $booking->package ? $booking->package->name : 'Custom Safari' }}</td>
                                <td>{{ date('M d, Y', strtotime($booking->start_date)) }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($booking->status) }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="auth-btn" style="padding: 8px 18px; display: inline-flex; align-items: center; gap: 6px; font-size: 13px; border-radius: 8px;">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="empty-bookings">
                                    <i class="fas fa-calendar-plus"></i>
                                    <p>No bookings found yet. Start your adventure today!</p>
                                    <a href="{{ route('booking') }}" class="cta-button" style="display: inline-flex; align-items: center; gap: 10px;">
                                        <i class="fas fa-plus-circle"></i> Create New Booking
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Trends Analysis -->
            <div class="content-card" data-aos="fade-left">
                <div class="card-header">
                    <h2><i class="fas fa-chart-area" style="color: var(--primary-color); margin-right: 10px; font-size: 24px;"></i>Booking Trends</h2>
                </div>
                <div class="chart-container">
                    <canvas id="trendsChart"></canvas>
                </div>
                <div style="margin-top: 25px; padding: 20px; background: #f8fafc; border-radius: 15px; border-left: 4px solid var(--primary-color);">
                    <p style="font-size: 15px; color: #475569; line-height: 1.7; margin: 0;">
                        <i class="fas fa-chart-line" style="color: var(--primary-color); margin-right: 10px;"></i>
                        Your booking activity has increased by <strong style="color: var(--secondary-color);">15%</strong> compared to last month.
                    </p>
                </div>

                <div class="quick-actions-section">
                    <h3 class="quick-actions-title">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h3>
                    <div class="quick-actions-grid">
                        <a href="{{ route('packages') }}" class="quick-action-btn">
                            <i class="fas fa-search"></i> 
                            <span>Explore Packages</span>
                        </a>
                        <a href="{{ route('gallery') }}" class="quick-action-btn">
                            <i class="fas fa-images"></i> 
                            <span>View Gallery</span>
                        </a>
                        <a href="{{ route('booking') }}" class="quick-action-btn" style="grid-column: 1 / -1; background: var(--accent-color); color: #fff; border-color: var(--accent-color);">
                            <i class="fas fa-calendar-check"></i> 
                            <span>New Booking</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('trendsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Bookings',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#d4a373',
                backgroundColor: 'rgba(212, 163, 115, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#d4a373',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection

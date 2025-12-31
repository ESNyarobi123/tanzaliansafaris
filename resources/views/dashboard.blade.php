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
        padding: 40px 0;
        min-height: 80vh;
    }

    .welcome-banner {
        background: var(--secondary-gradient);
        border-radius: 24px;
        padding: 40px;
        color: white;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(44, 85, 48, 0.2);
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
        font-size: 32px;
        margin-bottom: 10px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .icon-bookings { background: var(--primary-gradient); }
    .icon-pending { background: #f59e0b; }
    .icon-confirmed { background: #10b981; }
    .icon-spent { background: #3b82f6; }

    .stat-info h3 {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-info .value {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .content-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .card-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        color: #1e293b;
    }

    .booking-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .booking-table th {
        text-align: left;
        padding: 15px;
        color: #64748b;
        font-weight: 600;
        font-size: 14px;
    }

    .booking-table tr {
        transition: transform 0.2s;
    }

    .booking-table td {
        padding: 20px 15px;
        background: white;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
    }

    .booking-table td:first-child {
        border-left: 1px solid #f1f5f9;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .booking-table td:last-child {
        border-right: 1px solid #f1f5f9;
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending { background: #fef3c7; color: #d97706; }
    .status-confirmed { background: #d1fae5; color: #059669; }
    .status-cancelled { background: #fee2e2; color: #dc2626; }

    .chart-container {
        height: 300px;
        position: relative;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .welcome-banner {
            padding: 30px;
        }
        .welcome-banner h1 {
            font-size: 24px;
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
                    <h2>Recent Bookings</h2>
                    <a href="{{ route('booking') }}" class="cta-button" style="padding: 8px 20px; font-size: 12px;">New Booking</a>
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
                                    <button class="auth-btn" style="padding: 5px 15px;">Details</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">
                                    <i class="fas fa-folder-open" style="font-size: 40px; margin-bottom: 15px; display: block;"></i>
                                    No bookings found. Start your adventure today!
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
                    <h2>Booking Trends</h2>
                </div>
                <div class="chart-container">
                    <canvas id="trendsChart"></canvas>
                </div>
                <div style="margin-top: 20px;">
                    <p style="font-size: 14px; color: #64748b; line-height: 1.6;">
                        Your booking activity has increased by <strong>15%</strong> compared to last month.
                    </p>
                </div>

                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                    <h3 style="font-size: 16px; margin-bottom: 15px;">Quick Actions</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <a href="{{ route('packages') }}" class="auth-btn" style="justify-content: center; gap: 8px;">
                            <i class="fas fa-search"></i> Explore
                        </a>
                        <a href="{{ route('gallery') }}" class="auth-btn" style="justify-content: center; gap: 8px;">
                            <i class="fas fa-images"></i> Gallery
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

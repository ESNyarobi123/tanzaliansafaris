@extends('layouts.app')

@section('title', ($package->name ?? 'Safari Package') . ' - Detailed Itinerary | Tanzalian Safari\'s')

@section('styles')
<style>
    /* ============================================
       PACKAGE DETAIL PAGE WITH ITINERARY
    ============================================ */
    
    /* Hero Section */
    .pkg-detail-hero {
        position: relative;
        height: 70vh;
        min-height: 500px;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
    }

    .pkg-detail-hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .pkg-detail-hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pkg-detail-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, 
            rgba(15, 23, 42, 0.95) 0%, 
            rgba(15, 23, 42, 0.5) 50%, 
            rgba(15, 23, 42, 0.3) 100%);
        z-index: 1;
    }

    .pkg-detail-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 60px 0;
        color: white;
    }

    .pkg-detail-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: var(--gray-400);
        margin-bottom: 20px;
    }

    .pkg-detail-breadcrumb a {
        color: var(--accent-400);
        text-decoration: none;
    }

    .pkg-detail-breadcrumb a:hover {
        text-decoration: underline;
    }

    .pkg-detail-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        margin-bottom: 20px;
        max-width: 800px;
    }

    .pkg-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        margin-bottom: 30px;
    }

    .pkg-detail-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pkg-detail-meta-icon {
        width: 44px;
        height: 44px;
        background: rgba(255,255,255,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--accent-400);
    }

    .pkg-detail-meta-label {
        font-size: 12px;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .pkg-detail-meta-value {
        font-size: 16px;
        font-weight: 600;
    }

    .pkg-detail-price-box {
        display: inline-flex;
        align-items: center;
        gap: 20px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 20px 30px;
        border-radius: 20px;
    }

    .pkg-detail-price {
        display: flex;
        flex-direction: column;
    }

    .pkg-detail-price-label {
        font-size: 12px;
        color: var(--gray-400);
    }

    .pkg-detail-price-value {
        font-family: var(--font-display);
        font-size: 32px;
        color: var(--accent-400);
    }

    /* Sticky Navigation */
    .pkg-sticky-nav {
        position: sticky;
        top: 80px;
        background: white;
        border-bottom: 1px solid var(--gray-200);
        z-index: 100;
        padding: 15px 0;
    }

    .pkg-sticky-nav-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .pkg-nav-links {
        display: flex;
        gap: 30px;
    }

    .pkg-nav-link {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
        text-decoration: none;
        padding: 8px 0;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .pkg-nav-link:hover,
    .pkg-nav-link.active {
        color: var(--primary-600);
        border-bottom-color: var(--primary-600);
    }

    .pkg-nav-cta {
        display: flex;
        gap: 10px;
    }

    /* Main Content Grid */
    .pkg-detail-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 40px;
        padding: 60px 0;
    }

    /* Left Content */
    .pkg-detail-main {
        display: flex;
        flex-direction: column;
        gap: 60px;
    }

    .pkg-section {
        scroll-margin-top: 140px;
    }

    .pkg-section-title {
        font-size: 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pkg-section-title i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-100), var(--primary-200));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--primary-600);
    }

    /* Overview */
    .pkg-overview-text {
        font-size: 16px;
        line-height: 1.8;
        color: var(--text-secondary);
    }

    .pkg-highlights {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 30px;
    }

    .pkg-highlight-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: var(--gray-50);
        border-radius: 12px;
    }

    .pkg-highlight-icon {
        width: 36px;
        height: 36px;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: var(--primary-600);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    /* Itinerary Timeline */
    .itinerary-timeline {
        position: relative;
        padding-left: 40px;
    }

    .itinerary-timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--primary-300), var(--primary-600));
        border-radius: 2px;
    }

    .itinerary-day {
        position: relative;
        margin-bottom: 40px;
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .itinerary-day:hover {
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-300);
    }

    .itinerary-day::before {
        content: attr(data-day);
        position: absolute;
        left: -40px;
        top: 20px;
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: white;
        border: 3px solid white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .itinerary-day-header {
        background: linear-gradient(135deg, var(--gray-50), white);
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
    }

    .itinerary-day-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .itinerary-day-route {
        font-size: 14px;
        color: var(--text-muted);
    }

    .itinerary-day-content {
        padding: 24px;
    }

    .itinerary-activities {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .itinerary-activity {
        display: flex;
        gap: 16px;
    }

    .itinerary-time {
        width: 70px;
        flex-shrink: 0;
        font-size: 13px;
        font-weight: 600;
        color: var(--primary-600);
        padding-top: 2px;
    }

    .itinerary-activity-content h4 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-primary);
    }

    .itinerary-activity-content p {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    .itinerary-day-footer {
        display: flex;
        gap: 24px;
        padding-top: 20px;
        margin-top: 20px;
        border-top: 1px solid var(--gray-100);
    }

    .itinerary-info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-secondary);
    }

    .itinerary-info-item i {
        color: var(--primary-500);
    }

    /* Inclusions/Exclusions */
    .inclusions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }

    .inclusion-box {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 20px;
        padding: 24px;
    }

    .inclusion-box.included {
        border-top: 4px solid var(--success);
    }

    .inclusion-box.excluded {
        border-top: 4px solid var(--error);
    }

    .inclusion-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .inclusion-box.included .inclusion-title {
        color: var(--success);
    }

    .inclusion-box.excluded .inclusion-title {
        color: var(--error);
    }

    .inclusion-list {
        list-style: none;
    }

    .inclusion-list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid var(--gray-100);
        font-size: 14px;
        color: var(--text-secondary);
    }

    .inclusion-list li:last-child {
        border-bottom: none;
    }

    .inclusion-list i {
        margin-top: 2px;
    }

    .inclusion-box.included .inclusion-list i {
        color: var(--success);
    }

    .inclusion-box.excluded .inclusion-list i {
        color: var(--error);
    }

    /* Sidebar */
    .pkg-detail-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .sidebar-card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 20px;
        padding: 24px;
        position: sticky;
        top: 160px;
    }

    .sidebar-card-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .price-breakdown {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 20px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
    }

    .price-row.label {
        color: var(--text-secondary);
    }

    .price-row.total {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        padding-top: 12px;
        border-top: 1px solid var(--gray-200);
    }

    .sidebar-cta {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn-sidebar-primary {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-sidebar-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(196, 81, 47, 0.3);
    }

    .btn-sidebar-secondary {
        width: 100%;
        padding: 14px;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-sidebar-secondary:hover {
        background: #128C7E;
    }

    /* Need to Know */
    .need-to-know-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .need-to-know-item {
        display: flex;
        gap: 12px;
    }

    .need-to-know-icon {
        width: 32px;
        height: 32px;
        background: var(--gray-100);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: var(--primary-600);
        flex-shrink: 0;
    }

    .need-to-know-content h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .need-to-know-content p {
        font-size: 13px;
        color: var(--text-secondary);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .pkg-detail-grid {
            grid-template-columns: 1fr;
        }
        .pkg-detail-sidebar {
            order: -1;
        }
        .sidebar-card {
            position: relative;
            top: 0;
        }
        .pkg-sticky-nav {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .pkg-detail-meta {
            gap: 20px;
        }
        .pkg-highlights {
            grid-template-columns: 1fr;
        }
        .inclusions-grid {
            grid-template-columns: 1fr;
        }
        .itinerary-timeline {
            padding-left: 30px;
        }
        .itinerary-day::before {
            left: -30px;
            width: 24px;
            height: 24px;
            font-size: 10px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="pkg-detail-hero">
    <div class="pkg-detail-hero-bg">
        <img src="{{ $package->image_path ?? 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80' }}" alt="{{ $package->name }}">
    </div>
    <div class="pkg-detail-hero-overlay"></div>
    <div class="pkg-detail-hero-content">
        <div class="container">
            <div class="pkg-detail-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                <a href="{{ route('packages') }}">Packages</a>
                <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                <span>{{ $package->name ?? 'Safari Package' }}</span>
            </div>
            
            <h1 class="pkg-detail-title">{{ $package->name ?? 'Classic Serengeti Safari' }}</h1>
            
            <div class="pkg-detail-meta">
                <div class="pkg-detail-meta-item">
                    <div class="pkg-detail-meta-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <div class="pkg-detail-meta-label">Duration</div>
                        <div class="pkg-detail-meta-value">{{ $package->duration_label ?? '5 Days / 4 Nights' }}</div>
                    </div>
                </div>
                
                <div class="pkg-detail-meta-item">
                    <div class="pkg-detail-meta-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <div class="pkg-detail-meta-label">Destinations</div>
                        <div class="pkg-detail-meta-value">Serengeti, Ngorongoro</div>
                    </div>
                </div>
                
                <div class="pkg-detail-meta-item">
                    <div class="pkg-detail-meta-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="pkg-detail-meta-label">Group Size</div>
                        <div class="pkg-detail-meta-value">2-6 People</div>
                    </div>
                </div>
                
                <div class="pkg-detail-meta-item">
                    <div class="pkg-detail-meta-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <div class="pkg-detail-meta-label">Rating</div>
                        <div class="pkg-detail-meta-value">4.9/5 (120 reviews)</div>
                    </div>
                </div>
            </div>
            
            <div class="pkg-detail-price-box">
                <div class="pkg-detail-price">
                    <span class="pkg-detail-price-label">From</span>
                    <span class="pkg-detail-price-value">${{ number_format($package->price_amount ?? 2450) }}</span>
                </div>
                <span style="color: var(--gray-400);">per person</span>
            </div>
        </div>
    </div>
</section>

<!-- Sticky Navigation -->
<div class="pkg-sticky-nav">
    <div class="container">
        <div class="pkg-sticky-nav-content">
            <div class="pkg-nav-links">
                <a href="#overview" class="pkg-nav-link active">Overview</a>
                <a href="#itinerary" class="pkg-nav-link">Itinerary</a>
                <a href="#inclusions" class="pkg-nav-link">What's Included</a>
                <a href="#need-to-know" class="pkg-nav-link">Need to Know</a>
            </div>
            <div class="pkg-nav-cta">
                <a href="{{ route('booking') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-calendar-check"></i> Book Now
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="pkg-detail-grid">
        <!-- Left Content -->
        <div class="pkg-detail-main">
            <!-- Overview Section -->
            <section id="overview" class="pkg-section">
                <h2 class="pkg-section-title">
                    <i class="fas fa-info-circle"></i>
                    Tour Overview
                </h2>
                <div class="pkg-overview-text">
                    <p>{{ $package->short_description ?? 'Experience the best of Tanzania\'s wildlife on this unforgettable safari adventure. Witness the Big Five in their natural habitat, explore the iconic Serengeti plains, and descend into the Ngorongoro Crater - a UNESCO World Heritage Site and one of the world\'s most spectacular natural wonders.' }}</p>
                    <p style="margin-top: 16px;">This carefully crafted itinerary combines game drives, cultural experiences, and comfortable accommodations to give you an authentic African safari experience. Our expert guides will ensure you don\'t miss any of the incredible wildlife sightings while sharing their deep knowledge of the local ecosystem.</p>
                </div>
                
                <div class="pkg-highlights">
                    <div class="pkg-highlight-item">
                        <div class="pkg-highlight-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <span>Big Five Safari</span>
                    </div>
                    <div class="pkg-highlight-item">
                        <div class="pkg-highlight-icon">
                            <i class="fas fa-binoculars"></i>
                        </div>
                        <span>Expert Guide</span>
                    </div>
                    <div class="pkg-highlight-item">
                        <div class="pkg-highlight-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <span>Photo Opportunities</span>
                    </div>
                    <div class="pkg-highlight-item">
                        <div class="pkg-highlight-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <span>All Meals Included</span>
                    </div>
                    <div class="pkg-highlight-item">
                        <div class="pkg-highlight-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <span>4x4 Safari Vehicle</span>
                    </div>
                    <div class="pkg-highlight-item">
                        <div class="pkg-highlight-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <span>Lodge Accommodation</span>
                    </div>
                </div>
            </section>

            <!-- Itinerary Section -->
            <section id="itinerary" class="pkg-section">
                <h2 class="pkg-section-title">
                    <i class="fas fa-route"></i>
                    Day-by-Day Itinerary
                </h2>
                
                <div class="itinerary-timeline">
                    <!-- Day 1 -->
                    <div class="itinerary-day" data-day="01">
                        <div class="itinerary-day-header">
                            <div class="itinerary-day-title">Arrival in Dar es salaam</div>
                            <div class="itinerary-day-route"><i class="fas fa-plane-arrival"></i> Kilimanjaro Airport → Dar es salaam</div>
                        </div>
                        <div class="itinerary-day-content">
                            <div class="itinerary-activities">
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">12:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Airport Pickup</h4>
                                        <p>Our representative will meet you at Kilimanjaro International Airport with a warm welcome. Transfer to your hotel in Dar es salaam in a comfortable private vehicle.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">2:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Safari Briefing</h4>
                                        <p>Meet your safari guide for a comprehensive briefing about your upcoming adventure. Review the itinerary, ask questions, and get to know your fellow travelers.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">Evening</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Relax at Lodge</h4>
                                        <p>Enjoy dinner at the lodge and rest after your journey. Take in the beautiful views of Mount Meru and prepare for the exciting days ahead.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-day-footer">
                                <div class="itinerary-info-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Dar es salaam Coffee Lodge (4★)</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>Dinner included</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-road"></i>
                                    <span>Transfer: 1 hour</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Day 2 -->
                    <div class="itinerary-day" data-day="02">
                        <div class="itinerary-day-header">
                            <div class="itinerary-day-title">Dar es salaam to Serengeti</div>
                            <div class="itinerary-day-route"><i class="fas fa-route"></i> Dar es salaam → Serengeti National Park</div>
                        </div>
                        <div class="itinerary-day-content">
                            <div class="itinerary-activities">
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">6:30 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Early Breakfast</h4>
                                        <p>Wake up to a delicious breakfast at the lodge. Meet your guide and prepare for the journey to Serengeti.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">7:30 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Scenic Drive to Serengeti</h4>
                                        <p>Begin your safari with a scenic drive through the Tanzanian countryside. Pass local villages, see Maasai herdsmen, and enjoy the changing landscapes.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">12:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Picnic Lunch</h4>
                                        <p>Stop for a packed lunch at a scenic spot with panoramic views of the Rift Valley.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">2:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Afternoon Game Drive</h4>
                                        <p>Enter Serengeti National Park and begin your first game drive. Look for lions, elephants, giraffes, and the countless wildebeest that make this park famous.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-day-footer">
                                <div class="itinerary-info-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Serengeti Serena Lodge (4★)</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>All meals included</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-road"></i>
                                    <span>Drive: 6 hours</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Day 3 -->
                    <div class="itinerary-day" data-day="03">
                        <div class="itinerary-day-header">
                            <div class="itinerary-day-title">Full Day in Serengeti</div>
                            <div class="itinerary-day-route"><i class="fas fa-binoculars"></i> Serengeti National Park</div>
                        </div>
                        <div class="itinerary-day-content">
                            <div class="itinerary-activities">
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">6:00 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Sunrise Game Drive</h4>
                                        <p>Experience the magic of an African sunrise on an early morning game drive. This is the best time to see predators in action as they hunt in the cool morning air.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">8:30 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Breakfast in the Bush</h4>
                                        <p>Enjoy a hot breakfast served in the heart of the Serengeti. Watch wildlife while you eat in this unforgettable setting.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">10:00 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Continue Game Viewing</h4>
                                        <p>Explore different areas of the park, searching for the Big Five. Your guide will share fascinating insights about animal behavior and the ecosystem.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">1:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Lunch & Rest</h4>
                                        <p>Return to the lodge for lunch and a midday rest. Use the pool or relax on your private veranda overlooking the savanna.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">4:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Afternoon Game Drive</h4>
                                        <p>Head out again as the heat subsides and animals become more active. Look for leopards lounging in acacia trees and cheetahs scanning the plains.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">Sunset</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Sundowner</h4>
                                        <p>Stop at a scenic viewpoint for sundowners - drinks and snacks while watching the African sunset paint the sky in brilliant colors.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-day-footer">
                                <div class="itinerary-info-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Serengeti Serena Lodge (4★)</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>All meals included</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Full day safari</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Day 4 -->
                    <div class="itinerary-day" data-day="04">
                        <div class="itinerary-day-header">
                            <div class="itinerary-day-title">Serengeti to Ngorongoro</div>
                            <div class="itinerary-day-route"><i class="fas fa-route"></i> Serengeti → Ngorongoro Crater</div>
                        </div>
                        <div class="itinerary-day-content">
                            <div class="itinerary-activities">
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">6:00 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Final Serengeti Game Drive</h4>
                                        <p>One last chance to spot wildlife in the Serengeti. Keep your eyes peeled for any animals you haven't seen yet.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">9:00 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Breakfast & Departure</h4>
                                        <p>Enjoy breakfast at the lodge before departing for Ngorongoro Conservation Area.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">12:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Olduvai Gorge Visit (Optional)</h4>
                                        <p>Stop at the famous archaeological site where early human fossils were discovered. Learn about human evolution at the museum (entrance fee not included).</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">2:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Crater Rim Arrival</h4>
                                        <p>Arrive at your lodge on the rim of Ngorongoro Crater. Marvel at the breathtaking views of the world's largest inactive volcanic caldera below.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-day-footer">
                                <div class="itinerary-info-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Ngorongoro Serena Lodge (4★)</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>All meals included</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-road"></i>
                                    <span>Drive: 4 hours</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Day 5 -->
                    <div class="itinerary-day" data-day="05">
                        <div class="itinerary-day-header">
                            <div class="itinerary-day-title">Ngorongoro Crater & Departure</div>
                            <div class="itinerary-day-route"><i class="fas fa-home"></i> Ngorongoro → Dar es salaam → Airport</div>
                        </div>
                        <div class="itinerary-day-content">
                            <div class="itinerary-activities">
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">6:00 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Descend into the Crater</h4>
                                        <p>After an early breakfast, descend 600 meters into Ngorongoro Crater for a spectacular game drive. This UNESCO World Heritage Site is home to over 25,000 large animals.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">8:00 AM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Crater Floor Safari</h4>
                                        <p>Explore the crater floor, searching for the endangered black rhino, large lion prides, and massive bull elephants. The crater offers the best chance to see the Big Five in one day.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">12:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Picnic Lunch by the Lake</h4>
                                        <p>Enjoy lunch near the hippo pool, watching these massive animals wallow in the water while hippos grunt and splash nearby.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">2:00 PM</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Ascend & Return to Dar es salaam</h4>
                                        <p>Begin the drive back to Dar es salaam with a stop at a local market for souvenir shopping if time permits.</p>
                                    </div>
                                </div>
                                <div class="itinerary-activity">
                                    <div class="itinerary-time">Evening</div>
                                    <div class="itinerary-activity-content">
                                        <h4>Airport Transfer</h4>
                                        <p>Transfer to Kilimanjaro International Airport for your departure flight, carrying memories that will last a lifetime.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-day-footer">
                                <div class="itinerary-info-item">
                                    <i class="fas fa-plane-departure"></i>
                                    <span>Departure</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>Breakfast & Lunch included</span>
                                </div>
                                <div class="itinerary-info-item">
                                    <i class="fas fa-road"></i>
                                    <span>Drive: 4 hours</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Inclusions Section -->
            <section id="inclusions" class="pkg-section">
                <h2 class="pkg-section-title">
                    <i class="fas fa-clipboard-list"></i>
                    What's Included & Excluded
                </h2>
                
                <div class="inclusions-grid">
                    <div class="inclusion-box included">
                        <div class="inclusion-title">
                            <i class="fas fa-check-circle"></i>
                            Included
                        </div>
                        <ul class="inclusion-list">
                            <li><i class="fas fa-check"></i> All park entrance fees (Serengeti & Ngorongoro)</li>
                            <li><i class="fas fa-check"></i> 4 nights accommodation (4-star lodges)</li>
                            <li><i class="fas fa-check"></i> All meals (breakfast, lunch, dinner)</li>
                            <li><i class="fas fa-check"></i> Professional English-speaking guide</li>
                            <li><i class="fas fa-check"></i> 4x4 safari vehicle with pop-up roof</li>
                            <li><i class="fas fa-check"></i> Airport transfers (pickup & drop-off)</li>
                            <li><i class="fas fa-check"></i> Unlimited game drives</li>
                            <li><i class="fas fa-check"></i> Drinking water during safari</li>
                            <li><i class="fas fa-check"></i> Government taxes & VAT</li>
                        </ul>
                    </div>
                    
                    <div class="inclusion-box excluded">
                        <div class="inclusion-title">
                            <i class="fas fa-times-circle"></i>
                            Not Included
                        </div>
                        <ul class="inclusion-list">
                            <li><i class="fas fa-times"></i> International flights</li>
                            <li><i class="fas fa-times"></i> Visa fees ($50-100 depending on nationality)</li>
                            <li><i class="fas fa-times"></i> Travel insurance (mandatory)</li>
                            <li><i class="fas fa-times"></i> Alcoholic beverages & soft drinks</li>
                            <li><i class="fas fa-times"></i> Tips for guide & lodge staff ($10-20/day recommended)</li>
                            <li><i class="fas fa-times"></i> Personal expenses (souvenirs, laundry)</li>
                            <li><i class="fas fa-times"></i> Optional activities (hot air balloon, Maasai village)</li>
                            <li><i class="fas fa-times"></i> Olduvai Gorge museum entrance ($30)</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Need to Know Section -->
            <section id="need-to-know" class="pkg-section">
                <h2 class="pkg-section-title">
                    <i class="fas fa-exclamation-circle"></i>
                    Important Information
                </h2>
                
                <div class="need-to-know-list">
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon">
                            <i class="fas fa-suitcase"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>What to Pack</h4>
                            <p>Light neutral-colored clothing, hat, sunscreen, binoculars, camera with zoom lens, comfortable walking shoes, warm jacket for mornings.</p>
                        </div>
                    </div>
                    
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon">
                            <i class="fas fa-syringe"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>Health Requirements</h4>
                            <p>Yellow fever vaccination required if arriving from endemic country. Malaria prophylaxis recommended. Consult your doctor before travel.</p>
                        </div>
                    </div>
                    
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon">
                            <i class="fas fa-cloud-sun"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>Best Time to Visit</h4>
                            <p>June to October (dry season) offers best wildlife viewing. Wildebeest migration typically in Serengeti June-July and October.</p>
                        </div>
                    </div>
                    
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>Cancellation Policy</h4>
                            <p>Free cancellation up to 30 days before departure. 50% refund for 15-30 days. No refund for less than 15 days. We recommend travel insurance.</p>
                        </div>
                    </div>
                    
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>Group Size</h4>
                            <p>Maximum 6 guests per vehicle for optimal comfort and viewing. Private safari available at supplement cost.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="pkg-detail-sidebar">
            <!-- Price Card -->
            <div class="sidebar-card">
                <h3 class="sidebar-card-title">Price Breakdown</h3>
                <div class="price-breakdown">
                    <div class="price-row">
                        <span>Base price per person</span>
                        <span>${{ number_format($package->price_amount ?? 2450) }}</span>
                    </div>
                    <div class="price-row">
                        <span>Park fees (5 days)</span>
                        <span>Included</span>
                    </div>
                    <div class="price-row">
                        <span>Accommodation (4 nights)</span>
                        <span>Included</span>
                    </div>
                    <div class="price-row">
                        <span>All meals</span>
                        <span>Included</span>
                    </div>
                    <div class="price-row total">
                        <span>Total per person</span>
                        <span>${{ number_format($package->price_amount ?? 2450) }}</span>
                    </div>
                </div>
                
                <div class="sidebar-cta">
                    <a href="{{ route('booking') }}" class="btn-sidebar-primary">
                        <i class="fas fa-calendar-check"></i>
                        Book This Safari
                    </a>
                    <a href="https://wa.me/255691111111?text={{ urlencode('Hi, I am interested in the ' . ($package->name ?? 'Safari Package')) }}" class="btn-sidebar-secondary" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Ask on WhatsApp
                    </a>
                </div>
                
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gray-200);">
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--text-secondary);">
                        <i class="fas fa-shield-alt" style="color: var(--success);"></i>
                        <span>Secure booking with SSL encryption</span>
                    </div>
                </div>
            </div>
            
            <!-- Why Book Card -->
            <div class="sidebar-card">
                <h3 class="sidebar-card-title">Why Book With Us?</h3>
                <div class="need-to-know-list">
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon" style="background: var(--success); color: white;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>Best Price Guarantee</h4>
                            <p>We match any comparable quote</p>
                        </div>
                    </div>
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon" style="background: var(--success); color: white;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>Expert Local Guides</h4>
                            <p>10+ years experience each</p>
                        </div>
                    </div>
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon" style="background: var(--success); color: white;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>24/7 Support</h4>
                            <p>Always here during your trip</p>
                        </div>
                    </div>
                    <div class="need-to-know-item">
                        <div class="need-to-know-icon" style="background: var(--success); color: white;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="need-to-know-content">
                            <h4>Flexible Booking</h4>
                            <p>Free cancellation up to 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Smooth scroll for navigation links
    document.querySelectorAll('.pkg-nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Update active nav link on scroll
    const sections = document.querySelectorAll('.pkg-section');
    const navLinks = document.querySelectorAll('.pkg-nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
</script>
@endsection

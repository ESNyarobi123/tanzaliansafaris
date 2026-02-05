@extends('layouts.app')

@section('title', 'Book Your Adventure - Tanzalian Safari\'s')

@section('styles')
    <!-- Select2 & Flag Icons -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />

    <style>
    :root {
        --booking-primary: #d4a373;
        --booking-secondary: #2c5530;
        --booking-dark: #0f172a;
        --booking-glass: rgba(255, 255, 255, 0.03);
        --booking-border: rgba(255, 255, 255, 0.1);
    }

    .booking-hero {
        background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), url('https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        background-size: cover;
        background-position: center;
        padding: 100px 0 80px;
        text-align: center;
        color: white;
    }

    .booking-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(32px, 5vw, 56px);
        margin-bottom: 20px;
    }

    /* Trust Badges on Booking Page */
    .booking-trust-badges {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .booking-trust-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        padding: 12px 20px;
        border-radius: 50px;
        border: 1px solid rgba(255,255,255,0.2);
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .booking-trust-item:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-2px);
    }

    .booking-trust-item i {
        color: #10b981;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .booking-trust-badges {
            gap: 15px;
        }
        .booking-trust-item {
            padding: 10px 15px;
            font-size: 12px;
        }
    }

    /* Availability Calendar Styles */
    .availability-calendar-container {
        background: white;
        border: 2px solid #f1f5f9;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 20px;
    }

    .calendar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .calendar-header h4 {
        font-size: 18px;
        font-weight: 700;
        color: var(--booking-dark);
        margin: 0;
    }

    .calendar-nav {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        color: #64748b;
    }

    .calendar-nav:hover {
        background: var(--booking-primary);
        color: white;
    }

    .calendar-legend {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #64748b;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .legend-dot.available { background: #10b981; }
    .legend-dot.limited { background: #F1B434; }
    .legend-dot.booked { background: #ef4444; }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
    }

    .calendar-day-header {
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        color: #94a3b8;
        padding: 10px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        border: 2px solid transparent;
        background: #f8fafc;
    }

    .calendar-day:hover:not(.disabled):not(.booked) {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .calendar-day-number {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .calendar-day-status {
        font-size: 10px;
        margin-top: 2px;
        font-weight: 500;
    }

    .calendar-day.available {
        background: #ecfdf5;
        border-color: #a7f3d0;
    }

    .calendar-day.available .calendar-day-number {
        color: #065f46;
    }

    .calendar-day.limited {
        background: #fffbeb;
        border-color: #fcd34d;
    }

    .calendar-day.limited .calendar-day-number {
        color: #92400e;
    }

    .calendar-day.booked {
        background: #fef2f2;
        border-color: #fecaca;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .calendar-day.booked .calendar-day-number {
        color: #991b1b;
        text-decoration: line-through;
    }

    .calendar-day.selected {
        background: linear-gradient(135deg, var(--booking-primary), #e65a2b);
        border-color: var(--booking-primary);
        box-shadow: 0 4px 15px rgba(212, 163, 115, 0.4);
    }

    .calendar-day.selected .calendar-day-number {
        color: white;
    }

    .calendar-day.selected .calendar-day-status {
        color: rgba(255,255,255,0.9);
    }

    .calendar-day.disabled {
        background: #f1f5f9;
        cursor: not-allowed;
        opacity: 0.5;
    }

    .calendar-day.disabled .calendar-day-number {
        color: #94a3b8;
    }

    .calendar-day.today {
        border: 2px solid var(--booking-primary);
    }

    .calendar-selected {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
        padding: 16px 20px;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 12px;
        color: #065f46;
        font-size: 15px;
    }

    .calendar-selected i {
        font-size: 20px;
    }

    .calendar-urgency {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 12px;
        padding: 12px 16px;
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border-radius: 10px;
        color: #92400e;
        font-size: 14px;
        animation: pulse-urgency 2s infinite;
    }

    @keyframes pulse-urgency {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    .calendar-urgency i {
        color: #F1B434;
    }

    /* Next Dates Grid */
    .next-dates-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 16px;
    }

    .next-date-card {
        background: white;
        border: 2px solid #f1f5f9;
        border-radius: 16px;
        padding: 16px 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .next-date-card:hover {
        border-color: var(--booking-primary);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .next-date-day {
        font-size: 12px;
        color: #94a3b8;
        text-transform: uppercase;
        font-weight: 600;
    }

    .next-date-number {
        font-size: 28px;
        font-weight: 800;
        color: var(--booking-dark);
        line-height: 1;
        margin: 4px 0;
    }

    .next-date-month {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .next-date-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .next-date-status.available {
        background: #ecfdf5;
        color: #065f46;
    }

    .next-date-status.limited {
        background: #fffbeb;
        color: #92400e;
    }

    .calendar-note {
        text-align: center;
        font-size: 13px;
        color: #94a3b8;
        margin: 0;
    }

    .calendar-note i {
        margin-right: 6px;
    }

    @media (max-width: 640px) {
        .calendar-grid {
            gap: 4px;
        }
        .calendar-day {
            border-radius: 8px;
        }
        .calendar-day-number {
            font-size: 12px;
        }
        .calendar-day-status {
            font-size: 8px;
        }
        .next-dates-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .calendar-legend {
            gap: 12px;
            flex-wrap: wrap;
        }
    }

    /* Security Notice */
    .security-notice {
        display: flex;
        align-items: center;
        gap: 15px;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border: 1px solid #a7f3d0;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .security-icon {
        width: 48px;
        height: 48px;
        background: #10b981;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }

    .security-content {
        display: flex;
        flex-direction: column;
    }

    .security-content strong {
        font-size: 16px;
        font-weight: 700;
        color: #065f46;
        margin-bottom: 4px;
    }

    .security-content span {
        font-size: 14px;
        color: #047857;
        line-height: 1.5;
    }

    @media (max-width: 640px) {
        .security-notice {
            flex-direction: column;
            text-align: center;
        }
    }

    .booking-wrapper {
        margin-top: -100px;
        padding-bottom: 100px;
        background: #f8fafc;
    }

    .booking-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .booking-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.1);
        overflow: hidden;
        display: grid;
        grid-template-columns: 300px 1fr;
    }

    @media (max-width: 992px) {
        .booking-card {
            grid-template-columns: 1fr;
        }
    }

    /* Booking Type Selection */
    .booking-type-selection {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    .booking-type-card {
        border: 3px solid #f1f5f9;
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        background: white;
        overflow: hidden;
    }

    .booking-type-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(212, 163, 115, 0.1), transparent);
        transition: left 0.5s;
    }

    .booking-type-card:hover::before {
        left: 100%;
    }

    .booking-type-card:hover {
        border-color: var(--booking-primary);
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(212, 163, 115, 0.2);
    }

    .booking-type-card.selected {
        border-color: var(--booking-primary);
        background: linear-gradient(135deg, rgba(212, 163, 115, 0.05), rgba(255, 255, 255, 0.95));
        box-shadow: 0 15px 35px rgba(212, 163, 115, 0.25);
    }

    .booking-type-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--booking-primary), var(--booking-secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        transition: all 0.3s;
    }

    .booking-type-card:hover .booking-type-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .booking-type-card.selected .booking-type-icon {
        box-shadow: 0 10px 30px rgba(212, 163, 115, 0.4);
    }

    .booking-type-icon i {
        font-size: 48px;
        color: white;
    }

    .booking-type-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        color: var(--booking-dark);
        margin-bottom: 15px;
        font-weight: 900;
    }

    .booking-type-card p {
        color: #64748b;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .booking-type-badge {
        display: inline-block;
        padding: 6px 15px;
        background: var(--accent-color);
        color: white;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .coming-soon-content {
        text-align: center;
        padding: 60px 40px;
        display: none;
    }

    .coming-soon-content.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    .coming-soon-icon-large {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, var(--booking-primary), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: pulse 2s infinite;
    }

    .coming-soon-icon-large i {
        font-size: 80px;
        color: white;
    }

    .coming-soon-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        color: var(--booking-dark);
        margin-bottom: 15px;
    }

    .coming-soon-content .badge-large {
        display: inline-block;
        padding: 12px 30px;
        background: var(--accent-color);
        color: white;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 25px;
    }

    .coming-soon-content p {
        color: #64748b;
        font-size: 18px;
        line-height: 1.8;
        max-width: 600px;
        margin: 0 auto 40px;
    }

    .contact-box {
        background: #f8fafc;
        padding: 30px;
        border-radius: 20px;
        margin: 30px 0;
    }

    .contact-box h4 {
        font-size: 20px;
        color: var(--booking-dark);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .contact-box a {
        color: var(--booking-primary);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin: 5px 15px;
        transition: all 0.3s;
    }

    .contact-box a:hover {
        color: var(--accent-color);
        transform: translateX(5px);
    }

    @media (max-width: 768px) {
        .booking-type-selection {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .booking-type-card {
            padding: 30px;
        }
        
        .coming-soon-content h2 {
            font-size: 28px;
        }
    }

    /* Sidebar Steps */
    .booking-sidebar {
        background: var(--booking-secondary);
        padding: 40px;
        color: white;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        opacity: 0.5;
        transition: all 0.3s;
    }

    .step-item.active {
        opacity: 1;
    }

    .step-number {
        width: 35px;
        height: 35px;
        border: 2px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }

    .step-item.active .step-number {
        background: var(--booking-primary);
        border-color: var(--booking-primary);
    }

    .step-label {
        font-weight: 600;
        font-size: 15px;
    }

    /* Form Content */
    .booking-form-content {
        padding: 50px;
    }

    .form-step {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .form-step.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .step-title {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        color: var(--booking-dark);
        margin-bottom: 30px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 8px;
    }

    .input-group input, 
    .input-group select, 
    .input-group textarea {
        width: 100%;
        padding: 12px 18px;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        transition: all 0.3s;
        background: #f8fafc;
    }

    .input-group input:focus, 
    .input-group select:focus, 
    .input-group textarea:focus {
        border-color: var(--booking-primary);
        background: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(212, 163, 115, 0.1);
    }

    /* Package Selection Cards */
    .package-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 15px;
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .package-option {
        border: 2px solid #f1f5f9;
        border-radius: 15px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .package-option:hover {
        border-color: var(--booking-primary);
        background: rgba(212, 163, 115, 0.05);
    }

    .package-option.selected {
        border-color: var(--booking-primary);
        background: rgba(212, 163, 115, 0.1);
    }

    .package-info h4 {
        font-size: 16px;
        margin-bottom: 4px;
    }

    .package-info p {
        font-size: 13px;
        color: #64748b;
    }

    .package-price {
        font-weight: 700;
        color: var(--booking-secondary);
    }

    /* Navigation Buttons */
    .form-nav {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-next, .btn-submit {
        background: var(--booking-primary);
        color: white;
        padding: 12px 35px;
        border-radius: 50px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-prev {
        background: #f1f5f9;
        color: #64748b;
        padding: 12px 35px;
        border-radius: 50px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-next:hover, .btn-submit:hover {
        background: var(--booking-dark);
        transform: translateY(-2px);
    }

    /* Payment Icons */
    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
    }

    .payment-method-card {
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .payment-method-card i {
        font-size: 20px;
        margin-bottom: 5px;
        display: block;
    }

    .payment-method-card span {
        font-size: 11px;
        font-weight: 600;
    }

    .payment-method-card.selected {
        border-color: var(--booking-primary);
        background: rgba(212, 163, 115, 0.1);
        color: var(--booking-primary);
    }

    /* Custom Scrollbar */
    .package-grid::-webkit-scrollbar {
        width: 6px;
    }
    .package-grid::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    .package-grid::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    /* Select2 Custom Styling */
    .select2-container--default .select2-selection--single {
        height: 50px;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        background: #f8fafc;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #1e293b;
        font-size: 15px;
        padding-left: 15px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px;
    }
    .select2-dropdown {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 15px;
        overflow: hidden;
        padding: 10px;
    }
    .select2-search__field {
        border-radius: 8px !important;
        border: 1px solid #e2e8f0 !important;
        padding: 8px 12px !important;
    }
    .select2-results__option {
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 2px;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: var(--booking-primary);
    }
    .flag-icon {
        margin-right: 10px;
        border-radius: 2px;
    }
</style>
@endsection

@section('content')
<div class="booking-hero">
    <div class="container">
        <h1 data-aos="fade-up">Start Your Journey</h1>
        <p data-aos="fade-up" data-aos-delay="100">Tell us about your dream safari and we'll make it a reality.</p>
        
        Trust Badges on Booking Page
        <div class="booking-trust-badges" data-aos="fade-up" data-aos-delay="200">
            <div class="booking-trust-item">
                <i class="fas fa-shield-alt"></i>
                <span>Secure Booking</span>
            </div>
            <div class="booking-trust-item">
                <i class="fas fa-lock"></i>
                <span>256-bit SSL</span>
            </div>
            <div class="booking-trust-item">
                <i class="fas fa-certificate"></i>
                <span>TALA Licensed</span>
            </div>
            <div class="booking-trust-item">
                <i class="fas fa-star"></i>
                <span>4.9/5 Rating</span>
            </div>
        </div>
    </div>
</div>

<div class="booking-wrapper">
    <div class="booking-container">
        @if(isset($requiresLogin) && $requiresLogin)
        <div style="background: #fff3cd; border: 2px solid #ffc107; border-radius: 15px; padding: 20px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px; box-shadow: 0 5px 15px rgba(255,193,7,0.2);">
            <i class="fas fa-exclamation-triangle" style="font-size: 28px; color: #ff9800;"></i>
            <div style="flex: 1;">
                <h3 style="margin: 0 0 8px 0; color: #856404; font-size: 18px; font-weight: 700;">Sign In Required</h3>
                <p style="margin: 0; color: #856404; font-size: 15px; line-height: 1.6;">
                    You need to <a href="{{ route('signin') }}" style="color: var(--booking-primary); font-weight: 700; text-decoration: underline;">sign in</a> to complete your booking. 
                    Don't have an account? <a href="{{ route('signup') }}" style="color: var(--booking-primary); font-weight: 700; text-decoration: underline;">Create one now</a>.
                </p>
            </div>
        </div>
        @endif

        <!-- Booking Type Selection Card -->
        <div class="booking-card" data-aos="zoom-in" id="booking-type-card">
            <div class="booking-form-content" style="grid-column: 1 / -1;">
                <!-- Step 0: Booking Type Selection -->
                <div class="form-step active" id="step-0">
                    <h2 class="step-title">Choose Your Booking Type</h2>
                    <p style="text-align: center; color: #64748b; margin-bottom: 40px; font-size: 16px;">
                        Select the type of booking you'd like to make
                    </p>
                    
                    <div class="booking-type-selection">
                        <div class="booking-type-card" onclick="selectBookingType('safari')">
                            <div class="booking-type-icon">
                                <i class="fas fa-binoculars"></i>
                            </div>
                            <h3>Safari Booking</h3>
                            <p>Book amazing safari tours, packages, and adventures across Tanzania's national parks and reserves.</p>
                            <div style="margin-top: 20px;">
                                <i class="fas fa-check-circle" style="color: var(--booking-primary);"></i>
                                <span style="color: #64748b; font-size: 14px; margin-left: 8px;">Available Now</span>
                            </div>
                        </div>
                        
                        <div class="booking-type-card" onclick="selectBookingType('flight')">
                            <div class="booking-type-icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <h3>Flight Booking</h3>
                            <p>Book domestic and international flights to make your journey seamless and convenient.</p>
                            <div style="margin-top: 20px;">
                                <span class="booking-type-badge">Coming Soon</span>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="booking_type" name="booking_type" value="">
                </div>

                <!-- Coming Soon Content (for Flight Booking) -->
                <div class="coming-soon-content" id="coming-soon-flight">
                    <div class="coming-soon-icon-large">
                        <i class="fas fa-plane"></i>
                    </div>
                    <span class="badge-large">Coming Soon</span>
                    <h2>Flight Booking</h2>
                    <p>
                        We're working hard to bring you an amazing flight booking experience! 
                        Soon you'll be able to book both domestic and international flights directly through our platform.
                    </p>
                    
                    <div class="contact-box">
                        <h4><i class="fas fa-info-circle"></i> Want to be notified when it's ready?</h4>
                        <div>
                            <a href="tel:+255691111111">
                                <i class="fas fa-phone"></i> +255 691 111 111
                            </a>
                            <a href="mailto:info@tanzaliansafaris.com">
                                <i class="fas fa-envelope"></i> info@tanzaliansafaris.com
                            </a>
                            <a href="https://wa.me/255691111111" target="_blank">
                                <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                            </a>
                        </div>
                    </div>

                    <button type="button" class="btn-prev" onclick="goBackToSelection()" style="margin-top: 20px;">
                        <i class="fas fa-arrow-left"></i> Back to Selection
                    </button>
                </div>
            </div>
        </div>

        <!-- Safari Booking Form Card (Hidden Initially) -->
        <div class="booking-card" data-aos="zoom-in" id="safari-booking-card" style="display: none;">
            <!-- Sidebar -->
            <div class="booking-sidebar" id="booking-sidebar">
                <div class="step-item" id="step-nav-1">
                    <div class="step-number">1</div>
                    <div class="step-label">Personal Info</div>
                </div>
                <div class="step-item" id="step-nav-2">
                    <div class="step-number">2</div>
                    <div class="step-label">Safari Details</div>
                </div>
                <div class="step-item" id="step-nav-3">
                    <div class="step-number">3</div>
                    <div class="step-label">Payment & Review</div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="booking-form-content">
                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    
                    <!-- Step 1: Personal Info -->
                    <div class="form-step" id="step-1">
                        <h2 class="step-title">Personal Information</h2>
                        <div class="form-grid">
                            <div class="input-group">
                                <label>Full Name *</label>
                                <input type="text" name="full_name" placeholder="John Doe" required value="{{ old('full_name', auth()->user() ? auth()->user()->name : '') }}">
                            </div>
                            <div class="input-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" placeholder="john@example.com" required value="{{ old('email', auth()->user() ? auth()->user()->email : '') }}">
                            </div>
                            <div class="input-group">
                                <label>Phone Number *</label>
                                <input type="tel" name="phone" placeholder="+255..." required value="{{ old('phone', auth()->user() ? auth()->user()->phone : '') }}">
                            </div>
                            <div class="input-group">
                                <label>Country *</label>
                                <select name="country" id="country_select" required style="width: 100%;">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-nav">
                            <div></div>
                            <button type="button" class="btn-next" onclick="nextStep(2)">Next Step <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Safari Details -->
                    <div class="form-step" id="step-2">
                        <h2 class="step-title">Safari Details</h2>
                        
                        <div class="input-group">
                            <label>Select Your Package *</label>
                            <div class="package-grid">
                                @foreach ($packages as $p)
                                <div class="package-option {{ old('safari_package') == $p->id ? 'selected' : '' }}" onclick="selectPackage(this, '{{ $p->id }}')" data-package-id="{{ $p->id }}">
                                    <div class="package-info">
                                        <h4>{{ $p->name }}</h4>
                                        <p>{{ $p->duration_label }}</p>
                                    </div>
                                    <div class="package-price">{{ $p->price_amount }}{{ $p->price_suffix }}</div>
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="safari_package" id="selected_package" required value="{{ old('safari_package') }}">
                        </div>

                        <!-- Availability Calendar Section -->
                        <div class="input-group" id="calendar-section" style="display: none;">
                            <label>Select Your Start Date *</label>
                            <div class="availability-calendar-container">
                                <div class="calendar-header">
                                    <button type="button" class="calendar-nav" id="prevMonth">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <h4 id="calendarMonth">February 2026</h4>
                                    <button type="button" class="calendar-nav" id="nextMonth">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <div class="calendar-legend">
                                    <div class="legend-item">
                                        <span class="legend-dot available"></span>
                                        <span>Available</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot limited"></span>
                                        <span>Limited</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot booked"></span>
                                        <span>Booked</span>
                                    </div>
                                </div>
                                <div class="calendar-grid" id="calendarGrid">
                                    <!-- Calendar will be populated by JavaScript -->
                                </div>
                                <div class="calendar-selected" id="calendarSelected" style="display: none;">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Selected: <strong id="selectedDateDisplay"></strong></span>
                                </div>
                                <div class="calendar-urgency" id="calendarUrgency" style="display: none;">
                                    <i class="fas fa-fire"></i>
                                    <span>Only <strong id="spotsRemaining">2</strong> spots left on this date!</span>
                                </div>
                            </div>
                            <input type="hidden" name="start_date" id="start_date" required value="{{ old('start_date') }}">
                        </div>

                        <!-- Next Available Dates (shown when no package selected) -->
                        <div class="input-group" id="next-available-section">
                            <label>Popular Upcoming Dates</label>
                            <div class="next-dates-grid" id="nextDatesGrid">
                                <div class="next-date-card">
                                    <div class="next-date-day">Mon</div>
                                    <div class="next-date-number">15</div>
                                    <div class="next-date-month">Feb</div>
                                    <span class="next-date-status available">Available</span>
                                </div>
                                <div class="next-date-card">
                                    <div class="next-date-day">Thu</div>
                                    <div class="next-date-number">18</div>
                                    <div class="next-date-month">Feb</div>
                                    <span class="next-date-status limited">Limited</span>
                                </div>
                                <div class="next-date-card">
                                    <div class="next-date-day">Sat</div>
                                    <div class="next-date-number">20</div>
                                    <div class="next-date-month">Feb</div>
                                    <span class="next-date-status available">Available</span>
                                </div>
                                <div class="next-date-card">
                                    <div class="next-date-day">Wed</div>
                                    <div class="next-date-number">24</div>
                                    <div class="next-date-month">Feb</div>
                                    <span class="next-date-status available">Available</span>
                                </div>
                            </div>
                            <p class="calendar-note"><i class="fas fa-info-circle"></i> Select a package above to see full availability calendar</p>
                        </div>

                        <!-- Packing List Reminder -->
                        <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); border: 1px solid #fcd34d; border-radius: 16px; padding: 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 16px;">
                            <div style="width: 48px; height: 48px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                                🎒
                            </div>
                            <div style="flex: 1;">
                                <h4 style="font-size: 16px; color: #92400e; margin-bottom: 4px;">Going on Safari?</h4>
                                <p style="font-size: 14px; color: #78350f; margin: 0;">Check our <a href="{{ route('packing-list') }}" target="_blank" style="color: #d97706; font-weight: 700; text-decoration: underline;">Packing List</a> to make sure you bring everything you need!</p>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="input-group">
                                <label>Accommodation *</label>
                                <select name="accommodation" required>
                                    <option value="">Choose Level</option>
                                    <option value="Luxury Lodges" {{ old('accommodation') === 'Luxury Lodges' ? 'selected' : '' }}>Luxury Lodges</option>
                                    <option value="Mid-range Lodges" {{ old('accommodation') === 'Mid-range Lodges' ? 'selected' : '' }}>Mid-range Lodges</option>
                                    <option value="Budget Camps" {{ old('accommodation') === 'Budget Camps' ? 'selected' : '' }}>Budget Camps</option>
                                    <option value="Camping Only" {{ old('accommodation') === 'Camping Only' ? 'selected' : '' }}>Camping Only</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Nights *</label>
                                <input type="number" name="nights" min="1" required value="{{ old('nights', 1) }}">
                            </div>
                            <div class="input-group">
                                <label>Adults *</label>
                                <input type="number" name="adults" min="1" required value="{{ old('adults', 2) }}">
                            </div>
                            <div class="input-group">
                                <label>Children</label>
                                <input type="number" name="children" min="0" value="{{ old('children', 0) }}">
                            </div>
                        </div>

                        <div class="form-nav">
                            <button type="button" class="btn-prev" onclick="prevStep(1)"><i class="fas fa-arrow-left"></i> Back</button>
                            <button type="button" class="btn-next" onclick="nextStep(3)">Next Step <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Payment & Review -->
                    <div class="form-step" id="step-3">
                        <h2 class="step-title">Payment & Review</h2>
                        
                        <!-- Security Notice -->
                        <div class="security-notice">
                            <div class="security-icon">
                                <i class="fas fa-shield-check"></i>
                            </div>
                            <div class="security-content">
                                <strong>Secure Payment</strong>
                                <span>Your payment information is encrypted with 256-bit SSL security. We never store your card details.</span>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <label>Preferred Payment Method *</label>
                            <div class="payment-methods">
                                @if(\App\Models\PaymentSetting::get('card_enabled') == '1')
                                <div class="payment-method-card" onclick="selectPayment(this, 'visa_mastercard')">
                                    <i class="fas fa-credit-card"></i>
                                    <span>Card</span>
                                </div>
                                @endif

                                @if(\App\Models\PaymentSetting::get('zenopay_enabled') == '1')
                                <div class="payment-method-card" onclick="selectPayment(this, 'mpesa')">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span>Mobile Money</span>
                                </div>
                                @endif

                                @if(\App\Models\PaymentSetting::get('paypal_enabled') == '1')
                                <div class="payment-method-card" onclick="selectPayment(this, 'paypal')">
                                    <i class="fab fa-paypal"></i>
                                    <span>PayPal</span>
                                </div>
                                @endif

                                @if(\App\Models\PaymentSetting::get('bank_enabled') == '1')
                                <div class="payment-method-card" onclick="selectPayment(this, 'bank_swift')">
                                    <i class="fas fa-university"></i>
                                    <span>Bank</span>
                                </div>
                                @endif

                                @if(\App\Models\PaymentSetting::get('usdt_enabled') == '1')
                                <div class="payment-method-card" onclick="selectPayment(this, 'usdt')">
                                    <i class="fas fa-coins"></i>
                                    <span>USDT</span>
                                </div>
                                @endif
                            </div>
                            <input type="hidden" name="payment_method" id="selected_payment" required value="{{ old('payment_method') }}">
                        </div>

                        <div id="dynamicPaymentFields" class="form-grid" style="margin-bottom: 20px;"></div>

                        <div class="input-group">
                            <label>Special Requests / Message</label>
                            <textarea name="message" rows="4" placeholder="Any dietary requirements or special needs?">{{ old('message') }}</textarea>
                        </div>

                        <input type="hidden" name="payment_details" id="payment_details_hidden">

                        <div class="form-nav">
                            <button type="button" class="btn-prev" onclick="prevStep(2)"><i class="fas fa-arrow-left"></i> Back</button>
                            <button type="submit" class="btn-submit">Confirm Booking <i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Set min date to today
    document.getElementById("start_date").min = new Date().toISOString().split("T")[0];

    // Initialize Country Select with Flags
    $(document).ready(function() {
        const countrySelect = $('#country_select');

        function formatCountry(country) {
            if (!country.id) return country.text;
            const code = country.element.dataset.code;
            if (!code) return country.text;
            return $(`<span><span class="fi fi-${code.toLowerCase()} flag-icon"></span>${country.text}</span>`);
        }

        // Fetch Countries
        fetch('https://restcountries.com/v3.1/all?fields=name,cca2')
            .then(res => res.json())
            .then(data => {
                const countries = data.map(c => ({
                    name: c.name.common,
                    code: c.cca2
                })).sort((a, b) => a.name.localeCompare(b.name));

                countries.forEach(c => {
                    const option = new Option(c.name, c.name, false, false);
                    option.dataset.code = c.code;
                    countrySelect.append(option);
                });

                countrySelect.select2({
                    templateResult: formatCountry,
                    templateSelection: formatCountry,
                    placeholder: "Search for a country...",
                    allowClear: true
                });
            });
    });

    function selectBookingType(type) {
        @if(isset($requiresLogin) && $requiresLogin)
        if (type === 'safari') {
            // Redirect to signin if not authenticated
            window.location.href = '{{ route("signin") }}?redirect_after_login={{ urlencode(route("booking")) }}';
            return;
        }
        @endif

        // Remove selected class from all cards
        document.querySelectorAll('.booking-type-card').forEach(card => {
            card.classList.remove('selected');
        });

        // Add selected class to clicked card
        event.currentTarget.classList.add('selected');
        document.getElementById('booking_type').value = type;

        if (type === 'flight') {
            // Hide safari booking card
            document.getElementById('safari-booking-card').style.display = 'none';
            
            // Hide step-0 (selection) and show coming soon
            document.getElementById('step-0').classList.remove('active');
            document.getElementById('coming-soon-flight').classList.add('active');
        } else if (type === 'safari') {
            // Hide booking type selection card
            document.getElementById('booking-type-card').style.display = 'none';
            
            // Hide coming soon if visible
            document.getElementById('coming-soon-flight').classList.remove('active');
            
            // Show safari booking form card
            document.getElementById('safari-booking-card').style.display = 'grid';
            document.getElementById('step-1').classList.add('active');
            
            // Update sidebar navigation
            document.querySelectorAll('.step-item').forEach(n => n.classList.remove('active'));
            document.getElementById('step-nav-1').classList.add('active');
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function goBackToSelection() {
        // Hide safari booking card
        document.getElementById('safari-booking-card').style.display = 'none';
        
        // Hide coming soon and show step-0 (selection)
        document.getElementById('coming-soon-flight').classList.remove('active');
        document.getElementById('step-0').classList.add('active');
        
        // Show booking type selection card
        document.getElementById('booking-type-card').style.display = 'block';
        document.getElementById('booking_type').value = '';
        
        // Remove selected class from all cards
        document.querySelectorAll('.booking-type-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function nextStep(step) {
        // Simple validation for current step
        const currentStep = document.querySelector('.form-step.active');
        if (!currentStep) return;
        
        const inputs = currentStep.querySelectorAll('input[required], select[required]');
        let valid = true;
        
        inputs.forEach(input => {
            if (!input.value) {
                input.style.borderColor = '#ef4444';
                valid = false;
            } else {
                input.style.borderColor = '#f1f5f9';
            }
        });

        if (!valid) {
            alert("Please fill in all required fields.");
            return;
        }

        // Switch steps
        document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
        document.getElementById('step-' + step).classList.add('active');
        
        // Update nav
        document.querySelectorAll('.step-item').forEach(n => n.classList.remove('active'));
        document.getElementById('step-nav-' + step).classList.add('active');
        
        window.scrollTo({ top: 200, behavior: 'smooth' });
    }

    function prevStep(step) {
        document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
        document.getElementById('step-' + step).classList.add('active');
        
        document.querySelectorAll('.step-item').forEach(n => n.classList.remove('active'));
        document.getElementById('step-nav-' + step).classList.add('active');
    }

    function selectPackage(el, id) {
        document.querySelectorAll('.package-option').forEach(opt => opt.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('selected_package').value = id;
        
        // Show calendar section and load availability
        document.getElementById('calendar-section').style.display = 'block';
        document.getElementById('next-available-section').style.display = 'none';
        
        // Load calendar for selected package
        availabilityCalendar.loadForPackage(id);
    }

    // Availability Calendar Class
    class AvailabilityCalendar {
        constructor() {
            this.currentDate = new Date();
            this.selectedDate = null;
            this.packageId = null;
            this.calendarData = [];
            
            this.init();
        }
        
        init() {
            // Bind navigation buttons
            document.getElementById('prevMonth').addEventListener('click', () => this.prevMonth());
            document.getElementById('nextMonth').addEventListener('click', () => this.nextMonth());
            
            // Generate initial empty calendar
            this.renderCalendar([]);
        }
        
        loadForPackage(packageId) {
            this.packageId = packageId;
            this.fetchAvailability();
        }
        
        async fetchAvailability() {
            const month = this.currentDate.getMonth() + 1;
            const year = this.currentDate.getFullYear();
            
            try {
                const response = await fetch(`/booking/availability?package_id=${this.packageId}&month=${month}&year=${year}`);
                const data = await response.json();
                
                if (data.success) {
                    this.calendarData = data.calendar;
                    document.getElementById('calendarMonth').textContent = data.month_name;
                    this.renderCalendar(this.calendarData);
                }
            } catch (error) {
                console.error('Error fetching availability:', error);
            }
        }
        
        renderCalendar(calendarData) {
            const grid = document.getElementById('calendarGrid');
            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            
            let html = '';
            
            // Day headers
            dayNames.forEach(day => {
                html += `<div class="calendar-day-header">${day}</div>`;
            });
            
            // Calendar days
            calendarData.forEach(day => {
                const date = new Date(day.date);
                const isToday = this.isToday(date);
                const isSelected = this.selectedDate === day.date;
                
                let classes = ['calendar-day', day.status];
                if (isToday) classes.push('today');
                if (isSelected) classes.push('selected');
                if (day.is_past || !day.is_available) classes.push('disabled');
                
                html += `
                    <div class="${classes.join(' ')}" 
                         onclick="availabilityCalendar.selectDate('${day.date}', ${day.is_available})"
                         title="${day.status_label}">
                        <span class="calendar-day-number">${day.day}</span>
                        ${day.status === 'limited' ? '<span class="calendar-day-status">Limited</span>' : ''}
                    </div>
                `;
            });
            
            grid.innerHTML = html;
        }
        
        selectDate(dateStr, isAvailable) {
            if (!isAvailable) return;
            
            this.selectedDate = dateStr;
            document.getElementById('start_date').value = dateStr;
            
            // Update UI
            document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('selected'));
            event.currentTarget.classList.add('selected');
            
            // Show selected date
            const selectedDay = this.calendarData.find(d => d.date === dateStr);
            document.getElementById('selectedDateDisplay').textContent = new Date(dateStr).toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            document.getElementById('calendarSelected').style.display = 'flex';
            
            // Show urgency if limited spots
            if (selectedDay && selectedDay.status === 'limited') {
                document.getElementById('spotsRemaining').textContent = selectedDay.spots_remaining;
                document.getElementById('calendarUrgency').style.display = 'flex';
            } else {
                document.getElementById('calendarUrgency').style.display = 'none';
            }
        }
        
        prevMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            if (this.packageId) {
                this.fetchAvailability();
            }
        }
        
        nextMonth() {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            if (this.packageId) {
                this.fetchAvailability();
            }
        }
        
        isToday(date) {
            const today = new Date();
            return date.getDate() === today.getDate() &&
                   date.getMonth() === today.getMonth() &&
                   date.getFullYear() === today.getFullYear();
        }
    }
    
    // Initialize calendar
    const availabilityCalendar = new AvailabilityCalendar();

    function selectPayment(el, method) {
        document.querySelectorAll('.payment-method-card').forEach(opt => opt.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('selected_payment').value = method;
        renderPaymentFields(method);
    }

    function renderPaymentFields(method) {
        const container = document.getElementById('dynamicPaymentFields');
        container.innerHTML = "";
        
        if (method === "visa_mastercard") {
            container.innerHTML = `
                <div class="input-group">
                    <label>Card Number</label>
                    <input type="text" id="card_number" placeholder="0000 0000 0000 0000" required>
                </div>
                <div class="input-group">
                    <label>Expiry / CVV</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" id="card_expiry" placeholder="MM/YY" required>
                        <input type="text" id="card_cvv" placeholder="CVV" required>
                    </div>
                </div>
            `;
        } else if (method === "mpesa") {
            container.innerHTML = `
                <div class="input-group" style="grid-column: span 2;">
                    <label>M-Pesa Number</label>
                    <input type="tel" id="mm_number" placeholder="0762..." required>
                </div>
            `;
        } else if (method === "paypal") {
            container.innerHTML = `
                <div class="input-group" style="grid-column: span 2;">
                    <label>PayPal Email</label>
                    <input type="email" id="paypal_email" placeholder="your@email.com" required>
                </div>
            `;
        } else if (method === "bank_swift") {
            container.innerHTML = `
                <div class="input-group" style="grid-column: span 2;">
                    <label>Account Name</label>
                    <input type="text" id="acct_name" placeholder="Full Name" required>
                </div>
            `;
        } else if (method === "usdt") {
            container.innerHTML = `
                <div class="input-group" style="grid-column: span 2;">
                    <label>USDT TRC20 Wallet Address</label>
                    <input type="text" id="usdt_wallet" placeholder="T..." required>
                </div>
            `;
        }
    }

    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        @if(isset($requiresLogin) && $requiresLogin)
        e.preventDefault();
        alert('Please sign in to complete your booking.');
        window.location.href = '{{ route("signin") }}?redirect_after_login={{ urlencode(route("booking")) }}';
        return false;
        @endif

        const method = document.getElementById('selected_payment').value;
        let details = {};
        
        if (method === "visa_mastercard") {
            details.card = document.getElementById('card_number').value;
        } else if (method === "mpesa") {
            details.phone = document.getElementById('mm_number').value;
        } else if (method === "paypal") {
            details.email = document.getElementById('paypal_email').value;
        }
        
        document.getElementById('payment_details_hidden').value = JSON.stringify(details);
    });
</script>
@endsection

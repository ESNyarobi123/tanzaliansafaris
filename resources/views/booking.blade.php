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
        padding: 100px 0;
        text-align: center;
        color: white;
    }

    .booking-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(32px, 5vw, 56px);
        margin-bottom: 20px;
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
                                <div class="package-option {{ old('safari_package') == $p->id ? 'selected' : '' }}" onclick="selectPackage(this, '{{ $p->id }}')">
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
                                <label>Start Date *</label>
                                <input type="date" name="start_date" id="start_date" required value="{{ old('start_date') }}">
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
    }

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

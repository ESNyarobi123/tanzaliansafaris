@extends('layouts.app')

@section('title', 'Privacy Policy - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-privacy {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 120px 0 80px;
        text-align: center;
    }
    .page-header-privacy h1 {
        font-family: 'Playfair Display', serif;
        font-size: 56px;
        margin-bottom: 20px;
    }
    .page-header-privacy p {
        font-size: 20px;
        opacity: 0.9;
    }
    .privacy-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 60px 20px;
        background: white;
    }
    .content-section-privacy {
        margin-bottom: 50px;
    }
    .content-section-privacy h2 {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: var(--secondary-color);
        margin-bottom: 25px;
        border-bottom: 3px solid var(--primary-color);
        padding-bottom: 15px;
    }
    .content-section-privacy h3 {
        font-size: 22px;
        color: var(--secondary-color);
        margin: 30px 0 15px 0;
        font-weight: 700;
    }
    .content-section-privacy p {
        margin-bottom: 20px;
        color: var(--text-light);
        line-height: 1.8;
        font-size: 16px;
    }
    .content-section-privacy ul {
        margin-left: 30px;
        margin-bottom: 25px;
    }
    .content-section-privacy li {
        margin-bottom: 12px;
        color: var(--text-light);
        font-size: 16px;
    }
    .highlight-box-privacy {
        background: #f8f9fa;
        border-left: 5px solid var(--primary-color);
        padding: 30px;
        margin: 30px 0;
        border-radius: 0 15px 15px 0;
    }
    @media (max-width: 768px) {
        .page-header-privacy h1 {
            font-size: 36px;
        }
        .content-section-privacy h2 {
            font-size: 26px;
        }
        .highlight-box-privacy {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-privacy">
    <div data-aos="fade-up">
        <h1>Privacy Policy</h1>
        <p>Last Updated: {{ date('F Y') }}</p>
    </div>
</section>

<div class="privacy-container">
    <div class="content-section-privacy" data-aos="fade-up">
        <p>At Tanzalian Safari's Limited, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you interact with us.</p>
    </div>

    <div class="content-section-privacy" data-aos="fade-up">
        <h2>1. Information We Collect</h2>
        
        <h3>1.1 Personal Information</h3>
        <p>When you book a safari or contact us, we collect:</p>
        <ul>
            <li>Full name and contact details (email, phone number, address)</li>
            <li>Passport information for booking and permit purposes</li>
            <li>Date of birth and nationality</li>
            <li>Payment and billing information</li>
            <li>Dietary requirements and medical conditions (if relevant to your trip)</li>
            <li>Emergency contact information</li>
        </ul>

        <h3>1.2 Automatically Collected Information</h3>
        <p>When you visit our website, we may collect:</p>
        <ul>
            <li>IP address and browser type</li>
            <li>Pages visited and time spent on site</li>
            <li>Referring website addresses</li>
            <li>Device information</li>
        </ul>
    </div>

    <div class="content-section-privacy" data-aos="fade-up">
        <h2>2. How We Use Your Information</h2>
        <p>We use your personal information to:</p>
        <ul>
            <li>Process and confirm your safari bookings</li>
            <li>Communicate with you about your trip details</li>
            <li>Arrange accommodations, permits, and activities with our partners</li>
            <li>Provide customer support and assistance</li>
            <li>Send important travel updates and documentation</li>
            <li>Process payments securely</li>
            <li>Comply with legal and regulatory requirements in Tanzania</li>
            <li>Improve our services and website experience</li>
        </ul>
    </div>

    <div class="content-section-privacy" data-aos="fade-up">
        <h2>3. Information Sharing</h2>
        <p>We share your information only when necessary to fulfill your travel arrangements:</p>
        
        <h3>3.1 Service Providers</h3>
        <p>We share relevant information with:</p>
        <ul>
            <li>Hotels, lodges, and campsites where you will stay</li>
            <li>Airlines and transport providers for your transfers</li>
            <li>National park authorities for entry permits</li>
            <li>Tour guides and local partners involved in your safari</li>
        </ul>

        <div class="highlight-box-privacy">
            <p><strong><i class="fas fa-shield-alt"></i> Our Promise:</strong> We never sell, rent, or trade your personal information to third parties for marketing purposes. Your trust is our priority.</p>
        </div>
    </div>

    <div class="content-section-privacy" data-aos="fade-up">
        <h2>4. Data Security</h2>
        <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, or disclosure. This includes SSL encryption for data transmission and restricted access to sensitive data within our organization.</p>
    </div>

    <div class="content-section-privacy" data-aos="fade-up">
        <h2>5. Your Rights</h2>
        <p>You have the right to access, correct, or request the deletion of your personal information. You can also opt-out of any marketing communications at any time by contacting us directly.</p>
    </div>

    <div class="content-section-privacy" data-aos="fade-up">
        <h2>6. Contact Us</h2>
        <p>For any questions about this Privacy Policy or how we handle your data, please reach out to us:</p>
        <div class="highlight-box-privacy">
            <p><strong>Tanzalian Safari's Limited</strong><br>
            Arusha, Tanzania<br>
            <i class="fas fa-phone"></i> Phone: +255 762 402 880<br>
            <i class="fas fa-envelope"></i> Email: info@tanzaliansafaris.com</p>
        </div>
    </div>
</div>
@endsection

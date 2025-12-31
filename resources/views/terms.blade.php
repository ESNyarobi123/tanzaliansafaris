@extends('layouts.app')

@section('title', 'Terms & Conditions - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-terms {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        color: white;
        padding: 120px 0 80px;
        text-align: center;
    }
    .page-header-terms h1 {
        font-family: 'Playfair Display', serif;
        font-size: 56px;
        margin-bottom: 20px;
    }
    .page-header-terms p {
        font-size: 20px;
        opacity: 0.9;
    }
    .terms-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 60px 20px;
        background: white;
    }
    .content-section-terms {
        margin-bottom: 50px;
    }
    .content-section-terms h2 {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: var(--secondary-color);
        margin-bottom: 25px;
        border-bottom: 3px solid var(--primary-color);
        padding-bottom: 15px;
    }
    .content-section-terms h3 {
        font-size: 22px;
        color: var(--secondary-color);
        margin: 30px 0 15px 0;
        font-weight: 700;
    }
    .content-section-terms p {
        margin-bottom: 20px;
        color: var(--text-light);
        line-height: 1.8;
        font-size: 16px;
    }
    .content-section-terms ul, .content-section-terms ol {
        margin-left: 30px;
        margin-bottom: 25px;
    }
    .content-section-terms li {
        margin-bottom: 12px;
        color: var(--text-light);
        font-size: 16px;
    }
    @media (max-width: 768px) {
        .page-header-terms h1 {
            font-size: 36px;
        }
        .content-section-terms h2 {
            font-size: 26px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-terms">
    <div data-aos="fade-up">
        <h1>Terms & Conditions</h1>
        <p>Last Updated: {{ date('F Y') }}</p>
    </div>
</section>

<div class="terms-container">
    <div class="content-section-terms" data-aos="fade-up">
        <h2>1. Booking & Reservations</h2>
        <p>By making a booking with Tanzalian Safari's Limited, you agree to be bound by these terms and conditions. Please read them carefully before making a reservation.</p>
        
        <h3>1.1 Booking Confirmation</h3>
        <p>A booking is confirmed only upon receipt of a non-refundable deposit of 30% of the total safari cost. Full payment must be received at least 60 days before the safari departure date.</p>
        
        <h3>1.2 Payment Methods</h3>
        <p>We accept payments via bank transfer, credit cards (Visa, Mastercard), and selected mobile money services. All prices are quoted in USD unless otherwise stated.</p>
    </div>

    <div class="content-section-terms" data-aos="fade-up">
        <h2>2. Cancellation Policy</h2>
        <p>In the event of a cancellation, the following fees apply:</p>
        <ul>
            <li><strong>90+ days before departure:</strong> 30% deposit forfeited</li>
            <li><strong>60-89 days before departure:</strong> 50% of total cost</li>
            <li><strong>30-59 days before departure:</strong> 75% of total cost</li>
            <li><strong>Less than 30 days:</strong> 100% of total cost</li>
        </ul>
        <p>We strongly recommend purchasing comprehensive travel insurance to cover potential cancellation fees.</p>
    </div>

    <div class="content-section-terms" data-aos="fade-up">
        <h2>3. Travel Insurance</h2>
        <p>Travel insurance is mandatory for all safari participants. Your policy must cover medical expenses, emergency evacuation, trip cancellation, and baggage loss. Proof of insurance may be requested before departure.</p>
    </div>

    <div class="content-section-terms" data-aos="fade-up">
        <h2>4. Health & Safety</h2>
        <p>Clients are responsible for ensuring they meet all health requirements for entry into Tanzania, including mandatory Yellow Fever vaccinations if applicable. You must follow all safety instructions provided by your guide during game drives and activities.</p>
    </div>

    <div class="content-section-terms" data-aos="fade-up">
        <h2>5. Liability</h2>
        <p>Tanzalian Safari's Limited acts as an agent for various service providers. While we choose our partners carefully, we are not liable for any loss, damage, injury, or delay caused by these third parties or by events beyond our control (force majeure).</p>
    </div>

    <div class="content-section-terms" data-aos="fade-up">
        <h2>6. Contact Information</h2>
        <p>If you have any questions regarding these terms, please contact us:</p>
        <div style="background: #f8f9fa; padding: 25px; border-radius: 15px; border-left: 5px solid var(--primary-color);">
            <p><strong>Tanzalian Safari's Limited</strong><br>
            Arusha, Tanzania<br>
            <i class="fas fa-phone"></i> Phone: +255 762 402 880<br>
            <i class="fas fa-envelope"></i> Email: info@tanzaliansafaris.com</p>
        </div>
    </div>
</div>
@endsection

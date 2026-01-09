@extends('layouts.app')

@section('title', 'Flight Booking - Coming Soon - Tanzalian Safari\'s')

@section('styles')
<style>
    .coming-soon-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        text-align: center;
    }

    .coming-soon-container {
        max-width: 600px;
        background: white;
        padding: 60px 40px;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    }

    .coming-soon-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: pulse 2s infinite;
    }

    .coming-soon-icon i {
        font-size: 60px;
        color: white;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(212, 163, 115, 0.7);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 0 20px rgba(212, 163, 115, 0);
        }
    }

    .coming-soon-container h1 {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        font-weight: 900;
        color: var(--secondary-color);
        margin-bottom: 20px;
    }

    .coming-soon-container .badge {
        display: inline-block;
        padding: 10px 25px;
        background: var(--accent-color);
        color: white;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 30px;
    }

    .coming-soon-container p {
        font-size: 18px;
        color: var(--text-light);
        line-height: 1.8;
        margin-bottom: 40px;
    }

    .contact-info {
        background: var(--light-color);
        padding: 30px;
        border-radius: 20px;
        margin-top: 30px;
    }

    .contact-info h3 {
        font-size: 20px;
        color: var(--secondary-color);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .contact-info p {
        color: var(--text-light);
        margin-bottom: 10px;
        font-size: 16px;
    }

    .contact-info a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .contact-info a:hover {
        color: var(--accent-color);
    }

    .btn-back {
        display: inline-block;
        margin-top: 30px;
        padding: 15px 40px;
        background: var(--secondary-color);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s;
        box-shadow: 0 5px 20px rgba(44, 85, 48, 0.3);
    }

    .btn-back:hover {
        background: var(--primary-color);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 163, 115, 0.4);
    }

    @media (max-width: 768px) {
        .coming-soon-container {
            padding: 40px 30px;
        }
        
        .coming-soon-container h1 {
            font-size: 32px;
        }
        
        .coming-soon-icon {
            width: 100px;
            height: 100px;
        }
        
        .coming-soon-icon i {
            font-size: 50px;
        }
    }
</style>
@endsection

@section('content')
<section class="coming-soon-section">
    <div class="coming-soon-container" data-aos="zoom-in" data-aos-duration="800">
        <div class="coming-soon-icon">
            <i class="fas fa-plane"></i>
        </div>
        
        <span class="badge">Coming Soon</span>
        
        <h1>Flight Booking</h1>
        
        <p>
            We're working hard to bring you an amazing flight booking experience! 
            Soon you'll be able to book both domestic and international flights directly through our platform.
        </p>

        <div class="contact-info">
            <h3><i class="fas fa-info-circle"></i> Want to be notified when it's ready?</h3>
            <p>
                Contact us at <a href="tel:+255691111111"><i class="fas fa-phone"></i> +255 691 111 111</a>
            </p>
            <p>
                Or email us at <a href="mailto:info@tanzaliansafaris.com"><i class="fas fa-envelope"></i> info@tanzaliansafaris.com</a>
            </p>
            <p>
                <a href="https://wa.me/255691111111" target="_blank" style="display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fab fa-whatsapp"></i> Chat with us on WhatsApp
                </a>
            </p>
        </div>

        <a href="{{ route('home') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>
</section>
@endsection

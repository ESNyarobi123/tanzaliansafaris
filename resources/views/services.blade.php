@extends('layouts.app')

@section('title', 'Our Services - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-services {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('https://images.unsplash.com/photo-1523805009345-7448845a9e53?w=1920') center/cover;
        padding: 150px 20px 100px;
        text-align: center;
        color: white;
    }
    .page-header-services h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        font-weight: 900;
        margin-bottom: 20px;
    }
    .page-header-services p {
        font-size: 20px;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0.9;
    }
    .services-section-page {
        padding: 100px 20px;
        background: white;
    }
    .services-grid-page {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .service-card-page {
        background: white;
        padding: 50px 40px;
        border-radius: 25px;
        text-align: center;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
        transition: all 0.3s;
        border: 1px solid #f1f5f9;
    }
    .service-card-page:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        border-color: var(--primary-color);
    }
    .service-icon-page {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        box-shadow: 0 10px 20px rgba(44,85,48,0.2);
    }
    .service-icon-page i {
        font-size: 44px;
        color: white;
    }
    .service-card-page h3 {
        font-size: 28px;
        margin-bottom: 20px;
        color: var(--secondary-color);
        font-family: 'Playfair Display', serif;
    }
    .service-card-page p {
        color: var(--text-light);
        line-height: 1.8;
        font-size: 16px;
    }
    .service-card-page .btn-primary {
        background: var(--accent-color);
        color: #fff !important;
        box-shadow: 0 5px 20px rgba(255, 107, 53, 0.4);
        transition: all 0.3s;
    }
    .service-card-page .btn-primary:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 163, 115, 0.4);
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-services">
    <div data-aos="fade-up">
        <h1>Our Services</h1>
        <p>Comprehensive travel solutions for your perfect African adventure. We handle everything from the moment you land until you depart.</p>
    </div>
</section>

<!-- Services -->
<section class="services-section-page">
    <div class="container">
        <div class="services-grid-page">
            <div class="service-card-page" data-aos="fade-up" data-aos-delay="0">
                <div class="service-icon-page">
                    <i class="fas fa-binoculars"></i>
                </div>
                <h3>Safari Tours</h3>
                <p>Experience the Big Five in Serengeti, Ngorongoro Crater, Tarangire, and more incredible national parks with our expert guides.</p>
            </div>

            <div class="service-card-page" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon-page">
                    <i class="fas fa-car"></i>
                </div>
                <h3>Car Rentals</h3>
                <p>Reliable 4×4 safari vehicles with experienced drivers for your comfort and safety across all terrains in Tanzania.</p>
            </div>

            <div class="service-card-page" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon-page">
                    <i class="fas fa-hotel"></i>
                </div>
                <h3>Hotel Bookings</h3>
                <p>From luxury lodges to budget-friendly camps, we arrange the perfect accommodation that suits your style and budget.</p>
            </div>

            <div class="service-card-page" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon-page">
                    <i class="fas fa-mountain"></i>
                </div>
                <h3>Mountain Climbing</h3>
                <p>Conquer Kilimanjaro and Mount Meru with our experienced guides and porters who prioritize your safety and success.</p>
            </div>

            <div class="service-card-page" data-aos="fade-up" data-aos-delay="400">
                <div class="service-icon-page">
                    <i class="fas fa-umbrella-beach"></i>
                </div>
                <h3>Beach Holidays</h3>
                <p>Relax in Zanzibar's pristine beaches and discover Stone Town's rich history and vibrant spice markets.</p>
            </div>

            <div class="service-card-page" data-aos="fade-up" data-aos-delay="500">
                <div class="service-icon-page">
                    <i class="fas fa-passport"></i>
                </div>
                <h3>Travel Planning</h3>
                <p>Complete trip planning including visas, flights, and itinerary customization to ensure a stress-free experience.</p>
            </div>

            <div class="service-card-page" data-aos="fade-up" data-aos-delay="600">
                <div class="service-icon-page">
                    <i class="fas fa-plane"></i>
                </div>
                <h3>Flight Booking</h3>
                <p>Domestic and international flight bookings to make your journey seamless. Coming soon!</p>
                <a href="{{ route('flight.booking') }}" class="btn-primary" style="margin-top: 25px; display: inline-block; padding: 12px 30px; font-size: 14px; border-radius: 30px; text-decoration: none; transition: all 0.3s;">
                    <i class="fas fa-calendar-check"></i> Book Now (Coming Soon)
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Travel Guide - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-guide {
        background: linear-gradient(rgba(255,107,53,0.8), rgba(255,107,53,0.8)),
            url('https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/chatgpt-image-may-21-2025-12_43_15-am-1.png') center/cover;
        color: white;
        padding: 120px 0 80px;
        text-align: center;
    }
    .page-header-guide h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        margin-bottom: 20px;
    }
    .page-header-guide p {
        font-size: 20px;
        opacity: 0.9;
        max-width: 800px;
        margin: 0 auto;
    }
    .guide-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }
    .guide-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 80px;
    }
    .guide-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
        transition: all 0.3s;
        border: 1px solid #f1f5f9;
    }
    .guide-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
    }
    .guide-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
    }
    .guide-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--accent-color);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 13px;
        box-shadow: 0 5px 15px rgba(255,107,53,0.3);
    }
    .guide-content {
        padding: 35px;
    }
    .guide-content h3 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        color: var(--secondary-color);
        margin-bottom: 15px;
    }
    .guide-content p {
        color: var(--text-light);
        margin-bottom: 25px;
        line-height: 1.8;
        font-size: 16px;
    }
    .guide-highlights {
        list-style: none;
        margin-bottom: 30px;
        padding: 0;
    }
    .guide-highlights li {
        padding: 10px 0;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 15px;
    }
    .guide-highlights li i {
        color: var(--primary-color);
        margin-right: 15px;
        font-size: 18px;
    }
    .guide-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 12px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(212,163,115,0.3);
    }
    .guide-btn:hover {
        transform: translateX(10px);
        box-shadow: 0 8px 25px rgba(212,163,115,0.5);
    }
    .guide-info-section {
        background: white;
        padding: clamp(30px, 8vw, 80px);
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.05);
        margin-bottom: 60px;
        border: 1px solid #f1f5f9;
    }
    .guide-info-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        color: var(--secondary-color);
        margin-bottom: 30px;
        text-align: center;
    }
    .guide-info-section p.intro {
        text-align: center;
        color: var(--text-light);
        font-size: 18px;
        max-width: 800px;
        margin: 0 auto 50px;
    }
    .guide-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    .guide-info-item {
        padding: 30px;
        background: #f8f9fa;
        border-radius: 20px;
        border-left: 5px solid var(--primary-color);
        transition: transform 0.3s;
    }
    .guide-info-item:hover {
        transform: scale(1.05);
    }
    .guide-info-item h4 {
        color: var(--secondary-color);
        font-size: 22px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .guide-info-item p {
        color: var(--text-light);
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 0;
    }
    @media (max-width: 768px) {
        .page-header-guide h1 {
            font-size: 40px;
        }
        .guide-info-section h2 {
            font-size: 32px;
        }
        .guide-content {
            padding: 25px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-guide">
    <div data-aos="fade-up">
        <h1>Complete Travel Guide</h1>
        <p>Your comprehensive guide to exploring Tanzania's wonders. Everything you need to plan the adventure of a lifetime.</p>
    </div>
</section>

<div class="guide-container">
    <div class="guide-grid">
        <div class="guide-card" data-aos="fade-up">
            <div style="position:relative;">
                <img src="https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/chatgpt-image-may-21-2025-12_16_42-am.png" alt="Serengeti Wildlife" class="guide-image">
                <span class="guide-badge">Most Popular</span>
            </div>
            <div class="guide-content">
                <h3>Serengeti National Park</h3>
                <p>Witness millions of wildebeest, zebras, and gazelles in their natural habitat. Home to Africa's most spectacular wildlife concentrations and the iconic Great Migration.</p>
                <ul class="guide-highlights">
                    <li><i class="fas fa-check-circle"></i> Great Wildebeest Migration</li>
                    <li><i class="fas fa-check-circle"></i> Big Five Wildlife Encounters</li>
                    <li><i class="fas fa-check-circle"></i> Hot Air Balloon Safaris</li>
                    <li><i class="fas fa-check-circle"></i> Best Time: June - October</li>
                </ul>
                <a href="{{ route('booking') }}" class="guide-btn">Book Safari <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="guide-card" data-aos="fade-up" data-aos-delay="100">
            <div style="position:relative;">
                <img src="https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/chatgpt-image-may-21-2025-01_03_34-am.png" alt="Ngorongoro Safari" class="guide-image">
                <span class="guide-badge">UNESCO Site</span>
            </div>
            <div class="guide-content">
                <h3>Ngorongoro Crater</h3>
                <p>Descend into the world's largest unbroken volcanic caldera. This natural amphitheater hosts over 25,000 large animals in one of Africa's most unique wildlife viewing areas.</p>
                <ul class="guide-highlights">
                    <li><i class="fas fa-check-circle"></i> Highest Wildlife Density</li>
                    <li><i class="fas fa-check-circle"></i> All Big Five in One Day</li>
                    <li><i class="fas fa-check-circle"></i> Year-Round Destination</li>
                    <li><i class="fas fa-check-circle"></i> Maasai Cultural Encounters</li>
                </ul>
                <a href="{{ route('booking') }}" class="guide-btn">Book Safari <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="guide-card" data-aos="fade-up" data-aos-delay="200">
            <div style="position:relative;">
                <img src="https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/chatgpt-image-may-21-2025-12_43_15-am-1.png" alt="Mount Kilimanjaro" class="guide-image">
                <span class="guide-badge">Epic Adventure</span>
            </div>
            <div class="guide-content">
                <h3>Mount Kilimanjaro</h3>
                <p>Stand on Africa's rooftop at 5,895 meters! Trek through five distinct climate zones from tropical rainforest to arctic summit. No technical climbing skills required.</p>
                <ul class="guide-highlights">
                    <li><i class="fas fa-check-circle"></i> 7 Different Climbing Routes</li>
                    <li><i class="fas fa-check-circle"></i> No Technical Equipment Needed</li>
                    <li><i class="fas fa-check-circle"></i> 5-9 Day Expeditions</li>
                    <li><i class="fas fa-check-circle"></i> Best Time: Jan-Mar, Jun-Oct</li>
                </ul>
                <a href="{{ route('booking') }}" class="guide-btn">Book Climb <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="guide-info-section" data-aos="fade-up">
        <h2><i class="fas fa-info-circle"></i> Essential Travel Information</h2>
        <p class="intro">Everything you need to know before embarking on your Tanzanian adventure. We ensure you're fully prepared for the journey.</p>

        <div class="guide-info-grid">
            <div class="guide-info-item">
                <h4><i class="fas fa-language"></i> Language</h4>
                <p>Swahili is the official language, but English is widely spoken in tourist areas. Learning a few Swahili phrases will greatly enhance your experience.</p>
            </div>
            <div class="guide-info-item">
                <h4><i class="fas fa-plug"></i> Electricity</h4>
                <p>230V, 50Hz. Type D and G plugs (British style). We recommend bringing a universal adapter for all your electronic devices.</p>
            </div>
            <div class="guide-info-item">
                <h4><i class="fas fa-clock"></i> Time Zone</h4>
                <p>East Africa Time (EAT), UTC+3. Tanzania does not observe daylight saving time, making it easy to plan your calls home.</p>
            </div>
            <div class="guide-info-item">
                <h4><i class="fas fa-car"></i> Getting Around</h4>
                <p>We use specially modified 4x4 safari vehicles for national parks. Domestic flights are available to connect major destinations quickly.</p>
            </div>
        </div>
    </div>

    <div class="guide-info-section" data-aos="fade-up">
        <h2><i class="fas fa-calendar-alt"></i> Seasonal Guide</h2>
        <p class="intro">Tanzania offers incredible experiences year-round. Use this guide to choose the perfect time for your specific interests.</p>

        <div class="guide-info-grid">
            <div class="guide-info-item">
                <h4>June - October</h4>
                <p><strong>Dry Season</strong> - Peak safari season with excellent wildlife viewing. Clear skies, minimal rain, and comfortable temperatures for game drives.</p>
            </div>
            <div class="guide-info-item">
                <h4>November - December</h4>
                <p><strong>Short Rains</strong> - Fewer tourists, lush green landscapes, and incredible bird watching. Excellent value for money during this period.</p>
            </div>
            <div class="guide-info-item">
                <h4>January - March</h4>
                <p><strong>Calving Season</strong> - Witness thousands of wildebeest births in southern Serengeti. Predator action is at its peak during this time.</p>
            </div>
            <div class="guide-info-item">
                <h4>April - May</h4>
                <p><strong>Green Season</strong> - Long rains bring verdant scenery. Best rates, intimate experiences, and spectacular photography opportunities.</p>
            </div>
        </div>
    </div>
</div>
@endsection

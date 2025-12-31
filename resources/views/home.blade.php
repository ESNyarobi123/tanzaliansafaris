@extends('layouts.app')

@section('title', "Tanzalian Safari's - Your Gateway to Authentic Tanzanian Adventures")

@section('styles')
<style>
    .hero{
        height: auto;
        min-height: 85svh;
        width: 100%;
        background-color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        position: relative;
        padding: 120px 20px;
        overflow: hidden;
    }

    .hero::before{
        content:"";
        position:absolute;
        inset:0;
        background-image: var(--hero-bg-image);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index:0;
    }

    .hero::after{
        content:"";
        position:absolute;
        inset:0;
        background: linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.3));
        z-index:1;
    }

    @keyframes heroZoomOut{
        from{ transform: scale(1.18); }
        to{ transform: scale(1); }
    }

    .hero-content{
        max-width: 900px;
        padding: 20px;
        position: relative;
        z-index: 2;
    }

    .hero h1{
        font-family: 'Playfair Display', serif;
        font-size: clamp(32px, 5.5vw, 68px);
        line-height: 1.2;
        font-weight: 900;
        margin-bottom: 30px;
        text-shadow: 2px 4px 10px rgba(0,0,0,0.5);
        max-width: 1100px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero p{
        font-size: clamp(15px, 1.8vw, 20px);
        margin-bottom: 50px;
        font-weight: 400;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.4);
        max-width: 850px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .hero-buttons{
        display:flex;
        gap:20px;
        justify-content:center;
        flex-wrap:wrap;
    }

    .btn-primary,.btn-secondary{
        padding: clamp(12px, 2.2vh, 15px) clamp(22px, 4vw, 40px);
        border-radius:30px;
        text-decoration:none;
        font-weight:600;
        font-size: clamp(14px, 1.6vw, 16px);
        transition:all .3s;
        display:inline-block;
    }

    .btn-primary{
        background:var(--accent-color);
        color:#fff;
        box-shadow:0 5px 20px rgba(255,107,53,.4);
    }

    .btn-secondary{
        background: rgba(255,255,255,0.15);
        color: #fff;
        border: 2px solid #fff;
        backdrop-filter: blur(5px);
    }

    .btn-secondary:hover{
        background: #fff;
        color: var(--secondary-color);
    }

    .scroll-down{
        position:absolute;
        bottom: clamp(14px, 3vh, 30px);
        left:50%;
        transform:translateX(-50%);
        animation:bounce 2s infinite;
        z-index:2;
    }

    @keyframes bounce{
        0%,20%,50%,80%,100%{transform:translateX(-50%) translateY(0);}
        40%{transform:translateX(-50%) translateY(-20px);}
        60%{transform:translateX(-50%) translateY(-10px);}
    }

    /* About Section Styles */
    .about-v2{background:#f2f2f2;}
    .about-v2 .about-hero{
        display:flex;
        flex-wrap:wrap;
        gap:40px;
        align-items:center;
        margin-bottom:60px;
    }
    .about-v2 .about-hero-main{flex:1 1 500px;}
    .about-text-bg{
        padding-right:40px;
    }
    .about-v2 .kicker{
        color:var(--primary-color);
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:2px;
        font-size:14px;
        margin-bottom:15px;
        display:block;
    }
    .about-v2 .subtitle{
        font-size:18px;
        color:var(--text-light);
        margin-bottom:30px;
        line-height:1.8;
    }
    .about-v2 .snapshot{
        flex:1 1 400px;
        background:#fff;
        border-radius:15px;
        padding:15px;
        border:1px solid rgba(0,0,0,.05);
        box-shadow:0 10px 30px rgba(0,0,0,0.05);
    }
    .about-v2 .snapshot img{
        width:100%;
        height:280px;
        object-fit:cover;
        border-radius:10px;
        margin-bottom:15px;
    }
    .snapshot-title{
        font-weight:800;
        font-size:14px;
        text-transform:uppercase;
        letter-spacing:1px;
        color:var(--primary-color);
        margin-bottom:15px;
    }
    .stat-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:15px;
    }
    .stat-item{
        background:var(--light-color);
        padding:15px;
        border-radius:12px;
        text-align:center;
    }
    .stat-item strong{
        display:block;
        font-size:22px;
        color:var(--secondary-color);
        margin-bottom:5px;
    }
    .stat-item span{
        font-size:11px;
        color:var(--text-light);
        line-height:1.3;
        display:block;
    }
    .about-v2 .layout{
        display:grid;
        grid-template-columns: 1.8fr 1.2fr;
        gap:40px;
    }

    @media (max-width: 992px) {
        .about-v2 .layout {
            grid-template-columns: 1fr;
        }
        .about-v2 .about-hero {
            flex-direction: column;
        }
        .about-text-bg {
            padding-right: 0;
            margin-bottom: 30px;
        }
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 36px;
        }
        .section-title {
            font-size: 28px;
        }
        .about-v2 .title {
            font-size: 26px;
            line-height: 1.2;
        }
        .about-v2 .subtitle {
            font-size: 15px;
            margin-bottom: 20px;
        }
        .about-v2 .about-hero {
            gap: 20px;
        }
        .service-card {
            padding: 25px;
        }
        .service-icon {
            font-size: 36px;
            margin-bottom: 15px;
        }
        .about-v2 .snapshot {
            padding: 15px;
        }
    }
    .about-v2 .card{
        background:#ffffff;
        border-radius:18px;
        padding:22px 22px;
        border:1px solid rgba(0,0,0,.08);
        box-shadow:0 14px 35px rgba(0,0,0,.08);
    }
    .about-v2 .card + .card{margin-top:18px;}
    .about-v2 .card-title{
        font-size:18px;
        font-weight:800;
        color:var(--secondary-color);
    }
    .about-v2 .pill-row{
        display:flex;
        flex-wrap:wrap;
        gap:8px;
        margin-top:10px;
    }
    .about-v2 .pill{
        padding:6px 12px;
        border-radius:999px;
        font-size:12px;
        border:1px solid rgba(0,0,0,.10);
        background:var(--light-color);
        color:var(--secondary-color);
        font-weight:600;
    }
    .about-v2 .why-grid{
        margin-top:14px;
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
        gap:14px;
    }
    .about-v2 .why-card{
        background:var(--light-color);
        border:1px solid rgba(0,0,0,.06);
        border-radius:16px;
        padding:14px 14px;
    }
    .about-v2 .why-card h4{
        font-size:14px;
        margin-bottom:6px;
        display:flex;
        align-items:center;
        gap:8px;
        color:var(--secondary-color);
        font-weight:800;
    }
    .about-v2 .why-card h4 i{color:var(--accent-color);}
    .about-v2 .why-card p{
        font-size:13px;
        color:var(--text-light);
        line-height:1.7;
        margin:0;
    }
    .about-v2 .values-list{
        list-style:none;
        margin:0;
        padding:0;
    }
    .about-v2 .values-list li{
        display:flex;
        gap:10px;
        padding:10px 0;
        border-bottom:1px dashed rgba(0,0,0,.10);
        color:var(--text-light);
        font-size:14px;
        line-height:1.7;
    }
    .about-v2 .values-list i{
        color:var(--accent-color);
        margin-top:3px;
        font-size:14px;
    }
    .about-v2 .mission-box{
        margin-top:16px;
        padding:14px 14px;
        border-radius:16px;
        border:1px dashed rgba(212,163,115,.9);
        background:rgba(212,163,115,.08);
    }
    .about-v2 .mission-box h4{
        font-size:15px;
        color:var(--secondary-color);
        margin-bottom:6px;
        font-weight:900;
    }
    .about-v2 .mission-box h4 i{color:var(--accent-color);margin-right:6px;}
    .about-v2 .mission-box p{
        margin:0;
        color:var(--text-light);
        font-size:14px;
        line-height:1.75;
    }

    /* Services Section */
    .services-section{background:var(--light-color);}
    .services-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(300px,1fr));
        gap:30px;
        margin-top:50px;
    }
    .service-card{
        background:#fff;
        padding:40px;
        border-radius:20px;
        text-align:center;
        transition:all .3s;
        box-shadow:0 5px 20px rgba(0,0,0,.08);
    }
    .service-card:hover{
        transform:translateY(-10px);
        box-shadow:0 15px 40px rgba(0,0,0,.15);
    }
    .service-icon{font-size:50px;color:var(--primary-color);margin-bottom:20px;}
    .service-card h3{font-size:24px;margin-bottom:15px;color:var(--secondary-color);}
    .service-card p{color:var(--text-light);line-height:1.8;}

    /* Gallery Section */
    #gallery{}
    .gallery-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(350px,1fr));
        gap:20px;
    }
    .gallery-item{
        position:relative;
        overflow:hidden;
        border-radius:15px;
        height:400px;
        cursor:pointer;
    }
    .gallery-item img{
        width:100%;
        height:100%;
        object-fit:cover;
        transition:transform .5s;
    }
    .gallery-item:hover img{transform:scale(1.1);}
    .gallery-overlay{
        position:absolute;
        bottom:0;
        left:0;
        right:0;
        background:linear-gradient(transparent, rgba(0,0,0,.8));
        color:#fff;
        padding:30px;
        transform:translateY(100%);
        transition:transform .3s;
    }
    .gallery-item:hover .gallery-overlay{transform:translateY(0);}
    .gallery-book-btn{
        margin-top:12px;
        display:inline-block;
        padding:10px 22px;
        border-radius:30px;
        background:var(--accent-color);
        color:#fff;
        font-size:14px;
        font-weight:600;
        text-decoration:none;
        box-shadow:0 4px 14px rgba(0,0,0,.45);
        transition:all .25s;
    }

    /* Testimonials */
    .testimonials-section{background:var(--secondary-color); color:#fff;}
    .testimonials-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(300px,1fr));
        gap:30px;
        margin-top:50px;
    }
    .testimonial-card{
        background:rgba(255,255,255,.1);
        padding:40px;
        border-radius:20px;
        backdrop-filter:blur(10px);
    }
    .stars{color:#ffd700;font-size:20px;margin-bottom:20px;}
    .testimonial-text{font-style:italic;margin-bottom:20px;line-height:1.8;}
    .testimonial-author{display:flex;align-items:center;gap:15px;}
    .author-avatar{
        width:50px;height:50px;border-radius:50%;
        background:var(--primary-color);
        display:flex;align-items:center;justify-content:center;
        font-weight:700;font-size:20px;
    }

    /* CTA Section */
    .cta-section{
        background:linear-gradient(rgba(44,85,48,.95), rgba(44,85,48,.95)),
            url('{{ asset('assets/img/cta-bg.jpg') }}') center/cover;
        color:#fff;
        text-align:center;
    }
    .cta-section h2{font-family:'Playfair Display',serif;font-size: clamp(32px, 8vw, 56px);margin-bottom:20px;}
    .cta-section p{font-size:20px;margin-bottom:40px;}

    .section-header{text-align:center;margin-bottom:60px;}
    .section-subtitle{
        color:var(--primary-color);
        font-weight:600;
        font-size:16px;
        text-transform:uppercase;
        letter-spacing:2px;
        margin-bottom:10px;
    }
    .section-title{
        font-family:'Playfair Display',serif;
        font-size: clamp(28px, 5vw, 48px);
        font-weight:900;
        color:var(--secondary-color);
        margin-bottom:20px;
    }
    .section-description{
        font-size:18px;
        color:var(--text-light);
        max-width:700px;
        margin:0 auto;
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="home" style="--hero-bg-image: url('{{ asset($homeContent['hero_image'] ?? 'assets/img/hero-bg.jpg') }}');">
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1>Welcome to Tanzalian Safaris Discover Tanzania. Experience the Wild. Travel in Style.</h1>
            <p>Tanzalian Safaris is a premier tour operator dedicated to delivering unforgettable African experiences. From the vast plains of the Serengeti to the white-sand beaches of Zanzibar, we design trips that match your budget and vibrant culture of Tanzania. Let us create an unforgettable experience tailored just for you.</p>
            <div class="hero-buttons">
                <a href="{{ route('booking') }}" class="btn-primary">
                    <i class="fas fa-calendar-check"></i> Book Now
                </a>
                <a href="{{ route('gallery') }}" class="btn-secondary">
                    <i class="fas fa-images"></i> Gallery Items
                </a>
                <a href="#about" class="btn-secondary">
                    <i class="fas fa-play-circle"></i> Browse Video
                </a>
            </div>
        </div>
        <div class="scroll-down">
            <i class="fas fa-chevron-down" style="color:white;font-size:30px;"></i>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-v2">
        <div class="container">
            <div class="about-hero" data-aos="fade-up" data-aos-duration="1000">
                <div class="about-hero-main">
                    <div class="about-text-bg">
                        <div class="kicker">{{ $aboutPageContent['about_kicker'] ?? "About Why Travel with Tanzalian Safari's" }}</div>
                        <h2 class="title">{{ $aboutPageContent['about_title'] ?? "About Why Travel with Tanzalian Safari's" }}</h2>
                        <p class="subtitle">
                            {{ $aboutPageContent['about_subtitle'] ?? ($aboutPageContent['about_paragraph1'] ?? 'We are a proudly Tanzanian-owned travel company dedicated to crafting memorable journeys across our beautiful country.') }}
                        </p>
                        <a href="{{ route('booking') }}" class="btn-primary">
                            <i class="fas fa-calendar-check"></i> {{ $aboutPageContent['about_button_text'] ?? 'Book Now' }}
                        </a>
                    </div>
                </div>

                <aside class="snapshot" data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset($aboutPageContent['about_image'] ?? 'assets/img/about-bg.jpg') }}" alt="About image">
                    <div class="snapshot-title">{{ $aboutPageContent['about_snapshot_title'] ?? 'Quick Snapshot' }}</div>
                    <div class="stat-grid">
                        <div class="stat-item">
                            <strong>{{ $aboutPageContent['about_stat_1_value'] ?? '10+' }}</strong>
                            <span>{{ $aboutPageContent['about_stat_1_label'] ?? 'National parks & reserves covered' }}</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ $aboutPageContent['about_stat_2_value'] ?? '5★' }}</strong>
                            <span>{{ $aboutPageContent['about_stat_2_label'] ?? 'Personalized, guest-first service' }}</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ $aboutPageContent['about_stat_3_value'] ?? '24/7' }}</strong>
                            <span>{{ $aboutPageContent['about_stat_3_label'] ?? 'On-ground support in Tanzania' }}</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ $aboutPageContent['about_stat_4_value'] ?? '100%' }}</strong>
                            <span>{{ $aboutPageContent['about_stat_4_label'] ?? 'Tailor-made itineraries' }}</span>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="layout">
                <div>
                    <article class="card" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-header">
                            <h3 class="card-title">{{ $aboutPageContent['about_who_title'] ?? 'Who We Are' }}</h3>
                        </div>
                        <p>{{ $aboutPageContent['about_paragraph1'] ?? "Tanzalian Safari's is a Tanzania-based tour operator that specializes in authentic African experiences." }}</p>
                        <p>{{ $aboutPageContent['about_paragraph2'] ?? "From the vast plains of the Serengeti to the white-sand beaches of Zanzibar, we design trips that match your budget." }}</p>
                        <div class="pill-row">
                            @foreach ($pills as $pill)
                                <span class="pill">{{ $pill }}</span>
                            @endforeach
                        </div>
                    </article>

                    <article class="card" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="why-title">{{ $aboutPageContent['about_why_title'] ?? 'What Makes Us Special' }}</h3>
                        <div class="why-grid">
                            <div class="why-card">
                                <h4><i class="fa-solid fa-user-check"></i> {{ $aboutPageContent['about_why_1_title'] ?? 'Local Expertise' }}</h4>
                                <p>{{ $aboutPageContent['about_why_1_text'] ?? 'Our guides know the parks by heart.' }}</p>
                            </div>
                            <div class="why-card">
                                <h4><i class="fa-solid fa-shield-heart"></i> {{ $aboutPageContent['about_why_2_title'] ?? 'Safe & Reliable' }}</h4>
                                <p>{{ $aboutPageContent['about_why_2_text'] ?? 'We prioritize safety with well-maintained vehicles.' }}</p>
                            </div>
                        </div>
                    </article>
                </div>

                <aside>
                    <article class="card" data-aos="fade-up" data-aos-delay="300">
                        <div class="mission-box">
                            <h4><i class="fa-solid fa-bullseye"></i> {{ $aboutPageContent['about_mission_title'] ?? 'Our Mission' }}</h4>
                            <p>{{ $aboutPageContent['mission_text'] ?? 'To provide safe, reliable, and inspiring travel experiences.' }}</p>
                        </div>
                    </article>
                </aside>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p class="section-subtitle">Our Services</p>
                <h2 class="section-title">What We Offer</h2>
            </div>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-icon"><i class="fas fa-binoculars"></i></div>
                    <h3>Safari Tours</h3>
                    <p>Experience the Big Five in Serengeti, Ngorongoro Crater, and more.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-icon"><i class="fas fa-car"></i></div>
                    <h3>Car Rentals</h3>
                    <p>4x4 vehicles and professional guided drivers.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-icon"><i class="fas fa-hotel"></i></div>
                    <h3>Hotel & Lodge Bookings</h3>
                    <p>Luxury lodges and boutique hotels across Tanzania.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-icon"><i class="fas fa-plane-arrival"></i></div>
                    <h3>Airport Transfers</h3>
                    <p>Reliable and prompt airport pickup and drop-off services.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-icon"><i class="fas fa-map-marked-alt"></i></div>
                    <h3>Custom Packages</h3>
                    <p>Personalized itineraries tailored to your interests and budget.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-icon"><i class="fas fa-users"></i></div>
                    <h3>Cultural Tours</h3>
                    <p>Authentic experiences with local tribes and communities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p class="section-subtitle">Gallery</p>
                <h2 class="section-title">Discover Tanzania</h2>
            </div>
            <div class="gallery-grid">
                @foreach ($galleryItems as $item)
                    <div class="gallery-item" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <img src="{{ asset('uploads/gallery/' . $item->image_path) }}" alt="{{ $item->title }}">
                        <div class="gallery-overlay">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->subtitle }}</p>
                            <a href="{{ route('booking') }}" class="gallery-book-btn">Book Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p class="section-subtitle">Testimonials</p>
                <h2 class="section-title">What Our Travelers Say</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">Our Tanzania safari was absolutely incredible! Highly recommended!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">JD</div>
                        <div class="author-info"><h4>John Doe</h4><p>USA</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="destinations">
        <div class="container" data-aos="zoom-in">
            <p class="section-subtitle">{{ $pageContent['cta_subtitle'] ?? 'Ready for Adventure?' }}</p>
            <h2>{{ $pageContent['cta_title'] ?? 'Start Your Tanzanian Journey Today' }}</h2>
            <p>{{ $pageContent['cta_text'] ?? 'Let us create an unforgettable experience tailored just for you' }}</p>
            <a href="{{ route('booking') }}" class="btn-primary">Book Your Trip</a>
        </div>
    </section>
@endsection

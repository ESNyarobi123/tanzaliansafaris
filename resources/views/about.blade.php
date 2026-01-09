@extends('layouts.app')

@section('title', 'About Tanzalian Safari\'s - Authentic Tanzanian Adventures')

@section('styles')
<style>
    /* =========================
       ABOUT PAGE SLIDER HERO
       - Smooth rotating slider
       - CTA buttons route correctly
       ========================= */
    
    .page-hero-about{
        position: relative;
        padding:80px 0 60px;
        border-bottom:1px solid rgba(148,163,184,.25);
        background:radial-gradient(circle at top,rgba(15,118,110,.4),transparent 55%);
        min-height: 500px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    /* Background slides for About page */
    .about-hero__bg{
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        z-index: 0;
        will-change: opacity;
        animation-duration: 18s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        animation-fill-mode: both;
        transition: opacity 1s ease-in-out;
    }

    .about-hero__bg--1{ 
        opacity: 1;
        background-image: url('https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: aboutSlide1;
    }
    .about-hero__bg--2{
        background-image: url('https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: aboutSlide2;
    }
    .about-hero__bg--3{
        background-image: url('https://images.unsplash.com/photo-1523805009345-7448845a9e53?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: aboutSlide3;
    }
    .about-hero__bg--4{
        background-image: url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: aboutSlide4;
    }

    /* Gradient overlay */
    .page-hero-about::before{
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top, rgba(15,118,110,.5), transparent 55%), linear-gradient(rgba(0,0,0,.2), rgba(0,0,0,.3));
        z-index: 1;
        pointer-events: none;
    }

    /* Crossfade animations for About slider */
    @keyframes aboutSlide1{ 0%,20%{opacity:1;} 25%,100%{opacity:0;} }
    @keyframes aboutSlide2{ 0%,20%{opacity:0;} 25%,45%{opacity:1;} 50%,100%{opacity:0;} }
    @keyframes aboutSlide3{ 0%,45%{opacity:0;} 50%,70%{opacity:1;} 75%,100%{opacity:0;} }
    @keyframes aboutSlide4{ 0%,70%{opacity:0;} 75%,96%{opacity:1;} 100%{opacity:0;} }
    .page-hero-inner-about{
        position: relative;
        z-index: 2;
        display:flex;
        flex-wrap:wrap;
        gap:30px;
        align-items:flex-start;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }
    .page-hero-main-about{
        flex:1 1 100%;
    }
    .page-kicker-about{
        font-size:14px;
        text-transform:uppercase;
        letter-spacing:.18em;
        color:var(--primary-color);
        margin-bottom:10px;
        font-weight: 700;
    }
    .page-title-about{
        font-family:'Playfair Display',serif;
        font-size:42px;
        line-height:1.2;
        margin-bottom:15px;
        color: var(--secondary-color);
    }
    .page-subtitle-about{
        font-size:18px;
        color:var(--text-light);
        max-width:600px;
        line-height: 1.6;
    }
    .page-hero-stat-about{
        flex:1 1 100%;
        background:rgba(15,23,42,.85);
        backdrop-filter: blur(10px);
        border-radius:20px;
        padding:25px;
        border:1px solid rgba(255,255,255,0.1);
        box-shadow:0 20px 50px rgba(0,0,0,0.4);
        color: white;
        transition: transform 0.3s;
    }
    
    .page-hero-stat-about:hover{
        transform: translateY(-5px);
    }
    .page-hero-stat-title-about{
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.18em;
        color:var(--primary-color);
        margin-bottom:15px;
        font-weight: 700;
    }
    .stat-grid-about{
        display:grid;
        grid-template-columns:repeat(2, 1fr);
        gap:20px;
    }
    .stat-item-about strong{
        display:block;
        font-size:24px;
        font-weight:800;
        color: white;
    }
    .stat-item-about span{
        font-size:12px;
        color:rgba(255,255,255,0.7);
    }
    .main-about{
        padding:60px 0;
        background: #f8f9fa;
    }
    .layout-about{
        display:grid;
        grid-template-columns: 1fr;
        gap:40px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (min-width: 992px) {
        .layout-about {
            grid-template-columns: 2fr 1fr;
        }
        .page-hero-main-about {
            flex: 1;
        }
        .page-hero-stat-about {
            flex: 0 0 350px;
        }
    }
    .card-about{
        background: white;
        border-radius:20px;
        padding:40px;
        border:1px solid rgba(0,0,0,0.05);
        box-shadow:0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    .card-header-about{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }
    .card-title-about{
        font-size:24px;
        font-weight:800;
        color: var(--secondary-color);
        font-family: 'Playfair Display', serif;
    }
    .card-tag-about{
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.16em;
        color:var(--primary-color);
        font-weight: 700;
    }
    .card-about p{
        font-size:16px;
        line-height:1.8;
        color:var(--text-light);
        margin-bottom:20px;
    }
    .pill-row-about{
        display:flex;
        flex-wrap:wrap;
        gap:10px;
        margin-top:20px;
    }
    .pill-about{
        padding:8px 20px;
        border-radius:999px;
        font-size:13px;
        border:1px solid rgba(0,0,0,0.1);
        color:var(--secondary-color);
        background:#f1f5f9;
        font-weight: 600;
    }
    .why-title-wrap-about{
        margin-bottom:30px;
    }
    .why-subtitle-about{
        font-size:14px;
        text-transform:uppercase;
        letter-spacing:.18em;
        color:var(--primary-color);
        font-weight: 700;
    }
    .why-title-about{
        font-family:'Playfair Display',serif;
        font-size:32px;
        color: var(--secondary-color);
    }
    .why-grid-about{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
        gap:20px;
    }
    .why-card-about{
        background:#f8f9fa;
        border-radius:15px;
        padding:25px;
        border:1px solid rgba(0,0,0,0.05);
        transition: transform 0.3s;
    }
    .why-card-about:hover {
        transform: translateY(-5px);
    }
    .why-card-about h4{
        font-size:16px;
        margin-bottom:10px;
        display:flex;
        align-items:center;
        gap:10px;
        color: var(--secondary-color);
        font-weight: 800;
    }
    .why-card-about h4 i{
        color:var(--accent-color);
    }
    .why-card-about p{
        color:var(--text-light);
        line-height:1.6;
        font-size:14px;
        margin: 0;
    }
    .side-section-title-about{
        font-size:14px;
        text-transform:uppercase;
        letter-spacing:.18em;
        color:var(--primary-color);
        margin-bottom:15px;
        font-weight: 700;
    }
    .values-list-about{
        list-style:none;
        padding: 0;
    }
    .values-list-about li{
        font-size:15px;
        padding:15px 0;
        border-bottom:1px dashed rgba(0,0,0,0.1);
        display:flex;
        align-items:flex-start;
        gap:15px;
        color:var(--text-light);
    }
    .values-list-about li:last-child{border-bottom:none;}
    .values-list-about i{
        margin-top:5px;
        color:var(--accent-color);
        font-size:14px;
    }
    .mission-box-about{
        margin-top:30px;
        padding:25px;
        border-radius:15px;
        border:1px dashed var(--primary-color);
        background:rgba(212,163,115,0.05);
    }

    /* About CTA Buttons */
    .about-cta-buttons{
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .about-cta-btn{
        padding: 12px 25px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .about-cta-btn-primary{
        background: var(--accent-color);
        color: #fff;
        box-shadow: 0 5px 20px rgba(255,107,53,0.4);
    }
    
    .about-cta-btn-primary:hover{
        background: #e65a2b;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255,107,53,0.5);
    }
    
    .about-cta-btn-secondary{
        background: rgba(255,255,255,0.15);
        color: #fff;
        border: 2px solid #fff;
        backdrop-filter: blur(5px);
    }
    
    .about-cta-btn-secondary:hover{
        background: #fff;
        color: var(--secondary-color);
        transform: translateY(-2px);
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce){
        .about-hero__bg{animation:none;opacity:0;}
        .about-hero__bg--1{opacity:1;}
    }
    .mission-box-about h4{
        font-size:18px;
        margin-bottom:10px;
        color: var(--secondary-color);
        font-weight: 800;
    }
    .mission-box-about p{
        color:var(--text-light);
        line-height:1.7;
        margin: 0;
        font-size: 15px;
    }
</style>
@endsection

@section('content')
<section class="page-hero-about">
    <!-- Background Slides for About Page -->
    <div class="about-hero__bg about-hero__bg--1" aria-hidden="true"></div>
    <div class="about-hero__bg about-hero__bg--2" aria-hidden="true"></div>
    <div class="about-hero__bg about-hero__bg--3" aria-hidden="true"></div>
    <div class="about-hero__bg about-hero__bg--4" aria-hidden="true"></div>

    <div class="page-hero-inner-about">
        <div class="page-hero-main-about">
            <div class="page-kicker-about">{{ $aboutContent['about_kicker'] ?? 'About Tanzalian Safari\'s' }}</div>
            <h1 class="page-title-about">{{ $aboutContent['about_title'] ?? 'Your Gateway to Authentic Tanzanian Adventures' }}</h1>
            <p class="page-subtitle-about">
                {{ $aboutContent['about_subtitle'] ?? 'We are a proudly Tanzanian-owned travel company dedicated to crafting memorable journeys across our beautiful country – from wildlife safaris to turquoise island escapes.' }}
            </p>
            <div class="about-cta-buttons">
                <a href="{{ route('booking') }}" class="about-cta-btn about-cta-btn-primary">
                    <i class="fas fa-calendar-check"></i> Book Your Safari
                </a>
                <a href="{{ route('packages') }}" class="about-cta-btn about-cta-btn-secondary">
                    <i class="fas fa-search"></i> Explore Packages
                </a>
                <a href="{{ route('home') }}#contact" class="about-cta-btn about-cta-btn-secondary">
                    <i class="fas fa-envelope"></i> Contact Us
                </a>
            </div>
        </div>

        <aside class="page-hero-stat-about" data-aos="fade-left">
            <div class="page-hero-stat-title-about">Quick Snapshot</div>
            <div class="stat-grid-about">
                <div class="stat-item-about">
                    <strong>{{ $aboutContent['about_stat_1_value'] ?? '10+' }}</strong>
                    <span>{{ $aboutContent['about_stat_1_label'] ?? 'National parks & reserves covered' }}</span>
                </div>
                <div class="stat-item-about">
                    <strong>{{ $aboutContent['about_stat_2_value'] ?? '5★' }}</strong>
                    <span>{{ $aboutContent['about_stat_2_label'] ?? 'Personalized, guest-first service' }}</span>
                </div>
                <div class="stat-item-about">
                    <strong>{{ $aboutContent['about_stat_3_value'] ?? '24/7' }}</strong>
                    <span>{{ $aboutContent['about_stat_3_label'] ?? 'On-ground support in Tanzania' }}</span>
                </div>
                <div class="stat-item-about">
                    <strong>{{ $aboutContent['about_stat_4_value'] ?? '100%' }}</strong>
                    <span>{{ $aboutContent['about_stat_4_label'] ?? 'Tailor-made itineraries' }}</span>
                </div>
            </div>
        </aside>
    </div>
</section>

<main class="main-about">
    <div class="layout-about">
        <!-- LEFT: ABOUT CONTENT -->
        <section>
            <article class="card-about" data-aos="fade-up">
                <div class="card-header-about">
                    <h2 class="card-title-about">{{ $aboutContent['about_who_title'] ?? 'Who We Are' }}</h2>
                    <span class="card-tag-about">About Us</span>
                </div>
                <p>{{ $aboutContent['about_paragraph1'] ?? 'Tanzalian Safari\'s is a Tanzania-based tour operator that specializes in authentic African experiences. Our team is made up of local experts who understand the land, culture, and rhythm of Tanzania.' }}</p>
                <p>{{ $aboutContent['about_paragraph2'] ?? 'From the vast plains of the Serengeti and the crater of Ngorongoro to the snowy peak of Mount Kilimanjaro and the white-sand beaches of Zanzibar, we design trips that match your budget, interests, and travel dates.' }}</p>
                <div class="pill-row-about">
                    @foreach ($pills as $pill)
                        <span class="pill-about">{{ $pill }}</span>
                    @endforeach
                </div>
            </article>

            <article class="card-about" data-aos="fade-up" data-aos-delay="100">
                <div class="why-title-wrap-about">
                    <div class="why-subtitle-about">Why Choose Us</div>
                    <h2 class="why-title-about">{{ $aboutContent['about_why_title'] ?? 'What Makes Us Special' }}</h2>
                </div>

                <div class="why-grid-about">
                    <div class="why-card-about">
                        <h4><i class="fa-solid fa-user-check"></i> {{ $aboutContent['about_why_1_title'] ?? 'Local Expertise' }}</h4>
                        <p>{{ $aboutContent['about_why_1_text'] ?? 'Our guides and support teams are Tanzanians who know the parks, hidden routes, and best seasons by heart.' }}</p>
                    </div>
                    <div class="why-card-about">
                        <h4><i class="fa-solid fa-shield-heart"></i> {{ $aboutContent['about_why_2_title'] ?? 'Safe & Reliable' }}</h4>
                        <p>{{ $aboutContent['about_why_2_text'] ?? 'We prioritize safety with well-maintained vehicles, licensed guides, and carefully inspected partner accommodations.' }}</p>
                    </div>
                    <div class="why-card-about">
                        <h4><i class="fa-solid fa-leaf"></i> {{ $aboutContent['about_why_3_title'] ?? 'Responsible Travel' }}</h4>
                        <p>{{ $aboutContent['about_why_3_text'] ?? 'We work with locally-owned lodges and support community initiatives, ensuring tourism benefits local families.' }}</p>
                    </div>
                    <div class="why-card-about">
                        <h4><i class="fa-solid fa-handshake-angle"></i> {{ $aboutContent['about_why_4_title'] ?? 'Personal Support' }}</h4>
                        <p>{{ $aboutContent['about_why_4_text'] ?? 'From your first enquiry to the day you fly back home, our team is always reachable for questions and support.' }}</p>
                    </div>
                </div>
            </article>
        </section>

        <!-- RIGHT: VALUES & MISSION -->
        <aside>
            <section class="card-about" data-aos="fade-left">
                <div class="side-section-title-about">Our Core Values</div>
                <ul class="values-list-about">
                    <li>
                        <i class="fa-solid fa-compass"></i>
                        <span><strong>Authenticity:</strong> We showcase real Tanzania – its nature, people, and stories.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-people-roof"></i>
                        <span><strong>Hospitality:</strong> Guests are welcomed as friends and leave as family.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-earth-africa"></i>
                        <span><strong>Respect:</strong> For wildlife, local communities, and the environment.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-star"></i>
                        <span><strong>Excellence:</strong> We constantly refine our services based on feedback.</span>
                    </li>
                </ul>

                <div class="mission-box-about">
                    <h4><i class="fa-solid fa-bullseye"></i> {{ $aboutContent['about_mission_title'] ?? 'Our Mission' }}</h4>
                    <p>{{ $aboutContent['mission_text'] ?? 'To provide safe, reliable, and inspiring travel experiences that celebrate Tanzania’s wildlife, cultures, and landscapes – while empowering local communities.' }}</p>
                </div>
            </section>
        </aside>
    </div>
</main>
@endsection

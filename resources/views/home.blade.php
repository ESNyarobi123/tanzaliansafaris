@extends('layouts.app')

@section('title', "Tanzalian Safari's - Your Gateway to Authentic Tanzanian Adventures")

@section('styles')
<style>
    /* =========================
       HERO SLIDESHOW WITH ANIMATED TEXT
       - Background slideshow with crossfade
       - Per-letter wave animation on heading
       - 9:16 aspect ratio support
       - Responsive with quality preservation
       ========================= */
    
    .hero{
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
        /* Fallback image */
        background-image: url('{{ asset($homeContent['hero_image'] ?? 'assets/img/hero-bg.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-color: #000;
        /* Aspect ratio - Mobile first (9:16 portrait) */
        aspect-ratio: 9/16;
        max-height: 100vh;
    }

    /* Tablet - landscape orientation */
    @media (min-width: 768px) and (orientation: landscape) {
        .hero {
            aspect-ratio: 16/9;
            min-height: 90vh;
        }
    }

    /* Desktop - wider format */
    @media (min-width: 1024px) {
        .hero {
            aspect-ratio: 21/9;
            min-height: 90vh;
        }
    }

    /* Large screens - maintain quality */
    @media (min-width: 1920px) {
        .hero {
            aspect-ratio: 21/9;
            min-height: 85vh;
        }
    }

    /* Background slides */
    .hero__bg{
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        z-index: 0;
        will-change: opacity;
        animation-duration: 25s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        animation-fill-mode: both;
        /* Preserve quality with responsive cropping */
        image-rendering: -webkit-optimize-contrast;
        image-rendering: auto;
        backface-visibility: hidden;
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
    }

    /* Responsive background sizing */
    @media (max-width: 767px) {
        .hero__bg {
            background-size: cover;
            background-position: center;
            /* Better cropping for 9:16 on mobile */
            object-position: center center;
        }
    }

    @media (min-width: 768px) {
        .hero__bg {
            background-size: cover;
            background-position: center;
        }
    }

    @media (min-width: 1920px) {
        .hero__bg {
            background-size: cover;
            background-position: center;
            /* High DPI support */
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
        }
    }

    /* Force first slide visible immediately */
    .hero__bg--1{ opacity: 1; }

    .hero__bg--1{
        background-image: url('{{ asset($homeContent['hero_image'] ?? 'assets/img/hero-bg.jpg') }}');
        animation-name: slide1;
    }
    .hero__bg--2{
        background-image: url('https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: slide2;
    }
    .hero__bg--3{
        background-image: url('https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: slide3;
    }
    .hero__bg--4{
        background-image: url('https://images.unsplash.com/photo-1523805009345-7448845a9e53?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: slide4;
    }
    .hero__bg--5{
        background-image: url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        animation-name: slide5;
    }

    /* Crossfade windows - Slower transitions for 20s cycle */
    @keyframes slide1{ 0%,16%{opacity:1;} 20%,100%{opacity:0;} }
    @keyframes slide2{ 0%,15%{opacity:0;} 19%,31%{opacity:1;} 35%,100%{opacity:0;} }
    @keyframes slide3{ 0%,35%{opacity:0;} 39%,51%{opacity:1;} 55%,100%{opacity:0;} }
    @keyframes slide4{ 0%,55%{opacity:0;} 59%,71%{opacity:1;} 75%,100%{opacity:0;} }
    @keyframes slide5{ 0%,75%{opacity:0;} 79%,96%{opacity:1;} 100%{opacity:0;} }

    /* Gradient overlay */
    .hero::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(rgba(0,0,0,.4), rgba(0,0,0,.5));
        z-index: 1;
        pointer-events: none;
    }

    /* Content */
    .hero-content{
        position: relative;
        z-index: 2;
        padding: 0 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
    }

    /* Animated Heading */
    .headline{
        margin: 0 0 1.5rem;
        font-size: clamp(2rem, 4.5vw + 0.5rem, 5.5rem);
        font-weight: 800;
        line-height: 1.05;
        color: #fff;
        text-shadow: 0 4px 14px rgba(0,0,0,.45);
        font-family: 'Playfair Display', serif;
    }

    /* Word spacing fix using flex + gap */
    .flag-heading{
        display: inline-flex;
        flex-wrap: wrap;
        gap: 0.28em;
        justify-content: center;
        white-space: normal;
        font-kerning: normal;
        word-break: keep-all;
        line-height: 1.1;
        text-align: center;
    }

    .flag-heading .word{
        display: inline-flex;
        gap: 0.12em;
        align-items: baseline;
    }
    
    /* Larger gap after periods - using class */
    .flag-heading .word.after-period{
        margin-right: 0.45em;
    }

    .flag-heading .flag-char{
        display: inline-block;
        line-height: 1;
        text-shadow: 0 4px 14px rgba(0,0,0,.65);
        animation: blueWhiteWave 3s linear infinite;
        transition: transform 0.1s ease;
    }

    .flag-heading .flag-char:hover{
        transform: scale(1.1) translateY(-3px);
    }

    /* Wave animation - blue and white */
    @keyframes blueWhiteWave{
        0%, 40%{ color: #ffffff; text-shadow: 0 4px 14px rgba(0,0,0,.65), 0 0 20px rgba(255,255,255,0.3); }
        50%, 90%{ color: #00A3DD; text-shadow: 0 4px 14px rgba(0,0,0,.65), 0 0 25px rgba(0,163,221,0.5); }
        100%{ color: #ffffff; text-shadow: 0 4px 14px rgba(0,0,0,.65), 0 0 20px rgba(255,255,255,0.3); }
    }

    /* Stagger delays for each character (count all letters in heading) */
    .flag-heading .flag-char:nth-child(1){animation-delay:0s;}
    .flag-heading .flag-char:nth-child(2){animation-delay:.07s;}
    .flag-heading .flag-char:nth-child(3){animation-delay:.14s;}
    .flag-heading .flag-char:nth-child(4){animation-delay:.21s;}
    .flag-heading .flag-char:nth-child(5){animation-delay:.28s;}
    .flag-heading .flag-char:nth-child(6){animation-delay:.35s;}
    .flag-heading .flag-char:nth-child(7){animation-delay:.42s;}
    .flag-heading .flag-char:nth-child(8){animation-delay:.49s;}
    .flag-heading .flag-char:nth-child(9){animation-delay:.56s;}
    .flag-heading .flag-char:nth-child(10){animation-delay:.63s;}
    .flag-heading .flag-char:nth-child(11){animation-delay:.70s;}
    .flag-heading .flag-char:nth-child(12){animation-delay:.77s;}
    .flag-heading .flag-char:nth-child(13){animation-delay:.84s;}
    .flag-heading .flag-char:nth-child(14){animation-delay:.91s;}
    .flag-heading .flag-char:nth-child(15){animation-delay:.98s;}
    .flag-heading .flag-char:nth-child(16){animation-delay:1.05s;}
    .flag-heading .flag-char:nth-child(17){animation-delay:1.12s;}
    .flag-heading .flag-char:nth-child(18){animation-delay:1.19s;}
    .flag-heading .flag-char:nth-child(19){animation-delay:1.26s;}
    .flag-heading .flag-char:nth-child(20){animation-delay:1.33s;}
    .flag-heading .flag-char:nth-child(21){animation-delay:1.40s;}
    .flag-heading .flag-char:nth-child(22){animation-delay:1.47s;}
    .flag-heading .flag-char:nth-child(23){animation-delay:1.54s;}
    .flag-heading .flag-char:nth-child(24){animation-delay:1.61s;}
    .flag-heading .flag-char:nth-child(25){animation-delay:1.68s;}
    .flag-heading .flag-char:nth-child(26){animation-delay:1.75s;}
    .flag-heading .flag-char:nth-child(27){animation-delay:1.82s;}
    .flag-heading .flag-char:nth-child(28){animation-delay:1.89s;}
    .flag-heading .flag-char:nth-child(29){animation-delay:1.96s;}
    .flag-heading .flag-char:nth-child(30){animation-delay:2.03s;}
    .flag-heading .flag-char:nth-child(31){animation-delay:2.10s;}
    .flag-heading .flag-char:nth-child(32){animation-delay:2.17s;}
    .flag-heading .flag-char:nth-child(33){animation-delay:2.24s;}
    .flag-heading .flag-char:nth-child(34){animation-delay:2.31s;}
    .flag-heading .flag-char:nth-child(35){animation-delay:2.38s;}
    .flag-heading .flag-char:nth-child(36){animation-delay:2.45s;}
    .flag-heading .flag-char:nth-child(37){animation-delay:2.52s;}
    .flag-heading .flag-char:nth-child(38){animation-delay:2.59s;}
    .flag-heading .flag-char:nth-child(39){animation-delay:2.66s;}
    .flag-heading .flag-char:nth-child(40){animation-delay:2.73s;}

    .subhead{
        margin: 0 0 2rem;
        color: #f4f7fb;
        font-size: clamp(1rem, 1.2vw + 0.6rem, 1.5rem);
        text-shadow: 0 3px 10px rgba(0,0,0,.4);
        font-weight: 400;
        line-height: 1.6;
        max-width: 850px;
        padding: 0 1rem;
    }

    /* Responsive text adjustments */
    @media (max-width: 767px) {
        .headline {
            font-size: clamp(1.8rem, 6vw, 3rem);
            margin-bottom: 1rem;
        }
        .subhead {
            font-size: clamp(0.9rem, 3vw, 1.1rem);
            margin-bottom: 1.5rem;
        }
        .hero-buttons {
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 300px;
        }
        .hero-buttons a {
            width: 100%;
            text-align: center;
        }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce){
        .hero__bg{animation:none;opacity:0;}
        .hero__bg--1{opacity:1;}
        .flag-char{animation:none;color:#fff !important;}
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
        position: absolute;
        bottom: clamp(20px, 4vh, 40px);
        left: 50%;
        transform: translateX(-50%);
        animation: bounce 2s infinite;
        z-index: 3;
        color: white;
        font-size: 30px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .scroll-down:hover {
        transform: translateX(-50%) translateY(5px);
        color: var(--primary-color);
    }

    @keyframes bounce{
        0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
        40% { transform: translateX(-50%) translateY(-15px); }
        60% { transform: translateX(-50%) translateY(-8px); }
    }

    /* Fix for scroll-down positioning on mobile */
    @media (max-width: 767px) {
        .scroll-down {
            bottom: 15px;
            font-size: 24px;
        }
    }

    /* About Section Styles */
    .about-v2{
        background:#f2f2f2;
        padding: 100px 0;
    }
    .about-v2 .container{
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }
    .about-v2 .about-hero{
        display:flex;
        flex-wrap:wrap;
        gap:50px;
        align-items:center;
        margin-bottom:70px;
    }
    .about-v2 .about-hero-main{
        flex:1 1 500px;
        min-width: 300px;
    }
    .about-text-bg{
        padding-right:40px;
    }
    @media (max-width: 992px) {
        .about-text-bg{
            padding-right: 0;
        }
    }
    .about-v2 .kicker{
        color:var(--primary-color);
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:2.5px;
        font-size:14px;
        margin-bottom:18px;
        display:block;
        position: relative;
        padding-left: 15px;
    }
    .about-v2 .kicker::before{
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 18px;
        background: var(--primary-color);
        border-radius: 2px;
    }
    .about-v2 .subtitle{
        font-size:clamp(15px, 1.8vw, 18px);
        color:var(--text-light);
        margin-bottom:35px;
        line-height:1.8;
    }
    .about-v2 .snapshot{
        flex:1 1 400px;
        background:#fff;
        border-radius:20px;
        padding:25px;
        border:1px solid rgba(0,0,0,.08);
        box-shadow:0 15px 40px rgba(0,0,0,0.08);
        transition: all 0.4s;
    }
    .about-v2 .snapshot:hover{
        transform: translateY(-5px);
        box-shadow:0 20px 50px rgba(0,0,0,0.12);
    }
    .about-v2 .snapshot img{
        width:100%;
        height:300px;
        object-fit:cover;
        border-radius:15px;
        margin-bottom:20px;
        transition: transform 0.4s;
    }
    .about-v2 .snapshot:hover img{
        transform: scale(1.02);
    }
    .snapshot-title{
        font-weight:800;
        font-size:14px;
        text-transform:uppercase;
        letter-spacing:1.5px;
        color:var(--primary-color);
        margin-bottom:20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .snapshot-title::before{
        content: '';
        width: 30px;
        height: 2px;
        background: var(--primary-color);
    }
    .stat-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:18px;
    }
    .stat-item{
        background:var(--light-color);
        padding:20px 15px;
        border-radius:15px;
        text-align:center;
        transition: all 0.3s;
        border: 1px solid rgba(0,0,0,.05);
    }
    .stat-item:hover{
        background: #fff;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: var(--primary-color);
    }
    .stat-item strong{
        display:block;
        font-size:28px;
        color:var(--secondary-color);
        margin-bottom:8px;
        font-weight: 900;
        font-family: 'Playfair Display', serif;
    }
    .stat-item span{
        font-size:12px;
        color:var(--text-light);
        line-height:1.5;
        display:block;
        font-weight: 500;
    }
    .about-v2 .layout{
        display:grid;
        grid-template-columns: 1.8fr 1.2fr;
        gap:45px;
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }

    @media (max-width: 992px) {
        .about-v2 .layout {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .about-v2 .about-hero {
            flex-direction: column;
            gap: 30px;
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
            font-size: clamp(28px, 6vw, 40px);
        }
        .section-header {
            margin-bottom: 50px;
        }
        .about-v2 {
            padding: 60px 0;
        }
        .about-v2 .title {
            font-size: clamp(24px, 5vw, 32px);
            line-height: 1.2;
        }
        .about-v2 .subtitle {
            font-size: clamp(14px, 3vw, 16px);
            margin-bottom: 25px;
        }
        .about-v2 .about-hero {
            gap: 25px;
            margin-bottom: 40px;
        }
        .services-section,
        #gallery,
        .testimonials-section {
            padding: 60px 0;
        }
        .cta-section {
            padding: 80px 20px;
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
        border-radius:22px;
        padding:35px 30px;
        border:1px solid rgba(0,0,0,.08);
        box-shadow:0 15px 40px rgba(0,0,0,.08);
        transition: all 0.4s;
        position: relative;
        overflow: hidden;
    }
    .about-v2 .card::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        transform: scaleX(0);
        transition: transform 0.4s;
    }
    .about-v2 .card:hover::before{
        transform: scaleX(1);
    }
    .about-v2 .card:hover{
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0,0,0,.12);
        border-color: var(--primary-color);
    }
    .about-v2 .card + .card{
        margin-top:25px;
    }
    .about-v2 .card-title{
        font-family: 'Playfair Display', serif;
        font-size:22px;
        font-weight:900;
        color:var(--secondary-color);
        margin-bottom: 20px;
    }
    .about-v2 .pill-row{
        display:flex;
        flex-wrap:wrap;
        gap:10px;
        margin-top:15px;
    }
    .about-v2 .pill{
        padding:10px 18px;
        border-radius:999px;
        font-size:13px;
        border:2px solid var(--primary-color);
        background:var(--light-color);
        color:var(--secondary-color);
        font-weight:600;
        cursor:pointer;
        transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:6px;
        position:relative;
        overflow:hidden;
    }
    .about-v2 .pill::before{
        content:'';
        position:absolute;
        top:0;
        left:-100%;
        width:100%;
        height:100%;
        background:linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition:left .5s;
    }
    .about-v2 .pill:hover::before{
        left:100%;
    }
    .about-v2 .pill:hover{
        background:var(--primary-color);
        color:#fff;
        transform:translateY(-3px);
        box-shadow:0 8px 20px rgba(212,163,115,0.4);
        border-color:var(--primary-color);
    }
    .about-v2 .pill:active{
        transform:translateY(-1px);
    }
    .about-v2 .pill i{
        font-size:12px;
        transition:transform .3s;
    }
    .about-v2 .pill:hover i{
        transform:translateX(3px);
    }
    .about-v2 .why-title-wrap-about{
        margin-bottom: 30px;
    }
    .about-v2 .why-subtitle-about{
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 12px;
    }
    .about-v2 .why-title-about{
        font-family: 'Playfair Display', serif;
        font-size: clamp(26px, 4vw, 36px);
        color: var(--secondary-color);
        font-weight: 900;
        margin: 0;
    }
    .about-v2 .why-grid{
        margin-top:25px;
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
        gap:20px;
    }
    .about-v2 .why-card{
        background:var(--light-color);
        border:2px solid rgba(0,0,0,.06);
        border-radius:18px;
        padding:25px 20px;
        transition: all 0.4s;
        position: relative;
        overflow: hidden;
    }
    .about-v2 .why-card::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-color);
        transform: scaleY(0);
        transition: transform 0.4s;
    }
    .about-v2 .why-card:hover::before{
        transform: scaleY(1);
    }
    .about-v2 .why-card:hover{
        background: #fff;
        border-color: var(--primary-color);
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,.12);
    }
    .about-v2 .why-card h4{
        font-size:16px;
        margin-bottom:10px;
        display:flex;
        align-items:center;
        gap:10px;
        color:var(--secondary-color);
        font-weight:800;
        position: relative;
        z-index: 1;
    }
    .about-v2 .why-card h4 i{
        color:var(--accent-color);
        font-size: 20px;
        transition: transform 0.3s;
    }
    .about-v2 .why-card:hover h4 i{
        transform: scale(1.2) rotate(10deg);
    }
    .about-v2 .why-card p{
        font-size:14px;
        color:var(--text-light);
        line-height:1.7;
        margin:0;
        position: relative;
        z-index: 1;
    }
    .about-v2 .side-section-title-about{
        font-size:13px;
        text-transform:uppercase;
        letter-spacing:2px;
        color:var(--primary-color);
        margin-bottom:20px;
        font-weight:700;
        display: block;
        position: relative;
        padding-left: 15px;
    }
    .about-v2 .side-section-title-about::before{
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 18px;
        background: var(--primary-color);
        border-radius: 2px;
    }
    .about-v2 .values-list{
        list-style:none;
        margin:0 0 25px 0;
        padding:0;
    }
    .about-v2 .values-list li{
        display:flex;
        gap:12px;
        padding:16px 0;
        border-bottom:1px dashed rgba(0,0,0,.12);
        color:var(--text-light);
        font-size:14px;
        line-height:1.7;
        transition: all 0.3s;
        position: relative;
    }
    .about-v2 .values-list li:last-child{
        border-bottom: none;
    }
    .about-v2 .values-list li:hover{
        padding-left: 8px;
        color: var(--secondary-color);
    }
    .about-v2 .values-list li:hover i{
        transform: scale(1.2);
    }
    .about-v2 .values-list i{
        color:var(--accent-color);
        margin-top:4px;
        font-size:16px;
        transition: all 0.3s;
        flex-shrink: 0;
    }
    .about-v2 .mission-box{
        margin-top:25px;
        padding:25px;
        border-radius:18px;
        border:2px dashed rgba(212,163,115,.5);
        background:linear-gradient(135deg, rgba(212,163,115,.08), rgba(255,107,53,.05));
        transition: all 0.4s;
        position: relative;
    }
    .about-v2 .mission-box:hover{
        border-color: var(--primary-color);
        background:linear-gradient(135deg, rgba(212,163,115,.15), rgba(255,107,53,.08));
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(212,163,115,0.2);
    }
    .about-v2 .mission-box h4{
        font-size:18px;
        color:var(--secondary-color);
        margin-bottom:12px;
        font-weight:900;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'Playfair Display', serif;
    }
    .about-v2 .mission-box h4 i{
        color:var(--accent-color);
        font-size: 22px;
    }
    .about-v2 .mission-box p{
        margin:0;
        color:var(--text-light);
        font-size:15px;
        line-height:1.8;
    }

    /* Services Section */
    .services-section{
        background:var(--light-color);
        padding: 100px 0;
    }
    .services-section .container{
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }
    .services-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(300px,1fr));
        gap:30px;
        margin-top:60px;
    }
    .service-card{
        background:#fff;
        padding:45px 35px;
        border-radius:25px;
        text-align:center;
        transition:all .4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow:0 5px 20px rgba(0,0,0,.08);
        border: 1px solid rgba(0,0,0,.05);
        position: relative;
        overflow: hidden;
    }
    .service-card::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        transform: scaleX(0);
        transition: transform 0.4s;
    }
    .service-card:hover::before{
        transform: scaleX(1);
    }
    .service-card:hover{
        transform:translateY(-12px);
        box-shadow:0 20px 50px rgba(0,0,0,.15);
        border-color: var(--primary-color);
    }
    .service-icon{
        font-size:56px;
        color:var(--primary-color);
        margin-bottom:25px;
        display: inline-block;
        transition: transform 0.3s;
    }
    .service-card:hover .service-icon{
        transform: scale(1.1) rotate(5deg);
    }
    .service-card h3{
        font-family: 'Playfair Display', serif;
        font-size:26px;
        margin-bottom:18px;
        color:var(--secondary-color);
        font-weight: 900;
    }
    .service-card p{
        color:var(--text-light);
        line-height:1.8;
        font-size: 15px;
        margin-bottom: 0;
    }
    .service-card .btn-primary{
        margin-top:20px;
        padding:12px 30px;
        font-size:14px;
        border-radius:30px;
        text-decoration:none;
        display:inline-block;
        transition:all .3s;
    }
    .service-card .btn-primary:hover{
        transform:translateY(-2px);
        box-shadow:0 8px 25px rgba(255,107,53,0.4);
    }

    /* Gallery Section */
    #gallery{
        padding: 100px 0;
        background: #fff;
    }
    #gallery .container{
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }
    .gallery-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(320px,1fr));
        gap:25px;
        margin-top: 50px;
    }
    .gallery-item{
        position:relative;
        overflow:hidden;
        border-radius:20px;
        height:420px;
        cursor:pointer;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.4s;
    }
    .gallery-item:hover{
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        transform: translateY(-5px);
    }
    .gallery-item img{
        width:100%;
        height:100%;
        object-fit:cover;
        transition:transform .6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-item:hover img{
        transform:scale(1.15);
    }
    .gallery-overlay{
        position:absolute;
        bottom:0;
        left:0;
        right:0;
        background:linear-gradient(transparent 0%, rgba(0,0,0,.4) 50%, rgba(0,0,0,.9) 100%);
        color:#fff;
        padding:35px 30px;
        transform:translateY(100%);
        transition:transform .4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-item:hover .gallery-overlay{
        transform:translateY(0);
    }
    .gallery-overlay h3{
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        margin-bottom: 10px;
        font-weight: 900;
    }
    .gallery-overlay p{
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 15px;
        line-height: 1.6;
    }
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
    .testimonials-section{
        background:var(--secondary-color); 
        color:#fff;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    .testimonials-section::before{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center/cover;
        opacity: 0.15;
        z-index: 0;
    }
    .testimonials-section .container{
        position: relative;
        z-index: 1;
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }
    .testimonials-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(320px,1fr));
        gap:30px;
        margin-top:60px;
    }
    .testimonial-card{
        background:rgba(255,255,255,.12);
        padding:45px;
        border-radius:25px;
        backdrop-filter:blur(15px);
        border: 1px solid rgba(255,255,255,.2);
        transition: all 0.4s;
        position: relative;
        overflow: hidden;
    }
    .testimonial-card::before{
        content: '"';
        position: absolute;
        top: -10px;
        left: 20px;
        font-size: 120px;
        font-family: 'Playfair Display', serif;
        opacity: 0.15;
        line-height: 1;
    }
    .testimonial-card:hover{
        background:rgba(255,255,255,.18);
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }
    .stars{
        color:#ffd700;
        font-size:22px;
        margin-bottom:25px;
        display: flex;
        gap: 3px;
    }
    .testimonial-text{
        font-style:italic;
        margin-bottom:25px;
        line-height:1.8;
        font-size: 16px;
        position: relative;
        z-index: 1;
    }
    .testimonial-author{
        display:flex;
        align-items:center;
        gap:18px;
        position: relative;
        z-index: 1;
    }
    .author-avatar{
        width:55px;
        height:55px;
        border-radius:50%;
        background:var(--primary-color);
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:700;
        font-size:22px;
        box-shadow: 0 5px 15px rgba(212, 163, 115, 0.4);
    }
    .author-info h4{
        font-size: 18px;
        margin-bottom: 3px;
        font-weight: 700;
    }
    .author-info p{
        font-size: 14px;
        opacity: 0.8;
    }

    /* CTA Section */
    .cta-section{
        background:linear-gradient(rgba(44,85,48,.92), rgba(44,85,48,.92)),
            url('https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center/cover;
        color:#fff;
        text-align:center;
        padding: 120px 20px;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before{
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, transparent, rgba(0,0,0,0.3));
        z-index: 0;
    }
    .cta-section .container{
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
    }
    .cta-section h2{
        font-family:'Playfair Display',serif;
        font-size: clamp(36px, 6vw, 64px);
        margin-bottom:25px;
        font-weight: 900;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .cta-section p{
        font-size:clamp(16px, 1.8vw, 22px);
        margin-bottom:45px;
        line-height: 1.7;
        opacity: 0.95;
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
    }

    .section-header{
        text-align:center;
        margin-bottom:70px;
        padding: 0 20px;
    }
    .section-subtitle{
        color:var(--primary-color);
        font-weight:700;
        font-size:15px;
        text-transform:uppercase;
        letter-spacing:2.5px;
        margin-bottom:15px;
        display: inline-block;
        position: relative;
        padding-bottom: 10px;
    }
    .section-subtitle::after{
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 2px;
    }
    .section-title{
        font-family:'Playfair Display',serif;
        font-size: clamp(32px, 5.5vw, 52px);
        font-weight:900;
        color:var(--secondary-color);
        margin-bottom:25px;
        line-height: 1.2;
    }
    .section-description{
        font-size:clamp(16px, 1.8vw, 19px);
        color:var(--text-light);
        max-width:750px;
        margin:0 auto;
        line-height: 1.8;
    }
</style>
@endsection

@section('content')
    <!-- PWA Install Banner -->
    <div id="pwa-install-banner" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 10000; max-width: 600px; width: 90%; background: linear-gradient(135deg, #2c5530, #1a331d); color: #fff; padding: 20px 25px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); animation: slideDown 0.5s ease;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="width: 60px; height: 60px; background: rgba(212,163,115,0.2); border-radius: 15px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fas fa-download" style="font-size: 28px; color: #d4a373;"></i>
            </div>
            <div style="flex: 1;">
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 5px; font-family: 'Playfair Display', serif;">Install Tanzalian Safaris App</h3>
                <p style="font-size: 13px; opacity: 0.9; margin: 0; line-height: 1.5;">Get instant access to safari bookings, packages, and gallery. Works offline too!</p>
            </div>
            <div style="display: flex; gap: 10px; flex-shrink: 0;">
                <button onclick="installPWA()" style="background: var(--accent-color); color: #fff; border: none; padding: 10px 20px; border-radius: 25px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s; box-shadow: 0 5px 15px rgba(255,107,53,0.4);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(255,107,53,0.5)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(255,107,53,0.4)';">
                    <i class="fas fa-download"></i> Install
                </button>
                <button onclick="hideInstallPrompt()" style="background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.3); padding: 10px 15px; border-radius: 25px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.1)';" onmouseout="this.style.background='transparent';">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }
        @media (max-width: 768px) {
            #pwa-install-banner {
                top: 10px;
                padding: 15px 20px;
                border-radius: 15px;
            }
            #pwa-install-banner h3 {
                font-size: 16px;
            }
            #pwa-install-banner p {
                font-size: 12px;
            }
            #pwa-install-banner button {
                padding: 8px 15px;
                font-size: 13px;
            }
            #pwa-install-banner > div > div:first-child {
                width: 50px;
                height: 50px;
            }
            #pwa-install-banner > div > div:first-child i {
                font-size: 22px;
            }
        }
    </style>

    <!-- Hero Section with Slideshow -->
    <section class="hero hero--slideshow" id="home" aria-label="Welcome to Tanzalian Safaris hero">
        <!-- Background Slides -->
        <div class="hero__bg hero__bg--1" aria-hidden="true"></div>
        <div class="hero__bg hero__bg--2" aria-hidden="true"></div>
        <div class="hero__bg hero__bg--3" aria-hidden="true"></div>
        <div class="hero__bg hero__bg--4" aria-hidden="true"></div>
        <div class="hero__bg hero__bg--5" aria-hidden="true"></div>

        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="headline flag-heading" aria-label="Welcome to Tanzalian Safaris Discover Tanzania Experience the Wild Travel in Style">
                <span class="word">
                    <span class="flag-char">W</span><span class="flag-char">e</span><span class="flag-char">l</span><span class="flag-char">c</span><span class="flag-char">o</span><span class="flag-char">m</span><span class="flag-char">e</span>
                </span>
                <span class="word">
                    <span class="flag-char">t</span><span class="flag-char">o</span>
                </span>
                <span class="word">
                    <span class="flag-char">T</span><span class="flag-char">a</span><span class="flag-char">n</span><span class="flag-char">z</span><span class="flag-char">a</span><span class="flag-char">l</span><span class="flag-char">i</span><span class="flag-char">a</span><span class="flag-char">n</span>
                </span>
                <span class="word">
                    <span class="flag-char">S</span><span class="flag-char">a</span><span class="flag-char">f</span><span class="flag-char">a</span><span class="flag-char">r</span><span class="flag-char">i</span><span class="flag-char">s</span>
                </span>
                <span class="word">
                    <span class="flag-char">D</span><span class="flag-char">i</span><span class="flag-char">s</span><span class="flag-char">c</span><span class="flag-char">o</span><span class="flag-char">v</span><span class="flag-char">e</span><span class="flag-char">r</span>
                </span>
                <span class="word after-period">
                    <span class="flag-char">T</span><span class="flag-char">a</span><span class="flag-char">n</span><span class="flag-char">z</span><span class="flag-char">a</span><span class="flag-char">n</span><span class="flag-char">i</span><span class="flag-char">a</span><span class="flag-char">.</span>
                </span>
                <span class="word">
                    <span class="flag-char">E</span><span class="flag-char">x</span><span class="flag-char">p</span><span class="flag-char">e</span><span class="flag-char">r</span><span class="flag-char">i</span><span class="flag-char">e</span><span class="flag-char">n</span><span class="flag-char">c</span><span class="flag-char">e</span>
                </span>
                <span class="word">
                    <span class="flag-char">t</span><span class="flag-char">h</span><span class="flag-char">e</span>
                </span>
                <span class="word after-period">
                    <span class="flag-char">W</span><span class="flag-char">i</span><span class="flag-char">l</span><span class="flag-char">d</span><span class="flag-char">.</span>
                </span>
                <span class="word">
                    <span class="flag-char">T</span><span class="flag-char">r</span><span class="flag-char">a</span><span class="flag-char">v</span><span class="flag-char">e</span><span class="flag-char">l</span>
                </span>
                <span class="word">
                    <span class="flag-char">i</span><span class="flag-char">n</span>
                </span>
                <span class="word after-period">
                    <span class="flag-char">S</span><span class="flag-char">t</span><span class="flag-char">y</span><span class="flag-char">l</span><span class="flag-char">e</span><span class="flag-char">.</span>
                </span>
            </h1>
            <p class="subhead">Tanzalian Safaris is a premier tour operator dedicated to delivering unforgettable African experiences. From the vast plains of the Serengeti to the white-sand beaches of Zanzibar, we design trips that match your budget and vibrant culture of Tanzania.</p>
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
                        <h3 class="card-title">{{ $aboutPageContent['about_who_title'] ?? 'Who We Are' }}</h3>
                        <p style="margin-bottom: 18px; line-height: 1.8; color: var(--text-light); font-size: 15px;">{{ $aboutPageContent['about_paragraph1'] ?? "Tanzalian Safari's is a Tanzania-based tour operator that specializes in authentic African experiences." }}</p>
                        <p style="margin-bottom: 20px; line-height: 1.8; color: var(--text-light); font-size: 15px;">{{ $aboutPageContent['about_paragraph2'] ?? "From the vast plains of the Serengeti to the white-sand beaches of Zanzibar, we design trips that match your budget." }}</p>
                        <div class="pill-row">
                            @foreach ($pills as $pill)
                                @php
                                    $route = '';
                                    $icon = 'fas fa-chevron-right';
                                    if(stripos($pill, 'private safari') !== false) {
                                        $route = route('packages') . '?type=private';
                                        $icon = 'fas fa-user-friends';
                                    } elseif(stripos($pill, 'group') !== false || stripos($pill, 'family') !== false) {
                                        $route = route('packages') . '?type=group';
                                        $icon = 'fas fa-users';
                                    } elseif(stripos($pill, 'zanzibar') !== false) {
                                        $route = route('packages') . '?type=zanzibar';
                                        $icon = 'fas fa-umbrella-beach';
                                    } elseif(stripos($pill, 'car hire') !== false || stripos($pill, 'transfer') !== false) {
                                        $route = route('services');
                                        $icon = 'fas fa-car';
                                    } else {
                                        $route = route('packages');
                                    }
                                @endphp
                                <a href="{{ $route }}" class="pill" onclick="handlePillClick(event, '{{ $pill }}')">
                                    <span>{{ $pill }}</span>
                                    <i class="{{ $icon }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </article>

                    <article class="card" data-aos="fade-up" data-aos-delay="200">
                        <div class="why-title-wrap-about">
                            <div class="why-subtitle-about">Why Choose Us</div>
                            <h3 class="why-title-about">{{ $aboutPageContent['about_why_title'] ?? 'What Makes Us Special' }}</h3>
                        </div>
                        <div class="why-grid">
                            <div class="why-card">
                                <h4><i class="fa-solid fa-user-check"></i> {{ $aboutPageContent['about_why_1_title'] ?? 'Local Expertise' }}</h4>
                                <p>{{ $aboutPageContent['about_why_1_text'] ?? 'Our guides know the parks by heart.' }}</p>
                            </div>
                            <div class="why-card">
                                <h4><i class="fa-solid fa-shield-heart"></i> {{ $aboutPageContent['about_why_2_title'] ?? 'Safe & Reliable' }}</h4>
                                <p>{{ $aboutPageContent['about_why_2_text'] ?? 'We prioritize safety with well-maintained vehicles.' }}</p>
                            </div>
                            <div class="why-card">
                                <h4><i class="fa-solid fa-leaf"></i> {{ $aboutPageContent['about_why_3_title'] ?? 'Responsible Travel' }}</h4>
                                <p>{{ $aboutPageContent['about_why_3_text'] ?? 'We work with locally-owned lodges and support community initiatives.' }}</p>
                            </div>
                            <div class="why-card">
                                <h4><i class="fa-solid fa-handshake-angle"></i> {{ $aboutPageContent['about_why_4_title'] ?? 'Personal Support' }}</h4>
                                <p>{{ $aboutPageContent['about_why_4_text'] ?? 'Our team is always reachable for questions and support.' }}</p>
                            </div>
                        </div>
                    </article>
                </div>

                <aside>
                    <article class="card" data-aos="fade-up" data-aos-delay="300">
                        <div class="side-section-title-about">Our Core Values</div>
                        <ul class="values-list">
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
                        <div class="mission-box">
                            <h4><i class="fa-solid fa-bullseye"></i> {{ $aboutPageContent['about_mission_title'] ?? 'Our Mission' }}</h4>
                            <p>{{ $aboutPageContent['mission_text'] ?? "To provide safe, reliable, and inspiring travel experiences that celebrate Tanzania's wildlife, cultures, and landscapes – while empowering local communities." }}</p>
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
                <div class="service-card" data-aos="fade-up" data-aos-delay="700">
                    <div class="service-icon"><i class="fas fa-plane"></i></div>
                    <h3>Flight Booking</h3>
                    <p>Domestic and international flight bookings to make your journey seamless.</p>
                    <a href="{{ route('flight.booking') }}" class="btn-primary" style="margin-top: 20px; display: inline-block;">
                        <i class="fas fa-calendar-check"></i> Book Now (Coming Soon)
                    </a>
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

@section('scripts')
<script>
    function handlePillClick(event, pillName) {
        event.preventDefault();
        const url = event.currentTarget.href;
        
        // Store selected service type in sessionStorage if available
        if(url.includes('type=')) {
            const typeParam = url.split('type=')[1].split('&')[0];
            sessionStorage.setItem('selectedServiceType', typeParam);
        }
        
        // Navigate to the route
        window.location.href = url;
    }

    // PWA Install Success Message
    function showInstallSuccess() {
        // Create success notification
        const successMsg = document.createElement('div');
        successMsg.id = 'pwa-install-success';
        successMsg.style.cssText = 'position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 10001; background: linear-gradient(135deg, #10b981, #059669); color: #fff; padding: 20px 30px; border-radius: 20px; box-shadow: 0 10px 40px rgba(16,185,129,0.4); animation: slideDown 0.5s ease; max-width: 500px; width: 90%;';
        successMsg.innerHTML = `
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-check-circle" style="font-size: 24px;"></i>
                </div>
                <div style="flex: 1;">
                    <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 5px; font-family: "Playfair Display", serif;">App Installed Successfully! 🎉</h3>
                    <p style="font-size: 13px; opacity: 0.95; margin: 0; line-height: 1.5;">Tanzalian Safaris app is now installed. Enjoy offline access and faster loading!</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" style="background: transparent; color: #fff; border: none; padding: 5px 10px; cursor: pointer; font-size: 18px; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        document.body.appendChild(successMsg);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if(successMsg && successMsg.parentElement) {
                successMsg.style.animation = 'slideUp 0.5s ease';
                setTimeout(() => successMsg.remove(), 500);
            }
        }, 5000);
    }

    // Show install prompt automatically on welcome page (after 3 seconds)
    window.addEventListener('load', () => {
        // Check if app is already installed
        const isInstalled = window.matchMedia('(display-mode: standalone)').matches ||
                           window.navigator.standalone === true ||
                           document.referrer.includes('android-app://');
        
        if(!isInstalled) {
            // Wait a bit then check if deferredPrompt is available
            setTimeout(() => {
                if(typeof deferredPrompt !== 'undefined' && deferredPrompt) {
                    showInstallPrompt();
                }
            }, 3000);
        }
    });
</script>

<style>
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        to {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }
    }
</style>
@endsection

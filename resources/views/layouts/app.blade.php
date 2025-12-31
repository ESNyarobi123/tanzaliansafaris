<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', "Tanzalian Safari's - Your Gateway to Authentic Tanzanian Adventures")</title>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *{margin:0;padding:0;box-sizing:border-box;}

        :root{
            --primary-color:#d4a373;
            --secondary-color:#2c5530;
            --dark-color:#1a1a1a;
            --light-color:#f8f5f0;
            --accent-color:#ff6b35;
            --text-dark:#333;
            --text-light:#666;
            --hero-bg-image:url('{{ asset('assets/img/hero-bg.jpg') }}'); /* Fallback */
            --about-main-image:url('{{ asset('assets/img/about-bg.jpg') }}'); /* Fallback */
        }

        body{
            font-family:'Poppins',sans-serif;
            line-height:1.6;
            color:var(--text-dark);
            overflow-x:hidden;
            background: #fff;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        section {
            padding: 100px 0;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            section {
                padding: 60px 0;
            }
        }

        /* ========== HEADER & NAVIGATION ========== */
        .top-bar {
            background: #0f172a;
            color: #94a3b8;
            padding: 12px 0;
            font-size: 13px;
            font-weight: 500;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .top-bar .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar-left {
            display: flex;
            gap: 25px;
        }

        .top-bar-left span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-bar-left i {
            color: var(--primary-color);
        }

        .top-bar-right {
            display: flex;
            gap: 15px;
        }

        .top-bar-right a {
            color: #94a3b8;
            transition: all 0.3s;
        }

        .top-bar-right a:hover {
            color: var(--primary-color);
        }

        header {
            background: #fff;
            position: sticky;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1100;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        header.scrolled {
            padding: 5px 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        nav {
            max-width: 1240px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 900;
            color: var(--secondary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.3s;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .logo i {
            color: var(--primary-color);
            font-size: 30px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #1e293b;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            position: relative;
            padding: 8px 0;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s;
            border-radius: 2px;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .auth-btn {
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            color: #1e293b;
            transition: all 0.3s;
            padding: 10px 22px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .auth-btn:hover {
            color: var(--primary-color);
        }

        .cta-button {
            background: var(--accent-color);
            color: #fff !important;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }

        .cta-button:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 163, 115, 0.3);
        }

        .menu-toggle {
            display: none;
            width: 30px;
            height: 20px;
            position: relative;
            cursor: pointer;
            z-index: 1200;
        }

        .menu-toggle span {
            display: block;
            width: 100%;
            height: 2px;
            background: var(--secondary-color);
            position: absolute;
            transition: all 0.3s;
        }

        header.scrolled .menu-toggle span {
            background: var(--secondary-color);
        }

        .menu-toggle span:nth-child(1) { top: 0; }
        .menu-toggle span:nth-child(2) { top: 9px; }
        .menu-toggle span:nth-child(3) { top: 18px; }

        .menu-toggle.active span:nth-child(1) { transform: rotate(45deg); top: 9px; }
        .menu-toggle.active span:nth-child(2) { opacity: 0; }
        .menu-toggle.active span:nth-child(3) { transform: rotate(-45deg); top: 9px; }

        @media (max-width: 1024px) {
            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 280px;
                max-width: 85%;
                height: 100vh;
                background: #fff;
                flex-direction: column;
                padding: 80px 30px;
                gap: 15px;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -10px 0 30px rgba(0,0,0,0.1);
                z-index: 1150;
            }

            .nav-menu.open {
                right: 0;
            }

            .nav-menu li {
                width: 100%;
                border-bottom: 1px solid #f1f5f9;
                padding-bottom: 15px;
            }

            .nav-menu a {
                font-size: 18px;
                color: var(--secondary-color);
                width: 100%;
                display: block;
            }

            .nav-menu a::after {
                display: none;
            }

            .menu-toggle {
                display: block;
            }

            .top-bar-left {
                display: none;
            }

            .nav-actions .auth-btn {
                display: none;
            }

            /* Overlay */
            .nav-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(4px);
                z-index: 1040;
                opacity: 0;
                visibility: hidden;
                transition: all 0.4s;
            }

            .nav-overlay.active {
                opacity: 1;
                visibility: visible;
            }
            nav {
                padding: 15px 20px;
            }
        }

        @media (max-width: 480px) {
            .cta-button {
                padding: 8px 15px;
                font-size: 10px;
            }
            .logo {
                font-size: 18px;
            }
            header {
                padding: 10px 0;
            }
        }

        /* ========== FOOTER ========== */
        footer {
            background: #0f172a; /* Darker navy for premium feel */
            color: #fff;
            padding: 100px 0 30px;
            margin-top: 0;
            position: relative;
            z-index: 10;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
            gap: 60px;
            margin-bottom: 80px;
        }

        .footer-about h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 25px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-about p {
            color: #94a3b8;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            width: 42px;
            height: 42px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-links a:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-5px) rotate(8deg);
            color: #fff;
        }

        .footer-column h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #fff;
            position: relative;
            padding-bottom: 12px;
        }

        .footer-column h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-links a i {
            font-size: 12px;
            color: var(--primary-color);
            transition: transform 0.3s;
        }

        .footer-links a:hover {
            color: #fff;
            padding-left: 8px;
        }

        .footer-links a:hover i {
            transform: translateX(3px);
        }

        .contact-info {
            list-style: none;
        }

        .contact-info li {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            color: #94a3b8;
            font-size: 15px;
            line-height: 1.5;
        }

        .contact-info i {
            color: var(--primary-color);
            font-size: 18px;
            margin-top: 2px;
        }

        .newsletter-form {
            margin-top: 25px;
        }

        .newsletter-form .input-group {
            display: flex;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 6px;
            transition: all 0.3s;
        }

        .newsletter-form .input-group:focus-within {
            border-color: var(--primary-color);
            background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 4px rgba(212, 163, 115, 0.1);
        }

        .newsletter-form input {
            background: transparent;
            border: none;
            padding: 10px 15px;
            color: #fff;
            flex: 1;
            font-size: 14px;
            outline: none;
            width: 100%;
        }

        .newsletter-form button {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .newsletter-form button:hover {
            background: var(--accent-color);
            transform: scale(1.02);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px 0;
            border-top: 1px solid rgba(255,255,255,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }
        }

        @media (max-width: 640px) {
            .footer-content {
                grid-template-columns: 1fr;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            footer {
                padding: 60px 0 30px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="nav-overlay" id="navOverlay"></div>
 
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <span><i class="fas fa-phone"></i> +255 762 402 880</span>
                <span><i class="fas fa-envelope"></i> info@tanzaliansafaris.com</span>
            </div>
            <div class="top-bar-right">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header>
        <nav>
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-tree"></i> Tanzalian Safari's
            </a>
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('packages') }}">Packages</a></li>
                <li><a href="{{ route('booking') }}">Booking</a></li>
                <li><a href="{{ route('services') }}">Our Services</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
            </ul>
            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="auth-btn">Dashboard</a>
                    <a href="{{ route('logout') }}" class="cta-button" style="background: var(--secondary-color);">Logout</a>
                @else
                    <a href="{{ route('signin') }}" class="auth-btn">Sign In</a>
                    <a href="{{ route('signup') }}" class="cta-button">Sign Up</a>
                @endauth
                <div class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div style="max-width: 1240px; margin: 20px auto; padding: 15px 20px; background: #dcfce7; color: #166534; border-radius: 10px; border: 1px solid #bbf7d0;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="max-width: 1240px; margin: 20px auto; padding: 15px 20px; background: #fee2e2; color: #991b1b; border-radius: 10px; border: 1px solid #fecaca;">
                <ul style="list-style: none;">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-about">
                <h3><i class="fas fa-tree"></i> Tanzalian Safari's</h3>
                <p>Your premier gateway to authentic Tanzanian adventures. We specialize in crafting personalized journeys that showcase the breathtaking beauty and rich culture of East Africa.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="{{ route('packages') }}"><i class="fas fa-chevron-right"></i> Safari Packages</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Our Services</a></li>
                    <li><a href="{{ route('privacy') }}"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}"><i class="fas fa-chevron-right"></i> Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Travel Guide</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('travel-guide') }}"><i class="fas fa-chevron-right"></i> Destination Guide</a></li>
                    <li><a href="{{ route('travel-tips') }}"><i class="fas fa-chevron-right"></i> Travel Tips</a></li>
                    <li><a href="{{ route('faqs') }}"><i class="fas fa-chevron-right"></i> FAQs</a></li>
                    <li><a href="{{ route('testimonials') }}"><i class="fas fa-chevron-right"></i> Testimonials</a></li>
                    <li><a href="{{ route('gallery') }}"><i class="fas fa-chevron-right"></i> Photo Gallery</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Newsletter</h4>
                <p>Join our community for exclusive travel deals and safari updates.</p>
                <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                        <button type="submit">Join</button>
                    </div>
                </form>
                <div style="margin-top: 20px; color: #94a3b8; font-size: 14px;">
                    <i class="fas fa-phone-alt" style="color: var(--primary-color); margin-right: 10px;"></i> +255 762 402 880
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Tanzalian Safari's. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');
        const navOverlay = document.getElementById('navOverlay');
        const header = document.querySelector('header');

        function toggleMenu() {
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('open');
            navOverlay.classList.toggle('active');
            document.body.style.overflow = navMenu.classList.contains('open') ? 'hidden' : '';
        }

        menuToggle.addEventListener('click', toggleMenu);
        navOverlay.addEventListener('click', toggleMenu);

        // Close menu on link click
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (navMenu.classList.contains('open')) {
                    toggleMenu();
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>

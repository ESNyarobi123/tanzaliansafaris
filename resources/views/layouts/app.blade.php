<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#2B5238">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Tanzalian Safaris">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="description" content="Premier tour operator for authentic Tanzanian safari experiences. Book safaris, explore packages, and manage your bookings on the go.">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="apple-touch-icon" sizes="96x96" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="apple-touch-icon" sizes="128x128" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="apple-touch-icon" sizes="384x384" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('assets/img/tanzalogo.jpg') }}">
    
    <title>@yield('title', "Tanzalian Safari's - Your Gateway to Authentic Tanzanian Adventures")</title>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google Fonts - Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ============================================
           MODERN DESIGN SYSTEM 2025
           - Glassmorphism
           - Smooth animations
           - Modern color palette
           - Better spacing & typography
        ============================================ */
        
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* ============================================
               TANZALIAN SAFARIS - BRAND COLOR SYSTEM
               Primary: Deep Forest Green (#2B5238)
               Accent: Golden Harvest (#F1B434)
               Background: Pure White (#FFFFFF)
               Text: Charcoal Grey (#333333)
               Soft Background: Soft Cloud Grey (#F7F7F7)
               Usage: 60% White | 30% Green | 10% Gold
            ============================================ */
            
            /* Primary Colors - Deep Forest Green Scale */
            --primary-50: #f4f7f5;
            --primary-100: #e3ebe6;
            --primary-200: #c5d6cb;
            --primary-300: #9ab8a4;
            --primary-400: #6e957a;
            --primary-500: #4d775a;
            --primary-600: #2B5238;
            --primary-700: #23452f;
            --primary-800: #1c3726;
            --primary-900: #152a1d;

            /* Secondary - Forest Green Variations */
            --secondary-50: #f4f7f5;
            --secondary-100: #e3ebe6;
            --secondary-200: #c5d6cb;
            --secondary-300: #9ab8a4;
            --secondary-400: #6e957a;
            --secondary-500: #4d775a;
            --secondary-600: #2B5238;
            --secondary-700: #23452f;
            --secondary-800: #1c3726;
            --secondary-900: #152a1d;

            /* Accent - Golden Harvest Scale */
            --accent-50: #fefcf5;
            --accent-100: #fdf6e3;
            --accent-200: #faebc5;
            --accent-300: #f6db97;
            --accent-400: #f1c760;
            --accent-500: #F1B434;
            --accent-600: #d99a1e;
            --accent-700: #b67f18;
            --accent-800: #936517;
            --accent-900: #785216;

            /* Neutral - Modern Gray Scale */
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;

            /* Semantic Colors - Brand Application */
            --primary: #2B5238;
            --primary-light: #4d775a;
            --primary-dark: #1c3726;
            
            --secondary: #2B5238;
            --secondary-light: #4d775a;
            --secondary-dark: #152a1d;
            
            --accent: #F1B434;
            --accent-light: #f6db97;
            --accent-dark: #b67f18;

            /* Background Colors - Brand Application */
            --bg-primary: #FFFFFF;
            --bg-secondary: #F7F7F7;
            --bg-tertiary: #e8e8e8;
            --bg-dark: #2B5238;
            --bg-dark-light: #23452f;

            /* Text Colors - Brand Application */
            --text-primary: #333333;
            --text-secondary: #555555;
            --text-muted: #888888;
            --text-inverse: #FFFFFF;

            /* Status Colors */
            --success: #10b981;
            --warning: #F1B434;
            --error: #ef4444;
            --info: #3b82f6;

            /* Spacing Scale */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;

            /* Typography - Montserrat */
            --font-sans: 'Montserrat', system-ui, -apple-system, sans-serif;
            --font-display: 'Montserrat', system-ui, -apple-system, sans-serif;
            
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            --text-5xl: 3rem;
            --text-6xl: 3.75rem;
            --text-7xl: 4.5rem;

            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-3xl: 2rem;
            --radius-full: 9999px;

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --shadow-glow: 0 0 40px rgba(43, 82, 56, 0.15);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 250ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 350ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: 500ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            font-size: var(--text-base);
            line-height: 1.6;
            color: var(--text-primary);
            background: var(--bg-primary);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Modern Container */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            width: 100%;
        }

        @media (min-width: 1024px) {
            .container {
                padding: 0 var(--space-8);
            }
        }

        /* ============================================
           TYPOGRAPHY
        ============================================ */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.01em;
        }

        .display-1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            line-height: 1.1;
        }

        .display-2 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            line-height: 1.15;
        }

        .display-3 {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
        }

        /* ============================================
           MODERN BUTTONS
        ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            font-family: 'Montserrat', sans-serif;
            font-size: var(--text-sm);
            font-weight: 600;
            text-decoration: none;
            border: none;
            border-radius: var(--radius-full);
            cursor: pointer;
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
            transition: transform var(--transition-slow);
        }

        .btn:hover::before {
            transform: translateX(100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #2B5238, #23452f);
            color: white;
            padding: var(--space-3) var(--space-6);
            box-shadow: 0 4px 14px rgba(43, 82, 56, 0.35);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #23452f, #1c3726);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(43, 82, 56, 0.45);
        }

        .btn-secondary {
            background: #2B5238;
            color: white;
            padding: var(--space-3) var(--space-6);
            box-shadow: 0 4px 14px rgba(43, 82, 56, 0.25);
        }

        .btn-secondary:hover {
            background: #23452f;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(43, 82, 56, 0.35);
        }

        .btn-accent {
            background: linear-gradient(135deg, #F1B434, #d99a1e);
            color: #333333;
            padding: var(--space-3) var(--space-6);
            box-shadow: 0 4px 14px rgba(241, 180, 52, 0.35);
        }

        .btn-accent:hover {
            background: linear-gradient(135deg, #d99a1e, #b67f18);
            color: #333333;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(241, 180, 52, 0.45);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            padding: var(--space-3) var(--space-6);
            border: 2px solid var(--gray-200);
        }

        .btn-outline:hover {
            border-color: var(--primary-500);
            color: var(--primary-600);
            background: var(--primary-50);
        }

        .btn-outline-white {
            background: rgba(255,255,255,0.1);
            color: white;
            padding: var(--space-3) var(--space-6);
            border: 2px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
        }

        .btn-outline-white:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.5);
        }

        .btn-lg {
            padding: var(--space-4) var(--space-8);
            font-size: var(--text-base);
        }

        .btn-sm {
            padding: var(--space-2) var(--space-4);
            font-size: var(--text-xs);
        }

        .btn-icon {
            width: 2.5rem;
            height: 2.5rem;
            padding: 0;
            border-radius: var(--radius-full);
        }

        /* ============================================
           HEADER - Modern Sticky with Glassmorphism
        ============================================ */
        /* ============================================
           HEADER - Compact & Modern
        ============================================ */
        header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1100;
            transition: all var(--transition-base);
            border-bottom: 1px solid var(--gray-100);
            box-shadow: var(--shadow-sm);
        }

        header.scrolled {
            background: rgba(255, 255, 255, 0.99);
            box-shadow: var(--shadow-md);
        }

        nav {
            max-width: 1280px;
            margin: 0 auto;
            padding: 10px var(--space-5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }

        @media (min-width: 1024px) {
            nav {
                padding: 12px var(--space-8);
                height: 64px;
            }
        }

        /* Modern Logo - Compact with Circle Image */
        .logo {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: var(--space-2);
            transition: all var(--transition-fast);
        }

        .logo:hover {
            opacity: 0.9;
        }

        .logo:hover .logo-image-wrapper {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .logo-image-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all var(--transition-base);
            flex-shrink: 0;
        }

        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #2B5238, #23452f);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .logo-text span {
            display: block;
            font-size: 0.65rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: -2px;
        }

        /* Modern Navigation - Compact */
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 4px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-secondary);
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            font-size: 13px;
            padding: 8px 14px;
            border-radius: var(--radius-full);
            transition: all var(--transition-fast);
            position: relative;
            white-space: nowrap;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: #2B5238;
            background: #f4f7f5;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Hide mobile auth on desktop */
        .mobile-auth-links {
            display: none;
        }

        /* Compact Header Buttons */
        .nav-actions .btn {
            padding: 7px 14px;
            font-size: 12px;
            font-weight: 600;
        }

        .nav-actions .btn-outline {
            background: transparent;
            border: 1.5px solid var(--gray-200);
            color: var(--text-secondary);
        }

        .nav-actions .btn-outline:hover {
            border-color: #2B5238;
            color: #2B5238;
            background: #f4f7f5;
        }

        /* Mobile Menu Toggle - Modern */
        .menu-toggle {
            display: none;
            width: 44px;
            height: 44px;
            position: relative;
            cursor: pointer;
            z-index: 1200;
            background: var(--gray-100);
            border: none;
            border-radius: var(--radius-lg);
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all var(--transition-base);
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }

        .menu-toggle:hover {
            background: var(--gray-200);
        }

        .menu-toggle span {
            display: block;
            width: 20px;
            height: 2px;
            background: var(--text-primary);
            border-radius: 2px;
            transition: all var(--transition-base);
        }

        .menu-toggle.active {
            background: #e3ebe6;
        }

        .menu-toggle.active span:nth-child(1) { 
            transform: rotate(45deg) translate(5px, 5px);
        }
        .menu-toggle.active span:nth-child(2) { 
            opacity: 0;
        }
        .menu-toggle.active span:nth-child(3) { 
            transform: rotate(-45deg) translate(5px, -5px);
        }

        @media (max-width: 1024px) {
            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 320px;
                max-width: 85%;
                height: 100vh;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 100px var(--space-8) var(--space-8);
                gap: var(--space-2);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -10px 0 40px rgba(0,0,0,0.1);
                z-index: 1150;
                pointer-events: auto;
            }

            .nav-menu.open {
                right: 0;
            }

            .nav-menu li {
                width: 100%;
            }

            .nav-menu a {
                font-size: var(--text-lg);
                color: var(--text-primary);
                width: 100%;
                display: block;
                padding: var(--space-3) var(--space-4);
                position: relative;
                z-index: 1160;
                pointer-events: auto;
            }

            .menu-toggle {
                display: flex;
            }

            .nav-actions .btn {
                display: none;
            }

            .nav-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(43, 82, 56, 0.4);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                z-index: 1090;
                opacity: 0;
                visibility: hidden;
                transition: all var(--transition-base);
                pointer-events: none;
            }

            .nav-overlay.active {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }
            
            /* Ensure menu is always clickable above overlay */
            .nav-menu.open {
                pointer-events: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .nav-menu.open li,
            .nav-menu.open a {
                pointer-events: auto;
                position: relative;
                z-index: 1160;
                touch-action: manipulation;
                -webkit-tap-highlight-color: transparent;
                cursor: pointer;
            }
            
            .nav-menu.open a:active {
                background: #e3ebe6;
            }
            
            nav {
                padding: 12px 16px;
                height: 60px;
            }
            
            .logo {
                font-size: 1.2rem;
            }
            
            .logo-icon {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }
            
            .mobile-auth-links {
                display: block !important;
            }
            
            .mobile-auth-links a {
                display: flex !important;
                align-items: center;
                font-weight: 600 !important;
                margin-bottom: 8px;
            }
            
            .logo-image-wrapper {
                width: 38px;
                height: 38px;
                border-width: 2px;
            }

            .logo-text span {
                font-size: 10px;
            }
        }

        /* ============================================
           MODERN ALERTS
        ============================================ */
        .alert {
            max-width: 1280px;
            margin: var(--space-4) auto;
            padding: var(--space-4) var(--space-6);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-size: var(--text-sm);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ============================================
           WHATSAPP FLOAT - Modern Design
        ============================================ */
        .whatsapp-float {
            position: fixed;
            bottom: var(--space-6);
            right: var(--space-6);
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25d366, #128c7e);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all var(--transition-base);
            animation: pulse-whatsapp 2s infinite;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            transform: scale(1.1) translateY(-5px);
            box-shadow: 0 12px 40px rgba(37, 211, 102, 0.5);
        }

        .whatsapp-float i {
            color: white;
            font-size: 28px;
        }

        @keyframes pulse-whatsapp {
            0%, 100% {
                box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4);
            }
            50% {
                box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4), 0 0 0 15px rgba(37, 211, 102, 0.1);
            }
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: var(--space-4);
                right: var(--space-4);
                width: 55px;
                height: 55px;
            }
            .whatsapp-float i {
                font-size: 24px;
            }
        }

        /* ============================================
           MODERN FOOTER
        ============================================ */
        footer {
            background: var(--gray-900);
            color: var(--gray-300);
            padding: var(--space-24) 0 var(--space-8);
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2B5238, #F1B434, #2B5238);
        }

        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: var(--space-12);
            margin-bottom: var(--space-16);
        }

        .footer-about h3 {
            font-size: var(--text-2xl);
            margin-bottom: var(--space-6);
            color: white;
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .footer-about h3 i {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2B5238, #23452f);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-lg);
        }

        .footer-about p {
            color: var(--gray-400);
            font-size: var(--text-sm);
            line-height: 1.8;
            margin-bottom: var(--space-6);
        }

        .social-links {
            display: flex;
            gap: var(--space-3);
        }

        .social-links a {
            width: 42px;
            height: 42px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-lg);
            color: var(--gray-400);
            text-decoration: none;
            transition: all var(--transition-base);
        }

        .social-links a:hover {
            background: #F1B434;
            border-color: #F1B434;
            color: #333333;
            transform: translateY(-3px);
        }

        .footer-column h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: var(--text-sm);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: var(--space-6);
            color: white;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: var(--space-3);
        }

        .footer-links a {
            color: var(--gray-400);
            text-decoration: none;
            font-size: var(--text-sm);
            transition: all var(--transition-fast);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .footer-links a:hover {
            color: #F1B434;
            padding-left: var(--space-1);
        }

        .contact-info {
            list-style: none;
        }

        .contact-info li {
            display: flex;
            gap: var(--space-3);
            margin-bottom: var(--space-4);
            color: var(--gray-400);
            font-size: var(--text-sm);
        }

        .contact-info i {
            color: #F1B434;
            font-size: var(--text-base);
            margin-top: 2px;
        }

        .newsletter-form {
            margin-top: var(--space-6);
        }

        .newsletter-form .input-group {
            display: flex;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-full);
            padding: var(--space-1);
            transition: all var(--transition-base);
        }

        .newsletter-form .input-group:focus-within {
            border-color: #F1B434;
            background: rgba(255,255,255,0.08);
        }

        .newsletter-form input {
            background: transparent;
            border: none;
            padding: var(--space-3) var(--space-4);
            color: white;
            flex: 1;
            font-size: var(--text-sm);
            outline: none;
        }

        .newsletter-form input::placeholder {
            color: var(--gray-500);
        }

        .newsletter-form button {
            background: #F1B434;
            color: #333333;
            border: none;
            padding: var(--space-3) var(--space-5);
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: var(--text-sm);
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .newsletter-form button:hover {
            background: #d99a1e;
        }

        /* Footer Contact Bar */
        .footer-contact-bar {
            background: rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: var(--space-6) 0;
            margin-top: var(--space-12);
        }

        .footer-contact-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 var(--space-6);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: var(--space-6);
        }

        .footer-contact-info {
            display: flex;
            align-items: center;
            gap: var(--space-8);
            flex-wrap: wrap;
        }

        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: var(--gray-300);
            text-decoration: none;
            font-size: var(--text-sm);
            font-weight: 500;
            transition: all var(--transition-fast);
        }

        .footer-contact-item:hover {
            color: #F1B434;
        }

        .footer-contact-item i {
            color: #F1B434;
            font-size: var(--text-base);
        }

        .footer-contact-item.location {
            cursor: default;
        }

        .footer-contact-item.location:hover {
            color: var(--gray-300);
        }

        .footer-social-links {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .follow-text {
            font-size: var(--text-sm);
            color: var(--gray-500);
            margin-right: var(--space-2);
        }

        .footer-social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-400);
            font-size: var(--text-lg);
            text-decoration: none;
            transition: all var(--transition-base);
        }

        .footer-social-links a:hover {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: white;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .footer-contact-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-contact-info {
                justify-content: center;
                gap: var(--space-5);
            }
            
            .footer-social-links {
                justify-content: center;
            }
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.5);
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: var(--space-4) var(--space-6);
            margin-top: 0;
        }
        
        .footer-bottom-content {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: var(--space-4);
            color: var(--gray-500);
            font-size: var(--text-xs);
            font-weight: 500;
        }
        
        .footer-bottom-content p {
            margin: 0;
        }

        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: var(--space-10);
            }
        }

        @media (max-width: 640px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: var(--space-8);
            }
            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
            }
            footer {
                padding: var(--space-16) 0 var(--space-6);
            }
        }

        /* ============================================
           UTILITY CLASSES
        ============================================ */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-600), var(--accent-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-padding {
            padding: var(--space-24) 0;
        }

        @media (max-width: 768px) {
            .section-padding {
                padding: var(--space-16) 0;
            }
        }

        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-400);
            border-radius: var(--radius-full);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-500);
        }

        /* ============================================
           TRUST BADGES SECTION
        ============================================ */
        .trust-badges-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: var(--space-12) var(--space-6) var(--space-8);
            border-top: 1px solid rgba(255,255,255,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .trust-badges-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }

        .trust-badge-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-4);
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: var(--radius-xl);
            transition: all var(--transition-base);
        }

        .trust-badge-item:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.15);
            transform: translateY(-3px);
        }

        .trust-badge-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            flex-shrink: 0;
        }

        .trust-badge-content {
            display: flex;
            flex-direction: column;
        }

        .trust-badge-content strong {
            font-size: 14px;
            font-weight: 700;
            color: white;
        }

        .trust-badge-content span {
            font-size: 12px;
            color: var(--gray-400);
        }

        /* Payment Badges */
        .payment-badges {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-4);
            flex-wrap: wrap;
            padding-top: var(--space-6);
        }

        .payment-label {
            font-size: 13px;
            color: var(--gray-400);
            font-weight: 500;
        }

        .payment-icons {
            display: flex;
            gap: var(--space-4);
        }

        .payment-icons i {
            font-size: 28px;
            color: var(--gray-400);
            transition: all var(--transition-fast);
        }

        .payment-icons i:hover {
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 1024px) {
            .trust-badges-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 640px) {
            .trust-badges-container {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--space-3);
            }
            .trust-badge-item {
                padding: var(--space-3);
            }
            .trust-badge-icon {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
            .trust-badge-content strong {
                font-size: 12px;
            }
            .trust-badge-content span {
                font-size: 10px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Header (must be before overlay for proper z-index stacking) -->
    <header>
        <nav>
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-image-wrapper">
                    <img src="{{ asset('assets/img/tanzalogo.jpg') }}" alt="Tanzalian Safari's Logo" class="logo-img">
                </div>
                <div class="logo-text">
                    Tanzalian Safari's
                    <span>Est. 2015</span>
                </div>
            </a>
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('packages') }}" class="{{ request()->routeIs('packages*') ? 'active' : '' }}">Packages</a></li>
                <li><a href="{{ route('guides') }}" class="{{ request()->routeIs('guides') ? 'active' : '' }}">Guides</a></li>
                <li><a href="{{ route('booking') }}" class="{{ request()->routeIs('booking') ? 'active' : '' }}">Booking</a></li>
                <li><a href="{{ route('packing-list') }}" class="{{ request()->routeIs('packing-list') ? 'active' : '' }}">Packing List</a></li>
                <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
                <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a></li>
                
                <!-- Mobile Auth Links -->
                <li class="mobile-auth-links" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gray-100);">
                    @auth
                        <a href="{{ route('dashboard') }}" style="background: var(--primary-50); color: var(--primary-600);">
                            <i class="fas fa-user-circle" style="margin-right: 8px;"></i> Dashboard
                        </a>
                        <a href="{{ route('logout') }}" style="color: var(--error); margin-top: 8px;">
                            <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> Logout
                        </a>
                    @else
                        <a href="{{ route('signin') }}" style="background: var(--primary-50); color: var(--primary-600); margin-bottom: 8px;">
                            <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Sign In
                        </a>
                        <a href="{{ route('signup') }}" style="background: linear-gradient(135deg, var(--primary-500), var(--primary-600)); color: white;">
                            <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Get Started
                        </a>
                    @endauth
                </li>
            </ul>
            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline btn-sm">Dashboard</a>
                    <a href="{{ route('logout') }}" class="btn btn-secondary btn-sm">Logout</a>
                @else
                    <!-- <a href="{{ route('signin') }}" class="btn btn-outline btn-sm auth-btn">Sign In</a> -->
                    <a href="{{ route('signup') }}" class="btn btn-primary btn-sm">Get Started</a>
                @endauth
                <div class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Overlay - Placed after header for proper z-index stacking -->
    <div class="nav-overlay" id="navOverlay"></div>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--space-1);">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/255691111111" target="_blank" class="whatsapp-float" aria-label="Contact us on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-about">
                <h3>
                    <img src="{{ asset('assets/img/tanzalogo.jpg') }}" alt="Tanzalian Safari's" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; vertical-align: middle; margin-right: 10px;">
                    Tanzalian Safari's
                </h3>
                <p>Your premier gateway to authentic Tanzanian adventures. We specialize in crafting personalized journeys that showcase the breathtaking beauty and rich culture of East Africa.</p>
                <div class="social-links">
                    <a href="https://www.instagram.com/tanzaliansafaris" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/@tanzaliansafaris" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://api.whatsapp.com/send/?phone=255691111111" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('packages') }}">Safari Packages</a></li>
                    <li><a href="{{ route('guides') }}">Our Guides</a></li>
                    <li><a href="{{ route('services') }}">Our Services</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Travel Guide</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('travel-guide') }}">Destination Guide</a></li>
                    <li><a href="{{ route('packing-list') }}">Packing List</a></li>
                    <li><a href="{{ route('travel-tips') }}">Travel Tips</a></li>
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                    <li><a href="{{ route('gallery') }}">Photo Gallery</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Newsletter</h4>
                <p style="font-size: var(--text-sm); color: var(--gray-400); margin-bottom: var(--space-4);">Join our community for exclusive travel deals and safari updates.</p>
                <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit">Join</button>
                    </div>
                </form>
                <div style="margin-top: var(--space-5); color: var(--gray-400); font-size: var(--text-sm);">
                    <i class="fas fa-phone-alt" style="color: var(--primary-500); margin-right: var(--space-2);"></i> +255 691 111 111
                </div>
            </div>
        </div>
        <!-- Trust Badges Section -->
        <div class="trust-badges-section">
            <div class="trust-badges-container">
                <div class="trust-badge-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="trust-badge-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="trust-badge-content">
                        <strong>SSL Secured</strong>
                        <span>256-bit Encryption</span>
                    </div>
                </div>
                
                <div class="trust-badge-item" data-aos="fade-up" data-aos-delay="150">
                    <div class="trust-badge-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="trust-badge-content">
                        <strong>TALA Licensed</strong>
                        <span>Regulated Operator</span>
                    </div>
                </div>
                
                <div class="trust-badge-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="trust-badge-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="trust-badge-content">
                        <strong>4.9/5 Rating</strong>
                        <span>500+ Reviews</span>
                    </div>
                </div>
                
                <div class="trust-badge-item" data-aos="fade-up" data-aos-delay="250">
                    <div class="trust-badge-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div class="trust-badge-content">
                        <strong>Eco Certified</strong>
                        <span>Sustainable Tourism</span>
                    </div>
                </div>
                
                <div class="trust-badge-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="trust-badge-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="trust-badge-content">
                        <strong>15+ Years</strong>
                        <span>Experience</span>
                    </div>
                </div>
            </div>
            
            <!-- Payment Methods -->
            <div class="payment-badges" data-aos="fade-up" data-aos-delay="350">
                <span class="payment-label">Secure Payment Methods:</span>
                <div class="payment-icons">
                    <i class="fab fa-cc-visa" title="Visa"></i>
                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                    <i class="fab fa-cc-paypal" title="PayPal"></i>
                    <i class="fas fa-mobile-alt" title="M-Pesa"></i>
                    <i class="fab fa-bitcoin" title="USDT/Crypto"></i>
                    <i class="fas fa-university" title="Bank Transfer"></i>
                </div>
            </div>
        </div>

        <!-- Contact Bar (Moved from Top) -->
        <div class="footer-contact-bar">
            <div class="footer-contact-content">
                <div class="footer-contact-info">
                    <a href="tel:+255691111111" class="footer-contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>+255 691 111 111</span>
                    </a>
                    <a href="mailto:info@tanzaliansafaris.com" class="footer-contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@tanzaliansafaris.com</span>
                    </a>
                    <span class="footer-contact-item location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Arusha, Tanzania</span>
                    </span>
                </div>
                <div class="footer-social-links">
                    <span class="follow-text">Follow Us:</span>
                    <a href="https://www.instagram.com/tanzaliansafaris" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com/@tanzaliansafaris" target="_blank" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send/?phone=255691111111" target="_blank" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; {{ date('Y') }} Tanzalian Safari's. All rights reserved.</p>
                <p style="color: var(--gray-500);">Crafted with <i class="fas fa-heart" style="color: var(--primary-500);"></i> in Tanzania</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS with modern settings
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');
        const navOverlay = document.getElementById('navOverlay');
        const header = document.querySelector('header');

        function toggleMenu() {
            const isOpen = navMenu.classList.contains('open');
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('open');
            navOverlay.classList.toggle('active');
            document.body.style.overflow = !isOpen ? 'hidden' : '';
        }

        function closeMenu() {
            if (navMenu.classList.contains('open')) {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('open');
                navOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });

        // Close menu when clicking on overlay (outside menu)
        navOverlay.addEventListener('click', function(e) {
            e.preventDefault();
            closeMenu();
        });

        // Close menu on link click
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.stopPropagation();
                closeMenu();
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (navMenu.classList.contains('open') && 
                !navMenu.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                closeMenu();
            }
        });

        // Header scroll effect with throttling
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    if (window.scrollY > 50) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    @yield('scripts')
    
    <!-- PWA Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('[PWA] Service Worker registered:', registration.scope);
                        
                        registration.addEventListener('updatefound', () => {
                            const newWorker = registration.installing;
                            newWorker.addEventListener('statechange', () => {
                                if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                    if (confirm('New version available! Reload to update?')) {
                                        window.location.reload();
                                    }
                                }
                            });
                        });
                    })
                    .catch((error) => {
                        console.log('[PWA] Service Worker registration failed:', error);
                    });
            });
        }
    </script>
</body>
</html>

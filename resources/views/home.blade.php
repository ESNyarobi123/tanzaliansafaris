@extends('layouts.app')

@section('title', "Tanzalian Safari's - Your Gateway to Authentic Tanzanian Adventures")

@section('styles')
<style>
    /* ============================================
       MODERN HERO SECTION
    ============================================ */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: var(--gray-900);
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        position: absolute;
        inset: 0;
        transition: opacity 1.5s ease-in-out, transform 10s ease-out;
        transform: scale(1.1);
    }

    .hero-bg img.active {
        opacity: 1;
        transform: scale(1);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            135deg,
            rgba(15, 23, 42, 0.85) 0%,
            rgba(15, 23, 42, 0.6) 50%,
            rgba(20, 83, 45, 0.4) 100%
        );
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 900px;
        padding: var(--space-8);
        color: white;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: var(--space-2) var(--space-4);
        border-radius: var(--radius-full);
        font-size: var(--text-sm);
        font-weight: 500;
        color: var(--accent-300);
        margin-bottom: var(--space-6);
        animation: fadeInDown 0.8s ease-out;
    }

    .hero-badge i {
        color: var(--accent-400);
    }

    .hero h1 {
        font-size: clamp(2.5rem, 6vw, 5rem);
        line-height: 1.1;
        margin-bottom: var(--space-6);
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .hero h1 span {
        display: block;
        font-size: clamp(1rem, 2vw, 1.5rem);
        font-family: var(--font-sans);
        font-weight: 400;
        color: var(--gray-300);
        margin-top: var(--space-4);
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .hero-description {
        font-size: clamp(1rem, 1.5vw, 1.25rem);
        color: var(--gray-300);
        max-width: 600px;
        margin: 0 auto var(--space-8);
        line-height: 1.8;
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .hero-actions {
        display: flex;
        gap: var(--space-4);
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 0.8s ease-out 0.6s both;
    }

    .hero-stats {
        position: absolute;
        bottom: var(--space-12);
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        display: flex;
        gap: var(--space-12);
        padding: var(--space-6) var(--space-10);
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-2xl);
        animation: fadeInUp 0.8s ease-out 0.8s both;
    }

    .hero-stat {
        text-align: center;
    }

    .hero-stat-value {
        font-family: var(--font-display);
        font-size: var(--text-3xl);
        color: white;
        line-height: 1;
    }

    .hero-stat-label {
        font-size: var(--text-xs);
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-top: var(--space-1);
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .hero-stats {
            gap: var(--space-6);
            padding: var(--space-4) var(--space-6);
            bottom: var(--space-8);
        }
        
        .hero-stat-value {
            font-size: var(--text-2xl);
        }
    }

    /* ============================================
       FEATURES SECTION - Bento Grid
    ============================================ */
    .features-section {
        padding: var(--space-24) 0;
        background: var(--bg-secondary);
    }

    .section-header {
        text-align: center;
        max-width: 700px;
        margin: 0 auto var(--space-16);
    }

    .section-kicker {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        font-size: var(--text-sm);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--primary-600);
        margin-bottom: var(--space-4);
    }

    .section-title {
        font-size: clamp(2rem, 4vw, 3rem);
        margin-bottom: var(--space-4);
    }

    .section-subtitle {
        font-size: var(--text-lg);
        color: var(--text-secondary);
        line-height: 1.7;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-6);
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: white;
        border-radius: var(--radius-2xl);
        padding: var(--space-8);
        transition: all var(--transition-base);
        border: 1px solid var(--gray-100);
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-500), var(--accent-500));
        transform: scaleX(0);
        transition: transform var(--transition-base);
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-card.featured {
        grid-column: span 2;
        grid-row: span 2;
        background: linear-gradient(135deg, var(--secondary-800), var(--secondary-900));
        color: white;
    }

    .feature-card.featured .feature-icon {
        background: rgba(255,255,255,0.1);
        color: var(--accent-300);
    }

    .feature-card.featured h3 {
        color: white;
    }

    .feature-card.featured p {
        color: var(--gray-300);
    }

    .feature-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--primary-50), var(--primary-100));
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-2xl);
        color: var(--primary-600);
        margin-bottom: var(--space-5);
        transition: all var(--transition-base);
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .feature-card h3 {
        font-size: var(--text-xl);
        margin-bottom: var(--space-3);
        color: var(--text-primary);
    }

    .feature-card p {
        font-size: var(--text-sm);
        color: var(--text-secondary);
        line-height: 1.7;
    }

    @media (max-width: 1024px) {
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .feature-card.featured {
            grid-column: span 2;
            grid-row: span 1;
        }
    }

    @media (max-width: 640px) {
        .features-grid {
            grid-template-columns: 1fr;
        }
        .feature-card.featured {
            grid-column: span 1;
        }
    }

    /* ============================================
       ABOUT SECTION - Modern Split
    ============================================ */
    .about-section {
        padding: var(--space-24) 0;
        background: white;
        position: relative;
        overflow: hidden;
    }

    .about-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, var(--primary-100) 0%, transparent 70%);
        opacity: 0.5;
        pointer-events: none;
    }

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-16);
        align-items: center;
    }

    .about-images {
        position: relative;
    }

    .about-image-main {
        border-radius: var(--radius-3xl);
        overflow: hidden;
        box-shadow: var(--shadow-2xl);
        position: relative;
        z-index: 1;
    }

    .about-image-main img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        transition: transform var(--transition-slow);
    }

    .about-image-main:hover img {
        transform: scale(1.05);
    }

    .about-image-float {
        position: absolute;
        bottom: -30px;
        right: -30px;
        width: 250px;
        height: 180px;
        border-radius: var(--radius-2xl);
        overflow: hidden;
        box-shadow: var(--shadow-xl);
        border: 4px solid white;
        z-index: 2;
    }

    .about-image-float img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .about-experience {
        position: absolute;
        top: 30px;
        left: -30px;
        background: white;
        padding: var(--space-6);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-xl);
        z-index: 2;
        text-align: center;
        min-width: 140px;
    }

    .about-experience-value {
        font-family: var(--font-display);
        font-size: var(--text-4xl);
        color: var(--primary-600);
        line-height: 1;
    }

    .about-experience-label {
        font-size: var(--text-sm);
        color: var(--text-secondary);
        margin-top: var(--space-1);
    }

    .about-content h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        margin-bottom: var(--space-6);
    }

    .about-content > p {
        font-size: var(--text-lg);
        color: var(--text-secondary);
        line-height: 1.8;
        margin-bottom: var(--space-8);
    }

    .about-features {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-5);
        margin-bottom: var(--space-8);
    }

    .about-feature {
        display: flex;
        align-items: flex-start;
        gap: var(--space-3);
    }

    .about-feature i {
        width: 24px;
        height: 24px;
        background: var(--primary-100);
        color: var(--primary-600);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--text-xs);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .about-feature span {
        font-size: var(--text-sm);
        font-weight: 500;
        color: var(--text-primary);
    }

    @media (max-width: 1024px) {
        .about-grid {
            grid-template-columns: 1fr;
            gap: var(--space-12);
        }
        .about-images {
            max-width: 600px;
            margin: 0 auto;
        }
    }

    @media (max-width: 640px) {
        .about-image-float {
            width: 180px;
            height: 130px;
            right: -10px;
            bottom: -20px;
        }
        .about-experience {
            left: -10px;
            padding: var(--space-4);
        }
        .about-experience-value {
            font-size: var(--text-3xl);
        }
    }

    /* ============================================
       PACKAGES SECTION - Modern Cards
    ============================================ */
    .packages-section {
        padding: var(--space-24) 0;
        background: linear-gradient(180deg, var(--bg-secondary) 0%, white 100%);
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-8);
        max-width: 1200px;
        margin: 0 auto;
    }

    .package-card {
        background: white;
        border-radius: var(--radius-3xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all var(--transition-base);
        border: 1px solid var(--gray-100);
        position: relative;
    }

    .package-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-2xl);
    }

    .package-badge {
        position: absolute;
        top: var(--space-4);
        left: var(--space-4);
        background: linear-gradient(135deg, var(--accent-500), var(--accent-600));
        color: white;
        padding: var(--space-1) var(--space-3);
        border-radius: var(--radius-full);
        font-size: var(--text-xs);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        z-index: 2;
    }

    .package-image {
        position: relative;
        height: 240px;
        overflow: hidden;
    }

    .package-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-slow);
    }

    .package-card:hover .package-image img {
        transform: scale(1.1);
    }

    .package-duration {
        position: absolute;
        bottom: var(--space-4);
        right: var(--space-4);
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(10px);
        color: white;
        padding: var(--space-2) var(--space-3);
        border-radius: var(--radius-lg);
        font-size: var(--text-xs);
        font-weight: 500;
    }

    .package-content {
        padding: var(--space-6);
    }

    .package-title {
        font-size: var(--text-xl);
        margin-bottom: var(--space-2);
    }

    .package-description {
        font-size: var(--text-sm);
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: var(--space-4);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .package-features {
        display: flex;
        flex-wrap: wrap;
        gap: var(--space-2);
        margin-bottom: var(--space-5);
    }

    .package-feature {
        font-size: var(--text-xs);
        color: var(--text-secondary);
        background: var(--gray-100);
        padding: var(--space-1) var(--space-2);
        border-radius: var(--radius-md);
    }

    .package-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: var(--space-4);
        border-top: 1px solid var(--gray-100);
    }

    .package-price {
        display: flex;
        align-items: baseline;
        gap: var(--space-1);
    }

    .package-price-value {
        font-family: var(--font-display);
        font-size: var(--text-2xl);
        color: var(--primary-600);
    }

    .package-price-suffix {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .package-cta {
        width: 40px;
        height: 40px;
        background: var(--primary-50);
        color: var(--primary-600);
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all var(--transition-base);
    }

    .package-cta:hover {
        background: var(--primary-600);
        color: white;
        transform: translateX(4px);
    }

    @media (max-width: 1024px) {
        .packages-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .packages-grid {
            grid-template-columns: 1fr;
        }
    }

    /* ============================================
       DESTINATIONS SECTION
    ============================================ */
    .destinations-section {
        padding: var(--space-24) 0;
        background: var(--gray-900);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .destinations-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.03)"/></svg>');
        background-size: 50px 50px;
        pointer-events: none;
    }

    .destinations-section .section-kicker {
        color: var(--accent-400);
    }

    .destinations-section .section-title {
        color: white;
    }

    .destinations-section .section-subtitle {
        color: var(--gray-400);
    }

    .destinations-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--space-6);
    }

    .destination-card {
        position: relative;
        border-radius: var(--radius-2xl);
        overflow: hidden;
        aspect-ratio: 3/4;
        cursor: pointer;
        group: destination;
    }

    .destination-card.large {
        grid-column: span 2;
        grid-row: span 2;
    }

    .destination-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-slow);
    }

    .destination-card:hover img {
        transform: scale(1.1);
    }

    .destination-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 60%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: var(--space-6);
        transition: all var(--transition-base);
    }

    .destination-card:hover .destination-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 100%);
    }

    .destination-name {
        font-size: var(--text-xl);
        color: white;
        margin-bottom: var(--space-1);
        transform: translateY(20px);
        opacity: 0;
        transition: all var(--transition-base);
    }

    .destination-card:hover .destination-name {
        transform: translateY(0);
        opacity: 1;
    }

    .destination-location {
        font-size: var(--text-sm);
        color: var(--gray-300);
        display: flex;
        align-items: center;
        gap: var(--space-2);
        transform: translateY(20px);
        opacity: 0;
        transition: all var(--transition-base) 0.1s;
    }

    .destination-card:hover .destination-location {
        transform: translateY(0);
        opacity: 1;
    }

    @media (max-width: 1024px) {
        .destinations-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .destination-card.large {
            grid-column: span 2;
            grid-row: span 1;
            aspect-ratio: 16/9;
        }
    }

    @media (max-width: 640px) {
        .destinations-grid {
            grid-template-columns: 1fr;
        }
        .destination-card.large {
            grid-column: span 1;
        }
    }

    /* ============================================
       TESTIMONIALS SECTION
    ============================================ */
    .testimonials-section {
        padding: var(--space-24) 0;
        background: white;
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-8);
    }

    .testimonial-card {
        background: var(--gray-50);
        border-radius: var(--radius-2xl);
        padding: var(--space-8);
        position: relative;
        transition: all var(--transition-base);
    }

    .testimonial-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .testimonial-card.featured {
        background: linear-gradient(135deg, var(--secondary-800), var(--secondary-900));
        color: white;
    }

    .testimonial-card.featured .testimonial-text {
        color: var(--gray-200);
    }

    .testimonial-card.featured .testimonial-author-name {
        color: white;
    }

    .testimonial-quote {
        font-size: var(--text-4xl);
        color: var(--primary-300);
        line-height: 1;
        margin-bottom: var(--space-4);
        font-family: Georgia, serif;
    }

    .testimonial-text {
        font-size: var(--text-base);
        color: var(--text-secondary);
        line-height: 1.8;
        margin-bottom: var(--space-6);
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: var(--space-4);
    }

    .testimonial-author-avatar {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-full);
        object-fit: cover;
        border: 2px solid white;
        box-shadow: var(--shadow-md);
    }

    .testimonial-author-info {
        flex: 1;
    }

    .testimonial-author-name {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: var(--space-1);
    }

    .testimonial-author-location {
        font-size: var(--text-sm);
        color: var(--text-muted);
    }

    .testimonial-rating {
        color: var(--accent-400);
        font-size: var(--text-sm);
    }

    @media (max-width: 1024px) {
        .testimonials-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .testimonials-grid {
            grid-template-columns: 1fr;
        }
    }

    /* ============================================
       CTA SECTION
    ============================================ */
    .cta-section {
        padding: var(--space-24) 0;
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .cta-section::after {
        content: '';
        position: absolute;
        bottom: -50%;
        left: -20%;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .cta-content {
        text-align: center;
        max-width: 700px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        color: white;
    }

    .cta-content h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        margin-bottom: var(--space-6);
    }

    .cta-content p {
        font-size: var(--text-lg);
        color: rgba(255,255,255,0.9);
        margin-bottom: var(--space-8);
        line-height: 1.8;
    }

    .cta-buttons {
        display: flex;
        gap: var(--space-4);
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-white {
        background: white;
        color: var(--primary-700);
        padding: var(--space-4) var(--space-8);
        border-radius: var(--radius-full);
        font-weight: 600;
        text-decoration: none;
        transition: all var(--transition-base);
        box-shadow: var(--shadow-lg);
    }

    .btn-white:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-xl);
    }

    .btn-outline-white-2 {
        background: transparent;
        color: white;
        padding: var(--space-4) var(--space-8);
        border-radius: var(--radius-full);
        font-weight: 600;
        text-decoration: none;
        border: 2px solid rgba(255,255,255,0.3);
        transition: all var(--transition-base);
    }

    .btn-outline-white-2:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.5);
    }

    /* ============================================
       NEWSLETTER SECTION
    ============================================ */
    .newsletter-section {
        padding: var(--space-16) 0;
        background: var(--gray-100);
    }

    .newsletter-box {
        background: white;
        border-radius: var(--radius-3xl);
        padding: var(--space-12) var(--space-8);
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        box-shadow: var(--shadow-lg);
    }

    .newsletter-box h3 {
        font-size: var(--text-2xl);
        margin-bottom: var(--space-3);
    }

    .newsletter-box p {
        color: var(--text-secondary);
        margin-bottom: var(--space-6);
    }

    .newsletter-form-inline {
        display: flex;
        gap: var(--space-3);
        max-width: 500px;
        margin: 0 auto;
    }

    .newsletter-form-inline input {
        flex: 1;
        padding: var(--space-4) var(--space-5);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-full);
        font-size: var(--text-base);
        outline: none;
        transition: all var(--transition-fast);
    }

    .newsletter-form-inline input:focus {
        border-color: var(--primary-500);
        box-shadow: 0 0 0 4px rgba(196, 81, 47, 0.1);
    }

    @media (max-width: 640px) {
        .newsletter-form-inline {
            flex-direction: column;
        }
    }

    /* Trust Indicators */
    .trust-indicators {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-8);
        margin-top: var(--space-16);
        padding: var(--space-6) var(--space-8);
        background: white;
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-lg);
        flex-wrap: wrap;
    }

    .trust-item {
        display: flex;
        align-items: center;
        gap: var(--space-3);
        color: var(--text-secondary);
        font-size: var(--text-sm);
    }

    .trust-item i {
        font-size: var(--text-xl);
        color: var(--primary-600);
    }

    .trust-item strong {
        color: var(--text-primary);
    }

    .trust-divider {
        width: 1px;
        height: 30px;
        background: var(--gray-200);
    }

    @media (max-width: 768px) {
        .trust-indicators {
            flex-direction: column;
            gap: var(--space-4);
        }
        .trust-divider {
            width: 100%;
            height: 1px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" class="active" alt="Serengeti">
        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Elephants">
        <img src="https://images.unsplash.com/photo-1523805009345-7448845a9e53?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Lion">
        <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Zanzibar">
    </div>
    <div class="hero-overlay"></div>
    
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fas fa-award"></i>
            Tanzania's Leading Safari Operator
        </div>
        <h1>
            Discover the Wild Heart of Africa
            <span>Unforgettable Safari Adventures Await</span>
        </h1>
        <p class="hero-description">
            Experience the breathtaking beauty of Tanzania's national parks, witness the Great Migration, 
            and create memories that will last a lifetime with our expert-guided safaris.
        </p>
        <div class="hero-actions">
            <a href="{{ route('packages') }}" class="btn btn-accent btn-lg">
                Explore Packages <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('about') }}" class="btn btn-outline-white btn-lg">
                <i class="fas fa-play"></i> Watch Video
            </a>
        </div>
    </div>

    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat-value">15+</div>
            <div class="hero-stat-label">Years Experience</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value">10k+</div>
            <div class="hero-stat-label">Happy Travelers</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value">50+</div>
            <div class="hero-stat-label">Safari Packages</div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-value">4.9</div>
            <div class="hero-stat-label">Rating</div>
        </div>
    </div>
</section>

<!-- Features Section - Bento Grid -->
<section class="features-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-star"></i> Why Choose Us
            </div>
            <h2 class="section-title">The Ultimate Safari Experience</h2>
            <p class="section-subtitle">
                We combine local expertise with world-class service to deliver unforgettable 
                adventures that exceed your expectations.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card featured" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <i class="fas fa-compass"></i>
                </div>
                <h3>Expert Local Guides</h3>
                <p>Our certified guides have over 10 years of experience navigating Tanzania's wilderness. They know every corner of the national parks and can spot wildlife others miss.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Safety First</h3>
                <p>Your safety is our priority. All our vehicles are equipped with modern safety features and communication systems.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h3>Luxury Accommodations</h3>
                <p>From boutique lodges to luxury tented camps, we partner with the finest properties in Tanzania.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3>Eco-Friendly Tours</h3>
                <p>We're committed to sustainable tourism practices that protect wildlife and support local communities.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <h3>Photography Focus</h3>
                <p>Specialized photography safaris with expert tips and prime positioning for the perfect shot.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-images" data-aos="fade-right">
                <div class="about-image-main">
                    <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Safari Adventure">
                </div>
                <div class="about-image-float" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1534177616072-ef7dc12044f2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Tanzania Landscape">
                </div>
                <div class="about-experience" data-aos="zoom-in" data-aos-delay="400">
                    <div class="about-experience-value">15+</div>
                    <div class="about-experience-label">Years of Excellence</div>
                </div>
            </div>

            <div class="about-content" data-aos="fade-left">
                <div class="section-kicker">
                    <i class="fas fa-info-circle"></i> About Us
                </div>
                <h2>Crafting Unforgettable Safari Experiences Since 2009</h2>
                <p>
                    Tanzalian Safari's is more than just a tour operator – we're your gateway to the 
                    authentic heart of Africa. With deep roots in Tanzania and a passion for wildlife, 
                    we create personalized journeys that connect you with nature in its purest form.
                </p>

                <div class="about-features">
                    <div class="about-feature">
                        <i class="fas fa-check"></i>
                        <span>Certified Safari Guides</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check"></i>
                        <span>Customized Itineraries</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check"></i>
                        <span>24/7 Support</span>
                    </div>
                    <div class="about-feature">
                        <i class="fas fa-check"></i>
                        <span>Best Price Guarantee</span>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="btn btn-primary">
                    Learn Our Story <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Packages Section -->
<section class="packages-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-suitcase"></i> Popular Packages
            </div>
            <h2 class="section-title">Curated Safari Experiences</h2>
            <p class="section-subtitle">
                Choose from our handpicked selection of safari packages designed to showcase 
                the best of Tanzania's wildlife and landscapes.
            </p>
        </div>

        <div class="packages-grid">
            @forelse($featuredPackages->take(3) as $package)
            <div class="package-card" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                @if($loop->first)
                    <div class="package-badge">Most Popular</div>
                @endif
                <div class="package-image">
                    <img src="{{ $package->image_path ?? 'https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $package->name }}">
                    <div class="package-duration">
                        <i class="fas fa-clock"></i> {{ $package->duration_label }}
                    </div>
                </div>
                <div class="package-content">
                    <h3 class="package-title">{{ $package->name }}</h3>
                    <p class="package-description">{{ $package->short_description }}</p>
                    <div class="package-features">
                        <span class="package-feature"><i class="fas fa-user"></i> 2-6 People</span>
                        <span class="package-feature"><i class="fas fa-car"></i> 4x4 Vehicle</span>
                        <span class="package-feature"><i class="fas fa-utensils"></i> Meals</span>
                    </div>
                    <div class="package-footer">
                        <div class="package-price">
                            <span class="package-price-value">${{ number_format($package->price_amount) }}</span>
                            <span class="package-price-suffix">/ person</span>
                        </div>
                        <a href="{{ route('packages.show', $package->id) }}" class="package-cta" title="View Details">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <!-- Fallback packages when none in database -->
            <div class="package-card" data-aos="fade-up" data-aos-delay="100">
                <div class="package-badge">Most Popular</div>
                <div class="package-image">
                    <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Serengeti Safari">
                    <div class="package-duration"><i class="fas fa-clock"></i> 5 Days</div>
                </div>
                <div class="package-content">
                    <h3 class="package-title">Classic Serengeti Safari</h3>
                    <p class="package-description">Witness the incredible wildlife of Serengeti and Ngorongoro Crater on this unforgettable journey.</p>
                    <div class="package-features">
                        <span class="package-feature"><i class="fas fa-user"></i> 2-6 People</span>
                        <span class="package-feature"><i class="fas fa-car"></i> 4x4 Vehicle</span>
                        <span class="package-feature"><i class="fas fa-utensils"></i> Meals</span>
                    </div>
                    <div class="package-footer">
                        <div class="package-price">
                            <span class="package-price-value">$2,450</span>
                            <span class="package-price-suffix">/ person</span>
                        </div>
                        <a href="{{ route('packages') }}" class="package-cta" title="View All Packages"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="package-card" data-aos="fade-up" data-aos-delay="200">
                <div class="package-image">
                    <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Zanzibar Beach">
                    <div class="package-duration"><i class="fas fa-clock"></i> 7 Days</div>
                </div>
                <div class="package-content">
                    <h3 class="package-title">Safari & Zanzibar Beach</h3>
                    <p class="package-description">Combine thrilling game drives with relaxing days on Zanzibar's pristine white sand beaches.</p>
                    <div class="package-features">
                        <span class="package-feature"><i class="fas fa-user"></i> 2-6 People</span>
                        <span class="package-feature"><i class="fas fa-plane"></i> Flight</span>
                        <span class="package-feature"><i class="fas fa-hotel"></i> Resort</span>
                    </div>
                    <div class="package-footer">
                        <div class="package-price">
                            <span class="package-price-value">$3,890</span>
                            <span class="package-price-suffix">/ person</span>
                        </div>
                        <a href="{{ route('packages') }}" class="package-cta" title="View All Packages"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="package-card" data-aos="fade-up" data-aos-delay="300">
                <div class="package-image">
                    <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Migration Safari">
                    <div class="package-duration"><i class="fas fa-clock"></i> 8 Days</div>
                </div>
                <div class="package-content">
                    <h3 class="package-title">Great Migration Experience</h3>
                    <p class="package-description">Follow the world-famous wildebeest migration across the Serengeti plains.</p>
                    <div class="package-features">
                        <span class="package-feature"><i class="fas fa-user"></i> 2-6 People</span>
                        <span class="package-feature"><i class="fas fa-campground"></i> Luxury Camp</span>
                        <span class="package-feature"><i class="fas fa-binoculars"></i> Game Drives</span>
                    </div>
                    <div class="package-footer">
                        <div class="package-price">
                            <span class="package-price-value">$4,650</span>
                            <span class="package-price-suffix">/ person</span>
                        </div>
                        <a href="{{ route('packages') }}" class="package-cta" title="View All Packages"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: var(--space-12);" data-aos="fade-up">
            <a href="{{ route('packages') }}" class="btn btn-outline btn-lg">
                View All Packages <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Trust Indicators -->
        <div class="trust-indicators" data-aos="fade-up" data-aos-delay="200">
            <div class="trust-item">
                <i class="fas fa-shield-check"></i>
                <span><strong>100% Secure</strong> Bookings</span>
            </div>
            <div class="trust-divider"></div>
            <div class="trust-item">
                <i class="fas fa-undo"></i>
                <span><strong>Free Cancellation</strong> up to 30 days</span>
            </div>
            <div class="trust-divider"></div>
            <div class="trust-item">
                <i class="fas fa-headset"></i>
                <span><strong>24/7 Support</strong> during your trip</span>
            </div>
            <div class="trust-divider"></div>
            <div class="trust-item">
                <i class="fas fa-medal"></i>
                <span><strong>Best Price</strong> Guarantee</span>
            </div>
        </div>
    </div>
</section>

<!-- Destinations Section -->
<section class="destinations-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-map-marker-alt"></i> Destinations
            </div>
            <h2 class="section-title">Explore Tanzania's Treasures</h2>
            <p class="section-subtitle">
                From the endless plains of the Serengeti to the pristine beaches of Zanzibar, 
                discover Tanzania's most iconic destinations.
            </p>
        </div>

        <div class="destinations-grid">
            <div class="destination-card large" data-aos="fade-up" data-aos-delay="100">
                <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Serengeti">
                <div class="destination-overlay">
                    <h3 class="destination-name">Serengeti National Park</h3>
                    <p class="destination-location"><i class="fas fa-map-pin"></i> Northern Tanzania</p>
                </div>
            </div>

            <div class="destination-card" data-aos="fade-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1587595431973-160d0d94add1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Ngorongoro">
                <div class="destination-overlay">
                    <h3 class="destination-name">Ngorongoro Crater</h3>
                    <p class="destination-location"><i class="fas fa-map-pin"></i> Crater Highlands</p>
                </div>
            </div>

            <div class="destination-card" data-aos="fade-up" data-aos-delay="300">
                <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Zanzibar">
                <div class="destination-overlay">
                    <h3 class="destination-name">Zanzibar</h3>
                    <p class="destination-location"><i class="fas fa-map-pin"></i> Spice Islands</p>
                </div>
            </div>

            <div class="destination-card" data-aos="fade-up" data-aos-delay="400">
                <img src="https://images.unsplash.com/photo-1551009175-8a68da93d5f9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Kilimanjaro">
                <div class="destination-overlay">
                    <h3 class="destination-name">Mt. Kilimanjaro</h3>
                    <p class="destination-location"><i class="fas fa-map-pin"></i> Northern Tanzania</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-heart"></i> Testimonials
            </div>
            <h2 class="section-title">What Our Travelers Say</h2>
            <p class="section-subtitle">
                Don't just take our word for it – hear from the thousands of travelers 
                who've experienced the magic of Tanzania with us.
            </p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text">
                    Absolutely incredible experience! Our guide was so knowledgeable and we saw the Big Five 
                    within the first two days. The accommodations were top-notch.
                </p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Johnson" class="testimonial-author-avatar">
                    <div class="testimonial-author-info">
                        <div class="testimonial-author-name">Sarah Johnson</div>
                        <div class="testimonial-author-location">United Kingdom</div>
                    </div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i> 5.0
                    </div>
                </div>
            </div>

            <div class="testimonial-card featured" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text">
                    The Great Migration safari exceeded all my expectations. Witnessing thousands of 
                    wildebeest crossing the Mara River was a life-changing moment. Tanzalian Safari's 
                    handled every detail perfectly.
                </p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="testimonial-author-avatar">
                    <div class="testimonial-author-info">
                        <div class="testimonial-author-name">Michael Chen</div>
                        <div class="testimonial-author-location">Singapore</div>
                    </div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i> 5.0
                    </div>
                </div>
            </div>

            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text">
                    We took our family of 5 on safari and it was the best vacation we've ever had. 
                    The kids loved every moment and learned so much about wildlife and conservation.
                </p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emma Schmidt" class="testimonial-author-avatar">
                    <div class="testimonial-author-info">
                        <div class="testimonial-author-name">Emma Schmidt</div>
                        <div class="testimonial-author-location">Germany</div>
                    </div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i> 5.0
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meet Our Guides Section -->
<section class="section-padding" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-users"></i> Expert Team
            </div>
            <h2 class="section-title">Meet Your Safari Guides</h2>
            <p class="section-subtitle">
                Our certified professional guides are passionate about wildlife and dedicated to making your safari unforgettable.
            </p>
        </div>

        <div class="guides-preview-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 40px;">
            @forelse($teamMembers as $index => $member)
            <div class="guide-preview-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-md); text-align: center;">
                <div style="height: 200px; overflow: hidden;">
                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h4 style="font-size: 18px; margin-bottom: 4px;">{{ $member->name }}</h4>
                    <p style="font-size: 13px; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">{{ $member->position }}</p>
                    @if($member->experience_years > 0)
                        <p style="font-size: 12px; color: var(--text-secondary);">{{ $member->experience_years }} Years Experience</p>
                    @endif
                </div>
            </div>
            @empty
            <!-- Default guide cards if no team members added -->
            <div class="guide-preview-card" data-aos="fade-up" data-aos-delay="100" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-md); text-align: center;">
                <div style="height: 200px; overflow: hidden;">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Guide" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 20px;">
                    <h4 style="font-size: 18px; margin-bottom: 4px;">Expert Guide</h4>
                    <p style="font-size: 13px; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">Senior Guide</p>
                    <p style="font-size: 12px; color: var(--text-secondary);">10+ Years Experience</p>
                </div>
            </div>
            @endforelse
        </div>

        <div style="text-align: center;" data-aos="fade-up">
            <a href="{{ route('guides') }}" class="btn btn-outline btn-lg">
                Meet All Our Guides <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2>Ready to Start Your Adventure?</h2>
            <p>
                Let us craft your perfect safari experience. Our travel experts are ready to 
                design a personalized itinerary that matches your dreams and budget.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('booking') }}" class="btn-white">
                    <i class="fas fa-calendar-check"></i> Book Now
                </a>
                <a href="https://wa.me/255691111111" class="btn-outline-white-2">
                    <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-box" data-aos="fade-up">
            <h3>Get Travel Inspiration</h3>
            <p>Subscribe to our newsletter for exclusive deals, travel tips, and safari inspiration.</p>
            <form class="newsletter-form-inline" action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Hero Slideshow with Ken Burns effect
    const heroImages = document.querySelectorAll('.hero-bg img');
    let currentImage = 0;

    function rotateHeroImages() {
        heroImages[currentImage].classList.remove('active');
        currentImage = (currentImage + 1) % heroImages.length;
        heroImages[currentImage].classList.add('active');
    }

    setInterval(rotateHeroImages, 6000);

    // Animate hero stats counter
    const stats = document.querySelectorAll('.hero-stat-value');
    
    const animateCounter = (element, target) => {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + (element.textContent.includes('+') ? '+' : '');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + (element.textContent.includes('+') ? '+' : '');
            }
        }, 30);
    };

    // Intersection Observer for stats animation
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const value = entry.target.textContent;
                const numericValue = parseInt(value);
                if (!isNaN(numericValue)) {
                    animateCounter(entry.target, numericValue);
                }
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    stats.forEach(stat => statsObserver.observe(stat));
</script>
@endsection

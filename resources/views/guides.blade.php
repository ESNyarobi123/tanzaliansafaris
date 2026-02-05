@extends('layouts.app')

@section('title', 'Meet Your Safari Guides - Expert Local Guides | Tanzalian Safari\'s')

@section('styles')
<style>
    /* ============================================
       GUIDES PAGE - Meet Your Safari Guides
    ============================================ */
    
    /* Hero Section */
    .guides-hero {
        position: relative;
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--gray-900) 0%, #1a365d 50%, var(--secondary-900) 100%);
        overflow: hidden;
        padding: 120px 0 80px;
    }

    .guides-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center/cover;
        opacity: 0.3;
    }

    .guides-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.9));
    }

    .guides-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        padding: 0 20px;
        color: white;
    }

    .guides-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        color: var(--accent-300);
        margin-bottom: 24px;
    }

    .guides-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .guides-hero p {
        font-size: 18px;
        color: var(--gray-300);
        line-height: 1.8;
        max-width: 600px;
        margin: 0 auto;
    }

    .guides-stats {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-top: 40px;
        padding-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .guides-stat {
        text-align: center;
    }

    .guides-stat-value {
        font-family: var(--font-display);
        font-size: 48px;
        color: var(--accent-400);
        line-height: 1;
    }

    .guides-stat-label {
        font-size: 14px;
        color: var(--gray-400);
        margin-top: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width: 768px) {
        .guides-stats {
            gap: 30px;
            flex-wrap: wrap;
        }
        .guides-stat-value {
            font-size: 36px;
        }
    }

    /* Why Our Guides Section */
    .why-guides-section {
        padding: 100px 0;
        background: var(--bg-secondary);
    }

    .why-guides-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin-top: 60px;
    }

    .why-guide-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-100);
        transition: all 0.3s;
    }

    .why-guide-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .why-guide-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-100), var(--primary-200));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: var(--primary-600);
        margin: 0 auto 24px;
        transition: all 0.3s;
    }

    .why-guide-card:hover .why-guide-icon {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        color: white;
    }

    .why-guide-card h3 {
        font-size: 20px;
        margin-bottom: 12px;
    }

    .why-guide-card p {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.7;
    }

    @media (max-width: 1024px) {
        .why-guides-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .why-guides-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Guides Grid */
    .guides-section {
        padding: 100px 0;
        background: white;
    }

    .guides-filter {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-bottom: 60px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 12px 24px;
        background: var(--gray-100);
        border: none;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.3s;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--primary-600);
        color: white;
    }

    .guides-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }

    /* Guide Card */
    .guide-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        transition: all 0.4s;
        position: relative;
    }

    .guide-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-2xl);
    }

    .guide-card.featured {
        grid-column: span 1;
        grid-row: span 1;
    }

    .guide-card.featured .guide-badge {
        background: linear-gradient(135deg, var(--accent-500), var(--accent-600));
    }

    .guide-image-wrap {
        position: relative;
        height: 320px;
        overflow: hidden;
    }

    .guide-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .guide-card:hover .guide-image {
        transform: scale(1.05);
    }

    .guide-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--primary-600);
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
    }

    .guide-experience-badge {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        color: white;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        z-index: 2;
    }

    .guide-experience-badge i {
        color: var(--accent-400);
        margin-right: 6px;
    }

    .guide-content {
        padding: 30px;
    }

    .guide-header {
        margin-bottom: 20px;
    }

    .guide-name {
        font-size: 24px;
        margin-bottom: 4px;
    }

    .guide-title {
        font-size: 14px;
        color: var(--primary-600);
        font-weight: 600;
    }

    .guide-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
    }

    .guide-stars {
        color: var(--accent-500);
        font-size: 14px;
    }

    .guide-rating-text {
        font-size: 13px;
        color: var(--text-secondary);
    }

    .guide-bio {
        font-size: 14px;
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .guide-specialties {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }

    .specialty-tag {
        background: var(--gray-100);
        color: var(--text-secondary);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .guide-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-100);
    }

    .guide-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .guide-info-icon {
        width: 36px;
        height: 36px;
        background: var(--primary-50);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: var(--primary-600);
    }

    .guide-info-content {
        display: flex;
        flex-direction: column;
    }

    .guide-info-label {
        font-size: 11px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .guide-info-value {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .guide-cta {
        margin-top: 24px;
        display: flex;
        gap: 12px;
    }

    .btn-guide-primary {
        flex: 1;
        padding: 14px 20px;
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-guide-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(196, 81, 47, 0.3);
    }

    .btn-guide-secondary {
        width: 48px;
        height: 48px;
        background: var(--gray-100);
        border: none;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-guide-secondary:hover {
        background: #25D366;
        color: white;
    }

    @media (max-width: 1024px) {
        .guides-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .guides-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Guide Detail Modal */
    .guide-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        z-index: 2000;
        overflow-y: auto;
        padding: 40px 20px;
    }

    .guide-modal.active {
        display: block;
    }

    .guide-modal-content {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
    }

    .guide-modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s;
    }

    .guide-modal-close:hover {
        background: white;
        transform: rotate(90deg);
    }

    /* Testimonials Section */
    .guide-testimonials {
        padding: 100px 0;
        background: linear-gradient(135deg, var(--secondary-800), var(--secondary-900));
        color: white;
    }

    .guide-testimonials .section-header h2,
    .guide-testimonials .section-header p {
        color: white;
    }

    .testimonial-carousel {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 60px;
    }

    .guide-testimonial-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 30px;
    }

    .guide-testimonial-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .guide-testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--accent-400);
    }

    .guide-testimonial-info h4 {
        font-size: 16px;
        margin-bottom: 4px;
    }

    .guide-testimonial-info span {
        font-size: 13px;
        color: var(--gray-300);
    }

    .guide-testimonial-text {
        font-size: 15px;
        line-height: 1.8;
        color: var(--gray-200);
        font-style: italic;
    }

    .guide-testimonial-rating {
        margin-top: 16px;
        color: var(--accent-400);
    }

    @media (max-width: 1024px) {
        .testimonial-carousel {
            grid-template-columns: 1fr;
        }
    }

    /* CTA Section */
    .guides-cta-section {
        padding: 100px 0;
        background: var(--bg-secondary);
        text-align: center;
    }

    .guides-cta-content {
        max-width: 700px;
        margin: 0 auto;
    }

    .guides-cta-content h2 {
        font-size: 36px;
        margin-bottom: 20px;
    }

    .guides-cta-content p {
        font-size: 18px;
        color: var(--text-secondary);
        margin-bottom: 40px;
        line-height: 1.7;
    }

    .guides-cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="guides-hero">
    <div class="guides-hero-overlay"></div>
    <div class="guides-hero-content">
        <div class="guides-hero-badge">
            <i class="fas fa-certificate"></i>
            Certified Professional Guides
        </div>
        <h1>Meet Your Safari Guides</h1>
        <p>Our team of expert local guides are passionate about wildlife and dedicated to making your safari unforgettable. With decades of combined experience, they know every corner of Tanzania's national parks.</p>
        
        <div class="guides-stats">
            <div class="guides-stat">
                <div class="guides-stat-value">15+</div>
                <div class="guides-stat-label">Expert Guides</div>
            </div>
            <div class="guides-stat">
                <div class="guides-stat-value">150+</div>
                <div class="guides-stat-label">Years Combined Experience</div>
            </div>
            <div class="guides-stat">
                <div class="guides-stat-value">10k+</div>
                <div class="guides-stat-label">Happy Travelers</div>
            </div>
        </div>
    </div>
</section>

<!-- Why Our Guides Section -->
<section class="why-guides-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-star"></i> Why Choose Our Guides
            </div>
            <h2 class="section-title">The Best in the Business</h2>
            <p class="section-subtitle">
                Our guides are more than just drivers – they're wildlife experts, storytellers, 
                and your personal connection to the incredible landscapes of Tanzania.
            </p>
        </div>

        <div class="why-guides-grid">
            <div class="why-guide-card" data-aos="fade-up" data-aos-delay="100">
                <div class="why-guide-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Certified Experts</h3>
                <p>All guides are certified by the Tanzania National Parks Authority (TANAPA) and undergo rigorous training.</p>
            </div>

            <div class="why-guide-card" data-aos="fade-up" data-aos-delay="200">
                <div class="why-guide-icon">
                    <i class="fas fa-language"></i>
                </div>
                <h3>Multilingual</h3>
                <p>Our guides speak English, Swahili, and many speak French, German, Spanish, and Italian.</p>
            </div>

            <div class="why-guide-card" data-aos="fade-up" data-aos-delay="300">
                <div class="why-guide-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Passionate</h3>
                <p>Born and raised in Tanzania, our guides have a deep love and respect for wildlife and nature.</p>
            </div>

            <div class="why-guide-card" data-aos="fade-up" data-aos-delay="400">
                <div class="why-guide-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Safety First</h3>
                <p>Trained in first aid, wildlife behavior, and emergency procedures to keep you safe.</p>
            </div>
        </div>
    </div>
</section>

<!-- Guides Grid -->
<section class="guides-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-users"></i> Our Team
            </div>
            <h2 class="section-title">Meet The Experts</h2>
            <p class="section-subtitle">
                Each of our guides brings unique skills and specialties. 
                Browse their profiles to learn more about who might lead your safari.
            </p>
        </div>

        <!-- Filter Buttons -->
        <div class="guides-filter" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">All Guides</button>
            <button class="filter-btn" data-filter="senior">Senior Guides</button>
            <button class="filter-btn" data-filter="birding">Birding Experts</button>
            <button class="filter-btn" data-filter="photography">Photo Specialists</button>
            <button class="filter-btn" data-filter="cultural">Cultural Experts</button>
        </div>

        <!-- Guides Grid -->
        <div class="guides-grid">
            <!-- Guide 1 - Senior Guide -->
            <div class="guide-card featured" data-aos="fade-up" data-category="senior photography" data-aos-delay="100">
                <div class="guide-image-wrap">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="John Makala" class="guide-image">
                    <div class="guide-badge">Head Guide</div>
                    <div class="guide-experience-badge">
                        <i class="fas fa-medal"></i>
                        18 Years Experience
                    </div>
                </div>
                <div class="guide-content">
                    <div class="guide-header">
                        <h3 class="guide-name">John Makala</h3>
                        <div class="guide-title">Senior Safari Guide & Photography Expert</div>
                        <div class="guide-rating">
                            <span class="guide-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="guide-rating-text">5.0 (280 reviews)</span>
                        </div>
                    </div>
                    
                    <p class="guide-bio">
                        Born in Dar es salaam, John has been guiding safaris for 18 years. He's an expert in big cat behavior and a passionate wildlife photographer. His knowledge of the Serengeti ecosystem is unmatched.
                    </p>

                    <div class="guide-specialties">
                        <span class="specialty-tag">Big Cats</span>
                        <span class="specialty-tag">Photography</span>
                        <span class="specialty-tag">Serengeti</span>
                    </div>

                    <div class="guide-info-grid">
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Languages</span>
                                <span class="guide-info-value">English, Swahili, French</span>
                            </div>
                        </div>
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Specialty</span>
                                <span class="guide-info-value">Big Five Tracking</span>
                            </div>
                        </div>
                    </div>

                    <div class="guide-cta">
                        <a href="{{ route('booking') }}" class="btn-guide-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book with John
                        </a>
                        <a href="https://wa.me/255691111111" class="btn-guide-secondary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Guide 2 - Birding Expert -->
            <div class="guide-card" data-aos="fade-up" data-category="birding" data-aos-delay="200">
                <div class="guide-image-wrap">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="David Mushi" class="guide-image">
                    <div class="guide-experience-badge">
                        <i class="fas fa-medal"></i>
                        15 Years Experience
                    </div>
                </div>
                <div class="guide-content">
                    <div class="guide-header">
                        <h3 class="guide-name">David Mushi</h3>
                        <div class="guide-title">Birding Specialist & Naturalist</div>
                        <div class="guide-rating">
                            <span class="guide-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="guide-rating-text">5.0 (195 reviews)</span>
                        </div>
                    </div>
                    
                    <p class="guide-bio">
                        David is our resident birding expert with an encyclopedic knowledge of East African birds. He can identify over 1,000 species by sight and sound. Perfect for birding enthusiasts!
                    </p>

                    <div class="guide-specialties">
                        <span class="specialty-tag">Birding</span>
                        <span class="specialty-tag">Ornithology</span>
                        <span class="specialty-tag">Nature Walks</span>
                    </div>

                    <div class="guide-info-grid">
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Languages</span>
                                <span class="guide-info-value">English, Swahili, German</span>
                            </div>
                        </div>
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-dove"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Bird Species</span>
                                <span class="guide-info-value">1,000+ Identified</span>
                            </div>
                        </div>
                    </div>

                    <div class="guide-cta">
                        <a href="{{ route('booking') }}" class="btn-guide-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book with David
                        </a>
                        <a href="https://wa.me/255691111111" class="btn-guide-secondary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Guide 3 - Cultural Expert -->
            <div class="guide-card" data-aos="fade-up" data-category="cultural" data-aos-delay="300">
                <div class="guide-image-wrap">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Josephat Lema" class="guide-image">
                    <div class="guide-experience-badge">
                        <i class="fas fa-medal"></i>
                        12 Years Experience
                    </div>
                </div>
                <div class="guide-content">
                    <div class="guide-header">
                        <h3 class="guide-name">Josephat Lema</h3>
                        <div class="guide-title">Cultural Specialist & Walking Guide</div>
                        <div class="guide-rating">
                            <span class="guide-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </span>
                            <span class="guide-rating-text">4.9 (156 reviews)</span>
                        </div>
                    </div>
                    
                    <p class="guide-bio">
                        A Maasai by birth, Josephat offers unique insights into Tanzania's indigenous cultures. He specializes in cultural tours, walking safaris, and connecting travelers with local communities.
                    </p>

                    <div class="guide-specialties">
                        <span class="specialty-tag">Maasai Culture</span>
                        <span class="specialty-tag">Walking Safaris</span>
                        <span class="specialty-tag">Community Tours</span>
                    </div>

                    <div class="guide-info-grid">
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Languages</span>
                                <span class="guide-info-value">English, Swahili, Maa</span>
                            </div>
                        </div>
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-walking"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Specialty</span>
                                <span class="guide-info-value">Walking Safaris</span>
                            </div>
                        </div>
                    </div>

                    <div class="guide-cta">
                        <a href="{{ route('booking') }}" class="btn-guide-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book with Josephat
                        </a>
                        <a href="https://wa.me/255691111111" class="btn-guide-secondary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Guide 4 - Photography -->
            <div class="guide-card" data-aos="fade-up" data-category="photography" data-aos-delay="100">
                <div class="guide-image-wrap">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Peter Ndungu" class="guide-image">
                    <div class="guide-experience-badge">
                        <i class="fas fa-medal"></i>
                        10 Years Experience
                    </div>
                </div>
                <div class="guide-content">
                    <div class="guide-header">
                        <h3 class="guide-name">Peter Ndungu</h3>
                        <div class="guide-title">Photography Specialist</div>
                        <div class="guide-rating">
                            <span class="guide-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="guide-rating-text">5.0 (142 reviews)</span>
                        </div>
                    </div>
                    
                    <p class="guide-bio">
                        Peter is a professional wildlife photographer turned guide. He knows exactly where to position the vehicle for the perfect shot and offers invaluable tips for capturing stunning wildlife photos.
                    </p>

                    <div class="guide-specialties">
                        <span class="specialty-tag">Photography</span>
                        <span class="specialty-tag">Golden Hour</span>
                        <span class="specialty-tag">Composition</span>
                    </div>

                    <div class="guide-info-grid">
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Languages</span>
                                <span class="guide-info-value">English, Swahili</span>
                            </div>
                        </div>
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Equipment</span>
                                <span class="guide-info-value">Pro Photo Guidance</span>
                            </div>
                        </div>
                    </div>

                    <div class="guide-cta">
                        <a href="{{ route('booking') }}" class="btn-guide-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book with Peter
                        </a>
                        <a href="https://wa.me/255691111111" class="btn-guide-secondary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Guide 5 - Female Guide -->
            <div class="guide-card" data-aos="fade-up" data-category="senior cultural" data-aos-delay="200">
                <div class="guide-image-wrap">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Grace Mbwana" class="guide-image">
                    <div class="guide-badge">Top Rated</div>
                    <div class="guide-experience-badge">
                        <i class="fas fa-medal"></i>
                        8 Years Experience
                    </div>
                </div>
                <div class="guide-content">
                    <div class="guide-header">
                        <h3 class="guide-name">Grace Mbwana</h3>
                        <div class="guide-title">Senior Guide & Conservationist</div>
                        <div class="guide-rating">
                            <span class="guide-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="guide-rating-text">5.0 (178 reviews)</span>
                        </div>
                    </div>
                    
                    <p class="guide-bio">
                        Grace is one of Tanzania's few female senior guides. With a background in conservation biology, she offers deep insights into animal behavior and ecosystem dynamics. A role model for aspiring female guides.
                    </p>

                    <div class="guide-specialties">
                        <span class="specialty-tag">Conservation</span>
                        <span class="specialty-tag">Elephants</span>
                        <span class="specialty-tag">Education</span>
                    </div>

                    <div class="guide-info-grid">
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Languages</span>
                                <span class="guide-info-value">English, Swahili, Spanish</span>
                            </div>
                        </div>
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Education</span>
                                <span class="guide-info-value">Wildlife Biology</span>
                            </div>
                        </div>
                    </div>

                    <div class="guide-cta">
                        <a href="{{ route('booking') }}" class="btn-guide-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book with Grace
                        </a>
                        <a href="https://wa.me/255691111111" class="btn-guide-secondary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Guide 6 - Young energetic -->
            <div class="guide-card" data-aos="fade-up" data-category="photography" data-aos-delay="300">
                <div class="guide-image-wrap">
                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Emmanuel Pallangyo" class="guide-image">
                    <div class="guide-experience-badge">
                        <i class="fas fa-medal"></i>
                        6 Years Experience
                    </div>
                </div>
                <div class="guide-content">
                    <div class="guide-header">
                        <h3 class="guide-name">Emmanuel Pallangyo</h3>
                        <div class="guide-title">Adventure Guide & Tracker</div>
                        <div class="guide-rating">
                            <span class="guide-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </span>
                            <span class="guide-rating-text">4.8 (98 reviews)</span>
                        </div>
                    </div>
                    
                    <p class="guide-bio">
                        Emmanuel's enthusiasm is infectious! His exceptional tracking skills and knowledge of animal signs make him excellent at finding elusive wildlife. Young, energetic, and always smiling.
                    </p>

                    <div class="guide-specialties">
                        <span class="specialty-tag">Tracking</span>
                        <span class="specialty-tag">Big Five</span>
                        <span class="specialty-tag">Adventure</span>
                    </div>

                    <div class="guide-info-grid">
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Languages</span>
                                <span class="guide-info-value">English, Swahili, Italian</span>
                            </div>
                        </div>
                        <div class="guide-info-item">
                            <div class="guide-info-icon">
                                <i class="fas fa-paw"></i>
                            </div>
                            <div class="guide-info-content">
                                <span class="guide-info-label">Specialty</span>
                                <span class="guide-info-value">Animal Tracking</span>
                            </div>
                        </div>
                    </div>

                    <div class="guide-cta">
                        <a href="{{ route('booking') }}" class="btn-guide-primary">
                            <i class="fas fa-calendar-check"></i>
                            Book with Emmanuel
                        </a>
                        <a href="https://wa.me/255691111111" class="btn-guide-secondary" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="guide-testimonials">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker" style="color: var(--accent-400);">
                <i class="fas fa-quote-left"></i> Traveler Stories
            </div>
            <h2 class="section-title">What Travelers Say About Our Guides</h2>
            <p class="section-subtitle" style="color: var(--gray-300);">
                Real reviews from real travelers who experienced Tanzania with our guides.
            </p>
        </div>

        <div class="testimonial-carousel">
            <div class="guide-testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="guide-testimonial-header">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah" class="guide-testimonial-avatar">
                    <div class="guide-testimonial-info">
                        <h4>Sarah Johnson</h4>
                        <span>Traveled with John Makala</span>
                    </div>
                </div>
                <p class="guide-testimonial-text">
                    "John was absolutely incredible! His knowledge of the Serengeti is encyclopedic. He found us a leopard sleeping in a tree that other vehicles drove right past. Cannot recommend him enough!"
                </p>
                <div class="guide-testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>

            <div class="guide-testimonial-card" data-aos="fade-up" data-aos-delay="200">
                <div class="guide-testimonial-header">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael" class="guide-testimonial-avatar">
                    <div class="guide-testimonial-info">
                        <h4>Michael Chen</h4>
                        <span>Traveled with David Mushi</span>
                    </div>
                </div>
                <p class="guide-testimonial-text">
                    "As a bird photographer, I was amazed by David's expertise. He identified species by sound before we even saw them. Added 45 new species to my life list in just 5 days!"
                </p>
                <div class="guide-testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>

            <div class="guide-testimonial-card" data-aos="fade-up" data-aos-delay="300">
                <div class="guide-testimonial-header">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emma" class="guide-testimonial-avatar">
                    <div class="guide-testimonial-info">
                        <h4>Emma Schmidt</h4>
                        <span>Traveled with Josephat Lema</span>
                    </div>
                </div>
                <p class="guide-testimonial-text">
                    "Josephat's cultural insights made this trip special. Visiting his Maasai village was the highlight. My children learned so much and made friends they'll never forget."
                </p>
                <div class="guide-testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="guides-cta-section">
    <div class="container">
        <div class="guides-cta-content" data-aos="fade-up">
            <h2>Ready to Meet Your Guide?</h2>
            <p>
                All our safaris are led by certified professional guides. While we can't guarantee 
                a specific guide, we'll match you with the perfect expert for your interests and travel style.
            </p>
            <div class="guides-cta-buttons">
                <a href="{{ route('packages') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-suitcase"></i>
                    Browse Safaris
                </a>
                <a href="https://wa.me/255691111111" class="btn btn-outline btn-lg" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    Request Specific Guide
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const guideCards = document.querySelectorAll('.guide-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.getAttribute('data-filter');

            // Filter cards
            guideCards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-category').includes(filter)) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
</script>
@endsection

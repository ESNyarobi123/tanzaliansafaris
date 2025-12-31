@extends('layouts.app')

@section('title', 'Travel Tips - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-tips {
        background: linear-gradient(rgba(212, 163, 115, 0.9), rgba(212, 163, 115, 0.9)),
            url('https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/chatgpt-image-may-21-2025-01_03_34-am.png') center/cover;
        color: white;
        padding: 120px 0 80px;
        text-align: center;
    }
    .page-header-tips h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        margin-bottom: 20px;
    }
    .page-header-tips p {
        font-size: 20px;
        opacity: 0.9;
        max-width: 800px;
        margin: 0 auto;
    }
    .tips-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }
    .tips-grid-page {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }
    .tip-card-page {
        background: white;
        padding: clamp(25px, 5vw, 50px);
        border-radius: 30px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
        transition: all 0.3s;
        border-top: 6px solid var(--primary-color);
        border-left: 1px solid #f1f5f9;
        border-right: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
    }
    .tip-card-page:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
    }
    .tip-icon-page {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
        margin-bottom: 30px;
        box-shadow: 0 10px 20px rgba(212,163,115,0.3);
    }
    .tip-card-page h3 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        color: var(--secondary-color);
        margin-bottom: 20px;
    }
    .tip-card-page ul {
        list-style: none;
        padding: 0;
    }
    .tip-card-page ul li {
        padding: 12px 0;
        color: var(--text-light);
        display: flex;
        align-items: flex-start;
        line-height: 1.8;
        font-size: 16px;
    }
    .tip-card-page ul li i {
        color: var(--primary-color);
        margin-right: 15px;
        margin-top: 6px;
        font-size: 16px;
    }
    .important-note-tips {
        background: linear-gradient(135deg, var(--accent-color), #ff8c5a);
        color: white;
        padding: 60px;
        border-radius: 30px;
        text-align: center;
        margin: 80px 0;
        box-shadow: 0 20px 50px rgba(255,107,53,0.2);
    }
    .important-note-tips h2 {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        margin-bottom: 25px;
    }
    .important-note-tips p {
        font-size: 20px;
        line-height: 1.9;
        opacity: 0.95;
        max-width: 900px;
        margin: 0 auto;
    }
    @media (max-width: 768px) {
        .page-header-tips h1 {
            font-size: 40px;
        }
        .important-note-tips {
            padding: 40px 20px;
        }
        .important-note-tips h2 {
            font-size: 32px;
        }
        .important-note-tips p {
            font-size: 16px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-tips">
    <div data-aos="fade-up">
        <h1>Essential Travel Tips</h1>
        <p>Expert advice to make your Tanzanian adventure smooth, safe, and truly memorable. We've got you covered from arrival to departure.</p>
    </div>
</section>

<div class="tips-container">
    <div class="tips-grid-page">
        <div class="tip-card-page" data-aos="fade-up">
            <div class="tip-icon-page">
                <i class="fas fa-passport"></i>
            </div>
            <h3>Visa & Documents</h3>
            <ul>
                <li><i class="fas fa-check-circle"></i> Most visitors can get a visa on arrival at $50-100 USD.</li>
                <li><i class="fas fa-check-circle"></i> Passport must be valid for at least 6 months from entry.</li>
                <li><i class="fas fa-check-circle"></i> We recommend applying for an e-visa online before travel.</li>
                <li><i class="fas fa-check-circle"></i> Keep digital and physical copies of all important documents.</li>
            </ul>
        </div>

        <div class="tip-card-page" data-aos="fade-up" data-aos-delay="100">
            <div class="tip-icon-page">
                <i class="fas fa-syringe"></i>
            </div>
            <h3>Health & Safety</h3>
            <ul>
                <li><i class="fas fa-check-circle"></i> Yellow fever certificate is mandatory for many travelers.</li>
                <li><i class="fas fa-check-circle"></i> Malaria prophylaxis is highly recommended for all areas.</li>
                <li><i class="fas fa-check-circle"></i> Pack high-quality insect repellent and SPF 30+ sunscreen.</li>
                <li><i class="fas fa-check-circle"></i> Comprehensive travel insurance is essential for your trip.</li>
            </ul>
        </div>

        <div class="tip-card-page" data-aos="fade-up" data-aos-delay="200">
            <div class="tip-icon-page">
                <i class="fas fa-suitcase"></i>
            </div>
            <h3>What to Pack</h3>
            <ul>
                <li><i class="fas fa-check-circle"></i> Lightweight, neutral-colored clothing (khaki, beige, olive).</li>
                <li><i class="fas fa-check-circle"></i> Comfortable, broken-in walking shoes or hiking boots.</li>
                <li><i class="fas fa-check-circle"></i> High-quality binoculars and camera with extra batteries.</li>
                <li><i class="fas fa-check-circle"></i> Wide-brimmed hat, polarized sunglasses, and warm layers.</li>
            </ul>
        </div>

        <div class="tip-card-page" data-aos="fade-up">
            <div class="tip-icon-page">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <h3>Money & Currency</h3>
            <ul>
                <li><i class="fas fa-check-circle"></i> US Dollars (post-2006) are widely accepted everywhere.</li>
                <li><i class="fas fa-check-circle"></i> Local currency: Tanzanian Shilling (TZS) for small items.</li>
                <li><i class="fas fa-check-circle"></i> ATMs are available in Arusha, Dar, and major towns.</li>
                <li><i class="fas fa-check-circle"></i> Credit cards are accepted at most lodges and hotels.</li>
            </ul>
        </div>

        <div class="tip-card-page" data-aos="fade-up" data-aos-delay="100">
            <div class="tip-icon-page">
                <i class="fas fa-camera"></i>
            </div>
            <h3>Photography</h3>
            <ul>
                <li><i class="fas fa-check-circle"></i> Bring plenty of extra memory cards and spare batteries.</li>
                <li><i class="fas fa-check-circle"></i> A telephoto lens (200mm-400mm) is ideal for wildlife.</li>
                <li><i class="fas fa-check-circle"></i> Early morning and late afternoon offer the best light.</li>
                <li><i class="fas fa-check-circle"></i> Always ask for permission before photographing people.</li>
            </ul>
        </div>

        <div class="tip-card-page" data-aos="fade-up" data-aos-delay="200">
            <div class="tip-icon-page">
                <i class="fas fa-users"></i>
            </div>
            <h3>Cultural Etiquette</h3>
            <ul>
                <li><i class="fas fa-check-circle"></i> Dress modestly when visiting local villages and towns.</li>
                <li><i class="fas fa-check-circle"></i> Learning basic Swahili greetings goes a long way.</li>
                <li><i class="fas fa-check-circle"></i> Tipping your guide and lodge staff is customary.</li>
                <li><i class="fas fa-check-circle"></i> Respect local customs and traditions at all times.</li>
            </ul>
        </div>
    </div>

    <div class="important-note-tips" data-aos="zoom-in">
        <h2><i class="fas fa-info-circle"></i> Important Reminder</h2>
        <p>Always book with registered tour operators like Tanzalian Safari's for a safe, authentic, and professionally managed experience. We provide 24/7 support, licensed expert guides, and complete peace of mind throughout your entire journey in Tanzania.</p>
    </div>
</div>
@endsection

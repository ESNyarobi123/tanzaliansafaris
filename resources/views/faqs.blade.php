@extends('layouts.app')

@section('title', 'Frequently Asked Questions - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-faqs {
        background: linear-gradient(rgba(44, 85, 48, 0.8), rgba(44, 85, 48, 0.8)),
            url('https://ceo47c82dcc0cb0.wordpress.com/wp-content/uploads/2025/05/may-21-2025-12_21_05-am.png') center/cover;
        color: white;
        padding: 120px 0 80px;
        text-align: center;
    }
    .page-header-faqs h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        margin-bottom: 20px;
    }
    .page-header-faqs p {
        font-size: 20px;
        opacity: 0.9;
        max-width: 800px;
        margin: 0 auto;
    }
    .faqs-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 60px 20px;
    }
    .faq-item-page {
        background: white;
        margin-bottom: 25px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.3s;
        border: 1px solid #f1f5f9;
    }
    .faq-item-page:hover {
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        border-color: var(--primary-color);
    }
    .faq-question-page {
        padding: 30px 40px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 700;
        color: var(--secondary-color);
        font-size: 20px;
        transition: all 0.3s;
    }
    .faq-question-page:hover {
        color: var(--accent-color);
    }
    .faq-question-page i {
        color: var(--primary-color);
        font-size: 20px;
        transition: transform 0.3s;
    }
    .faq-item-page.active .faq-question-page i {
        transform: rotate(180deg);
    }
    .faq-answer-page {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out;
        background: #f8f9fa;
    }
    .faq-answer-content-page {
        padding: 30px 40px;
        color: var(--text-light);
        line-height: 1.9;
        font-size: 16px;
    }
    .faq-item-page.active .faq-answer-page {
        max-height: 800px;
    }
    .contact-cta-faqs {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        color: white;
        padding: 60px;
        border-radius: 30px;
        text-align: center;
        margin-top: 80px;
        box-shadow: 0 20px 50px rgba(44,85,48,0.2);
    }
    .contact-cta-faqs h2 {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        margin-bottom: 20px;
    }
    .contact-cta-faqs p {
        font-size: 18px;
        margin-bottom: 30px;
        opacity: 0.9;
    }
    .contact-cta-faqs a {
        display: inline-block;
        background: var(--accent-color);
        color: white;
        padding: 15px 45px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(255,107,53,0.3);
    }
    .contact-cta-faqs a:hover {
        background: white;
        color: var(--accent-color);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    @media (max-width: 768px) {
        .page-header-faqs h1 {
            font-size: 40px;
        }
        .faq-question-page {
            padding: 20px 25px;
            font-size: 16px;
        }
        .faq-answer-content-page {
            padding: 20px 25px;
            font-size: 14px;
        }
        .contact-cta-faqs {
            padding: 40px 20px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-faqs">
    <div data-aos="fade-up">
        <h1>Frequently Asked Questions</h1>
        <p>Find answers to common questions about your Tanzanian adventure. We've compiled everything you need to know before you go.</p>
    </div>
</section>

<div class="faqs-container">
    <div class="faq-list-page">
        <div class="faq-item-page" data-aos="fade-up">
            <div class="faq-question-page" onclick="toggleFaq(this)">
                <span><i class="fas fa-calendar-check"></i> When is the best time to visit Tanzania for a safari?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer-page">
                <div class="faq-answer-content-page">
                    The best time for safari is during the dry season from June to October when wildlife congregates around water sources, making viewing easier. However, Tanzania offers excellent safari experiences year-round. January to February is ideal for witnessing the wildebeest calving season, while the green season (March to May) offers lush landscapes and fewer tourists.
                </div>
            </div>
        </div>

        <div class="faq-item-page" data-aos="fade-up" data-aos-delay="50">
            <div class="faq-question-page" onclick="toggleFaq(this)">
                <span><i class="fas fa-passport"></i> Do I need a visa to visit Tanzania?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer-page">
                <div class="faq-answer-content-page">
                    Most visitors can obtain a visa on arrival at Tanzanian airports for $50–100 USD, depending on nationality. We recommend applying for an e-visa online before your trip for a smoother arrival process. Your passport must be valid for at least 6 months from your entry date.
                </div>
            </div>
        </div>

        <div class="faq-item-page" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-question-page" onclick="toggleFaq(this)">
                <span><i class="fas fa-syringe"></i> What vaccinations do I need?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer-page">
                <div class="faq-answer-content-page">
                    A Yellow Fever vaccination certificate is mandatory if traveling from or through yellow fever endemic countries. We also recommend vaccinations for Hepatitis A & B, Typhoid, and Tetanus. Malaria prophylaxis is advised for most areas. Consult your doctor at least 6–8 weeks before travel.
                </div>
            </div>
        </div>

        <div class="faq-item-page" data-aos="fade-up" data-aos-delay="150">
            <div class="faq-question-page" onclick="toggleFaq(this)">
                <span><i class="fas fa-money-bill-wave"></i> What currency should I bring?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer-page">
                <div class="faq-answer-content-page">
                    US Dollars are widely accepted throughout Tanzania, especially for tourism services. The local currency is Tanzanian Shilling (TZS), useful for small purchases and tips. ATMs are available in major cities. Credit cards are accepted at most hotels and lodges, though cash is preferred in remote areas.
                </div>
            </div>
        </div>

        <div class="faq-item-page" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-question-page" onclick="toggleFaq(this)">
                <span><i class="fas fa-suitcase"></i> What should I pack for a safari?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer-page">
                <div class="faq-answer-content-page">
                    Pack lightweight, neutral-colored clothing (khaki, beige, olive), comfortable walking shoes, a wide-brimmed hat, sunglasses, sunscreen, insect repellent, binoculars, and camera equipment with extra batteries. Bring warm layers as early mornings and evenings can be cool. Most lodges offer laundry services, so you can pack light.
                </div>
            </div>
        </div>

        <div class="faq-item-page" data-aos="fade-up" data-aos-delay="250">
            <div class="faq-question-page" onclick="toggleFaq(this)">
                <span><i class="fas fa-shield-alt"></i> Is Tanzania safe for tourists?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer-page">
                <div class="faq-answer-content-page">
                    Yes! Tanzania is one of the safest safari destinations in Africa. Tourist areas are well-protected and welcoming. When you book with Tanzalian Safari's, you travel with experienced guides, stay in secure accommodations, and have 24/7 support. We prioritize your safety at every step of your journey.
                </div>
            </div>
        </div>
    </div>

    <div class="contact-cta-faqs" data-aos="zoom-in">
        <h2><i class="fas fa-question-circle"></i> Still Have Questions?</h2>
        <p>Our team is here to help! Contact us for personalized assistance and expert advice on planning your perfect trip.</p>
        <a href="{{ route('home') }}#contact"><i class="fas fa-phone-alt"></i> Contact Us Now</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleFaq(element) {
        const faqItem = element.parentElement;
        const allFaqs = document.querySelectorAll('.faq-item-page');
        
        allFaqs.forEach(item => {
            if (item !== faqItem) {
                item.classList.remove('active');
            }
        });
        
        faqItem.classList.toggle('active');
    }
</script>
@endsection

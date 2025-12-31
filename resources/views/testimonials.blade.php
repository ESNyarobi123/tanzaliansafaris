@extends('layouts.app')

@section('title', 'Customer Testimonials - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-testimonials {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1920') center/cover;
        padding: 120px 0 80px;
        text-align: center;
        color: white;
    }
    .page-header-testimonials h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        font-weight: 900;
        margin-bottom: 20px;
    }
    .page-header-testimonials p {
        font-size: 20px;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0.9;
    }
    .testimonials-section-page {
        background: white;
    }
    .rating-overview-page {
        text-align: center;
        margin-bottom: 60px;
        padding: clamp(30px, 8vw, 60px);
        background: #f8f9fa;
        border-radius: 30px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
    }
    .rating-number-page {
        font-size: 84px;
        font-weight: 900;
        color: var(--primary-color);
        margin-bottom: 15px;
        font-family: 'Playfair Display', serif;
    }
    .rating-stars-page {
        font-size: 36px;
        color: #f59e0b;
        margin-bottom: 15px;
    }
    .rating-count-page {
        font-size: 20px;
        color: var(--text-light);
        font-weight: 500;
    }
    .testimonials-grid-page {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .testimonial-card-page {
        background: white;
        padding: clamp(25px, 5vw, 50px);
        border-radius: 30px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
        position: relative;
        border: 1px solid #f1f5f9;
        transition: all 0.3s;
    }
    .testimonial-card-page:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        border-color: var(--primary-color);
    }
    .quote-icon-page {
        position: absolute;
        top: 30px;
        right: 40px;
        font-size: 64px;
        color: var(--primary-color);
        opacity: 0.15;
    }
    .testimonial-header-page {
        display: flex;
        align-items: center;
        gap: 25px;
        margin-bottom: 30px;
    }
    .testimonial-avatar-page {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 800;
        flex-shrink: 0;
        box-shadow: 0 10px 20px rgba(212,163,115,0.3);
    }
    .testimonial-info-page h4 {
        font-size: 24px;
        margin-bottom: 8px;
        color: var(--secondary-color);
        font-family: 'Playfair Display', serif;
    }
    .testimonial-info-page .stars {
        color: #f59e0b;
        font-size: 18px;
        margin-bottom: 5px;
    }
    .testimonial-info-page .location {
        font-size: 15px;
        color: var(--text-light);
        font-weight: 500;
    }
    .testimonial-text-page {
        color: var(--text-dark);
        line-height: 1.9;
        font-style: italic;
        font-size: 17px;
        position: relative;
        z-index: 1;
    }
    .testimonial-date-page {
        margin-top: 25px;
        font-size: 14px;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width: 768px) {
        .page-header-testimonials h1 {
            font-size: 40px;
        }
        .rating-number-page {
            font-size: 60px;
        }
        .testimonial-header-page {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-testimonials">
    <div data-aos="fade-up">
        <h1>Customer Testimonials</h1>
        <p>Hear from travelers who experienced the magic of Tanzania with us. Their stories are our greatest inspiration.</p>
    </div>
</section>

<section class="testimonials-section-page">
    <div class="container">
        <div class="rating-overview-page" data-aos="fade-up">
            <div class="rating-number-page">4.9</div>
            <div class="rating-stars-page">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <div class="rating-count-page">Based on 500+ verified customer reviews</div>
        </div>

        <div class="testimonials-grid-page">
            <div class="testimonial-card-page" data-aos="fade-up">
                <i class="fas fa-quote-right quote-icon-page"></i>
                <div class="testimonial-header-page">
                    <div class="testimonial-avatar-page">J</div>
                    <div class="testimonial-info-page">
                        <h4>John Smith</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="location">London, UK</div>
                    </div>
                </div>
                <p class="testimonial-text-page">"This was the trip of a lifetime! The guides were incredibly knowledgeable, the accommodations were perfect, and seeing the wildebeest migration was absolutely breathtaking. Highly recommend Tanzalian Safari's for anyone visiting Tanzania!"</p>
                <div class="testimonial-date-page">August 2024</div>
            </div>

            <div class="testimonial-card-page" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-quote-right quote-icon-page"></i>
                <div class="testimonial-header-page">
                    <div class="testimonial-avatar-page">S</div>
                    <div class="testimonial-info-page">
                        <h4>Sarah Johnson</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="location">New York, USA</div>
                    </div>
                </div>
                <p class="testimonial-text-page">"Everything was well-organized from start to finish. The wildlife sightings exceeded our expectations, and the hospitality was unmatched. Thank you for creating such wonderful memories for our family!"</p>
                <div class="testimonial-date-page">September 2024</div>
            </div>

            <div class="testimonial-card-page" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-quote-right quote-icon-page"></i>
                <div class="testimonial-header-page">
                    <div class="testimonial-avatar-page">M</div>
                    <div class="testimonial-info-page">
                        <h4>Michael Brown</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="location">Sydney, Australia</div>
                    </div>
                </div>
                <p class="testimonial-text-page">"Had an excellent budget safari experience. The camping was surprisingly comfortable and the game drives were fantastic. Our guide knew exactly where to find the lions! Would definitely do this again!"</p>
                <div class="testimonial-date-page">October 2024</div>
            </div>

            <div class="testimonial-card-page" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-quote-right quote-icon-page"></i>
                <div class="testimonial-header-page">
                    <div class="testimonial-avatar-page">E</div>
                    <div class="testimonial-info-page">
                        <h4>Emma Wilson</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="location">Toronto, Canada</div>
                    </div>
                </div>
                <p class="testimonial-text-page">"Professional service from booking to the end of our safari. The team went above and beyond to ensure we had an amazing experience. The Ngorongoro Crater was spectacular and our guide was a true expert."</p>
                <div class="testimonial-date-page">November 2024</div>
            </div>
        </div>
    </div>
</section>
@endsection

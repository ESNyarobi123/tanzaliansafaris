@extends('layouts.app')

@section('title', 'Destinations - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-destinations {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('https://images.unsplash.com/photo-1489392191049-fc10c97e64b6?w=1920') center/cover;
        padding: 120px 0 80px;
        text-align: center;
        color: white;
    }
    .page-header-destinations h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        font-weight: 900;
        margin-bottom: 20px;
    }
    .page-header-destinations p {
        font-size: 20px;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0.9;
    }
    .destinations-section-page {
        background: white;
    }
    .destinations-grid-page {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .destination-card-page {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
        transition: all 0.3s;
        border: 1px solid #f1f5f9;
    }
    .destination-card-page:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
    }
    .destination-image-page {
        height: 280px;
        overflow: hidden;
        position: relative;
    }
    .destination-image-page img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .destination-card-page:hover .destination-image-page img {
        transform: scale(1.1);
    }
    .destination-badge-page {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--accent-color);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 5px 15px rgba(255,107,53,0.3);
    }
    .destination-content-page {
        padding: 35px;
    }
    .destination-content-page h3 {
        font-size: 28px;
        margin-bottom: 15px;
        color: var(--secondary-color);
        font-family: 'Playfair Display', serif;
    }
    .destination-content-page p {
        color: var(--text-light);
        margin-bottom: 25px;
        line-height: 1.8;
        font-size: 16px;
    }
    .destination-features-page {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
    .feature-tag-page {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--text-dark);
        font-weight: 600;
        background: #f8f9fa;
        padding: 6px 15px;
        border-radius: 50px;
    }
    .feature-tag-page i {
        color: var(--primary-color);
    }
    .btn-explore-page {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary-color);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(212,163,115,0.3);
    }
    .btn-explore-page:hover {
        background: var(--secondary-color);
        transform: translateX(10px);
        box-shadow: 0 8px 20px rgba(44,85,48,0.3);
    }
    @media (max-width: 768px) {
        .page-header-destinations h1 {
            font-size: 40px;
        }
        .destination-content-page {
            padding: 25px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-destinations">
    <div data-aos="fade-up">
        <h1>Our Destinations</h1>
        <p>Explore Tanzania's most breathtaking locations. From the endless plains of Serengeti to the turquoise waters of Zanzibar.</p>
    </div>
</section>

<!-- Destinations -->
<section class="destinations-section-page">
    <div class="container">
        <div class="destinations-grid-page">
            <div class="destination-card-page" data-aos="fade-up" data-aos-delay="0">
                <div class="destination-image-page">
                    <img src="https://images.unsplash.com/photo-1523805009345-7448845a9e53?w=800" alt="Serengeti">
                    <div class="destination-badge-page">Popular</div>
                </div>
                <div class="destination-content-page">
                    <h3>Serengeti National Park</h3>
                    <p>World-famous for the Great Migration and home to the Big Five. Experience nature at its finest in the heart of Africa.</p>
                    <div class="destination-features-page">
                        <span class="feature-tag-page"><i class="fas fa-clock"></i> 3-5 Days</span>
                        <span class="feature-tag-page"><i class="fas fa-paw"></i> Big Five</span>
                        <span class="feature-tag-page"><i class="fas fa-star"></i> UNESCO Site</span>
                    </div>
                    <a href="{{ route('packages') }}" class="btn-explore-page">Explore Packages <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="destination-card-page" data-aos="fade-up" data-aos-delay="100">
                <div class="destination-image-page">
                    <img src="https://images.unsplash.com/photo-1621414050345-53db43f7e7ab?w=800" alt="Ngorongoro">
                    <div class="destination-badge-page">Must Visit</div>
                </div>
                <div class="destination-content-page">
                    <h3>Ngorongoro Crater</h3>
                    <p>The world's largest intact volcanic caldera, teeming with wildlife in a natural amphitheater of stunning beauty.</p>
                    <div class="destination-features-page">
                        <span class="feature-tag-page"><i class="fas fa-clock"></i> 1-2 Days</span>
                        <span class="feature-tag-page"><i class="fas fa-mountain"></i> Crater</span>
                        <span class="feature-tag-page"><i class="fas fa-camera"></i> Scenic</span>
                    </div>
                    <a href="{{ route('packages') }}" class="btn-explore-page">Explore Packages <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="destination-card-page" data-aos="fade-up" data-aos-delay="200">
                <div class="destination-image-page">
                    <img src="https://images.unsplash.com/photo-1589182373726-e4f658ab50f0?w=800" alt="Kilimanjaro">
                    <div class="destination-badge-page">Adventure</div>
                </div>
                <div class="destination-content-page">
                    <h3>Mount Kilimanjaro</h3>
                    <p>Africa's highest peak at 5,895m. An iconic climbing experience for adventurers seeking the roof of Africa.</p>
                    <div class="destination-features-page">
                        <span class="feature-tag-page"><i class="fas fa-clock"></i> 5-7 Days</span>
                        <span class="feature-tag-page"><i class="fas fa-hiking"></i> Trekking</span>
                        <span class="feature-tag-page"><i class="fas fa-mountain"></i> 5,895m</span>
                    </div>
                    <a href="{{ route('packages') }}" class="btn-explore-page">Explore Packages <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="destination-card-page" data-aos="fade-up" data-aos-delay="0">
                <div class="destination-image-page">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800" alt="Zanzibar">
                    <div class="destination-badge-page">Beach</div>
                </div>
                <div class="destination-content-page">
                    <h3>Zanzibar Island</h3>
                    <p>Pristine white beaches, turquoise waters, and rich history in Stone Town. The perfect end to any safari adventure.</p>
                    <div class="destination-features-page">
                        <span class="feature-tag-page"><i class="fas fa-clock"></i> 3-7 Days</span>
                        <span class="feature-tag-page"><i class="fas fa-umbrella-beach"></i> Beach</span>
                        <span class="feature-tag-page"><i class="fas fa-utensils"></i> Spice Tour</span>
                    </div>
                    <a href="{{ route('packages') }}" class="btn-explore-page">Explore Packages <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="destination-card-page" data-aos="fade-up" data-aos-delay="100">
                <div class="destination-image-page">
                    <img src="https://images.unsplash.com/photo-1551969014-7d2c4cddf0b6?w=800" alt="Tarangire">
                </div>
                <div class="destination-content-page">
                    <h3>Tarangire National Park</h3>
                    <p>Known for large elephant herds and ancient baobab trees dotting the landscape. A hidden gem of northern Tanzania.</p>
                    <div class="destination-features-page">
                        <span class="feature-tag-page"><i class="fas fa-clock"></i> 1-2 Days</span>
                        <span class="feature-tag-page"><i class="fas fa-tree"></i> Baobab</span>
                        <span class="feature-tag-page"><i class="fas fa-paw"></i> Elephants</span>
                    </div>
                    <a href="{{ route('packages') }}" class="btn-explore-page">Explore Packages <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="destination-card-page" data-aos="fade-up" data-aos-delay="200">
                <div class="destination-image-page">
                    <img src="https://images.unsplash.com/photo-1489392191049-fc10c97e64b6?w=800" alt="Lake Manyara">
                </div>
                <div class="destination-content-page">
                    <h3>Lake Manyara</h3>
                    <p>Famous for tree-climbing lions and stunning flamingo populations on the alkaline lake. A birdwatcher's paradise.</p>
                    <div class="destination-features-page">
                        <span class="feature-tag-page"><i class="fas fa-clock"></i> 1 Day</span>
                        <span class="feature-tag-page"><i class="fas fa-water"></i> Lake</span>
                        <span class="feature-tag-page"><i class="fas fa-dove"></i> Birds</span>
                    </div>
                    <a href="{{ route('packages') }}" class="btn-explore-page">Explore Packages <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

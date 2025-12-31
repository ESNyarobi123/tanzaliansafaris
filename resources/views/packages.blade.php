@extends('layouts.app')

@section('title', 'Safari Packages - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-hero-packages{
        background:linear-gradient(120deg,#022c22,#14532d);
        color:#fff;
        padding:80px 0 60px;
    }
    .page-hero-inner-packages{
        max-width:1200px;
        margin:0 auto;
        padding:0 18px;
        display:flex;
        flex-direction:column;
        gap:12px;
    }
    .breadcrumb-packages{
        font-size:13px;
        opacity:.8;
    }
    .breadcrumb-packages a{
        color:#bbf7d0;
    }
    .page-title-packages{
        font-family:'Playfair Display',serif;
        font-size:48px;
        font-weight:900;
        letter-spacing:.5px;
    }
    .page-subtitle-packages{
        font-size:18px;
        max-width:700px;
        opacity:.9;
    }
    .page-intro-box-packages{
        background:rgba(236,253,243,0.1);
        border-left:4px solid var(--primary-color);
        border-radius:8px;
        padding:20px;
        margin-top:20px;
        font-size:16px;
        color:#bbf7d0;
        backdrop-filter: blur(5px);
    }
    .page-section-packages{
        padding:60px 18px;
        background: #f3f4f6;
    }
    .packages-grid-packages{
        max-width:1200px;
        margin:0 auto;
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap:30px;
    }
    .pkg-card-packages{
        background:#ffffff;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 15px 35px rgba(0,0,0,0.1);
        display:flex;
        flex-direction:column;
        transition: transform 0.3s;
    }
    .pkg-card-packages:hover {
        transform: translateY(-10px);
    }
    .pkg-img-wrap-packages{
        position:relative;
        height:250px;
        overflow:hidden;
    }
    .pkg-img-wrap-packages img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
        transition:transform .4s;
    }
    .pkg-badge-packages{
        position:absolute;
        top:15px;
        left:15px;
        background:rgba(255,255,255,0.9);
        color:#b91c1c;
        border-radius:999px;
        padding:6px 15px;
        font-size:12px;
        font-weight:700;
        display:flex;
        align-items:center;
        gap:6px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .pkg-duration-packages{
        position:absolute;
        bottom:15px;
        right:15px;
        background:rgba(15,23,42,0.8);
        color:#fff;
        padding:6px 15px;
        border-radius:999px;
        font-size:12px;
        display:flex;
        align-items:center;
        gap:6px;
    }
    .pkg-body-packages{
        padding:25px;
        display:flex;
        flex-direction:column;
        gap:10px;
        flex-grow: 1;
    }
    .pkg-name-packages{
        font-size:22px;
        font-weight:800;
        color:var(--secondary-color);
        font-family: 'Playfair Display', serif;
    }
    .pkg-short-packages{
        font-size:14px;
        color:var(--text-light);
        line-height: 1.6;
    }
    .pkg-features-packages{
        margin-top:10px;
        font-size:13px;
        color:#4b5563;
    }
    .pkg-features-packages ul{
        padding-left:20px;
        list-style-type: disc;
    }
    .pkg-features-packages li{
        margin-bottom:5px;
    }
    .pkg-footer-packages{
        margin-top:auto;
        padding: 25px;
        border-top: 1px solid #f1f5f9;
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap: wrap;
        gap: 15px;
    }
    .pkg-price-packages{
        font-size:20px;
        font-weight:800;
        color:#b91c1c;
    }
    .pkg-price-packages span{
        font-size:12px;
        color:#6b7280;
        font-weight:500;
    }
    .pkg-cta-packages{
        display:flex;
        gap:10px;
    }
    .btn-pill-packages{
        border:none;
        border-radius:999px;
        padding:10px 20px;
        font-size:13px;
        font-weight:700;
        cursor:pointer;
        display:inline-flex;
        align-items:center;
        gap:8px;
        transition: all 0.3s;
    }
    .btn-book-packages{
        background:var(--accent-color);
        color:#fff;
        box-shadow:0 4px 15px rgba(255,107,53,0.3);
    }
    .btn-book-packages:hover{
        background: #e65a2b;
        transform: scale(1.05);
    }
    .btn-wa-packages{
        background:#25D366;
        color:#fff;
    }
    .btn-wa-packages:hover {
        background: #1eb954;
        transform: scale(1.05);
    }
    .empty-state-packages{
        grid-column: 1 / -1;
        text-align:center;
        padding: 100px 20px;
        color:#6b7280;
    }
</style>
@endsection

@section('content')
<!-- PAGE HERO -->
<section class="page-hero-packages">
    <div class="page-hero-inner-packages">
        <div class="breadcrumb-packages">
            <a href="{{ route('home') }}">Home</a> &raquo; <span>Safari Packages</span>
        </div>
        <h1 class="page-title-packages">Safari Packages</h1>
        <p class="page-subtitle-packages">
            Discover our hand-picked safari experiences across Tanzania – from Serengeti and Ngorongoro
            to Zanzibar and beyond.
        </p>

        @if ($pageIntro)
            <div class="page-intro-box-packages">
                {!! $pageIntro->content !!}
            </div>
        @endif
    </div>
</section>

<!-- PACKAGES GRID -->
<section class="page-section-packages">
    <div class="packages-grid-packages">
        @forelse ($packages as $pkg)
            @php
                $img = trim($pkg->image_path ?? '');
                if ($img !== '') {
                    if (preg_match('#^https?://#', $img)) {
                        $imgSrc = $img;
                    } else {
                        $imgSrc = asset('uploads/safari_packages/' . $img);
                    }
                } else {
                    $imgSrc = 'https://images.pexels.com/photos/417074/pexels-photo-417074.jpeg?auto=compress&cs=tinysrgb&w=800';
                }

                $featuresList = [];
                if (!empty($pkg->features_text)) {
                    $lines = preg_split('/\r\n|\r|\n/', $pkg->features_text);
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if ($line !== '') {
                            $featuresList[] = $line;
                        }
                    }
                }
            @endphp
            <article class="pkg-card-packages" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="pkg-img-wrap-packages">
                    <img src="{{ $imgSrc }}" alt="{{ $pkg->name }}">
                    @if (!empty($pkg->badge_label))
                        <div class="pkg-badge-packages">
                            <i class="fa-solid fa-star"></i>
                            {{ $pkg->badge_label }}
                        </div>
                    @endif
                    @if (!empty($pkg->duration_label))
                        <div class="pkg-duration-packages">
                            <i class="fa-regular fa-clock"></i>
                            {{ $pkg->duration_label }}
                        </div>
                    @endif
                </div>
                <div class="pkg-body-packages">
                    <div class="pkg-name-packages">{{ $pkg->name }}</div>
                    @if (!empty($pkg->short_description))
                        <div class="pkg-short-packages">{{ $pkg->short_description }}</div>
                    @endif

                    @if (!empty($featuresList))
                        <div class="pkg-features-packages">
                            <ul>
                                @foreach ($featuresList as $f)
                                    <li>{{ $f }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="pkg-footer-packages">
                    <div class="pkg-price-packages">
                        @if ($pkg->price_amount > 0)
                            ${{ number_format($pkg->price_amount, 0) }}
                            @if ($pkg->price_suffix !== '')
                                <span>{{ $pkg->price_suffix }}</span>
                            @endif
                        @else
                            <span>Contact us for price</span>
                        @endif
                    </div>
                    <div class="pkg-cta-packages">
                        <a class="btn-pill-packages btn-book-packages" href="{{ route('booking') }}">
                            <i class="fa-solid fa-calendar-check"></i>
                            Book now
                        </a>
                        <a class="btn-pill-packages btn-wa-packages"
                           href="https://wa.me/255691111111?text={{ urlencode('Hello, I am interested in the package: ' . $pkg->name) }}"
                           target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state-packages">
                <i class="fa-regular fa-face-frown" style="font-size:50px;margin-bottom:20px;"></i>
                <p>Kwa sasa hakuna safari packages zilizo wazi. Tafadhali rudi tena baadae, au wasiliana nasi kupitia WhatsApp kwa ofa maalum.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection

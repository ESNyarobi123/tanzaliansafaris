@extends('layouts.app')

@section('title', 'Photo Gallery - Tanzalian Safari\'s')

@section('styles')
<style>
    .page-header-gallery {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=1920') center/cover;
        padding: 120px 0 80px;
        text-align: center;
        color: white;
    }
    .page-header-gallery h1 {
        font-family: 'Playfair Display', serif;
        font-size: 64px;
        font-weight: 900;
        margin-bottom: 20px;
    }
    .page-header-gallery p {
        font-size: 20px;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0.9;
    }
    .gallery-section-page {
        background: white;
    }
    .gallery-grid-page {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .gallery-item-page {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        cursor: pointer;
        height: 400px;
        transition: transform 0.3s;
    }
    .gallery-item-page:hover {
        transform: translateY(-10px);
    }
    .gallery-item-page img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .gallery-item-page:hover img {
        transform: scale(1.1);
    }
    .gallery-overlay-page {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.9));
        padding: 40px 30px 30px;
        color: white;
        transform: translateY(100%);
        transition: transform 0.3s;
    }
    .gallery-item-page:hover .gallery-overlay-page {
        transform: translateY(0);
    }
    .gallery-overlay-page h3 {
        font-size: 24px;
        margin-bottom: 10px;
        font-family: 'Playfair Display', serif;
    }
    .gallery-overlay-page p {
        font-size: 16px;
        opacity: 0.9;
    }
    .gallery-book-btn-page {
        margin-top: 20px;
        display: inline-block;
        padding: 10px 25px;
        background: var(--primary-color);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
    }
    .gallery-book-btn-page:hover {
        background: var(--accent-color);
        transform: scale(1.05);
    }
    @media (max-width: 768px) {
        .page-header-gallery h1 {
            font-size: 40px;
        }
        .gallery-item-page {
            height: 300px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-gallery">
    <div data-aos="fade-up">
        <h1>Photo Gallery</h1>
        <p>Glimpse into the wonders of Tanzania through our lens. From the vast Serengeti to the white sands of Zanzibar.</p>
    </div>
</section>

<!-- Gallery -->
<section class="gallery-section-page">
    <div class="container">
        <div class="gallery-grid-page">
            @forelse ($galleryItems as $item)
                <div class="gallery-item-page" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <img src="{{ asset('uploads/gallery/' . $item->image_path) }}" alt="{{ $item->title }}">
                    <div class="gallery-overlay-page">
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->subtitle }}</p>
                        <a href="{{ route('booking') }}" class="gallery-book-btn-page">Book This Experience</a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 100px 20px; color: #6b7280;">
                    <i class="fas fa-images" style="font-size: 50px; margin-bottom: 20px;"></i>
                    <p>No gallery items found. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Travel Blog - Tanzalian Safari\'s')

@section('styles')
<style>
    .hero-blog {
        padding: 80px 0 60px;
        background: radial-gradient(circle at top, rgba(37,99,235,.2), transparent 55%);
        border-bottom: 1px solid rgba(148,163,184,.25);
    }
    .hero-inner-blog {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        align-items: flex-start;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .hero-main-blog {
        flex: 1 1 100%;
    }
    .hero-kicker-blog {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: .18em;
        color: var(--primary-color);
        margin-bottom: 10px;
        font-weight: 700;
    }
    .hero-title-blog {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        margin-bottom: 15px;
        color: var(--secondary-color);
    }
    .hero-subtitle-blog {
        font-size: 18px;
        color: var(--text-light);
        max-width: 600px;
        line-height: 1.6;
    }
    .hero-aside-blog {
        flex: 1 1 100%;
        border-radius: 20px;
        border: 1px dashed rgba(148,163,184,.5);
        padding: 25px;
        font-size: 15px;
        background: rgba(15,23,42,.05);
    }
    .hero-aside-blog h4 {
        font-size: 18px;
        margin-bottom: 10px;
        color: var(--secondary-color);
    }
    .hero-aside-blog p {
        color: var(--text-light);
        line-height: 1.6;
    }
    .main-blog {
        padding: 60px 0;
        background: #f8f9fa;
    }
    .blog-layout-blog {
        display: grid;
        grid-template-columns: 1fr;
        gap: 40px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (min-width: 992px) {
        .blog-layout-blog {
            grid-template-columns: 2fr 1fr;
        }
        .hero-main-blog {
            flex: 1;
        }
        .hero-aside-blog {
            flex: 0 0 350px;
        }
    }

    @media (max-width: 768px) {
        .hero-title-blog {
            font-size: 32px;
        }
    }
    .blog-grid-blog {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    .post-card-blog {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        transition: transform 0.3s;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .post-card-blog:hover {
        transform: translateY(-10px);
    }
    .post-image-blog {
        height: 200px;
        background-size: cover;
        background-position: center;
    }
    .post-body-blog {
        padding: 25px;
    }
    .post-tag-blog {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .18em;
        color: var(--primary-color);
        margin-bottom: 10px;
        font-weight: 700;
    }
    .post-title-blog {
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 10px;
        color: var(--secondary-color);
        font-family: 'Playfair Display', serif;
    }
    .post-meta-blog {
        font-size: 13px;
        color: var(--text-light);
        margin-bottom: 15px;
    }
    .post-excerpt-blog {
        font-size: 15px;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .post-footer-blog {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }
    .link-more-blog {
        color: var(--primary-color);
        font-weight: 700;
        text-decoration: none;
    }
    .side-card-blog {
        background: white;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .side-title-blog {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: .18em;
        color: var(--primary-color);
        margin-bottom: 15px;
        font-weight: 700;
    }
    .tip-list-blog {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }
    .tip-list-blog li {
        padding: 12px 0;
        border-bottom: 1px dashed rgba(0,0,0,0.1);
        display: flex;
        gap: 15px;
        color: var(--text-light);
        font-size: 14px;
    }
    .tip-list-blog li:last-child { border-bottom: none; }
    .tip-list-blog i {
        color: var(--accent-color);
        margin-top: 3px;
    }
    .side-cta-blog {
        margin-top: 30px;
        padding: 25px;
        border-radius: 15px;
        background: rgba(212,163,115,0.05);
        border: 1px solid var(--primary-color);
    }
    .side-cta-blog button {
        width: 100%;
        margin-top: 15px;
        border: none;
        border-radius: 50px;
        padding: 12px;
        font-weight: 700;
        cursor: pointer;
        background: var(--primary-color);
        color: white;
        transition: all 0.3s;
    }
    .side-cta-blog button:hover {
        background: var(--accent-color);
        transform: scale(1.02);
    }
</style>
@endsection

@section('content')
<section class="hero-blog">
    <div class="hero-inner-blog">
        <div class="hero-main-blog">
            <div class="hero-kicker-blog">Travel Blog</div>
            <h1 class="hero-title-blog">Stories, tips & adventures from Tanzania</h1>
            <p class="hero-subtitle-blog">
                Get inspired, learn practical safari tips, and discover hidden corners of Tanzania
                through real stories and guides from our team.
            </p>
        </div>
        <aside class="hero-aside-blog" data-aos="fade-left">
            <h4><i class="fa-solid fa-book-open"></i> What you’ll find here</h4>
            <p>
                Short, practical articles to help you plan your dream trip – from what to pack and
                when to visit, to how to combine Serengeti, Ngorongoro and Zanzibar in one itinerary.
            </p>
        </aside>
    </div>
</section>

<main class="main-blog">
    <div class="container blog-layout-blog">
        <!-- BLOG POSTS -->
        <section>
            <div class="blog-grid-blog">
                <article class="post-card-blog" data-aos="fade-up">
                    <div class="post-image-blog" style="background-image:url('https://images.pexels.com/photos/1207875/pexels-photo-1207875.jpeg?auto=compress&cs=tinysrgb&w=1200');"></div>
                    <div class="post-body-blog">
                        <div class="post-tag-blog">Safari Planning</div>
                        <h2 class="post-title-blog">Best time to visit Serengeti & Ngorongoro</h2>
                        <div class="post-meta-blog">
                            <i class="fa-regular fa-calendar"></i> Seasonal Guide • 5 min read
                        </div>
                        <p class="post-excerpt-blog">
                            Learn how Tanzania’s dry and wet seasons affect wildlife sightings, road
                            conditions and overall safari experience – so you can choose the perfect month
                            for your trip.
                        </p>
                        <div class="post-footer-blog">
                            <span><i class="fa-regular fa-clock"></i> Updated regularly</span>
                            <a href="#" class="link-more-blog">Read article →</a>
                        </div>
                    </div>
                </article>

                <article class="post-card-blog" data-aos="fade-up" data-aos-delay="100">
                    <div class="post-image-blog" style="background-image:url('https://images.pexels.com/photos/2408372/pexels-photo-2408372.jpeg?auto=compress&cs=tinysrgb&w=1200');"></div>
                    <div class="post-body-blog">
                        <div class="post-tag-blog">Zanzibar</div>
                        <h2 class="post-title-blog">Combining Safari & Zanzibar Beach Holiday</h2>
                        <div class="post-meta-blog">
                            <i class="fa-regular fa-calendar"></i> Itinerary Ideas • 4 min read
                        </div>
                        <p class="post-excerpt-blog">
                            Thinking of a few days on safari followed by relaxation by the Indian Ocean?
                            Here’s how many nights to spend in each place and sample route ideas.
                        </p>
                        <div class="post-footer-blog">
                            <span><i class="fa-solid fa-umbrella-beach"></i> Bush & beach combo</span>
                            <a href="#" class="link-more-blog">Read article →</a>
                        </div>
                    </div>
                </article>

                <article class="post-card-blog" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-image-blog" style="background-image:url('https://images.pexels.com/photos/593575/pexels-photo-593575.jpeg?auto=compress&cs=tinysrgb&w=1200');"></div>
                    <div class="post-body-blog">
                        <div class="post-tag-blog">Practical Tips</div>
                        <h2 class="post-title-blog">What to pack for a Tanzanian safari</h2>
                        <div class="post-meta-blog">
                            <i class="fa-regular fa-calendar"></i> Packing List • 3 min read
                        </div>
                        <p class="post-excerpt-blog">
                            From lightweight clothing and camera gear to power adapters and medication,
                            this checklist will make sure you don’t forget the essentials.
                        </p>
                        <div class="post-footer-blog">
                            <span><i class="fa-solid fa-suitcase-rolling"></i> Safari-ready</span>
                            <a href="#" class="link-more-blog">Read article →</a>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- SIDEBAR -->
        <aside>
            <section class="side-card-blog" data-aos="fade-left">
                <div class="side-title-blog">Planning Corner</div>
                <p>
                    Not sure where to begin? Start with these quick tips that we share with almost
                    every guest before they travel.
                </p>
                <ul class="tip-list-blog">
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span><strong>Pick 2–3 main areas</strong> instead of trying to see everything in one trip.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-moon"></i>
                        <span><strong>Stay at least 2 nights</strong> in each park to enjoy unhurried game drives.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-plane-departure"></i>
                        <span><strong>Arrive a day early</strong> in Dar es salaam or Mwanza to rest before safari begins.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-comments"></i>
                        <span><strong>Tell us your priorities</strong> – wildlife, culture, photography, relaxation, or all of them.</span>
                    </li>
                </ul>

                <div class="side-cta-blog">
                    <span style="font-size:12px;color:var(--primary-color);text-transform:uppercase;letter-spacing:.14em;font-weight:700;">
                        Need a personalized plan?
                    </span>
                    <p style="font-size:14px; margin-top: 10px;">
                        Share your dates and interests with our team and we’ll suggest a route and budget that fits you.
                    </p>
                    <button type="button" onclick="window.location.href='{{ route('booking') }}'">
                        <i class="fa-solid fa-paper-plane"></i> Request a safari quote
                    </button>
                </div>
            </section>
        </aside>
    </div>
</main>
@endsection

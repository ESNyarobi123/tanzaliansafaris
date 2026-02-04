@extends('layouts.app')

@section('title', 'Safari Packing List - What to Bring | Tanzalian Safari\'s')

@section('styles')
<style>
    /* ============================================
       PACKING LIST PAGE
    ============================================ */
    
    /* Hero Section */
    .packing-hero {
        background: linear-gradient(135deg, var(--secondary-800), var(--secondary-900));
        padding: 100px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .packing-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center/cover;
        opacity: 0.2;
    }

    .packing-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .packing-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        margin-bottom: 20px;
    }

    .packing-hero p {
        font-size: 18px;
        color: var(--gray-300);
        max-width: 600px;
        margin: 0 auto 30px;
    }

    .packing-hero-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-pdf {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 32px;
        background: white;
        color: var(--secondary-800);
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-pdf:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .btn-print {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 32px;
        background: rgba(255,255,255,0.1);
        color: white;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-print:hover {
        background: rgba(255,255,255,0.2);
        border-color: rgba(255,255,255,0.5);
    }

    /* Quick Info Bar */
    .packing-info-bar {
        background: var(--bg-secondary);
        padding: 40px 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .packing-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .packing-info-item {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .packing-info-icon {
        width: 56px;
        height: 56px;
        background: white;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--primary-600);
        box-shadow: var(--shadow-sm);
    }

    .packing-info-content h4 {
        font-size: 14px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .packing-info-content p {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
    }

    @media (max-width: 1024px) {
        .packing-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .packing-info-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Packing List Content */
    .packing-content {
        padding: 80px 0;
        background: white;
    }

    .packing-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 50px;
    }

    /* Checklist Categories */
    .packing-main {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .packing-category {
        background: var(--bg-secondary);
        border-radius: 24px;
        padding: 32px;
    }

    .packing-category-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .packing-category-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .packing-category h3 {
        font-size: 22px;
        margin-bottom: 4px;
    }

    .packing-category-meta {
        font-size: 14px;
        color: var(--text-secondary);
    }

    /* Checkbox Items */
    .packing-items {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .packing-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 16px;
        background: white;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        border: 2px solid transparent;
    }

    .packing-item:hover {
        border-color: var(--primary-300);
        transform: translateX(4px);
    }

    .packing-item.checked {
        opacity: 0.6;
        background: var(--gray-100);
    }

    .packing-item.checked .packing-item-text {
        text-decoration: line-through;
    }

    .packing-checkbox {
        width: 24px;
        height: 24px;
        border: 2px solid var(--gray-300);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s;
        margin-top: 2px;
    }

    .packing-item:hover .packing-checkbox {
        border-color: var(--primary-400);
    }

    .packing-item.checked .packing-checkbox {
        background: var(--success);
        border-color: var(--success);
        color: white;
    }

    .packing-item-text {
        font-size: 15px;
        color: var(--text-primary);
        line-height: 1.5;
    }

    .packing-item-note {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    @media (max-width: 768px) {
        .packing-items {
            grid-template-columns: 1fr;
        }
    }

    /* Priority Section */
    .priority-section {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border: 2px solid #F1B434;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 40px;
    }

    .priority-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .priority-header i {
        font-size: 24px;
        color: #d97706;
    }

    .priority-header h3 {
        font-size: 18px;
        color: #92400e;
        margin: 0;
    }

    .priority-list {
        list-style: none;
    }

    .priority-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        color: #78350f;
        font-size: 15px;
    }

    .priority-list li i {
        color: #d97706;
    }

    /* Sidebar */
    .packing-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .sidebar-card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 20px;
        padding: 24px;
        box-shadow: var(--shadow-sm);
    }

    .sidebar-card h4 {
        font-size: 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-card h4 i {
        color: var(--primary-600);
    }

    /* Progress Widget */
    .packing-progress {
        text-align: center;
    }

    .progress-circle {
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
        position: relative;
    }

    .progress-circle svg {
        transform: rotate(-90deg);
    }

    .progress-circle-bg {
        fill: none;
        stroke: var(--gray-200);
        stroke-width: 10;
    }

    .progress-circle-fill {
        fill: none;
        stroke: var(--primary-500);
        stroke-width: 10;
        stroke-linecap: round;
        transition: stroke-dashoffset 0.5s;
    }

    .progress-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 32px;
        font-weight: 800;
        color: var(--text-primary);
    }

    .progress-label {
        font-size: 14px;
        color: var(--text-secondary);
    }

    /* Tips List */
    .tips-list {
        list-style: none;
    }

    .tips-list li {
        display: flex;
        gap: 12px;
        padding: 16px 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .tips-list li:last-child {
        border-bottom: none;
    }

    .tips-icon {
        width: 36px;
        height: 36px;
        background: var(--primary-50);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: var(--primary-600);
        flex-shrink: 0;
    }

    .tips-content h5 {
        font-size: 14px;
        margin-bottom: 4px;
    }

    .tips-content p {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.5;
    }

    /* Bag Weight Info */
    .weight-info {
        background: var(--gray-50);
        border-radius: 12px;
        padding: 20px;
    }

    .weight-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .weight-item:last-child {
        border-bottom: none;
    }

    .weight-label {
        font-size: 14px;
        color: var(--text-secondary);
    }

    .weight-value {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* Season Section */
    .season-section {
        padding: 80px 0;
        background: var(--bg-secondary);
    }

    .season-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }

    .season-card {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: var(--shadow-sm);
    }

    .season-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .season-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .season-card.dry .season-icon {
        background: #fef3c7;
    }

    .season-card.wet .season-icon {
        background: #dbeafe;
    }

    .season-card h3 {
        font-size: 20px;
        margin-bottom: 4px;
    }

    .season-card-subtitle {
        font-size: 14px;
        color: var(--text-secondary);
    }

    .season-items {
        list-style: none;
    }

    .season-items li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        font-size: 14px;
        color: var(--text-secondary);
    }

    .season-items li i {
        color: var(--success);
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .packing-grid {
            grid-template-columns: 1fr;
        }
        .packing-sidebar {
            order: -1;
        }
        .season-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Print Styles */
    @media print {
        .packing-hero-actions,
        .packing-sidebar {
            display: none !important;
        }
        
        .packing-item {
            break-inside: avoid;
        }
        
        .packing-category {
            break-inside: avoid;
            page-break-inside: avoid;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="packing-hero">
    <div class="container">
        <div class="packing-hero-content" data-aos="fade-up">
            <h1>Safari Packing List</h1>
            <p>Everything you need for an unforgettable African adventure. Use our interactive checklist to ensure you don't forget anything important!</p>
            <div class="packing-hero-actions">
                <a href="{{ route('packing-list.download') }}" class="btn-pdf">
                    <i class="fas fa-file-pdf"></i>
                    Download PDF
                </a>
                <button class="btn-print" onclick="window.print()">
                    <i class="fas fa-print"></i>
                    Print Checklist
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Quick Info Bar -->
<section class="packing-info-bar">
    <div class="container">
        <div class="packing-info-grid">
            <div class="packing-info-item" data-aos="fade-up" data-aos-delay="100">
                <div class="packing-info-icon">
                    <i class="fas fa-weight-hanging"></i>
                </div>
                <div class="packing-info-content">
                    <h4>Luggage Limit</h4>
                    <p>15kg (Soft bags only)</p>
                </div>
            </div>
            <div class="packing-info-item" data-aos="fade-up" data-aos-delay="150">
                <div class="packing-info-icon">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="packing-info-content">
                    <h4>Clothing Style</h4>
                    <p>Neutral colors (Khaki, Olive)</p>
                </div>
            </div>
            <div class="packing-info-item" data-aos="fade-up" data-aos-delay="200">
                <div class="packing-info-icon">
                    <i class="fas fa-suitcase"></i>
                </div>
                <div class="packing-info-content">
                    <h4>Bag Type</h4>
                    <p>Soft duffel bag recommended</p>
                </div>
            </div>
            <div class="packing-info-item" data-aos="fade-up" data-aos-delay="250">
                <div class="packing-info-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <div class="packing-info-content">
                    <h4>Camera Gear</h4>
                    <p>Zoom lens essential (200mm+)</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Priority Section -->
<section class="packing-content">
    <div class="container">
        <div class="priority-section" data-aos="fade-up">
            <div class="priority-header">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Don't Forget These Essentials!</h3>
            </div>
            <ul class="priority-list">
                <li><i class="fas fa-check-circle"></i> <strong>Passport</strong> - Must be valid for at least 6 months</li>
                <li><i class="fas fa-check-circle"></i> <strong>Yellow Fever Certificate</strong> - Required if arriving from endemic country</li>
                <li><i class="fas fa-check-circle"></i> <strong>Travel Insurance</strong> - Comprehensive coverage including medical evacuation</li>
                <li><i class="fas fa-check-circle"></i> <strong>Malaria Prophylaxis</strong> - Consult your doctor before travel</li>
                <li><i class="fas fa-check-circle"></i> <strong>USD Cash</strong> - Small bills for tips and souvenirs (bills dated 2006 or newer)</li>
                <li><i class="fas fa-check-circle"></i> <strong>Prescription Medications</strong> - Bring in original containers with prescription</li>
            </ul>
        </div>

        <div class="packing-grid">
            <!-- Main Checklist -->
            <div class="packing-main">
                <!-- Clothing -->
                <div class="packing-category" data-aos="fade-up">
                    <div class="packing-category-header">
                        <div class="packing-category-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div>
                            <h3>Clothing</h3>
                            <p class="packing-category-meta">Light, breathable, neutral colors</p>
                        </div>
                    </div>
                    <div class="packing-items">
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Long-sleeve shirts (3-4)</div>
                                <div class="packing-item-note">Lightweight, breathable fabric</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Short-sleeve shirts (3-4)</div>
                                <div class="packing-item-note">Neutral colors (khaki, olive, beige)</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Long pants (2-3 pairs)</div>
                                <div class="packing-item-note">Quick-dry material preferred</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Shorts (1-2 pairs)</div>
                                <div class="packing-item-note">For hot days at camp</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Fleece or light jacket</div>
                                <div class="packing-item-note">Mornings can be cool</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Light rain jacket</div>
                                <div class="packing-item-note">Waterproof, packable</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Swimwear</div>
                                <div class="packing-item-note">Some lodges have pools</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Sleepwear</div>
                                <div class="packing-item-note">Lightweight for warm nights</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Footwear -->
                <div class="packing-category" data-aos="fade-up">
                    <div class="packing-category-header">
                        <div class="packing-category-icon">
                            <i class="fas fa-shoe-prints"></i>
                        </div>
                        <div>
                            <h3>Footwear</h3>
                            <p class="packing-category-meta">Comfortable for walking and game drives</p>
                        </div>
                    </div>
                    <div class="packing-items">
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Comfortable walking shoes</div>
                                <div class="packing-item-note">Broken-in, sturdy soles</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Sandals or flip-flops</div>
                                <div class="packing-item-note">For around camp/lodge</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Light hiking boots</div>
                                <div class="packing-item-note">If doing walking safaris</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Cotton socks (4-5 pairs)</div>
                                <div class="packing-item-note">Plus extra in case of rain</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Accessories -->
                <div class="packing-category" data-aos="fade-up">
                    <div class="packing-category-header">
                        <div class="packing-category-icon">
                            <i class="fas fa-hat-cowboy"></i>
                        </div>
                        <div>
                            <h3>Accessories</h3>
                            <p class="packing-category-meta">Sun protection and comfort items</p>
                        </div>
                    </div>
                    <div class="packing-items">
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Wide-brim hat</div>
                                <div class="packing-item-note">Essential for sun protection</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Sunglasses</div>
                                <div class="packing-item-note">Good quality UV protection</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Buff or scarf</div>
                                <div class="packing-item-note">For dust protection</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Lightweight daypack</div>
                                <div class="packing-item-note">For carrying camera, water</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Binoculars</div>
                                <div class="packing-item-note">8x42 or 10x42 recommended</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Reusable water bottle</div>
                                <div class="packing-item-note">Stay hydrated!</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Toiletries & Health -->
                <div class="packing-category" data-aos="fade-up">
                    <div class="packing-category-header">
                        <div class="packing-category-icon">
                            <i class="fas fa-first-aid"></i>
                        </div>
                        <div>
                            <h3>Toiletries & Health</h3>
                            <p class="packing-category-meta">Personal care and first aid</p>
                        </div>
                    </div>
                    <div class="packing-items">
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Sunscreen SPF 50+</div>
                                <div class="packing-item-note">High SPF essential</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Insect repellent</div>
                                <div class="packing-item-note">DEET-based recommended</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Personal medications</div>
                                <div class="packing-item-note">Bring extra supply</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Basic first aid kit</div>
                                <div class="packing-item-note">Plasters, antiseptic, pain relief</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Anti-malarial medication</div>
                                <div class="packing-item-note">As prescribed by doctor</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Hand sanitizer</div>
                                <div class="packing-item-note">Travel size</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Toiletries</div>
                                <div class="packing-item-note">Toothbrush, toothpaste, etc.</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Tissues/wet wipes</div>
                                <div class="packing-item-note">Handy for dust and bathrooms</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Camera Gear -->
                <div class="packing-category" data-aos="fade-up">
                    <div class="packing-category-header">
                        <div class="packing-category-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div>
                            <h3>Camera Gear</h3>
                            <p class="packing-category-meta">Capture those unforgettable moments</p>
                        </div>
                    </div>
                    <div class="packing-items">
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Camera with zoom lens</div>
                                <div class="packing-item-note">Minimum 200mm zoom recommended</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Extra memory cards</div>
                                <div class="packing-item-note">You'll take more photos than expected!</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Spare batteries</div>
                                <div class="packing-item-note">Charging opportunities limited</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Battery charger</div>
                                <div class="packing-item-note">Plus adapter for Tanzania plugs</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Lens cleaning kit</div>
                                <div class="packing-item-note">Dust is common</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Phone with camera</div>
                                <div class="packing-item-note">For quick shots and videos</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Documents -->
                <div class="packing-category" data-aos="fade-up">
                    <div class="packing-category-header">
                        <div class="packing-category-icon">
                            <i class="fas fa-passport"></i>
                        </div>
                        <div>
                            <h3>Documents</h3>
                            <p class="packing-category-meta">Keep copies in separate locations</p>
                        </div>
                    </div>
                    <div class="packing-items">
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Passport</div>
                                <div class="packing-item-note">Valid for 6+ months</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Yellow fever certificate</div>
                                <div class="packing-item-note">If required for your route</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Travel insurance documents</div>
                                <div class="packing-item-note">Print and digital copies</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Flight tickets/e-tickets</div>
                                <div class="packing-item-note">Confirmation numbers</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Emergency contacts</div>
                                <div class="packing-item-note">Family, embassy, insurance</div>
                            </div>
                        </label>
                        <label class="packing-item">
                            <div class="packing-checkbox"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="packing-item-text">Cash and cards</div>
                                <div class="packing-item-note">USD cash + 2 cards minimum</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="packing-sidebar">
                <!-- Progress Widget -->
                <div class="sidebar-card" data-aos="fade-left" data-aos-delay="100">
                    <h4><i class="fas fa-chart-pie"></i> Your Progress</h4>
                    <div class="packing-progress">
                        <div class="progress-circle">
                            <svg width="150" height="150">
                                <circle class="progress-circle-bg" cx="75" cy="75" r="65"></circle>
                                <circle class="progress-circle-fill" cx="75" cy="75" r="65" 
                                        stroke-dasharray="408" stroke-dashoffset="408" id="progressCircle"></circle>
                            </svg>
                            <div class="progress-text" id="progressText">0%</div>
                        </div>
                        <p class="progress-label"><span id="checkedCount">0</span> of <span id="totalCount">0</span> items packed</p>
                    </div>
                </div>

                <!-- Quick Tips -->
                <div class="sidebar-card" data-aos="fade-left" data-aos-delay="150">
                    <h4><i class="fas fa-lightbulb"></i> Pro Tips</h4>
                    <ul class="tips-list">
                        <li>
                            <div class="tips-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div class="tips-content">
                                <h5>Layer Your Clothes</h5>
                                <p>Mornings are cool, days are hot. Layering helps you adjust.</p>
                            </div>
                        </li>
                        <li>
                            <div class="tips-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <div class="tips-content">
                                <h5>Avoid Bright Colors</h5>
                                <p>Neutral tones (khaki, olive, beige) don't attract insects or disturb animals.</p>
                            </div>
                        </li>
                        <li>
                            <div class="tips-icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="tips-content">
                                <h5>Pack in Carry-On</h5>
                                <p>Keep essentials + 1 day clothes in carry-on in case luggage is delayed.</p>
                            </div>
                        </li>
                        <li>
                            <div class="tips-icon">
                                <i class="fas fa-zap"></i>
                            </div>
                            <div class="tips-content">
                                <h5>Power Bank Essential</h5>
                                <p>Electricity not always available. Bring power bank for devices.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Bag Weight -->
                <div class="sidebar-card" data-aos="fade-left" data-aos-delay="200">
                    <h4><i class="fas fa-weight"></i> Weight Guide</h4>
                    <div class="weight-info">
                        <div class="weight-item">
                            <span class="weight-label">Checked Bag</span>
                            <span class="weight-value">15 kg max</span>
                        </div>
                        <div class="weight-item">
                            <span class="weight-label">Carry-On</span>
                            <span class="weight-value">7 kg max</span>
                        </div>
                        <div class="weight-item">
                            <span class="weight-label">Personal Item</span>
                            <span class="weight-value">3 kg max</span>
                        </div>
                    </div>
                    <p style="font-size: 12px; color: var(--text-muted); margin-top: 12px; line-height: 1.5;">
                        <i class="fas fa-info-circle"></i> Small aircraft used for safari transfers have strict weight limits. Soft duffel bags work best.
                    </p>
                </div>

                <!-- Need Help -->
                <div class="sidebar-card" style="background: linear-gradient(135deg, var(--primary-500), var(--primary-600)); color: white;" data-aos="fade-left" data-aos-delay="250">
                    <h4 style="color: white;"><i class="fas fa-question-circle"></i> Questions?</h4>
                    <p style="font-size: 14px; margin-bottom: 16px; opacity: 0.9;">
                        Not sure what to bring? Our team is happy to help you prepare for your safari.
                    </p>
                    <a href="https://wa.me/255691111111" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; color: white; text-decoration: none; font-weight: 600;">
                        <i class="fab fa-whatsapp"></i>
                        Chat on WhatsApp
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Seasonal Recommendations -->
<section class="season-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-kicker">
                <i class="fas fa-cloud-sun"></i> Seasonal Guide
            </div>
            <h2 class="section-title">What to Expect by Season</h2>
            <p class="section-subtitle">
                Tanzania's weather varies throughout the year. Here's what to pack for each season.
            </p>
        </div>

        <div class="season-grid">
            <div class="season-card dry" data-aos="fade-up" data-aos-delay="100">
                <div class="season-card-header">
                    <div class="season-icon">☀️</div>
                    <div>
                        <h3>Dry Season</h3>
                        <p class="season-card-subtitle">June - October</p>
                    </div>
                </div>
                <ul class="season-items">
                    <li><i class="fas fa-check"></i> Lightweight, breathable clothing</li>
                    <li><i class="fas fa-check"></i> Extra warm layer for mornings</li>
                    <li><i class="fas fa-check"></i> Higher SPF sunscreen</li>
                    <li><i class="fas fa-check"></i> Dust mask or buff</li>
                    <li><i class="fas fa-check"></i> Sunglasses essential</li>
                    <li><i class="fas fa-check"></i> Best wildlife viewing season</li>
                </ul>
            </div>

            <div class="season-card wet" data-aos="fade-up" data-aos-delay="200">
                <div class="season-card-header">
                    <div class="season-icon">🌧️</div>
                    <div>
                        <h3>Wet Season</h3>
                        <p class="season-card-subtitle">November - May</p>
                    </div>
                </div>
                <ul class="season-items">
                    <li><i class="fas fa-check"></i> Waterproof rain jacket</li>
                    <li><i class="fas fa-check"></i> Quick-dry clothing</li>
                    <li><i class="fas fa-check"></i> Waterproof bag for electronics</li>
                    <li><i class="fas fa-check"></i> Warmer clothing for evenings</li>
                    <li><i class="fas fa-check"></i> Anti-malarial prophylaxis</li>
                    <li><i class="fas fa-check"></i> Fewer crowds, lush landscapes</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Packing List Interactive Functions
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.packing-item');
        const totalCount = items.length;
        const checkedCountEl = document.getElementById('checkedCount');
        const totalCountEl = document.getElementById('totalCount');
        const progressText = document.getElementById('progressText');
        const progressCircle = document.getElementById('progressCircle');
        
        // Set total count
        totalCountEl.textContent = totalCount;
        
        // Calculate progress
        function updateProgress() {
            const checked = document.querySelectorAll('.packing-item.checked').length;
            const percentage = Math.round((checked / totalCount) * 100);
            
            checkedCountEl.textContent = checked;
            progressText.textContent = percentage + '%';
            
            // Update circle (circumference = 408)
            const offset = 408 - (408 * percentage) / 100;
            progressCircle.style.strokeDashoffset = offset;
        }
        
        // Add click handlers
        items.forEach(item => {
            item.addEventListener('click', function() {
                this.classList.toggle('checked');
                updateProgress();
                
                // Save to localStorage
                saveProgress();
            });
        });
        
        // Save progress to localStorage
        function saveProgress() {
            const checked = [];
            items.forEach((item, index) => {
                if (item.classList.contains('checked')) {
                    checked.push(index);
                }
            });
            localStorage.setItem('safariPackingList', JSON.stringify(checked));
        }
        
        // Load progress from localStorage
        function loadProgress() {
            const saved = localStorage.getItem('safariPackingList');
            if (saved) {
                const checked = JSON.parse(saved);
                items.forEach((item, index) => {
                    if (checked.includes(index)) {
                        item.classList.add('checked');
                    }
                });
                updateProgress();
            }
        }
        
        // Load saved progress
        loadProgress();
    });
</script>
@endsection

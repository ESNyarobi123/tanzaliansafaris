/**
 * MODERN FEATURES
 * ===============
 * WhatsApp, Social Proof, Wishlist, Reviews, etc.
 */

(function() {
    'use strict';
    
    // ========== WHATSAPP FLOATING BUTTON ==========
    const WhatsApp = {
        phone: '255691111111',
        message: 'Hello! I\'m interested in booking a safari with Tanzalian Safari\'s.',
        
        init() {
            this.createButton();
            this.addEventListeners();
        },
        
        createButton() {
            const cleanPhone = String(this.phone).replace(/\D/g, ''); // digits only

            const button = document.createElement('div');
            button.id = 'whatsapp-button';
            button.innerHTML = `
                <a href="https://wa.me/${cleanPhone}?text=${encodeURIComponent(this.message)}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   title="Chat on WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                    <span>Chat with us</span>
                </a>
            `;
            
            const style = document.createElement('style');
            style.textContent = `
                #whatsapp-button {
                    position: fixed;
                    bottom: 30px;
                    right: 30px;
                    z-index: 9999;
                    animation: bounce 2s infinite;
                }
                
                #whatsapp-button a {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    background: #25D366;
                    color: white;
                    padding: 15px 20px;
                    border-radius: 50px;
                    text-decoration: none;
                    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
                    transition: all 0.3s ease;
                    font-weight: 600;
                }
                
                #whatsapp-button a:hover {
                    transform: scale(1.05);
                    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
                }
                
                #whatsapp-button i {
                    font-size: 24px;
                }
                
                #whatsapp-button span {
                    font-size: 14px;
                }
                
                @keyframes bounce {
                    0%, 100% { transform: translateY(0); }
                    50% { transform: translateY(-10px); }
                }
                
                @media (max-width: 768px) {
                    #whatsapp-button {
                        bottom: 20px;
                        right: 20px;
                    }
                    
                    #whatsapp-button span {
                        display: none;
                    }
                    
                    #whatsapp-button a {
                        width: 60px;
                        height: 60px;
                        justify-content: center;
                        padding: 0;
                        border-radius: 50%;
                    }
                }
            `;
            
            document.head.appendChild(style);
            document.body.appendChild(button);
        },
        
        addEventListeners() {
            // Track WhatsApp clicks
            const btn = document.getElementById('whatsapp-button');
            if (!btn) return;

            btn.addEventListener('click', () => {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'whatsapp_click', {
                        'event_category': 'engagement',
                        'event_label': 'WhatsApp Button'
                    });
                }
            });
        }
    };
    
    // ========== SOCIAL PROOF NOTIFICATIONS ==========
    const SocialProof = {
        notifications: [],
        currentIndex: 0,
        interval: null,
        
        init() {
            this.fetchNotifications();
            this.createContainer();
        },
        
        async fetchNotifications() {
            try {
                // Check cache
                const cached = localStorage.getItem('social_proof_cache');
                const cacheTime = localStorage.getItem('social_proof_cache_time');
                const now = Date.now();
                
                if (cached && cacheTime && (now - parseInt(cacheTime)) < 300000) {
                    this.notifications = JSON.parse(cached);
                    this.startRotation();
                    return;
                }
                
                // Fetch from API (simulate for now)
                this.notifications = [
                    {
                        name: 'Emma from UK',
                        action: 'just booked',
                        package: 'Classic Northern Circuit',
                        time: '5 minutes ago'
                    },
                    {
                        name: 'David from USA',
                        action: 'just booked',
                        package: 'Ultimate Tanzania Experience',
                        time: '12 minutes ago'
                    },
                    {
                        name: 'Lisa from Germany',
                        action: 'left a 5-star review',
                        package: '',
                        time: '20 minutes ago'
                    }
                ];
                
                // Cache
                localStorage.setItem('social_proof_cache', JSON.stringify(this.notifications));
                localStorage.setItem('social_proof_cache_time', now.toString());
                
                this.startRotation();
            } catch (error) {
                console.error('Error fetching social proof:', error);
            }
        },
        
        createContainer() {
            const container = document.createElement('div');
            container.id = 'social-proof-container';
            
            const style = document.createElement('style');
            style.textContent = `
                #social-proof-container {
                    position: fixed;
                    bottom: 120px;
                    left: 30px;
                    z-index: 9998;
                    max-width: 350px;
                }
                
                .social-proof-notification {
                    background: white;
                    padding: 15px 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                    display: none;
                    animation: slideInLeft 0.5s ease;
                    border-left: 4px solid #10b981;
                }
                
                .social-proof-notification.show {
                    display: block;
                }
                
                .social-proof-notification .sp-header {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    margin-bottom: 8px;
                }
                
                .social-proof-notification .sp-avatar {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #d4a373, #2c5530);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: 600;
                }
                
                .social-proof-notification .sp-content {
                    flex: 1;
                }
                
                .social-proof-notification .sp-name {
                    font-weight: 600;
                    color: #1a1a1a;
                    font-size: 14px;
                }
                
                .social-proof-notification .sp-action {
                    color: #666;
                    font-size: 13px;
                }
                
                .social-proof-notification .sp-time {
                    color: #999;
                    font-size: 12px;
                    margin-top: 5px;
                }
                
                .social-proof-notification .sp-close {
                    background: none;
                    border: none;
                    color: #999;
                    cursor: pointer;
                    font-size: 18px;
                    padding: 0;
                    line-height: 1;
                }
                
                @keyframes slideInLeft {
                    from {
                        transform: translateX(-100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                @keyframes slideOutLeft {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(-100%);
                        opacity: 0;
                    }
                }
                
                @media (max-width: 768px) {
                    #social-proof-container {
                        left: 10px;
                        right: 10px;
                        max-width: none;
                        bottom: 100px;
                    }
                }
            `;
            
            document.head.appendChild(style);
            document.body.appendChild(container);
        },
        
        showNotification(notification) {
            const container = document.getElementById('social-proof-container');
            const initial = notification.name.charAt(0).toUpperCase();
            
            const notif = document.createElement('div');
            notif.className = 'social-proof-notification';
            notif.innerHTML = `
                <div class="sp-header">
                    <div class="sp-avatar">${initial}</div>
                    <div class="sp-content">
                        <div class="sp-name">${notification.name}</div>
                        <div class="sp-action">${notification.action} ${notification.package}</div>
                    </div>
                    <button class="sp-close" onclick="this.parentElement.parentElement.remove()">&times;</button>
                </div>
                <div class="sp-time">${notification.time}</div>
            `;
            
            container.innerHTML = '';
            container.appendChild(notif);
            
            setTimeout(() => {
                notif.classList.add('show');
            }, 100);
            
            // Auto hide after 8 seconds
            setTimeout(() => {
                notif.style.animation = 'slideOutLeft 0.5s ease';
                setTimeout(() => {
                    notif.remove();
                }, 500);
            }, 8000);
        },
        
        startRotation() {
            if (this.notifications.length === 0) return;
            
            // Show first notification after 5 seconds
            setTimeout(() => {
                this.showNotification(this.notifications[this.currentIndex]);
            }, 5000);
            
            // Rotate notifications every 15 seconds
            this.interval = setInterval(() => {
                this.currentIndex = (this.currentIndex + 1) % this.notifications.length;
                this.showNotification(this.notifications[this.currentIndex]);
            }, 15000);
        }
    };
    
    // ========== WISHLIST SYSTEM ==========
    const Wishlist = {
        items: [],
        
        init() {
            this.loadWishlist();
            this.attachButtons();
            this.updateCounter();
        },
        
        loadWishlist() {
            const stored = localStorage.getItem('wishlist');
            this.items = stored ? JSON.parse(stored) : [];
        },
        
        saveWishlist() {
            localStorage.setItem('wishlist', JSON.stringify(this.items));
            this.updateCounter();
        },
        
        add(packageId, packageName, packagePrice, packageImage) {
            if (this.isInWishlist(packageId)) {
                this.remove(packageId);
                return false;
            }
            
            this.items.push({
                id: packageId,
                name: packageName,
                price: packagePrice,
                image: packageImage,
                addedAt: new Date().toISOString()
            });
            
            this.saveWishlist();
            return true;
        },
        
        remove(packageId) {
            this.items = this.items.filter(item => item.id != packageId);
            this.saveWishlist();
        },
        
        isInWishlist(packageId) {
            return this.items.some(item => item.id == packageId);
        },
        
        getCount() {
            return this.items.length;
        },
        
        updateCounter() {
            const counters = document.querySelectorAll('.wishlist-count');
            counters.forEach(counter => {
                counter.textContent = this.getCount();
                counter.style.display = this.getCount() > 0 ? 'block' : 'none';
            });
        },
        
        attachButtons() {
            document.querySelectorAll('[data-wishlist-btn]').forEach(btn => {
                const packageId = btn.dataset.packageId;
                
                // Update button state
                if (this.isInWishlist(packageId)) {
                    btn.classList.add('in-wishlist');
                    btn.innerHTML = '<i class="fas fa-heart"></i> Saved';
                }
                
                // Add click handler
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const added = this.add(
                        packageId,
                        btn.dataset.packageName,
                        btn.dataset.packagePrice,
                        btn.dataset.packageImage
                    );
                    
                    if (added) {
                        btn.classList.add('in-wishlist');
                        btn.innerHTML = '<i class="fas fa-heart"></i> Saved';
                        this.showToast('Added to wishlist!');
                    } else {
                        btn.classList.remove('in-wishlist');
                        btn.innerHTML = '<i class="far fa-heart"></i> Save';
                        this.showToast('Removed from wishlist');
                    }
                });
            });
        },
        
        showToast(message) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #2c5530;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                z-index: 10000;
                animation: slideInRight 0.3s ease;
            `;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    };
    
    // ========== REVIEWS DISPLAY ==========
    const Reviews = {
        async loadReviews(packageId = null) {
            try {
                const url = packageId 
                    ? `/api/reviews.php?package_id=${packageId}&status=approved&limit=5`
                    : `/api/reviews.php?status=approved&featured=1&limit=3`;
                
                const response = await fetch(url);
                const result = await response.json();
                
                if (result.success) {
                    this.displayReviews(result.data, result.stats);
                }
            } catch (error) {
                console.error('Error loading reviews:', error);
            }
        },
        
        displayReviews(reviews, stats) {
            const container = document.querySelector('.reviews-container');
            if (!container) return;
            
            // Display stats
            if (stats) {
                const statsHtml = `
                    <div class="reviews-stats">
                        <div class="rating-overview">
                            <div class="rating-number">${stats.average_rating}</div>
                            <div class="rating-stars">${this.renderStars(stats.average_rating)}</div>
                            <div class="rating-count">${stats.total_reviews} reviews</div>
                        </div>
                    </div>
                `;
                container.innerHTML = statsHtml;
            }
            
            // Display reviews
            reviews.forEach(review => {
                const reviewEl = document.createElement('div');
                reviewEl.className = 'review-item';
                reviewEl.innerHTML = `
                    <div class="review-header">
                        <div class="review-avatar">${review.customer_name.charAt(0)}</div>
                        <div class="review-info">
                            <div class="review-author">${review.customer_name}</div>
                            <div class="review-rating">${this.renderStars(review.rating)}</div>
                        </div>
                        <div class="review-date">${new Date(review.created_at).toLocaleDateString()}</div>
                    </div>
                    ${review.review_title ? `<div class="review-title">${review.review_title}</div>` : ''}
                    <div class="review-text">${review.review_text}</div>
                    ${review.admin_reply ? `
                        <div class="admin-reply">
                            <strong>Reply from Tanzalian Safari's:</strong>
                            <p>${review.admin_reply}</p>
                        </div>
                    ` : ''}
                `;
                container.appendChild(reviewEl);
            });
        },
        
        renderStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="fas fa-star"></i>';
                } else if (i - 0.5 <= rating) {
                    stars += '<i class="fas fa-star-half-alt"></i>';
                } else {
                    stars += '<i class="far fa-star"></i>';
                }
            }
            return stars;
        }
    };
    
    // ========== INITIALIZE ALL FEATURES ==========
    function init() {
        WhatsApp.init();
        SocialProof.init();
        Wishlist.init();
        
        if (document.querySelector('.reviews-container')) {
            const packageId = document.body.dataset.packageId;
            Reviews.loadReviews(packageId);
        }
        
        console.log('Modern features initialized!');
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    window.TanzalianFeatures = {
        WhatsApp,
        SocialProof,
        Wishlist,
        Reviews
    };
    
})();

// Add necessary animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .wishlist-count {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ff6b35;
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }
    
    [data-wishlist-btn].in-wishlist i {
        color: #ff6b35;
    }
`;
document.head.appendChild(style);
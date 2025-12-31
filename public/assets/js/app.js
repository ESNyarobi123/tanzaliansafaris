/**
 * TANZALIAN SAFARI'S - SHARED JAVASCRIPT
 * =======================================
 * Behaviors for public pages
 */

(function() {
    'use strict';
    
    // ========== SMOOTH SCROLL ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // ========== SCROLL TO TOP BUTTON ==========
    const scrollTopBtn = document.querySelector('.scroll-top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
        });
        
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // ========== MOBILE MENU TOGGLE ==========
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // ========== FORM VALIDATION ==========
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    
                    // Show error message
                    let error = field.nextElementSibling;
                    if (!error || !error.classList.contains('form-error')) {
                        error = document.createElement('span');
                        error.className = 'form-error';
                        error.textContent = 'This field is required';
                        field.parentNode.insertBefore(error, field.nextSibling);
                    }
                } else {
                    field.classList.remove('is-invalid');
                    const error = field.nextElementSibling;
                    if (error && error.classList.contains('form-error')) {
                        error.remove();
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                }
            }
        });
        
        // Remove error on input
        form.querySelectorAll('[required]').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                const error = this.nextElementSibling;
                if (error && error.classList.contains('form-error')) {
                    error.remove();
                }
            });
        });
    });
    
    // ========== AJAX FORM SUBMISSIONS ==========
    const ajaxForms = document.querySelectorAll('form[data-ajax]');
    ajaxForms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            
            try {
                const response = await fetch(form.action, {
                    method: form.method || 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success || data.ok) {
                    showAlert('success', data.message || 'Form submitted successfully!');
                    form.reset();
                    
                    // Trigger custom success event
                    form.dispatchEvent(new CustomEvent('ajax-success', { detail: data }));
                } else {
                    showAlert('danger', data.message || 'An error occurred. Please try again.');
                }
            } catch (error) {
                console.error('Form submission error:', error);
                showAlert('danger', 'Network error. Please check your connection and try again.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    });
    
    // ========== ALERT HELPER ==========
    function showAlert(type, message) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.textContent = message;
        alert.style.position = 'fixed';
        alert.style.top = '20px';
        alert.style.right = '20px';
        alert.style.zIndex = '10000';
        alert.style.minWidth = '300px';
        alert.style.animation = 'slideIn 0.3s ease';
        
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }
    
    // ========== FAQ ACCORDION ==========
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', function() {
                // Close other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        }
    });
    
    // ========== DATE PICKER MIN DATE ==========
    const datePickers = document.querySelectorAll('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    datePickers.forEach(picker => {
        if (!picker.hasAttribute('min')) {
            picker.setAttribute('min', today);
        }
    });
    
    // ========== LOADING OVERLAY ==========
    window.showLoading = function() {
        let overlay = document.getElementById('loading-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'loading-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 99999;
            `;
            overlay.innerHTML = '<div style="color: white; font-size: 1.5rem;"><i class="fas fa-spinner fa-spin"></i> Loading...</div>';
            document.body.appendChild(overlay);
        }
        overlay.style.display = 'flex';
    };
    
    window.hideLoading = function() {
        const overlay = document.getElementById('loading-overlay');
        if (overlay) {
            overlay.style.display = 'none';
        }
    };
    
    // ========== LAZY LOADING IMAGES ==========
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    console.log('Tanzalian Safari\'s - App JS loaded');
})();


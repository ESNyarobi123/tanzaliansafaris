/**
 * ENHANCED ADMIN DASHBOARD JAVASCRIPT
 * ====================================
 * Modern, feature-rich admin functionality
 */

(function() {
    'use strict';
    
    // ========== TOAST NOTIFICATION SYSTEM ==========
    const Toast = {
        container: null,
        
        init() {
            if (!this.container) {
                this.container = document.createElement('div');
                this.container.className = 'toast-container';
                document.body.appendChild(this.container);
            }
        },
        
        show(message, type = 'info', duration = 5000) {
            this.init();
            
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            
            const icons = {
                success: 'fa-check-circle',
                error: 'fa-exclamation-circle',
                warning: 'fa-exclamation-triangle',
                info: 'fa-info-circle'
            };
            
            const titles = {
                success: 'Success',
                error: 'Error',
                warning: 'Warning',
                info: 'Information'
            };
            
            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="fas ${icons[type]}"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">${titles[type]}</div>
                    <div class="toast-message">${message}</div>
                </div>
            `;
            
            this.container.appendChild(toast);
            
            // Auto remove
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, duration);
            
            // Click to dismiss
            toast.addEventListener('click', () => {
                toast.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            });
        },
        
        success(message, duration) {
            this.show(message, 'success', duration);
        },
        
        error(message, duration) {
            this.show(message, 'error', duration);
        },
        
        warning(message, duration) {
            this.show(message, 'warning', duration);
        },
        
        info(message, duration) {
            this.show(message, 'info', duration);
        }
    };
    
    // Make Toast global
    window.Toast = Toast;
    
    // ========== LOADING OVERLAY ==========
    const Loading = {
        overlay: null,
        
        init() {
            if (!this.overlay) {
                this.overlay = document.createElement('div');
                this.overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.5);
                    display: none;
                    align-items: center;
                    justify-content: center;
                    z-index: 99999;
                    backdrop-filter: blur(4px);
                `;
                
                this.overlay.innerHTML = `
                    <div style="text-align: center;">
                        <div class="loading-spinner" style="width: 60px; height: 60px; border-width: 5px;"></div>
                        <p style="color: white; margin-top: 1rem; font-size: 1.1rem;">Loading...</p>
                    </div>
                `;
                
                document.body.appendChild(this.overlay);
            }
        },
        
        show() {
            this.init();
            this.overlay.style.display = 'flex';
        },
        
        hide() {
            if (this.overlay) {
                this.overlay.style.display = 'none';
            }
        }
    };
    
    // Make Loading global
    window.Loading = Loading;
    
    // ========== CONFIRM DIALOG ==========
    window.confirmDialog = function(message, callback) {
        const overlay = document.createElement('div');
        overlay.className = 'modal-overlay active';
        
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.style.maxWidth = '500px';
        
        modal.innerHTML = `
            <div class="modal-header">
                <h3 class="modal-title">Confirm Action</h3>
            </div>
            <div class="modal-body">
                <p style="font-size: 1.05rem; color: var(--text-dark);">${message}</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="this.closest('.modal-overlay').remove()">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button class="btn btn-danger" id="confirmBtn">
                    <i class="fas fa-check"></i> Confirm
                </button>
            </div>
        `;
        
        overlay.appendChild(modal);
        document.body.appendChild(overlay);
        
        document.getElementById('confirmBtn').onclick = function() {
            overlay.remove();
            callback();
        };
        
        overlay.onclick = function(e) {
            if (e.target === overlay) {
                overlay.remove();
            }
        };
    };
    
    // ========== FORM VALIDATION ==========
    function validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('[required]');
        
        inputs.forEach(input => {
            // Remove previous error states
            input.style.borderColor = '';
            const errorMsg = input.parentElement.querySelector('.error-message');
            if (errorMsg) errorMsg.remove();
            
            // Validate
            if (!input.value.trim()) {
                isValid = false;
                input.style.borderColor = 'var(--danger-color)';
                
                const error = document.createElement('div');
                error.className = 'error-message';
                error.style.cssText = 'color: var(--danger-color); font-size: 0.813rem; margin-top: 0.375rem;';
                error.textContent = 'This field is required';
                input.parentElement.appendChild(error);
            }
            
            // Email validation
            if (input.type === 'email' && input.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(input.value)) {
                    isValid = false;
                    input.style.borderColor = 'var(--danger-color)';
                    
                    const error = document.createElement('div');
                    error.className = 'error-message';
                    error.style.cssText = 'color: var(--danger-color); font-size: 0.813rem; margin-top: 0.375rem;';
                    error.textContent = 'Please enter a valid email';
                    input.parentElement.appendChild(error);
                }
            }
            
            // URL validation
            if (input.type === 'url' && input.value) {
                try {
                    new URL(input.value);
                } catch {
                    isValid = false;
                    input.style.borderColor = 'var(--danger-color)';
                    
                    const error = document.createElement('div');
                    error.className = 'error-message';
                    error.style.cssText = 'color: var(--danger-color); font-size: 0.813rem; margin-top: 0.375rem;';
                    error.textContent = 'Please enter a valid URL';
                    input.parentElement.appendChild(error);
                }
            }
        });
        
        return isValid;
    }
    
    // Auto-validate on submit
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.classList.contains('no-validate')) return;
        
        if (!validateForm(form)) {
            e.preventDefault();
            Toast.error('Please fill in all required fields correctly');
        }
    });
    
    // ========== SIDEBAR TOGGLE ==========
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.admin-sidebar');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 1024) {
                if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });
    }
    
    // ========== AUTO-RESIZE TEXTAREA ==========
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
    
    // ========== SEARCH FUNCTIONALITY ==========
    const searchInput = document.querySelector('.admin-search input');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.toLowerCase();
            
            searchTimeout = setTimeout(() => {
                // Implement search logic here
                console.log('Searching for:', query);
            }, 500);
        });
    }
    
    // ========== CHARACTER COUNTER ==========
    document.querySelectorAll('textarea[maxlength], input[maxlength]').forEach(input => {
        const maxLength = input.getAttribute('maxlength');
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.cssText = 'text-align: right; font-size: 0.75rem; color: var(--text-light); margin-top: 0.25rem;';
        
        function updateCounter() {
            const remaining = maxLength - input.value.length;
            counter.textContent = `${input.value.length} / ${maxLength}`;
            counter.style.color = remaining < 20 ? 'var(--danger-color)' : 'var(--text-light)';
        }
        
        input.parentElement.appendChild(counter);
        updateCounter();
        
        input.addEventListener('input', updateCounter);
    });
    
    // ========== COPY TO CLIPBOARD ==========
    window.copyToClipboard = function(text, elementId) {
        const element = elementId ? document.getElementById(elementId) : null;
        const textToCopy = element ? element.value || element.textContent : text;
        
        if (navigator.clipboard) {
            navigator.clipboard.writeText(textToCopy).then(() => {
                Toast.success('Copied to clipboard!', 2000);
            }).catch(() => {
                Toast.error('Failed to copy');
            });
        } else {
            // Fallback for older browsers
            const textarea = document.createElement('textarea');
            textarea.value = textToCopy;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                Toast.success('Copied to clipboard!', 2000);
            } catch (err) {
                Toast.error('Failed to copy');
            }
            document.body.removeChild(textarea);
        }
    };
    
    // ========== AUTO-SAVE DRAFT ==========
    const formInputs = document.querySelectorAll('form input, form textarea, form select');
    let autoSaveTimeout;
    
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimeout);
            const form = this.closest('form');
            if (!form || form.classList.contains('no-autosave')) return;
            
            autoSaveTimeout = setTimeout(() => {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);
                localStorage.setItem('draft_' + form.id, JSON.stringify(data));
                
                // Show subtle indicator
                const indicator = document.createElement('div');
                indicator.style.cssText = `
                    position: fixed;
                    bottom: 2rem;
                    left: 50%;
                    transform: translateX(-50%);
                    background: var(--success-color);
                    color: white;
                    padding: 0.5rem 1rem;
                    border-radius: var(--radius-full);
                    font-size: 0.813rem;
                    animation: fadeInOut 2s ease-in-out;
                `;
                indicator.textContent = 'Draft saved';
                document.body.appendChild(indicator);
                
                setTimeout(() => {
                    if (indicator.parentNode) {
                        indicator.parentNode.removeChild(indicator);
                    }
                }, 2000);
            }, 3000);
        });
    });
    
    // ========== IMAGE PREVIEW ==========
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = input.parentElement.querySelector('.image-preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.className = 'image-preview';
                    preview.style.cssText = `
                        max-width: 200px;
                        max-height: 200px;
                        margin-top: 1rem;
                        border-radius: var(--radius-md);
                        box-shadow: var(--shadow-md);
                    `;
                    input.parentElement.appendChild(preview);
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    });
    
    // ========== TOOLTIPS ==========
    document.querySelectorAll('[data-tooltip]').forEach(element => {
        element.addEventListener('mouseenter', function(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            tooltip.style.cssText = `
                position: absolute;
                background: var(--dark-color);
                color: white;
                padding: 0.5rem 0.75rem;
                border-radius: var(--radius-md);
                font-size: 0.813rem;
                z-index: 10000;
                pointer-events: none;
                white-space: nowrap;
                box-shadow: var(--shadow-lg);
            `;
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 8) + 'px';
            tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
            
            this._tooltip = tooltip;
        });
        
        element.addEventListener('mouseleave', function() {
            if (this._tooltip) {
                this._tooltip.remove();
                this._tooltip = null;
            }
        });
    });
    
    // ========== SMOOTH SCROLL ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#' || !href) return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // ========== KEYBOARD SHORTCUTS ==========
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S = Save (prevent default and trigger form submit)
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            const form = document.querySelector('form:not(.no-shortcuts)');
            if (form) {
                form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
                Toast.info('Saving...', 1000);
            }
        }
        
        // Escape = Close modal
        if (e.key === 'Escape') {
            const modal = document.querySelector('.modal-overlay.active');
            if (modal) {
                modal.classList.remove('active');
            }
        }
    });
    
    // ========== TABLE ENHANCEMENTS ==========
    document.querySelectorAll('.table tbody tr').forEach(row => {
        // Add hover effect
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // ========== DATE/TIME FORMATTING ==========
    window.formatDate = function(dateString, format = 'short') {
        const date = new Date(dateString);
        const options = {
            short: { year: 'numeric', month: 'short', day: 'numeric' },
            long: { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' },
            time: { hour: '2-digit', minute: '2-digit' }
        };
        return date.toLocaleDateString('en-US', options[format]);
    };
    
    // ========== INITIALIZE ==========
    console.log('%c🦁 Tanzalian Safari\'s Admin Panel', 'color: #d4a373; font-size: 20px; font-weight: bold;');
    console.log('%c✨ Enhanced Edition', 'color: #2c5530; font-size: 14px;');
    console.log('%cShortcuts: Ctrl+S (Save) | Esc (Close Modal)', 'color: #666; font-size: 12px;');
    
    // Show welcome toast on first load
    if (!sessionStorage.getItem('welcomed')) {
        setTimeout(() => {
            Toast.success('Welcome to Tanzalian Safari\'s Admin Panel!', 4000);
            sessionStorage.setItem('welcomed', 'true');
        }, 1000);
    }
    
})();

// ========== ADDITIONAL ANIMATIONS ==========
const style = document.createElement('style');
style.textContent = `
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
    }
    
    @keyframes fadeInOut {
        0%, 100% { opacity: 0; transform: translateX(-50%) translateY(10px); }
        10%, 90% { opacity: 1; transform: translateX(-50%) translateY(0); }
    }
`;
document.head.appendChild(style);


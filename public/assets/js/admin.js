/**
 * TANZALIAN SAFARI'S - ADMIN DASHBOARD JAVASCRIPT
 * ================================================
 * Behaviors specific to admin panel
 */

(function() {
    'use strict';
    
    // ========== SIDEBAR TOGGLE ==========
    const menuToggle = document.querySelector('.menu-toggle');
    const adminSidebar = document.querySelector('.admin-sidebar');
    const adminMain = document.querySelector('.admin-main');
    
    if (menuToggle && adminSidebar) {
        menuToggle.addEventListener('click', function() {
            adminSidebar.classList.toggle('open');
        });
        
        // Close sidebar on mobile when clicking outside
        if (window.innerWidth < 1024) {
            adminMain.addEventListener('click', function() {
                if (adminSidebar.classList.contains('open')) {
                    adminSidebar.classList.remove('open');
                }
            });
        }
    }
    
    // ========== DATA TABLE FILTERS ==========
    const tableFilters = document.querySelectorAll('.data-table-filters select, .data-table-filters input');
    tableFilters.forEach(filter => {
        filter.addEventListener('change', function() {
            applyTableFilters();
        });
        
        if (filter.tagName === 'INPUT') {
            filter.addEventListener('keyup', debounce(function() {
                applyTableFilters();
            }, 500));
        }
    });
    
    function applyTableFilters() {
        const filters = {};
        tableFilters.forEach(filter => {
            if (filter.value) {
                filters[filter.name] = filter.value;
            }
        });
        
        console.log('Applying filters:', filters);
        // Implement actual filtering logic here or via AJAX
    }
    
    // ========== MODAL MANAGEMENT ==========
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };
    
    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    };
    
    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });
    
    // Close modal buttons
    document.querySelectorAll('.modal-close, [data-modal-close]').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal-overlay');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });
    
    // ========== CONFIRM DELETE ==========
    document.querySelectorAll('[data-confirm]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const message = this.dataset.confirm || 'Are you sure you want to delete this item?';
            if (!confirm(message)) {
                e.preventDefault();
                return false;
            }
        });
    });
    
    // ========== TABLE ROW SELECTION ==========
    const selectAllCheckbox = document.getElementById('select-all');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActions();
        });
    }
    
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateBulkActions();
            
            // Update select-all checkbox state
            if (selectAllCheckbox) {
                const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }
        });
    });
    
    function updateBulkActions() {
        const selectedCount = document.querySelectorAll('.row-checkbox:checked').length;
        const bulkActions = document.querySelector('.bulk-actions');
        
        if (bulkActions) {
            if (selectedCount > 0) {
                bulkActions.style.display = 'flex';
                bulkActions.querySelector('.selected-count').textContent = selectedCount;
            } else {
                bulkActions.style.display = 'none';
            }
        }
    }
    
    // ========== SORTABLE TABLES ==========
    document.querySelectorAll('th[data-sort]').forEach(header => {
        header.style.cursor = 'pointer';
        header.innerHTML += ' <i class="fas fa-sort"></i>';
        
        header.addEventListener('click', function() {
            const column = this.dataset.sort;
            const table = this.closest('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            // Determine sort direction
            const currentDirection = this.dataset.direction || 'asc';
            const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            this.dataset.direction = newDirection;
            
            // Update sort icons
            table.querySelectorAll('th[data-sort]').forEach(th => {
                th.querySelector('i').className = 'fas fa-sort';
            });
            this.querySelector('i').className = `fas fa-sort-${newDirection === 'asc' ? 'up' : 'down'}`;
            
            // Sort rows
            const columnIndex = Array.from(this.parentElement.children).indexOf(this);
            rows.sort((a, b) => {
                const aValue = a.children[columnIndex].textContent.trim();
                const bValue = b.children[columnIndex].textContent.trim();
                
                // Try numeric comparison first
                const aNum = parseFloat(aValue);
                const bNum = parseFloat(bValue);
                
                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return newDirection === 'asc' ? aNum - bNum : bNum - aNum;
                }
                
                // String comparison
                return newDirection === 'asc' 
                    ? aValue.localeCompare(bValue)
                    : bValue.localeCompare(aValue);
            });
            
            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));
        });
    });
    
    // ========== CHARTS (if Chart.js is loaded) ==========
    if (typeof Chart !== 'undefined') {
        // Sales chart example
        const salesChartCanvas = document.getElementById('salesChart');
        if (salesChartCanvas) {
            new Chart(salesChartCanvas, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Bookings',
                        data: [12, 19, 15, 25, 22, 30],
                        borderColor: '#d4a373',
                        backgroundColor: 'rgba(212, 163, 115, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    }
    
    // ========== AUTO-DISMISS ALERTS ==========
    document.querySelectorAll('.alert').forEach(alert => {
        if (alert.dataset.autoDismiss !== 'false') {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        }
    });
    
    // ========== UTILITY: DEBOUNCE ==========
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // ========== COPY TO CLIPBOARD ==========
    window.copyToClipboard = function(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                showToast('Copied to clipboard!');
            });
        } else {
            // Fallback
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            showToast('Copied to clipboard!');
        }
    };
    
    // ========== TOAST NOTIFICATIONS ==========
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            z-index: 10000;
            animation: slideUp 0.3s ease;
            border-left: 4px solid;
        `;
        
        const colors = {
            success: '#28a745',
            danger: '#dc3545',
            warning: '#ffc107',
            info: '#17a2b8'
        };
        
        toast.style.borderLeftColor = colors[type] || colors.info;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideDown 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    };
    
    // ========== AJAX UTILITIES ==========
    window.adminAjax = async function(url, options = {}) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ||
                         document.querySelector('input[name="csrf_token"]')?.value;
        
        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken
            }
        };
        
        try {
            const response = await fetch(url, { ...defaultOptions, ...options });
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'Request failed');
            }
            
            return data;
        } catch (error) {
            console.error('AJAX Error:', error);
            showToast(error.message || 'An error occurred', 'danger');
            throw error;
        }
    };
    
    console.log('Tanzalian Safari\'s - Admin JS loaded');
})();

// ========== ADD ANIMATION STYLES ==========
const style = document.createElement('style');
style.textContent = `
    @keyframes slideUp {
        from { transform: translateY(100px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes slideDown {
        from { transform: translateY(0); opacity: 1; }
        to { transform: translateY(100px); opacity: 0; }
    }
    @keyframes slideIn {
        from { transform: translateX(100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100px); opacity: 0; }
    }
`;
document.head.appendChild(style);


/**
 * CONTENT LOADER
 * ==============
 * Dynamically loads navbar items and announcements from the CMS
 */

(function() {
    'use strict';
    
    // Configuration
    const config = {
        apiBaseUrl: '/api',
        navbarSelector: '.nav-menu',
        announcementSelector: '#announcements-container'
    };
    
    /**
     * Initialize content loader
     */
    function init() {
        // Delay loading to not block page render
        setTimeout(() => {
            // Load navbar items (cached)
            loadNavbarItems();
            
            // Load announcements
            loadAnnouncements();
        }, 100);
    }
    
    /**
     * Load navbar items from API (with caching)
     */
    async function loadNavbarItems() {
        try {
            // Check cache first (5 minutes)
            const cached = localStorage.getItem('navbar_cache');
            const cacheTime = localStorage.getItem('navbar_cache_time');
            const now = Date.now();
            
            if (cached && cacheTime && (now - parseInt(cacheTime)) < 300000) {
                // Use cached data
                const data = JSON.parse(cached);
                renderNavbar(data);
                return;
            }
            
            // Fetch fresh data
            const response = await fetch(`${config.apiBaseUrl}/navbar.php`);
            const result = await response.json();
            
            if (result.success && result.data) {
                // Cache the data
                localStorage.setItem('navbar_cache', JSON.stringify(result.data));
                localStorage.setItem('navbar_cache_time', now.toString());
                renderNavbar(result.data);
            }
        } catch (error) {
            console.error('Error loading navbar items:', error);
            // Keep default navbar if API fails
        }
    }
    
    /**
     * Render navbar items
     */
    function renderNavbar(items) {
        const navMenu = document.querySelector(config.navbarSelector);
        if (!navMenu) return;
        
        // Clear existing items
        navMenu.innerHTML = '';
        
        // Render items
        items.forEach(item => {
            const li = document.createElement('li');
            const a = document.createElement('a');
            
            a.href = item.url;
            a.target = item.target || '_self';
            
            if (item.icon) {
                const icon = document.createElement('i');
                icon.className = item.icon;
                icon.style.marginRight = '8px';
                a.appendChild(icon);
            }
            
            a.appendChild(document.createTextNode(item.label));
            
            if (item.css_class) {
                a.className = item.css_class;
            }
            
            li.appendChild(a);
            
            // Add children if exists (dropdown)
            if (item.children && item.children.length > 0) {
                const dropdown = document.createElement('ul');
                dropdown.className = 'dropdown-menu';
                
                item.children.forEach(child => {
                    const childLi = document.createElement('li');
                    const childA = document.createElement('a');
                    childA.href = child.url;
                    childA.target = child.target || '_self';
                    
                    if (child.icon) {
                        const childIcon = document.createElement('i');
                        childIcon.className = child.icon;
                        childIcon.style.marginRight = '8px';
                        childA.appendChild(childIcon);
                    }
                    
                    childA.appendChild(document.createTextNode(child.label));
                    childLi.appendChild(childA);
                    dropdown.appendChild(childLi);
                });
                
                li.appendChild(dropdown);
                li.classList.add('has-dropdown');
            }
            
            navMenu.appendChild(li);
        });
    }
    
    /**
     * Load announcements from API
     */
    async function loadAnnouncements() {
        try {
            // Get current page location
            const isHomepage = window.location.pathname === '/' || window.location.pathname === '/index.html';
            const location = isHomepage ? 'homepage' : 'navbar';
            
            const response = await fetch(`${config.apiBaseUrl}/announcements.php?location=${location}&active_only=true`);
            const result = await response.json();
            
            if (result.success && result.data && result.data.length > 0) {
                renderAnnouncements(result.data);
            }
        } catch (error) {
            console.error('Error loading announcements:', error);
        }
    }
    
    /**
     * Render announcements
     */
    function renderAnnouncements(announcements) {
        // Create announcements container if doesn't exist
        let container = document.querySelector(config.announcementSelector);
        
        if (!container) {
            // Create container after top bar
            container = document.createElement('div');
            container.id = 'announcements-container';
            
            const topBar = document.querySelector('.top-bar');
            if (topBar) {
                topBar.after(container);
            } else {
                const header = document.querySelector('header');
                if (header) {
                    header.before(container);
                }
            }
        }
        
        // Clear existing announcements
        container.innerHTML = '';
        
        // Render each announcement
        announcements.forEach(announcement => {
            const announcementDiv = document.createElement('div');
            announcementDiv.className = `announcement announcement-${announcement.type}`;
            announcementDiv.style.cssText = `
                background: ${getAnnouncementColor(announcement.type)};
                color: white;
                padding: 12px 20px;
                text-align: center;
                font-size: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
            `;
            
            // Icon
            if (announcement.icon) {
                const icon = document.createElement('i');
                icon.className = announcement.icon;
                announcementDiv.appendChild(icon);
            }
            
            // Message
            const message = document.createElement('span');
            message.textContent = announcement.message;
            announcementDiv.appendChild(message);
            
            // Link
            if (announcement.link_url && announcement.link_text) {
                const link = document.createElement('a');
                link.href = announcement.link_url;
                link.textContent = announcement.link_text;
                link.style.cssText = `
                    color: white;
                    text-decoration: underline;
                    margin-left: 10px;
                    font-weight: 600;
                `;
                announcementDiv.appendChild(link);
            }
            
            // Close button
            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '&times;';
            closeBtn.style.cssText = `
                position: absolute;
                right: 15px;
                background: none;
                border: none;
                color: white;
                font-size: 24px;
                cursor: pointer;
                padding: 0;
                line-height: 1;
            `;
            closeBtn.onclick = () => {
                announcementDiv.style.display = 'none';
                // Store dismissed announcement in localStorage
                localStorage.setItem(`announcement_${announcement.id}_dismissed`, 'true');
            };
            
            // Check if announcement was previously dismissed
            if (localStorage.getItem(`announcement_${announcement.id}_dismissed`) === 'true') {
                announcementDiv.style.display = 'none';
            }
            
            announcementDiv.appendChild(closeBtn);
            container.appendChild(announcementDiv);
        });
    }
    
    /**
     * Get announcement background color based on type
     */
    function getAnnouncementColor(type) {
        const colors = {
            'info': '#3498db',
            'success': '#2ecc71',
            'warning': '#f39c12',
            'danger': '#e74c3c'
        };
        return colors[type] || colors['info'];
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();


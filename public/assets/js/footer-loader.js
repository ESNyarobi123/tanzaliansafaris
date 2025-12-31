/**
 * FOOTER LOADER
 * ==============
 * Dynamically loads footer links from database
 */

(function() {
    'use strict';
    
    // Configuration
    const config = {
        apiBaseUrl: '/api',
        quickLinksSelector: '.footer-column:nth-child(2) .footer-links',
        resourcesSelector: '.footer-column:nth-child(3) .footer-links'
    };
    
    /**
     * Initialize footer loader
     */
    function init() {
        // Check if footer exists
        const quickLinksContainer = document.querySelector(config.quickLinksSelector);
        const resourcesContainer = document.querySelector(config.resourcesSelector);
        
        if (quickLinksContainer || resourcesContainer) {
            loadFooterLinks();
        }
    }
    
    /**
     * Load footer links from API
     */
    async function loadFooterLinks() {
        try {
            // Check cache first (10 minutes)
            const cached = localStorage.getItem('footer_links_cache');
            const cacheTime = localStorage.getItem('footer_links_cache_time');
            const now = Date.now();
            
            if (cached && cacheTime && (now - parseInt(cacheTime)) < 600000) {
                // Use cached data
                const data = JSON.parse(cached);
                renderFooterLinks(data);
                return;
            }
            
            // Fetch fresh data
            const response = await fetch(`${config.apiBaseUrl}/footer-links.php`);
            const result = await response.json();
            
            if (result.success && result.data) {
                // Cache the data
                localStorage.setItem('footer_links_cache', JSON.stringify(result.data));
                localStorage.setItem('footer_links_cache_time', now.toString());
                renderFooterLinks(result.data);
            }
        } catch (error) {
            console.error('Error loading footer links:', error);
            // Keep default footer if API fails
        }
    }
    
    /**
     * Render footer links
     */
    function renderFooterLinks(links) {
        const quickLinks = links.filter(link => link.section === 'quick_links');
        const resources = links.filter(link => link.section === 'resources');
        
        // Render Quick Links
        const quickLinksContainer = document.querySelector(config.quickLinksSelector);
        if (quickLinksContainer && quickLinks.length > 0) {
            quickLinksContainer.innerHTML = '';
            quickLinks.forEach(link => {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = link.url;
                
                if (link.icon) {
                    const icon = document.createElement('i');
                    icon.className = link.icon;
                    a.appendChild(icon);
                    a.appendChild(document.createTextNode(' '));
                }
                
                a.appendChild(document.createTextNode(link.label));
                li.appendChild(a);
                quickLinksContainer.appendChild(li);
            });
        }
        
        // Render Resources
        const resourcesContainer = document.querySelector(config.resourcesSelector);
        if (resourcesContainer && resources.length > 0) {
            resourcesContainer.innerHTML = '';
            resources.forEach(link => {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = link.url;
                
                if (link.icon) {
                    const icon = document.createElement('i');
                    icon.className = link.icon;
                    a.appendChild(icon);
                    a.appendChild(document.createTextNode(' '));
                }
                
                a.appendChild(document.createTextNode(link.label));
                li.appendChild(a);
                resourcesContainer.appendChild(li);
            });
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();


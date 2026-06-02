// Push Notification Button Component
// Add this script to pages where you want to show manual notification enable button

(function() {
    'use strict';
    
    // Create notification button element
    function createNotificationButton() {
        console.log('[Push Button] Attempting to create button');
        
        // Check if button already exists
        if (document.getElementById('push-notification-btn')) {
            console.log('[Push Button] Button already exists');
            return;
        }
        
        // Only show for logged-in users
        const isLoggedIn = document.body.classList.contains('logged-in');
        console.log('[Push Button] Is logged in:', isLoggedIn);
        
        if (!isLoggedIn) {
            console.log('[Push Button] User not logged in, not showing button');
            return;
        }
        
        // Check if notifications are supported
        if (!('Notification' in window) || !('serviceWorker' in navigator)) {
            console.log('[Push Button] Notifications not supported');
            return;
        }
        
        console.log('[Push Button] Notifications supported, checking permission...');
        
        // Check current permission status
        const permission = Notification.permission;
        console.log('[Push Button] Current permission:', permission);
        
        // Don't show button if notifications are already granted
        if (permission === 'granted') {
            console.log('[Push Button] Notifications already granted, not showing button');
            return;
        }
        
        const buttonText = 'Omogući Notifikacije';
        const buttonColor = '#977141';
        
        console.log('[Push Button] Creating button with text:', buttonText);
        
        // Create button container
        const container = document.createElement('div');
        container.id = 'push-notification-btn';
        
        // Check if PWA install banner is visible and adjust position accordingly
        const pwaBanner = document.getElementById('pwa-install-banner');
        const isPwaVisible = pwaBanner && pwaBanner.style.display !== 'none' && window.getComputedStyle(pwaBanner).display !== 'none';
        const bottomPos = isPwaVisible ? 'calc(60px + 20px + 20px)' : '20px'; // 60px banner height + 20px gap + 20px from bottom
        
        container.style.cssText = `
            position: fixed;
            bottom: ${bottomPos};
            right: 20px;
            z-index: 9999;
            animation: slideInUp 0.5s ease-out;
        `;
        
        // Create button
        const button = document.createElement('button');
        button.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 8px;">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            ${buttonText}
        `;
        button.style.cssText = `
            background: ${buttonColor};
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        `;
        
        button.onmouseover = function() {
            this.style.background = '#7f5f35';
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 6px 16px rgba(0,0,0,0.2)';
        };
        
        button.onmouseout = function() {
            this.style.background = '#977141';
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        };
        
        button.onclick = async function() {
            console.log('[Push Button] Clicked');
            this.disabled = true;
            this.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 8px; animation: spin 1s linear infinite;">
                    <circle cx="12" cy="12" r="10"></circle>
                </svg>
                Aktiviranje...
            `;
            
            try {
                console.log('[Push Button] Calling enablePushNotifications...');
                
                if (typeof window.enablePushNotifications !== 'function') {
                    throw new Error('enablePushNotifications function not found');
                }
                
                const result = await window.enablePushNotifications();
                console.log('[Push Button] Result:', result);
                
                if (result && result.success) {
                    this.innerHTML = `
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 8px;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Notifikacije Omogućene
                    `;
                    this.style.background = '#4CAF50';
                    
                    setTimeout(() => {
                        container.style.animation = 'slideOutDown 0.5s ease-in';
                        setTimeout(() => container.remove(), 500);
                    }, 2000);
                } else {
                    const errorMsg = result ? result.message : 'Unknown error';
                    console.error('[Push Button] Failed:', errorMsg);
                    this.innerHTML = `
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 8px;">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        ${errorMsg.length > 20 ? 'Greška' : errorMsg}
                    `;
                    this.style.background = '#f44336';
                    this.disabled = false;
                    
                    setTimeout(() => {
                        this.innerHTML = `
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 8px;">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            Omogući Notifikacije
                        `;
                        this.style.background = '#977141';
                    }, 3000);
                }
            } catch (err) {
                console.error('[Push Button] Error:', err);
                this.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 8px;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    Greška: ${err.message}
                `;
                this.style.background = '#f44336';
                this.disabled = false;
                
                setTimeout(() => {
                    this.innerHTML = `
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 8px;">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        Omogući Notifikacije
                    `;
                    this.style.background = '#977141';
                    this.disabled = false;
                }, 4000);
            }
        };
        
        // Close button
        const closeBtn = document.createElement('button');
        closeBtn.className = 'close-btn';
        closeBtn.innerHTML = '×';
        closeBtn.style.cssText = `
            position: absolute;
            top: -8px;
            right: -8px;
            background: white;
            color: #666;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
        `;
        
        closeBtn.onmouseover = function() {
            this.style.background = '#f44336';
            this.style.color = 'white';
        };
        
        closeBtn.onmouseout = function() {
            this.style.background = 'white';
            this.style.color = '#666';
        };
        
        closeBtn.onclick = function() {
            container.style.animation = 'slideOutDown 0.5s ease-in';
            setTimeout(() => container.remove(), 500);
        };
        
        container.appendChild(button);
        container.appendChild(closeBtn);
        document.body.appendChild(container);
        
        // Add animations and responsive styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInUp {
                from {
                    transform: translateY(100px);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
            @keyframes slideOutDown {
                from {
                    transform: translateY(0);
                    opacity: 1;
                }
                to {
                    transform: translateY(100px);
                    opacity: 0;
                }
            }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            @media (max-width: 600px) {
                #push-notification-btn {
                    right: 10px !important;
                    bottom: 10px !important;
                }
                #push-notification-btn button {
                    padding: 10px 16px !important;
                    font-size: 12px !important;
                }
                #push-notification-btn button svg {
                    width: 16px !important;
                    height: 16px !important;
                }
                #push-notification-btn .close-btn {
                    width: 20px !important;
                    height: 20px !important;
                    font-size: 16px !important;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Monitor PWA banner visibility changes and adjust notification button position
        const observerOptions = {
            attributes: true,
            attributeFilter: ['style', 'class'],
            attributeOldValue: true
        };
        
        const adjustNotificationButtonPosition = () => {
            const pwaBanner = document.getElementById('pwa-install-banner');
            const notifBtn = document.getElementById('push-notification-btn');
            
            if (!notifBtn || !pwaBanner) return;
            
            const isPwaVisible = pwaBanner.style.display !== 'none' && window.getComputedStyle(pwaBanner).display !== 'none';
            const newBottomPos = isPwaVisible ? 'calc(60px + 20px + 20px)' : '20px';
            
            notifBtn.style.bottom = newBottomPos;
        };
        
        // Watch for PWA banner changes
        const pwaBanner = document.getElementById('pwa-install-banner');
        if (pwaBanner) {
            const observer = new MutationObserver(adjustNotificationButtonPosition);
            observer.observe(pwaBanner, observerOptions);
        }
    }
    
    // Show button after a short delay
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            console.log('[Push Button] DOM ready, showing button in 2s');
            setTimeout(createNotificationButton, 2000);
        });
    } else {
        console.log('[Push Button] DOM already ready, showing button in 2s');
        setTimeout(createNotificationButton, 2000);
    }
})();

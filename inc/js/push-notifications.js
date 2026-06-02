// Push Notifications Manager
class PushNotificationManager {
    constructor() {
        this.vapidPublicKey = null;
        this.subscription = null;
        this.init();
    }

    async init() {
        if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
            console.log('[Push] Not supported in this browser');
            this.showMacWarning();
            return;
        }
        
        // Check if running in standalone mode (PWA)
        const isStandalone = window.matchMedia('(display-mode: standalone)').matches || 
                           window.navigator.standalone || 
                           document.referrer.includes('android-app://');
        
        console.log('[Push] Running in standalone mode:', isStandalone);

        // Get VAPID public key from server
        try {
            const response = await fetch('/inc/ajax/get_vapid_key.php');
            const data = await response.json();
            this.vapidPublicKey = data.publicKey;
            console.log('[Push] VAPID key loaded');
        } catch (err) {
            console.log('[Push] Failed to fetch VAPID key:', err);
            return;
        }

        // Wait for service worker to be ready
        try {
            console.log('[Push] Checking for existing service worker...');
            
            // Get all registrations
            const registrations = await navigator.serviceWorker.getRegistrations();
            console.log('[Push] Found', registrations.length, 'service worker(s)');
            
            let registration;
            
            if (registrations.length > 0) {
                // Use existing registration
                registration = registrations[0];
                console.log('[Push] Using existing service worker');
            } else {
                // Register new one
                console.log('[Push] Registering new service worker...');
                registration = await navigator.serviceWorker.register('/service-worker.js', { 
                    scope: '/',
                    updateViaCache: 'none' 
                });
                console.log('[Push] Service worker registered');
            }
            
            // Wait for it to be ready
            console.log('[Push] Waiting for service worker to be ready...');
            registration = await navigator.serviceWorker.ready;
            console.log('[Push] Service worker ready');
            
            await this.checkAndSubscribe(registration);
            
            // Re-check every minute
            setInterval(() => {
                navigator.serviceWorker.ready.then(reg => {
                    this.checkAndSubscribe(reg);
                });
            }, 60000);
        } catch (err) {
            console.log('[Push] Service worker error:', err);
        }
    }
    
    showMacWarning() {
        // Detect Mac/Safari
        const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
        const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
        
        if (isMac && isSafari) {
            console.log('[Push] Mac Safari detected - Web Push may have limited support');
            // Could show a user-friendly message here if needed
        }
    }

    async checkAndSubscribe(registration) {
        try {
            // Check if user is logged in
            const loggedIn = document.body.classList.contains('logged-in');
            if (!loggedIn) {
                console.log('[Push] Skip subscribe – not logged in');
                return;
            }

            // Check if already subscribed
            const subscription = await registration.pushManager.getSubscription();
            
            if (!subscription) {
                // Not subscribed, request permission and subscribe
                const permission = await Notification.requestPermission();
                
                if (permission === 'granted') {
                    console.log('[Push] Permission granted, subscribing');
                    await this.subscribe(registration);
                } else {
                    console.log('[Push] Permission not granted:', permission);
                }
            } else {
                // Already subscribed, ensure it's saved on server
                console.log('[Push] Subscription exists, saving to server');
                this.saveSubscription(subscription);
            }
        } catch (err) {
            console.log('[Push] Subscription check error:', err);
        }
    }
    
    // Manual subscription method that can be triggered by a button
    async requestPermissionManually() {
        try {
            console.log('[Push] Manual subscription requested');
            console.log('[Push] User Agent:', navigator.userAgent);
            
            const isStandalone = window.matchMedia('(display-mode: standalone)').matches || 
                               window.navigator.standalone || 
                               document.referrer.includes('android-app://');
            
            console.log('[Push] Standalone mode:', isStandalone);
            console.log('[Push] Is mobile:', /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
            
            if (!('serviceWorker' in navigator)) {
                console.error('[Push] Service Worker not supported');
                return { success: false, message: 'Service Worker nije podržan' };
            }
            
            if (!('PushManager' in window)) {
                console.error('[Push] Push notifications not supported');
                return { success: false, message: 'Push notifikacije nisu podržane' };
            }
            
            console.log('[Push] Checking for existing service worker...');
            const registrations = await navigator.serviceWorker.getRegistrations();
            console.log('[Push] Found', registrations.length, 'service worker(s)');
            
            let registration;
            
            if (registrations.length > 0) {
                registration = registrations[0];
                console.log('[Push] Using existing SW, scope:', registration.scope);
                
                // Make sure it's active
                if (registration.installing) {
                    console.log('[Push] SW is installing, waiting...');
                    await new Promise(resolve => {
                        registration.installing.addEventListener('statechange', function() {
                            if (this.state === 'activated') resolve();
                        });
                    });
                }
                
                await navigator.serviceWorker.ready;
                console.log('[Push] Service worker ready');
            } else {
                console.log('[Push] Registering new service worker...');
                registration = await navigator.serviceWorker.register('/service-worker.js', { 
                    scope: '/',
                    updateViaCache: 'none'
                });
                console.log('[Push] Service worker registered, waiting...');
                await navigator.serviceWorker.ready;
                console.log('[Push] Service worker now ready');
            }
            
            const subscription = await registration.pushManager.getSubscription();
            
            if (subscription) {
                console.log('[Push] Already subscribed');
                return { success: true, message: 'Već ste prijavljeni' };
            }
            
            console.log('[Push] Requesting permission...');
            const permission = await Notification.requestPermission();
            console.log('[Push] Permission result:', permission);
            
            if (permission === 'granted') {
                console.log('[Push] Permission granted, subscribing...');
                try {
                    await this.subscribe(registration);
                    console.log('[Push] Subscribe completed successfully');
                    return { success: true, message: 'Notifikacije omogućene' };
                } catch (subscribeErr) {
                    console.error('[Push] Subscribe failed:', subscribeErr);
                    return { success: false, message: 'Greška pri prijavi: ' + subscribeErr.message };
                }
            } else {
                console.log('[Push] Permission denied');
                return { success: false, message: 'Dozvola odbijena' };
            }
        } catch (err) {
            console.error('[Push] Manual subscription error:', err);
            return { success: false, message: 'Greška: ' + err.message };
        }
    }

    async subscribe(registration) {
        try {
            console.log('[Push] Creating subscription with VAPID key...');
            console.log('[Push] User Agent:', navigator.userAgent);
            console.log('[Push] Platform:', navigator.platform);
            
            const options = {
                userVisibleOnly: true,
                applicationServerKey: this.urlBase64ToUint8Array(this.vapidPublicKey)
            };
            
            console.log('[Push] Subscription options:', options);
            
            const subscription = await registration.pushManager.subscribe(options);
            console.log('[Push] Subscription object created:', subscription);

            console.log('[Push] Subscription created, saving to server...');
            await this.saveSubscription(subscription);
            console.log('[Push] Subscription successful');
        } catch (err) {
            console.error('[Push] Push subscription error:', err);
            console.error('[Push] Error name:', err.name);
            console.error('[Push] Error message:', err.message);
            console.error('[Push] Error stack:', err.stack);
            throw err;
        }
    }

    async saveSubscription(subscription) {
        try {
            const response = await fetch('/inc/ajax/save_push_subscription.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify(subscription)
            });

            if (!response.ok) {
                throw new Error('Failed to save subscription');
            }

            const data = await response.json();
            console.log('[Push] Save response:', data);
            if (data.success) {
                console.log('[Push] Subscription saved on server');
            } else {
                console.log('[Push] Save subscription failed:', data.error || 'unknown');
            }
        } catch (err) {
            console.log('[Push] Save subscription error:', err);
        }
    }

    urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/\-/g, '+')
            .replace(/_/g, '/');

        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }

        return outputArray;
    }
}

// Initialize push notifications when DOM is ready
let pushManager;

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        pushManager = new PushNotificationManager();
    });
} else {
    pushManager = new PushNotificationManager();
}

// Global function for manual subscription (can be called from button)
window.enablePushNotifications = async function() {
    console.log('[Push] Global function called');
    if (!pushManager) {
        console.error('[Push] Manager not initialized');
        return { success: false, message: 'Push manager not initialized' };
    }
    
    try {
        const result = await pushManager.requestPermissionManually();
        console.log('[Push] Result:', result);
        return result;
    } catch (err) {
        console.error('[Push] Global function error:', err);
        return { success: false, message: err.message };
    }
};


// Simple Push Notification Button - Always Shows
(function() {
    'use strict';
    
    function createButton() {
        // Remove old button if exists
        const oldBtn = document.getElementById('push-btn-simple');
        if (oldBtn) oldBtn.remove();
        
        const container = document.createElement('div');
        container.id = 'push-btn-simple';
        container.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99998;
        `;
        
        const button = document.createElement('button');
        button.id = 'enable-push-btn';
        button.style.cssText = `
            background: #977141;
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 30px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        `;
        button.textContent = '🔔 Notifikacije';
        
        button.onclick = async function() {
            if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
                alert('Push notifikacije nisu podržane u ovom browseru.');
                return;
            }
            
            this.textContent = '⏳ Čekam...';
            this.disabled = true;
            
            try {
                const permission = await Notification.requestPermission();
                
                if (permission !== 'granted') {
                    this.textContent = '❌ Odbijeno';
                    this.style.background = '#f44336';
                    this.disabled = false;
                    setTimeout(() => {
                        this.textContent = '🔔 Notifikacije';
                        this.style.background = '#977141';
                    }, 3000);
                    return;
                }
                
                const registrations = await navigator.serviceWorker.getRegistrations();
                let registration;
                
                if (registrations.length > 0) {
                    registration = registrations[0];
                } else {
                    registration = await navigator.serviceWorker.register('/service-worker.js?v=' + Date.now(), {
                        scope: '/',
                        updateViaCache: 'none'
                    });
                }
                
                await navigator.serviceWorker.ready;
                
                const existingSub = await registration.pushManager.getSubscription();
                if (existingSub) {
                    this.textContent = '✅ Već omogućeno';
                    this.style.background = '#4CAF50';
                    return;
                }
                
                const vapidResponse = await fetch('/inc/ajax/get_vapid_key.php');
                const vapidData = await vapidResponse.json();
                
                const subscription = await registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: urlBase64ToUint8Array(vapidData.publicKey)
                });
                
                const saveResponse = await fetch('/inc/ajax/save_push_subscription.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'same-origin',
                    body: JSON.stringify(subscription)
                });
                
                const saveData = await saveResponse.json();
                
                if (saveData.success) {
                    this.textContent = '✅ Omogućeno';
                    this.style.background = '#4CAF50';
                } else {
                    throw new Error(saveData.error || 'Server error');
                }
                
            } catch (err) {
                this.textContent = '❌ Greška';
                this.style.background = '#f44336';
                this.disabled = false;
                alert('Greška: ' + err.message);
                setTimeout(() => {
                    this.textContent = '🔔 Notifikacije';
                    this.style.background = '#977141';
                }, 3000);
            }
        };
        
        container.appendChild(button);
        document.body.appendChild(container);
    }
    
    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);
        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }
    
    // Create button when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', createButton);
    } else {
        createButton();
    }
})();

{locale path="./locale" domain="messages"}
<div class="notification-settings-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="page-title">{t}Notification Settings{/t}</h2>
                
                {if isset($status)}
                    <div class="alert alert-{$status}" role="alert">
                        {$message}
                    </div>
                {/if}

                <div class="settings-card">
                    <form method="POST" action="/notification-settings.php" class="notification-form">
                        
                        <div class="settings-group">
                            <h3>{t}Notification Preferences{/t}</h3>
                            <p class="text-muted">{t}Choose which notifications you want to receive{/t}</p>
                        </div>

                        <!-- Push Notifications -->
                        <div class="setting-item">
                            <div class="form-check form-switch">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="push_notifications" 
                                    id="pushNotifications"
                                    {if isset($pushEnabled) && $pushEnabled}checked{/if}
                                    value="1"
                                >
                                <label class="form-check-label" for="pushNotifications">
                                    <span class="setting-title">{t}Push Notifications{/t}</span>
                                    <span class="setting-description">{t}Receive push notifications for important updates{/t}</span>
                                </label>
                            </div>
                        </div>

                        <!-- Email Notifications -->
                        <div class="setting-item">
                            <div class="form-check form-switch">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="email_notifications" 
                                    id="emailNotifications"
                                    {if isset($emailEnabled) && $emailEnabled}checked{/if}
                                    value="1"
                                >
                                <label class="form-check-label" for="emailNotifications">
                                    <span class="setting-title">{t}Email Notifications{/t}</span>
                                    <span class="setting-description">{t}Receive email updates about your consultations{/t}</span>
                                </label>
                            </div>
                        </div>

                        <div class="settings-actions">
                            <button type="submit" class="btn gradient-border">{t}Save Settings{/t}</button>
                            <a href="/" class="btn btn-secondary">{t}Back{/t}</a>
                        </div>
                    </form>
                </div>

                <div class="info-section">
                    <h4>{t}About Notifications{/t}</h4>
                    <p>{t}We respect your privacy and will only send notifications according to your preferences. You can change these settings at any time.{/t}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.notification-settings-container {
    padding: 40px 0;
    min-height: 600px;
}

.page-title {
    color: #ffffff;
    margin-bottom: 30px;
    font-weight: 600;
}

.settings-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 30px;
    margin-bottom: 30px;
}

.settings-group {
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.settings-group h3 {
    color: #333;
    font-size: 18px;
    margin-bottom: 8px;
}

.settings-group p {
    margin: 0;
}

.setting-item {
    padding: 20px 0;
    border-bottom: 1px solid #f0f0f0;
}

.setting-item:last-child {
    border-bottom: none;
}

.form-check {
    display: flex;
    align-items: flex-start;
}

.form-check-input {
    margin-top: 4px;
    margin-right: 15px;
    width: 50px;
    height: 24px;
    cursor: pointer;
}

.form-check-label {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    flex: 1;
}

.setting-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.setting-description {
    font-size: 13px;
    color: #999;
}

.settings-actions {
    margin-top: 30px;
    display: flex;
    gap: 10px;
}

.settings-actions .btn {
    padding: 10px 25px;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-weight: 600;
}

.settings-actions .btn-secondary {
    background-color: #f0f0f0;
    color: #333;
}

.settings-actions .btn-secondary:hover {
    background-color: #e0e0e0;
}

.info-section {
    background: #f9f9f9;
    border-left: 4px solid #977141;
    padding: 20px;
    border-radius: 5px;
}

.info-section h4 {
    margin-top: 0;
    color: #333;
}

.info-section p {
    margin-bottom: 0;
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

.alert {
    padding: 12px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.subscription-status {
    background: #e7f3ff;
    border-left: 4px solid #2196F3;
    padding: 12px 15px;
    margin-top: 15px;
    border-radius: 4px;
    font-size: 13px;
    color: #0c5460;
}

.subscription-status.connected {
    background: #d4edda;
    border-left-color: #28a745;
    color: #155724;
}

.subscription-status.disconnected {
    background: #fff3cd;
    border-left-color: #ffc107;
    color: #856404;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.notification-form');
    const pushCheckbox = document.getElementById('pushNotifications');
    
    if (!form || !pushCheckbox) return;
    
    form.addEventListener('submit', function(e) {
        // Ako korisnik uključuje push notifikacije i nema subscription
        if (pushCheckbox.checked && !document.body.classList.contains('has-subscription')) {
            e.preventDefault();
            
            // Prvo spremi u bazu
            const formData = new FormData(form);
            
            fetch('/notification-settings.php', {
                method: 'POST',
                credentials: 'same-origin',
                body: formData
            })
            .then(response => response.text())
            .then(() => {
                // Sada registruj Service Worker i push
                registerServiceWorkerAndPush();
            })
            .catch(error => console.error('Error:', error));
        }
    });
});

function registerServiceWorkerAndPush() {
    if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
        alert('Push notifications are not supported in your browser');
        return;
    }
    
    navigator.serviceWorker.register('/service-worker.js')
        .then(registration => {
            console.log('Service Worker registered');
            subscribeToPush(registration);
        })
        .catch(error => {
            console.error('Service Worker registration failed:', error);
            alert('Failed to register service worker');
        });
}

function subscribeToPush(registration) {
    // Uzmi VAPID javni ključ
    fetch('/inc/ajax/get_vapid_key.php')
        .then(response => {
            console.log('Get VAPID response status:', response.status);
            console.log('Get VAPID response headers:', response.headers);
            
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error('Failed to get VAPID key: ' + response.status + ' - ' + text.substring(0, 100));
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('VAPID data received:', data);
            
            if (data.error) {
                throw new Error(data.error);
            }
            if (!data.publicKey) {
                throw new Error('No VAPID key from server');
            }
            
            const vapidPublicKey = data.publicKey;
            const convertedVapidKey = urlBase64ToUint8Array(vapidPublicKey);
            
            return registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: convertedVapidKey
            });
        })
        .then(subscription => {
            console.log('Push subscription successful:', subscription);
            // Spremi subscription na server
            return fetch('/inc/ajax/save_push_subscription.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(subscription)
            });
        })
        .then(response => {
            console.log('Save subscription response status:', response.status);
            
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error('Failed to save subscription: ' + response.status + ' - ' + text.substring(0, 100));
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Subscription saved:', data);
            
            if (!data.success) {
                throw new Error(data.error || 'Failed to save subscription');
            }
            
            // Reload stranica da pokaže uspeh
            setTimeout(() => {
                window.location.href = '/notification-settings.php?push=1';
            }, 1000);
        })
        .catch(error => {
            console.error('Push subscription failed:', error);
            alert('Failed to enable push notifications: ' + error.message);
        });
}

function urlBase64ToUint8Array(base64String) {
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
</script>


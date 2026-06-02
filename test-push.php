<?php
/**
 * Test Push Notifications
 * Simple script to test push notification functionality
 */

require_once 'includes.php';
require_once 'inc/class/PushNotificationHelper.php';

header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Push Notifications</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .result { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        button { padding: 10px 20px; margin: 5px; cursor: pointer; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Test Push Notifications</h1>
    
    <?php if (!$login->isLoggedIn()): ?>
        <p class="error">Morate biti ulogovani da biste testirali push notifikacije.</p>
        <a href="index.php">Uloguj se</a>
    <?php else: ?>
        <p>Trenutno ste ulogovani kao: <strong><?php echo $_SESSION['loggedName']; ?></strong></p>
        <p>User ID: <strong><?php echo $_SESSION['logged']; ?></strong></p>
        
        <h2>Ručni Test</h2>
        <button onclick="testNotification()">Pošalji Test Notifikaciju</button>
        <div id="result"></div>
        
        <h2>Browser Info</h2>
        <div id="browserInfo"></div>
        
        <h2>Service Worker Status</h2>
        <div id="swStatus"></div>
        
        <h2>Push Subscription Status</h2>
        <div id="subStatus"></div>
        
        <script>
            async function testNotification() {
                const resultDiv = document.getElementById('result');
                resultDiv.innerHTML = '<p>Šaljem...</p>';
                
                try {
                    const response = await fetch('/inc/ajax/send_push_notification.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            type: 'test',
                            user_id: <?php echo $_SESSION['logged']; ?>,
                            title: 'Test Notifikacija',
                            body: 'Ovo je test push notifikacije iz consultation sistema!'
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        resultDiv.innerHTML = `
                            <div class="result success">
                                <strong>Uspešno!</strong><br>
                                Poslato: ${data.sent || 0}<br>
                                Neuspelo: ${data.failed || 0}<br>
                                ${data.message || ''}
                            </div>
                        `;
                    } else {
                        resultDiv.innerHTML = `
                            <div class="result error">
                                <strong>Greška:</strong> ${data.error || 'Unknown error'}
                            </div>
                        `;
                    }
                } catch (err) {
                    resultDiv.innerHTML = `
                        <div class="result error">
                            <strong>Greška:</strong> ${err.message}
                        </div>
                    `;
                }
            }
            
            // Check browser info
            const browserInfo = document.getElementById('browserInfo');
            const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
            const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
            
            browserInfo.innerHTML = `
                <p>Platform: ${navigator.platform}</p>
                <p>User Agent: ${navigator.userAgent}</p>
                <p>Is Mac: ${isMac ? 'Yes' : 'No'}</p>
                <p>Is Safari: ${isSafari ? 'Yes' : 'No'}</p>
                <p>Push Supported: ${'PushManager' in window ? 'Yes' : 'No'}</p>
                <p>Service Worker Supported: ${'serviceWorker' in navigator ? 'Yes' : 'No'}</p>
                <p>Notification Permission: ${Notification.permission}</p>
            `;
            
            // Check service worker
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.ready.then(registration => {
                    document.getElementById('swStatus').innerHTML = `
                        <p class="success">✓ Service Worker je registrovan</p>
                        <p>Scope: ${registration.scope}</p>
                    `;
                    
                    // Check subscription
                    registration.pushManager.getSubscription().then(subscription => {
                        if (subscription) {
                            document.getElementById('subStatus').innerHTML = `
                                <p class="success">✓ Subscription postoji</p>
                                <p>Endpoint: ${subscription.endpoint.substring(0, 50)}...</p>
                            `;
                        } else {
                            document.getElementById('subStatus').innerHTML = `
                                <p class="error">✗ Nije subscription</p>
                                <button onclick="requestPermission()">Zatraži Dozvolu</button>
                            `;
                        }
                    });
                }).catch(err => {
                    document.getElementById('swStatus').innerHTML = `
                        <p class="error">✗ Service Worker nije registrovan: ${err.message}</p>
                    `;
                });
            } else {
                document.getElementById('swStatus').innerHTML = `
                    <p class="error">✗ Service Worker nije podržan u ovom browseru</p>
                `;
            }
            
            async function requestPermission() {
                const permission = await Notification.requestPermission();
                if (permission === 'granted') {
                    alert('Dozvola odobrena! Osvežite stranicu.');
                    location.reload();
                } else {
                    alert('Dozvola odbijena: ' + permission);
                }
            }
        </script>
    <?php endif; ?>
</body>
</html>

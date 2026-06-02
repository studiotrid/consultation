// Proveravamo status notifikacija pri učitavanju stranice
document.addEventListener('DOMContentLoaded', function() {
    updateNotificationBellStatus();
    
    // Proveravamo status svakih 30 sekundi
    setInterval(updateNotificationBellStatus, 30000);
});

function updateNotificationBellStatus() {
    fetch('/api/get-notification-status.php')
        .then(response => response.json())
        .then(data => {
            const bellIcon = document.querySelector('.notification-settings');
            
            if (data.any_enabled) {
                // Ako je barem jedna notifikacija uključena
                bellIcon.classList.add('notifications-enabled');
                bellIcon.classList.remove('notifications-disabled');
                bellIcon.setAttribute('data-status', 'enabled');
                bellIcon.title = 'Notifications are enabled - Click to manage';
            } else {
                // Ako su sve notifikacije isključene
                bellIcon.classList.remove('notifications-enabled');
                bellIcon.classList.add('notifications-disabled');
                bellIcon.setAttribute('data-status', 'disabled');
                bellIcon.title = 'Notifications are disabled - Click to enable';
            }
        })
        .catch(error => console.log('Error checking notification status:', error));
}

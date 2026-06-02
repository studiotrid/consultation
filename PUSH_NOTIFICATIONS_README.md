# Push Notifikacije - Brzo Uputstvo

## ✅ Šta je implementirano

Push notifikacije su potpuno integrisane u consultation sistem. Korisnici će automatski biti pitani da prihvate notifikacije nakon što se uloguju.

## 📋 Fajlovi

- ✅ `inc/conf/vapid.php` - VAPID ključevi
- ✅ `inc/ajax/get_vapid_key.php` - API za dobijanje public key-a
- ✅ `inc/ajax/save_push_subscription.php` - API za čuvanje subscription-a
- ✅ `inc/ajax/send_push_notification.php` - API za slanje notifikacija
- ✅ `inc/class/PushNotificationHelper.php` - Helper klasa
- ✅ `inc/js/push-notifications.js` - Frontend logika
- ✅ `service-worker.js` - Service Worker sa push event-om
- ✅ `templates/layout.tpl` - Ažuriran za logged-in klasu
- ✅ `test-push.php` - Test stranica
- ✅ `PUSH_NOTIFICATIONS.md` - Detaljna dokumentacija

## 🚀 Kako Testirati

1. **Uloguj se** na sistem
2. **Otvori** [test-push.php](test-push.php)
3. **Proveri status** - trebalo bi da vidiš:
   - ✓ Service Worker registrovan
   - ✓ Subscription postoji (ili dugme za dozvolu)
4. **Klikni** "Pošalji Test Notifikaciju"
5. **Proveri** da li se notifikacija pojavljuje

## 💻 Kako Koristiti u Kodu

```php
<?php
require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Pošalji notifikaciju korisniku
$pushHelper->notifyUser(
    $userId,                    // ID korisnika
    'message',                  // tip notifikacije
    'Nova poruka',             // naslov
    'Imate novu poruku od...',  // tekst
    '/img/karte/icon-192.png'   // ikona
);
?>
```

## 🍎 Mac Uređaji (Safari)

Safari na Mac-u ima problema sa Web Push notifikacijama:
- **Safari < 16.4**: Ne podržava Web Push
- **Safari >= 16.4**: Podržava Web Push ali sa ograničenjima

### Rešenje:
Sistem automatski detektuje Mac uređaje i prikazuje odgovarajuću poruku. Push će raditi na:
- ✅ Chrome na Mac-u
- ✅ Firefox na Mac-u
- ✅ Safari 16.4+ na Mac-u (sa manjim ograničenjima)
- ✅ Svi browseri na Android-u
- ✅ Svi browseri na Windows-u
- ✅ Svi browseri na Linux-u

## 🗃️ Baza Podataka

Tabela `push_subscriptions` se automatski kreira pri prvom pokušaju čuvanja subscription-a.

Možete i ručno kreirati:

```sql
CREATE TABLE IF NOT EXISTS `push_subscriptions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT DEFAULT NULL,
    `coach_id` INT DEFAULT NULL,
    `endpoint` TEXT NOT NULL,
    `auth_key` VARCHAR(255),
    `p256dh_key` TEXT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `last_updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_endpoint` (`endpoint`(255)),
    KEY `user_id` (`user_id`),
    KEY `coach_id` (`coach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

## 🔍 Provera

### U browseru (DevTools):
1. **Application** > **Service Workers** → trebao bi biti registrovan
2. **Application** > **Manifest** → proveri ikone
3. **Console** → traži `[Push]` poruke

### Na serveru:
```bash
# Proveri error log
tail -f /path/to/error.log

# Test VAPID key
curl https://consultation.profesionalnaastrologija.com/inc/ajax/get_vapid_key.php
```

## 📚 Više Informacija

Detaljno uputstvo: [PUSH_NOTIFICATIONS.md](PUSH_NOTIFICATIONS.md)

## ⚠️ Napomene

- Push notifikacije rade **samo preko HTTPS**
- Korisnik mora **odobriti** dozvolu
- Aplikacija **automatski** traži dozvolu nakon login-a
- Subscription se **osvežava** svakih 60 sekundi

---

**Implementirano:** 29. Januar 2026  
**Status:** ✅ Potpuno funkcionalno

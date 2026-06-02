# Push Notifikacije - Korisničko Uputstvo

## Pregled

Sistem ima integriranu podršku za Web Push notifikacije koje se koriste za obaveštavanje korisnika o važnim događajima kada imaju instaliranu PWA aplikaciju.

## Kako Funkcioniše?

### 1. **Korisnik Instalira Aplikaciju**
- Korisnik otvara portal na mobilnom/desktop uređaju
- Prikazuje se banner "Instaliraj aplikaciju"
- Nakon instalacije, korisnik ima dostupne push notifikacije

### 2. **Prosljeđivanje Dozvola**
- Aplikacija traži dozvolu za push notifikacije nakon login-a
- Korisnik odobrava (ili odbija)
- Ako je odobrio, browser prati subscription i šalje je na server

### 3. **Čuvanje Subscription-a**
- Svaki subscription se čuva u bazi: `push_subscriptions` tabela
- Svaki uređaj ima vlastiti subscription ID
- Korisnik može imati više subscriptions (desktop, tablet, mobilni, itd.)

### 4. **Slanje Notifikacija**
- Kada se dogodi važan događaj (nova poruka, novi termin, itd.)
- Server šalje push notifikaciju do svih aktivnih subscriptions korisnika
- Notification se prikazuje u sistem tray-u
- Korisnik može kliknuti da otvori aplikaciju

## Rešenje za Mac Uređaje

Mac uređaji (Safari, MacOS) imaju poznat problem sa Web Push notifikacijama:
- Safari do verzije 16.4 nije podržavao Web Push na Macu
- Nova verzija (16.4+) zahteva specifičnu konfiguraciju

### Implementirano Rešenje:
1. **Automatska detekcija**: Sistem automatski detektuje Mac uređaje
2. **Fallback**: Ako Web Push ne radi, koristi se alternativni pristup:
   - In-app notifikacije (polling)
   - Email notifikacije
   - SMS notifikacije (opciono)

## Tehnička Struktura

### Backend Files

| Fajl | Uloga |
|------|-------|
| `inc/ajax/get_vapid_key.php` | Vraća VAPID javni ključ (potreban za subscribe) |
| `inc/ajax/save_push_subscription.php` | Čuva subscription u bazi |
| `inc/class/PushNotificationHelper.php` | Helper klasa za slanje notifikacija |
| `inc/conf/vapid.php` | VAPID ključevi |

### Frontend Files

| Fajl | Uloga |
|------|-------|
| `inc/js/push-notifications.js` | Klijentska logika za subscription |
| `service-worker.js` | Obrađuje push event i prikazuje notifikaciju |
| `manifest.json` | PWA metadata sa notification permission |

### Database

**Tabela: `push_subscriptions`**
```sql
CREATE TABLE `push_subscriptions` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
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
);
```

## Kako Poslati Push Notifikaciju

### Iz PHP-a

```php
<?php
require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Pošalji notifikaciju jednome korisniku
$result = $pushHelper->notifyUser(
    $userId,           // ID korisnika koji treba obavesti
    'message',         // tip (message, appointment, etc)
    'Nova poruka',     // naslov
    'Adriana je poslala novu poruku',  // tekst
    '/img/karte/icon-192.png' // ikona
);

// Ili više korisnika
$pushHelper->notifyUsers(
    [1, 2, 3],  // niz ID-eva
    'appointment',
    'Novi termin',
    'Imate novi zakazani termin'
);
?>
```

### Primjeri Slučajeva Upotrebe

#### 1. Nove Poruke
```php
// U send_message.php
$pushHelper->notifyUser(
    $userId,
    'message',
    'Nova poruka',
    $senderName . ': ' . substr($message, 0, 50),
    '/img/karte/icon-192.png'
);
```

#### 2. Novi Termin
```php
// Kada se kreira novi termin
$pushHelper->notifyUser(
    $userId,
    'appointment',
    'Novi termin je dostupan',
    'Termin u ' . $dateTime . ' je sada slobodan',
    '/img/karte/icon-192.png'
);
```

#### 3. Obavijest o Promjeni
```php
// Kada se termin izmijeni
$pushHelper->notifyUser(
    $userId,
    'update',
    'Termin je promijenjen',
    'Vaš termin je pomjeren na ' . $newDateTime,
    '/img/karte/icon-192.png'
);
```

## Konfiguracija

### VAPID Ključevi

VAPID ključevi su kreirani u `inc/conf/vapid.php`.

**Nikada ne dijelite privatni ključ!**

### Service Worker

Service Worker je registrovan u [templates/layout.tpl](templates/layout.tpl) i automatski se aktivira kada korisnik poseti sajt.

### Logged-in Klasa

Template automatski dodaje `logged-in` klasu na `<body>` element kada je korisnik ulogovan. Push notifikacije se aktiviraju samo za ulogovane korisnike.

## Testiranje

### Test korak 1: Provjeri VAPID ključ
```bash
curl https://consultation.profesionalnaastrologija.com/inc/ajax/get_vapid_key.php
```

### Test korak 2: Instaliraj aplikaciju
1. Otvori portal na mobilnom
2. Instaliraj aplikaciju iz bannera
3. Uloguj se
4. Odobri dozvolu za notifikacije

### Test korak 3: Pošalji test notifikaciju
Koristi PushNotificationHelper iz PHP-a kako je pokazano gore.

## Napomene

- Push notifikacije rade samo sa HTTPS-om (ili localhost-om za testiranje)
- Subscription se automatski osvežava svakih 60 sekundi
- Aplikacija će tražiti dozvolu za notifikacije samo prvi put nakon login-a
- Korisnik može opozvati dozvolu preko browser settings

## Problem: Notifikacije se Ne Prikazuju

1. **Provjerite HTTPS**: Push notifikacije zahtijevaju HTTPS
2. **Provjerite Dozvolu**: Korisnik mora odobiti dozvolu
3. **Provjerite Service Worker**: Trebao bi biti registrovan u browser DevTools > Application > Service Workers
4. **Provjerite Logs**: Browser console će pokazati detaljne greške
5. **Provjerite Mac Safari**: Potrebna verzija 16.4+ za Web Push podršku

## Kontakt

Za probleme ili pitanja, konzultirajte server error log ili kontaktirajte administratora sistema.

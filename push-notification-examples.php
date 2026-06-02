<?php
/**
 * PRIMER IMPLEMENTACIJE PUSH NOTIFIKACIJA
 * 
 * Ovaj fajl pokazuje kako implementirati push notifikacije u različitim scenarijima
 */

// ============================================================================
// SCENARIO 1: Slanje poruke korisniku
// ============================================================================

// U fajlu gde se šalju poruke korisnicima (npr. send_message.php)
require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Nakon što se poruka uspešno pošalje...
if ($messageSuccess) {
    $pushHelper->notifyUser(
        $recipientUserId,
        'message',
        'Nova poruka',
        $senderName . ' vam je poslao poruku',
        '/img/karte/icon-192.png'
    );
}

// ============================================================================
// SCENARIO 2: Obaveštenje o novom terminu
// ============================================================================

// U fajlu gde se kreiraju termini (npr. create_appointment.php)
require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Nakon što se termin kreira...
if ($appointmentCreated) {
    $pushHelper->notifyUser(
        $userId,
        'appointment',
        'Novi termin',
        'Zakazan je termin za ' . $appointmentDate,
        '/img/karte/icon-192.png'
    );
}

// ============================================================================
// SCENARIO 3: Obaveštenje o promeni
// ============================================================================

// U fajlu gde se menjaju termini (npr. update_appointment.php)
require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Nakon što se termin izmeni...
if ($appointmentUpdated) {
    $pushHelper->notifyUser(
        $userId,
        'update',
        'Termin je promenjen',
        'Vaš termin je pomeren na ' . $newDate,
        '/img/karte/icon-192.png'
    );
}

// ============================================================================
// SCENARIO 4: Obaveštenje više korisnika
// ============================================================================

// U fajlu gde se šalju obaveštenja svim korisnicima (npr. broadcast.php)
require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Lista korisnika
$userIds = [1, 2, 3, 4, 5];

$totalSent = $pushHelper->notifyUsers(
    $userIds,
    'announcement',
    'Nova najava',
    'Novi sadržaj je dostupan',
    '/img/karte/icon-192.png'
);

echo "Poslato $totalSent notifikacija";

// ============================================================================
// SCENARIO 5: Obaveštenje coach-u
// ============================================================================

// U fajlu gde korisnik šalje poruku coach-u
require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Nakon što korisnik pošalje poruku...
if ($messageSent) {
    // Pretpostavka: $coachId je ID coach-a u sesiji ili bazi
    $pushHelper->notifyUser(
        $coachId,
        'message',
        'Nova poruka od korisnika',
        $userName . ': ' . substr($messageText, 0, 50),
        '/img/karte/icon-192.png',
        true  // isCoach = true
    );
}

// ============================================================================
// SCENARIO 6: Obaveštenje sa custom ikonom
// ============================================================================

require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Koristite specifičnu ikonu za različite tipove notifikacija
$pushHelper->notifyUser(
    $userId,
    'achievement',
    'Čestitamo!',
    'Ostvarili ste novi nivo',
    '/img/achievement-icon.png'  // custom ikona
);

// ============================================================================
// SCENARIO 7: Provera uspešnosti slanja
// ============================================================================

require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

$result = $pushHelper->notifyUser(
    $userId,
    'message',
    'Test',
    'Test notifikacija',
    '/img/karte/icon-192.png'
);

if ($result['success']) {
    error_log("Push notification sent successfully: " . $result['sent'] . " sent, " . $result['failed'] . " failed");
} else {
    error_log("Push notification failed: " . $result['error']);
}

// ============================================================================
// SCENARIO 8: Slanje notifikacije u toku transakcije
// ============================================================================

require_once 'inc/class/PushNotificationHelper.php';

$pushHelper = new PushNotificationHelper($db);

// Započni transakciju
$db->query("START TRANSACTION");

try {
    // Kreiraj zapis u bazi
    $db->query("INSERT INTO appointments (user_id, date) VALUES ($userId, '$date')");
    
    // Ako je sve OK, pošalji notifikaciju
    $pushHelper->notifyUser(
        $userId,
        'appointment',
        'Termin kreiran',
        'Vaš termin je uspešno zakazan',
        '/img/karte/icon-192.png'
    );
    
    // Commit transakcije
    $db->query("COMMIT");
} catch (Exception $e) {
    // Rollback ako nešto pođe po zlu
    $db->query("ROLLBACK");
    error_log("Transaction failed: " . $e->getMessage());
}

// ============================================================================
// TIPOVI NOTIFIKACIJA
// ============================================================================

/*
Tipovi notifikacija koje možete koristiti:
- 'message'      : Nova poruka
- 'appointment'  : Novi termin
- 'update'       : Promena termina
- 'announcement' : Najava
- 'reminder'     : Podsetnik
- 'achievement'  : Dostignuće
- 'alert'        : Upozorenje
- 'test'         : Test notifikacija
*/

?>

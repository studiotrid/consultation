<?php
require_once '../includes.php';

header('Content-Type: application/json');

// Proveravamo da li je korisnik ulogovan
if (!$login->isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['logged'];

// Prvo proveravamo da li kolone postoje
$checkPush = $db->query_first("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'korisnici' AND COLUMN_NAME = 'push_notifications' AND TABLE_SCHEMA = DATABASE()");

if (!$checkPush) {
    // Kolone ne postoje, dodajemo ih
    @$db->query("ALTER TABLE korisnici ADD COLUMN push_notifications TINYINT(1) DEFAULT 0");
    @$db->query("ALTER TABLE korisnici ADD COLUMN email_notifications TINYINT(1) DEFAULT 0");
}

// Učitaj trenutne postavke
$userSettings = $db->query_first("SELECT push_notifications, email_notifications FROM korisnici WHERE id = '{$userId}'");

if ($userSettings) {
    // Ako je barem jedna notifikacija uključena
    $hasNotificationsEnabled = ($userSettings['push_notifications'] == 1 || $userSettings['email_notifications'] == 1);
    
    echo json_encode([
        'push_notifications' => (int)$userSettings['push_notifications'],
        'email_notifications' => (int)$userSettings['email_notifications'],
        'any_enabled' => $hasNotificationsEnabled,
        'status' => 'success'
    ]);
} else {
    echo json_encode([
        'push_notifications' => 0,
        'email_notifications' => 0,
        'any_enabled' => false,
        'status' => 'success'
    ]);
}

$db->close();
?>

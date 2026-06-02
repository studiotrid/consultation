<?php
require_once 'includes.php';

$logFile = __DIR__ . '/notification-settings.log';
file_put_contents($logFile, "\n=== " . date('Y-m-d H:i:s') . " ===\n", FILE_APPEND);

// Proveravamo da li je korisnik ulogovan
if (!$login->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$userId = $_SESSION['logged'];

// Obrada POST zahteva za sačuvavanje postavki
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents($logFile, "POST received\n", FILE_APPEND);
    $pushEnabled = isset($_POST['push_notifications']) ? 1 : 0;
    $emailEnabled = isset($_POST['email_notifications']) ? 1 : 0;
    file_put_contents($logFile, "pushEnabled: {$pushEnabled}, emailEnabled: {$emailEnabled}\n", FILE_APPEND);
    
    // Prvo proveravamo da li kolone postoje, ako ne dodajemo ih
    $checkPush = $db->query_first("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'korisnici' AND COLUMN_NAME = 'push_notifications' AND TABLE_SCHEMA = DATABASE()");
    
    if (!$checkPush) {
        // Kolone ne postoje, dodajemo ih
        @$db->query("ALTER TABLE korisnici ADD COLUMN push_notifications TINYINT(1) DEFAULT 0");
        @$db->query("ALTER TABLE korisnici ADD COLUMN email_notifications TINYINT(1) DEFAULT 0");
    }
    
    // Sačuvaj postavke u bazu podataka
    $updateQuery = "UPDATE korisnici SET 
                    push_notifications = '{$pushEnabled}',
                    email_notifications = '{$emailEnabled}'
                    WHERE id = '{$userId}'";
    
    $updateResult = $db->query($updateQuery);
    file_put_contents($logFile, "Update result: " . ($updateResult ? 'success' : 'false/0') . "\n", FILE_APPEND);
    if ($updateResult === false || $updateResult == 0) {
        file_put_contents($logFile, "Update failed. DB Error: " . (isset($db->error) ? $db->error : 'Unknown') . "\n", FILE_APPEND);
    }

    if ($updateResult) {
        // Provera push_subscriptions tabele
        $userSubscription = $db->query_first("SELECT id FROM push_subscriptions WHERE user_id = '{$userId}' LIMIT 1");
        
        if ($pushEnabled == 1 && !$userSubscription) {
            // Korisnik je uključio push, a nema subscription
            // Prikaži poruku da registruje push
            $smarty->assign('push_action_needed', true);
            $smarty->assign('status', 'success');
            $smarty->assign('message', _('Settings saved. Please enable push notifications in the prompt.'));
        } else if ($pushEnabled == 0 && $userSubscription) {
            // Korisnik je isključio push, briši subscription
            $db->query("DELETE FROM push_subscriptions WHERE user_id = '{$userId}'");
            $smarty->assign('status', 'success');
            $smarty->assign('message', _('Notification settings saved and push notifications disabled'));
        } else {
            $smarty->assign('status', 'success');
            $smarty->assign('message', _('Notification settings saved successfully'));
        }
    } else {
        $smarty->assign('status', 'error');
        $smarty->assign('message', _('Error saving notification settings'));
    }
}

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
    $smarty->assign('pushEnabled', $userSettings['push_notifications']);
    $smarty->assign('emailEnabled', $userSettings['email_notifications']);
} else {
    // Ako nema postavki, postavi default vrednosti
    $smarty->assign('pushEnabled', 0);
    $smarty->assign('emailEnabled', 0);
}

// Provera da li korisnik ima subscription u bazi
$userSubscription = $db->query_first("SELECT id FROM push_subscriptions WHERE user_id = '{$userId}' LIMIT 1");
$smarty->assign('hasSubscription', ($userSubscription && isset($userSubscription['id'])) ? true : false);

$smarty->assign('logged', true);
$smarty->assign('language', $login->getCoachLang());

// Dodaj klasu u body ako ima subscription
if ($userSubscription && isset($userSubscription['id'])) {
    $smarty->assign('bodyClass', 'has-subscription');
}

// Show confirmation after push subscription is saved via JS redirect
if (isset($_GET['push']) && $_GET['push'] == '1') {
    $smarty->assign('status', 'success');
    $smarty->assign('message', _('Push notifications enabled successfully'));
}

$smarty->assign("content", $smarty->fetch('notification-settings.tpl'));

// Osiguraj da se stranica ne cache-a
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0', true);
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache', true);
header('Expires: 0', true);

$smarty->display('layout.tpl');

$db->close();
?>

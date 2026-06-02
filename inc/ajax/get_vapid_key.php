<?php
// Mora biti prvi redak - LOG SVE
$logFile = __DIR__ . '/get_vapid_key.log';
file_put_contents($logFile, "\n=== " . date('Y-m-d H:i:s') . " ===\n", FILE_APPEND);

error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 0);

// Content-Type mora biti prvi header
header('Content-Type: application/json');

file_put_contents($logFile, "Starting get_vapid_key.php\n", FILE_APPEND);

try {
    // Koristi apsolutnu putanju
    $includesFile = __DIR__ . '/../../includes.php';
    file_put_contents($logFile, "Looking for: " . $includesFile . "\n", FILE_APPEND);
    file_put_contents($logFile, "File exists: " . (file_exists($includesFile) ? 'YES' : 'NO') . "\n", FILE_APPEND);
    
    if (!file_exists($includesFile)) {
        http_response_code(500);
        echo json_encode(['error' => 'Includes file not found']);
        file_put_contents($logFile, "Includes file not found!\n", FILE_APPEND);
        exit;
    }
    
    require_once $includesFile;
    file_put_contents($logFile, "Includes loaded\n", FILE_APPEND);
    
    // Check if user is logged in
    $isLogged = $login->isLoggedIn();
    file_put_contents($logFile, "isLoggedIn: " . ($isLogged ? 'YES' : 'NO') . "\n", FILE_APPEND);
    
    if (!$isLogged) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        file_put_contents($logFile, "User not logged in\n", FILE_APPEND);
        exit;
    }
    
    // Load VAPID config
    $vapidFile = __DIR__ . '/../conf/vapid.php';
    file_put_contents($logFile, "Looking for VAPID: " . $vapidFile . "\n", FILE_APPEND);
    
    if (!file_exists($vapidFile)) {
        http_response_code(404);
        echo json_encode(['error' => 'VAPID config not found']);
        exit;
    }
    
    require_once $vapidFile;
    file_put_contents($logFile, "VAPID loaded\n", FILE_APPEND);
    
    if (!isset($VAPID['vapidPublicKey']) || empty($VAPID['vapidPublicKey'])) {
        http_response_code(500);
        echo json_encode(['error' => 'VAPID key not configured']);
        exit;
    }
    
    file_put_contents($logFile, "Returning VAPID key success\n", FILE_APPEND);
    
    echo json_encode([
        'publicKey' => $VAPID['vapidPublicKey'],
        'success' => true
    ]);
    
} catch (Exception $e) {
    file_put_contents($logFile, "Exception: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

file_put_contents($logFile, "Done\n", FILE_APPEND);
?>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// Loguj sve u fajl
$logFile = __DIR__ . '/../../../push_debug.log';
error_log("=== DEBUG: get_vapid_key.php started at " . date('Y-m-d H:i:s') . " ===", 3, $logFile);
error_log("Request: " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'], 3, $logFile);

header('Content-Type: application/json');

try {
    error_log("Attempting to require includes.php", 3, $logFile);
    
    $includesFile = __DIR__ . '/../../includes.php';
    error_log("Includes file path: " . $includesFile, 3, $logFile);
    error_log("File exists: " . (file_exists($includesFile) ? 'YES' : 'NO'), 3, $logFile);
    
    if (!file_exists($includesFile)) {
        http_response_code(500);
        echo json_encode(['error' => 'Includes file not found']);
        exit;
    }
    
    require_once $includesFile;
    error_log("Includes loaded successfully", 3, $logFile);
    
    // Check if user is logged in
    $isLogged = $login->isLoggedIn();
    error_log("Login check result: " . ($isLogged ? 'LOGGED IN' : 'NOT LOGGED IN'), 3, $logFile);
    
    if (!$isLogged) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized', 'session' => $_SESSION]);
        error_log("User not logged in, returning 401", 3, $logFile);
        exit;
    }
    
    // Load VAPID config
    $vapidFile = __DIR__ . '/../conf/vapid.php';
    error_log("VAPID file path: " . $vapidFile, 3, $logFile);
    error_log("VAPID file exists: " . (file_exists($vapidFile) ? 'YES' : 'NO'), 3, $logFile);
    
    if (!file_exists($vapidFile)) {
        http_response_code(404);
        echo json_encode(['error' => 'VAPID config not found']);
        exit;
    }
    
    require_once $vapidFile;
    error_log("VAPID loaded successfully", 3, $logFile);
    
    if (!isset($VAPID['vapidPublicKey']) || empty($VAPID['vapidPublicKey'])) {
        http_response_code(500);
        echo json_encode(['error' => 'VAPID key not configured']);
        exit;
    }
    
    error_log("VAPID key found, returning success", 3, $logFile);
    
    echo json_encode([
        'publicKey' => $VAPID['vapidPublicKey'],
        'success' => true
    ]);
    
} catch (Exception $e) {
    error_log("Exception caught: " . $e->getMessage(), 3, $logFile);
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

error_log("=== DEBUG: get_vapid_key.php ended ===", 3, $logFile);
?>

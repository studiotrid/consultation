<?php
// Log file za debug
$logFile = __DIR__ . '/save_push_subscription.log';
file_put_contents($logFile, "\n=== " . date('Y-m-d H:i:s') . " ===\n", FILE_APPEND);

error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 0);

// Content-Type mora biti prvi header
header('Content-Type: application/json');

file_put_contents($logFile, "Starting save_push_subscription.php\n", FILE_APPEND);

try {
    // Koristi apsolutnu putanju
    $includesFile = __DIR__ . '/../../includes.php';
    file_put_contents($logFile, "Loading includes from: " . $includesFile . "\n", FILE_APPEND);
    
    if (!file_exists($includesFile)) {
        http_response_code(500);
        echo json_encode(['error' => 'Includes file not found']);
        exit;
    }
    
    require_once $includesFile;
    file_put_contents($logFile, "Includes loaded\n", FILE_APPEND);
    
    // Check if user is logged in
    $isLogged = $login->isLoggedIn();
    file_put_contents($logFile, "isLoggedIn: " . ($isLogged ? 'YES' : 'NO') . "\n", FILE_APPEND);
    
    if (!$isLogged) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Unauthorized']);
        exit;
    }
    
    global $db;
    $createTableSQL = "CREATE TABLE IF NOT EXISTS `push_subscriptions` (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    
    try {
        $db->query($createTableSQL);
        file_put_contents($logFile, "Table created/checked\n", FILE_APPEND);
    } catch (Exception $e) {
        file_put_contents($logFile, "Table creation error: " . $e->getMessage() . "\n", FILE_APPEND);
    }
    
    // Get user ID from session
    $userId = isset($_SESSION['logged']) ? (int)$_SESSION['logged'] : null;
    $coachId = isset($_SESSION['coach']) ? (int)$_SESSION['coach'] : null;
    
    file_put_contents($logFile, "userId: " . ($userId ? $userId : 'NULL') . ", coachId: " . ($coachId ? $coachId : 'NULL') . "\n", FILE_APPEND);
    
    if (!$userId && !$coachId) {
        file_put_contents($logFile, "No user or coach ID found\n", FILE_APPEND);
        echo json_encode(['success' => false, 'error' => 'User ID not found in session']);

        exit;
    }
    
    // Get subscription data from request
    $rawData = file_get_contents('php://input');
    file_put_contents($logFile, "Raw data length: " . strlen($rawData) . "\n", FILE_APPEND);
    
    $data = json_decode($rawData, true);
    file_put_contents($logFile, "Parsed data: " . json_encode($data) . "\n", FILE_APPEND);
    
    if (!$data || !isset($data['endpoint'])) {
        file_put_contents($logFile, "Invalid subscription data\n", FILE_APPEND);
        echo json_encode(['success' => false, 'error' => 'Invalid subscription data']);
        exit;
    }
    
    $endpoint = $data['endpoint'];
    $authKey = isset($data['keys']['auth']) ? $data['keys']['auth'] : null;
    $p256dhKey = isset($data['keys']['p256dh']) ? $data['keys']['p256dh'] : null;
    
    file_put_contents($logFile, "Endpoint: " . substr($endpoint, 0, 50) . "...\n", FILE_APPEND);
    
    // Check if subscription already exists
    $existingSQL = "SELECT id FROM push_subscriptions WHERE endpoint = '" . $db->escape($endpoint) . "'";
    
    try {
        $existing = $db->query_first($existingSQL);
        file_put_contents($logFile, "Existing check: " . ($existing ? 'YES' : 'NO') . "\n", FILE_APPEND);
    } catch (Exception $e) {
        // Table might not exist yet, ignore
        file_put_contents($logFile, "Existing check exception: " . $e->getMessage() . "\n", FILE_APPEND);
        $existing = null;
    }
    
    if ($existing) {
        // Update existing subscription
        file_put_contents($logFile, "Updating existing subscription\n", FILE_APPEND);
        $updateSQL = "UPDATE push_subscriptions 
                      SET user_id = " . ($userId !== null ? "'$userId'" : 'NULL') . ",
                          coach_id = " . ($coachId !== null ? "'$coachId'" : 'NULL') . ",
                          auth_key = '" . ($authKey ? $db->escape($authKey) : '') . "',
                          p256dh_key = '" . ($p256dhKey ? $db->escape($p256dhKey) : '') . "',
                          last_updated = NOW()
                      WHERE endpoint = '" . $db->escape($endpoint) . "'";
        
        file_put_contents($logFile, "Update SQL: " . substr($updateSQL, 0, 100) . "...\n", FILE_APPEND);
        
        $result = $db->query($updateSQL);
        file_put_contents($logFile, "Update query result: " . ($result ? 'success' : 'false/0') . "\n", FILE_APPEND);
        
        if ($result === false || $result == 0) {
            file_put_contents($logFile, "Update failed. DB Error: " . (isset($db->error) ? $db->error : 'Unknown') . "\n", FILE_APPEND);
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Failed to update subscription']);
        } else {
            http_response_code(200);
            file_put_contents($logFile, "Subscription updated successfully\n", FILE_APPEND);
            echo json_encode(['success' => true, 'message' => 'Subscription updated']);
        }
    } else {
        // Insert new subscription
        file_put_contents($logFile, "Inserting new subscription\n", FILE_APPEND);
        // Insert new subscription
        $insertSQL = "INSERT INTO push_subscriptions (user_id, coach_id, endpoint, auth_key, p256dh_key)
                  VALUES (
                      " . ($userId !== null ? "'$userId'" : 'NULL') . ",
                      " . ($coachId !== null ? "'$coachId'" : 'NULL') . ",
                      '" . $db->escape($endpoint) . "',
                      '" . ($authKey ? $db->escape($authKey) : '') . "',
                      '" . ($p256dhKey ? $db->escape($p256dhKey) : '') . "')";
        
        file_put_contents($logFile, "SQL: " . substr($insertSQL, 0, 100) . "...\n", FILE_APPEND);
        
        $result = $db->query($insertSQL);
        file_put_contents($logFile, "Query result: " . ($result ? 'success' : 'false/0') . "\n", FILE_APPEND);
        
        if ($result === false || $result == 0) {
            file_put_contents($logFile, "Insert failed. DB Error: " . (isset($db->error) ? $db->error : 'Unknown') . "\n", FILE_APPEND);
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Failed to save subscription']);
        } else {
            http_response_code(201);
            file_put_contents($logFile, "Subscription inserted successfully\n", FILE_APPEND);
            echo json_encode(['success' => true, 'message' => 'Subscription saved']);
        }
    }
    
} catch (Exception $e) {
    file_put_contents($logFile, "Main exception: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}

file_put_contents($logFile, "Done\n", FILE_APPEND);
?>

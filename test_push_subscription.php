<?php
// Test script to simulate push subscription save
include_once 'includes.php';

// Check login
if (!$login->isLoggedIn()) {
    echo "User not logged in";
    exit;
}

// Get user data
$userId = $_SESSION['usernameId'] ?? null;
$coachId = $_SESSION['coach'] ?? 1;

echo "UserId: $userId, CoachId: $coachId\n";

// Create test subscription data
$subscription = [
    'endpoint' => 'https://fcm.googleapis.com/fcm/send/test_endpoint_' . time(),
    'keys' => [
        'auth' => 'test_auth_key_' . time(),
        'p256dh' => 'test_p256dh_key_' . time()
    ]
];

echo "Subscription: " . json_encode($subscription) . "\n";

// Simulate what save_push_subscription.php does
$endpoint = $subscription['endpoint'];
$authKey = $subscription['keys']['auth'] ?? null;
$p256dhKey = $subscription['keys']['p256dh'] ?? null;

// Check if subscription already exists
$query = "SELECT id FROM push_subscriptions WHERE endpoint = '" . $db->real_escape_string($endpoint) . "'";
echo "Check query: " . $query . "\n";

try {
    $existing = $db->query_first($query);
    echo "Existing: " . json_encode($existing) . "\n";
    
    if ($existing) {
        // Update
        echo "Would update...\n";
    } else {
        // Insert
        $insertSQL = "INSERT INTO push_subscriptions (user_id, coach_id, endpoint, auth_key, p256dh_key)
                      VALUES (
                          " . ($userId !== null ? "'$userId'" : 'NULL') . ",
                          " . ($coachId !== null ? "'$coachId'" : 'NULL') . ",
                          '" . $db->real_escape_string($endpoint) . "',
                          '" . ($authKey ? $db->real_escape_string($authKey) : '') . "',
                          '" . ($p256dhKey ? $db->real_escape_string($p256dhKey) : '') . "')";
        
        echo "Insert SQL: " . $insertSQL . "\n";
        
        $result = $db->query($insertSQL);
        echo "Query result: " . ($result ? 'success' : 'false/0') . "\n";
        echo "Result value: " . var_export($result, true) . "\n";
        
        if ($result === false || $result == 0) {
            echo "DB Error: " . (isset($db->error) ? $db->error : 'Unknown') . "\n";
        } else {
            echo "Subscription inserted successfully!\n";
        }
    }
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
?>

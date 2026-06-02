<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

require_once '../../includes.php';
require_once '../../inc/conf/vapid.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

header('Content-Type: application/json');

try {
    global $db;
    
    // Get message type and recipient from POST
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['type']) || (!isset($data['user_id']) && !isset($data['coach_id']))) {
        echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
        exit;
    }
    
    $type = $data['type'];
    $recipientUserId = isset($data['user_id']) ? (int)$data['user_id'] : null;
    $recipientCoachId = isset($data['coach_id']) ? (int)$data['coach_id'] : null;
    $title = isset($data['title']) ? $data['title'] : 'Konsultacije';
    $body = isset($data['body']) ? $data['body'] : 'Imate novu poruku';
    $icon = isset($data['icon']) ? $data['icon'] : '/img/karte/icon-192.png';
    
    // Get subscriptions for user or coach
    if ($recipientCoachId !== null) {
        $sql = "SELECT id, endpoint, auth_key, p256dh_key FROM push_subscriptions WHERE coach_id = '$recipientCoachId'";
    } else {
        $sql = "SELECT id, endpoint, auth_key, p256dh_key FROM push_subscriptions WHERE user_id = '$recipientUserId'";
    }
    
    $subscriptions = null;
    try {
        $subscriptions = $db->fetch_array($sql);
    } catch (Exception $e) {
        error_log('Failed to fetch subscriptions: ' . $e->getMessage());
    }
    
    if (!$subscriptions || empty($subscriptions)) {
        echo json_encode(['success' => true, 'message' => 'No subscriptions found']);
        exit;
    }
    
    // Initialize WebPush
    $auth = [
        'VAPID' => [
            'subject' => $VAPID['vapidSubject'],
            'publicKey' => $VAPID['vapidPublicKey'],
            'privateKey' => $VAPID['vapidPrivateKey']
        ]
    ];
    
    $webPush = new WebPush($auth);
    
    // Prepare notification payload
    $payload = [
        'title' => $title,
        'body' => $body,
        'icon' => $icon,
        'badge' => '/img/karte/icon-192.png',
        'tag' => 'consultation-' . $type,
        'type' => $type
    ];
    
    $successCount = 0;
    $failedCount = 0;
    $failedSubscriptions = [];
    
    // Send to each subscription
    foreach ($subscriptions as $sub) {
        try {
            $subscription = Subscription::create([
                'endpoint' => $sub['endpoint'],
                'keys' => [
                    'auth' => $sub['auth_key'],
                    'p256dh' => $sub['p256dh_key']
                ]
            ]);
            
            $webPush->queueNotification(
                $subscription,
                json_encode($payload)
            );
            
            $successCount++;
        } catch (Exception $e) {
            error_log('Failed to queue notification for subscription ' . $sub['id'] . ': ' . $e->getMessage());
            $failedSubscriptions[] = $sub['id'];
            $failedCount++;
        }
    }
    
    // Flush all queued notifications
    try {
        foreach ($webPush->flush() as $report) {
            error_log('Push report: endpoint=' . $report->getRequest()->getUri() . ' | success=' . ($report->isSuccess() ? 'yes' : 'no') . ' | reason=' . $report->getReason());
        }
    } catch (Exception $e) {
        error_log('WebPush flush error: ' . $e->getMessage());
    }
    
    // Clean up invalid subscriptions
    if (!empty($failedSubscriptions)) {
        $ids = implode(',', $failedSubscriptions);
        try {
            $db->query("DELETE FROM push_subscriptions WHERE id IN ($ids)");
        } catch (Exception $e) {
            error_log('Failed to clean up invalid subscriptions: ' . $e->getMessage());
        }
    }
    
    echo json_encode([
        'success' => true,
        'sent' => $successCount,
        'failed' => $failedCount
    ]);
    
} catch (Exception $e) {
    error_log('Error in send_push_notification.php: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>

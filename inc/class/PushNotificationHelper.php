<?php
/**
 * Push Notification Helper
 * Class to send push notifications to users
 */

class PushNotificationHelper {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    /**
     * Send notification to specific user
     * @param int $userId - ID of user to notify
     * @param string $type - Type of notification (message, appointment, etc)
     * @param string $title - Notification title
     * @param string $body - Notification body/message
     * @param string $icon - Icon URL
     * @param bool $isCoach - Is the recipient a coach
     * @return array - Status and message count
     */
    public function notifyUser($userId, $type = 'message', $title = 'Konsultacije', $body = 'Imate novu poruku', $icon = '/img/icon-192.png', $isCoach = false) {
        if (!$userId || !is_numeric($userId)) {
            return ['success' => false, 'error' => 'Invalid user ID'];
        }
        
        try {
            // Prepare notification payload
            $payload = [
                'type' => $type,
                'title' => $title,
                'body' => $body,
                'icon' => $icon
            ];
            
            // Use cURL to call send_push_notification.php
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/inc/ajax/send_push_notification.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    'type' => $type,
                    $isCoach ? 'coach_id' : 'user_id' => (int)$userId,
                    'title' => $title,
                    'body' => $body,
                    'icon' => $icon
                ]),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
                CURLOPT_TIMEOUT => 5
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode === 200) {
                $result = json_decode($response, true);
                return [
                    'success' => true,
                    'sent' => isset($result['sent']) ? $result['sent'] : 0,
                    'failed' => isset($result['failed']) ? $result['failed'] : 0
                ];
            } else {
                error_log('Push notification failed with HTTP code: ' . $httpCode);
                return ['success' => false, 'error' => 'HTTP ' . $httpCode];
            }
        } catch (Exception $e) {
            error_log('PushNotificationHelper error: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    /**
     * Notify multiple users
     * @param array $userIds - Array of user IDs
     * @param string $type - Type of notification
     * @param string $title - Notification title
     * @param string $body - Notification body
     * @return int - Total notifications sent
     */
    public function notifyUsers($userIds, $type = 'message', $title = 'Konsultacije', $body = 'Imate novu poruku') {
        if (!is_array($userIds) || empty($userIds)) {
            return 0;
        }
        
        $totalSent = 0;
        foreach ($userIds as $userId) {
            $result = $this->notifyUser($userId, $type, $title, $body);
            if ($result['success']) {
                $totalSent += isset($result['sent']) ? $result['sent'] : 1;
            }
        }
        
        return $totalSent;
    }
}
?>

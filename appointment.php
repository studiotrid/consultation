<?php
require_once 'includes.php';

header('Content-Type: application/json');

if (!$login->isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$userId = isset($_SESSION['logged']) ? intval($_SESSION['logged']) : 0;
$action = isset($_POST['action']) ? trim($_POST['action']) : '';
$tip = isset($_POST['tip']) ? intval($_POST['tip']) : 0;
$terminId = isset($_POST['termin']) ? intval($_POST['termin']) : 0;

if ($action === 'reserve') {
    // Reserve appointment
    if ($terminId <= 0 || $tip <= 0) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing appointment or consultation type']);
        exit;
    }
    
    // Get appointment details
    $appointment = $db->query_first("SELECT id, datum, coach FROM coach_termini WHERE id='".$terminId."' AND status=1");
    if (!$appointment) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Appointment not found or is no longer available']);
        exit;
    }
    
    // Verify user belongs to this coach
    $userCoach = $db->query_first("SELECT coach FROM korisnici WHERE id='".$userId."'");
    if (!$userCoach || $userCoach['coach'] != $appointment['coach']) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'Access denied']);
        exit;
    }
    
    // Create consultation entry
    $consultationData = [
        'user_id' => $userId,
        'user' => $userId,
        'tip' => $tip,
        'startTime' => $appointment['datum'],
        'endTime' => date('Y-m-d H:i:s', strtotime($appointment['datum'] . ' +1 hour')),
        'zauzet' => 1
    ];
    
    $consultationId = $db->insert('konsultacije', $consultationData);
    
    if (!$consultationId) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to create consultation']);
        exit;
    }
    
    // Update coach_termini to mark appointment as reserved and store user info
    $updateData = [
        'status' => 0,
        'user' => $userId,
        'tip' => $tip
    ];
    
    $updateResult = $db->update('coach_termini', $updateData, "id='".$terminId."'");
    
    if (!$updateResult) {
        // Log the consultation might still be created but appointment wasn't marked
        error_log("Warning: Consultation created but appointment not marked as reserved for ID ".$terminId);
    }
    
    // Get user details for the message
    $user = $db->query_first("SELECT id, ime, email, tel, mesto FROM korisnici WHERE id='".$userId."'");
    $consultationType = $db->query_first("SELECT naziv FROM konsultacije_tip WHERE id='".$tip."'");
    
    if ($user && $userCoach) {
        // Create message for coach
        $messageSubject = _("New consultation booked");
        $messageBody = _("New consultation booking:") . "\n\n";
        $messageBody .= _("User: ") . $user['ime'] . "\n";
        $messageBody .= _("Email: ") . $user['email'] . "\n";
        $messageBody .= _("Phone: ") . $user['tel'] . "\n";
        $messageBody .= _("Location: ") . $user['mesto'] . "\n";
        $messageBody .= _("Consultation Type: ") . ($consultationType['naziv'] ?? _('Unknown')) . "\n";
        $messageBody .= _("Appointment Date/Time: ") . $appointment['datum'] . "\n";
        $messageBody .= _("Booked on: ") . date('Y-m-d H:i:s') . "\n";
        
        $messageData = [
            'coach_id' => $userCoach['coach'],
            'user_id' => $userId,
            'subject' => $messageSubject,
            'message' => $messageBody,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $messageId = $db->insert('coach_messages', $messageData);
        
        if (!$messageId) {
            error_log("Warning: Message not created for coach ".$userCoach['coach']." about consultation booking");
        }

        // Slanje push notifikacije coach-u
        $data = [
            'type' => 'appointment',
            'coach_id' => $userCoach['coach'],
            'title' => _("Zakazana nova konsultacija"),
            'body' => _("Korisnik: ") . $user['ime'] . "\n" . _("Email: ") . $user['email'] . "\n" . _("Telefon: ") . $user['tel'] . "\n" . _("Mesto: ") . $user['mesto'] . "\n" . _("Tip: ") . ($consultationType['naziv'] ?? _('Nepoznato')) . "\n" . _("Termin: ") . $appointment['datum'],
            'icon' => '/img/icon-192.png'
        ];
        $ch = curl_init('https://coach.profesionalnaastrologija.com/ajax/send_push_notification.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    
    echo json_encode(['status' => 'ok', 'consultation_id' => $consultationId]);
    exit;

}
else if ($action === 'inform') {
    // Inform coach about interest in consultation
    if ($tip <= 0) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing consultation type']);
        exit;
    }
    
    // Get user's coach
    $userCoach = $db->query_first("SELECT coach FROM korisnici WHERE id='".$userId."'");
    if (!$userCoach) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'User coach not found']);
        exit;
    }
    
    // Get user details for the message
    $user = $db->query_first("SELECT id, ime, email, tel, mesto FROM korisnici WHERE id='".$userId."'");
    $consultationType = $db->query_first("SELECT naziv FROM konsultacije_tip WHERE id='".$tip."'");
    
    if ($user) {
        // Create message for coach about user interest
        $messageSubject = _("User interested in consultation");
        $messageBody = _("A user is interested in a consultation:") . "\n\n";
        $messageBody .= _("User: ") . $user['ime'] . "\n";
        $messageBody .= _("Email: ") . $user['email'] . "\n";
        $messageBody .= _("Phone: ") . $user['tel'] . "\n";
        $messageBody .= _("Location: ") . $user['mesto'] . "\n";
        $messageBody .= _("Interested in: ") . ($consultationType['naziv'] ?? _('Unknown')) . "\n";
        $messageBody .= _("Date: ") . date('Y-m-d H:i:s') . "\n\n";
        $messageBody .= _("Please contact the user to arrange a consultation appointment.");
        
        $messageData = [
            'coach_id' => $userCoach['coach'],
            'user_id' => $userId,
            'subject' => $messageSubject,
            'message' => $messageBody,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $messageId = $db->insert('coach_messages', $messageData);
        
        if (!$messageId) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to send inquiry']);
            exit;
        }

        // Slanje push notifikacije coach-u
        $data = [
            'type' => 'appointment',
            'coach_id' => $userCoach['coach'],
            'title' => _("Zainteresovan korisnik za konsultaciju"),
            'body' => _("Korisnik: ") . $user['ime'] . "\n" . _("Email: ") . $user['email'] . "\n" . _("Telefon: ") . $user['tel'] . "\n" . _("Mesto: ") . $user['mesto'] . "\n" . _("Tip: ") . ($consultationType['naziv'] ?? _('Nepoznato')),
            'icon' => '/img/icon-192.png'
        ];
        $ch = curl_init('https://coach.profesionalnaastrologija.com/ajax/send_push_notification.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    
    echo json_encode(['status' => 'ok']);
    exit;
}
else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    exit;
}

?>

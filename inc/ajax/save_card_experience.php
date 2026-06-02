<?php
/**
 * AJAX handler for saving card experience
 * This is called when user writes their experience for a drawn card
 */

// Include database and session handling
require_once('../../includes.php');

// Set JSON header
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

// Get POST data
$card_id = isset($_POST['card_id']) ? intval($_POST['card_id']) : 0;
$experience = isset($_POST['experience']) ? $_POST['experience'] : '';

// Validate input
if (!$card_id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing card ID']);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

try {
    // Get card details
    $card = $db->query_first("SELECT * FROM consultation_cards WHERE id='".$card_id."'");
    
    if (!$card) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Card not found']);
        exit;
    }
    
    // Verify the card belongs to the logged-in user
    if ($card['user_id'] != $_SESSION['logged']) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Unauthorized - card belongs to different user']);
        exit;
    }
    
    // Update the experience using safe escaping
    $experience_safe = $db->escape($experience);
    $result = $db->query("UPDATE consultation_cards SET experience='".$experience_safe."' WHERE id='".$card_id."'");
    
    if ($result !== false) {
        http_response_code(200);
        echo json_encode([
            'success' => true, 
            'message' => 'Experience saved successfully'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to save experience to database']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
?>

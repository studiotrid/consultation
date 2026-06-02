<?php
/**
 * AJAX handler for drawing a card
 * This is called when a card's date has arrived and needs to be revealed
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
        echo json_encode(['success' => false, 'error' => 'Unauthorized']);
        exit;
    }
    
    // Check if card already drawn
    if ($card['card_number'] !== null && $card['card_number'] != '') {
        echo json_encode([
            'success' => true, 
            'card_number' => $card['card_number'],
            'already_drawn' => true,
            'is_today' => ($card['card_date'] == date('Y-m-d'))
        ]);
        exit;
    }
    
    // Check if card date has arrived
    $today = date('Y-m-d');
    if ($card['card_date'] > $today) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Card date has not arrived yet']);
        exit;
    }
    
    // Draw a random card (1-100)
    $random_card = rand(1, 100);
    
    // Update the card with the drawn number
    $result = $db->query("UPDATE consultation_cards SET card_number='".$random_card."', drawn_at=NOW() WHERE id='".$card_id."'");
    
    if ($result !== false) {
        echo json_encode([
            'success' => true, 
            'card_number' => $random_card,
            'is_today' => ($card['card_date'] == $today),
            'drawn_at' => date('Y-m-d H:i:s')
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to save card']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
?>

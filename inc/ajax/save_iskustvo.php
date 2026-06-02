<?php
/**
 * AJAX handler for saving user experience/comments
 */

// Include database and session handling
require_once('../../includes.php');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

// Get POST data
$konsultacija_id = isset($_POST['konsultacija_id']) ? intval($_POST['konsultacija_id']) : 0;
$tekst = isset($_POST['iskustvo']) ? $_POST['iskustvo'] : '';

// Validate input
if (!$konsultacija_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing consultation ID']);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['logged'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

try {
    // Update the iskustvo field in konsultacije table
    $data = array('iskustvo' => $tekst);
    $result = $db->update('konsultacije', $data, 'id="'.$konsultacija_id.'"');
    
    if ($result !== false) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Experience saved successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save experience']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>

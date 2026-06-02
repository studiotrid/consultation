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
$coachId = isset($_SESSION['coach']) ? intval($_SESSION['coach']) : 0;

$consultationId = isset($_POST['consultation_id']) ? intval($_POST['consultation_id']) : 0;
$q1 = isset($_POST['q1']) ? trim($_POST['q1']) : '';
$q2 = isset($_POST['q2']) ? trim($_POST['q2']) : '';
$q3 = isset($_POST['q3']) ? trim($_POST['q3']) : '';

if ($consultationId <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing consultation id']);
    exit;
}

if ($q1 === '' || $q2 === '' || $q3 === '') {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'All questions are required']);
    exit;
}

// Confirm the consultation belongs to the logged-in user
$consultation = $db->query_first("SELECT id,user_id FROM konsultacije WHERE id='".$consultationId."'");
if (!$consultation || intval($consultation['user_id']) !== $userId) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Access denied for this consultation']);
    exit;
}

// Fetch the open questionnaire assignment for this consultation
$openRow = $db->query_first(
    "SELECT * FROM consultation_module12 WHERE consultation_id='".$consultationId."' " .
    "AND user_id='".$userId."' AND coach_id='".$coachId."' AND assigned=1"
);

if (!$openRow) {
    http_response_code(404);
    echo json_encode(['status' => 'error', 'message' => 'Questionnaire not available']);
    exit;
}

$updateData = [
    'q1' => $q1,
    'q2' => $q2,
    'q3' => $q3,
    'assigned' => 0,
];

$updated = $db->update(
    'consultation_module12',
    $updateData,
    "consultation_id='".$consultationId."' AND user_id='".$userId."' AND coach_id='".$coachId."' AND assigned=1"
);

if (!$updated) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to save answers']);
    exit;
}

echo json_encode(['status' => 'ok']);
exit;

<?php
/**
 * AJAX handler for saving a physically drawn constellation card for Kosmicka poruka module
 * Used in physical (non-digital) mode — user selects the card from a dropdown
 */

require_once('../../includes.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

$konsultacija = isset($_POST['konsultacija']) ? intval($_POST['konsultacija']) : 0;
$datum        = isset($_POST['datum'])        ? trim($_POST['datum'])          : '';
$karta        = isset($_POST['karta'])        ? intval($_POST['karta'])        : 0;

if (!$konsultacija || !$datum || !$karta) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
    exit;
}

// Validate date format
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datum)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid date format']);
    exit;
}

// Date must be today's slot
$today = date('Y-m-d');
if ($datum !== $today) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Can only save today\'s card']);
    exit;
}

// Verify the consultation belongs to the logged-in user
$konsult = $db->query_first(
    "SELECT id, user_id, faza FROM konsultacije WHERE id='" . $konsultacija . "'"
);

if (!$konsult) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Consultation not found']);
    exit;
}

if (intval($konsult['user_id']) !== intval($_SESSION['logged'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$faza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;
$isFaza2 = ($faza === 2 || $faza === 4);
$maxKartaId = $isFaza2 ? 72 : 88;

// Validate card range by phase deck
if ($karta < 1 || $karta > $maxKartaId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid card number']);
    exit;
}

// Verify the row exists and karta is still NULL
$row = $db->query_first(
    "SELECT id FROM izvucene_karte " .
    "WHERE konsultacija='" . $konsultacija . "' " .
    "AND datum='" . $datum . "' " .
    "AND karta IS NULL"
);

if (!$row) {
    echo json_encode(['success' => false, 'error' => 'Card already saved or slot not found']);
    exit;
}

// Save the card
$db->query(
    "UPDATE izvucene_karte SET karta='" . $karta . "' " .
    "WHERE konsultacija='" . $konsultacija . "' " .
    "AND datum='" . $datum . "' " .
    "AND karta IS NULL"
);

// Fetch the card name from phase-appropriate table
if ($isFaza2) {
    $kontal = $db->query_first(
        "SELECT andjeo AS naziv FROM andjeli WHERE id='" . $karta . "'"
    );
    $imgPath = '/img/boginje/' . $karta . '.jpg';
} else {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_kontalacije WHERE id='" . $karta . "'"
    );
    $imgPath = '/img/konstelacija/' . $karta . '.jpg';
}
$naziv = $kontal ? $kontal['naziv'] : '';

echo json_encode([
    'success'  => true,
    'karta_id' => $karta,
    'naziv'    => $naziv,
    'img_path' => $imgPath,
]);

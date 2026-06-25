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
$rowId        = isset($_POST['row_id'])       ? intval($_POST['row_id'])       : 0;
$deck         = isset($_POST['deck'])         ? trim($_POST['deck'])           : '';
$slotPosition = isset($_POST['slot_position']) ? trim($_POST['slot_position']) : '';

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
$isFaza5 = ($faza === 5);

if ($isFaza5) {
    if (!$rowId) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing slot parameters']);
        exit;
    }
}

// Verify the row exists and karta is still NULL
$row = $isFaza5
    ? $db->query_first(
        "SELECT id, datum FROM izvucene_karte " .
        "WHERE id='" . $rowId . "' " .
        "AND konsultacija='" . $konsultacija . "' " .
        "AND karta IS NULL"
    )
    : $db->query_first(
        "SELECT id FROM izvucene_karte " .
        "WHERE konsultacija='" . $konsultacija . "' " .
        "AND datum='" . $datum . "' " .
        "AND karta IS NULL"
    );

if (!$row) {
    echo json_encode(['success' => false, 'error' => 'Card already saved or slot not found']);
    exit;
}

if ($isFaza5) {
    $datum = isset($row['datum']) ? $row['datum'] : $datum;
    $dayRows = $db->fetch_array(
        "SELECT id FROM izvucene_karte " .
        "WHERE konsultacija='" . $konsultacija . "' " .
        "AND datum='" . $datum . "' " .
        "ORDER BY id ASC LIMIT 2"
    );
    if (is_array($dayRows) && count($dayRows) >= 2) {
        if (intval($dayRows[0]['id']) === intval($rowId)) {
            $slotPosition = 'top';
        } elseif (intval($dayRows[1]['id']) === intval($rowId)) {
            $slotPosition = 'bottom';
        }
    }
    if ($slotPosition === 'bottom') {
        $deck = 'boginje';
    } elseif ($slotPosition === 'top') {
        $deck = 'konstelacije';
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid phase 5 slot']);
        exit;
    }
}

$maxKartaId = $isFaza5 ? (($deck === 'boginje') ? 72 : 88) : ($isFaza2 ? 72 : 88);

// Validate card range by phase deck
if ($karta < 1 || $karta > $maxKartaId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid card number']);
    exit;
}

// Save the card
$db->query(
    "UPDATE izvucene_karte SET karta='" . $karta . "' " .
    ($isFaza5
        ? "WHERE id='" . $rowId . "' AND konsultacija='" . $konsultacija . "' AND karta IS NULL"
        : "WHERE konsultacija='" . $konsultacija . "' AND datum='" . $datum . "' AND karta IS NULL")
);

// Fetch the card name from phase-appropriate table
if ($isFaza5 && $deck === 'boginje') {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_boginje WHERE id='" . $karta . "'"
    );
    $imgPath = '/img/boginje/' . $karta . '.jpg';
} elseif ($isFaza5 && $deck === 'konstelacije') {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_kontalacije WHERE id='" . $karta . "'"
    );
    $imgPath = '/img/konstelacija/' . $karta . '.jpg';
} elseif ($isFaza2) {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_boginje WHERE id='" . $karta . "'"
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

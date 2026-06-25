<?php
/**
 * AJAX handler for digitally drawing a constellation card for Kosmicka poruka module
 * Only allowed when kosmicka_digitalno_izvlacenje = 1 and it is today's date
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
$rowId        = isset($_POST['row_id'])       ? intval($_POST['row_id'])       : 0;
$deck         = isset($_POST['deck'])         ? trim($_POST['deck'])           : '';
$slotPosition = isset($_POST['slot_position']) ? trim($_POST['slot_position']) : '';

if (!$konsultacija || !$datum) {
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

// Datum must be today
$today = date('Y-m-d');
if ($datum !== $today) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Can only draw today\'s card']);
    exit;
}

// Verify the consultation belongs to the logged-in user and digital drawing is enabled
$konsult = $db->query_first(
    "SELECT id, user_id, faza, kosmicka_digitalno_izvlacenje " .
    "FROM konsultacije WHERE id='" . $konsultacija . "'"
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

if (!intval($konsult['kosmicka_digitalno_izvlacenje'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Digital drawing not enabled']);
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
} elseif (!$datum) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
    exit;
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
    echo json_encode(['success' => false, 'error' => 'Card already drawn or slot not found']);
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
    if (!is_array($dayRows) || count($dayRows) < 2) {
        echo json_encode(['success' => false, 'error' => 'Invalid phase 5 day slots']);
        exit;
    }

    $actualSlotPosition = '';
    if (intval($dayRows[0]['id']) === intval($rowId)) {
        $actualSlotPosition = 'top';
    } elseif (intval($dayRows[1]['id']) === intval($rowId)) {
        $actualSlotPosition = 'bottom';
    }

    if ($actualSlotPosition !== '') {
        $slotPosition = $actualSlotPosition;
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

// Draw a random card from phase-appropriate deck
$maxKartaId = $isFaza5 ? (($deck === 'boginje') ? 72 : 88) : ($isFaza2 ? 72 : 88);
$kartaId = rand(1, $maxKartaId);

// Save it
$db->query(
    "UPDATE izvucene_karte SET karta='" . $kartaId . "' " .
    ($isFaza5
        ? "WHERE id='" . $rowId . "' AND konsultacija='" . $konsultacija . "' AND karta IS NULL"
        : "WHERE konsultacija='" . $konsultacija . "' AND datum='" . $datum . "' AND karta IS NULL")
);

// Fetch the card name from phase-appropriate table
if ($isFaza5 && $deck === 'boginje') {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_boginje WHERE id='" . $kartaId . "'"
    );
    $imgPath = '/img/boginje/' . $kartaId . '.jpg';
} elseif ($isFaza5 && $deck === 'konstelacije') {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_kontalacije WHERE id='" . $kartaId . "'"
    );
    $imgPath = '/img/konstelacija/' . $kartaId . '.jpg';
} elseif ($isFaza2) {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_boginje WHERE id='" . $kartaId . "'"
    );
    $imgPath = '/img/boginje/' . $kartaId . '.jpg';
} else {
    $kontal = $db->query_first(
        "SELECT naziv FROM karte_kontalacije WHERE id='" . $kartaId . "'"
    );
    $imgPath = '/img/konstelacija/' . $kartaId . '.jpg';
}
$naziv = $kontal ? $kontal['naziv'] : '';

echo json_encode([
    'success'  => true,
    'karta_id' => $kartaId,
    'naziv'    => $naziv,
    'img_path' => $imgPath,
    'debug_deck' => $deck,
    'debug_slot_position' => $slotPosition,
    'debug_row_id' => $rowId,
    'debug_datum' => $datum,
]);

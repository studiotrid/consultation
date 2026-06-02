<?php
/**
 * AJAX handler for saving daily scoring (3 questions × 0-10) for a Kosmicka poruka card
 * procenat = round((q1 + q2 + q3) / 30 * 100)
 * Returns row average if all 6 cards in the row are now scored
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
$q1           = isset($_POST['q1'])           ? intval($_POST['q1'])           : -1;
$q2           = isset($_POST['q2'])           ? intval($_POST['q2'])           : -1;
$q3           = isset($_POST['q3'])           ? intval($_POST['q3'])           : -1;
$komentar     = isset($_POST['komentar'])     ? trim($_POST['komentar'])       : '';

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

// Validate score ranges (0–10 each)
if ($q1 < 0 || $q1 > 10 || $q2 < 0 || $q2 > 10 || $q3 < 0 || $q3 > 10) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Scores must be between 0 and 10']);
    exit;
}

$komentarLen = function_exists('mb_strlen') ? mb_strlen($komentar, 'UTF-8') : strlen($komentar);
if ($komentarLen > 4000) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Komentar je predugačak']);
    exit;
}

// Verify consultation belongs to logged-in user
$konsult = $db->query_first(
    "SELECT id, user_id FROM konsultacije WHERE id='" . $konsultacija . "'"
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

// Verify the row exists and has a karta already set
$row = $db->query_first(
    "SELECT id FROM izvucene_karte " .
    "WHERE konsultacija='" . $konsultacija . "' " .
    "AND datum='" . $datum . "' " .
    "AND karta IS NOT NULL"
);

if (!$row) {
    echo json_encode(['success' => false, 'error' => 'Card not yet drawn for this date']);
    exit;
}

// Calculate procenat
$procenat = (int) round(($q1 + $q2 + $q3) / 30 * 100);

// Save
$db->query(
    "UPDATE izvucene_karte SET procenat='" . $procenat . "' " .
    "WHERE konsultacija='" . $konsultacija . "' " .
    "AND datum='" . $datum . "'"
);

// Save detailed answers + optional comment only if new columns exist
$hasKpCol = $db->query_first("SHOW COLUMNS FROM izvucene_karte LIKE 'kp_odgovor1'");
if ($hasKpCol) {
    $komentarEsc = addslashes($komentar);
    $db->query(
        "UPDATE izvucene_karte SET " .
        "kp_odgovor1='" . $q1 . "', " .
        "kp_odgovor2='" . $q2 . "', " .
        "kp_odgovor3='" . $q3 . "', " .
        "kp_komentar='" . $komentarEsc . "', " .
        "kp_testirano_at='" . date('Y-m-d H:i:s') . "' " .
        "WHERE konsultacija='" . $konsultacija . "' " .
        "AND datum='" . $datum . "'"
    );
}

// Check if the row of 6 cards (group of 6 ordered by date containing this datum) is now complete
// Fetch all cards for this consultation ordered by date
$allCards = $db->fetch_array(
    "SELECT datum, procenat FROM izvucene_karte " .
    "WHERE konsultacija='" . $konsultacija . "' " .
    "ORDER BY datum ASC"
);

$rowAverage = null;
if (is_array($allCards)) {
    // Find the 0-based index of $datum
    $idx = 0;
    foreach ($allCards as $i => $c) {
        if ($c['datum'] === $datum) {
            $idx = $i;
            break;
        }
    }
    // Determine which row (0-based group of 6)
    $rowNum   = (int) floor($idx / 6);
    $rowSlice = array_slice($allCards, $rowNum * 6, 6);

    // Update procenat in our local slice for the card we just saved
    foreach ($rowSlice as $k => $s) {
        if ($s['datum'] === $datum) {
            $rowSlice[$k]['procenat'] = $procenat;
        }
    }

    // Check if all cards in the row are scored
    $allScored = true;
    $sum       = 0;
    $cnt       = 0;
    foreach ($rowSlice as $s) {
        if ($s['procenat'] === null || $s['procenat'] === '') {
            $allScored = false;
            break;
        }
        $sum += intval($s['procenat']);
        $cnt++;
    }
    if ($allScored && $cnt > 0) {
        $rowAverage = round($sum / $cnt, 1);
    }
}

echo json_encode([
    'success'     => true,
    'procenat'    => $procenat,
    'row_average' => $rowAverage,
]);

<?php
/**
 * AJAX handler for saving karmicke vertikale test results
 */

require_once('../../includes.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

if (!isset($_SESSION['logged'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$ispitId = isset($_POST['ispitID']) ? intval($_POST['ispitID']) : 0;
if (!$ispitId) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing test ID']);
    exit;
}

$odgovor1 = isset($_POST['odgovor1']) ? intval($_POST['odgovor1']) : 0;
$odgovor2 = isset($_POST['odgovor2']) ? intval($_POST['odgovor2']) : 0;
$odgovor3 = isset($_POST['odgovor3']) ? intval($_POST['odgovor3']) : 0;
$komentar = isset($_POST['komentar']) ? trim($_POST['komentar']) : '';

if ($odgovor1 < 0 || $odgovor1 > 10 || $odgovor2 < 0 || $odgovor2 > 10 || $odgovor3 < 0 || $odgovor3 > 10) {
    http_response_code(400);
    echo json_encode(['error' => 'Odgovori moraju biti između 0 i 10']);
    exit;
}

if (mb_strlen($komentar, 'UTF-8') > 4000) {
    http_response_code(400);
    echo json_encode(['error' => 'Komentar je predugačak']);
    exit;
}

$dataj = array();
$dataj['odgovor1'] = $odgovor1;
$dataj['odgovor2'] = $odgovor2;
$dataj['odgovor3'] = $odgovor3;

$uspeh = ($odgovor1 + $odgovor2 + $odgovor3) / 30 * 100;
$dataj['uspeh'] = $uspeh;

try {
    $result = $db->update('karmicke_vertikale_termini', $dataj, 'ID="' . $ispitId . '"');
    if ($result !== false) {
        $testRecord = $db->query_first("SELECT datum, konsultacija FROM karmicke_vertikale_termini WHERE ID='" . $ispitId . "'");
        $uspehText = '';

        if ($testRecord && !empty($testRecord['datum']) && !empty($testRecord['konsultacija'])) {
            $kvData = array();
            $kvData['kv_odgovor1'] = $odgovor1;
            $kvData['kv_odgovor2'] = $odgovor2;
            $kvData['kv_odgovor3'] = $odgovor3;
            $kvData['kv_procenat'] = intval($uspeh);
            $kvData['kv_komentar'] = $komentar;
            $kvData['kv_testirano_at'] = date('Y-m-d H:i:s');

            $cardRow = $db->query_first(
                "SELECT id FROM izvucene_karte WHERE konsultacija='" . intval($testRecord['konsultacija']) . "' AND datum='" . $testRecord['datum'] . "'"
            );

            if ($cardRow && isset($cardRow['id'])) {
                $db->update('izvucene_karte', $kvData, 'id="' . intval($cardRow['id']) . '"');
            } else {
                $kvInsertData = $kvData;
                $kvInsertData['konsultacija'] = intval($testRecord['konsultacija']);
                $kvInsertData['datum'] = $testRecord['datum'];
                $db->insert('izvucene_karte', $kvInsertData);
            }
        }

        if($testRecord && $testRecord['datum']) {
            $timestamp = strtotime($testRecord['datum']);
            $dayName = strftime('%A', $timestamp);
            $dayNameLat = getDayNameLatin($dayName);
            $dateFormatted = date('d.m.Y', $timestamp);
            $uspehPercent = intval($uspeh);
            $uspehText = $dayNameLat . ', ' . $dateFormatted . ', uspešno završeno <span style="font-size: 1.3em; font-weight: bold;">' . $uspehPercent . '%</span>';
        }

        http_response_code(200);
        echo json_encode(['success' => true, 'uspeh' => intval($uspeh), 'uspehText' => $uspehText]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save test']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}

function getDayNameLatin($dayName){
    $daysMap = array(
        'понедељак' => 'ponedeljak',
        'уторак' => 'utorak',
        'среда' => 'sreda',
        'четвртак' => 'četvrtak',
        'петак' => 'petak',
        'суббота' => 'subota',
        'недеља' => 'nedjelja'
    );
    return isset($daysMap[$dayName]) ? $daysMap[$dayName] : $dayName;
}
?>

<?php
/**
 * AJAX handler for saving termini (dragon) test results
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

$dataj = array();
$dataj['odgovor1'] = $odgovor1;
$dataj['odgovor2'] = $odgovor2;
$dataj['odgovor3'] = $odgovor3;
$dataj['odgovor1text'] = isset($_POST['odgovor1text']) ? $_POST['odgovor1text'] : '';
$dataj['odgovor2text'] = isset($_POST['odgovor2text']) ? $_POST['odgovor2text'] : '';
$dataj['odgovor3text'] = isset($_POST['odgovor3text']) ? $_POST['odgovor3text'] : '';

$dataj['uspeh'] = ($odgovor1 + $odgovor2 + $odgovor3) / 30 * 100;
$uspeh = $dataj['uspeh'];

try {
    $result = $db->update('dragon_ispit_termini', $dataj, 'ID="' . $ispitId . '"');
    if ($result !== false) {
        // Get the test record to format the success text
        $testRecord = $db->query_first("SELECT datum FROM dragon_ispit_termini WHERE ID='" . $ispitId . "'");
        $uspehText = '';
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
    echo json_encode(['error' => $e->getMessage()]);
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

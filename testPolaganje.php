<?php
// Standalone test page without layout
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
date_default_timezone_set('Europe/Belgrade');

echo "<!-- TEST START -->\n";

require_once 'inc/conf/env.php';
require_once __DIR__ . '/vendor/autoload.php';

echo "<!-- Autoloader loaded -->\n";

function getTestCiljAnswerColumn($db)
{
    $tableExists = $db->query_first("SHOW TABLES LIKE 'test_cilja'");
    if (!$tableExists) {
        return null;
    }

    $columns = $db->fetch_array("SHOW COLUMNS FROM test_cilja");
    if (!$columns || !is_array($columns)) {
        return null;
    }

    $preferred = ['odgovor', 'tekst', 'text', 'opis', 'sadrzaj', 'note', 'napomena', 'content', 'body'];
    foreach ($columns as $col) {
        if (!is_array($col) || !isset($col['Field'])) {
            continue;
        }
        if (in_array($col['Field'], $preferred, true)) {
            return $col['Field'];
        }
    }

    foreach ($columns as $col) {
        if (!is_array($col) || !isset($col['Field']) || !isset($col['Type'])) {
            continue;
        }
        if (stripos($col['Type'], 'text') !== false) {
            return $col['Field'];
        }
    }

    return null;
}

// Create a clean Smarty instance
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');
$smarty->setCacheDir(__DIR__ . '/cache/');

echo "<!-- Smarty initialized -->\n";

require_once (WEBROOT.BASEPATH.'inc/conf/db.php');
require_once (WEBROOT.BASEPATH.'inc/class/Login.class.php');

echo "<!-- Database and Login loaded -->\n";

$login = Login::getInstance();

if (!$login->isLoggedIn()) {
    die('<h2>You must be logged in to take the test.</h2>');
}

echo "<!-- User is logged in -->\n";

$konsultacijaId = isset($_GET['konsultacija']) ? intval($_GET['konsultacija']) : 0;
$userId = isset($_SESSION['logged']) ? intval($_SESSION['logged']) : 0;
$standaloneTestId = isset($_GET['testID']) ? intval($_GET['testID']) : 0; // For standalone tests

// If konsultacija not provided (e.g., POST refresh), derive it from test record
if ($konsultacijaId <= 0 && isset($_POST['testID'])) {
    $tmpTest = $db->query_first("SELECT konsultacija, korisnik FROM test WHERE ID='".intval($_POST['testID'])."'");
    if ($tmpTest && isset($tmpTest['konsultacija'])) {
        $konsultacijaId = intval($tmpTest['konsultacija']);
        if ($userId <= 0 && isset($tmpTest['korisnik'])) {
            $userId = intval($tmpTest['korisnik']);
        }
    }
}

echo "<!-- Konsultacija: $konsultacijaId, User: $userId, StandaloneTestID: $standaloneTestId -->\n";

// For standalone tests, konsultacija can be 0, but user must be logged in
if ($userId <= 0) {
    die('<h2>Invalid request. User not logged in.</h2>');
}

// Handle form submission: save answers to 'odgovori'
// Allow submission with just cilj_odgovor (no planets) or with odgovori (with planets)
if (isset($_POST['testID']) && (isset($_POST['odgovori']) || isset($_POST['cilj_odgovor']))) {
    $testId = intval($_POST['testID']);
    $testRowPost = $db->query_first("SELECT * FROM test WHERE ID='".$testId."'");

    // Ensure konsultacija is known for subsequent render
    if ($konsultacijaId <= 0 && $testRowPost && isset($testRowPost['konsultacija'])) {
        $konsultacijaId = intval($testRowPost['konsultacija']);
        if ($userId <= 0 && isset($testRowPost['korisnik'])) {
            $userId = intval($testRowPost['korisnik']);
        }
    }

    $testCiljId = ($testRowPost && isset($testRowPost['cilj'])) ? intval($testRowPost['cilj']) : 0;
    $ciljAnswerColumn = ($testCiljId > 0) ? getTestCiljAnswerColumn($db) : null;
    $submittedCiljAnswer = isset($_POST['cilj_odgovor']) ? trim($_POST['cilj_odgovor']) : '';
    $saved = 0;
    
    // Save pitanje answers if they exist
    if (isset($_POST['odgovori']) && is_array($_POST['odgovori'])) {
        foreach ($_POST['odgovori'] as $pitanjeId => $odgovor) {
            $pitanjeId = intval($pitanjeId);
            $odgovorVal = intval($odgovor);
            if ($pitanjeId > 0) {
                $db->insert('odgovori', [
                    'test' => $testId,
                    'pitanje' => $pitanjeId,
                    'odgovor' => $odgovorVal
                ]);
                $saved++;
            }
        }
    }

    // Save cilj answer if it exists and test has cilj
    if ($testCiljId > 0 && $ciljAnswerColumn !== null) {
        $db->update('test_cilja', [
            $ciljAnswerColumn => $submittedCiljAnswer
        ], "ID='".$testCiljId."'");
    }

    // Mark test as done if columns exist (silently skip if they don't)
    $hasPolje = $db->query_first("SHOW COLUMNS FROM test LIKE 'polje'");
    if ($hasPolje && is_array($hasPolje) && count($hasPolje) > 0) {
        $db->update('test', ['polje' => 1], "ID='".$testId."'");
    }

    $hasUradjen = $db->query_first("SHOW COLUMNS FROM test LIKE 'uradjen'");
    if ($hasUradjen && is_array($hasUradjen) && count($hasUradjen) > 0) {
        $db->update('test', ['uradjen' => 1], "ID='".$testId."'");
    }

    // Show saved message
    $testImePost = ($testRowPost && isset($testRowPost['ime']) && $testRowPost['ime']!=='') ? $testRowPost['ime'] : 'Consultation Test';
    $testTipPost = ($testRowPost && isset($testRowPost['tip']) && $testRowPost['tip']!=='') ? $testRowPost['tip'] : 'yang';

    $smarty->assign('test', [
        'ID' => $testId,
        'konsultacija' => $konsultacijaId,
        'ime' => $testImePost,
        'tip' => $testTipPost,
        'cilj' => $testCiljId
    ]);
    $smarty->assign('savedCount', $saved);
    $smarty->display('testPolaganje.tpl');
    $db->close();
    exit;
}

// Create a new test record for this consultation and user
// Build comma-separated list of all chakras (planete) for comprehensive test
$chakras = $db->fetch_array("SELECT ID FROM cakre ORDER BY ID");
$planeteList = [];
foreach ($chakras as $row) {
    if (isset($row['ID'])) $planeteList[] = $row['ID'];
}
$planeteCsv = implode(',', $planeteList);

// Reuse existing test without answers if it exists; otherwise create a new one
if ($standaloneTestId > 0) {
    // For standalone tests, use the specific test ID provided
    $testRow = $db->query_first(
        "SELECT t.*, (SELECT COUNT(*) FROM odgovori o WHERE o.test = t.ID) AS ansCnt " .
        "FROM test t WHERE t.ID='".$standaloneTestId."' AND t.korisnik='".$userId."' LIMIT 1"
    );
} else {
    // For consultation tests, find test by consultation ID
    $testRow = $db->query_first(
        "SELECT t.*, (SELECT COUNT(*) FROM odgovori o WHERE o.test = t.ID) AS ansCnt " .
        "FROM test t WHERE t.konsultacija='".$konsultacijaId."' AND t.korisnik='".$userId."' " .
        "ORDER BY t.ID DESC LIMIT 1"
    );
}

if($testRow && isset($testRow['ansCnt']) && intval($testRow['ansCnt']) === 0){
    $createdTestId = $testRow['ID'];
    echo "<!-- Reusing existing test ID: ".$createdTestId." -->\n";
} else {
    $testData = [
        'konsultacija' => $konsultacijaId,
        'korisnik' => $userId,
        'planete' => $planeteCsv,
        'tip' => 'yang',
        'vreme' => 'now()'
    ];
    $createdTestId = $db->insert('test', $testData);
    $testRow = $db->query_first("SELECT * FROM test WHERE ID='".$createdTestId."'");
    echo "<!-- Created new test ID: ".$createdTestId." -->\n";
}

if(!$testRow || !isset($testRow['planete'])){
    die('<h2>Test record not found.</h2>');
}

$planeteArr = array_filter(array_map('trim', explode(',', $testRow['planete'])), 'strlen');
$planeteArr = array_map('intval', $planeteArr);

// Check if test has no planets but has a goal
$hasPlanets = count($planeteArr) > 0;
$testCiljIdCheck = (isset($testRow['cilj'])) ? intval($testRow['cilj']) : 0;

// If no planets but has cilj, show cilj-only form
if (!$hasPlanets && $testCiljIdCheck > 0) {
    $testCiljAnswerColumn = getTestCiljAnswerColumn($db);
    $testCiljExistingAnswer = '';

    if ($testCiljAnswerColumn !== null) {
        $testCiljRow = $db->query_first("SELECT * FROM test_cilja WHERE ID='".$testCiljIdCheck."'");
        if ($testCiljRow && isset($testCiljRow[$testCiljAnswerColumn])) {
            $testCiljExistingAnswer = $testCiljRow[$testCiljAnswerColumn];
        }
    }

    $test = [
        'ID' => $createdTestId,
        'ime' => 'Consultation Test',
        'tip' => isset($testRow['tip']) ? $testRow['tip'] : 'yang',
        'konsultacija' => $konsultacijaId,
        'cilj' => $testCiljIdCheck,
        'noPlantesOnlyGoal' => true
    ];

    $smarty->assign('test', $test);
    $smarty->assign('testCilj', [
        'id' => $testCiljIdCheck,
        'answerColumn' => $testCiljAnswerColumn,
        'answer' => $testCiljExistingAnswer
    ]);
    $smarty->assign('pitanja', []);
    $smarty->display('testPolaganje.tpl');
    $db->close();
    exit;
}

// If still no planets and no cilj, show error
if (!$hasPlanets) {
    die('<h2>No planets assigned to this test.</h2>');
}

// Determine limits
$limit = (count($planeteArr) <= 1) ? 30 : 100;

$planeteIn = implode(',', $planeteArr);
$testTip = isset($testRow['tip']) ? $testRow['tip'] : 'yang';
$testCiljId = (isset($testRow['cilj'])) ? intval($testRow['cilj']) : 0;
$testCiljAnswerColumn = ($testCiljId > 0) ? getTestCiljAnswerColumn($db) : null;
$testCiljExistingAnswer = '';

if ($testCiljId > 0 && $testCiljAnswerColumn !== null) {
    $testCiljRow = $db->query_first("SELECT * FROM test_cilja WHERE ID='".$testCiljId."'");
    if ($testCiljRow && isset($testCiljRow[$testCiljAnswerColumn])) {
        $testCiljExistingAnswer = $testCiljRow[$testCiljAnswerColumn];
    }
}

// Fetch filtered questions
$pitanja = $db->fetch_array(
    "SELECT ID, pitanje FROM pitanja " .
    "WHERE cakra IN (".$planeteIn.") AND tip='".$testTip."' " .
    "ORDER BY RAND() LIMIT " . intval($limit)
);

echo "<!-- Pitanja fetched: " . count($pitanja) . " -->\n";

// Debug output
if (!$pitanja || count($pitanja) === 0) {
    die('<h2>Warning: No questions found for selected planets!</h2><p>Test ID: '.$createdTestId.'</p>');
}

$test = [
    'ID' => $createdTestId,
    'ime' => 'Consultation Test',
    'tip' => $testTip,
    'konsultacija' => $konsultacijaId,
    'cilj' => $testCiljId
];

echo "<!-- About to assign to Smarty -->\n";

$smarty->assign('test', $test);
$smarty->assign('testCilj', [
    'id' => $testCiljId,
    'answerColumn' => $testCiljAnswerColumn,
    'answer' => $testCiljExistingAnswer
]);
$smarty->assign('pitanja', $pitanja);

echo "<!-- Assigned to Smarty, now displaying template -->\n";

// Direct display without layout
$smarty->display('testPolaganje.tpl');

echo "<!-- Template displayed -->\n";

$db->close();

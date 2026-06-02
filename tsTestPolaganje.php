<?php
session_start();
require_once('includes.php');

// Check if user is logged in
if (!isset($_SESSION['logged']) || $_SESSION['logged'] == '') {
    header('Location: login.php');
    exit;
}

$ulogovan = $_SESSION['logged'];

// Handle test submission
if (isset($_POST['testID'])) {
    $testID = intval($_POST['testID']);
    
    // Verify test belongs to logged in user
    $test = $db->query_first("SELECT * FROM ts_test WHERE id='".$testID."' AND korisnik='".$ulogovan."'");
    
    if ($test && isset($_POST['odgovori'])) {
        // Delete old answers if any
        $db->query('DELETE FROM ts_odgovori WHERE test="'.$testID.'"');
        
        // Save new answers
        foreach($_POST['odgovori'] as $pitanje => $odgovor) {
            $data = array();
            $data['test'] = $testID;
            $data['pitanje'] = intval($pitanje);
            $data['odgovor'] = intval($odgovor);
            $db->insert('ts_odgovori', $data);
        }
        
        // Mark test as completed
        $updateData = array(
            'uradjen' => 1,
            'obavesten' => 1
        );
        
        // If posttest, save additional answers
        if ($test['tip'] == 'posttest') {
            if (isset($_POST['post1'])) {
                $updateData['odgovor1'] = $_POST['post1'];
            }
            if (isset($_POST['post2a'])) {
                $updateData['odgovor2a'] = intval($_POST['post2a']);
            }
            if (isset($_POST['post2b'])) {
                $updateData['odgovor2b'] = intval($_POST['post2b']);
            }
            if (isset($_POST['post2c'])) {
                $updateData['odgovor2c'] = intval($_POST['post2c']);
            }
            if (isset($_POST['post3'])) {
                $updateData['odgovor3'] = $_POST['post3'];
            }
            if (isset($_POST['post4'])) {
                $updateData['odgovor4'] = $_POST['post4'];
            }
        }
        
        $db->update('ts_test', $updateData, 'id="'.$testID.'"');
        
        // If this is a pretest, create posttest for 28 days later
        if ($test['tip'] == 'predtest') {
            $posttestData = array(
                'korisnik' => $test['korisnik'],
                'planeta' => $test['planeta'],
                'tip' => 'posttest',
                'uradjen' => 0,
                'obavesten' => 0,
                'vreme' => date('Y-m-d H:i:s', strtotime($test['vreme'] . ' +28 days'))
            );
            $db->insert('ts_test', $posttestData);
        }
        
        $smarty->assign('success', true);
    }
} elseif (isset($_GET['test'])) {
    // Load test form
    $testID = intval($_GET['test']);
    $test = $db->query_first("SELECT * FROM ts_test WHERE id='".$testID."' AND korisnik='".$ulogovan."' AND uradjen=0");
    
    if ($test) {
        // Get planet name
        $planeta = $db->query_first("SELECT planeta FROM cakre WHERE ID='".$test['planeta']."'");
        $test['nazivPlanete'] = $planeta['planeta'];
        
        $smarty->assign('test', $test);
        
        // Load 30 random questions for this planet/chakra
        $pitanja = $db->fetch_array("SELECT *, pitanje as tekst FROM ts_pitanja WHERE cakra='".$test['planeta']."' ORDER BY RAND() LIMIT 30");
        $smarty->assign('pitanja', $pitanja);
    }
}

$smarty->display('tsTestPolaganje.tpl');

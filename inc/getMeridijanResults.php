<?php
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
require_once '../includes.php';

if (isset($_GET['test'])) {
    $testId = intval($_GET['test']);
    
    // Get test info
    $test = $db->query_first("SELECT * FROM meridijani_test WHERE id='".$testId."'");
    
    if (!$test || $test['uradjen'] != 1) {
        echo '<div style="padding: 20px;"><p>Test nije pronađen ili nije završen.</p></div>';
        exit;
    }
    
    // Get all answers for this test
    $odgovori = $db->fetch_array("SELECT mo.*, mp.tekst as pitanje_tekst 
                                   FROM meridijani_odgovori mo 
                                   LEFT JOIN meridijani_pitanja mp ON (mo.pitanje = mp.id) 
                                   WHERE mo.test='".$testId."' 
                                   ORDER BY mp.id");
    
    if (!$odgovori || count($odgovori) == 0) {
        echo '<div style="padding: 20px;"><p>Nema pronađenih odgovora za ovaj test.</p></div>';
        exit;
    }
    
    // Display results in a table
    echo '<div style="padding: 20px; font-family: Arial, sans-serif; background-color: #ffffff; color: #333;">';
    echo '<h2 style="margin-bottom: 20px; color: #333;">Rezultati Meridijanskog testa</h2>';
    echo '<p style="margin-bottom: 15px;"><strong>Meridijan:</strong> ' . htmlspecialchars($test['meridijan']) . '</p>';
    
    echo '<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">';
    echo '<thead>';
    echo '<tr style="background-color: #257C9E; color: white;">';
    echo '<th style="padding: 12px; text-align: left; border: 1px solid #ddd; width: 60px;">#</th>';
    echo '<th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Pitanje</th>';
    echo '<th style="padding: 12px; text-align: center; border: 1px solid #ddd; width: 100px;">Odgovor</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    $counter = 1;
    foreach ($odgovori as $odgovor) {
        $bgColor = ($counter % 2 == 0) ? '#f9f9f9' : '#ffffff';
        echo '<tr style="background-color: ' . $bgColor . ';">';
        echo '<td style="padding: 10px; border: 1px solid #ddd; text-align: center;">' . $counter . '</td>';
        echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($odgovor['pitanje_tekst']) . '</td>';
        
        // Color code the answer
        $odgovorValue = intval($odgovor['odgovor']);
        $color = '#333';
        if ($odgovorValue >= 7) {
            $color = '#d9534f'; // Red for high values
        } elseif ($odgovorValue >= 4) {
            $color = '#f0ad4e'; // Orange for medium values
        } else {
            $color = '#5cb85c'; // Green for low values
        }
        
        echo '<td style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: ' . $color . '; font-size: 1.2em;">' . $odgovorValue . '</td>';
        echo '</tr>';
        $counter++;
    }
    
    echo '</tbody>';
    echo '</table>';
    
    // Calculate average
    $total = 0;
    foreach ($odgovori as $odgovor) {
        $total += intval($odgovor['odgovor']);
    }
    $average = count($odgovori) > 0 ? round($total / count($odgovori), 2) : 0;
    
    echo '<div style="margin-top: 20px; padding: 15px; background-color: #f0f0f0; border-radius: 5px;">';
    echo '<p style="margin: 0; font-size: 1.1em;"><strong>Prosečan odgovor:</strong> <span style="color: #257C9E; font-size: 1.3em;">' . $average . '</span> / 10</p>';
    echo '</div>';
    
    echo '</div>';
} else {
    echo '<div style="padding: 20px;"><p>Test ID nije prosleđen.</p></div>';
}
?>

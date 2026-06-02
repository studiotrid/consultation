<?php
// Debug script za testiranje TS testova
require_once 'includes.php';

// Test sa korisnikom koji ima TS testove
$testUserId = 1027; // Ovaj korisnik ima TS testove i konsultacije

echo "<h1>TS Test Debug</h1>";
echo "<h2>User ID: $testUserId</h2>";

// Provera da li postoje predtestovi
$sveplanete = $db->fetch_array("SELECT * from cakre");
$tsPredTestovi = $db->fetch_array("SELECT * from ts_test where korisnik='$testUserId' and tip='predtest' and uradjen=1 order by vreme desc");

echo "<h3>Predtests found: " . count($tsPredTestovi) . "</h3>";

if(count($tsPredTestovi) > 0) {
    echo "<pre>";
    print_r($tsPredTestovi);
    echo "</pre>";
    
    echo "<h3>Processing first test...</h3>";
    $pred = $tsPredTestovi[0];
    $planeta = $db->query_first("SELECT planeta from cakre where ID='".$pred['planeta']."'");
    echo "<p>Planeta: " . $planeta['planeta'] . "</p>";
    
    $tsPostTest = $db->query_first("SELECT * from ts_test where korisnik='$testUserId' and tip='posttest' and planeta='".$pred['planeta']."'");
    echo "<p>PostTest found: " . (isset($tsPostTest['id']) ? 'YES (ID: '.$tsPostTest['id'].')' : 'NO') . "</p>";
} else {
    echo "<p>No predtests found for this user!</p>";
}

// Provera konsultacije
$konsultacije = Konsultacije::getInstance();
$lastConsultation = $konsultacije->getLast($testUserId);

if($lastConsultation) {
    echo "<h3>Last consultation loaded successfully</h3>";
    echo "<p>Checking if TS tests are in the output...</p>";
    
    $hasTS = false;
    foreach($lastConsultation as $item) {
        if(is_string($item) && strpos($item, 'modultestTS') !== false) {
            $hasTS = true;
            echo "<p style='color:green;'><strong>TS Tests FOUND in consultation output!</strong></p>";
            break;
        }
        if(is_string($item) && strpos($item, 'CT TESTS') !== false) {
            $hasTS = true;
            echo "<p style='color:green;'><strong>CT TESTS button FOUND in consultation output!</strong></p>";
            break;
        }
    }
    
    if(!$hasTS) {
        echo "<p style='color:red;'><strong>TS Tests NOT FOUND in consultation output!</strong></p>";
    }
    
    echo "<h4>Consultation modules:</h4>";
    echo "<pre>";
    $moduleNum = 0;
    foreach($lastConsultation as $key => $item) {
        if(is_array($item)) {
            echo "[$key] => Array with " . count($item) . " elements\n";
        } else {
            $preview = is_string($item) ? substr($item, 0, 200) : $item;
            echo "[$key] ($moduleNum) => $preview\n";
            echo str_repeat("-", 80) . "\n";
            $moduleNum++;
        }
    }
    echo "</pre>";
} else {
    echo "<h3 style='color:red;'>No last consultation found for this user!</h3>";
}

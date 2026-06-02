<?php

                                // Only consider tests not assigned to any consultation (standalone tests)
                                // Check for empty string, '0', or NULL
                                // Include tests without planets (cilj-only tests)
                                $sviTestovi = $db->fetch_array("SELECT * from test where (konsultacija='' OR konsultacija='0' OR konsultacija IS NULL) and korisnik='".$_SESSION['logged']."' ORDER BY vreme DESC");
                                $testoviCount = is_array($sviTestovi) ? count($sviTestovi) : 0;
                                $broj=0;
                                $svitesss = array();
                                $standaloneTestIcons = array(); // For tests that need to be taken
                                
                                if(is_array($sviTestovi) && count($sviTestovi) > 0){
                                foreach($sviTestovi as $testovi){
                                    // Check if test has recorded answers
                                    $imaOdgovora = $db->query_first("SELECT COUNT(*) as cnt FROM odgovori WHERE test='".$testovi['ID']."'");
                                    $imaOdgovore = isset($imaOdgovora['cnt']) && intval($imaOdgovora['cnt']) > 0;
                                    
                                    if (!$imaOdgovore) {
                                        // Test needs to be taken - add to icons list
                                        $testIcon = array(
                                            'id' => $testovi['ID'],
                                            'konsultacija' => 0, // Standalone test
                                            'datum' => $testovi['vreme'],
                                            'vreme' => $testovi['vreme']
                                        );
                                        $standaloneTestIcons[] = $testIcon;
                                        continue;
                                    }

                                    // Reset privremenih promenljivih za svaki test
                                    $procentiPlan = array();
                                    $procentiProc = array();
                                    $zaopis = array();
                                    $ceotest = array();

                                    $testCiljTekst = '';
                                    $testCiljId = (isset($testovi['cilj'])) ? intval($testovi['cilj']) : 0;
                                    if ($testCiljId > 0) {
                                        $ciljCol = $konsultacije->getTestCiljAnswerColumn();
                                        if ($ciljCol !== null) {
                                            $testCiljRow = $db->query_first("SELECT * FROM test_cilja WHERE ID='".$testCiljId."'");
                                            if ($testCiljRow && isset($testCiljRow[$ciljCol])) {
                                                $testCiljTekst = $testCiljRow[$ciljCol];
                                            }
                                        }
                                    }

                                    // Check if test has planets assigned
                                    $imaPlanete = !empty($testovi['planete']) && trim($testovi['planete']) != '';
                                    
                                    // If test has no planets, only show test cilja
                                    if (!$imaPlanete) {
                                        $jedantest = array();
                                        $jedantest['planete'] = 'TEST CILJA';
                                        $jedantest['tip'] = isset($testovi['tip']) ? $testovi['tip'] : '';
                                        $jedantest['datum'] = $testovi['vreme'];
                                        $jedantest['vreme'] = $testovi['vreme'];
                                        $jedantest['broj'] = $broj;
                                        $jedantest['test_cilja'] = $testCiljTekst;
                                        $jedantest['nema_planete'] = true; // Flag to skip planet-related display
                                        $broj++;
                                        $svitesss[] = $jedantest;
                                        continue; // Skip planet processing
                                    }

                                    $testPlanete=explode(',',$testovi['planete']);
                                    if (count($testPlanete)>1){
                                        $sveplanete=$db->fetch_array("SELECT * from cakre ");
                                        foreach($sveplanete as $planeta){
                                            $testStub['planeta']=$planeta['planeta'];
                                            $testStub['znak']=$planeta['znak'];
                                            $testStub['boja']=$planeta['boja'];
                                            $odgovori = $db->query_first("SELECT sum(odgovori.odgovor) as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) where odgovori.test='".$testovi['ID']."' and pitanja.cakra='".$planeta['cakra']."'");
                                            $totalBroj = $db->fetch_array("SELECT pitanja.pitanje,cakre.planeta,pitanja.planeta as cakra,pitanja.zivotinja,pitanja.nivo,odgovori.odgovor as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) left join cakre on (cakre.cakra = pitanja.cakra ) where odgovori.test='".$testovi['ID']."' and pitanja.cakra='".$planeta['cakra']."'");
                                            if ($testovi['tip']=='yang'){
                                                if (count($totalBroj)==0)$testStub['procenat']=0;
                                                else $testStub['procenat']=$odgovori['total']/(count($totalBroj)*10)*100;
                                            }
                                            else {
                                                if (count($totalBroj)==0)$testStub['procenat']=0;
                                                else $testStub['procenat']=$odgovori['total']/(count($totalBroj)*10)*100;
                                            }
                                            $testStub['pitanja']=$totalBroj;
                                            if ((isset($testStub['procenat']) and $testStub['procenat']=='') or !isset($testStub['procenat'])) $testStub['procenat']=0;
                                            $procentiPlan[]=$planeta['planeta'];
                                            if(in_array($planeta['cakra'],$testPlanete)) {
                                                $zaopis[]=$planeta['planeta'];
                                                $procentiProc[]=$testStub['procenat'];
                                            }
                                            $ceotest[]=$testStub; 
                                        }
                                    }
                                    else{
                                        $sveplanete=$db->fetch_array("SELECT * from cakre ");
                                        foreach($sveplanete as $planeta){
                                            $testStub['planeta']=$planeta['planeta'];
                                            $testStub['znak']=$planeta['znak'];
                                            $testStub['boja']=$planeta['boja'];
                                            $odgovori = $db->query_first("SELECT sum(odgovori.odgovor) as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) where odgovori.test='".$testovi['ID']."' and pitanja.planeta='".$planeta['cakra']."' ");
                                            $totalBroj = $db->fetch_array("SELECT pitanja.pitanje,cakre.planeta,pitanja.zivotinja,pitanja.cakra,pitanja.nivo,odgovori.odgovor as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) left join cakre on (cakre.cakra = pitanja.planeta ) where odgovori.test='".$testovi['ID']."' and pitanja.planeta='".$planeta['cakra']."' ");
                                            if ($testovi['tip']=='yang'){
                                                if (count($totalBroj)==0)$testStub['procenat']=0;
                                                else $testStub['procenat']=$odgovori['total']/(count($totalBroj)*10)*100;
                                            }
                                            else {
                                                if (count($totalBroj)==0)$testStub['procenat']=0;
                                                else $testStub['procenat']=$odgovori['total']/(count($totalBroj)*10)*100;
                                            }
                                            $testStub['pitanja']=$totalBroj;
                                            if ((isset($testStub['procenat']) and $testStub['procenat']=='') or !isset($testStub['procenat'])) $testStub['procenat']=0;
                                            $procentiPlan[]=$planeta['planeta'];
                                            $zaopis[]=$planeta['planeta'];
                                            $procentiProc[]=$testStub['procenat'];
                                            $ceotest[]=$testStub; 
                                        }
                                    }
                                    $testOpis = implode(', ',$zaopis);
                                    array_multisort($procentiProc,SORT_NUMERIC, SORT_DESC, $zaopis);
                                    if (count($testPlanete)==1 && $testPlanete[0]!='') {
                                         $jedantest['samojedna']=1;
                                      $tessssem = $db->query_first("SELECT planeta from cakre where ID =$testPlanete[0] ");
                                      $jedantest['disbalans']=$tessssem['planeta'].'-'.$zaopis[0];  
                                    }
                                    else $jedantest['disbalans']=$zaopis[0];
                                     if (count($testPlanete)==10)
                                        $tessss = 'KOMPLETAN TEST '.strtoupper($testovi['tip']);
                                       else {
                                        unset($tesssses);
                                        foreach($testPlanete as $plantest){
                                            if ($plantest!='')
                                            $tesssse = $db->query_first("SELECT planeta from cakre where ID =$plantest ");
                                            $tesssses[] = $tesssse['planeta'];
                                        }
                                        $tessss = implode(', ',$tesssses);
                                        $tessss .= ' '.strtoupper($testovi['tip']);
                                       }
                                    $jedantest['planete']=$tessss;
                                    $jedantest['tip']=$testovi['tip'];
                                    $jedantest['datum']=$testovi['vreme'];
                                    $jedantest['vreme']=$testovi['vreme'];
                                    $jedantest['broj']=$broj;
                                    $jedantest['stubovi']=$ceotest;
                                    $jedantest['test_cilja']=$testCiljTekst;
                                    $broj++;
                                    $svitesss[]=$jedantest;
                                    unset($ceotest,$jedantest,$procentiPlan,$procentiProc,$zaopis);
                                }
                                } // End of if(is_array($sviTestovi))

                                  if(isset($svitesss) && count($svitesss) > 0) {
                                      // Format data to match the structure expected by test-levo.tpl
                                      // Each test should be wrapped as a consultation with modules
                                      $formatiranTestovi = array();
                                      foreach($svitesss as $test) {
                                          $jednaKonsultacija = array();
                                          // First element: consultation data with date
                                          $jednaKonsultacija[] = array('datum' => $test['datum']);
                                          // Second element: rendered test HTML
                                          $smarty->assign('graf', $test);
                                          $jednaKonsultacija[] = $smarty->fetch('testGraf-full.tpl');
                                          $smarty->clearAssign('graf');
                                          $formatiranTestovi[] = $jednaKonsultacija;
                                      }
                                      $smarty->assign('nevezaniTestovi', $formatiranTestovi);
                                  } 
                                  
                                  // Add test icons for tests that need to be taken
                                  if(isset($standaloneTestIcons) && count($standaloneTestIcons) > 0) {
                                      // Format for accordion display with test module
                                      if(!isset($formatiranTestovi)) {
                                          $formatiranTestovi = array();
                                      }
                                      
                                      foreach($standaloneTestIcons as $testIcon) {
                                          $jednaKonsultacija = array();
                                          // First element: consultation data with date
                                          $jednaKonsultacija[] = array('datum' => $testIcon['datum']);
                                          // Second element: render test icon
                                          $smarty->assign('modultest', array($testIcon));
                                          $testHtml = $smarty->fetch('moduli/test.tpl');
                                          $smarty->clearAssign('modultest');
                                          $jednaKonsultacija[] = $testHtml;
                                          $formatiranTestovi[] = $jednaKonsultacija;
                                      }
                                      
                                      $smarty->assign('nevezaniTestovi', $formatiranTestovi);
                                  }
                                  
                                  // ===== TS (Tehnologija Svesti) TESTS =====
                                  // Load all TS tests for this user
                                  $sveplanete = $db->fetch_array("SELECT * FROM cakre");
                                  $tsPredTestovi = $db->fetch_array("SELECT * FROM ts_test WHERE korisnik='".$_SESSION['logged']."' AND tip='predtest' ORDER BY vreme DESC");
                                  
                                  $tsTestIconsToTake = array(); // Tests that need to be taken
                                  $tsCompletedTests = array(); // Completed tests with results
                                  
                                  foreach($tsPredTestovi as $pred) {
                                      // Get planet name
                                      $planeta = $db->query_first("SELECT planeta FROM cakre WHERE ID='".$pred['planeta']."'");
                                      $pred['nazivPlanete'] = $planeta['planeta'];
                                      
                                      // Check if pretest is completed
                                      if ($pred['uradjen'] == 0) {
                                          // Pretest not done - add to icons list
                                          $tsTestIconsToTake[] = array(
                                              'id' => $pred['id'],
                                              'tip' => 'predtest',
                                              'planeta' => $pred['nazivPlanete'],
                                              'datum' => $pred['vreme']
                                          );
                                          continue;
                                      }
                                      
                                      // Pretest is done - check for posttest
                                      $tsPostTest = $db->query_first("SELECT * FROM ts_test WHERE korisnik='".$_SESSION['logged']."' AND tip='posttest' AND planeta='".$pred['planeta']."'");
                                      
                                      if ($tsPostTest) {
                                          // Posttest exists
                                          if ($tsPostTest['uradjen'] == 0) {
                                              // Check if it's time to take posttest
                                              if (strtotime($tsPostTest['vreme']) <= time()) {
                                                  // Time to take posttest
                                                  $tsTestIconsToTake[] = array(
                                                      'id' => $tsPostTest['id'],
                                                      'tip' => 'posttest',
                                                      'planeta' => $pred['nazivPlanete'],
                                                      'datum' => $tsPostTest['vreme']
                                                  );
                                              }
                                              continue;
                                          }
                                          
                                          // Both tests completed - prepare graphs
                                          $pred['post'] = $tsPostTest;
                                      }
                                      
                                      // Only show graphs if pretest is completed
                                      if ($pred['uradjen'] == 1) {
                                          // Calculate pretest results
                                          $ceotest = array();
                                          foreach($sveplanete as $planeta) {
                                              $testStub = array();
                                              $testStub['planeta'] = $planeta['planeta'];
                                              $testStub['znak'] = $planeta['znak'];
                                              $testStub['boja'] = $planeta['boja'];
                                              
                                              $odgovori = $db->query_first("SELECT SUM(o.odgovor) as total FROM ts_odgovori o LEFT JOIN ts_pitanja p ON (p.id=o.pitanje) WHERE o.test='".$pred['id']."' AND p.planeta='".$planeta['cakra']."'");
                                              $totalBroj = $db->fetch_array("SELECT p.pitanje, c.planeta, p.zivotinja, p.cakra, p.nivo, o.odgovor as total FROM ts_odgovori o LEFT JOIN ts_pitanja p ON (p.id=o.pitanje) LEFT JOIN cakre c ON (c.cakra = p.planeta) WHERE o.test='".$pred['id']."' AND p.planeta='".$planeta['cakra']."'");
                                              
                                              if (count($totalBroj) == 0) {
                                                  $testStub['procenat'] = 0;
                                              } else {
                                                  $testStub['procenat'] = $odgovori['total'] / (count($totalBroj) * 10) * 100;
                                              }
                                              
                                              $testStub['pitanja'] = $totalBroj;
                                              $ceotest[] = $testStub;
                                              
                                              // Calculate posttest results if exists and completed
                                              if (isset($tsPostTest) && $tsPostTest['uradjen'] == 1) {
                                                  $testStub2 = array();
                                                  $testStub2['planeta'] = $planeta['planeta'];
                                                  $testStub2['znak'] = $planeta['znak'];
                                                  $testStub2['boja'] = $planeta['boja'];
                                                  
                                                  $odgovori2 = $db->query_first("SELECT SUM(o.odgovor) as total FROM ts_odgovori o LEFT JOIN ts_pitanja p ON (p.id=o.pitanje) WHERE o.test='".$tsPostTest['id']."' AND p.planeta='".$planeta['cakra']."'");
                                                  $totalBroj2 = $db->fetch_array("SELECT p.pitanje, c.planeta, p.zivotinja, p.cakra, p.nivo, o.odgovor as total FROM ts_odgovori o LEFT JOIN ts_pitanja p ON (p.id=o.pitanje) LEFT JOIN cakre c ON (c.cakra = p.planeta) WHERE o.test='".$tsPostTest['id']."' AND p.planeta='".$planeta['cakra']."'");
                                                  
                                                  if (count($totalBroj2) == 0) {
                                                      $testStub2['procenat'] = 0;
                                                  } else {
                                                      $testStub2['procenat'] = $odgovori2['total'] / (count($totalBroj2) * 10) * 100;
                                                  }
                                                  
                                                  $testStub2['pitanja'] = $totalBroj2;
                                                  $ceotest2[] = $testStub2;
                                              }
                                          }
                                          
                                          $pred['stubovi'] = $ceotest;
                                          
                                          if (isset($ceotest2)) {
                                              $pred['post']['stubovi'] = $ceotest2;
                                              unset($ceotest2);
                                          }
                                          
                                          $tsCompletedTests[] = $pred;
                                          unset($ceotest);
                                      }
                                  }
                                  
                                  // Add TS test icons to display
                                  if (count($tsTestIconsToTake) > 0) {
                                      if(!isset($formatiranTestovi)) {
                                          $formatiranTestovi = array();
                                      }
                                      
                                      foreach($tsTestIconsToTake as $tsIcon) {
                                          $jednaKonsultacija = array();
                          $jednaKonsultacija[] = array(
                              'datum' => $tsIcon['datum'],
                              'planeta' => $tsIcon['planeta'],
                              'tipTekst' => 'TS test'
                          );
                          
                          // Render TS test icon
                          $smarty->assign('tsTestIcon', $tsIcon);
                          $tsTestHtml = $smarty->fetch('moduli/tsTest.tpl');
                          $smarty->clearAssign('tsTestIcon');
                          $jednaKonsultacija[] = $tsTestHtml;
                          $formatiranTestovi[] = $jednaKonsultacija;
                      }
                      
                      $smarty->assign('nevezaniTestovi', $formatiranTestovi);
                  }
                  
                  // Add TS completed tests with graphs
                  if (count($tsCompletedTests) > 0) {
                      if(!isset($formatiranTestovi)) {
                          $formatiranTestovi = array();
                      }
                      
                      foreach($tsCompletedTests as $tsTest) {
                          $jednaKonsultacija = array();
                          $jednaKonsultacija[] = array(
                              'datum' => $tsTest['vreme'],
                              'planeta' => $tsTest['nazivPlanete'],
                              'tipTekst' => 'TS test'
                          );
                          
                          // Render TS test results
                          $smarty->assign('tsTest', $tsTest);
                          $tsResultsHtml = $smarty->fetch('moduli/tsTestResults.tpl');
                          $smarty->clearAssign('tsTest');
                          $jednaKonsultacija[] = $tsResultsHtml;
                          $formatiranTestovi[] = $jednaKonsultacija;
                      }
                      
                      $smarty->assign('nevezaniTestovi', $formatiranTestovi);
                  }
                  
                  // ===== MERIDIJAN TESTS =====
                  // Load all meridijan tests for this user
                  $meridijanTestovi = $db->fetch_array("SELECT * FROM meridijani_test WHERE korisnik='".$_SESSION['logged']."' ORDER BY COALESCE(datum, id) DESC");
                  
                  $meridijanTestIconsToTake = array(); // Tests that need to be taken
                  $meridijanCompletedTests = array(); // Completed tests with results
                  
                  if(is_array($meridijanTestovi) && count($meridijanTestovi) > 0){
                      foreach($meridijanTestovi as $mTest) {
                          // Add meridijan name/ID to display
                          $mTest['nazivMeridijana'] = 'Meridijan ' . $mTest['meridijan'];
                          
                          if ($mTest['uradjen'] == 0) {
                              // Test not done - add to icons list
                              $meridijanTestIconsToTake[] = array(
                                  'id' => $mTest['id'],
                                  'meridijan' => $mTest['meridijan'],
                                  'nazivMeridijana' => $mTest['nazivMeridijana'],
                                  'datum' => !empty($mTest['datum']) ? $mTest['datum'] : (isset($mTest['vreme']) ? $mTest['vreme'] : null)
                              );
                          } else {
                              // Test completed - prepare for results display
                              $meridijanCompletedTests[] = $mTest;
                          }
                      }
                  }
                  
                  // Add meridijan test icons to display
                  if (count($meridijanTestIconsToTake) > 0) {
                      if(!isset($formatiranTestovi)) {
                          $formatiranTestovi = array();
                      }
                      
                      foreach($meridijanTestIconsToTake as $mIcon) {
                          $jednaKonsultacija = array();
                          $jednaKonsultacija[] = array(
                              'datum' => $mIcon['datum'],
                              'planeta' => $mIcon['nazivMeridijana'],
                              'tipTekst' => 'Meridijanski test'
                          );
                          
                          // Render meridijan test icon
                          $smarty->assign('meridijanTestIcon', $mIcon);
                          $mTestHtml = $smarty->fetch('moduli/meridijanTest.tpl');
                          $smarty->clearAssign('meridijanTestIcon');
                          $jednaKonsultacija[] = $mTestHtml;
                          $formatiranTestovi[] = $jednaKonsultacija;
                      }
                      
                      $smarty->assign('nevezaniTestovi', $formatiranTestovi);
                  }
                  
                  // Add meridijan completed tests with results
                  if (count($meridijanCompletedTests) > 0) {
                      if(!isset($formatiranTestovi)) {
                          $formatiranTestovi = array();
                      }
                      
                      foreach($meridijanCompletedTests as $mTest) {
                          $jednaKonsultacija = array();
                          $jednaKonsultacija[] = array(
                              'datum' => !empty($mTest['datum']) ? $mTest['datum'] : (isset($mTest['vreme']) ? $mTest['vreme'] : null),
                              'planeta' => $mTest['nazivMeridijana'],
                              'tipTekst' => 'Meridijanski test'
                          );
                          
                          // Render meridijan test results
                          $smarty->assign('meridijanTest', $mTest);
                          $mResultsHtml = $smarty->fetch('moduli/meridijanTestResults.tpl');
                          $smarty->clearAssign('meridijanTest');
                          $jednaKonsultacija[] = $mResultsHtml;
                          $formatiranTestovi[] = $jednaKonsultacija;
                      }
                      
                      $smarty->assign('nevezaniTestovi', $formatiranTestovi);
                  }

                  // Final sort for all standalone tests by date (newest first)
                  if (isset($formatiranTestovi) && count($formatiranTestovi) > 1) {
                      usort($formatiranTestovi, function($a, $b) {
                          $dateA = isset($a[0]['datum']) ? strtotime($a[0]['datum']) : 0;
                          $dateB = isset($b[0]['datum']) ? strtotime($b[0]['datum']) : 0;
                          if ($dateA === $dateB) {
                              return 0;
                          }
                          return ($dateA < $dateB) ? 1 : -1;
                      });
                      $smarty->assign('nevezaniTestovi', $formatiranTestovi);
                  }

?>
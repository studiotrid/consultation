<?php
$sviTestovi = $db->fetch_array("SELECT * from test where konsultacija='".$konsultacija['id']."' and korisnik='$ulogovan' and planete != ''");
$broj=0;
foreach($sviTestovi as $testovi){
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $testPlanete=explode(',',$testovi['planete']);
                if (count($testPlanete)>1){
                    $sveplanete=$db->fetch_array("SELECT * from cakre ");
                    foreach($sveplanete as $planeta){
                      //  $stub=$db->query_first("SELECT * from cakre where cakra in ('".$testovi['planete']."')");
                        
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
                      //  $stub=$db->query_first("SELECT * from cakre where cakra in ('".$testovi['planete']."')");
                        
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
                        
                        
                      //  if(in_array($planeta['cakra'],$testPlanete)) {
                            $zaopis[]=$planeta['planeta'];
                            $procentiProc[]=$testStub['procenat'];
                            
                      //  }
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
                
               //$jedantest['planete']=$testOpis;
                $jedantest['datum']=$testovi['vreme'];
                $jedantest['broj']=$broj;
                $jedantest['stubovi']=$ceotest;
 
                $broj++;
                $svitesss[]=$jedantest;
                unset($ceotest,$jedantest,$procentiPlan,$procentiProc,$zaopis);
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               
  }
  if(isset($svitesss) && count($svitesss)>0)
    $ss['graf']= $svitesss;      
  
  unset($svitesss);
?>
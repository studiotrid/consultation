<?php

class Konsultacije
{
				private $db;
				static private $_instance = null;
                
				private function __construct(){
					$this->db = Database::obtain();
				}
                
                static public function getInstance(){
					if (self::$_instance == null)	
							self::$_instance = new Konsultacije();
						
					return self::$_instance;

				}

				public function setDatabase(PDO $database) {
					$this->db = $database;
				}
                
                public function getDefaultZaTip($tip){
                    $tt = $this->db->query_first("SELECT opis,slika from konsultacije_tip where id=$tip");
                    return $tt;
                }
                
                public function getCoachTermini($user){
                    $coach = $this->db->query_first("SELECT coach from korisnici where id=$user");
                    
                    $tt = $this->db->fetch_array("SELECT id,datum from coach_termini where coach='".$coach['coach']."' and status=1 and datum>now()");
                    if(isset($tt) && count($tt)>0)
                    return $tt;
                    else return false;
                }
                
                public function brojKonsultacija($user,$konsultacija){
                    $total = 0;
                    
                    $tt = $this->db->query_first("SELECT count(*) as broj from konsultacije where user_id ='$user' and tip='$konsultacija'");
                    if($tt['broj']!='') $total=$tt['broj'];
                    
                    return $total;
                    }
                    
                    
                public function getSve($tip,$user){
                    
                  //  $sve = array();
                    
                    $sveKonsultacije = $this->db->fetch_array("SELECT id from konsultacije where tip='$tip' and user_id='$user' and startTime < now() order by startTime desc");
                    
                    if(!isset($sveKonsultacije) or count($sveKonsultacije)==0){
                        $sve = $this->getDefaultZaTip($tip);
                    }
                    else
                        foreach($sveKonsultacije as $kons){
                            $sve[]=$this->getKonsultacija($kons['id']);
                        }
                    return $sve;
                }    
                
                
                
                public function getKonsultacija($id){
                    global $smarty;
                    
                    $konsult = $this->db->query_first("SELECT k.*,t.naziv from konsultacije k left join konsultacije_tip t on (k.tip=t.id) where k.id='$id' ");
                    $nextKonsult = $this->db->query_first("SELECT startTime from konsultacije where tip='".$konsult['tip']."' and user_id = '".$konsult['user_id']."' and startTime>now() order by startTime asc ");
                    if(isset($nextKonsult['startTime']) && $nextKonsult['startTime']!='') $konsult['nextConsult']=$nextKonsult['startTime'];
                    $mod[] = $konsult;
                    $moduli = $this->db->fetch_array("SELECT * from konsultacije_moduli where konsultacija='".$konsult['tip']."' order by redosled");
                    foreach($moduli as $modul){
                        $tip = $this->db->query_first("SELECT * from moduli where id='".$modul['modul']."'");
                        switch($tip['type']){
                            case 'cart':
                                $natalna=$this->db->query_first("SELECT cart from korisnici where id='".$konsult['user_id']."'");
                                $smarty->assign('modul'.$tip['type'], $natalna['cart']);
                            break;
                            
                            case 'test':
                                $testovi = $this->db->fetch_array("SELECT ispit_termini.*,afirmacije_centri.padez,afirmacije_centri.planetaen FROM ispit_termini left join afirmacije_centri on (ispit_termini.centar = afirmacije_centri.centar) WHERE ispit_termini.test = '".$id."' order by ispit_termini.datum");
                                $ss['test']=$testovi;
                                
                                foreach($testovi as $ovajTest){
                                    if ($ovajTest['datum']<date('Y-m-d')){
                                        
                                        $prikaziTest['planeta']=$ovajTest['planetaen'];
                                        $prikaziTest['planetaen']=$ovajTest['planetaen'];
                                        $prikaziTest['centar']=$ovajTest['centar'];
                                        $prikaziTest['id']=$ovajTest['ID'];
                                        $prikaziTest['intenzitet']=$ovajTest['intenzitet'];
                                        $prikaziTest['datum']=$ovajTest['datum'];
                                        $prikaziTest['vreme']=$ovajTest['vreme'];
                                        if($ovajTest['uspeh']=='') $smarty->assign('modul'.$tip['type'], $prikaziTest);
                                    }
                                }
                                
                                
                                $sviTestovi = $this->db->fetch_array("SELECT * from test where konsultacija='".$id."' and planete != ''");
                                $broj=0;
                                foreach($sviTestovi as $testovi){
                                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                                $testPlanete=explode(',',$testovi['planete']);
                                                if (count($testPlanete)>1){
                                                    $sveplanete=$this->db->fetch_array("SELECT * from cakre ");
                                                    foreach($sveplanete as $planeta){
                                                      //  $stub=$db->query_first("SELECT * from cakre where cakra in ('".$testovi['planete']."')");
                                                        
                                                        $testStub['planeta']=$planeta['planeta'];
                                                        $testStub['znak']=$planeta['znak'];
                                                        
                                                        $testStub['boja']=$planeta['boja'];
                                                        
                                                        $odgovori = $this->db->query_first("SELECT sum(odgovori.odgovor) as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) where odgovori.test='".$testovi['ID']."' and pitanja.cakra='".$planeta['cakra']."'");
                                                        $totalBroj = $this->db->fetch_array("SELECT pitanja.pitanje,cakre.planeta,pitanja.planeta as cakra,pitanja.zivotinja,pitanja.nivo,odgovori.odgovor as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) left join cakre on (cakre.cakra = pitanja.cakra ) where odgovori.test='".$testovi['ID']."' and pitanja.cakra='".$planeta['cakra']."'");
                                
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
                                                    
                                                    $sveplanete=$this->db->fetch_array("SELECT * from cakre ");
                                                    foreach($sveplanete as $planeta){
                                                      //  $stub=$db->query_first("SELECT * from cakre where cakra in ('".$testovi['planete']."')");
                                                        
                                                        $testStub['planeta']=$planeta['planeta'];
                                                        $testStub['znak']=$planeta['znak'];
                                                       
                                                        $testStub['boja']=$planeta['boja'];
                                                        
                                                        $odgovori = $this->db->query_first("SELECT sum(odgovori.odgovor) as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) where odgovori.test='".$testovi['ID']."' and pitanja.planeta='".$planeta['cakra']."' ");
                                                        $totalBroj = $this->db->fetch_array("SELECT pitanja.pitanje,cakre.planeta,pitanja.zivotinja,pitanja.cakra,pitanja.nivo,odgovori.odgovor as total from odgovori left join pitanja on (pitanja.ID=odgovori.pitanje) left join cakre on (cakre.cakra = pitanja.planeta ) where odgovori.test='".$testovi['ID']."' and pitanja.planeta='".$planeta['cakra']."' ");
                                
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
                                                  $tessssem = $this->db->query_first("SELECT planeta from cakre where ID =$testPlanete[0] ");
                                                  $jedantest['disbalans']=$tessssem['planeta'].'-'.$zaopis[0];  
                                                }
                                                else $jedantest['disbalans']=$zaopis[0];
                                                
                                                 if (count($testPlanete)==10)
                                                    $tessss = 'KOMPLETAN TEST '.strtoupper($testovi['tip']);
                                                   else {
                                                    unset($tesssses);
                                                    foreach($testPlanete as $plantest){
                                                        if ($plantest!='')
                                                        $tesssse = $this->db->query_first("SELECT planeta from cakre where ID =$plantest ");
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
                                     $smarty->assign('modul'.$tip['type'].'Test', $svitesss);   
                                    
                                
                            break;
                            
                            default:
                                $smarty->assign('modul'.$tip['type'], $konsult[$tip['type']]);
                            break;
                        }
                        
                        $mod[] = $smarty->fetch('moduli/'.$tip['template']);
                    }
                    return $mod;
                }
                    
                public function getLast($user){
                    $last = $this->db->query_first("SELECT * from konsultacije where user_id='$user' and startTime < now() order by startTime desc");
                    if($last['id']!='')
                        return $this->getKonsultacija($last['id']);
                    else return false;
                    }
                    
                public function getSveTipove($coach,$user){
                    if($coach!='' && $user!=''){
                        $konsultacije = array();
                        $sve = $this->db->fetch_array("SELECT k.* from konsultacije_coach o left join konsultacije_tip k on (o.konsultacija=k.id) where k.logo!='' and o.coach='$coach'  and k.aktivan=1");
                        foreach($sve as $svi){
                            $svi['koliko']=$this->brojKonsultacija($user,$svi['id']);
                            $konsultacije[]=$svi;
                        }
                        return $konsultacije;
                    }
                    else return false;
                }
    }
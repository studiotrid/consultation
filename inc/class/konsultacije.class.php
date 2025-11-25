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
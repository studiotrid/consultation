<?php

class Konsultacije
{
				private $db;
				static private $_instance = null;
                
				private function __construct(){
					$this->db = Database::obtain();
				}

                public function getTestCiljAnswerColumn()
                {
                    $tableExists = $this->db->query_first("SHOW TABLES LIKE 'test_cilja'");
                    if (!$tableExists) {
                        return null;
                    }

                    $columns = $this->db->fetch_array("SHOW COLUMNS FROM test_cilja");
                    if (!$columns || !is_array($columns)) {
                        return null;
                    }

                    $preferred = array('odgovor', 'tekst', 'text', 'opis', 'sadrzaj', 'note', 'napomena', 'content', 'body');
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
                
                static public function getInstance(){
					if (self::$_instance == null)	
							self::$_instance = new Konsultacije();
						
					return self::$_instance;

				}

				public function setDatabase(PDO $database) {
					$this->db = $database;
				}
                
                private function getDayNameEnglish($dayName){
                    $daysMap = array(
                        'понедељак' => 'Monday',
                        'уторак' => 'Tuesday',
                        'среда' => 'Wednesday',
                        'четвртак' => 'Thursday',
                        'петак' => 'Friday',
                        'суббота' => 'Saturday',
                        'недеља' => 'Sunday'
                    );
                    return isset($daysMap[$dayName]) ? $daysMap[$dayName] : $dayName;
                }

                private function getDayNameLatin($dayName){
                    $daysMap = array(
                        'понедељак' => 'ponedeljak',
                        'уторак' => 'utorak',
                        'среда' => 'sreda',
                        'четвртак' => 'četvrtak',
                        'петак' => 'petak',
                        'субота' => 'subota',
                        'суббота' => 'subota',
                        'недеља' => 'nedelja',
                        'ponedeljak' => 'ponedeljak',
                        'utorak' => 'utorak',
                        'sreda' => 'sreda',
                        'četvrtak' => 'četvrtak',
                        'petak' => 'petak',
                        'subota' => 'subota',
                        'nedelja' => 'nedelja'
                    );
                    return isset($daysMap[$dayName]) ? $daysMap[$dayName] : $dayName;
                }
                
                public function getDefaultZaTip($tip, $user = null){
                    // Ako je user prosleđen, proveri da li postoji personalizovan tekst od coach-a
                    if($user !== null) {
                        // Pronađi coach-a za korisnika
                        $korisnik = $this->db->query_first("SELECT coach FROM korisnici WHERE id='$user'");
                        
                        if(isset($korisnik['coach']) && $korisnik['coach'] != '') {
                            // Proveri da li coach ima personalizovan tekst za ovaj tip konsultacije
                            $coachTekst = $this->db->query_first("SELECT opis, slika FROM konsultacije_coach WHERE konsultacija='$tip' AND coach='".$korisnik['coach']."'");
                            
                            // Ako postoji i ako ima popunjeno opis ili slika, koristi taj tekst
                            if(isset($coachTekst) && ($coachTekst['opis'] != '' || $coachTekst['slika'] != '')) {
                                return $coachTekst;
                            }
                        }
                    }
                    
                    // Inače koristi default tekst iz konsultacije_tip
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
                        $sve = $this->getDefaultZaTip($tip, $user);
                    }
                    else
                        foreach($sveKonsultacije as $kons){
                            $sve[]=$this->getKonsultacija($kons['id']);
                        }
                    return $sve;
                }    
                
                public function getBuduce($user, $tip = null){
                    $userId = intval($user);
                    $tipFilter = '';
                    if ($tip !== null && $tip !== '' && is_numeric($tip)) {
                        $tipFilter = " AND k.tip='".intval($tip)."'";
                    }
                    $upcoming = $this->db->fetch_array("SELECT k.id,k.tip,k.startTime,k.faza,k.brojKonsultacijeUFazi,t.naziv FROM konsultacije k LEFT JOIN konsultacije_tip t ON (k.tip=t.id) WHERE k.user_id='".$userId."' and k.startTime>now()".$tipFilter." order by k.startTime asc");
                    if(isset($upcoming) && is_array($upcoming) && count($upcoming)>0){
                        return $upcoming;
                    }
                    return array();
                }
                
                
                
                public function getKonsultacija($id){
                    global $smarty;
                    
                    // Ensure module-scoped Smarty variables are cleared per consultation to avoid leakage
                    $moduleVarsToClear = array(
                        'modulcart',
                        'modulvenera_chart',
                        'modulvideo',
                        'modulvodjene',
                        'modulvenera_video',
                        'modulfrekvencija',
                        'modulafirmacija',
                        'modultest',
                        'modultestTest',
                        'modulupitnik',
                        'modulrituali',
                        'moduliskustvo',
                        'modulmeditacija',
                        'modulvideoMT',
                        'modulaudio',
                        'modulnapomena',
                        'modulbalans_napomena',
                        'modulzmaj',
                        'modulvezbe',
                        'modulvodic',
                        'modulvodjena',
                        'modulkamen',
                        'modulandjeo',
                        'modulandjeo_faza2_veza',
                        'modulkarmicko_uverenje_zivot',
                        'modultermini',
                        'modulaktiviranje',
                        'modulaktiviranje_karmicke_vertikale'
                    );
                    foreach ($moduleVarsToClear as $mv) {
                        $smarty->clearAssign($mv);
                    }
                    
                    $konsult = $this->db->query_first("SELECT k.*,t.naziv from konsultacije k left join konsultacije_tip t on (k.tip=t.id) where k.id='$id' ");
                    $nextKonsult = $this->db->query_first("SELECT startTime from konsultacije where tip='".$konsult['tip']."' and user_id = '".$konsult['user_id']."' and startTime>now() order by startTime asc ");
                    if(isset($nextKonsult['startTime']) && $nextKonsult['startTime']!='') $konsult['nextConsult']=$nextKonsult['startTime'];
                    
                    // Formatiraj naziv sa fazom ako postoji
                    if(isset($konsult['faza']) && isset($konsult['brojKonsultacijeUFazi']) && 
                       intval($konsult['faza']) > 0 && intval($konsult['brojKonsultacijeUFazi']) > 0) {
                        $konsult['naziv'] = $konsult['naziv'] . ' ' . $konsult['faza'] . '/' . $konsult['brojKonsultacijeUFazi'];
                    }
                    
                    $mod[] = $konsult;
                    $moduli = $this->db->fetch_array("SELECT * from konsultacije_moduli where konsultacija='".$konsult['tip']."' order by redosled");
                    
                    // Kreiraj array sa ID-evima već dodeljenih modula da bi se izbegla duplikacija
                    $dodeljeniModuliIds = array();
                    if(is_array($moduli)){
                        foreach($moduli as $m){
                            $dodeljeniModuliIds[] = $m['modul'];
                        }
                    }
                    
                    // Učitaj globalne module koji nisu već dodeljeni ovoj konsultaciji
                    $globalniModuli = $this->db->fetch_array("SELECT * from moduli where global = 1 order by id");
                    if(is_array($globalniModuli)){
                        foreach($globalniModuli as $globalniModul){
                            // Proveri da li je globalni modul već dodeljen konsultaciji
                            if(!in_array($globalniModul['id'], $dodeljeniModuliIds)){
                                // Skip module 2 (napomena) - should not be visible to users
                                // Skip module 24 (disbalans) - should not be visible to users
                                // Skip module 15 (iskustvo) jer se obrađuje odvojeno na kraju funkcije
                                if(in_array($globalniModul['id'], array(2, 15, 24))){
                                    continue;
                                }
                                
                                // Dodaj globalni modul u listu modula sa simuliranom strukturom konsultacije_moduli
                                $moduli[] = array(
                                    'modul' => $globalniModul['id'],
                                    'redosled' => 9999 + $globalniModul['id'], // Postavi visok redosled da budu na kraju
                                    'konsultacija' => $konsult['tip']
                                );
                            }
                        }
                    }
                    
                    foreach($moduli as $modul){
                        $shouldRenderModule = true;
                        $tip = $this->db->query_first("SELECT * from moduli where id='".$modul['modul']."'");
                        
                        // Skip module with ID 2 (napomena) - should not be visible to users
                        if($modul['modul'] == 2){
                            continue;
                        }
                        
                        // Skip module with ID 24 (disbalans) - should not be visible to users
                        if($modul['modul'] == 24){
                            continue;
                        }
                        
                        $skipSwitch = false;

                        // Inkarnacije module (ID: 27)
                        if($modul['modul'] == 27){
                            $inkarnacije = array(
                                'prethodna_cart' => isset($konsult['prethodna_cart']) ? $konsult['prethodna_cart'] : '',
                                'prethodna_pol' => isset($konsult['prethodna_pol']) ? $konsult['prethodna_pol'] : '',
                                'naredna_cart' => isset($konsult['naredna_cart']) ? $konsult['naredna_cart'] : '',
                                'naredna_pol' => isset($konsult['naredna_pol']) ? $konsult['naredna_pol'] : ''
                            );

                            $hasInkarnacije = false;
                            foreach ($inkarnacije as $val) {
                                if (isset($val) && trim($val) !== '') {
                                    $hasInkarnacije = true;
                                    break;
                                }
                            }

                            if($hasInkarnacije){
                                $smarty->assign('modulinkarnacije', $inkarnacije);
                                $tip['type'] = 'inkarnacije';
                                $tip['template'] = 'inkarnacije.tpl';
                                $skipSwitch = true;
                            } else {
                                $shouldRenderModule = false;
                                $skipSwitch = true;
                            }
                        }

                        // Materijal module (ID: 28)
                        if($modul['modul'] == 28){
                            $tip['type'] = 'materijal';
                            $tip['template'] = 'materijal.tpl';
                        }

                        // Karmicko uverenje zivot module (ID: 100)
                        if($modul['modul'] == 100){
                            $tip['type'] = 'karmicko_uverenje_zivot';
                            $tip['template'] = 'karmicko_uverenje_zivot.tpl';
                        }

                        // Senka module (ID: 101)
                        if($modul['modul'] == 101){
                            $tip['type'] = 'senka';
                            $tip['template'] = 'senka.tpl';
                        }

                        // Meditacija tekst module (ID: 102)
                        if($modul['modul'] == 102){
                            $tip['type'] = 'meditacija_tekst';
                            $tip['template'] = 'meditacija_tekst.tpl';
                        }

                        // Aktiviranje karmickih vertikala module (ID: 103)
                        if($modul['modul'] == 103){
                            $tip['type'] = 'aktiviranje_karmicke_vertikale';
                            $tip['template'] = 'aktiviranje_karmicke_vertikale.tpl';
                        }

                        // Andjeo veza sa prethodnim zivotom (ID: 105)
                        if($modul['modul'] == 105){
                            $tip['type'] = 'andjeo_faza2_veza';
                            $tip['template'] = 'andjeo_faza2_veza.tpl';
                        }

                        if(!$skipSwitch){
                        switch($tip['type']){
                            case 'cart':
                                // Prefer consultation-specific natal chart, fallback to user's default cart
                                $userCart = $this->db->query_first("SELECT cart FROM korisnici WHERE id='".$konsult['user_id']."'");
                                $cartFile = '';

                                if(isset($konsult['natalna']) && $konsult['natalna'] != ''){
                                    $cartFile = $konsult['natalna'];
                                } elseif(isset($userCart['cart']) && $userCart['cart'] != '') {
                                    $cartFile = $userCart['cart'];
                                }

                                if($cartFile != ''){
                                    $smarty->assign('modul'.$tip['type'], $cartFile);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            
                            case 'venera_chart':
                                if($konsult['venera_chart1']!='')
                                    $ret[]=$konsult['venera_chart1'];
                                
                                if($konsult['venera_chart2']!='')
                                    $ret[]=$konsult['venera_chart2'];
                                
                                if($konsult['venera_chart3']!='')
                                    $ret[]=$konsult['venera_chart3'];
                                
                                if($konsult['venera_chart4']!='')
                                    $ret[]=$konsult['venera_chart4'];
                                    
                                if($konsult['venera_chart5']!='')
                                    $ret[]=$konsult['venera_chart5'];
                                                                    
                                if(isset($ret))
                                    $smarty->assign('modulvenera_chart',$ret);
                                unset($ret);
                            break;
                            
                            case 'cakra':
                                $frekvencija=$this->db->query_first("SELECT * from astrolosko_cakre WHERE id = '".$konsult['cakra']."'");
                                if(isset($frekvencija['vimeo']) && $frekvencija['vimeo']!='')
                                $smarty->assign('modulvideo',$frekvencija['vimeo']);
                            break;
                            
                            case 'vodjene':
                                if($konsult['balance1']==1){
                                    $ss['tekst']=_("Isceljenje rana unutrašnjeg deteta");
                                    $ss['url']='01.mp3';
                                    $ret[]=$ss;
                                    unset($ss);
                                }
                                if($konsult['balance2']==1){
                                    $ss1['tekst']=_("Osvešćivanje i izražavanje svoje lepote");
                                    $ss1['url']='02.mp3';
                                    $ret[]=$ss1;
                                    unset($ss1);
                                }
                                if($konsult['balance3']==1){
                                    $ss2['tekst']=_("Odlazak u daleka sećanja iz detinjstva");
                                    $ss2['url']='03.mp3';
                                    $ret[]=$ss2;
                                    unset($ss2);
                                }
                                if(isset($ret))
                                    $smarty->assign('modulvodjene',$ret);
                                unset($ret);
                            break;
                            
                            case "venera_video":
                                if($konsult['venera_video']!=''){
                                    $frekvencija=$this->db->query_first("SELECT link from venera_video WHERE id = '".$konsult['venera_video']."'");
                                   if(isset($frekvencija)){
                 
                                    
                                    $smarty->assign('modulvenera_video',$frekvencija['link']);
                                    }
                                }
                            break;
                            
                            case "Kosmicka-poruka":
                                $kpFaza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;
                                if ($kpFaza === 0) {
                                    $shouldRenderModule = false;
                                    break;
                                }

                                if ($kpFaza === 1 || $kpFaza === 3) {
                                    $kpNaslov = 'Karmičko Uverenje Duše kroz inkarnacije';
                                } elseif ($kpFaza === 2 || $kpFaza === 4) {
                                    $kpNaslov = 'OTKRIVANJE UVERENJA';
                                } else {
                                    $kpNaslov = 'PORUKA VIŠEG JA';
                                }

                                if (empty($konsult['kosmicka_pocinje_od_datuma']) || empty($konsult['kosmicka_ukupan_broj_dana'])) {
                                    $shouldRenderModule = false;
                                    break;
                                }

                                $kpStart     = $konsult['kosmicka_pocinje_od_datuma'];
                                $kpBrojDana  = intval($konsult['kosmicka_ukupan_broj_dana']);
                                $kpDigitalno = intval($konsult['kosmicka_digitalno_izvlacenje']);
                                $kpBottomUp  = ($kpFaza === 3) ? 1 : 0;
                                $kpIsFaza2   = ($kpFaza === 2 || $kpFaza === 4);
                                $kpImgBase   = $kpIsFaza2 ? '/img/boginje' : '/img/konstelacija';
                                $kpBackImg   = $kpImgBase . '/0.jpg';
                                $kpKeyBeliefId = $kpIsFaza2 ? intval($konsult['senka_svrha_zivotinja_id']) : 0;

                                $kpLastValid = date('Y-m-d', strtotime($kpStart . ' +' . ($kpBrojDana - 1) . ' day'));

                                // Remove excess future undrawn cards if broj_dana was reduced
                                $this->db->query(
                                    "DELETE FROM izvucene_karte WHERE konsultacija='" . $konsult['id'] . "' " .
                                    "AND datum > '" . $kpLastValid . "' AND karta IS NULL"
                                );

                                $kpExist = $this->db->query_first(
                                    "SELECT COUNT(*) AS cnt FROM izvucene_karte WHERE konsultacija='" . $konsult['id'] . "'"
                                );
                                if (!$kpExist || intval($kpExist['cnt']) < $kpBrojDana) {
                                    // Fetch already-existing dates to avoid duplicates
                                    $kpExistingRows = $this->db->fetch_array(
                                        "SELECT datum FROM izvucene_karte WHERE konsultacija='" . $konsult['id'] . "'"
                                    );
                                    $kpExistingSet = array();
                                    if (is_array($kpExistingRows)) {
                                        foreach ($kpExistingRows as $kpEr) {
                                            $kpExistingSet[] = $kpEr['datum'];
                                        }
                                    }
                                    for ($kpD = 0; $kpD < $kpBrojDana; $kpD++) {
                                        $kpDatum = date('Y-m-d', strtotime($kpStart . ' +' . $kpD . ' day'));
                                        if (!in_array($kpDatum, $kpExistingSet)) {
                                            $this->db->query(
                                                "INSERT INTO izvucene_karte (konsultacija, datum) " .
                                                "VALUES ('" . $konsult['id'] . "', '" . $kpDatum . "')"
                                            );
                                        }
                                    }
                                }

                                if ($kpIsFaza2) {
                                    $kpKarte = $this->db->fetch_array(
                                        "SELECT ik.*, kb.naziv AS naziv " .
                                        "FROM izvucene_karte ik " .
                                        "LEFT JOIN karte_boginje kb ON kb.id = ik.karta " .
                                        "WHERE ik.konsultacija='" . $konsult['id'] . "' " .
                                        "ORDER BY ik.datum ASC"
                                    );
                                } else {
                                    $kpKarte = $this->db->fetch_array(
                                        "SELECT ik.*, kk.naziv " .
                                        "FROM izvucene_karte ik " .
                                        "LEFT JOIN karte_kontalacije kk ON kk.id = ik.karta " .
                                        "WHERE ik.konsultacija='" . $konsult['id'] . "' " .
                                        "ORDER BY ik.datum ASC"
                                    );
                                }

                                if (!is_array($kpKarte) || count($kpKarte) === 0) {
                                    $shouldRenderModule = false;
                                    break;
                                }

                                $kpVertDatumi = $this->db->fetch_array(
                                    "SELECT datum FROM karmicke_vertikale_termini WHERE konsultacija='" . $konsult['id'] . "'"
                                );
                                $kpVertSet = array();
                                if (is_array($kpVertDatumi)) {
                                    foreach ($kpVertDatumi as $vd) {
                                        $kpVertSet[] = $vd['datum'];
                                    }
                                }

                                $kpToday = date('Y-m-d');
                                foreach ($kpKarte as $kpK => $kpKar) {
                                    $kpKarte[$kpK]['crveni_okvir'] = in_array($kpKar['datum'], $kpVertSet) ? 1 : 0;
                                    $kpKarte[$kpK]['key_uverenje_okvir'] = (
                                        $kpKeyBeliefId > 0 &&
                                        isset($kpKar['karta']) &&
                                        intval($kpKar['karta']) === $kpKeyBeliefId
                                    ) ? 1 : 0;
                                    $kpKarte[$kpK]['datum_prikaz'] = date('d.m.Y', strtotime($kpKar['datum']));
                                    $kpKarte[$kpK]['je_danas']     = ($kpKar['datum'] === $kpToday) ? 1 : 0;
                                    $kpKarte[$kpK]['je_proslo']    = ($kpKar['datum'] < $kpToday) ? 1 : 0;
                                }

                                $kpBrojRedova = (int)ceil(count($kpKarte) / 6);
                                $kpRedProseci = array();
                                for ($kpR = 0; $kpR < $kpBrojRedova; $kpR++) {
                                    $kpSlice = array_slice($kpKarte, $kpR * 6, 6);
                                    $kpSve   = true;
                                    $kpSum   = 0;
                                    $kpCnt   = 0;
                                    foreach ($kpSlice as $kpS) {
                                        if ($kpS['procenat'] !== null && $kpS['procenat'] !== '') {
                                            $kpSum += intval($kpS['procenat']);
                                            $kpCnt++;
                                        } elseif ($kpS['je_proslo']) {
                                            // Past undrawn — counts as 0%
                                            $kpCnt++;
                                        } else {
                                            // Today undrawn or future — row not complete
                                            $kpSve = false;
                                            break;
                                        }
                                    }
                                    $kpRedProseci[$kpR] = ($kpSve && $kpCnt > 0)
                                        ? round($kpSum / $kpCnt, 1)
                                        : null;
                                }

                                $kpUkupniProsek = null;
                                $kpValidAvg = array_filter($kpRedProseci, function ($v) { return $v !== null; });
                                if (count($kpValidAvg) > 0) {
                                    $kpUkupniProsek = round(array_sum($kpValidAvg) / count($kpValidAvg), 1);
                                }

                                $kpKolona = ($kpBrojDana % 6 === 0) ? 5 : ($kpBrojDana % 6) - 1;

                                $kpLast = end($kpKarte);
                                $kpDone = ($kpLast && !empty($kpLast['karta'])
                                    && $kpLast['procenat'] !== null
                                    && $kpLast['procenat'] !== '') ? 1 : 0;

                                if ($kpIsFaza2) {
                                    $kpKontalacije = $this->db->fetch_array(
                                        "SELECT id, naziv FROM karte_boginje WHERE id BETWEEN 1 AND 72 ORDER BY id ASC"
                                    );
                                } else {
                                    $kpKontalacije = $this->db->fetch_array(
                                        "SELECT id, naziv FROM karte_kontalacije ORDER BY id ASC"
                                    );
                                }
                                if (!is_array($kpKontalacije)) {
                                    $kpKontalacije = array();
                                }

                                $smarty->assign('modulKosmickaPoruka', array(
                                    'faza'          => $kpFaza,
                                    'bottom_up'     => $kpBottomUp,
                                    'naslov'        => $kpNaslov,
                                    'konsultacija'  => $konsult['id'],
                                    'digitalno'     => $kpDigitalno,
                                    'karte'         => $kpKarte,
                                    'red_proseci'   => $kpRedProseci,
                                    'ukupni_prosek' => $kpUkupniProsek,
                                    'kolona'        => $kpKolona,
                                    'ukupan_broj'   => $kpBrojDana,
                                    'zavrseno'      => $kpDone,
                                    'today'         => $kpToday,
                                    'kontalacije'   => $kpKontalacije,
                                    'img_base'      => $kpImgBase,
                                    'back_img'      => $kpBackImg,
                                    'key_belief_id' => $kpKeyBeliefId,
                                    'is_faza_2'     => $kpIsFaza2 ? 1 : 0,
                                ));
                            break;

                            case "frekvencija":
                                if($konsult['frekvencija']!=''){
                                    $frekvencija=$this->db->query_first("SELECT centar,frekvencija from astrolosko_cakre WHERE id = '".$konsult['frekvencija']."'");
                                   if(isset($frekvencija)){
                                    $ss['frekvencija']=$frekvencija['frekvencija'];
                                    $ss['frekvencijaCentar']=$frekvencija['centar'];
                                    
                                    $smarty->assign('modulfrekvencija',$ss);
                                    }
                                }
                            break;
                            
                            case "afirmacija":
                                if ($konsult['afirmacija']!='' && $konsult['afirmacija']!=0){
                                    $afirmacija = $this->db->fetch_array("SELECT * FROM afirmacije WHERE centar = '".$konsult['afirmacija']."'");
                                    $ss['id']=$konsult['id'];
                                    $ss['afirmacija']=$afirmacija;
                                    $ss['afirmacijaCentar']=$konsult['afirmacija'];
                                
                                if($konsult['tip']==28){
                                    $afirmacija = $this->db->fetch_array("SELECT * FROM afirmacije_custom WHERE konsultacija = '".$konsult['id']."' ");
                                    if ( count($afirmacija)>0 )
                                       $ss['afirmacija']=$afirmacija;
                                }
                                $smarty->assign('modulafirmacija',$ss);
                                }
                            break;
                            
                            case 'test':
                                // Korak 1: Traži testove dodeljene kroz ispit_termini za ovu konsultaciju i korisnika
                                // Veza: ispit_termini.test -> test.ID -> test.konsultacija
                                $testovi = $this->db->fetch_array("SELECT ispit_termini.*,afirmacije_centri.padez,afirmacije_centri.planetaen FROM ispit_termini LEFT JOIN afirmacije_centri ON (ispit_termini.centar = afirmacije_centri.centar) LEFT JOIN test ON (ispit_termini.test = test.ID) WHERE test.konsultacija = '".$id."' AND ispit_termini.korisnik = '".$konsult['user_id']."' ORDER BY ispit_termini.datum");
                                $ss['test']=$testovi;
                                
                                $neuradjeniTest = array();
                                if(isset($testovi) && count($testovi) > 0){
                                    foreach($testovi as $ovajTest){
                                        if ($ovajTest['datum']<date('Y-m-d')){
                                            $prikaziTest['planeta']=$ovajTest['planetaen'];
                                            $prikaziTest['planetaen']=$ovajTest['planetaen'];
                                            $prikaziTest['centar']=$ovajTest['centar'];
                                            $prikaziTest['id']=$ovajTest['ID'];
                                            // Pass current consultation ID to template for opening the test popup
                                            $prikaziTest['konsultacija']=$id;
                                            $prikaziTest['intenzitet']=$ovajTest['intenzitet'];
                                            $prikaziTest['datum']=$ovajTest['datum'];
                                            $prikaziTest['vreme']=$ovajTest['vreme'];
                                            
                                             if($ovajTest['uspeh']=='' ) {
                                                $neuradjeniTest[]=$prikaziTest;
                                            }   
                                        }
                                    }
                                }

                                // Korak 2: Pronađi testove koji se trebaju prikazati kao ikonica
                                $modultestItems = array();
                                if(isset($neuradjeniTest) && count($neuradjeniTest)>0){
                                    foreach ($neuradjeniTest as $item) {
                                        $key = isset($item['id']) ? $item['id'] : uniqid('t');
                                        $modultestItems[$key] = $item;
                                    }
                                }

                                // Korak 3: Samo ako nema testova iz ispit_termini, proveri test tabelu
                                if(count($modultestItems)===0){
                                    $mojiTestovi = $this->db->fetch_array("SELECT ID FROM test WHERE konsultacija='".$id."' AND korisnik='".$konsult['user_id']."'");
                                    if(isset($mojiTestovi) && count($mojiTestovi)>0){
                                        foreach($mojiTestovi as $mt){
                                            $cnt = $this->db->query_first("SELECT COUNT(*) as cnt FROM odgovori WHERE test='".$mt['ID']."'");
                                            // Only add to modultest if test has NO answers (nema odgovora)
                                            if (!isset($cnt['cnt']) || intval($cnt['cnt'])===0){
                                                $key = $mt['ID'];
                                                $modultestItems[$key] = array('id'=>$mt['ID'], 'konsultacija'=>$id);
                                            }
                                        }
                                    }
                                }

                                // VAŽNO: Ne dodavaj placeholder ako nema nikakvih testova
                                // Ikonica se prikazuje SAMO ako je test eksplicitno dodeljen
                                
                                // Prikaži samo ako postoji bar jedan test
                                if(count($modultestItems)>0){
                                    $first = array_values($modultestItems);
                                    $smarty->assign('modultest', array($first[0]));
                                } else {
                                    // Nema nikakvih testova - ne prikazuj ikonu
                                    $shouldRenderModule = false;
                                }
                                


                                // Only consider tests assigned to this consultation AND this user
                                $sviTestovi = $this->db->fetch_array("SELECT * from test where konsultacija='".$id."' and korisnik='".$konsult['user_id']."' and planete != ''");
                                $broj=0;
                                $svitesss = array();
                                foreach($sviTestovi as $testovi){
                                    // Skip tests that have no recorded answers
                                    $imaOdgovora = $this->db->query_first("SELECT COUNT(*) as cnt FROM odgovori WHERE test='".$testovi['ID']."'");
                                    if (!isset($imaOdgovora['cnt']) || intval($imaOdgovora['cnt'])===0) {
                                        continue;
                                    }

                                    // Prikazuj rezultate samo za konsultaciju kojoj test zaista pripada
                                    if ($testovi['konsultacija'] != $id) {
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
                                        $ciljCol = $this->getTestCiljAnswerColumn();
                                        if ($ciljCol !== null) {
                                            $testCiljRow = $this->db->query_first("SELECT * FROM test_cilja WHERE ID='".$testCiljId."'");
                                            if ($testCiljRow && isset($testCiljRow[$ciljCol])) {
                                                $testCiljTekst = $testCiljRow[$ciljCol];
                                            }
                                        }
                                    }

                                    $testPlanete=explode(',',$testovi['planete']);
                                    if (count($testPlanete)>1){
                                        $sveplanete=$this->db->fetch_array("SELECT * from cakre ");
                                        foreach($sveplanete as $planeta){
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
                                            $zaopis[]=$planeta['planeta'];
                                            $procentiProc[]=$testStub['procenat'];
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
                                    $jedantest['datum']=$testovi['vreme'];
                                    $jedantest['vreme']=$testovi['vreme'];
                                    $jedantest['broj']=$broj;
                                    $jedantest['stubovi']=$ceotest;
                                    $jedantest['test_cilja']=$testCiljTekst;
                                    $broj++;
                                    $svitesss[]=$jedantest;
                                    unset($ceotest,$jedantest,$procentiPlan,$procentiProc,$zaopis);
                                }

                                //// Prikazuje rezultate urađenih testova za grafikone, to je ustvari $graf promenjiva u Smarty
                                          // Prikazuj test rezultate samo ako postoji tačno jedan test rezultat za ovu konsultaciju
                                          if(isset($svitesss) && count($svitesss) === 1) {
                                              $smarty->assign('modul'.$tip['type'].'Test', $svitesss);
                                          } else {
                                              // Ako ima više testova, ne prikazuj ništa (ili možeš logovati za debug)
                                              $smarty->clearAssign('modul'.$tip['type'].'Test');
                                          }
                                
                            break;

                            case 'upitnik':
                                // Show questionnaire icon only when an active (assigned) row exists for this consultation and user
                                $questionnaireRow = $this->db->query_first(
                                    "SELECT * FROM consultation_module12 WHERE consultation_id='".$konsult['id']."' " .
                                    "AND user_id='".$konsult['user_id']."' AND assigned=1"
                                );

                                $alreadyAnswered = false;
                                if ($questionnaireRow) {
                                    $alreadyAnswered =
                                        (isset($questionnaireRow['q1']) && trim($questionnaireRow['q1']) !== '') ||
                                        (isset($questionnaireRow['q2']) && trim($questionnaireRow['q2']) !== '') ||
                                        (isset($questionnaireRow['q3']) && trim($questionnaireRow['q3']) !== '');
                                }

                                if ($questionnaireRow && !$alreadyAnswered) {
                                    if (!isset($questionnaireRow['icon']) || $questionnaireRow['icon'] === '') {
                                        $questionnaireRow['icon'] = isset($tip['icon']) ? $tip['icon'] : 'questionnaire.png';
                                    }
                                    $smarty->assign('modulupitnik', $questionnaireRow);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'rituali':
                                // Show ritual icon only if there is text in konsultacije.rituali field
                                if(isset($konsult['rituali']) && trim($konsult['rituali']) != ''){
                                    $ritualData = array(
                                        'tekst' => $konsult['rituali'],
                                        'naslov' => 'Ritual za životinjskog vodiča'
                                    );
                                    $smarty->assign('modulrituali', $ritualData);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'iskustvo':
                                // This case is handled separately at the end of the function
                                // for full-width display below all icons
                                $shouldRenderModule = false;
                            break;
                            
                            case 'meditacija':
                                // Show meditation player only if meditacija field is set
                                if(isset($konsult['meditacija']) && $konsult['meditacija'] != '' && $konsult['meditacija'] != 0){
                                    $meditacijaRecord = $this->db->query_first("SELECT * FROM meditacije WHERE id='".$konsult['meditacija']."'");
                                    if($meditacijaRecord && isset($meditacijaRecord['naziv'])){
                                        $meditacijaData = array(
                                            'id' => $meditacijaRecord['id'],
                                            'naziv' => $meditacijaRecord['naziv'],
                                            'fajl' => '/upload/media/Rituali/'.$meditacijaRecord['fajl']
                                        );
                                        $smarty->assign('modulmeditacija', $meditacijaData);
                                    } else {
                                        $shouldRenderModule = false;
                                    }
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'zmaj':
                                // Show dragon info only if zmaj field is set
                                if(isset($konsult['zmaj']) && $konsult['zmaj'] != '' && $konsult['zmaj'] != 0){
                                    $zmajRecord = $this->db->query_first("SELECT * FROM zmaj WHERE id='".$konsult['zmaj']."'");
                                    if($zmajRecord && isset($zmajRecord['ime'])){
                                        $zmajData = array(
                                            'ime' => $zmajRecord['ime'],
                                            'slika' => $zmajRecord['slika'],
                                            'priroda' => $zmajRecord['priroda']
                                        );
                                        $smarty->assign('modulzmaj', $zmajData);
                                    } else {
                                        $shouldRenderModule = false;
                                    }
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'vezbe':
                                // Show physical exercises text if vezbe field is set
                                if(isset($konsult['vezbe']) && trim($konsult['vezbe']) != ''){
                                    $vezbeData = array(
                                        'tekst' => $konsult['vezbe']
                                    );
                                    $smarty->assign('modulvezbe', $vezbeData);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;

                            case 'meditacija_tekst':
                                // Show meditation text if meditacija_tekst field is set
                                if(isset($konsult['meditacija_tekst']) && trim($konsult['meditacija_tekst']) != ''){
                                    $meditacijaTekstData = array(
                                        'tekst' => $konsult['meditacija_tekst']
                                    );
                                    $smarty->assign('modulmeditacija_tekst', $meditacijaTekstData);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'vodic':
                                // Show spiritual guide info only if vodic field is set
                                if(isset($konsult['vodic']) && $konsult['vodic'] != '' && $konsult['vodic'] != 0){
                                    $vodicRecord = $this->db->query_first("SELECT * FROM zivotinje WHERE id='".$konsult['vodic']."'");
                                    if($vodicRecord && isset($vodicRecord['zivotinja'])){
                                        // Determine label based on phase
                                        $faza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;
                                        $vodicLabel = 'Spiritual Guide'; // Default
                                        if($faza == 1){
                                            $vodicLabel = 'Shadow Guide';
                                        } elseif($faza == 2){
                                            $vodicLabel = 'Life Guide';
                                        } elseif($faza == 3){
                                            $vodicLabel = 'Spiritual Guide';
                                        }
                                        
                                        $vodicData = array(
                                            'zivotinja' => $vodicRecord['zivotinja'],
                                            'priroda' => $vodicRecord['priroda'],
                                            'ritual' => isset($vodicRecord['ritual']) ? $vodicRecord['ritual'] : '',
                                            'prikazi_ritual' => (isset($konsult['prikazi_ritual']) && $konsult['prikazi_ritual'] == 1) ? 1 : 0,
                                            'faza' => $faza,
                                            'label' => $vodicLabel,
                                            'title' => 'Click to view ' . $vodicLabel . ' information'
                                        );
                                        $smarty->assign('modulvodic', $vodicData);
                                    } else {
                                        $shouldRenderModule = false;
                                    }
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;

                            case 'senka':
                                $faza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;

                                // Phase 0 and 5 do not render this module
                                if($faza === 0 || $faza === 5){
                                    $shouldRenderModule = false;
                                    break;
                                }

                                $zivotBroj = '';
                                $senkaZivotinjaId = 0;
                                $prikaziRitual = 0;

                                $naslov = '';
                                if($faza === 1){
                                    $zivotBroj = isset($konsult['senka_zivot_broj']) ? trim($konsult['senka_zivot_broj']) : '';
                                    $senkaZivotinjaId = isset($konsult['senka_zivotinja_id']) ? intval($konsult['senka_zivotinja_id']) : 0;
                                    $prikaziRitual = 1;
                                    $naslov = 'Senka Uverenja "'.$zivotBroj.'." prethodnog života';
                                } elseif($faza === 2){
                                    $zivotBroj = isset($konsult['senka_energija_broj']) ? trim($konsult['senka_energija_broj']) : '';
                                    $senkaZivotinjaId = isset($konsult['senka_energija_zivotinja_id']) ? intval($konsult['senka_energija_zivotinja_id']) : 0;
                                    $prikaziRitual = (isset($konsult['senka_energija_ritual']) && intval($konsult['senka_energija_ritual']) === 1) ? 1 : 0;
                                    $naslov = 'Energija Uverenja "'.$zivotBroj.'." prethodnog života';
                                } elseif($faza === 3){
                                    $zivotBroj = isset($konsult['senka_svrha_broj']) ? trim($konsult['senka_svrha_broj']) : '';
                                    $senkaZivotinjaId = isset($konsult['senka_svrha_zivotinja_id']) ? intval($konsult['senka_svrha_zivotinja_id']) : 0;
                                    $prikaziRitual = (isset($konsult['senka_svrha_ritual']) && intval($konsult['senka_svrha_ritual']) === 1) ? 1 : 0;
                                    $naslov = 'Senka svrhe "'.$zivotBroj.'." narednog života';
                                } elseif($faza === 4){
                                    $zivotBroj = isset($konsult['senka_esvrha_broj']) ? trim($konsult['senka_esvrha_broj']) : '';
                                    $senkaZivotinjaId = isset($konsult['senka_esvrha_zivotinja_id']) ? intval($konsult['senka_esvrha_zivotinja_id']) : 0;
                                    $prikaziRitual = (isset($konsult['senka_esvrha_ritual']) && intval($konsult['senka_esvrha_ritual']) === 1) ? 1 : 0;
                                    $naslov = 'Energija Svrhe "'.$zivotBroj.'." budućeg života';
                                }

                                $zivotinjaIme = '';
                                $zivotinjaRitual = '';
                                if($senkaZivotinjaId > 0){
                                    $senkaZivotinja = $this->db->query_first(
                                        "SELECT zivotinja, ritual FROM zivotinje WHERE id='".$senkaZivotinjaId."'"
                                    );
                                    if($senkaZivotinja){
                                        $zivotinjaIme = isset($senkaZivotinja['zivotinja']) ? $senkaZivotinja['zivotinja'] : '';
                                        $zivotinjaRitual = isset($senkaZivotinja['ritual']) ? $senkaZivotinja['ritual'] : '';
                                    }
                                }

                                // Build only for phases 1-4 and when there is at least some content to show.
                                if($naslov === '' || (trim($zivotinjaIme) === '' && trim($zivotinjaRitual) === '')){
                                    $shouldRenderModule = false;
                                    break;
                                }

                                $senkaData = array(
                                    'faza' => $faza,
                                    'broj' => $zivotBroj,
                                    'naslov' => $naslov,
                                    'zivotinja' => $zivotinjaIme,
                                    'ritual' => $zivotinjaRitual,
                                    'prikazi_ritual' => $prikaziRitual,
                                    'icon' => isset($tip['icon']) ? $tip['icon'] : '',
                                    'title' => 'Kliknite za prikaz Senka modula'
                                );

                                $smarty->assign('modulsenka', $senkaData);
                            break;
                            
                            case 'vodjena':
                                // Show guided meditation info only if vodjena_meditacija field is set
                                if(isset($konsult['vodjena_meditacija']) && $konsult['vodjena_meditacija'] != '' && $konsult['vodjena_meditacija'] != 0){
                                    $vodjenaRecord = $this->db->query_first("SELECT * FROM vodjene WHERE id='".$konsult['vodjena_meditacija']."'");
                                    if($vodjenaRecord && isset($vodjenaRecord['naziv'])){
                                        $vodjenaData = array(
                                            'naziv' => $vodjenaRecord['naziv']
                                        );
                                        $smarty->assign('modulvodjena', $vodjenaData);
                                    } else {
                                        $shouldRenderModule = false;
                                    }
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'kamen':
                                // Show stone meditation text if kamen field is set
                                if(isset($konsult['kamen']) && trim($konsult['kamen']) != ''){
                                    $kamenData = array(
                                        'tekst' => $konsult['kamen']
                                    );
                                    $smarty->assign('modulkamen', $kamenData);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'andjeo':
                                // Show angel info only if andjeo field is set
                                if(isset($konsult['andjeo']) && $konsult['andjeo'] != '' && $konsult['andjeo'] != 0){
                                    $andjeoRecord = $this->db->query_first("SELECT * FROM andjeli WHERE id='".$konsult['andjeo']."'");
                                    if($andjeoRecord && isset($andjeoRecord['andjeo'])){
                                        // Determine label based on phase
                                        $faza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;
                                        $andjeoLabel = 'Angel of Higher Self'; // Default for faza 3 and 4
                                        $andjeoLabelShort = 'the Angel of Higher Self';
                                        
                                        if($faza == 1){
                                            $andjeoLabel = 'Guardian Angel';
                                            $andjeoLabelShort = 'the Guardian Angel';
                                        } elseif($faza == 2){
                                            $andjeoLabel = 'Star Angel';
                                            $andjeoLabelShort = 'the Star Angel';
                                        }
                                        
                                        $andjeoData = array(
                                            'andjeo' => $andjeoRecord['andjeo'],
                                            'kamen' => isset($andjeoRecord['kamen']) ? $andjeoRecord['kamen'] : '',
                                            'priroda' => isset($andjeoRecord['priroda']) ? $andjeoRecord['priroda'] : '',
                                            'faza' => $faza,
                                            'label' => $andjeoLabel,
                                            'label_short' => $andjeoLabelShort,
                                            'title' => 'Click to view ' . $andjeoLabelShort . ' information'
                                        );
                                        $smarty->assign('modulandjeo', $andjeoData);
                                    } else {
                                        $shouldRenderModule = false;
                                    }
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;

                            case 'cards':
                                // Build cards data from consultation_cards table
                                if(isset($konsult['cards']) && trim($konsult['cards']) != ''){
                                    $cardsStartTs = strtotime($konsult['cards']);
                                    if($cardsStartTs === false){
                                        $shouldRenderModule = false;
                                        break;
                                    }
                                    $cardsStart = date('Y-m-d', $cardsStartTs);
                                    $cardsRows = $this->db->fetch_array(
                                        "SELECT * FROM consultation_cards " .
                                        "WHERE consultation_id='".$konsult['id']."' " .
                                        "AND user_id='".$konsult['user_id']."' " .
                                        "ORDER BY day_number ASC"
                                    );

                                    if(!is_array($cardsRows) || count($cardsRows) === 0){
                                        for($day = 1; $day <= 28; $day++){
                                            $cardDate = date('Y-m-d', strtotime($cardsStart . ' +' . ($day - 1) . ' day'));
                                            $this->db->query(
                                                "INSERT INTO consultation_cards (consultation_id, user_id, day_number, card_date) " .
                                                "VALUES ('".$konsult['id']."', '".$konsult['user_id']."', '".$day."', '".$cardDate."')"
                                            );
                                        }

                                        $cardsRows = $this->db->fetch_array(
                                            "SELECT * FROM consultation_cards " .
                                            "WHERE consultation_id='".$konsult['id']."' " .
                                            "AND user_id='".$konsult['user_id']."' " .
                                            "ORDER BY day_number ASC"
                                        );
                                    }

                                    if(is_array($cardsRows) && count($cardsRows) > 0){
                                        $modulcards = array(
                                            'consultation_id' => $konsult['id'],
                                            'today' => date('Y-m-d'),
                                            'cards' => $cardsRows
                                        );
                                        $smarty->assign('modulcards', $modulcards);
                                    } else {
                                        $shouldRenderModule = false;
                                    }
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'termini':
                                // Load termini schedule table (all records)
                                $terminiRecords = $this->db->fetch_array(
                                    "SELECT dit.*, c.planeta ".  
                                    "FROM dragon_ispit_termini dit ". 
                                    "LEFT JOIN cakre c ON (dit.centar = c.cakra) ". 
                                    "WHERE dit.konsultacija='".$konsult['id']."' ". 
                                    "ORDER BY dit.datum, dit.vreme"
                                );
                                
                                // Format termin records with date display
                                if(isset($terminiRecords) && count($terminiRecords) > 0){
                                    foreach($terminiRecords as $key => $termin){
                                        if($termin['uspeh'] !== null && $termin['uspeh'] !== '' && $termin['uspeh'] != 0){
                                            $timestamp = strtotime($termin['datum']);
                                            $dayName = strftime('%A', $timestamp);
                                            $dayNameLat = $this->getDayNameLatin($dayName);
                                            $dateFormatted = date('d.m.Y', $timestamp);
                                            $uspehPercent = intval($termin['uspeh']);
                                            $terminiRecords[$key]['uspehText'] = $dayNameLat . ', ' . $dateFormatted . ', uspešno završeno <span style="font-size: 1.3em; font-weight: bold;">' . $uspehPercent . '%</span>';
                                        }
                                    }
                                }

                                // Load termini tests that are due and not completed
                                $terminiTests = $this->db->fetch_array(
                                    "SELECT dit.*, c.planeta, k.faza ".  
                                    "FROM dragon_ispit_termini dit ". 
                                    "LEFT JOIN cakre c ON (dit.centar = c.cakra) ". 
                                    "LEFT JOIN konsultacije k ON (dit.konsultacija = k.id) ".
                                    "WHERE dit.konsultacija='".$konsult['id']."' ". 
                                    "AND dit.datum <= CURDATE() ". 
                                    "AND (dit.uspeh IS NULL OR dit.uspeh = 0) ". 
                                    "ORDER BY dit.datum, dit.vreme"
                                );
                                
                                if(isset($terminiRecords) && count($terminiRecords) > 0){
                                    $smarty->assign('modultermini', $terminiRecords);
                                    
                                    if(isset($terminiTests) && count($terminiTests) > 0){
                                        $smarty->assign('modulterminiTest', $terminiTests);
                                    }
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;
                            
                            case 'aktiviranje':
                                // Load activation schedule table (all records)
                                $aktiviranjeTabela = $this->db->fetch_array(
                                    "SELECT kit.*, c.planeta ".  
                                    "FROM karmicka_ispit_termini kit ". 
                                    "LEFT JOIN cakre c ON (kit.centar = c.cakra) ". 
                                    "WHERE kit.konsultacija='".$konsult['id']."' ". 
                                    "ORDER BY kit.datum, kit.vreme"
                                );
                                
                                // Format termin records with date display
                                if(isset($aktiviranjeTabela) && count($aktiviranjeTabela) > 0){
                                    foreach($aktiviranjeTabela as $key => $termin){
                                        if($termin['uspeh'] !== null && $termin['uspeh'] !== '' && $termin['uspeh'] != 0){
                                            $timestamp = strtotime($termin['datum']);
                                            $dayName = strftime('%A', $timestamp);
                                            $dayNameLat = $this->getDayNameLatin($dayName);
                                            $dateFormatted = date('d.m.Y', $timestamp);
                                            $uspehPercent = intval($termin['uspeh']);
                                            $aktiviranjeTabela[$key]['uspehText'] = $dayNameLat . ', ' . $dateFormatted . ', uspešno završeno <span style="font-size: 1.3em; font-weight: bold;">' . $uspehPercent . '%</span>';
                                        }
                                    }
                                }

                                // Load activation tests that are due and not completed
                                $aktiviranjeTests = $this->db->fetch_array(
                                    "SELECT kit.*, c.planeta ".  
                                    "FROM karmicka_ispit_termini kit ". 
                                    "LEFT JOIN cakre c ON (kit.centar = c.cakra) ". 
                                    "WHERE kit.konsultacija='".$konsult['id']."' ". 
                                    "AND (kit.uspeh IS NULL OR kit.uspeh='' OR kit.uspeh=0) ".
                                    "AND kit.datum <= CURDATE() ".
                                    "ORDER BY kit.datum, kit.vreme"
                                );

                                if((isset($aktiviranjeTabela) && count($aktiviranjeTabela) > 0) || (isset($aktiviranjeTests) && count($aktiviranjeTests) > 0)){
                                    $faza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;
                                    if (isset($aktiviranjeTests) && count($aktiviranjeTests) > 0) {
                                        foreach ($aktiviranjeTests as $k => $row) {
                                            if (isset($row['ID']) && !isset($row['id'])) {
                                                $aktiviranjeTests[$k]['id'] = $row['ID'];
                                            }
                                            $aktiviranjeTests[$k]['faza'] = $faza;
                                        }
                                    }
                                    if (isset($aktiviranjeTabela) && count($aktiviranjeTabela) > 0) {
                                        foreach ($aktiviranjeTabela as $k => $row) {
                                            if (isset($row['ID']) && !isset($row['id'])) {
                                                $aktiviranjeTabela[$k]['id'] = $row['ID'];
                                            }
                                        }
                                    }
                                    $smarty->assign('modulaktiviranje', $aktiviranjeTabela);
                                    $smarty->assign('modulaktiviranjeTest', $aktiviranjeTests);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;

                            case 'aktiviranje_karmicke_vertikale':
                                // Module 103: Karmicke vertikale schedule table.
                                $karmickeVertikaleTabela = $this->db->fetch_array(
                                    "SELECT kvt.*, c.planeta ".
                                    "FROM karmicke_vertikale_termini kvt ".
                                    "LEFT JOIN cakre c ON (kvt.centar = c.cakra) ".
                                    "WHERE kvt.konsultacija='".$konsult['id']."' ".
                                    "ORDER BY kvt.datum, kvt.vreme"
                                );

                                // Load due tests that are not completed.
                                $karmickeVertikaleTests = $this->db->fetch_array(
                                    "SELECT kvt.*, c.planeta ".
                                    "FROM karmicke_vertikale_termini kvt ".
                                    "LEFT JOIN cakre c ON (kvt.centar = c.cakra) ".
                                    "WHERE kvt.konsultacija='".$konsult['id']."' ".
                                    "AND kvt.datum <= CURDATE() ".
                                    "AND (kvt.uspeh IS NULL OR kvt.uspeh='' OR kvt.uspeh=0) ".
                                    "ORDER BY kvt.datum, kvt.vreme"
                                );

                                if(isset($karmickeVertikaleTabela) && count($karmickeVertikaleTabela) > 0){
                                    foreach($karmickeVertikaleTabela as $k => $row){
                                        if(isset($row['ID']) && !isset($row['id'])){
                                            $karmickeVertikaleTabela[$k]['id'] = $row['ID'];
                                        }
                                        if(isset($row['datum']) && $row['datum'] != ''){
                                            $timestamp = strtotime($row['datum']);
                                            if($timestamp !== false){
                                                $dayNameLocale = strftime('%A', $timestamp);
                                                $dayNameLatin = $this->getDayNameLatin($dayNameLocale);
                                                $karmickeVertikaleTabela[$k]['datumLocale'] = $dayNameLatin . ', ' . date('d.m.Y', $timestamp);
                                            }
                                        }
                                        if(isset($row['uspeh']) && $row['uspeh'] !== null && $row['uspeh'] !== '' && $row['uspeh'] != 0){
                                            $timestamp = strtotime($row['datum']);
                                            $dayName = strftime('%A', $timestamp);
                                            $dayNameLat = $this->getDayNameLatin($dayName);
                                            $dateFormatted = date('d.m.Y', $timestamp);
                                            $uspehPercent = intval($row['uspeh']);
                                            $karmickeVertikaleTabela[$k]['uspehText'] = $dayNameLat . ', ' . $dateFormatted . ', uspešno završeno <span style="font-size: 1.3em; font-weight: bold;">' . $uspehPercent . '%</span>';
                                        }
                                    }

                                    if(isset($karmickeVertikaleTests) && count($karmickeVertikaleTests) > 0){
                                        foreach($karmickeVertikaleTests as $k => $row){
                                            if(isset($row['ID']) && !isset($row['id'])){
                                                $karmickeVertikaleTests[$k]['id'] = $row['ID'];
                                            }
                                            if(isset($row['datum']) && $row['datum'] != ''){
                                                $timestamp = strtotime($row['datum']);
                                                if($timestamp !== false){
                                                    $dayNameLocale = strftime('%A', $timestamp);
                                                    $dayNameLatin = $this->getDayNameLatin($dayNameLocale);
                                                    $karmickeVertikaleTests[$k]['datumLocale'] = $dayNameLatin . ', ' . date('d.m.Y', $timestamp);
                                                }
                                            }
                                        }
                                    }

                                    $faza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;
                                    $modulNaslov = 'Karmičke Vertikale';
                                    if($faza === 2 || $faza === 4){
                                        $modulNaslov = 'Aktiviranje lakoće';
                                    } elseif($faza === 5){
                                        $modulNaslov = 'Aktiviranje Višeg Ja';
                                    }

                                    $smarty->assign('modulaktiviranje_karmicke_vertikale', array(
                                        'naslov' => $modulNaslov,
                                        'faza' => $faza,
                                        'termini' => $karmickeVertikaleTabela,
                                        'tests' => $karmickeVertikaleTests
                                    ));
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;

                            case 'materijal':
                                $materijali = $this->db->fetch_array(
                                    "SELECT id, naziv, opis, datoteka, tip_datoteke, velicina, redosled, kreirana " .
                                    "FROM konsultacije_materijal " .
                                    "WHERE konsultacija='".$konsult['id']."' " .
                                    "ORDER BY redosled ASC, id ASC"
                                );

                                if(!is_array($materijali)){
                                    $materijali = array();
                                }

                                // Format file sizes
                                foreach($materijali as $key => $mat){
                                    $bytes = intval($mat['velicina']);
                                    if ($bytes >= 1073741824) {
                                        $materijali[$key]['velicina_formatted'] = number_format($bytes / 1073741824, 2) . ' GB';
                                    } elseif ($bytes >= 1048576) {
                                        $materijali[$key]['velicina_formatted'] = number_format($bytes / 1048576, 2) . ' MB';
                                    } elseif ($bytes >= 1024) {
                                        $materijali[$key]['velicina_formatted'] = number_format($bytes / 1024, 2) . ' KB';
                                    } else {
                                        $materijali[$key]['velicina_formatted'] = $bytes . ' bytes';
                                    }
                                }

                                $modulMaterijal = array(
                                    'konsultacija_id' => $konsult['id'],
                                    'items' => $materijali
                                );
                                $smarty->assign('modulmaterijal', $modulMaterijal);
                            break;

                            case 'karmicko_uverenje_zivot':
                                $karmickoData = array(
                                    'negativno_uverenje' => isset($konsult['karmicko_negativno_uverenje']) ? $konsult['karmicko_negativno_uverenje'] : '',
                                    'pol' => isset($konsult['karmicko_pol']) ? $konsult['karmicko_pol'] : '',
                                    'najkvalitetnije_uverenje' => isset($konsult['karmicko_najkvalitetnije_uverenje']) ? $konsult['karmicko_najkvalitetnije_uverenje'] : '',
                                    'zivot_broj' => '',
                                    'andjeo' => ''
                                );

                                $korisnikKarmicko = $this->db->query_first(
                                    "SELECT karmicko_zivot_broj FROM korisnici WHERE id='".$konsult['user_id']."'"
                                );
                                if($korisnikKarmicko && isset($korisnikKarmicko['karmicko_zivot_broj'])){
                                    $karmickoData['zivot_broj'] = $korisnikKarmicko['karmicko_zivot_broj'];
                                }

                                if(isset($konsult['karmicko_andjeo_id']) && $konsult['karmicko_andjeo_id'] != '' && $konsult['karmicko_andjeo_id'] != 0){
                                    $andjeoKarmicko = $this->db->query_first(
                                        "SELECT andjeo FROM andjeli WHERE id='".$konsult['karmicko_andjeo_id']."'"
                                    );
                                    if($andjeoKarmicko && isset($andjeoKarmicko['andjeo'])){
                                        $karmickoData['andjeo'] = $andjeoKarmicko['andjeo'];
                                    }
                                }

                                if(
                                    trim($karmickoData['negativno_uverenje']) !== '' ||
                                    trim($karmickoData['pol']) !== '' ||
                                    trim($karmickoData['najkvalitetnije_uverenje']) !== '' ||
                                    trim($karmickoData['zivot_broj']) !== '' ||
                                    trim($karmickoData['andjeo']) !== ''
                                ){
                                    $smarty->assign('modulkarmicko_uverenje_zivot', $karmickoData);
                                } else {
                                    $shouldRenderModule = false;
                                }
                            break;

                            case 'andjeo_faza2_veza':
                                $faza = isset($konsult['faza']) ? intval($konsult['faza']) : 0;
                                if($faza !== 2){
                                    $shouldRenderModule = false;
                                    break;
                                }

                                $zivotBroj = isset($konsult['senka_svrha_broj']) ? trim($konsult['senka_svrha_broj']) : '';
                                $andjeoId = isset($konsult['senka_svrha_zivotinja_id']) ? intval($konsult['senka_svrha_zivotinja_id']) : 0;
                                if($zivotBroj === '' || $andjeoId <= 0){
                                    $shouldRenderModule = false;
                                    break;
                                }

                                $andjeoRecord = $this->db->query_first(
                                    "SELECT naziv FROM karte_boginje WHERE id='".$andjeoId."'"
                                );
                                $andjeoIme = ($andjeoRecord && isset($andjeoRecord['naziv'])) ? trim($andjeoRecord['naziv']) : '';
                                if($andjeoIme === ''){
                                    $shouldRenderModule = false;
                                    break;
                                }

                                $smarty->assign('modulandjeo_faza2_veza', array(
                                    'broj' => $zivotBroj,
                                    'andjeo' => $andjeoIme,
                                    'title' => 'Kliknite za prikaz veze sa prethodnim životom'
                                ));
                            break;
                            
                            default:
                                $smarty->assign('modul'.$tip['type'], $konsult[$tip['type']]);
                            break;
                        }
                        }
                        
                        if(!$shouldRenderModule){
                            continue;
                        }
                        
                        $mod[] = $smarty->fetch('moduli/'.$tip['template']);

                        // Clear the specific Smarty variable for this module after rendering
                        $moduleVarMap = array(
                            'cart' => 'modulcart',
                            'venera_chart' => 'modulvenera_chart',
                            'cakra' => 'modulvideo',
                            'vodjene' => 'modulvodjene',
                            'venera_video' => 'modulvenera_video',
                            'frekvencija' => 'modulfrekvencija',
                            'afirmacija' => 'modulafirmacija',
                            'test' => array('modultest','modultestTest'),
                            'upitnik' => 'modulupitnik',
                            'rituali' => 'modulrituali',
                            'iskustvo' => 'moduliskustvo',
                            'meditacija' => 'modulmeditacija',
                            'zmaj' => 'modulzmaj',
                            'vezbe' => 'modulvezbe',
                            'vodic' => 'modulvodic',
                            'senka' => 'modulsenka',
                            'vodjena' => 'modulvodjena',
                            'kamen' => 'modulkamen',
                            'andjeo' => 'modulandjeo',
                            'andjeo_faza2_veza' => 'modulandjeo_faza2_veza',
                            'cards' => 'modulcards',
                            'materijal' => 'modulmaterijal',
                            'termini' => 'modultermini',
                            'aktiviranje' => 'modulaktiviranje',
                            'aktiviranje_karmicke_vertikale' => 'modulaktiviranje_karmicke_vertikale',
                            'inkarnacije' => 'modulinkarnacije',
                            'karmicko_uverenje_zivot' => 'modulkarmicko_uverenje_zivot',
                            // Extra types
                            'videoMT' => 'modulvideoMT',
                            'audio' => 'modulaudio',
                            'napomena' => 'modulnapomena',
                            'balans_napomena' => 'modulbalans_napomena',
                            'Kosmicka-poruka' => 'modulKosmickaPoruka',
                        );
                        if (isset($tip['type'])) {
                            $t = $tip['type'];
                            if (isset($moduleVarMap[$t])) {
                                $mv = $moduleVarMap[$t];
                                if (is_array($mv)) {
                                    foreach ($mv as $one) { $smarty->clearAssign($one); }
                                } else {
                                    $smarty->clearAssign($mv);
                                }
                            } else {
                                $smarty->clearAssign('modul'.$t);
                            }
                        }
                    }
                    
                    // Load the experience/comments textarea at the end for full-width display
                    // Only show if module 15 (iskustvo) is assigned to this consultation type OR if it's global
                    $iskustvoModul = $this->db->query_first("SELECT * FROM konsultacije_moduli WHERE konsultacija='".$konsult['tip']."' AND modul=15");
                    $iskustvoGlobal = $this->db->query_first("SELECT * FROM moduli WHERE id=15 AND global=1");
                    
                    if($iskustvoModul || $iskustvoGlobal){
                        $iskustvoData = array(
                            'konsultacija_id' => $id,
                            'tekst' => isset($konsult['iskustvo']) ? $konsult['iskustvo'] : ''
                        );
                        $smarty->assign('moduliskustvo', $iskustvoData);
                        $iskustvoHtml = $smarty->fetch('moduli/iskustvo.tpl');
                        if($iskustvoHtml != '') {
                            $mod[] = $iskustvoHtml;
                        }
                        $smarty->clearAssign('moduliskustvo');
                    }
                    
                    return $mod;
                }
                    
                public function getLast($user){
                    $last = $this->db->query_first("SELECT * from konsultacije where user_id='$user' and startTime < now() order by startTime desc");
                    if(isset($last) && $last['id']!='')
                        return $this->getKonsultacija($last['id']);
                    else return false;
                    }
                    
                public function getSveTipove($coach,$user){
                    if($coach!='' && $user!=''){
                        $konsultacije = array();
                        // Tipovi koji se prikazuju samo ako korisnik ima već neku konsultaciju tog tipa
                        $restrictedTypes = array(62, 63, 64,53);
                        
                        $sve = $this->db->fetch_array("SELECT k.* from konsultacije_coach o left join konsultacije_tip k on (o.konsultacija=k.id) where k.logo!='' and o.coach='$coach'  and k.aktivan=1");
                        foreach($sve as $svi){
                            $svi['koliko']=$this->brojKonsultacija($user,$svi['id']);
                            
                            // Ako je tip u listi ograničenih tipova i korisnik nema nikakvu konsultaciju tog tipa, preskoči
                            if(in_array($svi['id'], $restrictedTypes) && $svi['koliko'] == 0){
                                continue;
                            }
                            
                            $konsultacije[]=$svi;
                        }
                        return $konsultacije;
                    }
                    else return false;
                }
    }

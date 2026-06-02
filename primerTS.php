<?php

//// TS predtestovi čitanje
    $sveplanete=$db->fetch_array("SELECT * from cakre ");
    $studentts = $db->query_first('SELECT ts_korisnik from korisnici where id="'.$ulogovan.'"');
    $smarty->assign('ts_korisnik',$studentts['ts_korisnik']);
    $tsPredTestovi = $db->fetch_array("SELECT * from ts_test where korisnik='".$ulogovan."' and tip='predtest' and uradjen=1 order by vreme desc");
    foreach($tsPredTestovi as $pred){
        $planeta = $db->query_first("SELECT planeta from cakre where ID='".$pred['planeta']."'");
        $pred['nazivPlanete']=$planeta['planeta'];
        $tsPostTest = $db->query_first("SELECT * from ts_test where korisnik='".$ulogovan."' and tip='posttest' and planeta='".$pred['planeta']."'");

                    foreach($sveplanete as $planeta){
                        $testStub['planeta']=$planeta['planeta'];
                        $testStub['znak']=$planeta['znak'];
                        $testStub['boja']=$planeta['boja'];
                        $odgovori = $db->query_first("SELECT sum(o.odgovor) as total from ts_odgovori o left join ts_pitanja p on (p.id=o.pitanje) where o.test='".$pred['id']."' and p.planeta='".$planeta['cakra']."' ");
                        $totalBroj = $db->fetch_array("SELECT p.pitanje,c.planeta,p.zivotinja,p.cakra,p.nivo,o.odgovor as total from ts_odgovori o left join ts_pitanja p on (p.id=o.pitanje) left join cakre c on (c.cakra = p.planeta ) where o.test='".$pred['id']."' and p.planeta='".$planeta['cakra']."' ");
                        if (count($totalBroj)==0)$testStub['procenat']=0;
                        else $testStub['procenat']=$odgovori['total']/(count($totalBroj)*10)*100;
                           
                        $testStub['pitanja']=$totalBroj;
                     
                        if ((isset($testStub['procenat']) and $testStub['procenat']=='') or !isset($testStub['procenat'])) $testStub['procenat']=0;
                        $ceotest[]=$testStub; 
                        
                        if($tsPostTest['id']!=''){
                            $testStub2['planeta']=$planeta['planeta'];
                            $testStub2['znak']=$planeta['znak'];
                            $testStub2['boja']=$planeta['boja'];
                            
                            $odgovori2 = $db->query_first("SELECT sum(o.odgovor) as total from ts_odgovori o left join ts_pitanja p on (p.id=o.pitanje) where o.test='".$tsPostTest['id']."' and p.planeta='".$planeta['cakra']."' ");
                            $totalBroj2 = $db->fetch_array("SELECT p.pitanje,c.planeta,p.zivotinja,p.cakra,p.nivo,o.odgovor as total from ts_odgovori o left join ts_pitanja p on (p.id=o.pitanje) left join cakre c on (c.cakra = p.planeta ) where o.test='".$tsPostTest['id']."' and p.planeta='".$planeta['cakra']."' ");
                        
                            if (count($totalBroj2)==0)$testStub2['procenat']=0;
                            else $testStub2['procenat']=$odgovori2['total']/(count($totalBroj2)*10)*100;
                               
                            $testStub2['pitanja']=$totalBroj2;
                         
                            if ((isset($testStub2['procenat']) and $testStub2['procenat']=='') or !isset($testStub2['procenat'])) $testStub2['procenat']=0;
                            $ceotest2[]=$testStub2;
                            
                            $testtt = $db->query_first("SELECT * from ts_test where id='".$tsPostTest['id']."'");
                            $pred['odmor'] = round(($testtt['odgovor2a']+$testtt['odgovor2b']+$testtt['odgovor2c'])/3); 
                            $tsPostTest['odgovori']=$testtt;
                        }
                        
                        
                    
                    }
        $tsPostTest['stubovi']=$ceotest2;            
        $pred['post']=$tsPostTest;
        
        $pred['stubovi']=$ceotest;
        $sviTest[]=$pred;
        unset($ceotest,$ceotest2);
    }
    
    
    /// Ovo je kada se snimaju odgovori iz testa
    if (isset($_POST['testID'])){
            $data['test']=$_POST['testID'];
            $db->query('DELETE from ts_odgovori where test="'.$_POST['testID'].'"');
        foreach($_POST['odgovori'] as $pitanje => $odgovor){
            $data['pitanje']=$pitanje;
            $data['odgovor']=$odgovor;
            $db->insert('ts_odgovori',$data);
        }
        $dd['uradjen']=1;
        $dd['obavesten']=1;
        $db->update('ts_test',$dd,'id="'.$_POST['testID'].'"');
        
        /// Kreiraj posttest
        $podaci = $db->query_first("SELECT * from ts_test where id='".$_POST['testID']."'");
        $podaci['tip']='posttest';
        $podaci['uradjen']=0;
        unset($podaci['id']);
        $podaci['obavesten']=0;
        $podaci['vreme']= date('Y-m-d H:i:s', strtotime($podaci['vreme'] . ' +28 days'));
        $db->insert('ts_test',$podaci);
    }
   else if (isset($_REQUEST['test'])){  // Prikaz forme za određeni test
        $test = $db->query_first("SELECT korisnici.ime,test.* from ts_test test left join korisnici on (test.korisnik = korisnici.id) where test.id='".$_REQUEST['test']."' and test.uradjen=0");
        if (isset($test) and $test['id']!='' and $test['uradjen']!=1){
            
            $smarty->assign("test",$test);

            $pitanja = $db->fetch_array("SELECT *,pitanje as tekst from ts_pitanja where  cakra='".$test['planeta']."' ORDER BY rand() limit 30");
            $smarty->assign("pitanja",$pitanja);
     
        }
    }
    
    $smarty->display('showMeridijanTest.tpl');
    
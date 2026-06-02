<?php
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
require_once 'includes.php';
include (WEBROOT.BASEPATH.'standard_assign.php');

if (isset($_POST['testID'])){
    $data['test']=$_POST['testID'];
    $db->query('DELETE from meridijani_odgovori where test="'.$_POST['testID'].'"');
    foreach($_POST['odgovori'] as $pitanje => $odgovor){
        $data['pitanje']=$pitanje;
        $data['odgovor']=$odgovor;
        $db->insert('meridijani_odgovori',$data);
    }
    $dd['uradjen']=1;
    $db->update('meridijani_test',$dd,'id="'.$_POST['testID'].'"');
}
else if (isset($_REQUEST['test'])){
    $test = $db->query_first("SELECT korisnici.ime,test.* from meridijani_test test left join korisnici on (test.korisnik = korisnici.id) where test.id='".$_REQUEST['test']."' and test.uradjen=0");
    if (isset($test) and $test['id']!='' and $test['uradjen']!=1){
        
        $smarty->assign("test",$test);

        $pitanja = $db->fetch_array("SELECT * from meridijani_pitanja where  meridijan='".$test['meridijan']."' ORDER BY rand() limit 100");
        $smarty->assign("pitanja",$pitanja);
    }
}

$smarty->display('showMeridijanTest.tpl');
?>

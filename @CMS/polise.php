<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('polise');
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_add();
    $xcrud->where('osiguranje!="komdom"');
    $xcrud->order_by('broj','desc');
    $xcrud->limit_list(array('10', '200', '500', '1000', 'all'));

$xcrud->relation('api','kanal','id',array('naziv'));          
$xcrud->columns('broj,datum,api,tip,period_od,period_do,podrucje,ime,jmbg,pasos,adresa,telefon,email,saglasan,iznos,kod,status');
$xcrud->fields('broj,datum,tip,period_od,period_do,podrucje,premija,doplaci,porez,dodatno2,dodatno3,iznos,generated,sent',false,'Osnovno');
$xcrud->fields('ime,jmbg,pasos,adresa,telefon,email',false,'Ugovarač');  
$xcrud->fields('osig1_ime,osig1_jmbg,osig1_datum,osig1_pasos',false,'Osigurano lice 1');
$xcrud->fields('osig2_ime,osig2_jmbg,osig2_datum,osig2_pasos',false,'Osigurano lice 2');
$xcrud->fields('osig3_ime,osig3_jmbg,osig3_datum,osig3_pasos',false,'Osigurano lice 3');
$xcrud->fields('osig4_ime,osig4_jmbg,osig4_datum,osig4_pasos',false,'Osigurano lice 4');
$xcrud->fields('osig5_ime,osig5_jmbg,osig5_datum,osig5_pasos',false,'Osigurano lice 5');
$xcrud->fields('osig6_ime,osig6_jmbg,osig6_datum,osig6_pasos',false,'Osigurano lice 6');
$xcrud->fields('osig7_ime,osig7_jmbg,osig7_datum,osig7_pasos',false,'Osigurano lice 7');
$xcrud->fields('osig8_ime,osig8_jmbg,osig8_datum,osig8_pasos',false,'Osigurano lice 8');
$xcrud->fields('osig9_ime,osig9_jmbg,osig9_datum,osig9_pasos',false,'Osigurano lice 9');
$xcrud->fields('osig10_ime,osig10_jmbg,osig10_datum,osig10_pasos',false,'Osigurano lice 10');
$xcrud->fields('osig11_ime,osig11_jmbg,osig11_datum,osig11_pasos',false,'Osigurano lice 11');
$xcrud->fields('osig12_ime,osig12_jmbg,osig12_datum,osig12_pasos',false,'Osigurano lice 12');
$xcrud->fields('osig13_ime,osig13_jmbg,osig13_datum,osig13_pasos',false,'Osigurano lice 13');
$xcrud->fields('Response,AuthCode,HostRefNum,ProcReturnCode,TransId,mdStatus,EXTRA_TRXDATE,status',false,'Banka');
$xcrud->column_pattern('broj','<a href="../../getPolisa.php?broj={value}" target="_blank">{value}</a>');
$xcrud->button('/CRON/force.php?broj={broj}','Generiši ponovo PZO','icon-loop-3','','',array("osiguranje","=","pzo"));
$xcrud->button('/CRON/forceDZO.php?broj={broj}','Generiši ponovo DZO','icon-loop-3','','',array("osiguranje","=","dzo"));
$xcrud->button('/CRON/forceDjacko.php?broj={broj}','Generiši ponovo Đačko','icon-loop-3','','',array("osiguranje","=","djacko"));
$xcrud->label('osig1_ime','Ime i prezime');
$xcrud->label('osig2_ime','Ime i prezime');
$xcrud->label('osig3_ime','Ime i prezime');
$xcrud->label('osig4_ime','Ime i prezime');
$xcrud->label('osig5_ime','Ime i prezime');
$xcrud->label('osig6_ime','Ime i prezime');
$xcrud->label('osig7_ime','Ime i prezime');
$xcrud->label('osig8_ime','Ime i prezime');
$xcrud->label('osig9_ime','Ime i prezime');
$xcrud->label('osig10_ime','Ime i prezime');
$xcrud->label('osig11_ime','Ime i prezime');
$xcrud->label('osig12_ime','Ime i prezime');
$xcrud->label('osig13_ime','Ime i prezime');
$xcrud->label('api','Kanal');

$xcrud->label('osig1_jmbg','JMBG');
$xcrud->label('osig2_jmbg','JMBG');
$xcrud->label('osig3_jmbg','JMBG');
$xcrud->label('osig4_jmbg','JMBG');
$xcrud->label('osig5_jmbg','JMBG');
$xcrud->label('osig6_jmbg','JMBG');
$xcrud->label('osig7_jmbg','JMBG');
$xcrud->label('osig8_jmbg','JMBG');
$xcrud->label('osig9_jmbg','JMBG');
$xcrud->label('osig10_jmbg','JMBG');
$xcrud->label('osig11_jmbg','JMBG');
$xcrud->label('osig12_jmbg','JMBG');
$xcrud->label('osig13_jmbg','JMBG');

$xcrud->label('osig1_datum','Datum rođenja');
$xcrud->label('osig2_datum','Datum rođenja');
$xcrud->label('osig3_datum','Datum rođenja');
$xcrud->label('osig4_datum','Datum rođenja');
$xcrud->label('osig5_datum','Datum rođenja');
$xcrud->label('osig6_datum','Datum rođenja');
$xcrud->label('osig7_datum','Datum rođenja');
$xcrud->label('osig8_datum','Datum rođenja');
$xcrud->label('osig9_datum','Datum rođenja');
$xcrud->label('osig10_datum','Datum rođenja');
$xcrud->label('osig11_datum','Datum rođenja');
$xcrud->label('osig12_datum','Datum rođenja');
$xcrud->label('osig13_datum','Datum rođenja');

$xcrud->label('pasos','Broj pasoša');
$xcrud->label('dodatno2','Gubitak prtljaga');
$xcrud->label('dodatno3','Prekid putovanja');
$xcrud->label('osig1_pasos','Broj pasoša');
$xcrud->label('osig3_pasos','Broj pasoša');
$xcrud->label('osig4_pasos','Broj pasoša');
$xcrud->label('osig2_pasos','Broj pasoša');
$xcrud->label('osig5_pasos','Broj pasoša');
$xcrud->label('osig6_pasos','Broj pasoša');
$xcrud->label('osig7_pasos','Broj pasoša');
$xcrud->label('osig8_pasos','Broj pasoša');
$xcrud->label('osig9_pasos','Broj pasoša');
$xcrud->label('osig10_pasos','Broj pasoša');
$xcrud->label('osig11_pasos','Broj pasoša');
$xcrud->label('osig12_pasos','Broj pasoša');
$xcrud->label('osig13_pasos','Broj pasoša');

$xcrud->label('generated','Napravljen PDF polise');
$xcrud->label('sent','Polisa poslata');
$xcrud->label('premija','Osiguran iznos');
$xcrud->label('iznos','Ukupno za naplatu');
$xcrud->label('period_od','Početak osiguranja');
$xcrud->label('period_do','Kraj osiguranja');
$xcrud->label('broj','Broj polise');
$xcrud->label('doplaci','Dodatno za naplatu');

$xcrud->button('#', "Prošla uplata", 'glyphicon glyphicon-euro icon-euro', 'btn xcrud-action btn-danger', array(
        'data-action' => 'makeSuccess',
        'data-task' => 'action',
        'data-primary' => '{id}'),
        
        array('status','!=','paid'));
         
    $xcrud->create_action('makeSuccess', 'makeSuccess');

$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Polise');

$breadcrumbs[]=array('link'=>'polise.php','title'=>'Polise');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
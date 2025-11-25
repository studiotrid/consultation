<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('polise');
    $xcrud->where('osiguranje="komdom"');
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_add();
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
$xcrud->fields('Response,AuthCode,HostRefNum,ProcReturnCode,TransId,mdStatus,EXTRA_TRXDATE,status',false,'Banka');
$xcrud->column_pattern('broj','<a href="../../getPolisa.php?broj={value}" target="_blank">{value}</a>');
$xcrud->button('/CRON/forceKomdom.php?broj={broj}','Generiši ponovo PDF','icon-loop-3');


$xcrud->label('osig1_ime','Ime i prezime');
$xcrud->label('osig2_ime','Ime i prezime');
$xcrud->label('osig3_ime','Ime i prezime');
$xcrud->label('osig4_ime','Ime i prezime');
$xcrud->label('osig5_ime','Ime i prezime');
$xcrud->label('api','Kanal');
$xcrud->label('osig1_jmbg','JMBG');
$xcrud->label('osig2_jmbg','JMBG');
$xcrud->label('osig3_jmbg','JMBG');
$xcrud->label('osig4_jmbg','JMBG');
$xcrud->label('osig5_jmbg','JMBG');

$xcrud->label('osig1_datum','Datum rođenja');
$xcrud->label('osig2_datum','Datum rođenja');
$xcrud->label('osig3_datum','Datum rođenja');
$xcrud->label('osig4_datum','Datum rođenja');
$xcrud->label('osig5_datum','Datum rođenja');

$xcrud->label('osig1_pasos','Broj pasoša');
$xcrud->label('osig3_pasos','Broj pasoša');
$xcrud->label('pasos','Broj pasoša');
$xcrud->label('dodatno2','Gubitak prtljaga');
$xcrud->label('dodatno3','Prekid putovanja');
$xcrud->label('osig4_pasos','Broj pasoša');
$xcrud->label('osig2_pasos','Broj pasoša');
$xcrud->label('osig5_pasos','Broj pasoša');


$xcrud->label('generated','Napravljen PDF polise');
$xcrud->label('sent','Polisa poslata');
$xcrud->label('premija','Osiguran iznos');
$xcrud->label('iznos','Ukupno za naplatu');
$xcrud->label('period_od','Početak osiguranja');
$xcrud->label('period_do','Kraj osiguranja');
$xcrud->label('broj','Broj polise');
$xcrud->label('doplaci','Dodatno za naplatu');

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
<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('standalone');
    $xcrud->where('tip','nezgoda');
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_add();
    $xcrud->order_by('broj','desc');


$xcrud->columns('broj,datum,osiguranje_od,osiguranje_do,ugovarac_ime,ugovarac_jmb,ugovarac_rezident,ugovarac_adresa,telefon,email,iznos,stanje');
$xcrud->fields('broj,osiguranje_od,osiguranje_do,ugovarac_ime,ugovarac_jmb,ugovarac_rezident,ugovarac_adresa,email,iznos,stanje,poslato,generisano',false,'Osnovno');
$xcrud->fields('ugovarac_ime,ugovarac_jmb,ugovarac_rezident,ugovarac_adresa,email',false,'Ugovarač');  
//$xcrud->fields('osig1_ime,osig1_jmbg,osig1_datum,osig1_pasos',false,'Osigurano lice');

//$xcrud->fields('Response,AuthCode,HostRefNum,ProcReturnCode,TransId,mdStatus,EXTRA_TRXDATE,status',false,'Banka');
$xcrud->column_pattern('broj','<a href="../../getPolisa.php?broj={value}" target="_blank">{value}</a>');
$xcrud->button('/CRON/standalone-nezgoda.php?broj={broj}','Generiši ponovo PDF','icon-loop-3');



$xcrud->label('iznos','Ukupno za naplatu');
$xcrud->label('osiguranje_od','Početak osiguranja');
$xcrud->label('osiguranje_do','Kraj osiguranja');
$xcrud->label('broj','Broj polise');


$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Polise (nezgoda)');

$breadcrumbs[]=array('link'=>'standalone-nezgoda.php','title'=>'Polise (nezgoda)');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('standalone');
    $xcrud->where('tip','imovina');
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_add();
    $xcrud->order_by('broj','desc');


$xcrud->columns('broj,datum,osiguranje_od,osiguranje_do,ugovarac_ime,ugovarac_jmb,ugovarac_rezident,ugovarac_adresa,telefon,email,iznos,stanje');
$xcrud->fields('broj,osiguranje_od,osiguranje_do,ugovarac_ime,ugovarac_jmb,ugovarac_rezident,ugovarac_adresa,email,iznos,stanje,poslato,generisano',false,'Osnovno');
$xcrud->fields('ugovarac_ime,ugovarac_jmb,ugovarac_rezident,ugovarac_adresa,email',false,'Ugovarač');  
$xcrud->fields('imovina_adresa,imovina_grad,imovina_tip,imovina_kvadratura,imovina_sprat,imovina_broj_stana,imovina_broj_ulaza,imovina_godina_izgradnje,imovina_broj_lista_nepokretnosti',false,'Imovina');

//$xcrud->fields('Response,AuthCode,HostRefNum,ProcReturnCode,TransId,mdStatus,EXTRA_TRXDATE,status',false,'Banka');
$xcrud->column_pattern('broj','<a href="../../getPolisa.php?broj={value}" target="_blank">{value}</a>');
$xcrud->button('/CRON/standalone-imovina.php?broj={broj}','Generiši ponovo PDF','icon-loop-3');



$xcrud->label('iznos','Ukupno za naplatu');
$xcrud->label('osiguranje_od','Početak osiguranja');
$xcrud->label('osiguranje_do','Kraj osiguranja');
$xcrud->label('broj','Broj polise');


$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Polise (imovina)');

$breadcrumbs[]=array('link'=>'standalone-imovina.php','title'=>'Polise (imovina)');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
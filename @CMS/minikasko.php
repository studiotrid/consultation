<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('minikasko_polise');
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_add();
    $xcrud->order_by('broj','desc');

$xcrud->columns('broj,datum,osiguranje_od,osiguranje_do,paket,ugovarac_ime,ugovarac_jmb,ugovarac_adresa,ugovarac_telefon,email,iznos,stanje');
$xcrud->fields('broj,datum,osiguranje_od,osiguranje_do,paket,email,iznos,stanje,generisano,poslato',false,'Osnovno');
$xcrud->fields('ugovarac_ime,ugovarac_jmb,ugovarac_adresa,ugovarac_telefon',false,'Ugovarač');  
$xcrud->fields('osiguranik_ime,osiguranik_jmb,osiguranik_adresa,osiguranik_telefon',false,'Osiguranik');  
$xcrud->fields('vozilo_marka,vozilo_model,vozilo_sasija,vozilo_tablice,vozilo_godiste,vozilo_zapremina,vozilo_polisaAO,vozilo_snaga',false,'Vozilo');  
$xcrud->column_pattern('broj','<a href="../../minikasko.php?id={id}&broj={value}" target="_blank">{value}</a>');

$slike = $xcrud->nested_table('Slike','id','minikasko_slike','polisa'); 
$slike->columns('slika');
$slike->change_type('slika', 'image','', array('path'=>'../../../polise/slike/')); 
$slike->unset_csv()->unset_remove()->unset_search()->unset_print()->unset_title();
//$xcrud->button('/CRON/force.php?broj={broj}','Generiši ponovo PDF','icon-loop-3');

/*
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
*/
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Mini kasko Polise');

$breadcrumbs[]=array('link'=>'minikasko.php','title'=>'Mini kasko - Polise');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
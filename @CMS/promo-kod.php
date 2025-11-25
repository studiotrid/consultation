<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('promokod');
  //  $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_add();
    $xcrud->order_by('izdato','desc');

          

$xcrud->label('iskoriscen','Iskorišćen');
$xcrud->relation('korisnik','korisnici','id',array('ime','prezime'));

$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Izdati Promo-kodovi');

$breadcrumbs[]=array('link'=>'promo-kod.php','title'=>'Izdati Promo-kodovi');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
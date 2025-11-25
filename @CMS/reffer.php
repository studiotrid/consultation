<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('reffer');
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_add();

          

$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Reffer');

$breadcrumbs[]=array('link'=>'reffer.php','title'=>'Poreklo saobraćaja');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
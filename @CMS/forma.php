<?php
require_once 'includes.php';

$xcrud = Xcrud::get_instance();
$xcrud->table('ikcg');
$xcrud->unset_edit();
$xcrud->unset_remove();
$xcrud->unset_add();

$operiod = $xcrud->nested_table('Članovi','id','ikcg_clan','upis');     
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Polise');

$breadcrumbs[]=array('link'=>'forma.php','title'=>'IKCG');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
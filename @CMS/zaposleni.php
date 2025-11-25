<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('zaposleni'); 
    $xcrud->unset_view();
    $xcrud->unset_remove();

    $xcrud->before_insert('hash_password2');
    $xcrud->before_update('hash_password_update2');
 
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Zaposleni');

$breadcrumbs[]=array('link'=>'zaposleni.php','title'=>'Zaposleni');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
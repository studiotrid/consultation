<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('korisnici');
    $xcrud->unset_view();
    $xcrud->unset_remove();


          

    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Registrovani korisnici');

$breadcrumbs[]=array('link'=>'registrovani.php','title'=>'Registrovani korisnici');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
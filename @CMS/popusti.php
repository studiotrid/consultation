<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('popusti');
    $smarty->assign('xcrud_js',Xcrud::load_js());
    $smarty->assign('xcrud_css',Xcrud::load_css());
    $breadcrumbs[]=array('link'=>'popusti.php','title'=>'Popusti');
    $smarty->assign('page_title',"Popusti");
    $smarty->assign('breadcrumbs',$breadcrumbs);
    $xcrud->label('od',"Od datuma");
    $xcrud->label('do',"Do datuma");
    $xcrud->label('popust',"Popust u %");
    
 if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
 
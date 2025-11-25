<?php 
require_once 'includes.php';

$smarty->assign('page_title','Media Library');


$breadcrumbs[]=array('link'=>'mediaLibrary','title'=>'Media Library');
$smarty->assign('breadcrumbs',$breadcrumbs);

$smarty->assign("fileupload", true); 

if ($login->isLoggedIn()) $smarty->assign("content", $smarty->fetch('mediaLibrary.tpl'));   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
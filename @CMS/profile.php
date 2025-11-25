<?php 
require_once 'includes.php';

$smarty->assign('page_title',ADMIN_PROFILE_TITLE);



$breadcrumbs[]=array('link'=>'profile','title'=>ADMIN_PROFILE_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $smarty->fetch('profile.tpl'));   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
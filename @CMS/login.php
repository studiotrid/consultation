<?php 
require_once 'includes.php';
 
if (isset($_POST['login'])) {
    if (isset($_POST['remember'])) $remember=$_POST['remember'];
    else $remember=false;
    if ($login->checkLogin($_POST['username'], $_POST['password'])) {
        header('Location: index.php');
    } else {
        $smarty->assign('message', ADMIN_LOGIN_ERROR);
        $smarty->assign("login", 'login'); 
        
    }
}
else {
        $smarty->assign('message', ADMIN_LOGIN_ERROR);
        $smarty->assign("login", 'login'); 
        
    }
 
$smarty->display('layout.tpl');
$db->close();
?>
<?php
require_once 'includes.php';

if (isset($_GET['SEO'])) {
 //   $page->getPageBySEO($_GET['SEO']);
    $smarty->assign("content", $smarty->fetch('page.tpl'));
    }
else {
    
    $smarty->assign('danas',date('d.m.Y'));
    
    if($login->isLoggedIn()){
        $smarty->assign('language',$login->getCoachLang());
        if(isset($_GET['tip'])) {
            $nazivTipa=$db->query_first("SELECT naziv from konsultacije_tip where id='".$_GET['tip']."'");
            $smarty->assign('nazivTipa',$nazivTipa['naziv']);
            $termini = $konsultacije->getCoachTermini($_SESSION['logged']);
            if($termini) $smarty->assign("termini", $termini);
            $smarty->assign('svesKonsultacije',$konsultacije->getSve($_GET['tip'],$_SESSION['logged']));
            $smarty->assign("levo", $smarty->fetch('lista.tpl'));
        }
        $smarty->assign("content", $smarty->fetch('frontpage.tpl'));
    }
    else 
        $smarty->assign("content", $smarty->fetch('login.tpl'));
}

//$smarty->debugging = true;
$smarty->display('layout.tpl');

$db->close();
?>
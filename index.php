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
        include("testovi.php");
        
        if(isset($_GET['tip'])) {
            if($_GET['tip']==0){
                //$smarty->assign('svesKonsultacije',$svitesss);
                $smarty->assign("levo", $smarty->fetch('test-levo.tpl'));
            }
            else{
                $nazivTipa=$db->query_first("SELECT naziv from konsultacije_tip where id='".$_GET['tip']."'");
                $smarty->assign('nazivTipa',$nazivTipa['naziv']);
                $termini = $konsultacije->getCoachTermini($_SESSION['logged']);
                if($termini) $smarty->assign("termini", $termini);
                $smarty->assign('buduceTipKonsultacije',$konsultacije->getBuduce($_SESSION['logged'], $_GET['tip']));
                $smarty->assign('svesKonsultacije',$konsultacije->getSve($_GET['tip'],$_SESSION['logged']));
                $smarty->assign("levo", $smarty->fetch('lista.tpl'));
            }
            
        }
        $smarty->assign("content", $smarty->fetch('frontpage.tpl'));
    }
    else 
        $smarty->assign("content", $smarty->fetch('login.tpl'));
}


// Osiguraj da se stranica ne cache-a
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0', true);
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache', true);
header('Expires: 0', true);

//$smarty->debugging = true;
$smarty->display('layout.tpl');

$db->close();
?>
<?php
   // $l->populateForSmarty();
    $smarty->assign('basepath',BASEPATH);

    if($login->isLoggedIn()){
        $smarty->assign('logged',true);
        $konsultacije = Konsultacije::getInstance();
        $smarty->assign('lastKonsultacija',$konsultacije->getLast($_SESSION['logged']));
        $smarty->assign('sveKonsultacije',$konsultacije->getSveTipove($_SESSION['coach'],$_SESSION['logged']));
        $coach=$login->getCoach();
        $smarty->assign('logo',$coach['logo']);
        $smarty->assign('potpis',$coach['potpis']);
    }
        
    
    if(isset($_GET['language']))  
        $_SESSION['language'] = $_GET['language'];
    else if($login->isLoggedIn())
        $_SESSION['language'] = $login->getCoachLang();
           
    $smarty->assign('language',$_SESSION['language']);
    $smarty->assign('date_format',$date_format);
    $smarty->assign('rnd',rand(0,65500));
?>
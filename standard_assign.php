<?php
   // $l->populateForSmarty();
    $smarty->assign('basepath',BASEPATH);

    if($login->isLoggedIn()){
        $smarty->assign('logged',true);
        $konsultacije = Konsultacije::getInstance();
        $lastKonsultacija = $konsultacije->getLast($_SESSION['logged']);
        $lastKonsultacijaTip = 0;
        if(is_array($lastKonsultacija) && isset($lastKonsultacija[0]) && is_array($lastKonsultacija[0]) && isset($lastKonsultacija[0]['tip'])){
            $lastKonsultacijaTip = intval($lastKonsultacija[0]['tip']);
        }
        $smarty->assign('lastKonsultacija', $lastKonsultacija);
        $smarty->assign('lastKonsultacijaTip', $lastKonsultacijaTip);
        $smarty->assign('buduceKonsultacije',$konsultacije->getBuduce($_SESSION['logged']));
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
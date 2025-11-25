<?php
    $lang->populateForSmarty();
    $smarty->assign('basepath',BASEPATH.'@CMS/');
    $langs=$db->fetch_array("SELECT * from langs ");
    $smarty->assign('langs',$langs);
    //$smarty->assign('menuitems',$main_menu->getMenuList());
    $smarty->assign('lang',DEFAULT_LANG);
    $smarty->assign('sliderEnabled',$config->slider);
    $smarty->assign('galleryEnabled',$config->gallery);
    $smarty->assign('portfolioEnabled',$config->portfolio);
?>
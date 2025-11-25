<?php
    session_start();
    date_default_timezone_set('Europe/Belgrade');
    
    require_once 'inc/conf/env.php';	# Environment vars
    $_SESSION['language'] = DEFAULT_LANG;

    // Uèitaj Composer autoloader
    require_once __DIR__ . '/vendor/autoload.php';
    
    $smarty = new Smarty();
    
    // Opcionalno: konfiguracija foldera
    $smarty->setTemplateDir(__DIR__ . '/templates/');
    $smarty->setCompileDir(__DIR__ . '/templates_c/');
    $smarty->setCacheDir(__DIR__ . '/cache/');
    $smarty->setConfigDir(__DIR__ . '/configs/');
    
	require_once (WEBROOT.BASEPATH.'inc/conf/db.php');	     # Database connection 
    require_once (WEBROOT.BASEPATH.'inc/functions.php');	 # Various functions 
    require_once (WEBROOT.BASEPATH.'inc/class/Login.class.php');   # Languages
    require_once (WEBROOT.BASEPATH.'inc/class/konsultacije.class.php');   # Languages
     
    $login = Login::getInstance();
    
    if(isset($_POST['username'])){

        if ( ($_POST['username'] != '') && ($_POST['password']!='') && $login->checkLogin(strip_tags($_POST['username']), strip_tags($_POST['password'])) ) {
            
            $smarty->assign('status', 'ok');
            $smarty->assign('message', _('Logged in'));
            header('Location: index.php');
        } else {
            $smarty->assign('status', 'error');
            $smarty->assign('message', _('Wrong data entered // Please, try again!'));
        }
    }
    
    if(isset($_GET['logout']))
            $login->logout();
    

    require_once (WEBROOT.BASEPATH.'standard_assign.php');       # Standard Smarty assigns
    
?>
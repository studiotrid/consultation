<?php
    error_reporting(0);
	ini_set("display_errors", "Off");

    require_once '../include/conf/env.php';	# Environment vars 
    require_once( WEBROOT.BASEPATH.'libs/Smarty.class.php');
    
    $smarty = new Smarty();
    $smarty->template_dir = WEBROOT.BASEPATH.'@CMS/templates/';
    $smarty->compile_dir  = WEBROOT.BASEPATH.'@CMS/templates_c/';
    $smarty->config_dir   = WEBROOT.BASEPATH.'configs/';
    $smarty->cache_dir    = WEBROOT.BASEPATH.'cache/';
    
	
	require_once (WEBROOT.BASEPATH.'include/conf/db.php');	     # Database connection 
    require_once (WEBROOT.BASEPATH.'include/conf/config.php');   # Config
    
    $config=new Config();
    
    require_once (WEBROOT.BASEPATH.'include/functions.php');	 # Various functions 
    require_once (WEBROOT.BASEPATH.'@CMS/includes/classes/lang.class.php');   # Languages
    require_once (WEBROOT.BASEPATH.'include/class/menu.class.php');   # Menus

    
    if (isset($_GET['language'])) {
        $lang_code=$_GET['language'];
        $_SESSION['language']=$lang_code;
    }
    if (!isset($_SESSION['language'])) $lang_code=DEFAULT_LANG;
    else $lang_code=$_SESSION['language'];
    
    $lang_code = 'en';
    $lang=new Lang($lang_code);
    $main_menu=new Menus(1,1);
    
    require_once('includes/classes/Login.class.php');  /// LOGIN
    $login = Login::getInstance();
    
        require_once (WEBROOT.BASEPATH.'@CMS/standard_assign.php');       # Standard Smarty assigns
    
if ($login->isLoggedIn()) {
    if (isset($_GET['page']) && $_GET['page'] == 'logout') {
        $login->logout();
        $smarty->assign("login", 'login'); 
    }

if (isset($_POST['profileChange'])){
    if ($login->checkLevel()<10) $_POST['adminRole']=$login->checkLevel();
    $login->changeUserDetails($_POST);
    
}
    $smarty->assign('loggedInUser',$login->getUserDetails());

}
else if(isset($_COOKIE['un']) && isset($_COOKIE['pw'])) $login->checkLogin($_COOKIE['un'], $_COOKIE['pw']);

    

    
    define('ADMIN_URL', rtrim($admin_url,'/'));
    require (ADMIN_URL.'/xcrud/xcrud.php');
    $_SESSION['ROOT']=ADMIN_URL;
    require_once (ADMIN_URL.'/xcrud/xcrud_config.php');
    Xcrud_config::$scripts_url = ADMINPATH.'xcrud';
    Xcrud_config::$dbname = DB_NAME;
    Xcrud_config::$dbuser = DB_USER;
    Xcrud_config::$dbpass = DB_PASS;
    Xcrud_config::$dbhost = DB_HOST;
    //session_start();
?>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_DEPRECATED);
    
	define("LOCAL",  true); // PARAMETERS FOR LOCAL AND REMOTE
	if(LOCAL===true){ // local
        define("ROOT",  'D:\consulting\\');
        define("WEBROOT",  'D:\\consulting');
        define("BASEPATH",'/');
        define('DB_HOST', "localhost");
        define('DB_USER', "root");
        define('DB_PASS', "");
        define('DB_NAME', "coach");
	}
	
	else{  // remote
		define("WEBROOT",  '/home/admin/web/consultation.profesionalnaastrologija.com/public_html');
		define("BASEPATH",'/');
		define('DB_HOST', "localhost");
	    define('DB_USER', "admin_coach");
	    define('DB_PASS', "NbkP6Hdtl5NbkP6Hdtl5");
	    define('DB_NAME', "admin_coach");
	}
    
    
    define('PASSWORD_SALT', 'OvoJeSo');
	define("WEBSITE",'http://consulting.local');
    define("SITEADMINADRESS",WEBROOT.BASEPATH.'@CMS/');
    define("UPLOAD",WEBROOT.BASEPATH.'upload/');
    
    if (!isset($_SESSION['upload'])) $_SESSION['upload']=UPLOAD;

    define("DEFAULT_LANG",'en_US.utf8');

    
    if (isset($_GET['language'])) {
       // session_destroy();
        unset($_SESSION['language']);
        $lang_code=$_GET['language'];
        $_SESSION['language']=$_GET['language'];
    }
    if (!isset($_SESSION['language'])) {
        $lang_code=DEFAULT_LANG;
        $_SESSION['language']=DEFAULT_LANG;
    }
    else $lang_code=$_SESSION['language'];
    
    setlocale(LC_ALL, $_SESSION['language']);
    //setlocale(LC_ALL, 'sr_RS@latin'); 
    define("ADMINPATH",BASEPATH.'@CMS/');
    define("ADMIN_EMAIL",'studio.trid@gmail.com');
    $webroot=WEBROOT;
    $admin_url = SITEADMINADRESS;
	$admin_root = SITEADMINADRESS; 
	$_root = WEBROOT;
	//define("ROOT",$admin_root); 
    
    bindtextdomain('messages', './locale'); 
    textdomain('messages'); 
    
    if($_SESSION['language']=='en_US.utf8') $date_format = '%m/%d/%Y';
    else if($_SESSION['language']=='sr_RS.utf8') $date_format = '%d.%m.%Y';
    
    
?>
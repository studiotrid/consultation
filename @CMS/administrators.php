<?php 
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('users');
    $xcrud->label('username',ADMIN_PROFILE_USERNAME)
          ->label('password',ADMIN_PROFILE_CHANGEPASS)
          ->label('Fname',ADMIN_PROFILE_FIRSTNAME)
          ->label('Lname',ADMIN_PROFILE_LASTNAME)
          ->label('phone',ADMIN_PROFILE_MOBILE)
          ->label('occupation',ADMIN_PROFILE_OCUPATION)
          ->label('website',ADMIN_PROFILE_WWW)
          ->label('picture',ADMIN_PROFILE_AVATAR)
          ->label('email',ADMIN_PROFILE_EMAIL);
          
    $xcrud->fields('phone,occupation,website,email',false,ADMIN_PROFILE_TITLE);
    $xcrud->fields('Fname,Lname,username',false,ADMIN_PROFILE_PERSONAL);
    $xcrud->fields('password',false,ADMIN_PROFILE_CHANGEPASS);
    $xcrud->fields('picture',false,ADMIN_PROFILE_CHANGEAVATAR);
    
    $xcrud->columns('picture,Fname,Lname,username');
    $xcrud->change_type('picture', 'image','', array('path'=>'../../upload/image/','width'=>420));
    
    $xcrud->before_insert('hash_password');
    $xcrud->before_update('hash_password_update');
    
    //$xcrud->change_type('password', 'password', 'md5', array('maxlength'=>10,'placeholder'=>'enter password'));
//    $xcrud->language('rs');
    
//  $xcrud->table_name('');


$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_ADMINISTRATOR_TITLE);

$breadcrumbs[]=array('link'=>'administrators','title'=>ADMIN_ADMINISTRATOR_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
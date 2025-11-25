<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('api');

$xcrud->label('name','Naziv API korisnika')
      ->label('user','Korisničko ime')
      ->label('pass','Šifra za pristup')
      ->label('active','Korisnik je aktivan?')
;
$xcrud->columns('name,user,pass,active');

$xcrud->fields('name,user,pass,active',false,'Osnovno');
//$xcrud->pass_var('link', base64_encode("{kod}"));
$xcrud->before_insert('hash_api_password');
$xcrud->before_update('hash_api_password_update');


//$xcrud->change_type('link','hidden');

$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','API pristup');

$breadcrumbs[]=array('link'=>'api.php','title'=>'API korisnici');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
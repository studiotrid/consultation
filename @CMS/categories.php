<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('categories');

    $xcrud->order_by('created','desc'); 
    
    $xcrud->label('title',ADMIN_CATEGORIES_PAGE_TITLE)
          ->label('created',ADMIN_CATEGORIES_CREATED)
          ->label('active',ADMIN_CATEGORIES_ACTIVE);
          

$xcrud->columns('title,active');

    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_CATEGORIES_TITLE);

$breadcrumbs[]=array('link'=>'pages','title'=>ADMIN_CATEGORIES_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
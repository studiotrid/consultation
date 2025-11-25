<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('menus');
    $xcrud->unset_view();
    $xcrud->label('title',ADMIN_MENUS_MENUS_TITLE)
          ->label('position',ADMIN_MENUS_POSITION)
          ->label('active',ADMIN_MENUS_ACTIVE);
    $xcrud->relation('position','menu_positions','id',array('title'));
    $xcrud->button(BASEPATH.'@CMS/menu_items?menu_id={id}',ADMIN_MENUS_ELEMENTS,'icon-sitemap','button','menu_id','id');
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_MENUS_TITLE);

$breadcrumbs[]=array('link'=>'menus','title'=>ADMIN_MENUS_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
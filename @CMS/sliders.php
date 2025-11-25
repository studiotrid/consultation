<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('sliders');
    
    $xcrud->label('title',ADMIN_SLIDERS_SLIDE_TITLE)
          ->label('active',ADMIN_SLIDERS_ACTIVE);
          

$xcrud->columns('title,active');
$xcrud->button(BASEPATH.'@CMS/slider_items?slider_id={id}',ADMIN_SLIDER_ELEMENTS,'icon-expand','button','sliders','id');
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_SLIDERS_TITLE);


$breadcrumbs[]=array('link'=>'pages','title'=>ADMIN_SLIDERS_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
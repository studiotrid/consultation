<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('portfolios');
    
    $xcrud->label('name',ADMIN_PORTFOLIO_TITLE)
          ->label('type',ADMIN_PORTFOLIO_TYPE);
    $xcrud->fields('name,type',false);
    $xcrud->relation('type','portfolio_types','id',array('name'));
 
  
$xcrud->columns('name,type');
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_PORTFOLIOS);


$breadcrumbs[]=array('link'=>'portfolios','title'=>ADMIN_PORTFOLIOS);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
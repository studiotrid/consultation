<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('portfolio_categories');
    
    $xcrud->label('name',ADMIN_PORTFOLIO_CATEGORY_TITLE);
    $xcrud->fields('name',false,ADMIN_GENERAL);
    $xcrud->columns('name');
    
    $xcrud->button(BASEPATH.'@CMS/portfolioItems?category_id={id}',ADMIN_PORTFOLIO_CATEGORY_ELEMENTS,'icon-expand','button','category','id');
    
$langs=$db->fetch_array("SELECT id,code,name from langs ");  
foreach($langs as $lang){
    $item_lang = $xcrud->nested_table($lang['name'],'id','portfolio_category_lang','category'); 
    $item_lang->where('lang=',$lang['id']);

    $item_lang->label('name',ADMIN_PORTFOLIO_CATEGORY_TITLE);
               
    $item_lang->change_type('category','hidden');
    $item_lang->pass_var('lang', $lang['id'], 'create');
    $item_lang->fields('name',false,ADMIN_PAGES_SEO_TAB);
    $item_lang->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    $item_lang->relation('lang','langs','id',array('name'));
}
    
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_PORTFOLIO_CATEGORY);


$breadcrumbs[]=array('link'=>'portfolioCategories','title'=>ADMIN_PORTFOLIO_CATEGORY);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
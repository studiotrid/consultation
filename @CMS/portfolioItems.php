<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('portfolio_items');
    $xcrud->unset_view();
    
  if (isset($_GET['category_id']))  $xcrud->where($_GET['category_id'].' IN (category)');
    
    $xcrud->label('name',ADMIN_PORTFOLIO_ITEM_NAME)
          ->label('active',ADMIN_PORTFOLIO_ITEM_ACTIVE)
          ->label('orderno',ADMIN_PORTFOLIO_ITEM_ORDER);
          
    $xcrud->label('category',ADMIN_PORTFOLIO_CATEGORY);

    $xcrud->relation('category','portfolio_categories','id',array('name'),'','',true);
if (!isset($_GET['category_id'])){     
    $xcrud->columns('name,category,active');
    $xcrud->fields('name,category,active',false,ADMIN_GENERAL);
    }
  else{  
    $xcrud->change_type('category','hidden');
    $xcrud->columns('name,active');
    $xcrud->fields('name,active',false,ADMIN_GENERAL);
    
    $xcrud->pass_var('category', $_GET['category_id'], 'create');
    $xcrud->button('#', "Top", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'movePortfolioTop',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $xcrud->button('#', "Bottom", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'movePortfolioBottom',
        'data-task' => 'action',
        'data-primary' => '{id}'));
         
    $xcrud->create_action('movePortfolioTop', 'movePortfolioTop');
    $xcrud->create_action('movePortfolioBottom', 'movePortfolioBottom');
     
    $xcrud->unset_sortable();
    $xcrud->order_by('orderno');
}

    
////////////// Langs Tab
$langs=$db->fetch_array("SELECT id,code,name from langs ");  
foreach($langs as $lang){

    $item_lang = $xcrud->nested_table($lang['name'],'id','portfolio_items_lang','item'); 
    $item_lang->where('lang=',$lang['id']);
    $item_lang->columns('name,content');
    $item_lang->label('name',ADMIN_PORTFOLIO_ITEM_NAME)
              ->label('content',ADMIN_PORTFOLIO_ITEM_DESC)
              ->label('lang',ADMIN_PORTFOLIO_ITEM_LANG);
               
    $item_lang->change_type('item','hidden');
    $item_lang->fields('name,content',false,ADMIN_GENERAL);
    $item_lang->pass_var('lang', $lang['id'], 'create');
    $item_lang->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    $item_lang->relation('lang','langs','id',array('name'));
    
    ////////////// Tabs Tab
    $tabs = $item_lang->nested_table(ADMIN_PORTFOLIO_TABS.' ['.$lang['name'].']','id','portfolio_tabs','item'); 
    $tabs->where('lang=',$lang['id']);
    $tabs->fields('name,content',false);
    
    $tabs->label('name',ADMIN_PORTFOLIO_TABS_NAME)
         ->label('content',ADMIN_PORTFOLIO_TABS_CONTENT);
             
    $tabs->change_type('lang,item','hidden');
    $tabs->pass_var('lang', $lang['id'], 'create');
    $tabs->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    
}


////////////// Images Tab
    $featured = $xcrud->nested_table(ADMIN_PAGES_TAB_IMAGES,'id','featured_images','item'); 
    $featured->where('type=','portfolio');
    $featured->fields('slika,redosled',false);
    
    $featured->label('slika',ADMIN_PAGES_IMAGE)
             ->label('redosled',ADMIN_PAGES_ORDER);
             
    $featured->change_type('type,item','hidden');
    $featured->pass_var('type', 'portfolio', 'create');
    $featured->change_type('slika', 'image','', array('path'=>UPLOAD.'image'));
    $featured->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();


//////////////          
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_PORTFOLIO_ELEMENTS);

if (isset($_GET['category_id'])){
    $breadcrumbs[]=array('link'=>'portfolioCategory','title'=>ADMIN_PORTFOLIO_CATEGORY);
    $breadcrumbs[]=array('link'=>'portfolioItems?category_id='.$_GET['category_id'],'title'=>ADMIN_PORTFOLIO_ELEMENTS);
}
    $breadcrumbs[]=array('link'=>'portfolioItem','title'=>ADMIN_PORTFOLIO_ELEMENTS);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
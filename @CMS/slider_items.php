<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('slider_items');
    $xcrud->unset_view();
    $xcrud->where('slider =', $_GET['slider_id']);
    
    $xcrud->label('title',ADMIN_SLIDER_SLIDE_TITLE)
          ->label('background',ADMIN_SLIDER_BG)
          ->label('active',ADMIN_SLIDER_ACTIVE)
          ->label('orderno',ADMIN_SLIDER_ORDER);
          
$xcrud->change_type('background', 'image','', array('path'=>UPLOAD.'image'));
$xcrud->fields('title,background,orderno,active',false,ADMIN_PAGES_GENERAL);
$xcrud->relation('parent','sliders','id',array('title'));
$xcrud->pass_var('slider', $_GET['slider_id'], 'create');

    $xcrud->button('#', "Top", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'movetop',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $xcrud->button('#', "Bottom", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'movebottom',
        'data-task' => 'action',
        'data-primary' => '{id}'));
         
    $xcrud->create_action('movetop', 'moveSlidersTop');
    $xcrud->create_action('movebottom', 'moveSlidersBottom');
     
    $xcrud->unset_sortable();
    $xcrud->order_by('orderno');
    

$langs=$db->fetch_array("SELECT id,code,name from langs ");  
foreach($langs as $lang){
    $pages_lang = $xcrud->nested_table($lang['name'],'id','sliders_lang','slider_item'); 
    $pages_lang->where('lang=',$lang['id']);
    $pages_lang->columns('content');
    $pages_lang->fields('content',false);
    $pages_lang->label('content',ADMIN_SLIDER_CONTENT)
               ->label('lang',ADMIN_SLIDER_LANG);
    
               
    $pages_lang->change_type('content','textarea');
    $pages_lang->change_type('slider_item','hidden');
    $pages_lang->pass_var('lang', $lang['id'], 'create');
    $pages_lang->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    $pages_lang->relation('lang','langs','id',array('name'));
    
    $elements_lang = $pages_lang->nested_table('Elements','id','sliders_lang_element','slide_element'); 
    $elements_lang->change_type('slide_element','hidden'); 
    $elements_lang->change_type('image', 'image','', array('path'=>UPLOAD.'image'));
    $elements_lang->no_editor('css,content');
}
          
    $xcrud->columns('title,active');
    $xcrud->pass_var('slider', $_GET['slider_id'], 'create');
    
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_SLIDER_ITEMS_TITLE);

$breadcrumbs[]=array('link'=>'sliders','title'=>ADMIN_SLIDERS_TITLE);
$breadcrumbs[]=array('link'=>'slider_items?slider_id='.$_GET['slider_id'],'title'=>ADMIN_SLIDER_ITEMS_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
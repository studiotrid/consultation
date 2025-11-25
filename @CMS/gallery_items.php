<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('gallery_items');
    $xcrud->unset_view();
    $xcrud->where('gallery =', $_GET['gallery_id']);
    
    $xcrud->label('image',ADMIN_GALLERY_IMAGE)
          ->label('orderno',ADMIN_GALLERY_ORDER);
          
$xcrud->change_type('image', 'image','', array('path'=>UPLOAD.'image'));
$xcrud->fields('image',false,ADMIN_GENERAL);
$xcrud->relation('gallery','gallery','id',array('title'));
$xcrud->columns('image');

$xcrud->pass_var('gallery', $_GET['gallery_id'], 'create');

    $xcrud->button('#', "Top", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'moveGalleryTop',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $xcrud->button('#', "Bottom", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'moveGalleryBottom',
        'data-task' => 'action',
        'data-primary' => '{id}'));
         
    $xcrud->create_action('moveGalleryTop', 'moveGalleryTop');
    $xcrud->create_action('moveGalleryBottom', 'moveGalleryBottom');
     
    $xcrud->unset_sortable();
    $xcrud->order_by('orderno');
    

$langs=$db->fetch_array("SELECT id,code,name from langs ");  
foreach($langs as $lang){
    $pages_lang = $xcrud->nested_table($lang['name'],'id','gallery_image_desc','image'); 
    $pages_lang->where('lang=',$lang['id']);
    $pages_lang->columns('desc');
    $pages_lang->fields('desc',false);
    $pages_lang->label('desc',ADMIN_GALLERY_IMAGE_DESC)
               ->label('lang',ADMIN_GALLERY_IMAGE_LANG);
               
    $pages_lang->change_type('desc','textarea');
    $pages_lang->change_type('image','hidden');
    $pages_lang->pass_var('lang', $lang['id'], 'create');
    $pages_lang->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    $pages_lang->relation('lang','langs','id',array('name'));
}
          


    
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_GALLERY_ELEMENTS);

$breadcrumbs[]=array('link'=>'galleries','title'=>ADMIN_GALLERY_TITLE);
$breadcrumbs[]=array('link'=>'gallery_items/?gallery_id='.$_GET['gallery_id'],'title'=>ADMIN_GALLERY_ELEMENTS);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
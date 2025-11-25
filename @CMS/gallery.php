<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('gallery');
    
    $xcrud->label('title',ADMIN_GALLERY_GALLERY_TITLE)
          ->label('date',ADMIN_GALLERY_DATE)
          ->label('active',ADMIN_GALLERY_ACTIVE);
  $xcrud->fields('title,date,active',false,ADMIN_GENERAL);
  
$langs=$db->fetch_array("SELECT id,code,name from langs ");  
foreach($langs as $lang){
    $pages_lang = $xcrud->nested_table($lang['name'],'id','gallery_lang','gallery'); 
    $pages_lang->where('lang=',$lang['id']);
    $pages_lang->columns('title,content');
    $pages_lang->fields('title,content',false);
    $pages_lang->label('content',ADMIN_GALLERY_CONTENT)
               ->label('title',ADMIN_GALLERY_GALLERY_TITLE)
               ->label('lang',ADMIN_GALLERY_IMAGE_LANG);
               
    $pages_lang->change_type('content','textarea');
    $pages_lang->change_type('gallery','hidden');
    $pages_lang->pass_var('lang', $lang['id'], 'create');
    $pages_lang->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    $pages_lang->relation('lang','langs','id',array('name'));
}
  
          

$xcrud->columns('title,active');
$xcrud->button(BASEPATH.'@CMS/gallery_items?gallery_id={id}',ADMIN_GALLERY_ELEMENTS,'icon-expand','button','gallery','id');
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_GALLERY_TITLE);


$breadcrumbs[]=array('link'=>'gallery','title'=>ADMIN_GALLERY_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
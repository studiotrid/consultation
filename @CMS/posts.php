<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('posts');
    $xcrud->unset_view();
    $xcrud->order_by('created','desc'); 
    
    $xcrud->label('title',ADMIN_POSTS_PAGE_TITLE)
          ->label('category',ADMIN_POSTS_CATEGORY)
          ->label('author',ADMIN_POSTS_AUTHOR)
          ->label('show_title',ADMIN_POSTS_SHOW_TITLE)
          ->label('created',ADMIN_POSTS_CREATED)
          ->label('active',ADMIN_POSTS_ACTIVE);
          

$xcrud->fields('title,category,author,created,active',false,ADMIN_POSTS_GENERAL);
$xcrud->relation('category','categories','id',array('title'));

$langs=$db->fetch_array("SELECT id,code,name from langs ");  
foreach($langs as $lang){
    $posts_lang = $xcrud->nested_table($lang['name'],'id','posts-lang','post'); 
    $posts_lang->where('lang=',$lang['id']);
    $posts_lang->columns('meta_title,intro');
    $posts_lang->fields('title,intro,content,active',false,ADMIN_POSTS_CONTENT);
    $posts_lang->label('content',ADMIN_POSTS_CONTENT)
               ->label('lang',ADMIN_POSTS_LANG)
               ->label('intro',ADMIN_POSTS_INTRO)
               ->label('created',ADMIN_POSTS_CREATED)
               ->label('active',ADMIN_POSTS_ACTIVE)
               ->label('meta_title',ADMIN_POSTS_META_TITLE)
               ->label('meta_keywords',ADMIN_POSTS_META_KEY)
               ->label('meta_desc',ADMIN_POSTS_META_DESC);
               
    $posts_lang->change_type('meta_desc,intro','textarea');
    $posts_lang->change_type('post','hidden');
    $posts_lang->fields('meta_title,meta_keywords,meta_desc',false,ADMIN_POSTS_SEO_TAB);
    $posts_lang->pass_var('lang', $lang['id'], 'create');
    $posts_lang->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    $posts_lang->relation('lang','langs','id',array('name'));
}
        
    $featured = $xcrud->nested_table(ADMIN_POSTS_TAB_IMAGES,'id','featured_images','item'); 
    $featured->where('type=','post');
    $featured->fields('slika,redosled',false);
    $featured->label('slika',ADMIN_POSTS_IMAGE)
             ->label('redosled',ADMIN_POSTS_ORDER);
             
    $featured->change_type('type,item','hidden');
    $featured->pass_var('type', 'post', 'create');
    $featured->change_type('slika', 'image','', array('path'=>UPLOAD.'image'));
    $featured->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    
    $featured->button('#', "Top", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'moveImageTop',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $featured->button('#', "Bottom", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'moveImageBottom',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $featured->create_action('movetop', 'moveImageTop');
    $featured->create_action('movebottom', 'moveImageBottom');
     
    $featured->unset_sortable();
    $featured->order_by('redosled');
    
    $xcrud->columns('title,category,active');

    
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_POSTS_TITLE);

$breadcrumbs[]=array('link'=>'pages','title'=>ADMIN_POSTS_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
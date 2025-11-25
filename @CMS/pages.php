<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('pages');
    $xcrud->unset_view();

    $xcrud->order_by('created','desc'); 
    
    $xcrud->label('title',ADMIN_PAGES_PAGE_TITLE)
          ->label('parent',ADMIN_PAGES_PARENT)
          ->label('show_title',ADMIN_PAGES_SHOW_TITLE)
          ->label('before_page',ADMIN_PAGES_BEFORE)
          ->label('after_page',ADMIN_PAGES_AFTER)
          ->label('created',ADMIN_PAGES_CREATED)
          ->label('active',ADMIN_PAGES_ACTIVE);
          

$xcrud->fields('title,parent,before_page,after_page,active',false,ADMIN_PAGES_GENERAL);
$xcrud->relation('parent','pages','id',array('title'));

$langs=$db->fetch_array("SELECT id,code,name from langs ");  
foreach($langs as $lang){
    $pages_lang = $xcrud->nested_table($lang['name'],'id','page-lang','page'); 
    $pages_lang->where('lang=',$lang['id']);
    $pages_lang->columns('SEO,meta_title,content');
    $pages_lang->fields('SEO,content,active',false,ADMIN_PAGES_CONTENT);
    $pages_lang->label('content',ADMIN_PAGES_CONTENT)
               ->label('SEO',ADMIN_PAGES_SEO)
               ->label('lang',ADMIN_PAGES_LANG)
               ->label('created',ADMIN_PAGES_CREATED)
               ->label('active',ADMIN_PAGES_ACTIVE)
               ->label('meta_title',ADMIN_PAGES_META_TITLE)
               ->label('meta_keywords',ADMIN_PAGES_META_KEY)
               ->label('meta_desc',ADMIN_PAGES_META_DESC);
               
    $pages_lang->change_type('meta_desc','textarea');
    $pages_lang->change_type('page','hidden');
    $pages_lang->column_pattern('SEO','<a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].BASEPATH.'{value}">http://'.$_SERVER['HTTP_HOST'].BASEPATH.'{value}</a>');

    $pages_lang->fields('meta_title,meta_keywords,meta_desc,created',false,ADMIN_PAGES_SEO_TAB);
    $pages_lang->pass_var('lang', $lang['id'], 'create');
    $pages_lang->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    $pages_lang->relation('lang','langs','id',array('name'));
}

    $elements = $xcrud->nested_table(ADMIN_PAGES_BLOCKS,'id','page_elements','page'); 
    $elements->fields('template,orderNo',false,ADMIN_PAGES_GENERAL);
    
    $elements->label('template',ADMIN_PAGES_TEMPLATE)
             ->label('orderNo',ADMIN_PAGES_ORDER);
             
    $elements->change_type('page','hidden');
    $elements->relation('template','elements','id',array('name'));
    $elements->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();

    $elements_blocks = $elements->nested_table(ADMIN_PAGES_POSTS,'id','page_element_posts','element'); 
    $elements_blocks->columns('post,orderNo');
    $elements_blocks->label('post',ADMIN_PAGES_POST)
                    ->label('orderNo',ADMIN_PAGES_ORDER);
    $elements_blocks->change_type('element','hidden');
    $elements_blocks->relation('post','posts','id',array('title'));
    $elements_blocks->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();
    
    $featured = $xcrud->nested_table(ADMIN_PAGES_TAB_IMAGES,'id','featured_images','item'); 
    $featured->where('type=','page');
    $featured->fields('slika,redosled',false);
    
    $featured->label('slika',ADMIN_PAGES_IMAGE)
             ->label('redosled',ADMIN_PAGES_ORDER);
             
    $featured->change_type('type,item','hidden');
    $featured->pass_var('type', 'page', 'create');
    $featured->change_type('slika', 'image','', array('path'=>UPLOAD.'image'));
    $featured->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();

    
    $xcrud->columns('title,active');

    
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title',ADMIN_PAGES_TITLE);

$breadcrumbs[]=array('link'=>'pages','title'=>ADMIN_PAGES_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
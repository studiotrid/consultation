<?php
require_once 'includes.php';

$smarty->assign('page_title',ADMIN_MENUS_TITLE);
$langs=$db->fetch_array("SELECT * from langs");

if (isset($_GET['addmenu'])){
    $data['parent']=$_POST['parent'];
    $data['menu']=$_GET['menu_id'];
    $data['link_type']=$_POST['link_type'];
    $data['title']=$_POST['title'];
    switch($_POST['link_type']){
        case "post":$data['link']=$_POST['link_post'];break;
        case "page":$data['link']=$_POST['link_page'];break;
        case "custom":$data['link']=$_POST['link_custom'];break;
    }
    $datas['menu_item']=$db->insert('menu_items',$data);
    foreach($langs as $lang){
        $datas['lang']=$lang['id'];
        $datas['title']=$_POST['title_'.$lang['id']];
        $db->insert('menu_lang',$datas);
    }
}
if (isset($_GET['edit'])){
    $edit=$db->query_first("SELECT * from menu_items WHERE id='".$_GET['edit']."'");
    $smarty->assign('edit',$edit);
    foreach($langs as $lang){
         $edit_lang=$db->query_first("SELECT * from menu_lang WHERE lang='".$lang['id']."' and menu_item='".$_GET['edit']."'");
         $smarty->assign('edit'.$lang['id'],$edit_lang);
    }
    
}
if (isset($_GET['remove'])){
    $data['parent']=0;
    $db->update('menu_items',$data,'parent="'.$_GET['remove'].'"');
    $db->query("DELETE from menu_lang WHERE menu_item='".$_GET['remove']."'");
    $db->query("DELETE from menu_items WHERE id='".$_GET['remove']."'");
    }
if (isset($_GET['update'])){
    $data['parent']=$_POST['parent'];
    $data['menu']=$_GET['menu_id'];
    $data['link_type']=$_POST['link_type'];
    $data['title']=$_POST['title'];
    switch($_POST['link_type']){
        case "post":$data['link']=$_POST['link_post'];break;
        case "page":$data['link']=$_POST['link_page'];break;
        case "custom":$data['link']=$_POST['link_custom'];break;
    }
    $db->update('menu_items',$data,'id="'.$_GET['update'].'"');
    $datas['menu_item']=$_GET['update'];
    foreach($langs as $lang){
        $datas['title']=$_POST['title_'.$lang['id']];
        $datas['active']=$_POST['active_'.$lang['id']];
        $ima=$db->query_first("SELECT id from menu_lang WHERE menu_item='".$_GET['update']."' and lang='".$lang['id']."'");
        if (isset($ima['id']))  $db->update('menu_lang',$datas,'id="'.$ima['id'].'"');
        else {
            $datas['lang']=$lang['id'];
            $db->insert('menu_lang',$datas);
        }
    }
    }

$smarty->assign('wholemenu',$main_menu->getMenuList(true));

$breadcrumbs[]=array('link'=>'/menus','title'=>ADMIN_MENUS_TITLE);
$breadcrumbs[]=array('link'=>'menu_tems','title'=>ADMIN_MENUS_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
$smarty->assign("nestable", true); 
$smarty->assign('xcrud_js','<script src="/@CMS/assets/menu_items.js"></script>');

$pages=$db->fetch_array("SELECT id,title from pages WHERE active='1'");
$posts=$db->fetch_array("SELECT id,title from posts WHERE active='1'");

$smarty->assign("pages", $pages);
$smarty->assign("posts", $posts);
$smarty->assign("langs", $langs);
   
if ($login->isLoggedIn()) $smarty->assign("content", $smarty->fetch('menu_items.tpl'));   
else $smarty->assign("login", "login"); 
//$smarty->debugging = true;     
$smarty->display('layout.tpl');
$db->close();
?>
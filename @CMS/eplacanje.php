<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('eplacanje');
    if(isset($_GET['tip'])) $xcrud->where('tip',$_GET['tip']);
    if(isset($_GET['status'])) $xcrud->where('status',$_GET['status']);
    $xcrud->unset_view();
    $xcrud->unset_remove();
    
    $xcrud->order_by('datum','desc');
    $xcrud->order_by('status','asc');

$xcrud->columns('datum,broj,iznos,link,email,tel,saglasan,zastupnik,status');          

$xcrud->relation('zastupnik','zaposleni','id',array('ime'));
$xcrud->label('zastupnik','zaposleni');
$xcrud->column_pattern('link','https://webshop.sava.co.me/eplacanje/polisa/{broj}/{id}');
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','E-plaćanje');

$breadcrumbs[]=array('link'=>'eplacanje.php','title'=>'E-plaćanje');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
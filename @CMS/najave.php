<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('najave');
    $xcrud->where('tip=',$_GET['tip']);
    $xcrud->unset_view();
    $xcrud->unset_sortable();
    $xcrud->order_by('redosled');

$xcrud->change_type('tip','hidden');
$xcrud->change_type('slika', 'image','', array('path'=>UPLOAD.'image')); 
$xcrud->pass_var('tip', $_GET['tip'], 'create');

$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());

    $xcrud->button('#', "Up", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'moveNajavaUp',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $xcrud->button('#', "Down", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'moveNajavaBottom',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $xcrud->create_action('up', 'moveNajavaUp');
    $xcrud->create_action('down', 'moveNajavaBottom');
     

if ($_GET['tip']=='knjiga') {
    $breadcrumbs[]=array('link'=>'knjige-najave','title'=>'Najave za knjige');
    $smarty->assign('page_title',"Najave za knjige");
}
if ($_GET['tip']=='clanak') {
    $breadcrumbs[]=array('link'=>'clanak-najave','title'=>'Najave za astrološke članke');
    $smarty->assign('page_title',"Najave za astrološke članke");
}
if ($_GET['tip']=='dvd') {
    $breadcrumbs[]=array('link'=>'dvd-najave','title'=>'Najave za DVD-je');
    $smarty->assign('page_title',"Najave za DVD-je");
}
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
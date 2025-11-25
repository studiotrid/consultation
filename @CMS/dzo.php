<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('dzo_tip');
    $xcrud->unset_view();
    $xcrud->unset_remove();


          

$xcrud->fields('naziv',false,'Tip osiguranja');
 


$opseg = $xcrud->nested_table('Opseg','id','dzo_opseg','osiguranje'); 
$opseg->fields('naziv,suma,redosled',false,'Opseg');
$opseg->order_by('redosled','asc');
$opseg->change_type('osiguranje','hidden');
$opseg->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();

$operiod = $xcrud->nested_table('Period','id','dzo_period','osiguranje'); 
$operiod->fields('dana',false,'Period');
$operiod->order_by('dana','asc');
$operiod->change_type('osiguranje','hidden');
$operiod->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title()->unset_numbers()->unset_pagination()->unset_limitlist()->unset_sortable();

$cene = $xcrud->nested_table('Cene','id','dzo_cene','osiguranje'); 
$cene->fields('opseg,period,suma,cena',false,'Cene');
$cene->change_type('osiguranje','hidden');
$cene->relation('opseg','dzo_opseg','id',array('naziv'),'osiguranje = {osiguranje}','redosled');
$cene->relation('suma','dzo_suma','id',array('naziv'),'','redosled');
$cene->relation('period','dzo_period','id',array('dana'),'osiguranje = {osiguranje}','dana');
$cene->unset_csv()->unset_view()->unset_search()->unset_print()->unset_title();

    
    
$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Osiguranja');

$breadcrumbs[]=array('link'=>'dzo.php','title'=>'Osiguranje');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
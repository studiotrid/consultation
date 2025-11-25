<?php
require_once 'includes.php';

	$xcrud = Xcrud::get_instance();
    $xcrud->table('zastupnici');
   // $xcrud->unset_edit();
    //$xcrud->unset_remove();
    //$xcrud->unset_add();
    $xcrud->subselect('polisa','SELECT COUNT(id) FROM polise WHERE status="paid" AND kod = {kod} ');
    $xcrud->subselect('iznos','SELECT round(sum(iznos-(dodatno2-dodatno2/1.09+dodatno3-dodatno3/1.09)),2) FROM polise WHERE status="paid" AND kod = {kod} ');      

$xcrud->label('name','Naziv zastupnika')
      ->label('kod','Zastupnièki kod')
      ->label('popust','Odobreni popust')
      ->label('link','Generisani link')
      ->label('linkDZO','Generisani link za DZO')
      ->label('polisa','Ukupno generisano polisa')
      ->label('iznos','Ukupna premija')
      ->label('tel','Telefon')
      ->label('active','Zastupnik aktivan?')
;
$xcrud->columns('name,tel,kod,popust,link,linkDZO,active,polisa,iznos');

$xcrud->fields('name,tel,email,ekspozitura,kod,link,linkDZO,popust,iznos,active',false,'Osnovno');
//$xcrud->pass_var('link', base64_encode("{kod}"));
$xcrud->before_insert('hashLink');
$xcrud->before_update('hashLink');
$xcrud->column_pattern('link','https://webshop.sava.co.me/code/{value}');
$xcrud->subselect('linkDZO','{link}');
$xcrud->column_pattern('linkDZO','https://webshop.sava.co.me/codeDZO/{value}');

//$xcrud->change_type('link','hidden');

$smarty->assign('xcrud_js',Xcrud::load_js());
$smarty->assign('xcrud_css',Xcrud::load_css());
$smarty->assign('page_title','Zastupnici');

$breadcrumbs[]=array('link'=>'zastupnici.php','title'=>'Zastupnici');
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $xcrud->render());   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
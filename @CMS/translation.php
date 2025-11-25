<?php 
require_once 'includes.php';

$smarty->assign('page_title',ADMIN_TRANSLATIONS_TITLE);


$langs=$db->fetch_array("SELECT * FROM langs");
foreach($langs as $lang){
    $blocks=$db->fetch_array('SELECT * FROM term_block');
    foreach($blocks as $block){
        $ma=$db->fetch_array("SELECT * FROM terms WHERE block='".$block['id']."'");
        $i=0;
        foreach($ma as $term){
            if (isset($_GET['translated'])){
            
                if (isset($_POST['termin_'.$lang['id'].'_'.$term['id']]) AND ($_POST['termin_'.$lang['id'].'_'.$term['id']]!='')){
                    $termin['value']=$_POST['termin_'.$lang['id'].'_'.$term['id']];
                    $prevod=$db->query_first("SELECT * FROM terms_translations WHERE term_id='".$term['id']."' and lang='".$lang['id']."'");
                    if (isset($prevod['value'])){
                        $db->update('terms_translations',$termin,"id='".$prevod['id']."'");
                    }
                    else {
                        $termin['lang']=$lang['id'];
                        $termin['term_id']=$term['id'];
                        $db->insert('terms_translations',$termin); 
                    }
                    unset($termin,$prevod);
                }
                else $db->query("DELETE FROM terms_translations WHERE term_id='".$term['id']."' and lang='".$lang['id']."'");
            }
            $prevod=$db->query_first("SELECT * FROM terms_translations WHERE term_id='".$term['id']."' and lang='".$lang['id']."'");
            if (isset($prevod['value'])) $i++;
            $elementi[] =array('opis'=>$term['value'],'prevod'=>$prevod['value'],'id'=>$term['id']); 
        }
        $blokovi[]=array('title'=>$block['name'],'id'=>$block['id'],'prevedeno'=>$i,'element'=>$elementi);
        unset($elementi,$i);
    }
    $smarty->assign('blocks'.$lang['id'],$blokovi);
    unset($blokovi);
}

$breadcrumbs[]=array('link'=>'pages','title'=>ADMIN_TRANSLATIONS_TITLE);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) $smarty->assign("content", $smarty->fetch('translation.tpl'));   
else $smarty->assign("login", "login"); 
     
$smarty->display('layout.tpl');
$db->close();
?>
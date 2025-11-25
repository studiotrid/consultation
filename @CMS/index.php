<?php 
require_once 'includes.php';


@$smarty->assign('page_title',ADMIN_DASHBOARD);

@$breadcrumbs[]=array('link'=>'','title'=>ADMIN_DASHBOARD);
$smarty->assign('breadcrumbs',$breadcrumbs);
    
if ($login->isLoggedIn()) {
    $db->query("SET lc_time_names = 'sr_RS'");
   $prodajaPZO = $db->fetch_array("SELECT DATE_FORMAT(`datum`,'%M %Y') as mesec,count(*) as brojPZO,sum(iznos) as iznosPZO FROM `polise` WHERE `status`='paid' and osiguranje='pzo' GROUP BY DATE_FORMAT(`datum`,'%b %Y') order by datum desc");
   

   $smarty->assign("prodaja", $prodajaPZO);
   $smarty->assign("content", $smarty->fetch('frontpage.tpl')); 
}  
else $smarty->assign("login", "login"); 


//$smarty->debugging = true;     
$smarty->display('layout.tpl');
$db->close();
?>
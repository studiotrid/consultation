<?php
    require_once '../../includes.php';
    $menu_data = json_decode($_GET['order'], true);
    
    if (!is_array($menu_data)) {
        $menu_data = array();
    }
    $i=0;
    foreach($menu_data as $menus){
            $data['orderNo']=$i;
            $db->update('menu_items',$data,'id="'.$menus['id'].'"');
            $i++;
            if (isset($menus['children'])){
                $s=0;
                foreach($menus['children'] as $child){
                    $datas['orderNo']=$s;
                    $db->update('menu_items',$datas,'id="'.$child['id'].'"');
                    $s++;  
                    if (isset($child['children'])){
                        $d=0;
                        foreach($child['children'] as $subchild){
                            $datasd['orderNo']=$d;
                            $db->update('menu_items',$datasd,'id="'.$subchild['id'].'"');
                            $d++;  
                        }
                    }
                }
            }
        }

?>
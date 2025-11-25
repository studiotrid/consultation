<?php
class Lang{
	
    private $db;
    public $lang_id;
    
    function __construct(){
        $this->db = Database::obtain();
    }
    
    function setLang($code){
        $this->lang_id = $code;
    }

    
    function e($term,$variables=false){
        $termin=$this->db->query_first("SELECT id,value,variables FROM terms WHERE name='$term'");
        $prevedeno=$this->db->query_first("SELECT id,value FROM terms_translations WHERE term_id='".$termin['id']."' AND lang='".$this->lang_id."'");
        if(!empty($prevedeno['id'])){  /// ima prevod
            if (is_array($variables)){
                $promenjive=explode(',',$termin['variables']);
                foreach($variables as $key=>$variable){
                    $prevedeno['value'] = str_replace($promenjive[$key], $variable, $prevedeno['value']);
                }
            }
            $prevod = $prevedeno['value'];
        }
        else{   ///  nema prevod
            
            if (is_array($variables)){
                $promenjive=explode(',',$termin['variables']);
                foreach($variables as $key=>$variable){
                    $termin['value'] = str_replace($promenjive[$key], $variable, $termin['value']);
                }
            }
            $prevod = $termin['value'];
        }
        
        return $prevod;
        
    }
    
    function populateForSmarty(){
        global $smarty;
        
        $termin=$this->db->fetch_array("SELECT name FROM terms where variables=''");
        foreach ($termin as $tem){
            $prevod=$this->e($tem['name']);
            $smarty->assign($tem['name'],$prevod);
        }
        
    }
    
}

?>
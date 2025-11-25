<?php
class Lang{
    public $lang_code;
    
    function __construct($lang_code){
        $this->lang_code = $lang_code;
        $_SESSION["adminlang"]= $lang_code;

    }
    
    function populateForSmarty(){
    global $smarty;
    include_once('lang/'.$this->lang_code.'.php');
        if (count($i18n)>0){
        foreach($i18n as $key=>$term){
            $smarty->assign($key,$term);
            define($key,$term);
        }
        }
    
    }
    
    function getList(){
       if ($handle = opendir('../../lang')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $jezik=explode('.php',$entry);
                    $langs[]=$jezik[0];
                }
            }
            closedir($handle);
        }
        
        return $langs;
    }
    
}

?>
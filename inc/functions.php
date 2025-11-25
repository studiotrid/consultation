<?php

sanitizeXSS();

//// Funkcija za proveru sintakse E-maila
function valid_email($email){
    if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) return true;
    else return false;
}

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function sanitizeXSS () {
    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $_REQUEST = (array)$_POST + (array)$_GET + (array)$_REQUEST;
}


//// Funkcija za sortiranje matrice po unutrašnjem ključu
function array_sort($array,$subkey,$order='ASC') {
	foreach($array as $k=>$v) {$b[$k] = strtolower($v[$subkey]);}
    if ($order!='ASC') arsort($b); 
    else asort($b);
    foreach($b as $key=>$val) {	$c[] = $array[$key];}
	return $c;
}


function cleanURL($string)
{
    $url = str_replace("'", '', $string);
    $url = str_replace('%20', ' ', $url);
    $trans = array('.'=> '_',"'"=> '|','"'=> '|','/'=> '-','='=> '-',' '=> '-',','=> '', 'ć'=>'c', 'Ć'=>'C', 'č'=>'c', 'Č'=>'C', 'š'=>'s', 'Š'=>'S','đ'=>'dj','Đ'=>'Dj','ž'=>'z','Ž'=>'Z');
    $url = strtr($url, $trans);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url); // substitutes anything but letters, numbers and '_' with separator
    $url = trim($url, "-");
    $cyr  = array('а','б','в','г','д','ђ','е','ж','з','и','ј','к','л','љ','м','н','њ','о','п','р','с','т','ћ','у', 'ф','х','ц','ч','џ','ш'
                  ,'А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','Љ','М','Н','Њ','О','П','Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Џ','Ш');
    $lat = array('a','b','v','g','d','dj','е','z','z','i','j','k','l','lj','m','n','nj','o','p','r','s','t','c','u', 'f','h','c','c','dz','s'
                 ,'A','B','V','G','D','Dj','E','Z','Z','I','J','K','L','Lj','M','N','Nj','O','P','R','S','T','C','U','F','H','C','C','Dz','S');
   $url = str_replace($cyr, $lat, $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url); // keep only letters, numbers, '_' and separator
    if ($url=='') return 'x';
    else return $url;
}

 function generateRandomString($length = 20) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function uzmidatumJmbg($jmbg){
    $dan=substr($jmbg,0,2);
    $mesec=substr($jmbg,2,2);
    $godina = substr($jmbg,4,3);
    $checkGodina = substr($jmbg,4,1);
    if($checkGodina==0) $godina="2".$godina;
    else $godina="1".$godina;
    
    return $godina."-".$mesec."-".$dan;
}

function checkJMBG($jmbg){
    if(strlen($jmbg)!=13) return false;
    else{
        $A = substr($jmbg,0,1);
        $B = substr($jmbg,1,1);
        $V = substr($jmbg,2,1);
        $G = substr($jmbg,3,1);
        $D = substr($jmbg,4,1);
        $DJ = substr($jmbg,5,1);
        $E = substr($jmbg,6,1);
        $ZJ = substr($jmbg,7,1);
        $Z = substr($jmbg,8,1);
        $I = substr($jmbg,9,1);
        $J = substr($jmbg,10,1);
        $K = substr($jmbg,11,1);
        $L = substr($jmbg,-1);
        
        $kontrola = 11 - (( 7*($A+$E) + 6*($B+$ZJ) + 5*($V+$Z) + 4*($G+$I) + 3*($D+$J) + 2*($DJ+$K) ) % 11);
        if($kontrola>=9) $kontrola = 0;
        if($L==$kontrola) return true;
        else return false;
    }
}

function dana($date1,$date2){
        if(isset($date1) and isset($date2)){
            
            
            $start = strtotime($date1);
            $end = strtotime($date2);
            
            //$days_between = ceil(abs($end - $start) / 86400)+1;
            $days_between = ceil(abs($end - $start+7200) / 86400);
            
            return $days_between;
            
            /*
            $datetime1 = new DateTime($date1);
            $datetime2 = new DateTime($date2);
            $difference = $datetime1->diff($datetime2);
            
            return $difference->d + 1;
            */
        }
        else return false;
    }

?>
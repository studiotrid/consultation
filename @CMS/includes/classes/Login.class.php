<?php
 
class Login {
    
    private $db;
    static private $_instance = null;
    
    private function __construct() {
        $this->db = Database::obtain();
        session_start();
    }
    
    static public function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new Login();
        }
        
        return self::$_instance;
        
    }
    
    public function getUserDetails(){
        $sql = "SELECT *,CONCAT_WS('&nbsp;',`Fname`,`Lname`) as name
                FROM `users` 
                WHERE `id` = '".$_SESSION['usernameId']."'";
        $check = $this->db->query_first($sql);
        return $check;
    }
    
    public function changeUserDetails($details){
        $data['Fname']=$details['profileFName'];
        $data['Lname']=$details['profileLName'];
        $data['phone']=$details['profileMobile'];
        $data['occupation']=$details['profileOcupation'];
        $data['level']=$details['adminRole'];
        $data['website']=$details['profileWeb'];
        $data['email']=$details['profileEmail'];
        $this->db->update('users',$data,"id='".$_SESSION['usernameId']."'");
    }
    
    public function checkLogin($username, $password,$remember=false) {
        $sql = "SELECT COUNT(*) as broj, id
                FROM `users` 
                WHERE `username` = '".$this->db->escape($username)."'
                AND `password` = '".$this->db->escape(md5($password.PASSWORD_SALT))."'";
        
        $count = $this->db->query_first($sql);

        if ($count['broj'] == 1) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            $_SESSION['usernameId'] = $count['id'];
            $_SESSION['auth'] = md5('pristupio');
            if ($remember){
                setcookie("un", $username, time()+13600);  /* expire in 1 hour */
                setcookie("pw", $password, time()+13600);  /* expire in 1 hour */
            }
            return true;
            
        } else {
            return false;
        }
    }
    
    public function checkLevel() {
        $sql = "SELECT `level` 
                FROM `users` 
                WHERE (`username` = '".$this->db->escape($_SESSION['username'])."')";
        $check = $this->db->query_first($sql);
        return $count['level'];
    }
    
    
    public function logout() {
        session_destroy();
    }
    
    public function isLoggedIn() {
        if (isset($_SESSION['username']) && $_SESSION['auth'] === md5('pristupio')) {
            return true;
        } else {
            return false;
        }
    }
}
?>
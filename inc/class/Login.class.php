<?php

class Login
{
				private $db;
				static private $_instance = null;
                
				private function __construct(){
					$this->db = Database::obtain();
				}

				static public function getInstance(){
					if (self::$_instance == null)	
							self::$_instance = new Login();
						
					return self::$_instance;

				}

				public function setDatabase(PDO $database) {
					$this->db = $database;
				}
                
                public function getCoach() {
				if (isset($_SESSION['coach']) && $_SESSION['coach'] != ''){
				    $coach = $this->db->query_first("SELECT * from coach where id='".$_SESSION['coach']."'");
                    return $coach;
				    }
                    else return false;
				}
                
                public function getCoachLang() {
				if (isset($_SESSION['coach']) && $_SESSION['coach'] != ''){
				    $coach = $this->db->query_first("SELECT lang from coach where id='".$_SESSION['coach']."'");
                    return $coach['lang'];
				    }
                    else return false;
				}

				public function checkLogin($username, $password) {
								$sql = "SELECT COUNT(*) as broj,coach,id,ime
                                        FROM `korisnici` 
                                        WHERE (`username` = '" . $username . "' 
                                        AND `password` = '" . md5($password) . "')
                                        GROUP BY `username`";

								$count = $this->db->query_first($sql);


								if (isset($count['broj']) && $count['broj'] == 1)
								{
									session_regenerate_id(true);
									$_SESSION['username'] = $username;
									$_SESSION['auth'] = md5('auth');
									$_SESSION['coach'] = $count['coach'];
                                    $_SESSION['logged']=$count['id'];
                                    $_SESSION['loggedName']=$count['ime'];
                                    $_SESSION['language']=$this->getCoachLang();
									return true;
								} else
    									return false;
    								
				}
                
				public function logout() {
				        $_SESSION['logged']='';
                        $_SESSION['loggedName']='';
                        $_SESSION['username']='';
						session_destroy();
                        header("Location: index.php");
				}
                
				public function isLoggedIn(){
						if (isset($_SESSION['username']) && $_SESSION['auth'] === md5('auth'))
                        	return true;
						 else
							return false;
				}
}

?>
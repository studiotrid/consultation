<?php

class Login
{
				private $db;
				static private $_instance = null;
				private $coachHashEndpoint = 'https://coach.profesionalnaastrologija.com/api/consultation-login-hash/';
                
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
									$this->setLoginSession($username, $count['coach'], $count['id'], $count['ime']);
									return true;
								} else
    									return false;
    								
				}

				public function checkLoginHash($hash, &$errorCode = null) {
					$errorCode = null;
					$hash = trim((string)$hash);

					if ($hash === '') {
						$errorCode = 'invalid_hash';
						return false;
					}

					$response = $this->validateHashWithCoach($hash);

					if (empty($response) || empty($response['ok'])) {
						$errorCode = isset($response['error']) ? (string)$response['error'] : 'invalid_hash';
						return false;
					}

					$externalUsername = trim((string)($response['external_username'] ?? ''));
					$externalEmail = trim((string)($response['external_email'] ?? ''));
					$displayName = trim((string)($response['display_name'] ?? ''));
					$coachId = (int)($response['coach_id'] ?? 0);

					if ($externalUsername === '' && $externalEmail === '') {
						$errorCode = 'invalid_payload';
						return false;
					}

					$user = $this->findUserByExternalIdentity($externalUsername, $externalEmail);

					if (!$user) {
						$userId = $this->createUserFromExternalIdentity($externalUsername, $externalEmail, $displayName, $coachId);
						if (!$userId) {
							$errorCode = 'local_user_create_failed';
							return false;
						}

						$user = $this->db->query_first("SELECT id, username, coach, ime FROM korisnici WHERE id='" . (int)$userId . "'");
					}

					if (!$user || empty($user['id'])) {
						$errorCode = 'local_user_not_found';
						return false;
					}

					$this->setLoginSession((string)$user['username'], (int)$user['coach'], (int)$user['id'], (string)$user['ime']);
					return true;
				}

				private function setLoginSession($username, $coachId, $userId, $displayName) {
					session_regenerate_id(true);
					$_SESSION['username'] = $username;
					$_SESSION['auth'] = md5('auth');
					$_SESSION['coach'] = (int)$coachId;
					$_SESSION['logged'] = (int)$userId;
					$_SESSION['loggedName'] = $displayName;
					$lang = $this->getCoachLang();
					$_SESSION['language'] = $lang ? $lang : (defined('DEFAULT_LANG') ? DEFAULT_LANG : 'sr');
				}

				private function validateHashWithCoach($hash) {
					$payload = json_encode(array('hash' => $hash));

					if ($payload === false) {
						return array('ok' => false, 'error' => 'invalid_payload');
					}

					$rawBody = '';
					$httpCode = 0;

					if (function_exists('curl_init')) {
						$ch = curl_init($this->coachHashEndpoint);
						curl_setopt_array($ch, array(
							CURLOPT_POST => true,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
							CURLOPT_POSTFIELDS => $payload,
							CURLOPT_TIMEOUT => 10,
						));
						$rawBody = curl_exec($ch);
						$httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
						curl_close($ch);
					} else {
						$context = stream_context_create(array(
							'http' => array(
								'method' => 'POST',
								'header' => "Content-Type: application/json\r\n",
								'content' => $payload,
								'timeout' => 10,
							),
						));
						$rawBody = @file_get_contents($this->coachHashEndpoint, false, $context);
						if (isset($http_response_header[0])) {
							if (preg_match('/\s(\d{3})\s/', $http_response_header[0], $m)) {
								$httpCode = (int)$m[1];
							}
						}
					}

					if (!is_string($rawBody) || $rawBody === '') {
						return array('ok' => false, 'error' => 'empty_response');
					}

					$decoded = json_decode($rawBody, true);
					if (!is_array($decoded)) {
						return array('ok' => false, 'error' => 'invalid_response');
					}

					if ($httpCode !== 200) {
						$decoded['ok'] = false;
					}

					return $decoded;
				}

				private function findUserByExternalIdentity($externalUsername, $externalEmail) {
					if ($externalUsername !== '') {
						$user = $this->db->query_first("SELECT id, username, coach, ime FROM korisnici WHERE username='" . $this->db->escape($externalUsername) . "' LIMIT 1");
						if ($user && !empty($user['id'])) {
							return $user;
						}
					}

					if ($externalEmail !== '') {
						$user = $this->db->query_first("SELECT id, username, coach, ime FROM korisnici WHERE email='" . $this->db->escape($externalEmail) . "' LIMIT 1");
						if ($user && !empty($user['id'])) {
							return $user;
						}
					}

					return false;
				}

				private function createUserFromExternalIdentity($externalUsername, $externalEmail, $displayName, $coachId) {
					$username = $externalUsername !== '' ? $externalUsername : $this->usernameFromEmail($externalEmail);
					if ($username === '') {
						$username = 'client_' . substr(md5(uniqid('', true)), 0, 12);
					}

					$baseUsername = $username;
					$counter = 1;
					while ($this->db->query_first("SELECT id FROM korisnici WHERE username='" . $this->db->escape($username) . "' LIMIT 1")) {
						$counter++;
						$username = $baseUsername . '_' . $counter;
					}

					$nameToSave = $displayName !== '' ? $displayName : $username;
					$emailToSave = $externalEmail !== '' ? $externalEmail : null;
					$coachToSave = $coachId > 0 ? $coachId : 0;
					$randomPassword = md5(uniqid('coach_hash_', true));

					$insertData = array(
						'username' => $username,
						'password' => $randomPassword,
						'ime' => $nameToSave,
						'coach' => (string)$coachToSave,
					);

					if ($emailToSave !== null) {
						$insertData['email'] = $emailToSave;
					}

					return $this->db->insert('korisnici', $insertData);
				}

				private function usernameFromEmail($email) {
					$email = trim((string)$email);
					if ($email === '' || strpos($email, '@') === false) {
						return '';
					}

					$parts = explode('@', $email);
					$local = strtolower(trim($parts[0]));
					$local = preg_replace('/[^a-z0-9._-]/', '', $local);

					return $local;
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
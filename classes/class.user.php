<?php
session_start();
require_once 'dbconfig.php';

class USER{
	private $conn;

	public function __construct()
    {
        $database = new Database();
        $db = $database->dbConn();
        $this->conn = $db;
    }

	public function runQuery($sql){
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function lastID(){
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	public function register(){

	}

	public function login($username, $password){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM users_tbl WHERE username=:user_name");
			$stmt->execute(array(":user_name" => $username));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1){
				if($userRow['approve'] == "1"){
					if($userRow['usertype'] == "Admin"){
						if($userRow['password'] == md5($password)){
							$_SESSION['userSession'] = $userRow['id'];
							$_SESSION['userSessionName'] = $userRow['username'];
							return true;
						}else{
							header("location: login.php?error1");
							$_SESSION['message'] = "Password should be hashed.";
							exit;
						}
					}else{
						header("location: login.php?error2");
						$_SESSION['message'] = "Undefine user type.";
						exit;
					}
				}else{
					header("location: login.php?error3");
					$_SESSION['message'] = "Your account is not approved";
					exit;
				}
			}else{
				header("location: login.php?error4");
				$_SESSION['message'] = "No data found is database";
				exit;
			}
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}

	public function staffLogin($username, $password){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM staff_tbl WHERE username=:user_name");
			$stmt->execute(array(":user_name" => $username));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1){
				if($userRow['approve'] == "1"){
					if($userRow['usertype'] == "Faculty"){
						if($userRow['password'] == md5($password)){
							$_SESSION['userSession'] = $userRow['staff_id'];
							$_SESSION['userSessionName'] = $userRow['username'];
							return true;
						}else{
							header("location: login.php?error1");
							$_SESSION['message'] = "Password should be hashed.";
							exit;
						}
					}else{
						header("location: login.php?error2");
						$_SESSION['message'] = "Undefine user type.";
						exit;
					}
				}else{
					header("location: login.php?error3");
					$_SESSION['message'] = "Your account is not approved";
					exit;
				}
			}else{
				header("location: login.php?error4");
				$_SESSION['message'] = "No data found is database";
				exit;
			}
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}

	public function is_logged_in()
    {
        if (isset($_SESSION['userSession'])) {
            return true;
        }
    }

	public function redirect($url){
		header("location: $url");
	}

	public function logout(){
		session_destroy();
		$_SESSION['userSession'] = false;
	}
}

?>
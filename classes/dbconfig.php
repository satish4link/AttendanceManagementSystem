<?php
class Database{
	private $host = "localhost";
	private $db_name = "attendance";
	private $username = "root";
	private $password = "";
	private $conn;

	public function dbConn(){
		$this->conn = null;
		try{
			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
		}catch(PDOException $exception){
			echo "Connection error: ".$exception->getMessage();
		}
		return $this->conn;
	}
}

?>
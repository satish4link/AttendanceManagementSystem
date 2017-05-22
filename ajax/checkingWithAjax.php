<?php
	require_once '../classes/class.user.php';
	$user = new USER();

	if(isset($_POST['email']))
	{
		$emailId = $_POST['email'];

		$stmt = $user->runQuery("SELECT email FROM staff_tbl WHERE email=:email");
		$stmt->execute(array(":email"=>$emailId));
		if($stmt->rowCount()==1){
			echo "Email Already Exists";
		}else{
			echo "Valid";
		}
	}else if(isset($_POST['code'])){
		$staff_username = $_POST['code'];

		$stmt = $user->runQuery("SELECT username FROM staff_tbl WHERE username=:username");
		$stmt->execute(array(":username"=>$staff_username));
		if($stmt->rowCount()==1){
			echo "Username Already Taken";
		}else{
			echo "Valid";
		}
	}else if(isset($_POST['code'])){
		$staff_username = $_POST['code'];

		$stmt = $user->runQuery("SELECT username FROM staff_tbl WHERE username=:username");
		$stmt->execute(array(":username"=>$staff_username));
		if($stmt->rowCount()==1){
			echo "Username Already Taken";
		}else{
			echo "Valid";
		}
	}
?>
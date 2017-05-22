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
		$student_username = $_POST['code'];

		$stmt = $user->runQuery("SELECT registration_code FROM student_tbl WHERE registration_code=:username");
		$stmt->execute(array(":username"=>$student_username));
		if($stmt->rowCount()==1){
			echo "Choose Another Code";
		}else{
			echo "Valid";
		}
	}
?>
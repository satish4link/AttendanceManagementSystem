<?php
session_start();
require_once 'classes/class.user.php';
$user = new USER;

if($user->is_logged_in()!=""){
	$user->redirect('index.php');
}

if(isset($_POST['submit'])){
	$usertype = trim($_POST['usertype']);
	$username = trim($_POST['uname']);
	$password = trim($_POST['pword']);

	if(empty($username) or empty($password)){
		$_SESSION['message'] = "Must enter Username and Password";
		$user->redirect("login.php");
		exit;
	}

	$username = strip_tags($username);
	$password = strip_tags($password);

	if($usertype == 'Admin'){
		if($user->login($username, $password)){
			$user->redirect('admin.php');
		}else{
			$_SESSION['message'] = "Could not login as $username";
	        $user->redirect("login.php");
	        exit;
		}
	}else{
		if($user->staffLogin($username, $password)){
			$user->redirect('staffHome.php');
		}else{
			$_SESSION['message'] = "Could not login as $username";
	        $user->redirect("login.php");
	        exit;
		}
	}

	
}
?>
<?php
if(!isset($_SESSION['userSessionName'])){
	header("location: login.php");
	die();
}
?>
<?php
session_start();
include("session.php");
$id = $_GET["id"];

echo $id;

require_once 'classes/class.user.php';
$user = new USER;

$status = 1;

$stmt = $user->runQuery("UPDATE staff_tbl SET approve=:status WHERE staff_id=:uID");
$stmt->bindparam(":status",$status);
$stmt->bindparam(":uID",$id);
$stmt->execute();

$user->redirect("staffRecord.php");
?>